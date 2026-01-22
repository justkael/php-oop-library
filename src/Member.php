<?php
declare(strict_types=1);

abstract class Member{
    private $name;
    private $memberId;
    
    public function __construct($name){
        $this->name=$name;
    }

    //magic method
    public function __get($property){
        if (property_exists($this,$property)){
            return $this->$property;
        }
    }


    abstract public function getType();

}




