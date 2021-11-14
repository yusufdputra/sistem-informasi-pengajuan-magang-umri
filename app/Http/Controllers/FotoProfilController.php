<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FotoProfilController extends Controller
{
    public $target = 'profile';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        // validasi
        $rules = [
            'file_foto' => 'required|file|max:1024',
        ];
        $pesan = [
            'file_foto.max' => "File terlalu besar. Maksimal 2MB",
        ];
        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        

        $upload = FileController::cekFile($request->file('file_foto'), $request->file_lama, $request->has('file_lama'), $this->target);
        if ($upload != false) {
            $where = [
                'id' => Auth::user()->id
            ];

            $values = [
                'foto_path' => $upload,
                'updated_at'   => Carbon::now(),
            ];

            $query = User::updateOrInsert($where, $values);
           

            if ($query) {
                return redirect()->back()->with('success', 'Berhasil disimpan');
            } else {
                return redirect()->back()->with('alert', 'Gagal disimpan');
            }
        }
        return redirect()->back()->with('alert', 'Gagal disimpan');
    }
}
