<?php

namespace UKMNorge\Design\Menu;

class MailLink extends Link
{
    /**
     * Create a new mailto-link 
     *
     * @param String $title
     * @param String $mailto
     * @param String $target
     */
    public function __construct(String $title, String $mailto, String $target = null)
    {
        parent::__construct(
            $title,
            'mailto:' . $mailto,
            $target
        );
    }
}
