<?php

namespace UKMNorge\Design\Sitemap;

use Exception;
use UKMNorge\Arrangement\Arrangement;
use UKMNorge\Geografi\Fylke;
use UKMNorge\Geografi\Kommune;

class Breadcrumbs
{
    static $sections = [];
    static $page;

    /**
     * Add a section
     *
     * @param Section $section
     * @return Section
     */
    public static function addSection(Section $section): Section
    {
        static::$sections[] = $section;
        return $section;
    }

    /**
     * Add fylke section
     *
     * @param Fylke $fylke
     * @return Section
     */
    public static function addFylke(Fylke $fylke): Section
    {
        return static::addSection(
            new Section(
                'fylke_' . $fylke->getId(),
                $fylke->getLink(),
                $fylke->getNavn()
            )
        );
    }

    /**
     * Add kommune section
     *
     * @param Kommune $kommune
     * @return Section
     */
    public static function addKommune(Kommune $kommune): Section
    {
        static::addFylke($kommune->getFylke());
        return static::addSection(
            new Section(
                'fylke_' . $kommune->getId(),
                $kommune->getLink(),
                $kommune->getNavn()
            )
        );
    }

    /**
     * Add arrangement section
     *
     * @param Arrangement $arrangement
     * @return Section
     */
    public static function addArrangement(Arrangement $arrangement): Section
    {
        if ($arrangement->getType() == 'fylke') {
            static::addFylke($arrangement->getFylke());
        }
        if ($arrangement->getType() == 'kommune') {
            static::addKommune($arrangement->getKommuner()->getAll()[0]);
        }
        return static::addSection(
            new Section(
                'arr_' . $arrangement->getId(),
                $arrangement->getLink(),
                $arrangement->getNavn()
            )
        );
    }

    /**
     * Set current page
     *
     * @param Page $page
     * @return Page
     */
    public static function setPage(Page $page): Page
    {
        static::$page = $page;
        return static::$page;
    }

    /**
     * Get all sections
     *
     * @return Array<Section>
     */
    public static function getSections(): array
    {
        return static::$sections;
    }

    /**
     * Get current page
     *
     * @return Page
     */
    public static function getPage()
    {
        return static::$page;
    }

    /**
     * Get section with given ID
     *
     * @param String $id
     * @return Section
     */
    public static function getSection(String $id): Section
    {
        foreach (static::getSections() as $section) {
            if ($section->getId() == $id) {
                return $section;
            }
        }
        throw new Exception(
            'Fant ikke section med id ' . $id
        );
    }

    /**
     * Get the last section
     *
     * @return Section
     */
    public static function getLastSection(): Section
    {
        if (sizeof(static::$sections) == 0) {
            return Sitemap::getSection('UKM');
        }
        return static::$sections[sizeof(static::$sections) - 1];
    }
}