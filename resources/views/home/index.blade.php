@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function(event) {
			var top = $(window).scrollTop();
			var hg = Math.floor($('#home-main-object').height() - $('#home-side-object').height());
			var top1 = Math.floor($('#home-primary-object').height() + ($('#home-side-object').height() - $(window).height()) + 80);
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
	<div class="sc-header">
		<div class="sc-place">
			<div class="col-all">
				<div class="place-search-tag ctr">
					<div class="st-lef">
							<div class="btn btn-circle btn-sekunder-color btn-no-border" onclick="toLeft()">
							<span class="fa fa-lg fa-angle-left"></span>
						</div>
					</div>
					<div class="st-mid" id="ctnTag">
						<div class="frame-top-ctr">
							<a href="{{ url('/timelines') }}">
								Timelines
							</a>
						</div>
						<div class="frame-top-ctr">
							<a href="{{ url('/fresh') }}">
								Fresh
							</a>
						</div>
						<div class="frame-top-ctr">
							<a href="{{ url('/popular') }}">
								Populars
							</a>
						</div>
						<div class="frame-top-ctr">
							<a href="{{ url('/trending') }}">
								Trendings
							</a>
						</div>
						@foreach ($topTags as $tg)
						<div class="frame-top-ctr">
							<a href="{{ url('/tags/'.$tg->tag) }}">
								{{ $tg->tag }}
							</a>
						</div>
						@endforeach
					</div>
					<div class="st-rig">
						<div class="btn btn-circle btn-sekunder-color btn-no-border" onclick="toRight()">
							<span class="fa fa-lg fa-angle-right"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="home-primary-object">
		<!--top banner-->
		<div class="banner">
			<div class="left">
				<div class="content">
					<h1 class="ttl-head ctn-main-font ctn-serif ctn-standar ctn-main-color ctn-thin">
						Everything's are Knowledge.
					</h1>
					<div class="padding-15px">
						<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-thin ctn-main-color">
							Some peoples have any Story in their lifes and it can be a Knowledge for other peoples.
							<br>
							So, share and read anything in here to change our lives together.
						</h4>
					</div>
					@if (is_null(Auth::id()))
						<div class="other">
							<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-bold ctn-main-color padding-bottom-10px">Join with us right now, and let's get started.</h4>
							<a href="{{ url('/register') }}">
								<button class="btn btn-main-color">
									Register
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
							<h4 class="ttl-sub ctn-main-font ctn-sans-serif ctn-bold ctn-main-color padding-bottom-10px">
								Let's get started to share anything that you want.
							</h4>
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
	</div>
	<div class="post-home grid">
		<div class="grid-1" id="home-main-object">
			@if (Auth::id())
				@if (count($timelinesStory) != 0)
					<div>
						<div class="need-mrg-left ttl-main-color">
							<label class="ctn-main-font ctn-sekunder-color ctn-keep">Timelines Stories</label>
						</div>
						@foreach ($timelinesStory as $story)
							@include('main.post-list')
						@endforeach
					</div>
				@endif
			@endif
			<div>
				<div class="need-mrg-left ttl-main-color">
					<label class="ctn-main-font ctn-sekunder-color ctn-keep">Trending Stories</label>
				</div>
				@foreach ($trendingStory as $story)
					@include('main.post-list')
				@endforeach
			</div>
			<div>
				<div class="need-mrg-left ttl-main-color">
					<label class="ctn-main-font ctn-sekunder-color ctn-keep">New Stories</label>
				</div>
				@foreach ($featuredStory as $story)
					@include('main.post-list')
				@endforeach
			</div>
		</div>
		<div class="grid-2">
			<div id="home-side-object">
				<div>
					<div class="ttl-main-color">
						<label class="ctn-main-font ctn-sekunder-color ctn-keep">Tranding Now's</label>
					</div>
					<div class="padding-bottom-10px"></div>
					@foreach ($topTags as $tg)
						<?php 
							$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
							$title = str_replace($replace, '', $tg->tag); 
						?>
						<a href="{{ url('/tags/'.$title) }}">
							<div class="frame-top-tag">
								{{ $tg->tag }}
							</div>
						</a>
					@endforeach
				</di>
				<div class="padding-bottom-10px"></div>
				<div>
					<div class="ttl-main-color padding-bottom-20px">
						<label class="ctn-main-font ctn-sekunder-color ctn-keep">Popular Now's</label>
					</div>
					<?php $i = 1; ?>
					@foreach ($popularStory as $story)
						@include('main.post-title')
						<?php $i += 1; ?>
					@endforeach
					@include('main.footer')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection