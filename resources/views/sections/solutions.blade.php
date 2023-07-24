
<!-- ======= Services Section ======= -->
<section id="solutions" class="services">
	<div class="container" data-aos="fade-up">

		<div class="section-header" data-aos="zoom-out">
			<h2>Our Solutions</h2>
		</div>

		<div class="row gy-5 row-cols-1 row-cols-md-3 justify-content-center">
			@foreach ($solutions as $solution )
                <div class="col" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-item d-flex flex-column h-100">
                        <div class="img">
                            <img src="assets/img/{{ $solution->image }}" class="img-fluid-slider" alt="">
                        </div>
                        <div class="details position-relative flex-grow-1">
                            <div class="icon">
                                <i class="fa {{ $solution->icon }}"></i>
                            </div>
                            <a href="solutions/{{ \Str::slug($solution->title) }}.php" class="stretched-link text-warning">
                                <h3>{{ $solution->title }}</h3>
                            </a>
                            <p>{{ $solution->subtitle }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
			
			
		</div>

	</div>
</section>
<!-- End Services Section -->