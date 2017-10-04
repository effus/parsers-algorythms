<?php
namespace effus\runner;

use \effus\runner\RunnerParameters;
use \effus\runner\RunnerResults;

/**
 * Parser Runner
 */
class ParserRunner
{

  /**
   * Run parser and algorithm modules
   *
   * @param RunnerParameters $param
   * @return RunnerResults
   */
  public static function run(RunnerParameters $param) : RunnerResults
  {
    $memory = \memory_get_usage();

    // Make parser path
    $parserClassName = "\\effus\\parsers\\{$param->parser}";
    if (!class_exists($parserClassName)) {
      throw new \Exception('Parser module not found: ' . $parserClassName);
    }

    // Make algo path
    $algoClassName = "\\effus\\algorithms\\{$param->algorithm}";
    if (!class_exists($algoClassName)) {
      throw new \Exception('Algorithms module not found: ' . $algoClassName);
    }

    // Result container
    $result = new RunnerResults();

    // Initialize parser
    $parser = new $parserClassName();
    // Run parsing procedure
    $parserResult = $parser->process($param->resource);
    $result->setStat('parsing', $parserResult->getStat('parsing'));
    $result->setStat('requests', $parserResult->getStat('requests'));
    $ms = microtime(true);

    // Initialize algorithm
    $algorithm = new $algoClassName();
    // Make some sort process
    $sortedIndex = $algorithm->process($parserResult->getIndex());

    // Change index container
    $parserResult->setIndex($sortedIndex);
    $result->setStat('algorithm', microtime(true) - $ms);
    $result->setStat('memoryDiff', (\memory_get_usage() - $memory) . ' B');

    // Output sorted data
    $result->setData($parserResult->getDataByIndex());

    return $result;
  }
}