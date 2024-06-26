<?php
/**
 * C1 Partners - WordPress Helper Functions
 * ------------------------------------------
 */

/*
 * Contents
 * - compiledAsset
 * - assetUrl
 * - urlSegments
 * - urlFull
 * - strContains
 * - formatPhone
 * - formatUrl
 * - formatSlug
 * - getPostBySlug
 * - imageAlt
 * - generateVideoEmbedUrl
 * - isEven
 */

class c1Helpers {

    /**
     * @param string $filename
     * @return string
     *
     * Compiled Asset
     * --------------
     * Returns the file path to the correct revision of the stylesheet or script file
     */
    public function compiledAsset($filename) {
        // Get the mix manifest file
        $manifest_path = $this->assetUrl('mix-manifest.json', false);

        // Make sure the mix manifest file exists, otherwise provide an empty array for the next check
        $manifest = (file_exists($manifest_path)) ? json_decode(file_get_contents($manifest_path), true) : array();

        // Return either the original/base stylesheet/script file or the versioned file provided by the manifest if it exists
        return (@array_key_exists($filename, $manifest)) ? $this->assetUrl($manifest[$filename]) : $this->assetUrl($filename);
    }



    /**
     * @param string $path
     * @param bool $withDomain
     * @return string
     *
     * Asset Url
     * ---------
     * Returns the full file path of a file within the asset directory, based on the provided relative path within the asset directory
     */
    public function assetUrl($path, $withDomain = true) {
        // Remove the /assets/ part if it was included in the provided path
        $path = str_replace('assets/', '', $path);

        // Make sure the urls coming in start consistently with no leading slash
        $path = ltrim($path, '/');

        // Append the path to the stylesheet (theme) directory with a slash in between
        $path = get_bloginfo('stylesheet_directory') . '/assets/' . $path;

        // Be default we will keep the domain at the beginning, but when needed, it can be removed for a path relative to the root directory
        if(!$withDomain) {
            // Trim the home_url (base domain) from the path
            $path = ltrim(str_replace(home_url(), '', $path), '/');
        }

        // Return the full path
        return $path;
    }



    /**
     * @return array
     *
     * Url Segments
     * ------------
     * Returns an array of the current url in segments
     */
    public function urlSegments() {
        return explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    }



    /**
     * @param bool $withProtocol
     * @return string
     *
     * Url Full
     * --------
     * Returns the current full url with or without protocol
     */
    public function urlFull($withProtocol = true) {
        $urlStr = '';
        if($withProtocol) { $urlStr .= (isset($_SERVER['HTTPS'])) ? 'https:' : 'http:'; }
        return $urlStr . "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }



    /**
     * @param string $needle
     * @param string $haystack
     * @param bool $ignoreCase
     * @return bool
     *
     * Str Contains
     * ------------
     * Quick helper for checking if a string contains a given value
     */
    function strContains($needle, $haystack, $ignoreCase = false) {
        if($ignoreCase) {
            $needle = strtolower($needle);
            $haystack = strtolower($haystack);
        }
        return strpos($haystack, $needle) !== false;
    }



    /**
     * @param string $phone
     * @param array $characters
     * @return mixed
     *
     * Formats a given phone number for use in tel: links. Can provide custom set of characters to replace
     */
    public function formatPhone($phone, $characters = array('-', ':', '(', ')', ' ', '.')) {
        $phone = str_replace($characters, '', $phone);
        return $phone;
    }



    /**
     * @param $url
     * @param bool $checkProtocol
     * @param bool $useSiteProtocol
     * @param string $protocol
     * @return string
     *
     * Format Url
     * ----------
     * Formats a given url with a protocol if not provided, able to set it to use whatever the site is using, or declare
     * a specific protocol to use. Helpful for Client provided links in the backend, or with uncontrolled api data that does
     * not contain proper protocols in their links
     */
    public function formatUrl($url, $checkProtocol = false, $useSiteProtocol = false, $protocol = 'http') {
        $parsed = parse_url($url);

        if($checkProtocol) {
            if($useSiteProtocol) {
                $protocol = (isset($_SERVER['HTTPS'])) ? 'https' : 'http';
            }

            if(empty($parsed['scheme'])) {
                return $protocol . '://' . ltrim($url, '/');
            } else {
                if($protocol === "http") {
                    return str_replace('https', 'http', $url);
                } elseif ($protocol === "https") {
                    return str_replace('http', 'https', $url);
                }
            }
        }

        return (empty($parsed['scheme'])) ? $protocol . '://' . ltrim($url, '/') : $url;
    }



    /**
     * @param string $string
     * @return null|string|string[]
     *
     * Format Slug
     * -----------
     * Generates a slug out of the provided string
     */
    public function formatSlug($string)
    {
        // replace non letter or digits by -
        $string = preg_replace('~[^\pL\d]+~u', '-', $string);
        // transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        // remove unwanted characters
        $string = preg_replace('~[^-\w]+~', '', $string);
        // trim
        $string = trim($string, '-');
        // remove duplicate -
        $string = preg_replace('~-+~', '-', $string);
        // lowercase
        $string = strtolower($string);
        if (empty($string)) {
            return 'n-a';
        }
        return $string;
    }



    /**
     * @param string $slug
     * @param string $postType
     * @return bool|object
     *
     * Format Slug
     * -----------
     * Provides the Post Object based on the provided slug, or returns false
     */
    public function getPostBySlug($slug, $postType = 'post'){
        $posts = get_posts(array(
            'name' => $slug,
            'posts_per_page' => 1,
            'post_type' => $postType,
            'post_status' => 'publish'
        ));

        if(count($posts) == 0) return false;

        return $posts[0];
    }



    /**
     * @param object $image
     * @param string $fallback
     * @return string
     *
     * Image Alt
     * -----------
     * Returns the alt attached to the image object, or falls back to the provided fallback variable
     */
    public function imageAlt($image, $fallback = "") {

        if(empty($image)) return $fallback;

        if(empty($image['alt'])) return $fallback;

        return $image['alt'];

    }



    /**
     * @param string $url
     * @return string
     *
     * Generate Video Embed Url
     * -----------
     * Takes a provided video url (the actual page url, not an already gather embed code) and formats it to be an embed url for an iframe
     */
    public function generateVideoEmbedUrl($url) {
        //This is a general function for generating an embed link of an FB/Vimeo/Youtube Video.
        $finalUrl = '';
        if (strpos($url, 'facebook.com/') !== false) {
            //it is FB video
            $finalUrl .= 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($url) . '&show_text=1&width=200';
        } else if (strpos($url, 'vimeo.com/') !== false) {
            //it is Vimeo video
            $videoId = explode("vimeo.com/", $url)[1];
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&", $videoId)[0];
            }
            $finalUrl .= 'https://player.vimeo.com/video/' . $videoId;
        } else if (strpos($url, 'youtube.com/') !== false) {
            //it is Youtube video
            $videoId = explode("v=", $url)[1];
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&", $videoId)[0];
            }
            $finalUrl .= 'https://www.youtube.com/embed/' . $videoId;
        } else if (strpos($url, 'youtu.be/') !== false) {
            //it is Youtube video
            $videoId = explode("youtu.be/", $url)[1];
            if (strpos($videoId, '&') !== false) {
                $videoId = explode("&", $videoId)[0];
            }
            $finalUrl .= 'https://www.youtube.com/embed/' . $videoId;
        } else {
            //Enter valid video URL
        }
        return $finalUrl;
    }



    /**
     * @param integer $number
     * @return boolean
     *
     * Is Even
     * -----------
     * Checks whether a provided integer is even or not
     */
    public function isEven($number) {
        return ($number % 2) === 0;
    }


    /**
     * @param integer $number
     * @return boolean
     * @return object
     *
     * Media Object
     * -----------
     * ...
     */
    public function mediaObject($id, $piecesToDisplay = array('caption', 'alt', 'title'))
    {
        if(empty($id)) return false;
        // TODO: Decide if splitting to 2 functions for Array/ID input
    }

    public function mediaParam($id, $param)
    {
        if(empty($param)) return false;

        // TODO: return specified parameter based on the image id
    }

}

$c1Helpers = new c1Helpers();
