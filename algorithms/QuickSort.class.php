<?php
namespace effus\algorithms;

/**
 * QuickSort Algorithm
 */
class QuickSort implements InterfaceAlgorithm
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
        return $this->quickSort($data);
    }

    /**
     * Base algorithm implementation
     *
     * @param [type] $array
     * @return void
     */
    private function quickSort($array)
    {
        if (count($array) < 2)
            return $array;
        \effus\outputStr("Base items:\t" . $this->arrToStringLine($array));
        $low = array();
        $high = array();
        $length = count($array);
        $pivot = $array[0];
        for ($i = 1; $i < $length; $i++) {
            if ($array[$i] < $pivot) {
                $low[] = $array[$i];
            }
            else {
                $high[] = $array[$i];
            }
        }
        $merge = array_merge(
            self::quickSort($low),
            array($pivot),
            self::quickSort($high)
        );
        \effus\outputStr("Sorting:\t" . $this->arrToStringLine($merge));
        return $merge;
    }

    private function arrToStringLine($arr)
    {
        return implode(' ', $arr);
    }
}