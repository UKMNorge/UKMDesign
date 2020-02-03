<?php

namespace UKMNorge\Design\Sitemap;

class Pages
{
    var $pages = [];

    public function __construct(array $pages)
    {
        foreach ($pages as $id => $page) {
            $this->add(new Page($page));
        }
    }

    /**
     * Add a page to the stack
     *
     * @param Page $page
     * @return self
     */
    public function add(Page $page)
    {
        $this->pages[] = $page;
        return $this;
    }

    /**
     * Get array of all pages
     *
     * @return Array<Page>
     */
    public function getAll()
    {
        return $this->pages;
    }

    /**
     * Get one page from this collection
     *
     * @param String $id
     * @return Page|false
     */
    public function get(String $id)
    {
        foreach ($this->pages as $page) {
            if ($id == $page->getId()) {
                return $page;
            }
        }
        return false;
    }

    /**
     * Get one page from this collection
     * ALIAS: get()
     * 
     * @see get()
     *
     * @param String $id
     * @return Page|false
     */
    public function getPage(String $id)
    {
        return $this->get($id);
    }
}
