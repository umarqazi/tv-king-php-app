<?php

namespace App\Console\Commands;

use App\Http\Requests\ChallengeRequest;
use App\Http\Requests\UserSignup;
use App\Services\BrandService;
use App\Services\ChallengeService;
use App\Services\SignupService;
use App\Services\TagService;
use App\Forms\Tag\CreatorForm;
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

        $this->createTags(50);

        try
        {
            $request = new CreatorForm();
            $request->name = "";
            $service = new TagService();
            $tag = $service->persist($request);
        }catch (ValidationException $exception){
            VarDumper::dump($exception->errors());
        }
    }

    /**
     * @param int $count
     */
    private function createTags($count = 10){
        $faker = Factory::create();

        for($i = 0; $i< $count; $i++){
            $request = new CreatorForm();
            $request->name = $faker->name;
            $service = new TagService();
            $tag = $service->persist($request);
            VarDumper::dump("Tag :: {$request->name}, ID :: {$tag->id}");
        }
    }

}
