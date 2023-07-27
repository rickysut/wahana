
						<div class="row row-cols-1 row-cols-md-2 row-cols-md-3 g-4 mb-5">
                            @foreach ($solutions as $item)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow">
                                        <img src="/assets/img/solutions/{{ $item->image }}" class="card-img-top-sol" alt="...">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="card-title">
                                                    <a href="/solutions/{{ \Str::slug($item->title) }}.php">{{ $item->title }}</a>
                                                </h5>
                                            </div>
                                            <p class="card-text">{{ $item->subtitle }}</p>
                                        </div>
                                        <div class="card-footer text-end">
                                            <small>
                                                <a href="/solutions/{{ \Str::slug($item->title) }}.php" class="btn btn-sm btn-primary">Read more</a>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
							
						</div>