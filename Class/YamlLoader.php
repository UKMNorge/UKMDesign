<?php

namespace UKMNorge\Design;

use Exception;
use Symfony\Component\Yaml\Yaml;

class YamlLoader implements YamlLoaderInterface
{
    private $install_path;
    private $cache_path;
    private $filename;

    private $content_cache;
    private $content_install;

    public function __construct(String $cache_path, String $install_path)
    {
        $this->cache_path = rtrim($cache_path, '/') . '/';
        $this->install_path = rtrim($install_path, '/') . '/';
    }

    /**
     * Sett filnavnet
     *
     * @param String $filename
     * @return self
     */
    public function setFilename(String $filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Hent filnavnet
     *
     * @return String
     */
    public function getFilename()
    {
        if (empty($this->filename)) {
            throw new Exception(
                'Tomt filnavn. Kjør setFilename(String) for å unngå denne feilmeldingen'
            );
        }
        return $this->filename;
    }

    /**
     * Finnes en cachet yaml-fil med gyldig data?
     *
     * @return boolean
     */
    public function hasCachedYaml()
    {
        if (!file_exists($this->cache_path . $this->getFilename())) {
            return false;
        }
        try {
            $this->getCachedYaml();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * Hent yaml fra cache-path
     *
     * @throws Exception
     * @return String yaml-data
     */
    public function getCachedYaml()
    {
        if (is_null($this->content_cache)) {
            $this->content_cache = $this->_readYaml($this->cache_path . $this->getFilename());
        }
        return $this->content_cache;
    }

    /**
     * Hent yaml fra install-path
     *
     * @throws Exception
     * @return String yaml-data
     */
    public function getInstallYaml()
    {
        if (is_null($this->content_install)) {
            $this->content_install = $this->_readYaml($this->install_path . $this->getFilename());
        }
        return $this->content_install;
    }

    /**
     * Faktisk les ut yaml-data 
     *
     * @param String $full_file_path
     * @throws Exception
     * @return String yaml
     */
    public function _readYaml(String $full_file_path)
    {
        $file_contents = @file_get_contents($full_file_path);
        if ($file_contents === false) {
            throw new Exception('Kunne ikke lese fil');
        }

        $yaml = static::parseYaml($file_contents);

        if ($yaml === false) {
            throw new Exception('Ugyldig Yaml i cache');
        }
        return $yaml;
    }

    /**
     * Gjør om yaml-innhold til array
     *
     * @param String $file_contents
     * @return Array
     */
    public static function parseYaml( String $file_contents ) {
        return Yaml::parse( $file_contents );
    }
}
