<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kuisioner;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Periode;
use App\Models\Prodi;
use App\Models\Sekolah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanMagangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Pengajuan PLP";
        // get status daftar periode saat ini
        $status_daftar = Periode::where('mulai_daftar', '<=', Carbon::now())
            ->where('akhir_daftar', '>=', Carbon::now())
            ->first();

        // get status magang periode saat ini
        $status_magang = PeriodeController::cekPeriode();

        if (Auth::user()->roles[0]['name'] == 'mahasiswa') {
            // dapatkan id mahasiswa
            $id_mhs = Mahasiswa::select('id')->where('id_user', Auth::user()->id)->first();
            // dapatkan data magang user mahasiswa
            $pengajuan = Magang::with('mhs', 'dsn', 'sekolah')
                ->where('id_mahasiswa', $id_mhs->id)
                ->orderBy('updated_at', 'DESC')
                ->get();
            
            
            // cek apakah ada pengajuan yang telah selesai pada semua periode
            $jml_mg = Magang::where('id_mahasiswa', $id_mhs->id)
            ->where('status_pengajuan', 'selesai')
            ->count();

            if ($jml_mg > 0) {
                $status = $jml_mg;
            }else{
                $status = null;
            }
            
            // cek apakah sudah ada pengajuan di periode ini
            if ($status == null && ($status_daftar) != null) {
                $status = Magang::where('id_mahasiswa', $id_mhs->id)
                    ->where('id_periode', $status_daftar['id'])
                    ->first();
                // dd($status_daftar);
                // ->whereBetween('created_at', [$status_daftar['mulai_daftar'], $status_daftar['akhir_daftar']])->first();
            }

           
            // dd($status);
            return view('umum.pengajuan.index', compact('title', 'pengajuan', 'status_daftar', 'status_magang', 'status'));
        }
        if (Auth::user()->roles[0]['name'] == 'admin') {
            $pengajuan = Magang::with('mhs', 'dsn', 'sekolah')
                ->where('status_pengajuan', '!=', 'selesai')
                ->orderBy('updated_at', 'DESC')
                ->get();
            return view('umum.pengajuan.index', compact('title', 'pengajuan', 'status_daftar', 'status_magang'));
        }
    }

    public function tambah()
    {
        $title = "Pengajuan PLP Baru";
        $dosen = Dosen::where('status', 'ON')->get();
        $prodi = Prodi::all();
        $mhs = Mahasiswa::with('user')->where('id_user', Auth::user()->id)->first();
        // get status daftar periode saat ini
        $periode = PeriodeController::cekPeriode();
        $pengajuan = null;
        // cek apakah kuisioner sudah terisi atau belum
        $kuisioner = Kuisioner::where('id_mahasiswa', $mhs->id)->first();
        if ($periode != null) {
            return view('mahasiswa.pengajuan.form', compact('title', 'pengajuan', 'dosen', 'prodi', 'mhs', 'periode', 'kuisioner'));
        } else {
            return redirect()->back()->with('alert', 'Waktu pendaftaran ditutup.');
        }
    }

    public function store(Request $request)
    {

        //cek apakah ada pengajuan yang masih di proses
        $validasi = Magang::where('id_mahasiswa', $request->id_mahasiswa)
            ->where('status_pengajuan', 'proses')
            ->first();
        if ($validasi != null) {
            return redirect()->back()->with('alert', 'Sudah ada pengajuan yang sedang di proses.');
        }

        try {
            // jika file sebelumnya ada dan tidak ada upload file baru
            if ($request->url_transkrip_lama != null && $request->trankrip == null) {
                $file_path =  $request->url_transkrip_lama;
            }

            // jika file sebelumnya ada dan ada upload baru
            else if ($request->trankrip != null) {
                if ($request->url_transkrip_lama != null) {
                    // hapus file yg lama
                    unlink(storage_path('app/public/' . $request->url_transkrip_lama));
                }
                // upload file baru
                $file = $request->file('trankrip');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file_path = $file->storeAs('uploads', $file_name, 'public');
                $file_path = $file_path;
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'Pengajuan PLP gagal dikirim. Terjadi kesalahan saat upload file.');
        }

        $where = [
            'id' => $request->id_pengajuan
        ];

        $nilai_matkul = [
            $request->nilai_matkul_1,
            $request->nilai_matkul_2,
            $request->nilai_matkul_3
        ];

        $values = [
            'id_mahasiswa'          => $request->id_mahasiswa,
            'nilai_matkul'          => serialize($nilai_matkul),
            'url_transkrip'         => $file_path,
            'ipk'                   => $request->ipk,
            'id_periode'            => $request->id_periode,
            'status_pengajuan'      => 'proses',
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now(),
        ];
        $query = Magang::updateOrInsert($where, $values);

        if ($query) {
            return redirect()->route('pengajuanMagang.index')->with('success', 'Pengajuan berhasil dikirim');
        } else {
            return redirect()->back()->with('alert', 'Pengajuan PLP gagal dikirim');
        }
    }

    public function getPengajuanById($id)
    {
        return Magang::find($id);
    }

    public function detail($id)
    {
        $title = "Detail Pengajuan";
        $pengajuan = Magang::where('id', $id)->with('mhs', 'dsn')->first();
        $dosen = Dosen::where('status', 'ON')->get();


        // extract array nilai matkul
        $nilai_matkul = unserialize($pengajuan['nilai_matkul']);
        if (Auth::user()->roles[0]['name'] == 'admin') {
            $sekolah = Sekolah::all();
            return view('admin.pengajuan.detail', compact('title', 'pengajuan', 'dosen', 'nilai_matkul', 'sekolah'));
        }
        if (Auth::user()->roles[0]['name'] == 'mahasiswa') {
            $prodi = Prodi::all();
            $mhs = Mahasiswa::with('user')->where('id_user', Auth::user()->id)->first();
            // get status daftar periode saat ini
            $periode = PeriodeController::cekPeriode();
            return view('mahasiswa.pengajuan.form', compact('title', 'pengajuan', 'dosen', 'mhs', 'periode', 'prodi', 'nilai_matkul'));
        }
    }

    public function proses(Request $request)
    {
        $query = Magang::where('id', $request->id_pengajuan)
            ->update([
                'status_pengajuan'  => $request->proses,
                'id_dosen'     => $request->id_dosen,
                'id_sekolah'     => $request->id_sekolah,
                'keterangan_status' => $request->keterangan
            ]);

        if ($query) {
            return redirect()->route('pengajuanMagang.index')->with('success', 'Pengajuan berhasil diproses');
        } else {
            return redirect()->back()->with('alert', 'Terjadi Kesalahan!');
        }
    }

    public function uploadLaporan(Request $request)
    {
        $query = Magang::where('id', $request->id_pengajuan)
            ->update([
                'status_pengajuan'  => 'selesai',
                'url_laporan' => $request->url_laporan
            ]);

        if ($query) {
            return redirect()->back()->with('success', 'Laporan berhasil diupload');
        } else {
            return redirect()->back()->with('alert', 'Laporan gagal diupload');
        }
    }

    public function getDosenRekomendasi($id_sekolah)
    {
        // get status daftar periode saat ini
        $periode = PeriodeController::cekPeriode();

        $jml_magang = Magang::where('id_sekolah', $id_sekolah)
            ->where('id_periode', $periode['id'])
            ->count();

        $dosen = Magang::with('dsn')
            ->where('id_sekolah', $id_sekolah)
            ->where('id_periode', $periode->id)
            ->where('id_dosen', '!=', null)
            ->first();

        $dosen_kosong = null;
        if ($dosen == null) {
            $terpakai = Magang::select('id_dosen')
                ->where('id_dosen', '!=', null)
                ->where('id_periode', $periode->id)
                ->groupBy('id_dosen')
                ->get();

            $dosen_kosong = Dosen::whereNotIn('id', $terpakai)->get();
        }

        return compact('jml_magang', 'dosen','dosen_kosong');
    }

    public function getJumlahBimbingan($id_dosen)
    {
        $periode = PeriodeController::cekPeriode();
        return Magang::where('id_dosen', $id_dosen)
            ->where('id_periode', $periode['id'])
            ->count();
    }
}
