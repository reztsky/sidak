<?php
namespace App\Services\Transaksi;

use App\Models\Transaksi;

class UpdateFotoService{

    public $foto,$id_transaksi,$transaksi;

    public function __construct($foto,$id_transaksi)
    {
        $this->foto=$foto;
        $this->id_transaksi=$id_transaksi;
        $this->transaksi();
    }

    public function update(){
       $filename=(new UploadFotoService($this->foto,$this->id_transaksi))->upload();
       Transaksi::where('id_transaksi',$this->id_transaksi)
        ->update(['foto'=>$filename]);
    }

    private function transaksi(){
        $this->transaksi=Transaksi::where('id_transaksi',$this->id_transaksi)->get()->first();
    }
    
}