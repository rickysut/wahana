<section id="solutions" class="services">
	<div class="container" data-aos="fade-up">

		<div class="section-header" data-aos="zoom-out">
			<a href="/solutions/index.php">
				<h2>Our Solutions</h2>
			</a>
		</div>

		<div class="row gy-5  row-cols-1 row-cols-md-3 justify-content-center">
            @foreach ($solutions as $item)
                
                <div class="col" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item d-flex flex-column h-100">
                        <div class="img">
                            <img src="/assets/img/{{ $item->image }}" class="img-fluid-slider" alt="">
                        </div>
                        <div class="details position-relative flex-grow-1">
                            <div class="icon">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                            <a href="/solutions/{{ \Str::slug($item->title) }}.php" class="stretched-link text-warning">
                                <h3>{{ $item->title }}</h3>
                            </a>
                            <p>{{ $item->subtitle }}</p>
                        </div>
                    </div>
                </div>

            @endforeach
			
		</div>

	</div>
</section>
<!-- End Services Section -->