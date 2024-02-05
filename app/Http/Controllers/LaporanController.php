<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Models\Bagian;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:YYS']);
    }

    public function bagian()
    {
        $bagian = Bagian::all();
          
        $title = "Laporan Data Bagian";
        $pdf = PDF::loadView('yys.laporan.bagian', compact('bagian','title'));  
        // $pdf->setPaper('L', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
  
        $canvas = $domPdf->get_canvas();
        // Atas
        // $canvas->page_text(10, 10, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        /* Set Page Number to Footer */ 
        // $canvas->page_text(10, $canvas->get_height() - 20, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
        // Lanscape
        // $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);

        return $pdf->stream($title.'-'.date('d-m-Y').'.pdf');
        // return $pdf->download('itsolutionstuff.pdf');
    }
}
