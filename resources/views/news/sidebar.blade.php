<div class="col-lg-4">

    <div class="sidebar">

        <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">Recent Posts</h3>

            <div class="mt-3">
                @foreach ($news as $item)
                    
                
                <div class="post-item mt-3">
                    <img src="/assets/img/news/{{ $item->front_image }}" alt="" class="flex-shrink-0">
                    <div>
                        <h4><a href="/news/{{ \Str::slug($item->title) }}.php">{{ $item->title }}</a></h4>
                        <time datetime="{{ $item->created_at->format('d-m-Y') }}">{{ $item->created_at->format('d-m-Y H:i:s') }}</time>
                    </div>
                </div><!-- End recent post item-->

                @endforeach

            </div>

        </div><!-- End sidebar recent posts-->

    </div><!-- End Blog Sidebar -->

</div>