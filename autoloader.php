<?php
namespace effus;
spl_autoload_register(function($className){
  $file = str_replace('\\', DIRECTORY_SEPARATOR, $className);
  $file =  __DIR__.'/'.str_replace('effus'.DIRECTORY_SEPARATOR,'',$file).'.class.php';
  if (!file_exists($file)) {
    die("FNF: $file\n");
  }
  require $file;
});