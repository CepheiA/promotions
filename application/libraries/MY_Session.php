<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Session extends CI_Session {
	
	/**
	 * sess_update()
	 *
	 * @access    public
	 * @return    void
	 */
	public function sess_update()
	{
		$CI =& get_instance();

		if ( ! $CI->input->is_ajax_request())
		{
			parent::sess_update();
		}
	}
	public function sess_destroy()
	{
// Do NOT update an existing session on AJAX calls.
		if (!$this->CI->input->is_ajax_request())
		{
			return parent::sess_destroy();
		}
		/* WHEN USER HIS/HER SELF DO A LOGOUT AND ALSO IF PROGRAMMER SET TO LOGOUT USING AJAX CALLS*/
		$firsturlseg = $this->CI->security->xss_clean( $this->CI->uri->segment(1) );        
		$securlseg = $this->CI->security->xss_clean( $this->CI->uri->segment(2) );      
		if((string)$firsturlseg==(string)'put ur controller name which u are using for login' &&    (string)$securlseg==(string)'put url controler function for logout')
		{
			return parent::sess_destroy();
		}
	}
}