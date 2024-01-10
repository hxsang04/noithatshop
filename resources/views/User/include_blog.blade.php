<div class="col-lg-4">
    <div class="blog_right_sidebar">
        <aside class="single_sidebar_widget search_widget">
            <form action="#">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder='Search Keyword'
                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'">
                        <div class="input-group-append">
                            <button class="btn" type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Search</button>
            </form>
        </aside>

        <aside class="single_sidebar_widget post_category_widget">
            <h4 class="widget_title">Category</h4>
            <ul class="list cat-list">
                @foreach ($categories as $cate)
                    <li>
                        <a href="{{ route('blog.edit', ['blog' => $cate->category_blog_id]) }}" class="d-flex">
                            <p>{{ ucfirst($cate->category_blog_name) }}</p>
                            <p> ({{ count($cate->CateBlog) }})</p>
                        </a>
                    </li>
                @endforeach

            </ul>
        </aside>

        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title">Recent Post</h3>

            @foreach ($blogs_view as $blog)
                @php
                    \Carbon\Carbon::setLocale('en');
                    $commentTime = $blog->created_at;
                    $commentTime = \Carbon\Carbon::parse($commentTime);
                    $currentTime = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                @endphp
                <div class="media post_item">
                    <img width="80px" height="80px" src="{{ asset('uploads/blog/' . $blog->blog_image) }}"
                        alt="post">
                    <div class="media-body">
                        <a
                            href="{{ route('blog.show', ['blog' => Str::slug($blog->blog_name), 'type' => $blog->blog_id]) }}">
                            <h3>{!! ucfirst(substr($blog->blog_name, 0, 20)) !!}...</h3>
                        </a>
                        @if ($commentTime->format('Y') != $currentTime->format('Y'))
                            <p>{{ $commentTime->format('F d, Y') }}</p>
                        @else
                            <p>{{ $commentTime->diffForHumans($currentTime) }}</p>
                        @endif

                    </div>
                </div>
            @endforeach

        </aside>

        <aside class="single_sidebar_widget tag_cloud_widget">
            <h4 class="widget_title">Tag Clouds</h4>
            <ul class="list">
                <li>
                    <a href="#">project</a>
                </li>
                <li>
                    <a href="#">love</a>
                </li>
                <li>
                    <a href="#">technology</a>
                </li>
                <li>
                    <a href="#">travel</a>
                </li>
                <li>
                    <a href="#">restaurant</a>
                </li>
                <li>
                    <a href="#">life style</a>
                </li>
                <li>
                    <a href="#">design</a>
                </li>
                <li>
                    <a href="#">illustration</a>
                </li>
            </ul>
        </aside>
        <aside class="single_sidebar_widget instagram_feeds">
            <h4 class="widget_title">Instagram Feeds</h4>
            <ul class="instagram_row flex-wrap">
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_5.png') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_6.png') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_7.png') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_8.png') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_9.png') }}" alt="">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('frontend/img/post/post_10.png') }}" alt="">
                    </a>
                </li>
            </ul>
        </aside>
        <aside class="single_sidebar_widget newsletter_widget">
            <h4 class="widget_title">Newsletter</h4>
            <form action="#">
                <div class="form-group">
                    <input type="email" class="form-control" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                </div>
                <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">Subscribe</button>
            </form>
        </aside>

    </div>
</div>
