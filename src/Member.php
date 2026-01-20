<?php
declare(strict_types=1);

abstract class Member{
    private $name;
    private $memberId;
    
    public function __construct($name,$memberId){
        $this->name=$name;
        $this->memberId=$memberId;
    }

    public function getName(){
        return $this->name;
    }

    public function getMemberId(){
        return $this->memberId;
    }

    abstract public function getType();

    public function getInfo(){
        return "Member: {$this->getName()} ID: ({$this->getMemberId()}) Member Type:[{$this->getType()}]";
    }

}




