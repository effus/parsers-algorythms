<?php
namespace effus\algorithms;

/**
 * Algorithm Interface
 */
interface InterfaceAlgorithm
{
  public function process(array $data) : array;
}