<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportExcelRequest;
use App\Models\Kegiatan;
use App\Services\BulanService;
use App\Services\SearchTransaksiService;
use App\Services\Transaksi\FindTransaksiService;
use App\Services\Transaksi\ImportExcelService;
use App\Services\Transaksi\UpdateFotoService;
use App\Services\Transaksi\UploadExcelService;
use Illuminate\Http\Request;

class OlahDataController extends Controller
{
    public function index(Request $request){
        $kegiatans=Kegiatan::kegiatans()->get();
        $bulans=BulanService::bulan();
        $searchResult=[];

        if($request->has(['bulan','id_kegiatan','tahun'])){
            $searchResult=(new SearchTransaksiService($request))->search();
        }

        return view('content.olahData.index',compact('kegiatans','bulans','searchResult'));
    }

    public function import(ImportExcelRequest $request){
        $excel=(new UploadExcelService($request->excel))->import();
        $insertTransaksi=(new ImportExcelService($excel,$request->id_kegiatan,$request->bulan))->import();
        
        if(in_array(false,$insertTransaksi->toArray())){
            return redirect()->route('olahData.index')->with('notifikasi','Gagal Mengimport Data');
        }
        
        return redirect()->route('olahData.index')->with('notifikasi','Sukses Mengimport Data');
    }

    public function search(Request $request){  
        $kegiatans=Kegiatan::kegiatans()->get();
        $bulans=BulanService::bulan();
        return view('content.olahData.index',compact('kegiatans','bulans','searchResult'));
    }

    public function edit($id){
        $transaksi=(new FindTransaksiService($id))->find();        
        return view('content.olahData.edit',compact('transaksi'));
    }

    public function upload(Request $request,$id){
        $validated=$request->validate([
            'foto'=>'max:2048|image',
        ]);
        $transaksi=(new UpdateFotoService($request->foto,$id))->update();

        return redirect()->route('olahData.index')->with('notifikasi','Sukses Menambahkan Foto');
    }
}
