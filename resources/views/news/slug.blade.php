<!DOCTYPE html>
<html lang="en">

@php echo '<?php include "../config/menu.php"; ?>'."\n" @endphp
@php echo '<?php include "../partials/meta.php"; ?>'."\n" @endphp
@php echo '<?php include "../config/phonenumber.php"; ?>'."\n" @endphp
<body>

	<!-- ======= Header ======= -->
	@php echo '<?php include "../partials/header.php"; ?>'."\n" @endphp 
	<!-- End Header -->

	<main id="main">
		<!-- ======= Portfolio Details Section ======= -->
		<section id="news" class="blog mt-5">
			<div class="container" data-aos="fade-up">
				<div class="row gy-4">
					<div class="col-lg-8">
						<article class="blog-details">
							<div class="post-img portfolio-details-slider swiper">
								<div class="swiper-wrapper align-items-center" style="max-height: 450px;">
                                    @foreach ($item->slider as $img)
									<div class="swiper-slide">
										<img src="/assets/img/news/slider/{{ $img }}" alt="" style="height: auto; width: 100%; object-fit: cover; object-position: center;">
									</div>
									@endforeach
								</div>
								<div class="swiper-pagination"></div>
							</div>

							<h2 class="title">{{ $item->title }}</h2>

							<div class="meta-top">
								<ul>
									<li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $item->user->name }}</li>
									<li class="d-flex align-items-center"><i class="bi bi-clock"></i><span>{{ $item->updated_at->format('M d, Y') }}</span></li>
								</ul>
							</div><!-- End meta top -->

							<div class="content">
								{!! $item->detail !!}
							</div>

						</article>
					</div>

					@php echo '<?php include "sidebar.php"; ?>'."\n" @endphp

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