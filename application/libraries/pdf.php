<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf {
    public function createPDF($html, $filename='', $download=TRUE) {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        if ($download) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 1));
        } else {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        }
    }
}
