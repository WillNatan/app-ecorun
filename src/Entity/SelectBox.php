<?php

namespace App\Entity;

class SelectBox
{
    public $items = array();

    public function addItem($name){
        $this->items[]= $name;
        return $this;
    }
}