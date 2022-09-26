<?php
namespace App\Services\Transaksi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportExcelService{

    public $excel,$id_kegiatan,$bulan;

    public function __construct($excel,$id_kegiatan,$bulan)
    {
        $this->excel=$excel;
        $this->id_kegiatan=$id_kegiatan;
        $this->bulan=$bulan;
    }

    public function import(){
        $transaksi=(new FastExcel)->import(Storage::path('excel/'.$this->excel),function($row){
            return $this->insert($row);
        });

        return $transaksi;
    }

    private function insert($row){
        $insert=[
            'id_kegiatan'=>$this->id_kegiatan,
            'bulan'=>$this->bulan,
            'user_input'=>Auth::user()->id,
            'tanggal_input'=>date('D-M-Y'),
        ];

        foreach ($row as $key => $value) {
            $insert[$key]=$value;
        };

        return DB::table('transaksi')
                ->insert($insert);

    }

}
