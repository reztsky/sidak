@extends('layout')
@section('link-dashboard','active')

@section('content')
    <div class="row my-3">
        <div class="col-md-12 col-sm-12 col-12 mb-3">
            <div class="bg-white border-2 border shadow-sm p-3 rounded">
                <h5 class="h5 fw-bold">Dashboard</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th rowspan="2" class="text-center">Jabatan</th>
                                <th rowspan="2" class="text-center">Nama Kegiatan</th>
                                <th colspan="12" class="text-center">Bulan / {{date('Y')}}</th>
                            </tr>
                            <tr>
                                @foreach ($bulans as $bulan)
                                    <th class="text-center">{{$bulan}}</th>    
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dashboard as $row)
                                <tr>
                                    <td>{{$row['jabatan_user']}}</td>
                                    <td>{{$row['nama_kegiatan']}}</td>
                                    @foreach ($bulans as $bulan)
                                        @if (array_key_exists($bulan,$row['details']->toArray()))
                                        <td>
                                            <a href="{{route('olahData.index',[
                                                'id_kegiatan'=>$row['id_kegiatan'],
                                                'bulan'=>$bulan,
                                                'tahun'=>date("Y")
                                            ])}}">
                                            {{$row['details'][$bulan]}}
                                            </a>
                                        </td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
