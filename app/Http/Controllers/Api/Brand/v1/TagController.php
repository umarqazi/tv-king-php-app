<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 13/03/2019
 * Time: 4:06 PM
 */

namespace App\Http\Controllers\Api\Brand\v1;


use App\Forms\Tag\TagSearchForm;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Services\TagService;

class TagController extends Controller
{
    private $tagService;

    /**
     * TagController constructor.
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     *
     */
    public function index(){
        $form = new TagSearchForm();
        $resources = $this->tagService->search($form);
        return  new TagCollection($resources) ;
    }

}