<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use App\Models\Produk;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    protected LaporanPenjualanService $laporanService;
    protected MonitoringStokService $stokService;

    public function __construct(
        LaporanPenjualanService $laporanService,
        MonitoringStokService $stokService
    ) {
        $this->laporanService = $laporanService;
        $this->stokService = $stokService;
    }

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();

        return view('dashboard', [
            'tanggalHariIni' => Carbon::now(),
            'ringkasan' => $ringkasan,
            'totalProduk' => Produk::count(),
            'bestSellers' => $this->laporanService->produkTerlarisHariIni(),
            'jumlahBestSellers' => $this->laporanService->jumlahProdukTerlarisHariIni(),
            'lowStock' => $this->stokService->produkStokRendah(),
            'jumlahLowStock' => $this->stokService->jumlahProdukStokRendah(),
            'outOfStock' => $this->stokService->produkStokHabis(),
            'jumlahOutOfStock' => $this->stokService->jumlahProdukStokHabis(),
        ]);
    }
}