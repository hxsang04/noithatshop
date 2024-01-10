@extends('Layout_user')
@section('content')
    <!--================Home Banner Area =================-->
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Shop Single</h2>
                            <p>Home <span>-</span> Shop Single</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Blog Area =================-->
    <section class="blog_area padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach ($blogs as $blog)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <img class="card-img rounded-0" src="{{ asset('uploads/blog/' . $blog->blog_image) }}"
                                        alt="">
                                    <a href="#" class="blog_item_date">
                                        <h3>{{ Carbon\Carbon::parse($blog->created_at)->format('d') }}</h3>
                                        <p>{{ Carbon\Carbon::parse($blog->created_at)->format('F') }}</p>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    <a class="d-inline-block"
                                        href="{{ route('blog.show', ['blog' => Str::slug($blog->blog_name), 'type' => $blog->blog_id]) }}">
                                        <h2>{{ $blog->blog_name }}</h2>
                                    </a>
                                    <p>{!! $blog->blog_content !!}</p>
                                    <ul class="blog-info-link">
                                        <li><a href="#"><i class="far fa-user"></i>
                                                {{ ucwords($blog->blog_user->name) }},
                                                {{ ucfirst($blog->blog_cate->category_blog_name) }}</a></li>
                                        <li><a href="#"><i class="far fa-comments"></i> 03 Comments</a></li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach


                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                {!! $blogs->render('User.pagination') !!}
                            </ul>
                        </nav>
                    </div>
                </div>
                @include('User.include_blog')
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection
