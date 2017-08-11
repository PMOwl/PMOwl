<ul class="list-group row topic-list">
    @foreach ($topics as $topic)
        <li class="list-group-item ">
            <a class="reply_count_area hidden-xs pull-right" href="">
                <div class="count_set">
                     <span class="count_of_votes" title="投票数">{{ $topic->vote_count }}</span>
                    <span class="count_seperator">/</span>
                    <span class="count_of_replies" title="回复数">{{ $topic->reply_count }}</span>
                    <span class="count_seperator">/</span>
                    <span class="count_of_visits" title="查看数">{{ $topic->view_count }}</span>
                    <span class="count_seperator">|</span>
                    <abbr title="{{ $topic->updated_at }}" class="timeago" data-toggle="popover" data-content="{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</abbr>
                </div>
            </a>
            <div class="avatar pull-left">
                <a href="" title="{{{ $topic->user->name }}}">
                    <img class="media-object img-thumbnail avatar avatar-middle" alt="{!! $topic->user->name !!}" src="{{ $topic->user->avatar }}"/>
                </a>
            </div>
            <div class="infos">
                <div class="media-heading">
                    @if ($topic->order > 0 && !\Illuminate\Support\Facades\Input::get('filter') && Route::currentRouteName() != 'home' )
                        <span class="hidden-xs label label-{{ ($topic->is_excellent == 'yes' && Route::currentRouteName() != 'home') ? 'success' : 'default' }}">{!! $topic->category->name !!}
                            ">{{ trans('stick') }}</span>
                    @else
                        <span class="hidden-xs label label-default">{{ $topic->category->name }}</span>
                    @endif

                    <a href="{{ route('topic.show', $topic->public_id) }}" title="{!! $topic->title !!}">{!! $topic->title !!}</a>
                </div>
            </div>
        </li>
    @endforeach
</ul>
