<?php

namespace UKMNorge\Design\Position;

class Vertical {

    var $align;
    static $valid_string = ['top','center','bottom'];
    static $valid_units = ['%','px','em','rem'];

    /**
     * Opprett ny vertical-alignment
     *
     * @param string alignment string or valid numeric unit
     */
    public function __construct( String $align='middle') {
        $is_string = in_array(
            $align, 
            static::$valid_string
        );
        $is_numeric = is_numeric(
            trim(
                str_replace(
                    static::$valid_units,
                    '',
                    $align
                )
            )
        );

        if( !$is_string && !$is_numeric ) {
            throw new Exception(
                'Beklager, banner støtter ikke vertikal-posisjon '. $align
            );
        }

        $this->align = $align;
    }

    /**
     * Returner verdien når kastet til string
     *
     * @return string
     */
    public function __toString() {
        return $this->align;
    }
}