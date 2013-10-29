<?php

/**
* Excel reader class
*
* PHP class for reading an Excel spreadsheet document.
*
* @author James Gifford
* @copyright Copyright (c) 2006, James Gifford
* @link http://jamesgifford.com My Website
* @link sc.openoffice.org/excelfileformat.pdf Excel format documentation
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @category Spredsheets
* @version 0.1.2
* @filesource
* @todo Too many things to list at this time
*/
class Excel_reader
{
    /**
     * The raw contents of the spredsheet document
     *
     * @access private
     * @var string
     */
    var $_document;
    
    /**
     * The size of standard sectors, in bytes
     *
     * @access public
     * @var long
     */
    var $_sector_size;
    
    /**
     * The size of short sectors, in bytes
     *
     * @access private
     * @var long
     */
    var $_short_sector_size;
    
    /**
     * The minimum size of a standard sector, in bytes
     *
     * @access private
     * @var long
     */
    var $_standard_size;
    
    /**
     * The sector allocation table
     *
     * @access private
     * @var array
     */
    var $_sat;
    
    /**
     * The short-sector allocation table
     *
     * @access private
     * @var array
     */
    var $_ssat;
    
    /**
     * The directory
     *
     * @access private
     * @var array
     */
    var $_directory;
    
    /**
     * The short-stream container stream
     *
     * @access private
     * @var string
     */
    var $_sscs;
    
    /**
     * The shared string table
     *
     * @access private
     * @var array
     */
    var $_sst;
    
    /**
     * The worksheets of the spreadsheet
     *
     * @access public
     * @var array
     */
    var $worksheets;
    
    /**
     * Constructor
     */
    function Excel_reader ($file = '')
    {
        $this->_init();
        
        if ($file !== '')
        {
            return $this->read($file);
        }
    }
    
    /**
     * Initialize class variables
     *
     * @access private
     * @return void
     */
    function _init ()
    {
        $this->_document = '';
        $this->_sector_size = 0;
        $this->_short_sector_size = 0;
        $this->_standard_size = 0;
        $this->_sat = array();
        $this->_ssat = array();
        $this->_directory = array();
        $this->_sscs = '';
    }
    
    /**
     * Read a spredsheet document
     *
     * @access public
     * @param string the path to the spreadsheet document
     * @return void
     */
    function read ($file)
    {
        if (!(is_readable($file)))
        {
            return false;
        }
        
        if (!($this->_document = file_get_contents($file)))
        {
            return false;
        }
        
        $this->_parse_header();
        $this->_parse_directory();
    }
    
    /**
     * Extract document values from the header sector and build data tables
     *
     * @access private
     * @return void
     */
    function _parse_header ()
    {
       // echo $this->_document."dsds";
		$header = substr($this->_document, 0, 512);
        
        if (substr($header, 0, 8) != pack('H*', 'd0cf11e0a1b11ae1'))
        {
            show_error('Invalid file format');
        }
        
        $this->_sector_size = pow(2, $this->_get_value($header, 30, 2));
        $this->_short_sector_size = pow(2, $this->_get_value($header, 32, 2));
        $this->_standard_size = $this->_get_value($header, 56, 4);
        
        $this->_build_sat($header);
        $this->_build_ssat($this->_get_value($header, 60, 4), $this->_get_value($header, 64, 4));
        $this->_build_directory($this->_get_value($header, 48, 4));
    }
    
    /**
     * Build the sector allocation table
     *
     * @access private
     * @param string the header stream
     * @return void
     */
    function _build_sat ($header)
    {
        $msat = array();
        
        for ($i = 76; $i < $this->_sector_size && $this->_get_value($header, $i, 4) != 0xffffffff; $i += 4)
        {
            $msat[] = $this->_get_value($header, $i, 4);
        }
        
        if (($msat_start = $this->_get_value($header, 68, 4)) != 0xfffffffe)
        {
            $msat_size = $this->_get_value($header, 72, 4);
            
            // TODO: complete the construction of the msat for larger documents
        }
        
        foreach ($msat as $sat_sid)
        {
            $sector = substr($this->_document, ((1 + $sat_sid) * $this->_sector_size), $this->_sector_size);
            
            for ($i = 0; $i < $this->_sector_size; $i += 4)
            {
                $this->_sat[] = $this->_get_value($sector, $i, 4);
            }
        }
        
        if ((count($this->_sat) / ($this->_sector_size / 4)) != $this->_get_value($header, 44, 4))
        {
            show_error('Currupted data found in file');
        }
    }
    
    /**
     * Build the short-sector allocation table
     *
     * @access private
     * @param long the startong sid
     * @param long the size of the ssat
     * @return void
     */
    function _build_ssat ($ssat_start, $ssat_size)
    {
        if ($ssat_start == 0xfffffffe)
        {
            return;
        }
        
        $ssat_chain = array($ssat_start);
        $ssat_sid = $ssat_start;
        
        while ($this->_sat[$ssat_sid] != 0xfffffffe)
        {
            $ssat_chain[] = $ssat_sid = $this->_sat[$ssat_sid];
        }
        
        foreach ($ssat_chain as $ssat_sid)
        {
            $sector = substr($this->_document, ((1 + $ssat_sid) * $this->_sector_size), $this->_sector_size);
            
            for ($i = 0; $i < $this->_sector_size; $i += 4)
            {
                $this->_ssat[] = $this->_get_value($sector, $i, 4);
            }
        }
        
        if ((count($this->_ssat) / ($this->_sector_size / 4)) != $ssat_size)
        {
            show_error('Corrupted data found in file');
        }
    }
    
    /**
     * Build the directory
     *
     * @access private
     * @param long the starting sid
     * @return void
     */
    function _build_directory ($directory_start)
    {
        $directory_chain = array($directory_start);
        $directory_sid = $directory_start;
        
        while ($this->_sat[$directory_sid] != 0xfffffffe)
        {
            $directory_chain[] = $directory_sid = $this->_sat[$directory_sid];
        }
        
        foreach ($directory_chain as $directory_sid)
        {
            $sector = substr($this->_document, ((1 + $directory_sid) * $this->_sector_size), $this->_sector_size);
            
            for ($i = 0; $i < 4; $i++)
            {
                $this->_directory[] = substr($sector, ($i * 128), 128);
            }
        }
    }
    
    /**
     * Extract values from directory entries and build data tables and streams
     *
     * @access private
     * @return void
     */
    function _parse_directory ()
    {
        foreach ($this->_directory as $entry_did => $entry)
        {
            $entry_name = '';
            
            for ($i = 0; $i < (($this->_get_value($entry, 64, 2) - 2) / 2); $i++)
            {
                $entry_name .= chr($this->_get_value(substr($entry, 0, 64), $i * 2, 2));
            }
            
            if ($this->_get_value($entry, 66, 1) == 5)
            {
                $this->_build_sscs($entry);
            }
            else if ($entry_name == 'Workbook' || $entry_name == 'Book')
            {
                $this->_parse_workbook($entry);
            }
            else
            {
                // TODO: Handle the other directory entries
            }
        }
    }
    
    /**
     * Build the short-stream container stream
     *
     * @access private
     * @param string the root entry stream
     * @return void
     */
    function _build_sscs ($root)
    {    
        $sscs_start = $this->_get_value($root, 116, 4);
        $sscs_size = $this->_get_value($root, 120, 4);
        
        if ($sscs_start == 0xfffffffe)
        {
            return;
        }
        
        $sscs_chain = array($sscs_start);
        $sscs_sid = $sscs_start;
        
        while ($this->_sat[$sscs_sid] != 0xfffffffe)
        {
            $sscs_chain[] = $sscs_sid = $this->_sat[$sscs_sid];
        }
        
        foreach ($sscs_chain as $sscs_sid)
        {
            $this->_sscs .= substr($this->_document, ((1 + $sscs_sid) * $this->_sector_size), $this->_sector_size);
        }
    }
    
    /**
     * Parse the workbook directory entry
     *
     * @access private
     * @param string the workbook stream
     * @return void
     */
    function _parse_workbook ($entry)
    {
        $workbook_start = $this->_get_value($entry, 116, 4);
        $workbook_size = $this->_get_value($entry, 120, 4);
        
        $workbook_chain = array($workbook_start);
        $workbook_sid = $workbook_start;
        
        if ($workbook_size >= $this->_standard_size)
        {
            while ($this->_sat[$workbook_sid] != 0xfffffffe)
            {
                $workbook_chain[] = $workbook_sid = $this->_sat[$workbook_sid];
            }
        }
        else
        {
            while ($this->_ssat[$workbook_sid] != 0xfffffffe)
            {
                $workbook_chain[] = $workbook_sid = $this->_ssat[$workbook_sid];
            }
        }
        
        foreach ($workbook_chain as $workbook_sid)
        {
            if ($workbook_size >= $this->_standard_size)
            {
                $this->workbook .= substr($this->_document, ((1 + $workbook_sid) * $this->_sector_size), $this->_sector_size);
            }
            else
            {
                $this->workbook .= substr($this->_sscs, ($workbook_sid * $this->_short_sector_size), $this->_short_sector_size);
            }
        }
        
        $this->workbook = substr($this->workbook, 0, $workbook_size);
        
        $this->biff_version = $this->_get_value($this->workbook, 1, 1);
        
        $i = 0;
        $identifier = 0;
        $record_identifier = $this->_get_value($this->workbook, $i, 2);
        
        while ($record_identifier != 0x000a)
        {
            $record_size = $this->_get_value($this->workbook, ($i + 2), 2);
            $record_data = substr($this->workbook, ($i + 4), $record_size);
            
            if ($record_identifier != 0x003c)
            {
                $identifier = $record_identifier;
            }
            
            switch ($identifier)
            {
                case 0x00fc:
                    $total_strings = $this->_get_value($this->workbook, $i + 4, 4);
                    $sst_strings = $this->_get_value($this->workbook, $i + 8, 4);
                    
                    $offset = 0;
                    for ($k = 0; $k < $sst_strings; $k++)
                    {
                        $string_size = $this->_get_value($this->workbook, $i + 12 + $offset, 2);
                        
                        $this->_sst[] = substr($this->workbook, $i + 12 + $offset + 3, $string_size);
                        
                        $offset += $string_size + 3;
                    }
                    break;
                
                case 0x0085:
                    $worksheets[] = $record_data;
                    break;
                    
                default:
                    // TODO: Handle other workbook records
                    break;
            }
            
            $i += ($record_size + 4);
            $record_identifier = $this->_get_value($this->workbook, $i, 2);    
        }
        
        foreach ($worksheets as $index => $worksheet)
        {
            $this->_parse_worksheet($worksheet, $index);
        }
    }
    
    /**
     * Parse a worksheet
     *
     * @access private
     * @param string portion of document stream containing the worksheet
     * @param int the index of this worksheet
     * @return void
     */
    function _parse_worksheet ($stream, $index)
    {
        $worksheet_start = $this->_get_value($stream, 0, 4);
        
        $length = $this->_get_value($stream, 6, 1);
        $something = $this->_get_value($stream, 7, 1);
        $sheet_name = substr($stream, 8, $length);
        
        $this->worksheet = substr($this->workbook, $worksheet_start);
        
        $j = 0;
        $worksheet_identifier = 0;
        $worksheet_record_identifier = $this->_get_value($this->worksheet, $j, 2);
        
        while ($worksheet_record_identifier != 0x000a)
        {
            $worksheet_record_size = $this->_get_value($this->worksheet, ($j + 2), 2);
            $worksheet_record_data = substr($this->worksheet, ($j + 4), $worksheet_record_size);
            
            if ($worksheet_record_identifier != 0x003c)
            {
                $worksheet_identifier = $worksheet_record_identifier;
            }
            
            switch ($worksheet_identifier)
            {
                case 0x00fd:
                    $row = $this->_get_value($this->worksheet, $j + 4, 2);
                    $col = $this->_get_value($this->worksheet, $j + 6, 2);
                    $sst_index = $this->_get_value($this->worksheet, $j + 10, 4);
                    
                    $this->worksheets[$index][$row][$col] = $this->_sst[$sst_index];
                    break;
                
                case 0x0006:
                case 0x0203:
                    $row = $this->_get_value($this->worksheet, $j + 4, 2);
                    $col = $this->_get_value($this->worksheet, $j + 6, 2);
                    $low_value = $this->_get_value($this->worksheet, $j + 10, 4);
                    $high_value = $this->_get_value($this->worksheet, $j + 14, 4);
                    
                    $this->worksheets[$index][$row][$col] = $this->_get_number($low_value, $high_value);
                    break;
                
                case 0x027e:
                    $row = $this->_get_value($this->worksheet, $j + 4, 2);
                    $col = $this->_get_value($this->worksheet, $j + 6, 2);
                    $rk_value = $this->_get_value($this->worksheet, $j + 10, 4);
                    
                    $this->worksheets[$index][$row][$col] = $this->_get_rk($rk_value);
                    break;
                
                case 0x00bd:
                    $row = $this->_get_value($this->worksheet, $j + 4, 2);
                    $first_col = $this->_get_value($this->worksheet, $j + 6, 2);
                    $last_col = $this->_get_value($this->worksheet, $j + 2 + $worksheet_record_size, 2);
                    
                    for ($i = 0; $i <= $last_col - $first_col; $i++)
                    {
                        $rk_value = $this->_get_value($this->worksheet, $j + 10 + ($i * 6), 4);
                        
                        $this->worksheets[$index][$row][$first_col + $i] = $this->_get_rk($rk_value);
                    }
                    break;
                
                default:
                    // TODO: Handle other worksheet records
                    break;
            }
            
            $j += ($worksheet_record_size + 4);
            $worksheet_record_identifier = $this->_get_value($this->worksheet, $j, 2);
        }
    }
    
    /**
     * Convert hexidecimal values to decimal
     *
     * @access private
     * @param string the stream from which to obtain the bytes
     * @param int the offset within the stream to start reading
     * @param int the number of bytes to read from the stream
     * @return long
     */
    function _get_value ($stream, $offset = 0, $length = 1)
    {
        if (strlen($stream) < ($offset + $length) || $length < 1)
        {
            return false;
        }
        
        $string = substr($stream, $offset, $length);
        $value = 0;
        
        for ($i = 0; $i < strlen($string); $i++)
        {
            $value += (ord($string[$i]) * pow(256, $i));
        }
        
        return $value;
    }
    
    /**
     * Convert an rk value to a decimal number
     *
     * @access private
     * @param long the rk value
     * @return mixed
     */
    function _get_rk ($rk)
    {
        if ($rk & 2)
        {
            $value = ($rk & 0xfffffffc) >> 2;
        }
        else
        {
            $exp = ((($rk & 0x7ff00000) >> 20) - 1023);
            $value = (0x100000 | ($rk & 0x000ffffc)) / pow(2, (20 - $exp));
            
            if (($rk & 0x80000000) >> 31)
            {
                $value = -$value;
            }
        }
        
        if ($rk & 1)
        {
            $value /= 100;
        }
        
        return $value;
    }
    
    /**
     * Convert a IEEE 754 floating point number into a decimal number
     *
     * @access private
     * @param long low value
     * @param long high value
     * @return mixed
     */
    function _get_number ($low, $high)
    {
        $exp = ((($high & 0x7ff00000) >> 20) - 1023);
        $value = (0x100000 | ($high & 0x000fffff)) / pow(2, (20 - $exp));
        
        if (($low & 0x80000000) >> 31)
        {
            $value += (1 / pow(2, (21 - $exp)));
        }
        
        $value += (($low & 0x7fffffff) / pow(2, (52 - $exp)));
        
        if (($high & 0x80000000) >> 31)
        {
            $value = -$value;
        }
        
        return $value;
    }
}

?> 