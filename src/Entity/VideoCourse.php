<?php

    namespace App\Entity;


    class VideoCourse extends Course{
        public function __construct($id, $title, $description,$content)
        {
            parent::__construct($id, $title, $description,"video",$content);
        }
        public function getContent()
        {
            return $this->content;
        }

    }