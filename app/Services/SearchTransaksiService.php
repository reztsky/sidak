<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class SearchTransaksiService{
    public $parameter;

    public function __construct($parameter){
        $this->parameter=$parameter;
    }

    public function search(){
        $transaksis = DB::table('transaksi')
                ->select($this->setSelect())
                ->join('kegiatan','kegiatan.id_kegiatan','=','transaksi.id_kegiatan')
                ->where([
                    ['kegiatan.id_kegiatan','=',$this->parameter->id_kegiatan],
                    ['transaksi.bulan','=',$this->parameter->bulan],
                    ['transaksi.tahun','=',$this->parameter->tahun],
                ])
                ->when($this->parameter->filled(['nama']),function($query){
                    return $query->where('transaksi.nama','like',"%{$this->parameter->nama}%");
                })
                ->paginate(10);
                
        $transaksis->appends($this->parameter->all());

        return $transaksis;
    }

    private function setSelect(){
        $detailKegiatan= DB::table('detail_kegiatan')
            ->join('detail','detail.id_detail','=','detail_kegiatan.id_detail')
            ->where('id_kegiatan',$this->parameter->id_kegiatan)
            ->get('detail.nama_detail')->pluck('nama_detail');

        $select = $detailKegiatan->map(function ($value){
            if($value=='id_kegiatan') return 'kegiatan.nama_kegiatan';
            return 'transaksi.'.$value;
        });

        
        return $select->toArray();

    }
}