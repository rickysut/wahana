<!DOCTYPE html>
<html lang="en">

@php echo '<?php include "../config/menu.php"; ?>' @endphp
@php echo '<?php include "../partials/meta.php"; ?>' @endphp

<body id="solutions">

	<!-- ======= Header ======= -->
	@php echo '<?php include "../partials/header.php"; ?>' @endphp
	<!-- End Header -->
	<section id="solutions" class="hero-static d-flex align-items-center">
		<div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
			<h2>{{ $solutions->title }}</h2>
			<p>
				<span class="fst-italic">"{{ $quote }}"</span><br />{{ $person }}
			</p>
		</div>
	</section>

	<main id="main">

		<!-- ======= Portfolio Details Section ======= -->
		<section class="blog">
			<div class="container" data-aos="fade-up">
				<div class="row gy-4">
					<div class="col-lg-8">
						<article class="blog-details">
							<div class="post-img swiper m-1" >
								<img src="../assets/img/solutions/banner/{{ $solutions->banner }}" alt="" style="max-height:420px;">
							</div>

							<div class="content">
								{!! $solutions->detail !!}

							</div>
						</article>
					</div>
					@php echo '<?php include "../solutions/sidebar.php"; ?>' @endphp

				</div>

			</div>
		</section>
		<!-- End Portfolio Details Section -->

		<!-- call to action -->
		<section>
			<div class="container">
				<div class="row justify-content-center text-center" data-aos="zoom-in">
					<h4>Need to develop your Corporate University?</h4>
					<span class="fs-6">Feel free to consult with us!</span>
					<div class="text-center mt-3">
						<button class="btn btn-lg btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact Us Now</button>
					</div>
				</div>
			</div>
		</section>

	</main><!-- End #main -->
	<!-- ======= Footer ======= -->
	@php echo '<?php include "../partials/footer.php"; ?>' @endphp
	<!-- End Footer -->

	@php echo '<?php include "../partials/script.php"; ?>' @endphp

</body>

</html>
