<?php
class Test extends Controller {

	function Test()
	{
		parent::Controller();
	}
	
	function index()
	{
		//echo substr(fncUuid (), 0, 8);
		
		/*$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
   $port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
   $port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
   $url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.dirname($_SERVER['PHP_SELF']);
   echo $url;*/
		
		
		$this->load->library('_fpdf/fpdf');
		
		$this->fpdf->Open();
		
		/*$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',14);
		$this->fpdf->SetY(30);
		$this->fpdf->Cell(40,10,'Hello World!');
		$this->fpdf->Output('output.pdf','D');*/  
		
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',9);
		$this->fpdf->Line(5,5,5,200);
		$this->fpdf->Line(5,5,185,5);
		for($i = 5 ; $i < 190; $i = $i+10)
		{
			for($j = 5 ; $j < 250; $j = $j+10)
			{
				$this->fpdf->SetXY($i,$j);
				$this->fpdf->SetFont('Arial','',5);
				$this->fpdf->Write(0,"(".$i.", ".$j.")");
				$this->fpdf->Line($i,$j,$i,200);
				$this->fpdf->Line($i,$j,185,$j);
			}
		}
		
		$this->fpdf->Output('output.pdf','I');
	
	
	}
	
	function nodata()
	{
		
		$this->load->library('_fpdf/fpdf');
		
		$this->fpdf->Open();
		
		$this->fpdf->AddPage();
		$this->fpdf->SetFont('Arial','B',18);
		$this->fpdf->SetY(30);
		$this->fpdf->Cell(350,100,'No Data!');
		$this->fpdf->Output('output.pdf','I');  
		
	
	
	}
	
	function backup()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		
		$prefs = array(
                //'tables'      => array('school_master'),  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

$backup =$this->dbutil->backup($prefs); 

		// Backup your entire database and assign it to a variable
		//& $this->dbutil->backup();
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/doc/mybackup.zip', $backup);
		
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.zip', $backup); 
	}
	
	function export_data()
	{
		$this->load->helper('csv/csv');
		
		$sub_district_code		=	$this->session->userdata('SUB_DISTRICT');
		$this->db->where('sub_district_code',$sub_district_code);
		$school_master								=	$this->db->get('school_master');
		//$this->Contents['school_master']			=	$school_master;
		
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->join('school_master AS SM','SD.school_code = SM.school_code');
		$school_details								=	$this->db->get('school_details AS SD');
		//$this->Contents['school_details']			=	$school_details;
		
		
		
		$this->db->where('sub_district_code',$sub_district_code);
		$participant_details							=	$this->db->get('participant_details');
		//$this->Contents['participant_details']			=	$participant_details;
		
		
		$this->db->where('PM.sub_district_code',$sub_district_code);
		$this->db->join('participant_details AS PM','PM.participant_id = PD.participant_id');
		$this->db->select('PD.*');
		$participant_item_details	=	$this->db->get('participant_item_details AS PD');
		//$this->Contents['participant_item_details']		=		$participant_item_details;
		
		$export_array		=	array();
		$export_array		=	array_merge($export_array,$school_master->result_array(),$school_details->result_array(),$participant_details->result_array(),$participant_item_details->result_array());
		array_to_csv($export_array,'eee.csv');
		
		/*header("Content-type: application/ms-excel");
		header("Content-Disposition: attachment; filename=cluster_report.xls");
		$this->load->view('test/test',$this->Contents);*/
		
	}
	
	function excel_reader()
	{ //echo $this->config->item('base_path').'uploads/cluster_report.xls';
		// Load the spreadsheet reader library
		$this->load->library('csvreader');
		
		// Read the spreadsheet via a relative path to the document
		// for example $this->excel_reader->read('./uploads/file.xls');
		$csvData		=	$this->csvreader->parse_file($this->config->item('base_path').'uploads/eee.csv');
		
		// Get the contents of the first worksheet
		//$worksheet = $this->excel_reader->worksheets[0]; 
		print('<pre>');
		print_r($csvData);
		print('</pre>');
	}
	
	
}

?>