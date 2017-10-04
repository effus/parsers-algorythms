<?php
namespace effus\runner;

/**
 * @authors effus
 * @date    2017-10-04 00:37:44
 * @version ${1.0.0}
 */
class ParserRunnerParameters {
    public $resource;
    public $output;
    public $algorithm;

    public function __construct($argv) {
        if(isset($argv[1])){
            $this->resource = $argv[1];
        } else 
            throw new \Exception('Resource not specified');
        if(isset($argv[2])){
            $this->output = $argv[2];
        } else 
            throw new \Exception('Output not specified');
        if(isset($argv[3])){
            $this->algorithm = $argv[3];
        } else 
            throw new \Exception('Algorithm not specified');
    }
}