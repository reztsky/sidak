@extends('layout')
@section('link-olah-data','active')

@section('content')
    <div class="row my-3">
        <div class="col-md-5 col-12">
            <div class="bg-white border border-2 shadow-sm p-3 rounded-3">
                <dl class="row">
                    @foreach ($transaksi as $key=>$value)
                        @continue($key=='id_transaksi')
                        @continue($key=='id_kegiatan')
                        @if ($key=='foto')
                            <dt class="col-md-4 col-sm-12 col-12">{{Str::title(str_replace('_',' ',$key))}}</dt>
                            <dd class="col-md-8 col-sm-12 col-12">
                                <img src="{{asset('storage/foto/'.$value)}}" alt="" class="img-thumbnail" height="150px">
                            </dd>    
                        @else
                            <dt class="col-md-4 col-sm-12 col-12">{{Str::title(str_replace('_',' ',$key))}}</dt>
                            <dd class="col-md-8 col-sm-12 col-12">{{$value}}</dd>
                        @endif
                    @endforeach
                </dl>
            </div>
        </div>
        <div class="col-md-7 col-12">
            <div class="bg-white border border-2 shadow-sm p-3 rounded-3">
                <form action="{{route('olahData.uploadFoto',request('id'))}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-2">
                                <label for="" class="form-label">Foto</label>
                                <input type="file" name="foto" id="" class="form-control">
                                <div class="form-text">
                                    Ukuran Foto Maksimal 2MB
                                </div>
                                @error('foto')
                                    <div class="form-text text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary btn-sm">Upload</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
      
    </script>
@endpush