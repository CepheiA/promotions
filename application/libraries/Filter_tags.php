<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Filter_tags {
    
    function filter_tags()
    {
        $CI = & get_instance();
        log_message('Debug', 'filter tags class is loaded.');
    }
 
    function load($params=NULL,$params2=NULL)
    {
        include_once APPPATH.'/third_party/filter_tags/class.inputfilter.php';
         
        if ($params == NULL && $params2 == NULL)
        {
            $params= array('strike','strong','br','i','u','b','pre','li','ul','span','div');
            $params2 = array('align','style','class');
        }
        return new InputFilter($params,$params2);
    }
        function clean($params=NULL,$params2=NULL)
    {
        include_once APPPATH.'/third_party/filter_tags/class.inputfilter.php';
         
        if ($params == NULL && $params2 == NULL)
        {
            $params= array();
            $params2 = array();
        }
        return new InputFilter($params,$params2);
    }
}