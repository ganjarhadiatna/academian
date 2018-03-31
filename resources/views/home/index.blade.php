@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function(event) {
			var top = $(window).scrollTop();
			var hg = Math.floor($('#home-main-object').height() - $('#home-side-object').height());
			var top1 = Math.floor($('#home-primary-object').height());
			if (top >= top1) {
				$('#home-side-object').attr('class', 'side-fixed');
			}
			if (top >= (hg + top1)) {
				$('#home-side-object').attr('class', 'side-absolute');
			}
			if (top < top1) {
				$('#home-side-object').attr('class', '');
			}
		});
	});
</script>
<div class="padding-bottom-5px"></div>
<div class="frame-home">
	<div class="col-full">
		<div id="home-primary-object">
			<div class="top-banner grid grid-2x padding-10px">
				<div class="tb-main grid-1">
					@foreach ($topStory as $story)
						<div class="frame-image">
							<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
								<div class="top" >
									<div class="img" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})"></div>
								</div>
							</a>
							<div class="bot">
								<div class="mn-title2 ctn ctn-sans-serif">{{ $story->title }}</div>
							</div>
						</div>
					@endforeach
				</div>

				<?php $i = 1; ?>
				<div class="tb-side grid-2">
					@foreach ($topAllStory as $story)
						<div class="frame-image">
							<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
								<div class="top" >
									<div class="img" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})"></div>
								</div>
							</a>
							<div class="bot">
								<div class="mn-title2 ctn ctn-sans-serif">{{ $story->title }}</div>
							</div>
						</div>
						<?php $i += 1; ?>
					@endforeach
				</div>
			</div>
			@if (Auth::id())
				@if (count($timelinesStory) != 0)
					<div>
						<div class="padding-20px">
							<div class="need-mrg-left ttl-main-color padding-bottom-15px">
								<label class="ctn-up">Timelines</label>
							</div>
							<div class="post">
								<?php $i = 1; ?>
								@foreach ($timelinesStory as $story)
									@if ($i <= 4)
										@include('main.post-list')
									@else
										@include('main.post')
									@endif
									<?php $i += 1; ?>
								@endforeach
							</div>
						</div>
					</div>
				@endif
			@endif
			<div>
				<div class="padding-20px">
					<div class="need-mrg-left ttl-main-color padding-bottom-15px">
						<label class="ctn-up">Fresh</label>
					</div>
					<div class="post">
						<?php $i = 1; ?>
						@foreach ($newStory as $story)
							@if ($i <= 4)
								@include('main.post-list')
							@else
								@include('main.post')
							@endif
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
			<div>
				<div class="padding-20px">
					<div class="need-mrg-left ttl-main-color padding-bottom-20px">
						<label class="ctn-up">Trandings</label>
					</div>
					<div class="post post-2">
						<?php $i = 1; ?>
						@foreach ($trendingStory as $story)
							@if ($i <= 4)
								@include('main.post-list')
							@else
								@include('main.post')
							@endif
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="post-home grid">
				<div class="grid-1 padding-bottom-20px" id="home-main-object">
					<div class="need-mrg-left ttl-main-color padding-bottom-20px">
						<label class="ctn-up">Featured</label>
					</div>
					@foreach ($featuredStory as $story)
					@include('main.post-list')
					@endforeach
				</div>
				<div class="grid-2">
					<div id="home-side-object">
						<div class="ttl-main-color padding-bottom-20px">
							<label class="ctn-up">Popular Now's</label>
						</div>
						<?php $i = 1; ?>
						@foreach ($popularStory as $story)
							<div class="frame frame-post-popular">
								<div class="main">
									<div class="sd-main">
										<div class="count">{{ '0'.$i }}</div>
									</div>
									<div class="sd-right">
										<div class="mid">
											<div>
												<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
													{{ $story->title }}
												</a>
											</div>
											<div class="date">
												<span class="ttl-views">{{ date('F d, Y', strtotime($story->created)) }}</span>
											</div>
											<div class="info">
												<a href="{{ url('/u/'.$story->id) }}">
													<span class="name">By {{ $story->name }}</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php $i += 1; ?>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection