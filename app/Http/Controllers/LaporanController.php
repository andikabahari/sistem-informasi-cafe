<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyAuth;
use App\Helpers\Pdf;

class LaporanController extends Controller
{
    private $tahun;
    private $bulan;
    private $periode;

    public function __construct(Request $request)
    {
        $strdate = $request->input('periode');
        if (preg_match('/\d{4}-\d{1,2}/', $strdate)) {
            $date = date_create($strdate);
            $this->tahun = date_format($date, 'Y');
            $this->bulan = date_format($date, 'm');
        } else {
            $this->tahun = date('Y');
            $this->bulan = date('m');
        }

        $this->periode = sprintf('%s-%s', $this->tahun, $this->bulan);
    }

    public function pesanan(Request $request, Pdf $pdf)
    {
        MyAuth::authorize('pemilik');

        $pesanan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $this->tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $this->bulan)
                ->select('tanggal_pesanan', 'nama_pelanggan', 'total')
                ->get();

        $header = array('Tanggal', 'Nama Pelanggan', 'Total (Rp)');

        $title = sprintf('Laporan Pesanan - %s, %s', date('M', strtotime($this->periode)), $this->tahun);
        
        $data = $pdf->LoadData($pesanan->map(function ($data)
                {
                    return [
                        $data->tanggal_pesanan,
                        $data->nama_pelanggan,
                        $data->total,
                    ];
                })->toArray());
        
        $pdf->AddPage();
        $pdf->SetFont('Arial','', 14);
        $pdf->Multicell(0, 10, $title); 
        $pdf->SetFont('Arial', '', 12);
        $pdf->BasicTable($header, $data);
        $pdf->Output();

        exit;
    }

    public function pendapatan(Request $request, Pdf $pdf)
    {
        MyAuth::authorize('pemilik');

        $pendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $this->tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $this->bulan)
                ->groupBy(DB::raw('pekan'))
                ->select(DB::raw('
                    DATE_FORMAT(tanggal_pesanan, "%b, %Y") as periode,
                    WEEK(tanggal_pesanan) as pekan,
                    COUNT(pembayaran.id_pesanan) as pesanan,
                    SUM(total) as pendapatan
                '))
                ->get();

        $totalPendapatan = DB::table('pembayaran')
                ->join('pesanan', 'pembayaran.id_pesanan', '=', 'pesanan.id_pesanan')
                ->where(DB::raw('YEAR(tanggal_pesanan)'), '=',  $this->tahun)
                ->where(DB::raw('MONTH(tanggal_pesanan)'), '=',  $this->bulan)
                ->sum('total');

        $header = array('Pekan', 'Banyak Pesanan', 'Pendapatan (Rp)');

        $title = sprintf('Laporan Pendapatan - %s, %s', date('M', strtotime($this->periode)), $this->tahun);

        $data = $pdf->LoadData($pendapatan->map(function ($data)
                {
                    return [
                        'Ke-'.$data->pekan,
                        $data->pesanan,
                        $data->pendapatan,
                    ];
                })->toArray());
        
        $pdf->AddPage();
        $pdf->SetFont('Arial','', 14); 
        $pdf->Multicell(0, 10, $title); 
        $pdf->SetFont('Arial', '', 12);
        $pdf->BasicTable($header, $data);
        $pdf->Cell(80, 6, 'Total', 1);
        $pdf->Cell(40, 6, $totalPendapatan, 1);
        $pdf->Ln();
        $pdf->Output();

        exit;
    }
}
