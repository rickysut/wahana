<div class="row gy-4 posts-list">

    @foreach ($page as $item)
    @php $carbonDate =  \Carbon\Carbon::parse($item->event_date); @endphp
    <div class="col-lg-4">
        <div class="card h-100 border-0 shadow">
            <div id="event-date" class="event-date">
                <div class="row">
                    <span class="fw-bold" style="font-size:28px; font-weight:900; ">{{ $carbonDate->format('d') }}</span>
                    <span class="" style="font-size:14px;">{{ $carbonDate->format('M') }}</span>
                </div>
            </div>
            <img src="/assets/img/events/{{ $item->front_image }}" class="card-img-top" style="height: 300px; width: 100%;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        <a href="/events/{{ \Str::slug($item->title) }}.php">{{ $item->title }}</a>
                    </h5>
                    @if ($item->kind == 1)
                    <span class="badge text-bg-primary">
                        Event                        
                    </span>
                    @else
                    <span class="badge text-bg-warning">
                        Workshop                        
                    </span>
                    @endif
                </div>
                <span class="card-text d-flex justify-content-between mb-3">
                    <small class="text-body-secondary">
                        <!-- author or speaker -->
                        <i class="fa fa-microphone text-body-tertiary"></i>
                        <span class="text-primary">{{ $item->speaker_name }}</span> |
                        <!-- event date or created_at -->
                        <i class="fa fa-calendar-day text-body-tertiary"></i>
                        <span class="text-primary">{{ $carbonDate->format('M d, Y')  }}</span> |
                        <!-- venue -->
                        <i class="fa fa-map-marker-alt mr-1"></i>
                        <span class="text-primary">{{ $item->location }}</span>
                    </small>
                </span>
                <p class="card-text">{{ $item->subtitle }}</p>
                <small>
                    @if ($carbonDate > \Carbon\Carbon::now()->addDay() )
                        @php echo '<?php include "../partials/book-now-button.php"; ?>'."\n" @endphp    
                    @endif
                    
                </small>
            </div>
        </div>
    </div>
    
    @endforeach
    
</div><!-- End blog posts list -->
