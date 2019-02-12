<?php

namespace App\Console\Commands;

use App\Services\BrandService;
use Illuminate\Console\Command;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $this->createBrand();
    }


    private function createBrand(){
        $request = new BrandRequest();
        $request->email = "umar.farooq@gems.techverx.com";
        $request->password = "abc123";

        $service = new BrandService();
        $brand = $service->persist($request);

    }
}
