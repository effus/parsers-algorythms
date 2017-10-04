<?php
namespace effus\runner;

use \effus\runner\RunnerParameters;
use \effus\runner\RunnerResults;

/**
 * Parser Runner
 */
class ParserRunner
{

  public static function run(RunnerParameters $param) : RunnerResults
  {
    $memory = \memory_get_usage();

    // Initialize parser
    $parserClassName = "\\effus\\parsers\\{$param->parser}";
    if (!class_exists($parserClassName)) {
      throw new \Exception('Parser module not found: ' . $parserClassName);
    }

    $algoClassName = "\\effus\\algorithms\\{$param->algorithm}";
    if (!class_exists($algoClassName)) {
      throw new \Exception('Algorithms module not found: ' . $algoClassName);
    }

    $result = new RunnerResults();

    $parser = new $parserClassName();
    $parserResult = $parser->process($param->resource);
    $result->setStat('parsing', $parserResult->getStat('parsing'));
    $result->setStat('requests', $parserResult->getStat('requests'));
    $ms = microtime(true);

    $algorithm = new $algoClassName();
    $sortedIndex = $algorithm->process($parserResult->getIndex());

    $parserResult->setIndex($sortedIndex);
    $result->setStat('algorithm', microtime(true) - $ms);
    $result->setStat('memoryDiff', (\memory_get_usage() - $memory) . ' B');

    $result->setData($parserResult->getDataByIndex());

    return $result;
  }
}