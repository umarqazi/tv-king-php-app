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
use App\Services\TrickService;
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
        $this->createTags(50);
        $this->createCustomers();
        $this->createBrands();
    }

    /**
     * @param int $count
     */
    private function createTags($maxCount = 10){
        $count = Tag::query()->count();
        VarDumper::dump('Tag Count :: ' . $count);
        if($count > 10){
            VarDumper::dump('Tag count is good');
            return;
        }
        for($i = 0; $i< $maxCount; $i++){
            $request = new CreatorForm();
            $request->name = $this->faker->name;
            $service = new TagService();
            $tag = $service->persist($request);
            VarDumper::dump("Tag :: {$request->name}, ID :: {$tag->id}");
        }
    }

    /**
     * @param $emailTpls
     * @param $user_type
     */
    private function createUsers($emailTpls, $user_type){
        foreach ($emailTpls as $idx => $tpl){
            for($b = 0; $b < $tpl['count']; $b++){
                $emails[] = strtr( $tpl['email'], [
                    '{counter}' => $b+1
                ]);
            }
        }
        $faker = Factory::create();
        foreach ($emails as $key => $email) {
            VarDumper::dump('Creating Brand ' . $email);
            $user = User::where("email", "=", $email)->first();
            if ($user == null) {
                $user = new User();
                $user->first_name = $this->faker->firstName;
                $user->last_name = $this->faker->lastName;
                $user->email = $email;
                $user->user_type = $user_type;
                $user->password = Hash::make('abc123');
                $user->save();

                $this->createChallenges($user->id, 15);
            }
        }
    }

    private function createBrands($count = 3)
    {
        VarDumper::dump('Creating Brands');
        $emailsTpl = [
            ['email' => 'fahad.shehzad+b{counter}@gems.techverx.com', 'count' => 10],
            ['email' => 'fahad.shehzad+b{counter}_19@gems.techverx.com', 'count' => 10],
            ['email' => 'fahad.shehzad+b{counter}_18@gems.techverx.com', 'count' => 10],
            ];
        $this->createUsers($emailsTpl, IUserType::BRAND);
    }

    private function createCustomers($count = 3)
    {
        VarDumper::dump('Creating Customers...');
        $emailsTpl = [
            ['email' => 'fahad.shehzad+c{counter}@gems.techverx.com', 'count' => 10],
            ['email' => 'fahad.shehzad+c{counter}_19@gems.techverx.com', 'count' => 10],
            ['email' => 'fahad.shehzad+c{counter}_18@gems.techverx.com', 'count' => 10],
            ];
        $this->createUsers($emailsTpl, IUserType::CUSTOMER);
    }

    /**
     * @param $brand_id
     * @param int $count
     */
    private function createChallenges ($brand_id, $count = 3){
        VarDumper::dump('Creating Challanges for Brand ' . $brand_id);
        for($i = 0; $i< $count; $i++){
            $this->createChallange($brand_id);
        }
    }

    private function random_tags($count = 3){
        $records = Tag::all()->pluck('name', 'id');
        $rand = $this->faker->randomElements(array_keys($records->toArray()), min($records->count(), 4));
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
            $challenge = $service->persist($form);

            $customers = $this->randomCustomers(10);
            foreach ($customers as $idx => $customer_id){
                $this->submitTrick($customer_id, $challenge->id);
            }
        }else{
            VarDumper::dump($form->errors());
        }
    }

    private function randomCustomers($count = 5){
        $query = User::query();
        $query->where('user_type', '=', IUserType::CUSTOMER);
        $records = $query->pluck('id', 'id');
        $rand = $this->faker->randomElements(array_keys($records->toArray()), min($records->count(), $count));
        return array_combine(array_values($rand), array_values($rand));
    }

    private function submitTrick($customer_id, $challenge_id){
        $form = new \App\Forms\Trick\CreatorForm();
        $form->challenge_id = $challenge_id;
        $form->customer_id = $customer_id;
        $form->description = $this->faker->sentence;

        $service = new TrickService();
        $service->persist($form);

    }

}
