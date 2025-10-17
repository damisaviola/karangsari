<?php
use Dompdf\Dompdf;

class Dompdf_gen {
    public $dompdf;

    public function __construct() {
        require_once APPPATH . '../vendor/autoload.php'; // jika pakai Composer
        $this->dompdf = new Dompdf();
    }
}
