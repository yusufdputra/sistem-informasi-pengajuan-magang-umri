@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      <div class="align-items-center row">
        @role('mahasiswa')
        <a href="{{route('pengajuanMagang.tambah')}}" class="btn btn-danger m-l-10 waves-light  mb-2">Kembali</a>
        @endrole
      </div>

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
      <form class="p-20" enctype="multipart/form-data" action="{{route('kuisioner.store')}}" method="POST">
        @csrf
        <input type="hidden" name="id_mahasiswa" value="{{$mhs['id']}}">

        <div class="form-row">
          <div class="form-group col-md-6">
            <label class=" col-form-label">Nama Lengkap</label>
            <input type="text" class="form-control" value="{{$mhs['nama']}}" name="nama" required placeholder="Ketikkan sesuatu..." />
          </div>
          <div class="form-group col-md-6">
            <label class=" col-form-label">NIM</label>
            <input type="text" value="{{$mhs->user['nomor_induk']}}" class="form-control" name="nim" required placeholder="Ketikkan sesuatu..." />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label class=" col-form-label">Bidang Peminatan Kompetensi PLP </label>
            <select required class="form-control" name="q_1">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[0] == '0' ? 'selected' : ''; ?> @endif>Teknik Komputer Jaringan - Pendidikan Informatika</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[0] == '1' ? 'selected' : ''; ?> @endif>Multimedia - Pendidikan Informatika</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[0] == '2' ? 'selected' : ''; ?> @endif>Rekayasa Perangkat Lunak - Pendidikan Informatika</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[0] == '3' ? 'selected' : ''; ?> @endif>Bahasa Inggris - Pendidikan Bahasa Inggris</option>
              <option value="4" @if($kuisioner !=null) <?= $jawaban[0] == '4' ? 'selected' : ''; ?> @endif>IPA SMP - Pendidikan IPA</option>
              <option value="5" @if($kuisioner !=null) <?= $jawaban[0] == '5' ? 'selected' : ''; ?> @endif>Teknik Audio Video - Pendidikan Vokasional Teknik Elektronik</option>
              <option value="6" @if($kuisioner !=null) <?= $jawaban[0] == '6' ? 'selected' : ''; ?> @endif>Teknik Elektronika - Pendidikan Vokasional Teknik Elektronik</option>
              <option value="7" @if($kuisioner !=null) <?= $jawaban[0] == '7' ? 'selected' : ''; ?> @endif>Elektronika Industri - Pendidikan Vokasional Teknik Elektronik</option>
              <option value="8" @if($kuisioner !=null) <?= $jawaban[0] == '8' ? 'selected' : ''; ?> @endif>Mekatronika - Pendidikan Vokasional Teknik Elektronik</option>
            </select>
          </div>

          <div class="form-group col-md-12">
            <label class=" col-form-label">Dengan ini saya bersedia mengikuti segala tahapan pelaksanaan PLP FKIP UMRI 2021 dan ditempatkan dimana saja sesuia dengan pertimbangan UP2KT FKIP UMRI</label>
            <select required class="form-control" name="q_2">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[1] == '0' ? 'selected' : ''; ?> @endif>Bersedia</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[1] == '1' ? 'selected' : ''; ?> @endif>Tidak Bersedia</option>
            </select>
          </div>
        </div>

        <div class="clearfix">
          <h4 class="text-danger mb-1">Jawablah beberapa pertanyaan/pernyataan berikut ini</h4>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label class=" col-form-label">Kemampuan saya dalam membuka pelajaran dan menutup pelajaran</label>
            <select required class="form-control" name="q_3">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[2] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[2] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[2] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[2] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label class=" col-form-label">Kemampuan saya dalam memberikan pertanyaan</label>
            <select required class="form-control" name="q_4">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[3] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[3] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[3] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[3] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="col-form-label">Kemampuan saya memberikan penguatan</label>
            <select required class="form-control" name="q_5">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[4] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[4] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[4] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[4] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label class="col-form-label">Kemampuan saya mengadakan variasi</label>
            <select required class="form-control" name="q_6">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[5] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[5] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[5] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[5] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
            <label class="col-form-label">Kemampuan saya dalam menjelaskan</label>
            <select required class="form-control" name="q_7">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[6] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[6] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[6] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[6] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label class=" col-form-label">Kemampuan saya dalam membimbing diskusi kelompok kecil</label>
            <select required class="form-control" name="q_8">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[7] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[7] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[7] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[7] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label class="col-form-label">Kemampuan saya dalam mengelola kelas</label>
            <select required class="form-control" name="q_9">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[8] == '0' ? 'selected' : ''; ?> @endif>Sangat Baik</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[8] == '1' ? 'selected' : ''; ?> @endif>Baik</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[8] == '2' ? 'selected' : ''; ?> @endif>Cukup</option>
              <option value="3" @if($kuisioner !=null) <?= $jawaban[8] == '3' ? 'selected' : ''; ?> @endif>Kurang Baik</option>
            </select>
          </div>
        </div>

        <div class="form-row">

          <div class="form-group col-md-12">
            <label class="col-12 col-form-label">Jika ditemukan dalam kelas saat proses belajar mengajar berlangsung terdapat 2 orang siswa/i sedang asik bercerita dan kelas dalamkeadaan ribut. Maka keterampilan yang diperlukan adalah</label>
            <select required class="form-control" name="q_10">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[9] == '0' ? 'selected' : ''; ?> @endif>Memberi penguatan</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[9] == '1' ? 'selected' : ''; ?> @endif>Membuka Dan menutup pelajaran</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[9] == '2' ? 'selected' : ''; ?> @endif>mengelola kelas</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label class="col-12 col-form-label">Jika ditemukan dalam kelas saat proses belajar mengajar berlangsung terdapat siswa/i sangat baik responnya dan mampu menjawab pertanyaan yang di ajukan oleh guru, maka sebagai seorang guru keterampilan yang diperlukan saat itu adalah</label>
            <select required class="form-control" name="q_11">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[10] == '0' ? 'selected' : ''; ?> @endif>Memberi penguatan</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[10] == '1' ? 'selected' : ''; ?> @endif>Mengelola Kelas</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[10] == '2' ? 'selected' : ''; ?> @endif>Memberikan Variasi</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label class="col-12 col-form-label">Jika ditemukan dalam kelas saat proses belajar mengajar berlangsung terdapat siswa/i yang terlihat belum fokus maka sebagai seorang guru keterampilan yang diperlukan saat itu adalah</label>
            <select required class="form-control" name="q_12">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[11] == '0' ? 'selected' : ''; ?> @endif>Mengajukan pertanyaan</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[11] == '1' ? 'selected' : ''; ?> @endif>Membuka pelajaran</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[11] == '2' ? 'selected' : ''; ?> @endif>Memberikan Variasi</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label class="col-12 col-form-label">Jika ditemukan dalam kelas saat proses belajar mengajar berlangsung terdapat siswa/i dalam keadaan tidak kondusif dan siswa terlihat tidak tertarik dalam belajar, maka sebagai seorang guru keterampilan yang diperlukan saat itu adalah</label>
            <select required class="form-control" name="q_13">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[12] == '0' ? 'selected' : ''; ?> @endif>Memberi penguatan</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[12] == '1' ? 'selected' : ''; ?> @endif>Menutup pelajaran</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[12] == '2' ? 'selected' : ''; ?> @endif>Memberikan Variasi</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label class="col-12 col-form-label">Jika ditemukan dalam kelas saat proses belajar mengajar berlangsung terdapat siswa/i dalam keadaan tidak kondusif dan siswa terlihat tidak tertarik dalam belajar, maka sebagai seorang guru keterampilan yang diperlukan saat itu adalah</label>
            <select required class="form-control" name="q_14">
              <option value="" selected disabled hidden>Silahkan Pilih</option>
              <option value="0" @if($kuisioner !=null) <?= $jawaban[13] == '0' ? 'selected' : ''; ?> @endif>Memberi penguatan</option>
              <option value="1" @if($kuisioner !=null) <?= $jawaban[13] == '1' ? 'selected' : ''; ?> @endif>Menutup pelajaran</option>
              <option value="2" @if($kuisioner !=null) <?= $jawaban[13] == '2' ? 'selected' : ''; ?> @endif>Memberikan Variasi</option>
            </select>
          </div>

          @role('mahasiswa')

          <div class="form-group col-md-12">
            <div class=" m-t-15">
              <button type="submit" class="btn btn-primary waves-effect waves-light">
                Submit
              </button>
            </div>
          </div>
          @endrole

        </div>
    </div><!-- end row -->
    </form>

  </div>
</div>

@endsection