<?php

    namespace App\Entity;

    class Category{
        private int $id;
        private string $name; 
        private string $description;
        private int $course_count;

        public function __construct($name,$description,$id=NULL,$course_count=0)
        {
            $this->id = $id; 
            $this->name = $name; 
            $this->description = $description;
            $this->course_count = $course_count;
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
    