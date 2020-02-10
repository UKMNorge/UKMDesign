<?php

namespace UKMNorge\Design\Blocks;

use UKMNorge\Design\Image as UKMDesignImage;

abstract class Image extends Block
{
    const TEMPLATE = 'Image';
    
    public $image;

    public function getAlign()
    {
        return static::ALIGN;
    }

    public function __construct(Int $id, UKMDesignImage $image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }
}
