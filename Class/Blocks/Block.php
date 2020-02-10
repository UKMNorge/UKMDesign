<?php

namespace UKMNorge\Design\Blocks;

class Block {
    public $id;
    public $content;
    public $title;

    public function __construct( Int $id ) {
        $this->id = $id;
    }

    public function setId( String $id ) {
        $this->id = $id;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setContent(String $content) {
        $this->content = $content;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setTitle(String $title) {
        $this->title =$title;
        return $this;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getAlign()
    {
        return static::ALIGN;
    }

    public function getTemplate() {
        return static::TEMPLATE;
    }
}