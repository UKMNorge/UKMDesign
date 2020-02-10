<?php

namespace UKMNorge\Design\Blocks;

abstract class Blocks {
    
    public $blocks;

    abstract function load();

    public function hasBlocks() {
        return sizeof($this->getAll()) > 0;
    }

    public function getAll() {
        $this->blocks = [];
        if( is_null($this->blocks)) {
            $this->load();   
        }
        return $this->blocks;
    }

    public function add( Block $block ) {
        $this->blocks[] = $block;
    }
}