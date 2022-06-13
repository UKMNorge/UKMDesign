<?php

namespace UKMNorge\Design\Blocks;

class ListElement extends Block
{
    const TEMPLATE = 'ListElement';
    public $icon;
    public $redirectLenke;

    public function __construct(String $id, String $title, String $content)
    {
        parent::__construct($id);
        $this->setTitle($title);
        $this->setContent($content);
    }

    public function setIcon(String $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function setRedirectLenke(String $lenke)
    {
        $this->redirectLenke = $lenke;
        return $this;
    }
    
    public function getIcon()
    {
        return $this->icon;
    }
    public function hasIcon()
    {
        return !is_null($this->icon);
    }
}
