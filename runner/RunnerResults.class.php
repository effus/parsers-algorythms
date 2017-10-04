<?php
namespace effus\runner;

/**
 * Show Runner Results
 */
class RunnerResults
{

    private $data;
    private $stat = [
        'requests' => 0,
        'parsing' => 0,
        'algorithm' => 0,
        'memoryDiff' => 0
    ];

    /**
     * Output data from containers
     *
     * @return void
     */
    public function show()
    {
        \effus\outputStr("=== RUNNER RESULTS ===");
        print_r($this->data);
        \effus\outputStr("=== SOME STATs ===");
        print_r($this->stat);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setStat($key, $value)
    {
        $this->stat[$key] = $value;
    }

}