<?php

    namespace App\Entity;

    class DocumentCourse extends Course{
        public function __construct($id, $title, $description,$content)
        {
            parent::__construct($id, $title, $description,"document",$content);
        }
        public function getContent()
        {
            return $this->content;
        }

    }