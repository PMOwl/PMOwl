<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel')) - PMOwl 机器学习社区::专注于研究机器学习相关技术</title>
    <meta name="description" content="@yield('site_description', 'PMOwl 机器学习社区，分享最新的国内外机器学习行业动态，交流机器学习资讯、技术等相关知识，PMOwl 机器学习社区是机器学习爱好者最好的交流学习社区。')" />
    <meta name="keywords" content="@yield('site_keywords', '机器学习,人工智能,AI,深度学习,机器学习社区')" />

    <!-- Styles -->
    @yield('before-css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('after-css')
</head>
<body>
<div id="app">
    @include('layouts.partials.nav')

    <div class="container main-container">
        @include('flash::message')

        @yield('content')
    </div>


    @include('layouts.partials.footer')
</div>

<!-- Scripts -->
@yield('before-js')
<script src="{{ asset('js/app.js') }}"></script>
@yield('after-js')
@if (App::environment() == 'production')
    <script>
        ga('create', '{{ config('app.GAId') }}', 'auto');
        ga('send', 'pageview');
    </script>


    <script>
        // Baidu link submit
        (function () {
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    </script>
@endif
</body>
</html>
