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
<div class="col-full">
	<div id="home-primary-object">
		<!--top banner-->
		<div class="banner">
			<div class="left">
				<div class="content">
					<h1 class="ttl-head ctn-main-font ctn-serif ctn-bold ctn-big ctn-main-color">
						Everything's are Knowledge.
					</h1>
					<div class="padding-15px">
						<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-thin ctn-main-color">
							Some peoples have any Story in their lifes and it can be a Knowledge for other peoples.
							So, share and read anything in here to change our lives together.
						</h4>
					</div>
					@if (is_null(Auth::id()))
						<div class="other">
							<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-bold ctn-main-color padding-bottom-10px">Join with us right now, and let's get started.</h4>
							<a href="{{ url('/register') }}">
								<button class="btn btn-main-color">
									Get Started
								</button>
							</a>
							<a href="{{ url('/login') }}">
								<button class="btn btn-sekunder-color">
									Login
								</button>
							</a>
						</div>
					@else
						<div class="other">
							<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-bold ctn-main-color padding-bottom-10px">Let's share your story and create whatever you want.</h4>
							<a href="{{ url('/compose') }}">
								<button class="btn btn-main-color">
									<span class="fas fa-lg fa-plus-circle"></span>
									<span class="ttl-post">Create Story</span>
								</button>
							</a>
						</div>
					@endif
				</div>
			</div>
			<div class="side" style="background-image: url('{{ asset('img/banner/1.png') }}');"></div>
		</div>
		@if (Auth::id())
			@if (count($timelinesStory) != 0)
				<div class="padding-15px">
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
			@endif
		@endif
		<div class="padding-15px">
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
		<div class="padding-15px">
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
					@include('main.post-title')
					<?php $i += 1; ?>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection