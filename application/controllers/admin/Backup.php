<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbutil(); 
        $this->load->helper(array('file', 'download')); 
    }

    public function index() {
     
        $prefs = array(
            'format' => 'zip', 
            'filename' => 'backup_db_karangsari.sql' 
        );


        $backup = $this->dbutil->backup($prefs);


        $backup_name = 'backup-karangsari-' . date("Y-m-d-H-i-s") . '.zip';

    
        $save = FCPATH . 'backups/' . $backup_name;
        write_file($save, $backup);

  
        force_download($backup_name, $backup);
    }
}
