<?php
namespace App\Services\Transaksi;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class FindTransaksiService{

    public $transaksi;
    public $id_kegiatan;

    public function __construct($id){
        $this->transaksi=Transaksi::where('id_transaksi',$id)->get();
        if(count($this->transaksi)==0) return abort(404,'No Found Record');

        $this->id_kegiatan=$this->transaksi->first()->id_kegiatan;
    }

    public function find(){
        return $this->transaksi->first()->only($this->setSelect());
    }

    private function setSelect(){
        $select = DB::table('detail_kegiatan')
            ->join('detail','detail.id_detail','=','detail_kegiatan.id_detail')
            ->where('id_kegiatan',$this->id_kegiatan)
            ->get('detail.nama_detail')->pluck('nama_detail');

        return $select->toArray();

    }
}