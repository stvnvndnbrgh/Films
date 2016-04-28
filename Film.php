<?php
//Film.php

class Film {
    private $id;
    private $titel;
    private $duurtijd;
    
    public function __construct($id, $titel, $duurtijd){
        $this->id = $id;
        $this->titel = $titel;
        $this->duurtijd = $duurtijd;
    }
    //getters
    public function getId(){
        return $this->id;
    }
    public function getTitel(){
        return $this->titel;
    }
    public function getDuurtijd(){
        return $this->duurtijd;
    }
    //setters
    public function setTitel($titel){
        $this->titel = $titel;
    }
    public function setDuurtijd($duurtijd){
        $this->duurtijd = $duurtijd;
    }
}

