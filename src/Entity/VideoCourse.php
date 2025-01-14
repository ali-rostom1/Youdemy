<?php

    namespace App\Entity;


    class VideoCourse extends Course{
        public function __construct($id, $title, $description,$content,Category $category,User $teacher,$tags = [])
        {
            parent::__construct($id, $title, $description,"video",$content,$category,$teacher,$tags);
        }
        public function getContent()
        {
            return $this->content;
        }

    }