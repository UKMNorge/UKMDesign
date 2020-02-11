<?php

namespace UKMNorge\Design\TemplateEngine;

use UKMNorge\Twig\Definitions\Functions as FunctionDefinitions;

class Functions extends FunctionDefinitions {

    public function UKMasset($path)
	{
		if ( defined('UKM_HOSTNAME') && UKM_HOSTNAME == 'ukm.dev' ) {
			return '//ukm.dev/wp-content/themes/UKMDesign/_GRAFIKK_UKM_NO/'. $path;
		}
		return '//grafikk.ukm.no/UKMresponsive/'. $path;
	}
}