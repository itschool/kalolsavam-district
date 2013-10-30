<?php
class Import extends Controller {

	function Import()
	{
		parent::Controller();
		$this->load->model('Session_Model');
		//$this->load->model('General_Model');
		//$this->Session_Model->is_user_logged(true);
		$this->template->add_js('js/admin/admin.js');
		//$this->template->write_view('menu', 'menu', '');
		$this->load->library('csvreader');
		$this->load->model('Import_Model');
		$this->Contents = array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	function index()
	{
		$this->import_district_kalolsavam_data ();
	}
	
	function import_data ()
	{
		if ($this->session->userdata('USER_GROUP') == 'A' && ($this->session->userdata('USER_TYPE')==3 || $this->session->userdata('USER_TYPE')==2))
		{
			
			if (is_import_data_finish ($this->session->userdata('SUB_DISTRICT')))
			{
				$this->Contents['import_completed'] = 'YES';
				$this->template->write_view('menu', 'menu', '');
			}
			else
			{
				$this->Contents['import_completed'] = 'NO';
			}
			if (isset($_FILES['kalolsavamCSV']['name']) && !empty($_FILES['kalolsavamCSV']['name']))
			{
				$file_name	= $this->General_Model->upload_kalolsavam_csv_data ('kalolsavamCSV', 'kalolsavamCSV'.substr(fncUuid(), 10));
				if (!$file_name)
				{
					$this->template->write('error', $this->upload->display_errors());
					$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
					$this->template->load();
					return;
				}
				if ($this->session->userdata('USER_TYPE')==3 )
				{
					$import_result	= $this->Import_Model->insert_import_data ($file_name);
					if (TRUE === $import_result)
					{
						$this->Contents['import_completed'] = 'YES';
						$this->template->write_view('menu', 'menu', '');
						$this->template->write('message', 'CSV Data saved successfully');
					}
					else if ('INVALID_DATA' == $import_result)
					{
						$this->template->write('error', 'Invalid CSV');
					}
					else if ('DATA_ALREADY_ENTERED' == $import_result)
					{
						$this->template->write('error', 'CSV data already imported');
					}
					else
					{
						$this->template->write('error', 'Failed to Save CSV Data');
					}
				}
				else if ($this->session->userdata('USER_TYPE')==2)
				{
					$import_result	= $this->Import_Model->insert_import_district_data ($file_name);
					if (TRUE === $import_result)
					{
						$this->template->write('message', 'CSV Data saved successfully');
					}
					else if ('INVALID_SUB_DISRICT_DATA' == $import_result)
					{
						$this->template->write('error', 'This Sub-District is not belongs to current District');
					}
					else if ('DATA_ALREADY_ENTERED' == $import_result)
					{
						$this->template->write('error', 'Sub-District data already imported');
					}
					else
					{
						$this->template->write('error', 'Failed to Save CSV Data');
					}
				}
				
				
			}
	
			$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
			$this->template->load();
		}
		else redirect ('welcome');
		
	}
	
	function import_district_kalolsavam_data ()
	{
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==2)
		{
			if (isset($_FILES['kalolsavamCSV']['name']) && !empty($_FILES['kalolsavamCSV']['name']))
			{
				$file_name	= $this->General_Model->upload_kalolsavam_csv_data ('kalolsavamCSV', 'kalolsavamCSV'.substr(fncUuid(), 10));
				if (!$file_name)
				{
					$this->template->write('error', $this->upload->display_errors());
					$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
					$this->template->load();
					return;
				}
				$import_result	= $this->Import_Model->insert_import_district_data ($file_name);
				if (TRUE === $import_result)
				{
					$this->template->write('message', 'CSV Data saved successfully');
				}
				else if ('INVALID_SUB_DISRICT_DATA' == $import_result)
				{
					$this->template->write('error', 'This Sub-District is not belongs to current District');
				}
				else if ('DATA_ALREADY_ENTERED' == $import_result)
				{
					$this->template->write('error', 'Sub-District data already imported');
				}
				else
				{
					$this->template->write('error', 'Failed to Save CSV Data');
				}
				
			}
			
			$this->Contents['sub_dist_list']		=	$this->Import_Model->get_sub_dist_data($this->session->userdata('DISTRICT'));
			
			
			$this->template->write_view('content', 'import/import_csv_dist_data', $this->Contents);
			$this->template->load();
		}
		else redirect ('welcome');
		
	}
	
	function confirm_dist_import_data()
	{
		$message		=	$this->Import_Model->confirm_dist_import_data($this->session->userdata('DISTRICT'));
		
		if ($message['error'])
		{
			$this->template->write('error', $message['error']);
		}
		else if ($message['message'])
		{
			$this->template->write('message', $message['message']);
			$this->template->write_view('menu', 'menu', '');
		}
		$this->import_district_kalolsavam_data();
	}
	
	function backup_data(){

		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file($_SERVER['DOCUMENT_ROOT'].'/kalolsavam_district/dbBackup/kalolsavam_district_'.date('d-m-Y-h-i-s').'.gz', $backup);
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('kalolsavam_district_'.date('d-m-Y-h-i-s').'.gz', $backup); 

		/*if($back_up		=	$this->Import_Model->backup_tables()){
		$message		=	'Database backup done sucessfully . To view the backup ,  file look in        '.$_SERVER['DOCUMENT_ROOT'].'/kalolsavam_district/dbBackup/';					
		$this->template->write('message', $message);
		}
		else{
			$message		=	'Database backup failure . please check it';
				
		$this->template->write('error', $message);
			}*/
		$this->template->write_view('menu', 'menu', '');
		$this->template->load();
				
		}
	function backup_data_sql(){
		if($back_up		=	$this->Import_Model->backup_tables()){
		$message		=	'Database backup done sucessfully . To view the backup ,  file look in        '.$_SERVER['DOCUMENT_ROOT'].'/kalolsavam_district/dbBackup/';					
		$this->template->write('message', $message);
		}
		else{
			$message		=	'Database backup failure . please check it';
				
		$this->template->write('error', $message);
			}
		$this->template->write_view('menu', 'menu', '');
		$this->template->load();
				
		}
	function repair_database(){
	$this->load->dbutil();
	if ($this->dbutil->repair_table('result_master'))
	{
		$message		=	'Repair done sucessfully';				
		$this->template->write('error', $message);
	} 
		$this->template->write_view('menu', 'menu', '');
		$this->template->load();
	}
	
	function restore_database(){
					
		$this->template->write_view('menu', 'menu', '');
		if ($this->session->userdata('USER_GROUP') == 'W')
		{
			
			if (isset($_FILES['kalolsavamdatabase']['name']) && !empty($_FILES['kalolsavamdatabase']['name']))
			{
				$file_name	= $this->General_Model->restore_database ('kalolsavamdatabase', 'kalolsavamdatabase'.substr(fncUuid(), 10));
				if (!$file_name)
				{
					$this->template->write('error', $this->upload->display_errors());
					$this->template->write_view('content', 'import/restore_data', $this->Contents);
					$this->template->load();
					return;
				}
				if ($this->session->userdata('USER_GROUP') == 'W')
				{
					$import_result	= $this->Import_Model->restore_Database ($file_name);
					if (TRUE === $import_result)
					{
						$this->template->write_view('menu', 'menu', '');
						$this->template->write('message', 'Restore Database successfully');
					}					
					else
					{
						$this->template->write('error', 'Failed to Restore Database');
					}
				}			
				
			}
	
			$this->template->write_view('content', 'import/restore_data', $this->Contents);
			$this->template->load();
		}
		else redirect ('welcome');
		
	
				
		}
}
?>