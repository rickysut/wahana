<!DOCTYPE html>
<html lang="en">

@php echo '<?php include "../config/menu.php"; ?>'."\n" @endphp
@php echo '<?php include "../partials/meta.php"; ?>'."\n" @endphp
@php echo '<?php include "../config/phonenumber.php"; ?>'."\n" @endphp
@php $carbonDate =  \Carbon\Carbon::parse($item->event_date); @endphp
<body>

	<!-- ======= Header ======= -->
	@php echo '<?php include "../partials/header.php"; ?>'."\n" @endphp 
	<!-- End Header -->

	<main id="main">
		<!-- ======= Portfolio Details Section ======= -->
		<section id="events" class="blog mt-5">
			<div class="container" data-aos="fade-up">
				<div class="row gy-4">
					<div class="col-lg-8">
						<article class="blog-details">
							<div class="post-img portfolio-details-slider swiper">
								<div class="swiper-wrapper align-items-center" style="max-height: 450px;">
                                    @foreach ($item->slider as $img)
									<div class="swiper-slide">
										<img src="/assets/img/events/slider/{{ $img }}" alt="">
									</div>
									@endforeach
								</div>
								<div class="swiper-pagination"></div>
							</div>

							<h2 class="title">{{ $item->title }}</h2>

							<div class="meta-top">
								<ul>
									<li class="d-flex align-items-center"><i class="fa fa-microphone"></i>{{ $item->speaker_name }}</li>
									<li class="d-flex align-items-center"><i class="bi bi-calendar"></i> <time datetime="{{ $carbonDate->format('Y-m-d') }}">{{ $carbonDate->format('M d, Y') }}</time></a></li>
								</ul>
							</div><!-- End meta top -->


							<div class="content">
								{!! $item->detail !!}
							</div>

						</article>
					</div>

					<div class="col-lg-4">
						@if ($item->speaker_name)
						<div class="row mt-5 mb-3">
							<div class="col mt-3">
								<div class="card border-0 mb-g shadow">
									<div class="row no-gutters row-grid">
										<div class="col-12">
											<div class="d-flex flex-column align-items-center justify-content-center p-4 border-bottom">
												<img src="/assets/img/events/{{ $item->speaker_img }}" class="author img-fluid rounded-circle shadow-2 img-thumbnail" alt="">
												<h5 class="mb-0 mt-5 fw-bold text-center">
													{{ $item->speaker_name }}
												</h5>
												<small class="text-muted mb-0">{{ $item->speaker_title }}</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
						@if ($item->information)
						<div class="card border-0 shadow mb-3" style="background-color: #f7f7f7;">
							<div class="card-body">
								<h3 class="card-title text-mute">Event Informations</h3>
								<p class="excerpt-detail">
									{{ $item->information }}
								</p>
							</div>
						</div>
						@endif

						@if ($item->location)
							
						
						<div class="card border-0 shadow">
							
							<div class="card-body">
								<h5 class="card-title">Location :</h5>
								<ul class="list-group list-group-flush">
									<li class="list-group-item d-flex justify-content-start align-items-top">
										<div class="col-2">
											<i class="fa fa-map-marker-alt"></i>
										</div>
										<div class="col-10">
											<span>
												{{ $item->location }}
											</span>
										</div>
									</li>
									<li class="list-group-item d-flex justify-content-start align-items-top">
										<div class="col-2">
											<i class="fa fa-clock"></i>
										</div>
										<div class="col-10">
											<span>
												{{ $carbonDate->format('M d, Y h:i') }}
											</span>
										</div>
									</li>
								</ul>
								<!-- <hr> -->
								<div class="d-grid mt-5">
									@if ($carbonDate > \Carbon\Carbon::now()->addDay())
										@php echo '<?php include "../partials/book-now-button.php"; ?>'."\n" @endphp    
									@endif
								</div>
							</div>
						</div>
						@endif
					</div>

				</div>

			</div>
		</section>
		<!-- End Portfolio Details Section -->

	</main><!-- End #main -->
	<!-- Modal -->
	<!-- ======= Footer ======= -->
	@php echo '<?php include "../partials/footer.php"; ?>'."\n" @endphp
	<!-- End Footer -->

	@php echo '<?php include "../partials/script.php"; ?>'."\n" @endphp


</body>

</html>