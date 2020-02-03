<?php

namespace UKMNorge\Design;

use Symfony\Component\Yaml\Yaml;

class Config
{
    private static $configPath = false;
    private static $keys = [];
    private static $dotKeys = [];

    public function __construct(String $yaml_file_path)
    {
        static::$configPath = $yaml_file_path;
    }

    /**
     * Sett en config-value (non-persistent)
     *
     * @param String $key
     * @param Any $val
     * @return void
     */
    public static function set(String $key, $val)
    {
        self::$keys[$key] = $val;

        // Risky da det er utestet - men det burde jo funke sånn (ish)
        //static::arrayToDotKey($key, self::$keys[$key], self::$dotKeys);
    }

    /**
     * Hent en config-verdi
     *
     * @param String $key
     * @return Any verdi
     */
    public static function get($key)
    {
        if (isset(static::$keys[$key])) {
            return static::$keys[$key];
        }
        if (isset(static::$dotKeys[$key])) {
            return static::$dotKeys[$key];
        }
        return false;
    }

    /**
     * Hent alle config-verdier
     *
     * @return Array
     */
    public static function getAll()
    {
        return self::$keys;
    }

    /**
     * Last inn config fra Yaml-fil
     *
     * @return void
     */
    public static function loadFromYamlfile()
    {
        if (!self::$configPath) {
            throw new Exception('Missing basic config file path');
        }
        $parameters = Yaml::parse(file_get_contents(self::$configPath));
        self::$keys = $parameters['parameters'];
        static::arrayToDotKey('', self::$keys, self::$dotKeys);
        static::$dotKeys = static::arrayToDotKey('', self::$keys, []);
    }

    /**
     * Konverter array til key.subkey => val
     *
     * @param String $key_base
     * @param Array $config_array
     * @param Array $output
     * @return Array key.subkey => val
     */
    public static function arrayToDotKey(String $key_base, array $config_array, array $output)
    {
        foreach ($config_array as $key => $value) {
            if (is_array($value)) {
                $output = array_merge($output, static::arrayToDotKey($key_base . '.' . $key, $value, $output));
            } else {
                $output[trim($key_base . '.' . $key, '.')] = $value;
            }
        }
        return $output;
    }
}
