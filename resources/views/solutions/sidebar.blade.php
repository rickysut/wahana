<div class="col-lg-4">
	<div class="sidebar">

		<div class="sidebar-item recent-posts">
			<h3 class="sidebar-title">Other Solutions</h3>
			<!-- the items list should exclude the displayed page -->
			<div class="mt-3">
                @foreach ($solutions as $item)
                    <div class="post-item" @php echo "<?php echo (activePage(\$dataPage) == '".\Str::slug($item->title) ."') ?  'hidden' : '' ?> " @endphp >
                        <img src="/assets/img/solutions/{{ $item->image }}" alt="" style="height: 70px; width: 70px">
                        <div>
                            <h4><a href="/solutions/{{ \Str::slug($item->title) }}.php">{{ $item->title }}</a></h4>
                        </div>
                    </div>
                @endforeach
			</div>

		</div><!-- End sidebar recent posts-->

	</div><!-- End Blog Sidebar -->

</div>