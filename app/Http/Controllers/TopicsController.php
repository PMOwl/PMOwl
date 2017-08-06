<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Services\TopicServices;
use App\Utils\EntityUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * @var TopicServices
     */
    private $topicServices;

    public function __construct(TopicServices $topicServices)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->topicServices = $topicServices;
    }

    /**
     * @param Request $request
     * @param TopicServices $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'index');

        $topics = $this->topicServices->getTopicsWithFilter($filter, 40);

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('topics.create', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->only('category_id', 'title', 'body');

        $topicId = $this->topicServices->storeTopic($params);

        return redirect(route('topic.show', $topicId));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = $this->topicServices->getTopic($id);

        $hits = EntityUtil::updateHit($topic, EntityUtil::TOPIC);

        $topic->view_count = $topic->view_count + $hits;

        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
