<?php

namespace UKMNorge\Design\Sitemap;

use Symfony\Component\Yaml\Yaml;

class Sitemap
{

    static $configPath;
    static $config = [];
    static $sections = [];

    /**
     * Set a new yaml file path for siteMap
     *
     * @param String $yaml_file_path
     */
    public function __construct(String $yaml_file_path)
    {
        static::$configPath = $yaml_file_path;
    }

    /**
     * Load the config from a Yaml-file
     *
     * @param String $filepath
     * @return void
     */
    public static function loadFromYamlfile()
    {
        self::$config = Yaml::parse(file_get_contents(static::$configPath));

        foreach (self::$config as $key => $val) {
            self::addSection(new Section($key, $val['url'], $val['title'], $val));
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
        foreach (self::$sections as $order => $section) {
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
        if (!self::getSection($section->getId())) {
            self::$sections[] = $section;
        }
        return sizeof(self::$sections);
    }

    /**
     * Get array of all Sections
     *
     * @return Array<Section>
     */
    public static function getSections()
    {
        return self::$sections;
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
        $section = self::getSection($sectionId);
        if (is_object($section)) {
            if (null == $pageId) {
                return $section->getUrl();
            }
            return $section->getPage($pageId);
        }
    }
}
