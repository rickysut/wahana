<ul class="list-unstyled">
    @foreach ($page as $item)
    @php $carbonDate =  \Carbon\Carbon::parse($item->event_date); @endphp
    <li>
        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 text-decoration-none border-bottom" href="/events/{{ \Str::slug($item->title) }}.php">
            <svg class="bd-placeholder-img" width="32" height="32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <rect width="100%" height="100%" fill="#ffc107" />
                <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#000" font-size="16px" font-weight="bold">{{ $loop->iteration }}</text>
            </svg>
            <div class="col-lg-8">
                <h6 class="mb-0">{{ $item->title }}</h6>
                <small class="text-light">{{ $carbonDate->format('M d, Y')  }}</small>
            </div>
        </a>
    </li>
    @endforeach
</ul>