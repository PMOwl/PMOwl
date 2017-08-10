@extends('layouts.app')

@section('title')
    {{ trans('site.site_title.index') }}
@stop

@section('content')
    <div class="panel padding-lg rm-padding-top">
        <div class="panel-body">

            <div class="markdown-body" id="emojify">


                <h1 id="toc_0">关于 {{ config('app.name') }}</h1>

                <h2 id="toc_1">说明</h2>

                <p>PM Owl 是积极向上的 机器学习 社区</p>
                <p>我们致力于推动 机器学习交流，从业经验，新理念在中国的发展。</p>

                <p>论坛基于开源项目 PMOwl 基础进行分支开发，PMOwl 由 Laravel5.4 构建</p>

                <h2 id="toc_2">关于新手问题</h2>

                <p>这个社区不是用来问新手问题的，如果你是 机器学习 新手，请先看 一些产品基础书籍和资料，当你构建出一个合理的 机器学习 基础知识体系时，欢迎与大家讨论。</p>

                <p>在学习上遇到问题的时候，请先 Google。</p>

                <p>如果觉得你的问题比较独占，请先仔细阅读 <a href="{{ url('/show/1') }}">提问的智慧</a>，然后发表你的问题，谢谢。 </p>

                <h2 id="toc_3">愿景 Vision</h2>

                <blockquote>
                    <p>下面是 {{ config('app.url') }} 创建的初衷，与君共勉。</p>
                </blockquote>

                <h3 id="toc_4">在这里的我们</h3>

                <ul>
                    <li>尊重他人;</li>
                    <li>热爱产品, 为最新最潮的产品思想狂热;</li>
                    <li>热爱学习, 热爱互联网;</li>
                    <li>热爱 机器学习;</li>
                </ul>

                <h3 id="toc_5">在这里我们可以</h3>

                <ul>
                    <li>分享生活见闻，分享知识，分享创意</li>
                    <li>接触新思想</li>
                    <li>为自己的创业项目找合伙人</li>
                    <li>讨论产品解决方案</li>
                    <li>自发线下聚会</li>
                    <li>遇见志同道合的人</li>
                    <li>发现更好工作机会</li>
                    <li>甚至是开始另一个神奇的产品项目</li>
                    <li>...</li>
                </ul>

                <h3 id="toc_6">在这里我们不可以</h3>

                <ul>
                    <li>这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题</li>
                    <li>这里感激和崇尚美的事物</li>
                    <li>这里尊重原创</li>
                    <li>这里反对中文互联网上的无信息量习惯如“顶”，“沙发”，“前排”，“留名”，“路过”</li>
                </ul>


            </div>

        </div>
    </div>
@endsection