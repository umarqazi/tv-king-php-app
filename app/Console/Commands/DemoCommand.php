<?php

namespace App\Console\Commands;

use App\Http\Requests\ChallengeRequest;
use App\Http\Requests\UserSignup;
use App\Services\BrandService;
use App\Services\ChallengeService;
use App\Services\SignupService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:install';

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

        $request = new UserSignup();
        /** @var $request UserSignup */
        //$request->request->set('name', 'umar');
        $request->name = "umar";
        $request->email = "e@mail.com";
        $request->password = "abc123";

        $service = new SignupService();

        $saved = $service->persist2 ($request);

        dd([$saved]);
    }
}
