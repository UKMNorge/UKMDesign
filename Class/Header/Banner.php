<?php

namespace UKMNorge\Design\Header;

use UKMNorge\Design\Image;
use UKMNorge\Design\Position\Vertical;

class Banner extends Image
{
    var $url;
    var $pos_y = '50%';
    var $large;

    /**
     * Set vertical alignment / position
     *
     * @param Vertical $pos_y
     * @return void
     */
    public function setPosY(Vertical $pos_y)
    {
        $this->pos_y = $pos_y;
    }
    
    /**
     * Get vertical alignment
     *
     * @return Vertical alignment
     */
    public function getPosY()
    {
        return $this->pos_y;
    }

    /**
     * Set banner large edition
     *
     * @param Image $image
     * @return void
     */
    public function setLarge(Image $image)
    {
        $this->large = $image;
    }

    /**
     * Get banner large edition
     *
     * @return void
     */
    public function getLarge()
    {
        return $this->large;
    }

    /**
     * Does the banner has a large edition?
     *
     * @return boolean
     */
    public function hasLarge()
    {
        return !is_null($this->large);
    }

    /**
     * Get URL of large image (if exists)
     *
     * @return String
     */
    public function getLargeUrl()
    {
        if (!$this->hasLarge()) {
            return '';
        }
        return $this->getLarge()->getUrl();
    }

    /**
     * Get background-image and background-position string
     *
     * @return String
     */
    public function getBackgroundStyle()
    {
        return
            "background-image:url('" . $this->getUrl() . "'); " .
            "background-position: " . $this->getPosition() . ";";
    }

    /**
     * Get image position
     * 
     * Korrigerer bottom-alignment til 95%, på grunn av visuals..?
     *
     * @return String css position
     */
    public function getPosition()
    {
        return !is_null($this->pos_y) ?
            'center ' . ($this->getPosY()->__toString() == 'bottom'
                ? '95%'
                : $this->getPosY()->__toString()) : '0px 0px';
    }
}
