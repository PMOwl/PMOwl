@if (isset($category) && $category->id == config('pmowl.category_ids.qa'))
    {{--<div class="alert alert-info">--}}
        {{--在 PM Owl，我们不提倡 <a href="{{ route('topics.show', 535) }}" style="text-decoration: underline;">新手提问</a>，如果你遇到难题，请先--}}
        {{--<a href="{{ route('topics.show', 3656) }}" style="text-decoration: underline;">搜索</a> 再 <a--}}
            {{--href="{{ route('topics.create', ['category_id' => config('phphub.qa_category_id')]) }}"--}}
            {{--class="btn btn-warning">提问</a>--}}
    {{--</div>--}}
@elseif(isset($category) && $category->id === config('pmowl.category_ids.challenger_ai'))
    <div class="alert alert-info">
        {!! $category->slug !!}
    </div>
@elseif (isset($category) && $category->id === config('pmowl.category_ids.recruit'))
    <div class="alert alert-info">
        发布招聘贴前请必须仔细阅读 <a
            href="/topics/817"
            style="text-decoration: underline;">PM Owl 招聘贴发布规范</a>，不按规范发帖会被管理员 <a
            href="/topics/2802"
            style="text-decoration: underline;">永久下沉</a>。<a
            href="{{ route('topics.create', ['category_id' => 1]) }}" class="btn btn-warning">发布招聘</a>
    </div>
@endif