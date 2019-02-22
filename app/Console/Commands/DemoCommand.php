<?php

namespace App\Console\Commands;

use App\Http\Requests\ChallengeRequest;
use App\Http\Requests\UserSignup;
use App\Services\BrandService;
use App\Services\ChallengeService;
use App\Services\SignupService;
use App\Services\TagService;
use App\Forms\Tag\TagCreatorForm;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Symfony\Component\VarDumper\VarDumper;

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
        $faker = Factory::create();
        $request = new TagCreatorForm();
        $request->name = $faker->name;

        if($request->passes()){
            $service = new TagService();
            $tag = $service->persist($request);
            VarDumper::dump("Tag :: {$request->name}, ID :: {$tag->id}");
        }else{
            VarDumper::dump('Fail to created Tag');
           // VarDumper::dump($request->errors());
        }

        try
        {
            $request = new TagCreatorForm();
            $request->name = "";
            $service = new TagService();
            $tag = $service->persist($request);
        }catch (ValidationException $exception){
            VarDumper::dump($exception->errors());
        }
    }

}
