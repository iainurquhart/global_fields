<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
 * Tab Builder
 */

class Global_fields_tab {

	// our array of field ids, set in config
	var $field_ids = array();
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();

		$this->EE->lang->loadfile('global_fields');
		if( $this->EE->config->item('global_fields_tab_name') ) 
		{
			$this->EE->lang->language['global_fields'] = $this->EE->config->item('global_fields_tab_name');
		}

	}

	/**
	 * Add our tab and fields
	 */
	function publish_tabs($channel_id, $entry_id = '')
	{

		// --------------------------------------------------------------
		//   make sure we have some fields to add
		// --------------------------------------------------------------
			$this->field_ids = $this->EE->config->item('global_field_ids');

			if( empty($this->field_ids) )
			{
				show_error('Please define global field IDs in your config.');
			}
		// --------------------------------------------------------------

		// define some default vars & values
		$tab_fields = array();
		
		foreach ($this->field_ids as $id)
		{
			$field_data[ $id ] = '';
		}

		// --------------------------------------------------------------
		// fetch field data if it exists, simply via a query for now.
		// --------------------------------------------------------------
			if ($entry_id != '')
			{
				$data = $this->EE->db->get_where('channel_data', array('entry_id' => $entry_id))->row_array();
				foreach ($this->field_ids as $id)
				{
					$field_data[ $id ] = (isset($data[ 'field_id_'.$id ])) ? $data[ 'field_id_'.$id ] : '';
				}
			}
		// --------------------------------------------------------------


		// --------------------------------------------------------------
		//  grab settings and populate our tab fields array
		// --------------------------------------------------------------
			$this->EE->load->model('field_model');

			$i = 0;

			// build our settings array which creates each field in the tab
			// go grab the native setting for each field
			foreach ($this->field_ids as $id)
			{

				$tab_fields[ $i ] = $this->EE->field_model->get_field( $id )->row_array();

				// field settings are encoded
				if(isset($tab_fields[ $i ]['field_settings']))
				{
					$field_settings = unserialize(base64_decode($tab_fields[ $i ]['field_settings']));
					$tab_fields[ $i ] = $tab_fields[ $i ] + $field_settings;
				}

				$tab_fields[ $i ]['field_data'] = $field_data[ $id ]; // inject the field data

				// revert name to what the tab is expecting
				// required so our field 'required' settings are honored etc
				$tab_fields[ $i ]['field_name'] = 'global_fields__'.$tab_fields[ $i ]['field_id'];
				$i++;
			}
		// --------------------------------------------------------------

		return $tab_fields;
	}

	/**
	 * Merge our tab data into the main channel data array
	 * So EE just takes it as if it was in the post data
	 */
	function validate_publish($params)
	{

		// reference our publish data
		$this->data =& $this->EE->api_channel_entries->data;

		$this->field_ids = $this->EE->config->item('global_field_ids');

		if( empty($this->field_ids) )
		{
			return FALSE;
		}

		foreach ($this->field_ids as $id)
		{
			$field_data = ''; // default to null

			// have we got some data submitted in our global_fields
			if( isset($this->data['revision_post']['global_fields__'.$id]) )
			{
				// assign the value over
				$field_data = $this->data['revision_post']['global_fields__'.$id];
				
				// is it an array
				// native checkboxes and multi-selects come back as arrays
				// we need to implode
				if( is_array($field_data) )
				{
					$field_data = implode('|', $field_data);
				}
			}
			
			// push to main api_channel_entries->data array
			// et voila
			$this->data['field_id_'.$id] = $this->data['revision_post']['field_id_'.$id] = $field_data;

		}

	    return  FALSE;

	}


}
/* END Class */

/* End of file tab.global_fields.php */
/* Location: ./system/expressionengine/third_party/modules/global_fields/tab.global_fields.php */