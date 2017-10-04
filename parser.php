<?php
namespace effus;

use \effus\runner\ParserRunnerParameters;
use \effus\runner\ParserRunner;

require_once "autoloader.php";
require_once "vendor/effus/php-tools/HTTPClient.php";

try {
  $config = new ParserRunnerParameters($argv);
  ParserRunner::run($config);

} catch(\Exception $e) {
  echo "Exception: ".$e->getMessage().PHP_EOL;
  echo "Usage: php parser.php <resource> <output> <algorithm>".PHP_EOL;
  exit(-1);
}


