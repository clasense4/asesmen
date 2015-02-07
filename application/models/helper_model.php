<?php
class helper_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * Helper Class
     */
    function printr($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    /**
     * Helper Class
     */
    function vardump($array)
    {
        echo "<pre>";
        var_dump($array);
        echo "</pre>";
    }

    /**
     * Humanize, convert lower case to camel case
     * id_asesi = Id Asesi
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    function humanize($string)
    {

    }

    /**
     * Remove underscore from a string
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    function strip_underscore($string)
    {
        return str_replace("_", " ", $string);
    }
}
?>