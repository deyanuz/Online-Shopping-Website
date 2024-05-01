@extends('layouts.app')
@section('title', 'Blogs')

@section('content')
    <style>
        .img-fluid {
            width: 100% !important;
            height: 100% !important;
        }

        .border-bottom {
            border-bottom: 3px solid rgb(151, 79, 203, 0.25) !important;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Blog
                    <span></span> {{$query}}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container custom">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-header mb-50">
                            <h1 class="font-xxl text-brand border-bottom pb-5">Our Blog</h1>
                        </div>
                        <div class="loop-grid pr-30">
                            <div class="row">
                                <div class="col-12">
                                    <article class="first-post mb-30 wow fadeIn animated hover-up">
                                        <div class="img-hover-slide position-relative overflow-hidden">
                                            <span class="top-right-icon bg-dark"><i class="fi-rs-bookmark"></i></span>
                                            <div class="post-thumb img-hover-scale">
                                                <a href="{{ $articles['0']['url'] }}" target="blank">
                                                    <img src="{{ $articles['0']['urlToImage'] }}" class="img-fluid"
                                                        alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="entry-content">
                                            <div class="entry-meta meta-1 mb-30">
                                                <a class="entry-meta meta-0" href="#"><span
                                                        class="post-in background4 text-brand font-xs">Mobile
                                                        Phone</span></a>
                                                <div class="font-sm">
                                                    <span><span class="mr-10 text-muted"><i
                                                                class="fi-rs-eye"></i></span>23k</span>
                                                    <span class="ml-30"><span class="mr-10 text-muted"><i
                                                                class="fi-rs-comment-alt"></i></span>17k</span>
                                                    <span class="ml-30"><span class="mr-10 text-muted"><i
                                                                class="fi-rs-share"></i></span>18k</span>
                                                </div>
                                            </div>
                                            <h2 class="post-title mb-20">
                                                <a href="{{ $articles['0']['url'] }}"  target="blank">{{ $articles['0']['title'] }}</a>
                                            </h2>
                                            <p class="post-exerpt font-medium text-muted mb-30">
                                                {{ $articles['0']['description'] }}</p>
                                            <div class="mb-20 entry-meta meta-2">
                                                <div class="font-xs ">
                                                    <div class="mb-5">
                                                        <span class="post-by has-dot ">By <a
                                                                href="#">{{ $articles['0']['author'] }}</a></span>
                                                    </div>
                                                    <div class="source mt-5"><span class='has-dot'>
                                                            Source:<a target="blank" href="#">
                                                                {{ $articles['0']['source']['name'] }}</a></span></div>
                                                    <div class="entry-meta meta-13 font-xxs color-grey">
                                                        @php
                                                            $dateTime = new DateTime($articles['0']['publishedAt']);

                                                            $date = $dateTime->format('Y-m-d');
                                                            $time = $dateTime->format('H:i:s');
                                                        @endphp
                                                        <div class="mt-5"><span class="post-on mr-10 "><i
                                                                    class="fi fi-rs-calendar"></i>
                                                                {{ $date }}</span> <span class="post-on mr-10 "><i
                                                                    class="fi-rs-clock"></i> {{ $time }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <a href="{{ $articles['0']['url'] }}" target="blank" class="btn btn-sm">Read
                                                    more<i class="fi-rs-arrow-right ml-10"></i></a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @foreach ($articles as $article)
                                    @if ($article != $articles['0'])
                                        <div class="col-lg-6">
                                            <article class="wow fadeIn animated hover-up mb-30">
                                                <div class="post-thumb img-hover-scale imgs">
                                                    <a href="{{ $article['url'] }}" target="blank">
                                                        <img src="{{ $article['urlToImage'] }}" class="img-fluid"
                                                            alt="">
                                                    </a>
                                                    <div class="entry-meta">
                                                        <a class="entry-meta meta-2"
                                                            href="blog.html">{{ $query }}</a>
                                                    </div>
                                                </div>
                                                <div class="entry-content-2">
                                                    <h3 class="post-title mb-15">
                                                        <a href="{{ $article['url'] }}"
                                                            target="blank">{{ $article['title'] }}</a>
                                                    </h3>
                                                    <p class="post-exerpt mb-30">{{ $article['description'] }}</p>
                                                    <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                                        <div class="entry-meta meta-13 font-xxs color-grey">
                                                            @php
                                                                $dateTime = new DateTime($article['publishedAt']);

                                                                $date = $dateTime->format('Y-m-d');
                                                                $time = $dateTime->format('H:i:s');
                                                            @endphp
                                                            <div class="mt-1"><span class="post-on mr-10 "><i
                                                                        class="fi fi-rs-calendar"></i>
                                                                    {{ $date }}</span> <span
                                                                    class="post-on mr-10 "><i class="fi-rs-clock"></i>
                                                                    {{ $time }}</span>
                                                            </div>
                                                        </div>
                                                        <a href="{{ $article['url'] }}" target="blank"
                                                            class="text-brand">Read more <i
                                                                class="fi-rs-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-area">
                            <div class="sidebar-widget widget_search mb-50">
                                <div class="search-form">
                                    <form action="{{route('frontend.searchBlogs')}}">
                                        @csrf
                                        <input type="text" name="query" @if(isset($searchQuery)) value="{{$searchQuery}}" @else placeholder="Search…" @endif>
                                        <button type="submit"> <i class="fi-rs-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <!--Widget categories-->
                            <div class="sidebar-widget widget_categories mb-40">
                                <div class="widget-header position-relative mb-20 pb-10">
                                    <h5 class="widget-title">Categories</h5>
                                </div>
                                <div class="post-block-list post-module-1 post-module-5">
                                    <ul>
                                        <li class="cat-item cat-item-2"><a
                                                href="{{ route('frontend.blogs', ['query' => 'beauty']) }}">Beauty</a>
                                        </li>
                                        <li class="cat-item cat-item-3"><a
                                                href="{{ route('frontend.blogs', ['query' => 'book']) }}">Book</a></li>
                                        <li class="cat-item cat-item-4"><a
                                                href="{{ route('frontend.blogs', ['query' => 'design']) }}">Design</a>
                                        </li>
                                        <li class="cat-item cat-item-5"><a
                                                href="{{ route('frontend.blogs', ['query' => 'fashion']) }}">Fashion</a>
                                        </li>
                                        <li class="cat-item cat-item-6"><a
                                                href="{{ route('frontend.blogs', ['query' => 'lifestyle']) }}">Lifestyle</a>
                                        </li>
                                        <li class="cat-item cat-item-7"><a
                                                href="{{ route('frontend.blogs', ['query' => 'travel']) }}">Travel</a>
                                        </li>
                                        <li class="cat-item cat-item-7"><a
                                                href="{{ route('frontend.blogs', ['query' => 'anime']) }}">Anime</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Widget latest posts style 1-->
                            <div class="sidebar-widget widget_alitheme_lastpost mb-20">
                                <div class="widget-header position-relative mb-20 pb-10">
                                    <h5 class="widget-title">Trending Now</h5>
                                </div>
                                <div class="row">
                                    <div class="col-12 sm-grid-content mb-30">
                                        <div class="post-thumb d-flex border-radius-5 img-hover-scale mb-15">
                                            <a href="{{ $trendings['0']['url'] }}" target="blank">
                                                <img src="{{ $trendings['0']['urlToImage'] }}" target='blank'
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h4 class="post-title mb-10 text-limit-2-row">{{ $trendings['0']['title'] }}
                                            </h4>
                                            <div class="entry-meta meta-13 font-xxs color-grey">
                                                @php
                                                    $dateTime = new DateTime($trendings['0']['publishedAt']);

                                                    $date = $dateTime->format('Y-m-d');
                                                    $time = $dateTime->format('H:i:s');
                                                @endphp
                                                <div class="mt-1"><span class="post-on mr-10 "><i
                                                            class="fi fi-rs-calendar"></i> {{ $date }}</span>
                                                </div>
                                                <div class="mt-1"><span class="post-on mr-10 "><i
                                                            class="fi-rs-clock"></i> {{ $time }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($trendings as $trending)
                                        @if ($trending != $trendings['0'])
                                            <div class="col-md-6 col-sm-6 sm-grid-content mb-30">
                                                <div class="post-thumb d-flex border-radius-5 img-hover-scale mb-15">
                                                    <a href={{ $trending['url'] }}  target="blank">
                                                        <img src={{ $trending['urlToImage'] }} alt="">
                                                    </a>
                                                </div>
                                                <div class="post-content media-body">
                                                    <h6 class="post-title mb-10 text-limit-2-row">{{ $trending['title'] }}
                                                    </h6>
                                                    <div class="entry-meta meta-13 font-xxs color-grey">
                                                        @php
                                                            $dateTime = new DateTime($trending['publishedAt']);

                                                            $date = $dateTime->format('Y-m-d');
                                                            $time = $dateTime->format('H:i:s');
                                                        @endphp
                                                        <div class="mt-1"><span class="post-on mr-10 "><i
                                                                    class="fi fi-rs-calendar"></i>
                                                                {{ $date }}</span></div>
                                                        <div class="mt-1"><span class="post-on mr-10 "><i
                                                                    class="fi-rs-clock"></i> {{ $time }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="border-bottom"></div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>

@endsection
@section('script')


@endsection
