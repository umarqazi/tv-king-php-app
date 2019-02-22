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
use App\Http\Resources\Tag;
use App\Http\Resources\TagCollection;
use App\Services\TagService;
use App\Forms\Tag\CreatorForm;
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
        $form = new CreatorForm();
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
        $form->keyword = $request['keyword'];
        $tags = $this->tagService->search( $form );
        return new TagCollection($tags);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function view($id){
        $tag = $this->tagService->findById($id);
        $jsonResource = new Tag($tag);
        return $jsonResource;
    }
}