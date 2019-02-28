<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:35 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;


use App\Forms\Trick\CreatorForm;
use App\Forms\Trick\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\TrickCollection;
use App\Services\TrickService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class TrickController
 * @package App\Http\Controllers\Api\Customer\v1
 */
class TrickController extends Controller
{
    protected $trickService;

    /**
     * TrickController constructor.
     * @param TrickService $service
     */
    public function __construct(TrickService $service)
    {
        $this->trickService = $service;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function view($id){
        return $this->trickService->findById($id);
    }

    /**
     * @param Request $request
     * @return \App\Models\Trick|mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $id){
        $form = new CreatorForm();
        $form->challenge_id = $id;
        $form->customer_id  = $this->currentUser();
        $form->description  = $request['description'];
        $trick = $this->trickService->persist($form);
        return $trick;
    }

    /**
     * @return TrickCollection
     */
    public function index(){
        $form = new SearchForm();
        $form->customer_id = Auth::id();
        $collection = $this->trickService->search( $form );
        return new TrickCollection( $collection ) ;
    }
}