<div class="panel-footer operate">

    <div class="pull-left hidden-xs">
        <div class="social-share-cs"></div>
    </div>

    <div class="pull-right actions">

        {{--@if (Auth::check() && false /* && Auth::user()->isAttentedTopic($topic)*/)--}}
            {{--<a class="popover-with-html" data-content="关注主题，当评论和附言创建时将会被通知" data-method="post"--}}
               {{--id="topic-attent-cancel-button" href="javascript:void(0);"--}}
               {{--data-url="{{ route('attentions.createOrDelete', $topic->id) }}">--}}
                {{--<i class="glyphicon glyphicon-eye-open" style="color:#ce8a81"></i> <span></span>--}}
            {{--</a>--}}
        {{--@elseif (Auth::check())--}}
            {{--<a class="popover-with-html" data-content="关注主题，当评论和附言创建时将会被通知" data-method="post" id="topic-attent-button"--}}
               {{--href="javascript:void(0);" data-url="{{ route('attentions.createOrDelete', $topic->id) }}">--}}
                {{--<i class="glyphicon glyphicon-eye-open"></i> <span></span>--}}
            {{--</a>--}}
        {{--@endif--}}

        @if (Auth::check() && false/*&& $manageTopics*/ )
            <a data-ajax="post" id="topic-recomend-button" href="javascript:void(0);"
               data-url="{{ route('topic.recommend', [$topic->id]) }}"
               class="admin popover-with-html {{ $topic->is_excellent == 'yes' ? 'active' : ''}}"
               data-content="推荐主题，加精的帖子会出现在首页">
                <i class="fa fa-trophy"></i>
            </a>

            @if ($topic->order >= 0)
                <a data-ajax="post" id="topic-pin-button" href="javascript:void(0);"
                   data-url="{{ route('topics.pin', [$topic->id]) }}"
                   class="admin popover-with-html {{ $topic->order > 0 ? 'active' : '' }}" data-content="帖子置顶，会在列表页置顶">
                    <i class="fa fa-thumb-tack"></i>
                </a>
            @endif

            @if ($topic->order <= 0)
                <a data-ajax="post" id="topic-sink-button" href="javascript:void(0);"
                   data-url="{{ route('topics.sink', [$topic->id]) }}"
                   class="admin popover-with-html {{ $topic->order < 0 ? 'active' : '' }}"
                   data-content="沉贴，帖子将会被降低排序优先级">
                    <i class="fa fa-anchor"></i>
                </a>
            @endif

        @endif

        @if (Auth::check() && (/*$manageTopics ||*/ Auth::user()->id == $topic->user_id) )

            <a data-method="delete" id="topic-delete-button" href="javascript:void(0);"
               data-url="{{ route('topic.delete', [$topic->public_id]) }}" data-content="{{ trans('Delete') }}"
               class="admin popover-with-html">
                <i class="fa fa-trash-o"></i>
            </a>

            <a id="topic-edit-button"
               href="{{ isset($isArticle) ?  route('articles.edit', [$topic->public_id]) : route('topic.edit', [$topic->public_id]) }}"
               data-content="{{ trans('Edit') }}" class="admin  popover-with-html no-pjax">
                <i class="fa fa-pencil-square-o"></i>
            </a>
        @endif


        {{--@if (!isset($isArticle) && Auth::user() && (/*$manageTopics || */Auth::user()->id == $topic->user_id))--}}
            {{--<a id="topic-append-button" href="javascript:void(0);" class="admin  popover-with-html" data-toggle="modal"--}}
               {{--data-target="#exampleModal" data-content="帖子附言，添加附言后所有参与讨论的用户都能收到消息提醒，包括点赞和评论的用户">--}}
                {{--<i class="fa fa-plus"></i>--}}
            {{--</a>--}}

        {{--@endif--}}

    </div>
    <div class="clearfix"></div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">{{ trans('Append Content') }}</h4>
            </div>

            <form method="POST" action="{{--{{route('topic.append', $topic->id)}}--}}" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <div class="modal-body">

                    <div class="alert alert-warning">
                        {{ trans('append_notice') }}
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" style="min-height:20px"
                                  placeholder="{{ trans('Please using markdown.') }}" name="content" cols="50"
                                  rows="10"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('Close') }}</button>
                    <button class="btn btn-primary">{{ trans('Submit') }}</button>
                </div>

            </form>

        </div>
    </div>
</div>
