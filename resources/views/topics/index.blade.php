@extends('layouts.app')

@section('content')
    <div class="col-md-9 topics-index main-col">
        <div class="panel panel-default">

            <div class="panel-heading">

                <ul class="list-inline topic-filter">
                    <li class="popover-with-html" data-content="最后回复排序">
                        <a href="">{{ trans('site.category.active') }}</a></li>
                    <li class="popover-with-html" data-content="只看加精的话题">
                        <a href="">{{ trans('site.category.excellent') }}</a>
                    </li>
                    <li class="popover-with-html" data-content="点赞数排序">
                        <a href="">{{ trans('site.category.vote') }}</a>
                    </li>
                    <li class="popover-with-html" data-content="发布时间排序">
                        <a href="">{{ trans('site.category.recent') }}</a>
                    </li>
                    <li class="popover-with-html" data-content="无人问津的话题">
                        <a href="">{{ trans('site.category.no-reply') }}</a>
                    </li>
                </ul>

                <div class="clearfix"></div>
            </div>

            @if ( ! $topics->isEmpty())
                <div class="jscroll">
                    <div class="panel-body remove-padding-horizontal">
                        @include('topics.partials.topics')
                    </div>
                    {{ $topics->links() }}
                </div>

            @else
                <div class="panel-body">
                    <div class="empty-block">{{ trans('Don\'t have any data Yet') }}~~</div>
                </div>
            @endif

        </div>

    </div>
@endsection