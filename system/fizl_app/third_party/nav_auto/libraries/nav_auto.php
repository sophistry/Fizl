<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nav Plugin
 *
 * Automatically creates a nav list for you 
 * based on the file structure
 *
 * @package		Fizl
 * @author		sophistry (@)
 * @copyright	Copyright (c) 2011, fizl
 * @license		http://1bitapps.com/fizl/license.html
 * @link		http://1bitapps.com/fizl
 */
class Nav_auto extends Plugin {

	/**
	 * Generate the nav list automatically
	 * sort based on numbers in directory name
	 * format is numbers starting directory name 
	 * followed by underscore eg. 10_about, 20_contact
	 */
	public function nav_auto()
	{
		$this->CI = get_instance();
		// load file and html helpers
		$this->CI->load->helper('file');
		$this->CI->load->helper('html');
		// get files, dirs, and sub dirs
		$sf = $this->CI->config->item('site_folder');
		$files = get_filenames($sf,TRUE);
		// remove FCPATH and site_folder
		// also remove index.html and any .html
		// to prepare for using the site dirs as links
		$files = str_replace(array(FCPATH.$sf.'/','index.html','.html'),'',$files);		
		// use natsort so we don't have to use zero-padded numbers
		natsort($files);

		$links = '';
		foreach ($files as $f)
		{
			// strip the number and underscore used for sorting
			// from the start of the filename
			$f = preg_replace('/^[0-9]+_/','',$f);
			// make an anchor and break
			// this should probably be some kind of ul listing
			$link_label = ($f=='') ? 'Home' : ucfirst(trim($f,'/'));
			$links .= anchor($f,$link_label).br();
		}
		return $links;
	}
		
}

/* End of file nav_auto.php */