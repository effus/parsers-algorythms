<?php
namespace effus\runner;

use ParserRunnerParameters;
use ParserRunnerResults;

/**
 * Parser Runner
 */
class ParserRunner {
  
  public static function run(\effus\runner\ParserRunnerParameters $param) {
    $parserClassName = "\\effus\\parsers\\{$param->algorithm}";
    if (!class_exists($parserClassName)) {
      throw new \Exception('Parser algorithm module not found: '.$parserClassName);
    }
    $response = \HttpClient::request($param->resource);
    if ($response[1]['http_code']!=200) {
        throw new \Exception('Bad HTTP response code: '.$response[1]['http_code']);
    }
    $parser = new $parserClassName();
    $result = $parser->process($response[0]);
    $result->show($param->output);
  }
}