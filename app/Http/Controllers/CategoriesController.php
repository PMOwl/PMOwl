<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\TopicsServices;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
    }

    /**
     * 分类分发
     * @param $categoryId
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($categoryId, Request $request)
    {
        $category = app(Category::class)->findOrFail($categoryId);
        $topics = app(TopicsServices::class)->getTopicsWithFilter($request->get('filter', 'default'), $categoryId);


        return view('topics.index', compact('topics', 'category'));
    }
}
