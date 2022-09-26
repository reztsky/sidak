@extends('layout')
@section('link-olah-data','active')

@section('content')

    <div class="row my-3">
        <div class="col-md-6 col-12">
            <div class="bg-white border border-2 shadow-sm p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="h5 fw-bold p-0 m-0">Import Data</h5>
                    <a class="btn btn-primary btn-sm" id="btn-toggle" data-bs-toggle="collapse" href="#form-import" role="button" aria-expanded="false" aria-controls="collapseExample">Hide</a>
                </div>
                <hr class="my-2">
                <div class="collapse show" id="form-import">
                    <form action="{{route('olahData.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Pilih Kegiatan</label>
                                    <select name="id_kegiatan" id="" class="form-select">
                                        @foreach ($kegiatans as $kegiatan)
                                            <option value="{{$kegiatan->id_kegiatan}}">{{$kegiatan->nama_kegiatan}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kegiatan')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Bulan</label>
                                    <select name="bulan" id="" class="form-select">
                                        @foreach ($bulans as $bulan)
                                            <option value="{{$bulan}}">{{$bulan}}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">File Excel</label>
                                    <input type="file" name="excel" id="" class="form-control">
                                    <div class="form-text">
                                        <ul>
                                            <li>Format File Excel (.xls, .xlsx)</li>
                                            <li>Ukuran Maksimal Excel 2MB</li>
                                            <li>Untuk Tahun Wajib Diisi pada excel</li>
                                        </ul>
                                    </div>
                                    @error('excel')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn-success btn btn-sm">Import</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="col-md-12 col-12 mt-3">
            <div class="bg-white border border-2 shadow-sm p-3 rounded-3">
                <h5 class="h5 fw-bold">Lihat Data</h5>
                <hr class="my-2">
                <form action="{{route('olahData.index')}}">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-2">
                                <label for="" class="form-label">Pilih Kegiatan</label>
                                <select name="id_kegiatan" id="" class="form-select">
                                    @foreach ($kegiatans as $kegiatan)
                                        <option value="{{$kegiatan->id_kegiatan}}" @selected(request('id_kegiatan')==$kegiatan->id_kegiatan)>{{$kegiatan->nama_kegiatan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Bulan</label>
                                <select name="bulan" id="" class="form-select">
                                    @foreach ($bulans as $bulan)
                                        <option value="{{$bulan}}" @selected(request('bulan')==$bulan)>{{$bulan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Tahun</label>
                                <select name="tahun" id="" class="form-select">
                                    @foreach (range(date('Y'),2022) as $year)
                                        <option value="{{$year}}" @selected(request('tahun')==$year)>{{$year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{request('nama')}}">
                                <div class="form-text">*Besar Kecil Huruf Mempengaruhi</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn-primary btn btn-sm">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr class="my-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            @if (count($searchResult)>0)
                                @forelse ($searchResult->first() as $key=>$item)
                                    <th>{{Str::title(str_replace('_',' ',$key))}}</th>        
                                @empty
                                    <th>No Found Record</th>
                                @endforelse
                                <th>Aksi</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($searchResult as $row)
                                <tr>
                                    @foreach ($row as $key=>$item)
                                        @if ($key=='foto')
                                            <td>
                                                <img src="{{asset('storage/foto/'.$item)}}" alt="" class="img-thumbnail">
                                            </td>
                                        @else
                                            <td>{{$item}}</td>    
                                        @endif
                                        
                                    @endforeach
                                    <td><a class="btn btn-sm btn-danger" href="{{route('olahData.edit',$row->id_transaksi)}}">Foto</a></td>
                                </tr>
                            @empty
                                <tr><td align="center" class="fw-bold">No Found Record</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (count($searchResult)>0)
                    {{ $searchResult->links() }}
                @endif                
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var btnToggle = document.getElementById('btn-toggle')
        btnToggle.addEventListener('click',function(){
            btnToggle.innerHTML === "Hide" ? btnToggle.innerHTML='Show' : btnToggle.innerHTML='Hide'
        })
    </script>
@endpush