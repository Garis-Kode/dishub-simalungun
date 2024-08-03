<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AdministrativeAreaImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:administrative-area';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import administrative area';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::unprepared(file_get_contents(resource_path('data/administrative_area.sql')));
            $this->info('administrative area has been imported successfully');
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
