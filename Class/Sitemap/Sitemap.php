<?php

namespace UKMNorge\Design\Sitemap;

use Exception;
use Symfony\Component\Yaml\Yaml;
use UKMNorge\Design\YamlLoaderInterface;

class Sitemap
{
    const SITEMAPURL = 'https://raw.githubusercontent.com/UKMNorge/UKMDesign/master/Resources/config/sitemap.yml';

    static $sitemapPath;
    static $sitemap = [];
    static $sections = [];
    static $breadcrumbs;

    /**
     * Set a new yaml file path for siteMap
     *
     * @param String $yaml_file_path
     */
    public function __construct(YamlLoaderInterface $loader)
    {
        $loader->setFilename('sitemap.yml');

        try {
            if (!$loader->hasCachedYaml()) {
                throw new Exception('Har ikke cache');
            }
            static::$sitemap = $loader->getCachedYaml();
        } catch (Exception $e) {
            static::$sitemap = $loader->getInstallYaml();
        }

        foreach (static::$sitemap as $key => $val) {
            static::addSection(new Section($key, $val['url'], $val['title'], $val));
        }
    }

    /**
     * Hent et oppdatert sitemap fra github.com
     * 
     * OBS: skal aldri gjøres runtime, men må håndteres av en cronjobb!
     *
     * @param Int $timeout
     * @throws Exception hvis ting går galt
     * @return String Yaml
     */
    public function getUpdatedSitemapFromGithub(Int $timeout)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, static::SITEMAPURL);
        curl_setopt($curl, CURLOPT_REFERER, $_SERVER['PHP_SELF']);
        curl_setopt($curl, CURLOPT_USERAGENT, "UKMNorge API");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HEADER, 0);

        $result = curl_exec($curl);

        if (!empty($result)) {
            return $result;
        }
        throw new Exception('Kunne ikke hente data fra Github', 1);
    }

    /**
     * Loads a new Sitemap.yml from GitHub
     *
     */
    public static function loadFromGithub()
    {

        throw new Exception("loadFromGithub() not implemented");
    }

    /**
     * Load the sitemap from a Yaml-file
     *
     * @param String $filepath
     * @return void
     */
    public static function loadFromYamlfile()
    {
        throw new Exception("Sitemap::loadFromYamlfile() is deprecated, will try in constructor!");
        static::$sitemap = Yaml::parse(file_get_contents(static::$sitemapPath));

        foreach (static::$sitemap as $key => $val) {
            static::addSection(new Section($key, $val['url'], $val['title'], $val));
        }
    }

    /**
     * Get one Section by ID
     *
     * @param String $id
     * @return Section|false
     */
    public static function getSection(String $id)
    {
        foreach (static::$sections as $order => $section) {
            if (is_object($section) && $id == $section->getId()) {
                return $section;
            }
        }

        return false;
    }

    /**
     * Add one section to the stac
     *
     * Fancy feature: returns number of sections atm. Wonder why
     * 
     * @param Section $section
     * @return Int number of sections atm
     */
    public static function addSection(Section $section)
    {
        if (!static::getSection($section->getId())) {
            static::$sections[] = $section;
        }
        return sizeof(static::$sections);
    }

    /**
     * Get array of all Sections
     *
     * @return Array<Section>
     */
    public static function getSections()
    {
        return static::$sections;
    }

    /**
     * Get a breadcrumbs object
     * 
     * @return Breadcrumbs
     */
    public static function getBreadCrumbs()
    {
        if (is_null(static::$breadcrumbs)) {
            static::$breadcrumbs = new Breadcrumbs();
        }
        return static::$breadcrumbs;
    }

    /**
     * Get one specific page
     * 
     * Since the section might be a page, $pageId can be null
     *
     * @param String $sectionId
     * @param String $pageId
     * @return Page
     */
    public static function getPage($sectionId, $pageId = null)
    {
        $section = static::getSection($sectionId);
        if (is_object($section)) {
            if (null == $pageId) {
                return $section->getUrl();
            }
            return $section->getPage($pageId);
        }
    }
}