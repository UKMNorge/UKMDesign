<?php

namespace UKMNorge\Design\Header;

class Header
{
    static $banner;
    static $visible_section_title = true;
    static $slogan;
    static $button_background;
    static $logo;

    /**
     * Set banner
     *
     * @param Banner $banner
     * @return void
     */
    public static function setBanner(Banner $banner)
    {
        static::$banner = $banner;
    }

    /**
     * Get banner
     *
     * @return void
     */
    public static function getBanner()
    {
        return static::$banner;
    }

    /**
     * Does the header even have a banner?
     *
     * @return boolean
     */
    public static function hasBanner()
    {
        return !is_null(static::$banner);
    }

    /**
     * Hide section title
     *
     * @return void
     */
    public static function hideSectionTitle()
    {
        $this->visible_section_title = false;
    }
    /**
     * Show section title (default)
     *
     * @return void
     */
    public static function showSectionTitle()
    {
        $this->visible_section_title = true;
    }
    /**
     * Should section title be visible
     *
     * @return bool
     */
    public static function visibleSectionTitle()
    {
        return static::$visible_section_title;
    }

    /**
     * Get logo
     *
     * @return Logo
     */
    public static function getLogo()
    {
        if (is_null(static::$logo)) {
            // On top of a banner, white (secondary) usually fits best
            // #onesizeequivalent
            if (static::hasBanner()) {
                static::$logo = Logo::getSecondary();
            } else {
                static::$logo = Logo::getSpecial();
            }
        }
        return static::$logo;
    }

    /**
     * Get menu button css class
     *
     * @return String css class
     */
    public static function getButtonClass()
    {
        return static::hasBanner() ? 'light' : 'primary';
    }

    /**
     * Get menu button background style
     *
     * @return String css style attributes
     */
    public static function getButtonBackground()
    {
        return 'background: ' . static::$button_background;
    }

    /**
     * Set menu button background style
     *
     * @param String css style attributes
     * @return void
     */
    public static function setButtonBackground(String $button_background)
    {
        static::$button_background = $button_background;
    }
    
    /**
     * Set a section slogan
     *
     * @param String $slogan
     * @return void
     */
    public static function setSlogan( String $slogan ) {
        static::$slogan = $slogan;
    }

    /**
     * Get the section slogan
     *
     * @return void
     */
    public static function getSlogan() {
        return static::$slogan;
    }

    /**
     * Does the section have a slogan?
     *
     * @return boolean
     */
    public static function hasSlogan() {
        return !is_null(static::$slogan);
    }
}
