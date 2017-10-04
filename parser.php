<?php
namespace effus;

use \effus\runner\RunnerParameters;
use \effus\runner\ParserRunner;
use \effus\runner\RunnerResults;

require_once "autoloader.php";
require_once "vendor/effus/php-tools/HTTPClient.php";

function outputStr($str, $ln = true)
{
  echo "$str" . ($ln ? "\n" : '');
}

try {
  $config = new RunnerParameters($argv);
  $result = ParserRunner::run($config);
  $result->show();

} catch (\Exception $e) {
  outputStr("Exception: " . $e->getMessage());
  outputStr("Usage: php parser.php <resource> <parser:YouTube> <algorithm|QuickSort>");
  exit(-1);
}


