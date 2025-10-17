<?php
use Dompdf\Dompdf;
use Dompdf\Options;

function generate_pdf($html, $filename = 'document.pdf')
{
    require_once FCPATH . 'vendor/autoload.php';

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A5', 'landscape'); // ubah jadi horizontal
    $dompdf->render();
    $dompdf->stream($filename, ['Attachment' => false]);
}
