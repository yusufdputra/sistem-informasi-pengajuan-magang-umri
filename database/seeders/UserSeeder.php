<?php

namespace Database\Seeders;

use App\Models\Dekan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::create([
        //     'nomor_induk' => 'admin1234',
        //     'email' => 'admin1234',
        //     'password' => bcrypt('admin1234')
        // ]);

        // $admin->assignRole('admin');

      

        // $user->assignRole('pegawai');

        
        $user = new User();
        $user->nomor_induk = '11651121';
        $user->email = 'dekan';
        $user->password = bcrypt('dekan1234');
        $user->save();
        //tambah ke role
        $user->assignRole('dekan');
        // simpan ke warga
        $mhs = Dekan::insert([
            'id_user' => $user->id,
            'nama' => 'Edi Ismanto, S.T, M.Kom',
            'created_at' => Carbon::now(),
        ]);

    }
}
