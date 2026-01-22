<?php
declare(strict_types=1);

abstract class Member{
    private $name;
    private $memberId;
    
    public function __construct($name,$memberId){
        $this->name=$name;
        $this->memberId=$memberId;
    }

    //magic method
    public function __get($property){
        if (property_exists($this,$property)){
            return $this->$property;
        }
    }


    abstract public function getType();

    public function getInfo(){
        return "Member: {$this->__get('name')} ID: ({$this->__get('memberId')}) Member Type:[{$this->getType()}]";
    }

}




