<?php

namespace ParkBundle\Services;


/**
 * Class Calculator
 * @package ParkBundle\Services
 */
class Calculator
{

    /**
     * @params integer $a
     * @params integer $b
     * @return integer
     */
    public function sumInteger($a, $b)
    {
        return $a+$b;
    }
}
