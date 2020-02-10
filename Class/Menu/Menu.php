<?php

namespace UKMNorge\Design\Menu;

class Menu
{
    private $links = [];

    /**
     * Add a link to the menu
     *
     * @param Link $link
     * @return void
     */
    public function add(Link $link)
    {
        $this->links[] = $link;
    }

    /**
     * Get all links
     *
     * @return void
     */
    public function getAll()
    {
        return $this->links;
    }

    /**
     * Does this menu have any links
     *
     * @return boolean
     */
    public function hasLinks()
    {
        return sizeof($this->getAll()) > 0;
    }
}
