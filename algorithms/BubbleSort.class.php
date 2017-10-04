<?php
namespace effus\algorithms;

/**
 * QuickSort Algorithm
 */
class BubbleSort implements InterfaceAlgorithm
{
    /**
     * make sort
     *
     * @param array $data
     * @return void
     */
    public function process(array $data) : array
    {
        if (!$data)
            throw new \Exception("No items for quicksort");
        \effus\outputStr("Start sorting");
        return $this->sort($data);
    }

    /**
     * Base algorithm implementation
     *
     * @param [type] $array
     * @return void
     */
    private function sort($array)
    {
        if (!$length = count($array)) {
            return $array;
        }
        for ($outer = 0; $outer < $length; $outer++) {
            for ($inner = 0; $inner < $length; $inner++) {
                if ($array[$outer] < $array[$inner]) {
                    $tmp = $array[$outer];
                    $array[$outer] = $array[$inner];
                    $array[$inner] = $tmp;
                }
            }
        }
        return $array;
    }

    private function arrToStringLine($arr)
    {
        return implode(' ', $arr);
    }
}