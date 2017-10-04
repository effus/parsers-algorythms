<?php
namespace effus\parsers;

use \effus\runner\ParserRunnerResults;

/**
 * Find all Youtube links like "/watch?v=8hP6WROycAU" by regexp and sort it by QS algorithm
 * 
 * @authors effus
 * @date    2017-10-04 00:37:44
 * @version ${1.0.0}
 */
class QuickSort implements InterfaceParser {

    public function process(string $data):ParserRunnerResults {
        $out = new ParserRunnerResults();
        $links = $this->getAllYoutubeLinks($data);
        $out->setData($this->qs($links));
        return $out;
    }

    private function getAllYoutubeLinks($data) {
        $a1 = preg_match_all('/\/watch\?v\=([A-z0-9\_\-]{11})/ui',$data,$matches1);
        $a2 = preg_match_all('/\"videoId\"\:\"([A-z0-9\_\-]{11})\"/ui',$data,$matches2);
        return $matches1[1] + $matches2[1];
    }

    private function qs($arr) {
        if (!count($arr)) {
            return [];
        }
        $rand = rand(0,count($arr)-1);
        
    }

    private function qsr($items,) {

    }

    private function compareStrings($str1,$str2) {
        $_n1 = $this->str2Num($str1);
        $_n2 = $this->str2Num($str2);
        return $_n1 > $_n2 ? -1 : ($_n1 < $_n2 ? 1 : 0);
    }

    private function str2Num($str) {
        $out = 0;
        for($i=0;$i<strlen($str);$i++){
            $out+=ord($str[$i]);
        }
        return $out;
    }
}