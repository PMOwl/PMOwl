<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topics\StoreTopicRequest;
use App\Models\Category;
use App\Services\TopicsServices;
use App\Utils\EntityUtil;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * @var TopicsServices
     */
    private $topicsServices;

    public function __construct(TopicsServices $topicsServices)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->topicsServices = $topicsServices;
    }

    /**
     * @param Request $request
     * @param TopicsServices $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'index');

        $topics = $this->topicsServices->getTopicsWithFilter($filter, 40);

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

        return view('topics.create-and-edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicRequest $request)
    {
        $params = $request->only('category_id', 'title', 'body');

        $topicId = $this->topicsServices->storeTopic($params);

        return redirect()->route('topic.show', publicId($topicId));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $topic = $this->topicsServices->getTopic($id);

        $replies = $this->topicsServices->getTopicRepliesWithLimit($topic, $request->order_by);

        $hits = EntityUtil::updateHit($topic, EntityUtil::TOPIC);

        $topic->view_count = $topic->view_count + $hits;

        return view('topics.show', compact('topic', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();

        $topic = $this->topicsServices->getTopic($id);

        return view('topics.create-and-edit', compact('categories', 'topic'));
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
        $params = $request->only('category_id', 'title', 'body');

        $this->topicsServices->updateTopic($id, $params);

        return redirect()->route('topic.show', public_id($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->topicsServices->destroyTopic($id);

        return redirect()->route('community');
    }
}
