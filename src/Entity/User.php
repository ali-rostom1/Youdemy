<?php

    namespace App\Entity;

    class User{

        private $id; 
        private $username; 
        private $password; 
        private $email; 
        private $role; 
        private $status;

        public function __construct($id,$username,$password,$email,$role,$status)
        {
            $this->id = $id; 
            $this->username = $username; 
            $this->password = $password;
            $this->email = $email; 
            $this->role = $role; 
            $this->status = $status;
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
