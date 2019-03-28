<?php

namespace App\Console\Commands;

use App\Forms\Auth\ProfileForm;
use App\Forms\Challenge\WinnerForm;
use App\Models\Tag;
use App\Models\User;
use App\Services\BrandService;
use App\Services\ChallengeService;
use App\Services\IUserType;
use App\Services\ProfileService;
use App\Services\SignupService;
use App\Services\TagService;
use App\Forms\Tag\CreatorForm;
use App\Services\TrickService;
use App\Services\UserService;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
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
     * @var ProfileService
     */
    private $profileService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
        $this->profileService = App::make(ProfileService::class);
        $this->userService = App::make(UserService::class);
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
        //$customer = $this->randomCustomers(1);
        //$this->verifyProfile(Arr::first($customer)));
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
        $tagTemplates = ['Cricket', 'Super King', 'Fun Master', 'Action Game', 'SpeedorMeter',
            'Eye Opener', 'PSL#2019', 'Zalmi', 'Karachi Kings',
            'Extreme Sport', 'Swimmer', 'Standup Comedy', 'Git Workflow', 'Moment Capture',
            'Dare Challenges', 'Annual Trips', 'Life at Techverx', 'Project Delivery Celeberations',
            'Die Hard Efforts', 'Lahore Qalenders', 'Life of a Programmer', 'Sprite Challenge'];

        $service = new TagService();
        foreach ($tagTemplates as $key => $tagName){
            $existingTag = $service->findByName($tagName);
            if($existingTag == null ){
                $request = new CreatorForm();
                $request->name = $tagName;
                $tag = $service->persist($request);
                VarDumper::dump("Tag :: {$request->name}, ID :: {$tag->id}");
            }
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
        $createdUsers = [];
        foreach ($emails as $key => $email) {
            VarDumper::dump('Creating Users ' . $email);
            $user = User::where("email", "=", $email)->first();
            if ($user == null) {
                $user = new User();
                $user->first_name = $this->faker->firstName;
                $user->last_name = $this->faker->lastName;
                $user->email = $email;
                $user->user_type = $user_type;
                $user->password = Hash::make('abc123');
                $user->save();
            }
            $createdUsers[] = $user->id;
        }
        return $createdUsers;
    }

    /**
     * @param $user_id
     * @throws \Exception
     */
    private function verifyProfile($user_id)
    {
        $profileForm = new ProfileForm();
        $profileForm->first_name = $this->faker->firstName;
        $profileForm->last_name = $this->faker->lastName;
        $profileForm->user_id = $user_id;
        $this->profileService->profile($profileForm);

        $profileUser = $this->userService->findById($user_id);
        if($profileForm->first_name !== $profileUser->first_name){
            throw new \Exception("Updating profile functionality not working.");
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
        $brands = $this->createUsers($emailsTpl, IUserType::BRAND);
        foreach ($brands as $idx => $brand_id){
            $this->createChallenges($brand_id, 15);
        }

    }

    private function createCustomers($count = 3)
    {
        VarDumper::dump('Creating Customers...');
        $emailsTpl = [
            ['email' => 'fahad.shehzad+c{counter}@gems.techverx.com', 'count' => 20],
            ['email' => 'fahad.shehzad+c{counter}_19@gems.techverx.com', 'count' => 30],
            ['email' => 'fahad.shehzad+c{counter}_18@gems.techverx.com', 'count' => 30],
            ];
        $this->createUsers($emailsTpl, IUserType::CUSTOMER);
    }

    /**
     * @param $brand_id
     * @param int $count
     */
    private function createChallenges ($brand_id, $count = 3){
        VarDumper::dump('Creating Challanges for Brand ' . $brand_id);
        $service = new ChallengeService();
        for($unpublishedCount = 0; $unpublishedCount < 10; $unpublishedCount++){
            $challenge = $this->createChallange($brand_id);
        }
        for($publishedCount = 0; $publishedCount < 10; $publishedCount++){
            $challenge = $this->createChallange($brand_id);
            $service->publish($challenge->id);
            $this->submitTricks($challenge->id);
        }
        for($winnerChallenges = 0; $winnerChallenges < $count; $winnerChallenges++){
            $challenge = $this->createChallange($brand_id);
            $service->publish($challenge->id);
            $this->submitTricks($challenge->id);
            $this->challengeWinner($challenge->id);
        }
    }

    /**
     * @param $challenge_id
     */
    private function submitTricks($challenge_id){
        $service = new ChallengeService();
        $service->publish($challenge_id);
        VarDumper::dump('Creating Challenge ' . $challenge_id);

        $customers = $this->randomCustomers(20);
        foreach ($customers as $idx => $customer_id){
            $this->submitTrick($customer_id, $challenge_id);
        }
    }

    private function challengeWinner($challenge_id){
        $service = new ChallengeService();
        $challenge = $service->findById($challenge_id);
        $tricks = Arr::shuffle($challenge->tricks->pluck('id', 'id')->toArray());
        $winnerTrick = Arr::random($tricks, 1);
        $winnerForm = new WinnerForm();
        $winnerForm->challenge_id = $challenge->id;
        $winnerForm->trick_id = $winnerTrick[0];
        $winnerForm->notes = $this->faker->sentence;
        $trickChallenge = $service->winner($winnerForm);
        VarDumper::dump('Verifiing Winner :: ' . $trickChallenge->winner->id . ' == ' . $winnerTrick[0]);
    }

    /**
     * @param $customer_id
     * @param $challenge_id
     * @throws ValidationException
     */
    private function submitTrick($customer_id, $challenge_id){
        $form = new \App\Forms\Trick\CreatorForm();
        $form->challenge_id = $challenge_id;
        $form->customer_id = $customer_id;
        $form->description = $this->faker->sentence;
        $service = new TrickService();
        $service->persist($form);
    }

    private function random_tags($count = 3){
        $records = Tag::all()->pluck('name', 'id');
        $rand = $this->faker->randomElements(array_keys($records->toArray()), min($records->count(), 4));
        return array_combine(array_values($rand), array_values($rand));
    }

    /**
     * @param $brand_id
     * @return \App\Models\Challenge
     */
    private function createChallange($brand_id){
        $tags = $this->random_tags(3);
        $form = new \App\Forms\Challenge\CreatorForm();
        $form->brand_id = $brand_id;
        $form->name = $this->faker->dateTime->format("F-Y") . ' Challenge';
        $form->description = $this->faker->sentence;
        $address = $this->faker->address;
        $form->address = $address;
        $form->city = $this->faker->city;
        $form->state = $this->faker->state;
        $form->country = $this->faker->country;
        $form->latitude = $this->faker->latitude;
        $form->longitude = $this->faker->longitude;
        $form->reward = "Trip to " . $this->faker->city;
        $form->reward_notes = $this->faker->sentence;
        $form->reward_url = $this->faker->url;
        $form->tags = $tags;

        if($form->passes()){
            $service = new ChallengeService();
            $challenge = $service->persist($form);
            return $challenge;
        }else{
            dd($form->errors());
        }
    }

    private function randomCustomers($count = 5){
        $query = User::query();
        $query->where('user_type', '=', IUserType::CUSTOMER);
        $records = $query->pluck('id', 'id');
        $rand = $this->faker->randomElements(array_keys($records->toArray()), min($records->count(), $count));
        return array_combine(array_values($rand), array_values($rand));
    }



}
