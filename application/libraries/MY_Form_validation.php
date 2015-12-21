<?php
class MY_Form_validation extends CI_Form_validation{
/**
     * Validation callback, allows international text
     *
     * @param    string
     * @return    bool
     */    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }
    function alpha_utf8($str)
    {
        $str = (strtolower($this->CI->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

        return ( ! preg_match("/^[[:alpha:]- ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß_.]+$/i", $str)) ? FALSE : TRUE;
    }
    function alpha_numeric_utf8($str)
    {
        $str = (strtolower($this->CI->config->item('charset')) != 'utf-8') ? utf8_encode($str) : $str;

        return ( ! preg_match("/^[[:alnum:]- ÀÁÂÃÄÅĀĄĂÆÇĆČĈĊĎĐÈÉÊËĒĘĚĔĖĜĞĠĢĤĦÌÍÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓÔÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚÛÜŪŮŰŬŨŲŴÝŶŸŹŽŻàáâãäåæçèéêëìíîïñòóôõöøùúûüýÿœšß_.]+$/i", $str)) ? FALSE : TRUE;
    }
    function isRun($str){
        return ( ! preg_match("/^(\d{1,3}\.)?(\d{3}\.)?\d{3}[-][0-9kK]{1}$/i", $str)) ? FALSE : TRUE;
    }
    function valid_date($str){
         return ( ! preg_match("/^(19|20)\d\d[- \/.](0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])$/i",$str)) ? FALSE : TRUE;
    }
    function valid_time($str){
         return ( ! preg_match("/^([0-1]?[0-9]|[2][0-3]):([0-5][0-9])(:[0-5][0-9])?$/i",$str)) ? FALSE : TRUE;
    }
    function xss_clean($str){
        return get_instance()->security->xss_clean($str, FALSE);
    }
    // --------------------------------------------------------------------

    /**
     * Match one field to another
     *
     * @access  public
     * @param   string
     * @param   field
     * @return  bool
     */
    public function if_exists($str, $field)
    {
        list($table, $field)=explode('.', $field);
        $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
        
        return $query->num_rows() === 1;
    }
    /**
     * Match one field to another
     *
     * @access  public
     * @param   string
     * @param   field
     * @return  bool
     */
    public function is_unique2($str, $field)
    {
        list($table, $field)=explode('.', $field);
        $query = $this->CI->db->limit(1)->where('OSESTADO',1)->get_where($table, array($field => $str));
        
        return $query->num_rows() === 0;
    }
}
/*FIN DE VALIDACIONES PROPIAS*/