@extends('layouts.app')

@section('title')
    {{ trans('site.site_title.Create New Account') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('site.site_title.Create New Account') }}</h3>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('socialite.signUp') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label" for="name">{{ trans('site.input_name.avatar') }}</label>
                            <div class="form-group">
                                <img src="{{ $socialiteUser['avatar'] }}" width="100%"/>
                                <input type="hidden" name="avatar" value="{{ $socialiteUser['avatar'] }}">
                            </div>
                        </div>

                        <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                            <label class="control-label" for="name">{{ trans('site.input_name.username') }}</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{ $socialiteUser['name'] ?: '' }}">
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>

                        @if($socialiteUser['driver'] == 'github')
                            <div class="form-group {{{ $errors->has('github_name') ? 'has-error' : '' }}}">
                                <label class="control-label" for="github_name">Github Name</label>
                                <input class="form-control" readonly="readonly" id="github_name" name="github_name" type="text"
                                       value="{{ isset($socialiteUser['nickname']) ? $socialiteUser['nickname'] : $socialiteUser['name'] }}">
                                {!! $errors->first('github_name', '<span class="help-block">:message</span>') !!}
                            </div>
                        @endif

                        <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <label class="control-label" for="email">{{ trans('site.input_name.email') }}</label>
                            <input class="form-control" id="email" name="email" type="text"
                                   value="{{ $socialiteUser['email'] ?: '' }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{{ $errors->has('password') ? 'has-error' : '' }}}">
                            <label class="control-label" for="password">{{ trans('site.input_name.password') }}</label>
                            <input class="form-control" id="password" name="password" type="password" value="{{ old('password') }}">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{{ $errors->has('password_confirmation') ? 'has-error' : '' }}}">
                            <label class="control-label" for="password_confirmation">{{ trans('site.input_name.password_confirmation') }}</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
                                   value="{{ old('password_confirmation') }}">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>

                        <input class="btn btn-lg btn-success btn-block" type="submit" value="{{ trans('site.button.Confirm') }}">
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
