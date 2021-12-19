@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      @if(\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
      </div>
      @endif

      @if(\Session::has('success'))
      <div class="alert alert-success">
        <div>{{Session::get('success')}}</div>
      </div>
      @endif


      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>
              NIM
            </th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Nomor HP</th>
            <th>Status Magang</th>
          </tr>
        </thead>

        <tbody>

          @foreach ($magang as $key=>$value)

          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->mhs->user->nomor_induk}}</td>
            <td>{{$value->mhs->nama}}</td>
            <td>{{$value->mhs->alamat}}</td>
            <td>Reguler {{strtoupper($value->mhs->kelas)}}</td>

            <td>{{strtoupper($value->mhs->prodi->nama)}}</td>
            <td>{{$value->mhs->nomor_hp}}</td>
            <td>
              @php
              $status = $value->status_pengajuan;
              @endphp

              @if($status == 'proses')
              <span class="badge badge-info">{{strtoupper($status)}}</span>
              @elseif($status == 'ditolak')
              <span class="badge badge-warning">{{strtoupper($status)}}</span>
              @elseif($status == 'diterima')
              <span class="badge badge-primary">{{strtoupper($status)}}</span>
              @elseif($status == 'selesai')
              <span class="badge badge-success">{{strtoupper($status)}}</span>
              @elseif($status == 'gagal')
              <span class="badge badge-danger">{{strtoupper($status)}}</span>
              @endif
            </td>

          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->


@endsection