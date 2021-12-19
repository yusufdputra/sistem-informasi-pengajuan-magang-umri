<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Arsip PLP Mahasiswa";
        $user = Auth::user();
        $role = $user->roles[0]['name'];
        if ($role == 'admin' || $role == 'dekan') {
            $riwayat = Magang::with('mhs', 'dsn', 'sekolah')
            ->where('status_pengajuan', '=', 'selesai')
            ->where('nilai_pembimbing', '!=', NULL)
            ->orderBy('id_periode', 'DESC')
            ->get();
        }else if ($role == 'dosen') {
            $dosen = Dosen::select('id')->where('id_user', $user->id)->first();
            
            $riwayat = Magang::with('mhs', 'dsn', 'sekolah')
            ->where('id_dosen', $dosen->id)
            ->where('nilai_pembimbing', '!=', NULL)
            ->orderBy('id_periode', 'DESC')
            ->get();
        }
        
        return view('umum.riwayat.index', compact('title', 'riwayat'));
    }
}
