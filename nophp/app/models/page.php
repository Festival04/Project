<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

// JSON encode uses the getters defined for this class
class Page {
    public id;
    public title;
    public content;
    public author;
    public visibility;
    public datetime;

    public function __construct($_id, $_author, $_title, $_content, $_visibility, $_datetime) 
    {
        $this->id = $_id;
        $this->title = $_title;
        $this->content = $_content;
        $this->author = $_author;
        $this->visibility = $_visibility;
        $this->datetime = $_datetime;
    }

    public function getID() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getContent() {
        return $this->content;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getVisibility() {
        return $this->visibility;
    }
    public function getDateTime() {
        return $this->datetime;
    }
}

?>