<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 9:35 PM
 */

namespace App\Http\Controllers\Api\Customer\v1;


use App\Forms\Trick\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\TrickCollection;
use App\Services\TrickService;
use Illuminate\Support\Facades\Auth;

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
     * @param $callenge_id
     */
    public function store($callenge_id){

    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator|void
     */
    public function index(){
        $form = new SearchForm();
        $form->customer_id = Auth::id();
        $collection = $this->trickService->search( $form );
        return new TrickCollection( $collection ) ;
    }
}