@extends('layouts.app')

@section('title')
    {{{ $topic->title }}} | @parent
@endSection

@section('description')
    {{{ $topic->excerpt }}}
@endSection

@section('content')
    <div class="col-md-9 topics-show main-col">
        <!-- Topic Detial -->
        <div class="topic panel panel-default">
            <div class="infos panel-heading">
                <h1 class="panel-title topic-title">{{{ $topic->title }}}</h1>

                @include('topics.partials.meta')
            </div>
            <div class="content-body entry-content panel-body ">
                @include('topics.partials.body', ['body' => $topic->body])

                <div data-lang-excellent="{{ trans('This topic has been mark as Excenllent Topic.') }}"
                     data-lang-wiki="{{ trans('This is a Community Wiki.') }}" class="ribbon-container">
                    {{--@include('topics.partials.ribbon')--}}
                </div>
            </div>
            <div class="appends-container" data-lang-append="{{ trans('Append') }}">
                {{--@foreach ($topic->appends as $index => $append)--}}

                    {{--<div class="appends">--}}
                        {{--<span class="meta">{{ trans('Append') }} {{ $index }} &nbsp;·&nbsp; <abbr--}}
                                {{--title="{{ $append->created_at }}"--}}
                                {{--class="timeago">{{ $append->created_at }}</abbr></span>--}}
                        {{--<div class="sep5"></div>--}}
                        {{--<div class="markdown-reply append-content">--}}
                            {{--{!! $append->content !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--@endforeach--}}
            </div>
            {{--@if($revisionHistory && in_array($revisionHistory->key, ['is_excellent', 'order']))--}}
                {{--<div class="admin-operation">--}}
                    {{--@php--}}
                    {{--$revisionAdmin = \App\Models\User::find($revisionHistory->user_id);--}}
                    {{--$adminOperation = '';--}}
                    {{--if ($revisionHistory->key == 'is_excellent') {--}}
                        {{--$adminOperation = $revisionHistory->new_value == 'yes' ? '加精' : '解除加精';--}}
                    {{--}--}}

                    {{--if ($revisionHistory->key == 'order') {--}}
                        {{--if ($revisionHistory->new_value < 0) {--}}
                            {{--$adminOperation = '沉帖';--}}
                        {{--} elseif ($revisionHistory->new_value > 0) {--}}
                            {{--$adminOperation = '置顶';--}}
                        {{--} elseif ($revisionHistory->new_value == 0) {--}}
                            {{--$adminOperation = $revisionHistory->old_value > 0 ? '取消置顶' : '取消沉帖';--}}
                        {{--}--}}
                    {{--}--}}
                    {{--@endphp--}}
                    {{--@if($adminOperation)--}}
                        {{--本帖由 <a href="{{ route('users.show', $revisionAdmin->id) }}"--}}
                               {{--target="_blank">{{$revisionAdmin->name}}</a>--}}
                        {{--于 {{$revisionHistory->created_at->diffForHumans()}} {{$adminOperation}}--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--@endif--}}
            {{--@include('topics.partials.topic_operate', ['manage_topics' => $currentUser ? ($currentUser->can("manage_topics") && $currentUser->roles->count() <= 5) : false])--}}
        </div>


        {{--@include('topics.partials.show_segment')--}}

    </div>

    {{--@if( $topic->user->payment_qrcode )--}}
        {{--@include('topics.partials.payment_qrcode_modal')--}}
    {{--@endif--}}

    {{--@include('layouts.partials.sidebar')--}}

    {{--@include('layouts.partials.bottombanner')--}}

@endSection

