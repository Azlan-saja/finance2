<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use DB;
use App\Models\Bagian;
use App\Models\Rencana;
use App\Models\SubBagian;
use App\Models\Kegiatan;
use App\Models\Sasaran;
use App\Models\Anggaran;
use App\Models\Satuan;
use App\Models\User;
use App\Models\RencanaDetail;
use App\Models\RencanaDetailSubBagian;
use App\Models\RencanaDetailKegiatan;
use App\Models\Realisasi;
use App\Models\Pemasukan;
use App\Models\Beban;
use App\Models\LabaRugi;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user-access:RA|SD|SMP|YYS']);
    }

    public function bagian()
    {
        $bagian = Bagian::orderBy('type','asc')->with('subbagians')->get();
        // return $bagian;
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
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
        // return $pdf->stream($title.'-'.date('d-m-Y').'.pdf');
    }
    public function kegiatan()
    {
        $kegiatan = Kegiatan::orderBy('kegiatan','asc')->get();
        $title = "Laporan Data Kegiatan";
        $pdf = PDF::loadView('yys.laporan.kegiatan', compact('kegiatan','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function sasaran()
    {
        $hasil = Sasaran::orderBy('sasaran','asc')->get();
        $title = "Laporan Data Sasaran";
        $pdf = PDF::loadView('yys.laporan.sasaran', compact('hasil','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function anggaran()
    {
        $hasil = Anggaran::orderBy('anggaran','asc')->get();
        $title = "Laporan Data Sumber Anggaran";
        $pdf = PDF::loadView('yys.laporan.anggaran', compact('hasil','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function satuan()
    {
        $hasil = Satuan::orderBy('satuan','asc')->get();
        $title = "Laporan Data Satuan";
        $pdf = PDF::loadView('yys.laporan.satuan', compact('hasil','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function pengguna()
    {
        $hasil = User::orderBy('name','asc')->orderBy('type','asc')->get(['name','email','type']);
        $title = "Laporan Data Pengguna";
        $pdf = PDF::loadView('yys.laporan.pengguna', compact('hasil','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function rencana()
    {
        $hasil = Rencana::latest()->get();
        $title = "Laporan Data Rencana Anggaran Belanja (RAB)";
        $pdf = PDF::loadView('yys.laporan.rencana', compact('hasil','title'));  
        $pdf->output();
        $domPdf = $pdf->getDomPDF();  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
        return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    public function rencana_detail($rencana_id)
    {
        $rencana = Rencana::where('id',$rencana_id)->first();       
        if ($rencana){
            $grandtotal = 0;
            $rencana['bagian'] = [];
            $rencana_detail = RencanaDetail::where('rencana_id',$rencana_id)->orderBy('bagian_id','asc')->get(['id','nama_bagian']);
            foreach ($rencana_detail as $key => $value) {
                $subtotal = 0;
                $rencana['bagian'] = $rencana_detail;
                $rencana_detail_subbagian = RencanaDetailSubBagian::where('rencana_detail_id', $value->id)->orderBy('subbagian_id','asc')->get(['id','nama_subbagian']);                
                foreach ($rencana_detail_subbagian as $key2 => $value2) {
                    $value2['kegiatan'] = [];
                    
                    $rencana_detail_kegiatan = RencanaDetailKegiatan::where('rencana_detail_subbagian_id', $value2->id)->oldest();
                    $rencana_detail_kegiatan2 = $rencana_detail_kegiatan->get(['nama_kegiatan','sasaran','anggaran','satuan','jumlah_sasaran','volume','harga']);
                    foreach ($rencana_detail_kegiatan2 as $key3 => $value3) {
                        
                        $value2['subtotal2'] = $rencana_detail_kegiatan->sum(DB::raw('volume*harga'));
                        $value2['kegiatan'] = $rencana_detail_kegiatan2;
                        
                    }
                    $subtotal += $value2['subtotal2'];
                    $value['subtotal'] = $subtotal;
                    $value['subbgaian'] = $rencana_detail_subbagian;
                }
                $grandtotal += $subtotal;
            }
            $rencana['grandtotal'] = $grandtotal;                  

            $title = "Laporan Data Rencana Anggaran Belanja (RAB)";    
            $pdf = PDF::loadView('yys.laporan.rencana-detail', compact('rencana','title'));  
            $pdf->setPaper('L', 'landscape');
            $pdf->output();
            $domPdf = $pdf->getDomPDF();  
            $canvas = $domPdf->get_canvas();
            $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
            return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
            
                                      
        }else{
             return redirect()->route('rencana-detail.index',$rencana_id)
                        ->with('error','Laporan Rencana Anggaran Belanja - RAB Tidak Ditemukan.');
 
        }               
    }

    public function realisasi($rencana_id)
    {
         $rencana = Rencana::where('id',$rencana_id)->first(['anggaran','unit','tahun']);       
        if ($rencana){           
            $rencana['bagian'] = [];
            $rencana_detail = RencanaDetail::where('rencana_id',$rencana_id)->orderBy('bagian_id','asc')->get(['id','nama_bagian']);            
            $total_all = 0;
            foreach ($rencana_detail as $key => $value) {                
                $total_bagian = 0;                               
                $rencana['bagian'] = $rencana_detail;
                $rencana_detail_subbagian = RencanaDetailSubBagian::where('rencana_detail_id', $value->id)->orderBy('subbagian_id','asc')->get(['id','nama_subbagian']);                
                foreach ($rencana_detail_subbagian as $key2 => $value2) {                    
                    $value2['kegiatan'] = [];
                    $total_subbagian = 0;
                    $rencana_detail_kegiatan = RencanaDetailKegiatan::where('rencana_detail_subbagian_id', $value2->id)->oldest();
                    $rencana_detail_kegiatan2 = $rencana_detail_kegiatan->get(['id','nama_kegiatan','sasaran','anggaran','satuan','jumlah_sasaran','volume','harga']);
                    foreach ($rencana_detail_kegiatan2 as $key3 => $value3) {
                        $value3['realisasi'] = [] ;
                        $value3['total_realisasi'] = 0 ;                                                                     
                        $value2['kegiatan'] = $rencana_detail_kegiatan2;
                        $realiasi_raw = Realisasi::where('rencana_id', $rencana_id)
                            ->where('rencana_detail_id', $value->id)
                            ->where('rencana_detail_subbagian_id', $value2->id)
                            ->where('rencana_detail_kegiatan_id', $value3->id);

                            $realiasi = $realiasi_raw->get(['b1','b2','b3','b4','b5','b6','b7','b8','b9','b10','b11','b12']);
                            $value3['realisasi'] = $realiasi;
                            $value3['total_realisasi'] =  $realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));
                            $total_subbagian += $value3['total_realisasi'];
                    }
                    
                    $value2['total_subbagian'] = $total_subbagian;                  
                    $value['subbgaian'] = $rencana_detail_subbagian;
                    $total_bagian += $total_subbagian;
                }
                $value['total_bagian'] = $total_bagian;
                $total_all += $total_bagian;
            } 
            $rencana['total_all'] = $total_all;

            $title = "Laporan Data Realisasi Anggaran";    
            $pdf = PDF::loadView('yys.laporan.realisasi', compact('rencana','title'));  
            $pdf->setPaper('L', 'landscape');
            $pdf->output();
            $domPdf = $pdf->getDomPDF();  
            $canvas = $domPdf->get_canvas();
            $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
            return $pdf->download($title.'-'.date('d-m-Y').'.pdf');

            // return view('yys.realisasi.index',compact('rencana','rencana_id'));                             
        }else{
             return redirect()->route('rencana.index')
                        ->with('error','Rencana Anggaran Belanja - RAB Tidak Ditemukan.');
 
        }
    }

    public function pemasukan()
    {
            $hasil =Pemasukan::latest()->get();
            $title = "Laporan Data Pemasukan";    
            $pdf = PDF::loadView('yys.laporan.pemasukan', compact('hasil','title'));  
            $pdf->output();
            $domPdf = $pdf->getDomPDF();  
            $canvas = $domPdf->get_canvas();
            $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
            return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }

    public function beban()
    {
            $hasil =Beban::latest()->get();
            $title = "Laporan Data Beban";    
            $pdf = PDF::loadView('yys.laporan.beban', compact('hasil','title'));  
            $pdf->output();
            $domPdf = $pdf->getDomPDF();  
            $canvas = $domPdf->get_canvas();
            $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
            return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
    }
    
    public function laba_rugi(Request $request)
    {
       
        
        if (Auth::user()->lvl == 3){
             $request->validate([
            'unit' => 'required',
            'tahun' => 'required|max:9',
            ]);
            $unit = $request->unit;
            $tahun = $request->tahun;
        }else{
            $request->validate([                
                'tahun' => 'required|max:9',
            ]);
            $unit = Auth::user()->lvl;
            $tahun = $request->tahun;
        }
        $pengeluaran = [];
        $data_pengeluaran = [];
        $pemasukan = [];
      
        if ($unit == 4){
            $hasil = collect();
            for ($i=3; $i >= 0; $i--){ 
                 $x = new \stdClass();
                 $x->unit =  ["RA", "SD", "SMP", "YYS"][$i];
                 $x->tahun = $tahun; 
                    $rencana = Rencana::where('unit',$i)->where('tahun',$tahun)->first();
                    if($rencana){                                                     
                        $pemasukan_raw = Pemasukan::where('unit',$i)->where('tahun',$tahun)->latest();
                        $pemasukan['total'] =$pemasukan_raw->sum('nominal');
                        $pemasukan['data'] = $pemasukan_raw->get(['nama','sumber','nominal']);                                             

                        $realiasi_raw = Realisasi::where('rencana_id',$rencana->id)
                                ->orderBy('bagian_id', 'asc')
                                ->orderBy('subbagian_id', 'asc')
                                ->orderBy('rencana_detail_kegiatan_id', 'asc')
                                ->with('kegiatans');
                        $realisasi = $realiasi_raw->get();
                        $data_pengeluaran =[];
                        foreach ($realisasi as $key => $value) {            
                            $a = [];
                            $a['nama'] = $value->kegiatans->nama_kegiatan;
                            $a['nominal'] = $value->b1 + $value->b2 + $value->b3 + $value->b4 + $value->b5 + $value->b6 + $value->b7 + $value->b8 + $value->b9 + $value->b10 + $value->b11 + $value->b12;                      
                            $data_pengeluaran[] = $a;

                        }
                        $pengeluaran['total'] =$realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));                        
                        $pengeluaran['data'] = $data_pengeluaran;
 
                        $x->total_pemasukan = $pemasukan['total'] ;
                        $x->total_pengeluaran = $pengeluaran['total'];
                        $x->pendapatan = $pemasukan['total'] - $pengeluaran['total'];
                        $x->pemasukan = $pemasukan;
                        $x->pengeluaran = $pengeluaran;

                        // return view('yys.laba-rugi.search',compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan'));
                    }else{
                        $x->total_pemasukan = 0;
                        $x->total_pengeluaran = 0;
                        $x->pendapatan = 0;
                        $x->pemasukan = [
                            'total' => 0,
                            'data' => [],
                        ];
                        $x->pengeluaran = [
                            'total' => 0,
                            'data' => [],
                        ];
                    }                
                 $hasil->push($x);
            }
            // substr($tahun, 5, 4);
            $xmasuk = substr($tahun, 0, 4);
            $beban = Beban::where('akhir','>=',$xmasuk)                       
                            ->get();        
            // return $beban;
            // return $hasil;
                    $title = "Laporan Data Laba Rugi Semua Unit";    
                    $pdf = PDF::loadView('yys.laporan.laba-rugi-all', compact('hasil','beban','title'));  
                    $pdf->output();
                    $domPdf = $pdf->getDomPDF();  
                    $canvas = $domPdf->get_canvas();
                    $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
                    return $pdf->download($title.'-'.date('d-m-Y').'.pdf');

            // return view('yys.laba-rugi.search-all',compact('hasil','beban'));


        }else{
            $rencana = Rencana::where('unit',$unit)->where('tahun',$tahun)->first();
                if($rencana){      
                    $realiasi_raw = Realisasi::where('rencana_id',$rencana->id)
                                    ->orderBy('bagian_id', 'asc')
                                    ->orderBy('subbagian_id', 'asc')
                                    ->orderBy('rencana_detail_kegiatan_id', 'asc')
                                    ->with('kegiatans');
                    $realisasi = $realiasi_raw->get();
                    foreach ($realisasi as $key => $value) {            
                        $a = [];
                        $a['nama'] = $value->kegiatans->nama_kegiatan;
                        $a['nominal'] = $value->b1 + $value->b2 + $value->b3 + $value->b4 + $value->b5 + $value->b6 + $value->b7 + $value->b8 + $value->b9 + $value->b10 + $value->b11 + $value->b12;                      
                        $data_pengeluaran[] = $a;

                    }

                    $pengeluaran['total'] =$realiasi_raw->sum(DB::raw('b1 + b2 + b3 + b4 + b5 + b6 + b7 + b8 + b9 + b10 + b11 + b12'));
                    $pengeluaran['data'] = $data_pengeluaran;
                    
                    $pemasukan_raw = Pemasukan::where('unit',$unit)->where('tahun',$tahun)->latest();
                    $pemasukan['total'] =$pemasukan_raw->sum('nominal');
                    $pemasukan['data'] = $pemasukan_raw->get(['nama','sumber','nominal']);

                    $unit = $rencana->unit;
                    $pendapatan = $pemasukan['total'] - $pengeluaran['total'];     
                    
                    $title = "Laporan Data Laba Rugi Unit ".$unit;    
                    $pdf = PDF::loadView('yys.laporan.laba-rugi', compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan','title'));  
                    $pdf->output();
                    $domPdf = $pdf->getDomPDF();  
                    $canvas = $domPdf->get_canvas();
                    $canvas->page_text($canvas->get_width() - 70, $canvas->get_height() - 30, "Hal {PAGE_NUM}/{PAGE_COUNT}", null, 10, [0, 0, 0]);
                    return $pdf->download($title.'-'.date('d-m-Y').'.pdf');
                    
                    // return view('yys.laba-rugi.search',compact('unit','tahun','pemasukan','pengeluaran', 'pendapatan'));
                }else{
                    return redirect()->back()->withInput()
                                ->with('error','Laba Rugi Tidak Ditemukan.');
            
                }    
        }  

    }
    
}
