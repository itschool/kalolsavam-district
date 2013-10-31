<?php
class Zipfiles extends Controller {

	function Zipfiles()
	{
		parent::Controller();
		$this->load->model('Session_Model');
		$this->Session_Model->is_user_logged(true);
		$this->template->add_js('js/admin/admin.js');
		//$this->template->write_view('menu', 'menu', '');
		//$this->load->model('zipfiles_model');
		$this->load->library('zip');
		$this->Contents = array();
	}

	function index()
	{
		 $this->zip_selected_photos();
	}

	function zip_selected_photos(){

        if($this->session->userdata('USER_TYPE')==2){

			$dist_code		=	$this->session->userdata('DISTRICT');
			$dist_name		=	get_dist_name($this->session->userdata('DISTRICT'));
			$photoDirectory	=	$dist_name.'Photos';
			$directoryToZip			=	'photos/'; // This will zip all the file(s) in this present working directory

			$outputDir				=	'uploads/'; //Replace "/" with the name of the desired output directory.
			$zipName				=	$photoDirectory.".zip";

			//Code toZip a directory and all its files/subdirectories
			$this->zip->zipDirectory($directoryToZip,$outputDir);
			$fd=fopen($zipName, "wb");
			$out=fwrite($fd,$this->zip->getZippedfile());
			fclose($fd);
			$this->zip->forceDownload($zipName);
			@unlink($zipName);
		}
		$this->template->load();
	}
}
