<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 24/02/2019
 * Time: 6:31 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;

use App\Forms\Trick\SearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Trick;
use App\Http\Resources\Admin\TrickCollection;
use App\Services\TrickService;
use Illuminate\Http\Request;

/**
 * Class TrickController
 * @package App\Http\Controllers\Api\Admin\v1
 *
 *
 *
 */
class TrickController extends Controller
{

    private $trickService;

    /**
     * TrickController constructor.
     * @param TrickService $service
     */
    public function __construct(TrickService $service)
    {
        $this->trickService = $service;
    }

    /**
     * @param Request $request
     * @return TrickCollection
     */
    public function index(Request $request)
    {
        $form = new SearchForm();
        $tricks = $this->trickService->search($form);
        return new TrickCollection($tricks);
    }

    /**
     * @param $id
     * @return Trick
     */
    public function view($id){
        $trick = $this->trickService->findById($id);
        return new Trick($trick);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request){

    }


}