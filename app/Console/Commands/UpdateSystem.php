<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\setting_system;
use Illuminate\Support\Facades\DB;

class UpdateSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Setting jika sudah mendekati tenggat waktu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $active= setting_system::all()->first();

        if($active->pemilihan_topik_dosen_tanggal <= date('Y-m-d')){
            DB::table('setting_system')
              ->where('id', $active->id)
              ->update(['pemilihan_topik_dosen' => 0]);   
        }
        else{
            DB::table('setting_system')
            ->where('id', $active->id)
            ->update(['pemilihan_topik_dosen' => 1]);
        }
        if($active->pemilihan_topik_mahasiswa_tanggal <= date('Y-m-d')){
            DB::table('setting_system')
              ->where('id', $active->id)
              ->update(['pemilihan_topik_mahasiswa' => 0]);
        }
        else{
            DB::table('setting_system')
            ->where('id', $active->id)
            ->update(['pemilihan_topik_mahasiswa' => 1]);
        }
        $this->info('Successfully Change Setting Daily.');
    }
}
