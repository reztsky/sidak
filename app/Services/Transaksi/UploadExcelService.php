<?php
namespace App\Services\Transaksi;

use Illuminate\Support\Facades\Storage;

class UploadExcelService{

    public function __construct(public $excel){}


    public function import(){
        $filename=$this->excel->getClientOriginalName();
        $this->checkIfFileExist($filename);
        $this->excel->storeAs('excel',$filename);
        return $filename;
    }

    private function checkIfFileExist($filename){
        if(Storage::exists('excel/'.$filename)){
            Storage::delete('excel/'.$filename);
        }
    }
}