<?php

namespace App\Console\Commands;

use App\Components\JuHe\Exp\ExpManager;
use Illuminate\Console\Command;

class TestJuHeExp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testJuHeExp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $result = ExpManager::com();

        echo "result:" . json_encode($result);
    }
}
