<?php

    namespace App\Entity;


    class VideoCourse extends Course{
        public function __construct($id, $title, $description,$content,Category $category,User $teacher,$tags = [])
        {
            parent::__construct($id, $title, $description,"video",$content,$category,$teacher,$tags);
        }
        public function getContent()
        {
            return $this->getYoutubeEmbed($this->content);
        }
        private function getYoutubeEmbed($url){
            $videoId = substr($url, strpos($url, 'v=') + 2, 11);
            return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
    }