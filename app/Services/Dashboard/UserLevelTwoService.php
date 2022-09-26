<?php
namespace App\Services\Dashboard;

use Illuminate\Support\Facades\DB;

class UserLevelTwoService{
    
    public static function dashboard(){
        $result=collect([]);
        $queryResult=self::queryDB();
        
        $queryResult->each(function($item,$key) use($result){

            $checkKegiatan=$result->filter(function($data,$key) use($item){
                return $data['id_kegiatan']==$item->id_kegiatan;
            });

            
            if(count($checkKegiatan)==0){
                $result->push([
                    'id_kegiatan'=>$item->id_kegiatan,
                    'jabatan_user'=>$item->jabatan_user,
                    'nama_kegiatan'=>$item->nama_kegiatan,
                    'details'=>collect([$item->bulan=>$item->jumlah]),
                ]);
                
                return true;
            }

            $arrayFromCheckKegiatan=$checkKegiatan->pop();
            $arrayFromCheckKegiatan['details']->put($item->bulan,$item->jumlah);
            return true;
        });
      
        return $result;
    }

    private static function queryDB(){
        $result= DB::table('kegiatan')
                ->select([
                    'kegiatan.id_kegiatan',
                    'user.jabatan_user',
                    'kegiatan.nama_kegiatan',
                    'transaksi.bulan'
                ])
                ->selectRaw('count(*) as jumlah')
                ->leftJoin('transaksi',function($query){
                    $query->on('kegiatan.id_kegiatan','=','transaksi.id_kegiatan')
                        ->where('transaksi.tahun','=',date('Y'));
                })
                ->leftJoin('user','user.id','=','kegiatan.id_user')
                ->where('user.level_user','=','2')
                ->groupBy([
                    'user.jabatan_user',
                    'kegiatan.nama_kegiatan',
                    'kegiatan.id_kegiatan',
                    'transaksi.bulan'
                ])
                ->orderBy('kegiatan.id_kegiatan')
                ->get();
        
        return $result;
    }
}