<?php

namespace UKMNorge\Design;

class Image
{
    public $url = '';
    public $width;
    public $height;
    public $type;

    /**
     * Create a new image
     *
     * @param String $url
     * @param Int $width
     * @param Int $height
     * @param String $type
     */
    public function __construct(String $url, Int $width = null, Int $height = null, String $type = null)
    {
        $this->url = $url;
        if ($width !== null && $height !== null) {
            $this->width = $width;
            $this->height = $height;
        }
        if ($type !== null) {
            $this->type = $type;
        }
    }

    /**
     * Get the type of image
     * 
     * @todo If is_null($this->type) return mime-type from file
     *
     * @return String mime-type
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Set the image mime-type
     *
     * @param String $type
     * @return self
     */
    public function setType(String $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the image URL
     *
     * @return String URL
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Set the image Url
     *
     * @param String $url
     * @return self
     */
    public function setUrl(String $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the image width
     * 
     * Potentially incorrect as we accept width
     * as a constructor parameter
     *
     * @return Int width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get the image height
     *
     * Potentially incorrect as we accept height
     * as a constructor parameter
     * 
     * @return Int height
     */
    public function getHeight()
    {
        return $this->height;
    }

    public function __toString() {
        return $this->getUrl();
    }
}
