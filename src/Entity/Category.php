<?php

    namespace App\Entity;

    class Category{
        private int $id;
        private string $name; 
        private string $description;

        public function __construct($id=NULL,$name,$description)
        {
            $this->id = $id; 
            $this->name = $name; 
            $this->description = $description;
        }
        public function __get($attr){
            if(property_exists($this,$attr)){
                return $this->$attr;
            }
        }
        public function __set($attr,$value){
            if(property_exists($this,$attr)){
                $this->$attr = $value;
            }
        }

    }
    