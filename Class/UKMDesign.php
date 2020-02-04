<?php

namespace UKMNorge\Design;

use Exception;
use UKMNorge\Design\Header\Header;
use UKMNorge\Design\Sitemap\Sitemap;
use UKMNorge\Design\Sitemap\Page;
use UKMNorge\Design\Sitemap\Section;

/**
 * UKMDesign
 * 
 * Class-map for the design:
 * 
 * <HEAD>
 * Seo
 * 
 * <BODY> Visible design elements
 * Logo | Section | [Menubutton]
 * ---
 * Banner
 * --
 * Banner-bar
 * --
 * SiteMap (default display:none)
 * --
 * {% BLOCK CONTENT %}
 * --
 * Footer 
 */
class UKMDesign
{
    static $header;
    static $current_url;
    static $render_without_framework = false;
    static $site_url;
    static $ajax_url;
    static $current_color_scheme;
    static $sitemap;
    static $current_section;
    static $config;
    static $current_page;
    static $path;

    const SUPPORTED_COLOR_SCHEMES = ['default', 'cherry'];


    public static function init()
    {
        if (is_null(static::$config)) {
            static::$config = new Config(
                static::getConfigPath() . 'parameters.yml'
            );
            static::$config::loadFromYamlfile();
        }
        if (is_null(static::$sitemap)) {
            static::$sitemap = new Sitemap(
                static::getConfigPath() . 'sitemap.yml'
            );
            static::getSitemap()::loadFromYamlfile();
        }
    }

    /**
     * Get header
     *
     * @return Header
     */
    public static function getHeader()
    {
        if ( is_null(static::$header)) {
            static::$header = new Header();
        }
        return static::$header;
    }

    /**
     * Set new header
     *
     * @param Header $header
     * @return void
     */
    public static function setBanner(Header $header)
    {
        static::$header = $header;
    }

    /**
     * Hent config
     *
     * @param String config value key
     * @return mixed
     */
    public static function getConfig(String $key = null)
    {
        if (is_null(static::$config)) {
            throw new Exception(
                'UKMDesign feil satt opp. Mangler config. Kjør init'
            );
        }
        if (!is_null($key)) {
            return static::$config->get($key);
        }
        return static::$config;
    }

    /**
     * Set config object
     *
     * @param Config $config
     * @return void
     */
    public static function setConfig(Config $config)
    {
        static::$config = $config;
    }

    /**
     * Get path of the config folder
     *
     * @return String path
     */
    public static function getConfigPath()
    {
        return dirname(dirname(__FILE__)) . '/Resources/config/';
    }

    /**
     * Set the current site URL
     *
     * @param String $url
     * @return void
     */
    public static function setCurrentUrl(String $url)
    {
        static::$current_url = $url;
    }

    /**
     * Get the current site URL
     *
     * @return String $url
     */
    public static function getCurrentUrl()
    {
        return static::$current_url;
    }

    /**
     * Set the ajax endpoint url
     *
     * @param String $url
     * @return void
     */
    public static function setAjaxUrl(String $url)
    {
        static::$ajax_url = $url;
    }

    /**
     * Get the ajax endpoint url
     *
     * @return String $url
     */
    public static function getAjaxUrl()
    {
        return static::$ajax_url;
    }

    /**
     * When rendering, do it without the framework
     * 
     * Used as a sort of API, as you can copy the
     * outputted html into any other service (UKM-app, for instance)
     *
     * @return void
     */
    public static function setRenderWithoutFramework()
    {
        static::$render_without_framework = true;
    }

    /**
     * Should this be rendered without framework?
     *
     * @return Bool
     */
    public static function doRenderWithoutFramework()
    {
        return static::$render_without_framework;
    }

    /**
     * Set current color scheme
     *
     * @param String $scheme
     * @return void
     */
    public static function setColorScheme(String $scheme)
    {
        if (in_array($scheme, static::SUPPORTED_COLOR_SCHEMES)) {
            static::$current_color_scheme = $scheme;
        }
    }

    /**
     * Get current colorScheme
     *
     * @return String $color_scheme
     */
    public static function getColorScheme()
    {
        if (static::$current_color_scheme == 'default') {
            return '';
        }
        return static::$current_color_scheme;
    }

    /**
     * Angi current page
     *
     * @param Page $page
     * @return void
     */
    public static function setCurrentPage(Page $page)
    {
        if (is_null(static::$current_page)) {
            throw new Exception(
                'UKMDesign feil satt opp. Current page er ikke satt'
            );
        }
        static::$current_page = $page;
        static::getHeader()::getSEO()
            ->setTitle( $page->getTitle() )
            ->setCanonical( $page->getUrl() );
    }

    /**
     * Hent aktiv page
     *
     * @return Page
     */
    public static function getCurrentPage()
    {
        return static::$current_page;
    }

    /**
     * Angi current section
     * 
     * Legges ikke til i sitemap, da det kan bygge en rar meny.
     * Men det er samme objektet da, så egenskapene er tilgjengelige.
     *
     * @param Section $section
     * @return void
     */
    public static function setCurrentSection(Section $section)
    {
        static::$current_section = $section;
        static::getHeader()::getSEO()
            ->setSection( $section->getTitle() );
    }

    /**
     * Hent aktiv section
     *
     * @return Section
     */
    public static function getCurrentSection()
    {
        if (is_null(static::$current_section)) {
            throw new Exception(
                'UKMDesign feil satt opp. Current section er ikke satt'
            );
        }
        return static::$current_section;
    }

    /**
     * Sett sitemap
     *
     * @param Sitemap $sitemap
     * @return void
     */
    public static function setSitemap(Sitemap $sitemap)
    {
        static::$sitemap = $sitemap;
    }

    /**
     * Hent sitemap
     *
     * @throws Exception hvis sitemap ikke er satt
     * @return Sitemap
     */
    public static function getSitemap()
    {
        if (is_null(static::$sitemap)) {
            throw new Exception(
                'UKMDesign feil satt opp. Sitemap ikke er initialisert.'
            );
        }
        return static::$sitemap;
    }

    /**
     * Get basepath of designbundle
     *
     * @return String $path
     */
    public static function getPath() {
        if( is_null(static::$path ) ) {
            static::$path = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        }
        return static::$path;
    }

    /**
     * Get view path of designbundle
     *
     * @return String path
     */
    public static function getViewPath() {
        return static::getPath() .'Resources/views/';
    }

    /**
     * Are we currently in the development environment?
     *
     * @return bool
     */
    public static function isDevEnv() {
        return defined('UKM_HOSTNAME') && UKM_HOSTNAME == 'ukm.dev';
    }

    /**
     * Set the site url 
     * 
     * (not current page, but main site / blog / whatever)
     *
     * @param String $site_url
     * @return void
     */
    public static function setSiteUrl( String $site_url ) {
        static::$site_url = $site_url;
    }

    /**
     * Get site URL
     *
     * @return void
     */
    public static function getSiteUrl() {
        return static::$site_url;
    }
}
