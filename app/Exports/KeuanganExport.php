<?php

namespace App\Exports;

use App\Models\Keuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use DB;

class KeuanganExport implements FromArray, WithMapping, WithHeadings, WithEvents, WithColumnWidths,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $keuangans = DB::table("keuangan")
        ->select('keuangan.id_keuangan', 'keuangan.deskripsi', 'keuangan.status', 'keuangan.foto_kwitansi', 'keuangan.nominal', 'keuangan.tgl_keuangan')->get()->toArray();
        return $keuangans;
    }

    public function map($keuangan): array
    {
            $nominal = 'Rp '.number_format(sprintf( preg_replace("/[^0-9.]/", "", $keuangan->nominal)), 0);
        return [
            $keuangan->id_keuangan,
            $keuangan->deskripsi,
            $keuangan->status,
            $keuangan->foto_kwitansi,
            $nominal,
            $keuangan->tgl_keuangan,
        ];
    }

    public function headings(): array
    {
        return [
            'Id Keuangan',
            'Deskripsi',
            'Status',
            'Foto Kwitansi',
            'Nominal',
            'Tanggal Keuangan'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font'=>[
                        'bold' => true
                    ]
                ]);
            }
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'D' => 28,
            'E' => 15,
            'F' => 22,            
        ];
    }
}
