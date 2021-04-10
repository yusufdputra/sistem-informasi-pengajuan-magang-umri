@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">

      <h5 class="m-b-30"><b>Edit Agenda</b></h5>
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

      <form method="POST" action="{{route('agenda.update')}}" enctype="multipart/form-data" class="form-horizontal group-border-dashed row">
        @csrf
        <div class="col-6">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nomor Surat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$agenda['nomor_surat']}}" name="nomor_surat" required placeholder="ex:812/A12/2021" />
            </div>
          </div>

          <input type="hidden" name="id" value="{{$agenda['id']}}">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Hari/Tanggal</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control" value="{{date('l, d-F-Y', strtotime($agenda['tanggal']))}}" required autocomplete="off" placeholder="dd/mm/yyyy" name="tanggal" id="datepicker-autoclose">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-calendar"></i></span>
                </div>
              </div><!-- input-group -->
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jam</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" id="" required class="timepicker2 form-control" value="{{$agenda['jam']}}" placeholder="hh/mm" name="jam">
                <div class="input-group-append">
                  <span class="input-group-text">s/d</span>
                </div>
                <input type="text" id="timepicker" required class=" form-control" value="{{$agenda['jam2']}}" placeholder="hh/mm" name="jam2">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fa fa-clock-o"></i></span>
                </div>
              </div><!-- input-group -->

            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tempat</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$agenda['tempat']}}" required name="tempat" placeholder="Tempat" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-8">
              <textarea required name="keterangan" required class="form-control">{{$agenda['keterangan']}}</textarea>
            </div>
          </div>

        </div>

        <div class="col-6">

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis Agenda</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$agenda['jenis_agenda']}}" required name="jenis_agenda" required placeholder="Jenis Agenda" />
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tujuan</label>
            <div class="col-sm-3">
              <div class="custom-control custom-radio">
                <input type="hidden" id="data_pegawai" value="{{$pegawai}}">
                <input type="radio" id="customRadio1" required value="tujuan_orang" name="jenis_tujuan" class="custom-control-input">
                <label class="custom-control-label" for="customRadio1">1 Orang </label>
              </div>
              <div class="custom-control custom-radio">
                <input type="hidden" id="data_bidang" value="{{$bidang}}">
                <input type="radio" id="customRadio2" value="tujuan_bidang" name="jenis_tujuan" class="custom-control-input">
                <label class="custom-control-label" for="customRadio2">Per Bidang</label>
              </div>
            </div>

            <div class="col-sm-5">
              <!-- nama orang -->
              <select class="custom-select select2" id="select_tujuan" name="tujuan">
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">File Surat</label>
            <div class="col-sm-8">
              <p class="text-muted">Format (PDF )</p>
              <input type="hidden" name="file_already" value="{{$agenda['file_upload']}}">
              <input type="file" data-height="100" class="dropify" name="file_upload" accept=".pdf" data-max-file-size="5M" />
              @error('file_upload')
              <div class="text-danger mt-2">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>


          <div class="form-group row">
            <div class="offset-sm-3 col-sm-9 m-t-15">
              <button type="submit" class="btn btn-primary waves-effect waves-light">
                Submit
              </button>
              <button onclick="history.back()" type="reset" class="btn btn-secondary waves-effect m-l-5">
                Cancel
              </button>
            </div>
          </div>
        </div>
      </form>
    </div><!-- end col -->

  </div><!-- end col -->
</div><!-- end row -->

<script type="text/javascript">
  $(document).ready(function() {


    $('input[type=radio][name=jenis_tujuan]').change(function() {
      var data_tujuan = []
      $('#select_tujuan').html('')
      if (this.value == 'tujuan_orang') {
        data_tujuan = null
        data_tujuan = document.getElementById('data_pegawai').value

      } else if (this.value == 'tujuan_bidang') {
        data_tujuan = null
        data_tujuan = document.getElementById('data_bidang').value
      }
      data_tujuan = JSON.parse(data_tujuan)
      for (let i = 0; i < data_tujuan.length; i++) {
        const id = data_tujuan[i]['id']
        const name = data_tujuan[i]['name']
        console.log(id);
        var o = new Option(name, id);
        $(o).html(name)
        $('#select_tujuan').append(o)
      }

    });

  })
</script>
@endsection