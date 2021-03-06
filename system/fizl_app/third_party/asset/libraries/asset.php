<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Asset Plugin
 *
 * Create asset links.
 *
 * @package		Fizl
 * @author		Adam Fairholm (@adamfairholm)
 * @copyright	Copyright (c) 2011, 1bit
 * @license		http://1bitapps.com/fizl/license.html
 * @link		http://1bitapps.com/fizl
 */
class Asset extends Plugin {

	function __construct()
	{
		$this->CI = get_instance();
		
		$this->CI->load->helper('html');
	}

	// --------------------------------------------------------------------------
	
	/**
	 * Image link
	 */
	public function img()
	{
		$image_properties['src'] = $this->CI->config->item('base_url').
					$this->CI->config->item('asset_folder').
					'/img/'.$this->get_param('file');

		$properties = array('alt', 'id', 'class', 'width', 'height', 'title', 'rel');
		
		foreach($properties as $prop):
		
			if($this->get_param($prop) != ''):
			
				$image_properties[$prop] = $this->get_param($prop);
			
			endif;
		
		endforeach;

		return img($image_properties);
	}

	// --------------------------------------------------------------------------
	
	/**
	 * CSS link
	 */
	public function css()
	{
		$src = 		$this->CI->config->item('base_url').
					$this->CI->config->item('asset_folder').
					'/css/'.$this->get_param('file');

		return '<link rel="stylesheet" type="text/css" href="'.$src.'" />';
	}

	// --------------------------------------------------------------------------
	
	/**
	 * JS link
	 */
	public function js()
	{
		$src = 		$this->CI->config->item('base_url').
					$this->CI->config->item('asset_folder').
					'/js/'.$this->get_param('file');

		return '<script type="text/javascript" src="'.$src.'"></script>';
	}
	
}

/* End of file asset.php */