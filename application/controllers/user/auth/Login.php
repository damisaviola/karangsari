<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load model/helper/library kalau butuh
    }

    public function index() {
        // Pastikan view ada di: application/views/user/auth/auth-login.php
        $this->load->view('user/auth/auth-login');
    }
}
