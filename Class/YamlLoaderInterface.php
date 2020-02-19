<?php

namespace UKMNorge\Design;

use Exception;

interface YamlLoaderInterface
{

    public function hasCachedYaml();
    public function getCachedYaml();
    public function getInstallYaml();

    public function setFilename(String $filename);
    public function getFilename();
}