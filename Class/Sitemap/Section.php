<?php

namespace UKMNorge\Design\Sitemap;

class Section
{
    var $id = null;
    var $url = null;
    var $title = null;
    var $pages = null;

    /**
     * Create a new Section
     *
     * @param String $id
     * @param Array $data
     */
    public function __construct(String $id, String $url, String $title, Array $data=null)
    {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        if( !is_null($data)) {
            $this->color = (isset($data['color']) && !empty($data['color'])) ? $data['color'] : false;

            $this->pages = new Pages(
                isset($data['pages']) && is_array($data['pages'])
                    ? $data['pages']
                    : []
            );
        } else {
            $this->pages = new Pages([]);
        }
    }

    /**
     * Get Section ID-string
     *
     * @return String
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Section home page URL
     *
     * @return String URL
     */
    public function getUrl()
    {
        return static::correctUrlHostname($this->url);
    }


    /**
     * Set section title
     *
     * @param String $title
     * @return self
     */
    public function setTitle( String $title ) {
        $this->title = $title;
        return $this;
    }
    /**
     * Get section Title
     *
     * @return String title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get all pages of section
     *
     * @return Pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Get Section color
     *
     * @return String hexcode (/ possibler rgba?)
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get one page from Section
     *
     * @param String page ID
     * @return Page
     */
    public function getPage(String $id)
    {
        return $this->getPages()->getPage($id);
    }

    /**
     * Make sure we're all URLs point to right environment
     *
     * @param String $url
     * @return String $url
     */
    public static function correctUrlHostname(String $url)
    {
        if (defined('UKM_HOSTNAME') && UKM_HOSTNAME != 'ukm.no') {
            return str_replace(
                'ukm.no',
                UKM_HOSTNAME,
                $url
            );
        }
        return $url;
    }
}
