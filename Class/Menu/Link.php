<?php

namespace UKMNorge\Design\Menu;

class Link
{

    private $title;
    private $target;
    private $url;
    private $active = false;

    /**
     * Create a new link
     *
     * @param String $title
     * @param String $url
     * @param String $target
     */
    public function __construct(String $title, String $url, String $target = null)
    {
        $this->title = $title;
        $this->url = $url;
        $this->target = $target;
    }

    public function setActive() {
        $this->active = true;
    }

    public function isActive() {
        return $this->active;
    }

    /**
     * Get the title of the link (text of link)
     *
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the URL of the link 
     * 
     * mailto:-prefix is automatically added if you use the class
     * MailLink
     *
     * @return String link
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the link target
     *
     * @return String
     */
    public function getTarget()
    {
        return $this->hasTarget() ? $this->target : '';
    }

    /**
     * Is target-property specified?
     *
     * @return boolean
     */
    public function hasTarget()
    {
        return !is_null($this->target);
    }

    /**
     * Get HTML tag element
     *
     * @return String HTML
     */
    public function getTag()
    {
        return
            '<a href="' . $this->getUrl() . '" ' . (!is_null($this->getTarget()) ? 'target="' . $this->getTarget() . '" ' : '') .
            '>' .
            $this->getTitle() .
            '</a>';
    }

    /**
     * Set icon of link
     *
     * @param String $icon
     * @return self
     */
    public function setIcon(String $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get link icon
     *
     * @return String icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Is link icon specified
     *
     * @return boolean
     */
    public function hasIcon()
    {
        return !is_null($this->icon) && !empty($this->icon);
    }

    /**
     * toString gives tag
     * 
     * @see getTag()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTag();
    }
}