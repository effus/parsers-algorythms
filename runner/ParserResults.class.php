<?php
namespace effus\runner;

/**
 * Parser Results
 */
class ParserResults
{
    private $data = []; // container for any structures with key similar to indexed value
    private $index = []; // container for indexed data

    private $stat = [
        'requests' => 0,
        'parsing' => 0
    ];

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function getData() : array
    {
        return $this->data;
    }

    public function getIndex() : array
    {
        return $this->index;
    }

    public function setIndex(array $index)
    {
        $this->index = $index;
    }

    public function getDataByIndex()
    {
        $out = [];
        foreach ($this->index as $_i) {
            $out[] = $this->data[$_i];
        }
        return $out;
    }

    public function addStat($key, $value)
    {
        $this->stat[$key] += $value;
    }

    public function getStat($key)
    {
        return $this->stat[$key];
    }
}