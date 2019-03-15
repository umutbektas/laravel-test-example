<?php
/**
 * Created by PhpStorm.
 * User: umutb
 * Date: 14/03/2019
 * Time: 23:24
 */

namespace App\TestExample;


class Product
{
    protected $name;
    protected $cost;


    public function __construct($name, $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function name () {
        return $this->name;
    }

    public function cost()
    {
        return $this->cost;
    }
}