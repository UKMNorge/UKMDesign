<?php

namespace UKMNorge\Design\Sitemap;

class Page
{
    var $id = null;
    var $url = null;
    var $title = null;
    var $description = null;
    var $target = false;

    /**
     * Create new page element
     *
     * @param Array $data
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->url = $data['url'];
        $this->title = $data['title'];
        if (isset($data['description'])) {
            $this->description = $data['description'];
        }
        if (isset($data['target'])) {
            $this->target = $data['target'];
        }
    }

    /**
     * Get the ID-string
     *
     * @return String id (from yaml)
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the full URL
     *
     * If you're in dev environment this automatically 
     * (thanks to Section::correctUrlHostname($this->url))
     * changes all ukm.no-references with ukm.dev
     * 
     * @return String
     */
    public function getUrl()
    {
        return Section::correctUrlHostname($this->url);
    }

    /**
     * Get the page title
     *
     * @return String title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the page description (if given)
     *
     * @return String|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the intended link target
     * 
     * Usually null (for same-page target), 
     * or "_blank" for new window target
     * 
     * @see getTargetProperty() before using this
     *
     * @return String|null
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Get the intended link target wrapped in `target="[...]"`
     *
     * @return String target="[...]"
     */
    public function getTargetProperty()
    {
        return $this->target == false ? '' : 'target="' . $this->target . '"';
    }

    /**
     * If you print the object, it'll give you the URL
     *
     * @return String $this->getUrl()
     */
    public function __toString()
    {
        return $this->getUrl();
    }
}
