<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $path_user=File::get(public_path('sql/add_user.sql'));
        // dd($path_user);
      
        DB::statement($path_user) ;
        
        $path_mahasiswa=File::get(public_path('sql/add_mahasiswa.sql'));
        // $sql_mahasiswa=file_get_contents($path_mahasiswa);
        DB::unprepared($path_mahasiswa);

    }
}
