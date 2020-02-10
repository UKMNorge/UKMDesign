<?php

namespace UKMNorge\Design\TemplateEngine;

use UKMNorge\Twig\Definitions\Filters as FilterDefinitions;

class Filters extends FilterDefinitions
{
    public function telefon($number)
    {
        return substr($number, 0, 3) . ' ' . substr($number, 3, 2) . ' ' . substr($number, 5, 3);
    }
    
    public function maned($nr)
    {
        switch ($nr) {
            case 1:
            case '01':
                return 'jan';
            case 2:
            case '02':
                return 'feb';
            case 3:
            case '03':
                return 'mar';
            case 4:
            case '04':
                return 'apr';
            case 5:
            case '05':
                return 'mai';
            case 6:
            case '06':
                return 'jun';
            case 7:
            case '07':
                return 'jul';
            case 8:
            case '08':
                return 'aug';
            case 9:
            case '09':
                return 'sep';
            case 10:
                return 'okt';
            case 11:
                return 'nov';
            case 12:
                return 'des';
        }
        return $nr;
    }
}
