<?php

namespace App\Console\Commands;

use App\Http\Requests\ChallengeRequest;
use App\Http\Requests\UserSignup;
use App\Models\Tag;
use App\Models\User;
use App\Services\BrandService;
use App\Services\ChallengeService;
use App\Services\IUserType;
use App\Services\SignupService;
use App\Services\TagService;
use App\Forms\Tag\CreatorForm;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
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
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->createChallenges(4, 3);
        //$this->createBrands();
       //$this->createTags(50);
    }

    /**
     * @param int $count
     */
    private function createTags($count = 10){
        for($i = 0; $i< $count; $i++){
            $request = new CreatorForm();
            $request->name = $this->faker->name;
            $service = new TagService();
            $tag = $service->persist($request);
            VarDumper::dump("Tag :: {$request->name}, ID :: {$tag->id}");
        }
    }


    private function createBrands($count = 3)
    {
        $emails = ['fahad.shehzad+b1@gems.techverx.com',
            'fahad.shehzad+b2@gems.techverx.com',
            'fahad.shehzad+b3@gems.techverx.com'];

        $faker = Factory::create();
        foreach ($emails as $key => $email) {
            $user = User::where("email", "=", $email)->first();
            if ($user == null) {
                $user = new User();
                $user->first_name = $this->faker->firstName;
                $user->last_name = $this->faker->lastName;
                $user->email = $email;
                $user->user_type = IUserType::BRAND;
                $user->password = Hash::make('abc123');
                $user->save();
            }
        }
    }

    /**
     * @param $brand_id
     * @param int $count
     */
    private function createChallenges ($brand_id, $count = 3){
        for($i = 0; $i< $count; $i++){
            $this->createChallange($brand_id);
        }
    }

    private function random_tags($count = 3){
        $tags = [];
        $tags = Tag::all()->pluck('name', 'id');
        $rand = $this->faker->randomElements(array_keys($tags->toArray()), min($tags->count(), 4));
        return array_combine(array_values($rand), array_values($rand));
    }

    /**
     * @param $brand_id
     */
    private function createChallange($brand_id){
        $tags = $this->random_tags(3);
        $form = new \App\Forms\Challenge\CreatorForm();
        $form->brand_id = $brand_id;
        $form->name = $this->faker->dateTime->format("F-Y") . ' Challenge';
        $form->description = $this->faker->sentence;
        $address = $this->faker->address;
        $form->location = $address;
        $form->latitude = $this->faker->latitude;
        $form->longitude = $this->faker->longitude;
        $form->tags = $tags;

        if($form->passes()){
            $service = new ChallengeService();
            $service->persist($form);
        }else{
            VarDumper::dump($form->errors());
        }
    }

}
