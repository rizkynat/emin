<?php

namespace App\Exports;

use App\Models\Artikel;
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

class ArtikelExport implements FromArray, WithMapping, WithHeadings, WithEvents, WithColumnWidths,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $artikels = DB::table('artikel')
            ->join('volume', 'volume.id_volume','=','artikel.id_volume')
            ->select('artikel.id_artikel','artikel.id_volume','artikel.nama_penulis','artikel.email_penulis','artikel.judul_artikel','artikel.instansi','volume.id_volume', DB::raw("DATE_FORMAT(volume.tahun, '%M %Y') as tahun"), 'volume.no_volume')->get()->toArray();
        return $artikels;
    }

    public function map($artikel): array
    {
        $no_volume = $artikel->no_volume.' ,'.$artikel->tahun;
        return [
            $artikel->id_artikel,
            $artikel->nama_penulis,
            $artikel->email_penulis,
            $artikel->judul_artikel,
            $artikel->instansi,
            $no_volume,
        ];
    }

    public function headings(): array
    {
        return [
            'Id Artikel',
            'Nama Penulis',
            'Email Penulis',
            'Judul Artikel',
            'Instansi',
            'No Volume'
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
            'D' => 95,
            'E' => 45,
            'F' => 22,            
        ];
    }
}
