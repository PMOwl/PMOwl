@extends('layouts.app')

@section('title')
    {{ isset($topic) ? '编辑话题' : trans('Create New Topic') }}
@endSection

@section('content')

    <div class="topic_create">

        <div class="col-md-8 main-col">

            <div class="reply-box form box-block">

                <div class="alert alert-warning">
                    {!! trans('site.info.be_nice') !!}
                </div>

                @include('layouts.partials.errors')

                @if (isset($topic))
                    <form method="POST" action="{{ route('topic.update', $topic->id) }}" accept-charset="UTF-8"
                          id="topic-edit-form" class="topic-form">
                        <input name="_method" type="hidden" value="PATCH">
                        @else
                            <form method="POST" action="{{ route('topic.store') }}" accept-charset="UTF-8"
                                  id="topic-create-form" class="topic-form">
                                @endif
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <select title="分类" class="selectpicker form-control" name="category_id"
                                            id="category-select"
                                            required>
                                        <option value="" disabled selected>{{ trans('site.info.Pick a category') }}</option>
                                        @foreach ($categories as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @foreach ($categories as $value)
                                    <div class="category-hint alert alert-warning animated rubberBand"
                                         id="category-{{ $value->id }}" style="display:none">{!! $value->slug !!}</div>
                                @endforeach

                                <div class="form-group">
                                    <input class="form-control" id="topic-title"
                                           placeholder="{{ trans('site.info.Please write down a topic') }}" name="title"
                                           value="{{ !isset($topic) ? '' : $topic->title }}" required>
                                </div>

                                <div class="form-group">
                                    <!-- 编辑器容器 -->
                                    <script id="container" name="body"
                                            type="text/plain">{{ !isset($topic) ? '' : $topic->body_original }}</script>
                                </div>

                                <div class="form-group status-post-submit">
                                    <button class="btn btn-primary submit-btn"
                                            id="topic-submit">{{ trans('site.button.Publish') }}</button>
                                </div>

                            </form>
                    </form>
            </div>
        </div>

        @include('topics.partials.side-bar')
    </div>


@endsection

@section('after-js')
    @include('vendor.ueditor.assets')
    <script>
        {{--Config.topic_id = '{{ isset($topic) ? $topic->id : 0 }}';--}}
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            @if ( ! isset($topic))
            localStorage.getItem('topic-title', function (err, value) {
                if ($('#topic-title').val() === '' && !err) {
                    $('#topic-title').val(value);
                }
            });
            $('#topic-title').keyup(function () {
                localStorage.setItem('topic-title', $(this).val());
            });
            @endif

            $('#category-select').on('change', function () {
                var current_cid = $(this).val();
                $('.category-hint').hide();
                $('#category-' + current_cid).fadeIn();
            });
        });
    </script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            initialFrameHeight: 500
        });
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@stop
