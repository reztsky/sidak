<?php
namespace App\Services\Transaksi;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Storage;

class UploadFotoService{

    public $foto,$id_transaksi,$transaksi;

    public function __construct($foto,$id_transaksi)
    {
        $this->foto=$foto;
        $this->id_transaksi=$id_transaksi;
        $this->transaksi();
    }

    public function upload(){
        $this->isFotoExistBefore();
        $filename=$this->foto->getClientOriginalName();
        $this->foto->storeAs('public/foto',$filename);
        return $filename;
    }

    private function transaksi(){
        $this->transaksi=Transaksi::where('id_transaksi',$this->id_transaksi)->get()->first();
    }

    private function isFotoExistBefore(){
        if(Storage::exists('public/foto/'.$this->transaksi->foto)){
            Storage::delete('public/foto/'.$this->transaksi->foto);
        }
    }
    
}