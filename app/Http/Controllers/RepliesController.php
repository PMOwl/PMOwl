<?php

namespace App\Http\Controllers;

use App\Http\Requests\Replies\StoreReplyRequest;
use App\Services\RepliesServices;

class RepliesController extends Controller
{
    /**
     * @var RepliesServices
     */
    private $repliesServices;

    public function __construct(RepliesServices $repliesServices)
    {
        $this->repliesServices = $repliesServices;
    }

    public function store(StoreReplyRequest $request)
    {
        $params = $request->only('topic_id', 'body');

        $replyId = $this->repliesServices->storeReply($params);

        return redirect()->route('topic.show', publicId($params['topic_id']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repliesServices->destroyReply($id);

        return;
    }

}
