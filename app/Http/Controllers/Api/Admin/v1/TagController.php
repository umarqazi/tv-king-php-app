<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 22/02/2019
 * Time: 3:27 PM
 */

namespace App\Http\Controllers\Api\Admin\v1;


use App\Forms\Tag\TagSearchForm;
use App\Http\Controllers\Controller;
use App\Services\TagService;
use App\Forms\Tag\TagCreatorForm;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * @param $request
     */
    public function store(Request $request){
        $form = new TagCreatorForm();
        $form->name = $request['name'];
        $savedTag = $this->tagService->persist($form);
        return response()->json(['record' => $savedTag->toArray()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $form = new TagSearchForm();

        $tags = $this->tagService->search( $form );

        return response()->json(['m' => $tags]);
    }
}