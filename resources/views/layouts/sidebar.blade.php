<div class="left side-menu">
  <div class="sidebar-inner slimscrollleft">

    <!-- User -->
    <div class="user-box">
      <div class="user-img">
        @if(Auth::user()->foto_path == null)
        <a href="#foto-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"><img src="{{asset('adminto/images/users/avatar-1.jpg')}}" alt="user-img" title="" class="rounded-circle img-thumbnail img-responsive"></a>
        @else
        <a href="#foto-modal" data-animation="sign" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a"><img src="storage/{{(Auth::user()->foto_path)}}" alt="user-img" title="" class="rounded-circle img-thumbnail img-responsive"></a>
        @endif
      </div>
      <ul class="list-inline">
        @if ($errors->any())
        <div class="p-2">

          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif

        <!-- get nama user login -->
        @role('mahasiswa')
        @php
        $user = App\Models\Mahasiswa::where('id_user', Auth::user()->id)->first()
        @endphp
        <h5><a href="#"> {{ $user->nama }}</a> </h5>
        @endrole

        @role('dosen')
        @php
        $user = App\Models\Dosen::where('id_user', Auth::user()->id)->first()
        @endphp
        <h5><a href="#"> {{ $user->nama }}</a> </h5>
        @endrole

        @role('dekan')
        @php
        $user = App\Models\Dekan::where('id_user', Auth::user()->id)->first()
        @endphp
        <h5><a href="#"> {{ $user->nama }}</a> </h5>
        @endrole

        @role('admin')
        <h5><a href="#"> ADMIN</a> </h5>
        @endrole
        <li class="list-inline-item">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </div>

    <!-- End User -->

    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <ul>
        <li class="text-muted menu-title">Navigation</li>
        <li>
          <a href="{{('/')}}" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
        </li>
        @role('admin')

        <li class="has_sub">
          <a href="javascript:void(0);" class="waves-effect"><i class=" mdi mdi-account-multiple"></i> <span> User Management </span> <span class="fa menu-arrow"></span></a>
          <ul class=" list-unstyled">
            <li><a href="{{route ('user.index', 'mahasiswa')}}">Mahasiswa</a></li>
            <li><a href="{{route ('user.index', 'dosen')}}">Dosen</a></li>
            <li><a href="{{route ('user.index', 'dekan')}}">Dekan</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route ('periode.index')}}" class="waves-effect"><i class="fa fa-calendar"></i> <span> Periode PLP </span> </a>
        </li>

        <li>
          <a href="{{route ('prodi.index')}}" class="waves-effect"><i class="fa fa-server"></i> <span> Program Studi </span> </a>
        </li>

        <li>
          <a href="{{route ('pengajuanMagang.index')}}" class="waves-effect"><i class="fa fa-address-card-o"></i> <span> Pengajuan PLP </span> </a>
        </li>

        <li>
          <a href="{{route ('sekolah.index')}}" class="waves-effect"><i class="fa fa-building-o"></i> <span> Data Sekolah </span> </a>
        </li>

        <li>
          <a href="{{route ('riwayat.index')}}" class="waves-effect"><i class="fa fa-history"></i> <span> Arsip PLP </span> </a>
        </li>

        @endrole


        @role('mahasiswa')
        <li>
          <a href="{{route ('pengajuanMagang.index')}}" class="waves-effect"><i class="fa fa-address-card-o"></i> <span> PLP </span> </a>
        </li>
        @endrole

        @role('dekan')
        <li>
          <a href="{{route ('mahasiswaData.index')}}" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Data Mahasiswa </span> </a>
        </li>
        @endrole

        @role('dosen')
        <li>
          <a href="{{route ('mahasiswa.index')}}" class="waves-effect"><i class="fa fa-group "></i> <span> Mahasiswa Bimbingan </span> </a>
        </li>

        <li>
          <a href="{{route ('riwayat.index')}}" class="waves-effect"><i class="fa fa-history"></i> <span> Arsip PLP </span> </a>
        </li>
        @endrole


      </ul>
      <div class="clearfix"></div>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>

  </div>

</div>
<!-- Left Sidebar End -->
<div id="foto-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Ubah Foto Profil</h4>
    </div>
    <div class="text-left">
      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('foto_profil.store')}}" method="POST">
        @csrf

        <input type="hidden" name="file_lama" value="{{Auth::user()->foto_path}}" id="">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Foto</label>
          <div class="col-sm-9">
            <input type="file" accept="image/*" required data-plugins="dropify" name="file_foto" data-max-file-size="2M" />
          </div>
        </div>




        <div class="modal-footer">
          <button type="button" onclick="Custombox.close();" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah</button>
        </div>


      </form>

    </div>
  </div>

</div>


<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container-fluid">


    </div> <!-- container -->

  </div> <!-- content -->

  <footer class="footer text-right">
    2021 - FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN UMRI
  </footer>

</div>