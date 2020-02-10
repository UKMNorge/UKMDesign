<?php

namespace UKMNorge\Design\Blocks;


class Text extends Block
{
    const ALIGN = 'left';
    const TEMPLATE = 'Text';

    public function __construct(Int $id, String $content)
    {
        parent::__construct($id);
        $this->content = $content;   
    }
}
