<div class="row gy-4 posts-list">

    @foreach ($page as $item)
    <div class="col-lg-4">
        <article class="d-flex flex-column">

            <div class="post-img">
                <img src="/assets/img/news/{{ $item->front_image }}" alt="" class="img-fluid">
            </div>

            <h2 class="title">
                <a href="/news/{{ \Str::slug($item->title) }}.php">{{ $item->title }}</a>
            </h2>

            <div class="meta-top">
                <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $item->user->name }}</li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <span>{{ $item->updated_at->format('M d, Y') }}</span></li>

                </ul>   
            </div>

            <div class="content">
                <p>
                    {{ $item->subtitle }}
                </p>
            </div>

            <div class="read-more mt-auto align-self-end">
                <a href="/news/{{ \Str::slug($item->title) }}.php">Read More</a>
            </div>

        </article>
    </div><!-- End post list item -->
    @endforeach
    
</div><!-- End blog posts list -->
