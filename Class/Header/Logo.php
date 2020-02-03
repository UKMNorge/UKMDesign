<?php

namespace UKMNorge\Design\Header;

use UKMNorge\Design\Image;
use UKMNorge\Design\UKMDesign;

class Logo extends Image
{
    var $visible = true;

    public function show() {
        $this->visible = true;
    }
    public function hide() {
        $this->visible = false;
    }
    public function visible() {
        return $this->visible;
    }
    public function hidden() {
        return !$this->visible;
    }    

    /**
     * Get the primary color logo of UKM (defined in config)
     *
     * @return Logo
     */
    public static function getPrimary()
    {
        return new Logo(
            UKMDesign::getConfig('logoer.ukm.utgaver.primar.url')
        );
    }

    /**
     * Get the secondary color logo of UKM (defined in config)
     *
     * @return Logo
     */
    public static function getSecondary()
    {
        return new Logo(
            UKMDesign::getConfig('logoer.ukm.utgaver.sekundar.url')
        );
    }

    /**
     * Get the special color logo of UKM (defined in config)
     *
     * @return Logo
     */
    public static function getSpecial()
    {
        return new Logo(
            UKMDesign::getConfig('logoer.ukm.utgaver.spesial.url')
        );
    }

    /**
     * Get the primary color logo of UKM Media
     *
     * @return Logo
     */
    public static function getMediaPrimary()
    {
        return new Logo(
            UKMDesign::getConfig('logoer.ukmmedia.utgaver.primar.url')
        );
    }

    /**
     * Get the secondary color logo of UKM Media
     *
     * @return Logo
     */
    public static function getMediaSecondary()
    {
        return new Logo(
            UKMDesign::getConfig('logoer.ukmmedia.utgaver.sekundar.url')
        );
    }
}