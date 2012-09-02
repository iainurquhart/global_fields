<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Global Fields for ExpressionEngine 2
 *
 * @package		ExpressionEngine
 * @subpackage	Modules
 * @category	Tab
 * @author    	Iain Urquhart <shout@iain.co.nz>
 * @copyright 	Copyright (c) 2012 Iain Urquhart
 * @license   	All Rights Reserved
*/
 
// ------------------------------------------------------------------------

/**
 * Global Fields Module Install/Update File
 */

class Global_fields_upd {
	
	public $version = '1.0';
	
	private $EE;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
	}

	function tabs()
	{			
		return array();	
	}
	
	// ----------------------------------------------------------------
	
	/**
	 * Installation Method
	 *
	 * @return 	boolean 	TRUE
	 */
	public function install()
	{
		$mod_data = array(
			'module_name'			=> 'global_fields',
			'module_version'		=> $this->version,
			'has_cp_backend'		=> "y",
			'has_publish_fields'	=> 'y'
		);
		
		$this->EE->db->insert('modules', $mod_data);
		
		$this->EE->load->library('layout');
		$this->EE->layout->add_layout_tabs($this->tabs());
		
		return TRUE;
	}

	// ----------------------------------------------------------------
	
	/**
	 * Uninstall
	 *
	 * @return 	boolean 	TRUE
	 */	
	public function uninstall()
	{
		$mod_id = $this->EE->db->select('module_id')
								->get_where('modules', array(
									'module_name'	=> 'Global_fields'
								))->row('module_id');
		
		$this->EE->db->where('module_id', $mod_id)
					 ->delete('module_member_groups');
		
		$this->EE->db->where('module_name', 'Global_fields')
					 ->delete('modules');
		
		$this->EE->load->library('layout');
		$this->EE->layout->delete_layout_tabs($this->tabs(), 'global_fields');
		
		return TRUE;
	}
	
	// ----------------------------------------------------------------
	
	/**
	 * Module Updater
	 *
	 * @return 	boolean 	TRUE
	 */	
	public function update($current = '')
	{
		// If you have updates, drop 'em in here.
		return TRUE;
	}
	
}
/* End of file upd.global_fields.php */
/* Location: /system/expressionengine/third_party/global_fields/upd.global_fields.php */