<?php

namespace App\Charts;

use App\Models\Anggota;
use App\Models\Korcam;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class KonstituanteBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
    $tahunAwal = 2023;    // Tahun awal adalah 2023
    $tahunAkhir = 2024;   // Tahun akhir adalah 2024
    $bulanAwal = 9;       // Bulan awal adalah September (bulan ke-9)
    $bulanAkhir = 3;      // Bulan akhir adalah Juli (bulan ke-7)

    $namaBulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $dataBulan = [];
    $dataTotalAnggota = [];
    // $dataTotalKorcam = [];

    for ($tahun = $tahunAwal; $tahun <= $tahunAkhir; $tahun++) {
        $bulanMulai = ($tahun == $tahunAwal) ? $bulanAwal : 1;
        $bulanSelesai = ($tahun == $tahunAkhir) ? $bulanAkhir : 12;

        for ($i = $bulanMulai; $i <= $bulanSelesai; $i++) {
            $totalAnggota = Anggota::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count('id');
            // $totalKorcam = Korcam::whereYear('created_at', $tahun)
            //     ->whereMonth('created_at', $i)
            //     ->count('id');


            $dataBulan[] = $namaBulan[$i - 1] . ' ' . $tahun;
            $dataTotalAnggota[] = $totalAnggota;
            // $dataTotalKorcam[] = $totalKorcam;
        }
    }
        return $this->chart->lineChart()
            ->setTitle('Data Konstituante')
            ->setSubtitle('Total Konstituante 2023 - 2024.')
            ->addData('Konstituante', $dataTotalAnggota)
            // ->addData('Korcam', $dataTotalKorcam)
            ->setHeight(250)
            ->setXAxis($dataBulan)
            ->setGrid()
            ->setMarkers(['#FF5722', '#E040FB'], 7, 10);
    }
}
