<?php
namespace effus\parsers;

use effus\runner\ParserResults;

interface InterfaceParser
{
  public function process(string $resource) : ParserResults;
}