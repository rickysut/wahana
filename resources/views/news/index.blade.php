<!DOCTYPE html>
<html lang="en">

@php echo '<?php include "../config/menu.php"; ?>'."\n" @endphp
@php echo '<?php include "../partials/meta.php"; ?>'."\n" @endphp
@php echo '<?php $page = $_GET[\'page\']; 
	if (!$page) $page = 1;
?>'."\n" 
@endphp
<body>
	<!-- ======= Header ======= -->
	@php echo '<?php include "../partials/header.php"; ?>'."\n" @endphp
	<!-- End Header -->

	<main id="">

		<!-- ======= Breadcrumbs ======= -->
		<div class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>News</h2>
				</div>

			</div>
		</div><!-- End Breadcrumbs -->

		<!-- ======= Blog Section ======= -->
		<section id="news" class="blog">
			<div class="container" data-aos="fade-up">
				<div class="row g-5">

					<div class="col-lg-12">
					@foreach ($pages as $index => $item)
						@php echo '<?php if ($page=='.($index+1).')  include "page_'.($index+1).'.php"; ?>'."\n" @endphp
					@endforeach
                        
					@if ($pages->count() > 1)
						<div class="blog-pagination">
							<ul class="justify-content-center">
								@foreach ($pages as $index => $item)
									<li @php echo '<?php if ($page=='.($index+1).') echo \'class="active"\' ?>' @endphp ><a href="?page={{ ($index+1) }}">{{ ($index+1) }}</a></li>
								@endforeach
							</ul>
						</div><!-- End blog pagination -->
					@endif
					</div>
				</div>

			</div>
		</section><!-- End Blog Section -->

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	@php echo '<?php include "../partials/footer.php"; ?>'."\n" @endphp
	<!-- End Footer -->

	@php echo '<?php include "../partials/script.php"; ?>'."\n" @endphp

</body>

</html>