<?php

namespace UKMNorge\Design\Header;

use DateTime;
use UKMNorge\Design\Image;

class SEO
{
    public $canonical;
    public $description;
    public $author;
    public $site_name;
    public $type;
    public $title;
    public $section;
    public $image;
    public $published;

    public $fb_admins;
    public $fb_app_id;

    public $google_site_verification;
    public $google_analytics;

    public $oembed = false;

    /**
     * Get canonical URL
     *
     * @return String
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * Set canonical URL
     *
     * @param String $canonical
     * @return self
     */
    public function setCanonical(String $canonical)
    {
        $this->canonical = $canonical;
        return $this;
    }

    /**
     * Set canonical URL
     * 
     * @see setCanonical
     *
     * @param String $url
     * @return self
     */
    public function setUrl(String $url ) {
        return $this->setCanonical($url);
    }

    /**
     * Get page description
     *
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set page description
     *
     * @param String $description
     * @return self
     */
    public function setDescription(String $description)
    {
        $this->description = str_replace(["\r", "\n"], "", strip_tags($description));
        return $this;
    }

    /**
     * Get page author
     *
     * @return self
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set page author
     *
     * @param String $author
     * @return self
     */
    public function setAuthor(String $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get website name
     *
     * @return String
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * Set website name
     *
     * @param String $site_name
     * @return self
     */
    public function setSiteName(String $site_name)
    {
        $this->site_name = $site_name;
        return $this;
    }

    /**
     * Get page type
     *
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set page type
     *
     * @param String $type
     * @return self
     */
    public function setType(String $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get page title
     *
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set page title
     *
     * @param String $title
     * @return self
     */
    public function setTitle(String $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get website section title
     *
     * @return String
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set website section title
     *
     * @param String section
     * @return self
     */
    public function setSection(String $section)
    {
        $this->section = $section;
        return $this;
    }

    /**
     * Get page image
     *
     * @return Image
     */
    public function getImage()
    {
        if( is_null($this->image)) {
            $this->image = new Image('');
        }
        return $this->image;
    }

    /**
     * Set page image
     *
     * @param Image $image
     * @return self
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get date published
     *
     * @return DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set date published
     *
     * @param DateTime $published
     * @return self
     */
    public function setPublished(DateTime $published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * Get Facebook admin IDs
     *
     * @return String
     */
    public function getFBAdmins()
    {
        return $this->fb_admins;
    }

    /**
     * Set Facebook admin IDs
     *
     * @param [type] $fb_admin_ids
     * @return self
     */
    public function setFBAdmins(String $fb_admin_ids)
    {
        $this->fb_admins = $fb_admin_ids;
        return $this;
    }

    /**
     * Get Facebook app ID
     *
     * @return String
     */
    public function getFBAppId()
    {
        return $this->fb_app_id;
    }

    /**
     * Set Facebook app ID
     *
     * @param String $fb_app_id
     * @return self
     */
    public function setFBAppId(String $fb_app_id)
    {
        $this->fb_app_id = $fb_app_id;
        return $this;
    }

    /**
     * Get the Google Site Verification ID
     *
     * @return String
     */
    public function getGoogleSiteVerification()
    {
        return $this->google_site_verification;
    }

    /**
     * Set the Google Site Verification ID
     *
     * @param String $site_verification_id
     * @return self
     */
    public function setGoogleSiteVerification(String $site_verification_id)
    {
        $this->google_site_verification = $site_verification_id;
        return $this;
    }

    /**
     * Get the Google Analytics ID
     *
     * @return String
     */
    public function getGoogleAnalytics()
    {
        return $this->google_analytics;
    }

    /**
     * Set Google Analytics ID
     *
     * @param String $analytics
     * @return self
     */
    public function setGoogleAnalytics(String $analytics)
    {
        $this->google_analytics = $analytics;
        return $this;
    }

    /**
     * Get the oEmbed URL for this page
     *
     * @return String url
     */
    public function getOembed()
    {
        return $this->oembed;
    }

    /**
     * Set the oEmbed URL for this page
     *
     * @param String $oembed
     * @return self
     */
    public function setOembed(String $oembed)
    {
        $this->oembed = $oembed;
        return $this;
    }
}
