<?php
namespace effus\parsers;

use effus\runner\ParserRunnerResults;

interface InterfaceParser {
  public function process(string $data):ParserRunnerResults;
}