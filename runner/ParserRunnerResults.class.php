<?php
namespace effus\runner;
/**
 * @authors effus
 * @date    2017-10-04 00:37:44
 * @version ${1.0.0}
 */
class ParserRunnerResults {

    private $data;
    private $stat=[
        'request'=>0,
        'parse'=>0,
        'algorithm'=>0,
        'memory'=>0
    ];

    public function show($output) {
        print_r($this->data);
        print_r($this->stat);
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setStat($key,$value) {
        $this->stat[$key] = $value;
    }
}