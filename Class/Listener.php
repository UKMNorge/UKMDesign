<?php

namespace UKMNorge\Design;

class Listener {

    private $listeners = [];

    public function listen( $event, $callback ) {
        return $this->on($event, $callback);
    }
    
    public function on( $event, $callback ) {
        $this->listeners[$event][] = $callback;
        return $this;
    }

    public function trigger( $event, $data ) {
        if( is_array( $this->listeners[$event] ) ) {
            foreach( $this->listeners[$event] as $listener ) {
                if( is_array( $listener ) ) {
                    $object = $listener[0];
                    $function = $listener[1];
                    $object->$function($data);
                } else {
                    $listener($data);
                }
            }
        }
        return $this;
    }
}