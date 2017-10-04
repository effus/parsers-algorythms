<?php
/**
 * Task: write shortest code to display diamond like this:
 * 
 *     *    
 *    ***   
 *   *****  
 *  ******* 
 * *********
 *  *******
 *   *****
 *    ***
 *     *
 * 
 * (9 rows with 9 chars each)
 */
 
 // My Version 1
 $x = [4,1];
 for($i=0;$i<9;$i++){
     echo ($x[0]?str_repeat(' ',$x[0]):'').str_repeat('*',$x[1]).($x[0]?str_repeat(' ',$x[0]):'').PHP_EOL;
     $x[0] += ($i<4)?-1:1;
     $x[1] += ($i<4)?2:-2;
 }
 
 // My Version 2
 $x = [1,3,5,7,9,7,5,3,1];
 $y = array_map(function($n){
     $half = round((9-$n)/2);
     return ($half?str_repeat(' ',$half):'') . (str_repeat('*',$n)) . ($half?str_repeat(' ',$half):'');
 },$x);
 echo implode(PHP_EOL,$y).PHP_EOL;