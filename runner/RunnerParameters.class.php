<?php
namespace effus\runner;


class RunnerParameters
{
    public $resource;
    public $parser;
    public $algorithm;

    /**
     * RunnerParameters constructor
     *
     * @param array $argv
     */
    public function __construct(array $argv)
    {
        if (isset($argv[1])) {
            $this->resource = $argv[1];
        }
        else
            throw new \Exception('Resource not specified');
        if (isset($argv[2])) {
            $this->parser = $argv[2];
        }
        else
            throw new \Exception('Parser not specified');
        if (isset($argv[3])) {
            $this->algorithm = $argv[3];
        }
        else
            throw new \Exception('Algorithm not specified');
    }
}