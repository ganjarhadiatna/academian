@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function(event) {
			var top = $(window).scrollTop();
			var hg = Math.floor($('#home-main-object').height() - $('#home-side-object').height());
			var top1 = Math.floor($('#home-side-object').height() - ($(window).height() - 100));
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
<div class="frame-home col-full">
	<div class="post-home grid grid-2x">
		<div class="grid-1">
			<div id="home-main-object">
				@foreach ($topStory as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="grid-2">
			<div id="home-side-object">
				<div class="follow mg-bottom place-follow">
					<div class="ttl-main-color padding-10px">
						<label class="ctn-up">Popular Now's</label>
					</div>
					<?php $i = 1; ?>
					@foreach ($popularStory3 as $story)
						<div class="frame frame-post-popular">
							<div class="main">
								<div class="sd-main">
									<div class="count">{{ '0'.$i }}</div>
								</div>
								<div class="sd-right">
									<div class="mid">
										<div>
											<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-serif">
												{{ $story->title }}
											</a>
										</div>
										<div class="date">
											<span class="ttl-views">{{ $story->views }} Views</span>
											<span class="fas fa-lw fa-circle"></span>
											<span class="ttl-views">{{ $story->loves }} Loves</span>
											<span class="fas fa-lw fa-circle"></span>
											<span class="ttl-views">{{ $story->ttl_comment }} Comments</span>
										</div>
										<div class="date">
											<span class="ttl-views">Published on {{ $story->created }}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php $i += 1; ?>
					@endforeach
				</div>
				<div class="follow place-tranding">
					<div class="ttl-main-color padding-10px">
						<label class="ctn-up">Tranding Now's</label>
					</div>
					<ul>
						@foreach($topTags as $tag)
						<?php 
							$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
							$title = str_replace($replace, '', $tag->tag); 
						?>
						<li class="tag">
							<div class="ttl-head">
								<a href="{{ url('/tags/'.$title) }}">
									{{ $tag->tag }}
								</a>
							</div>
							<div class="ttl-ctn">{{ $tag->ttl_tag }} Stories</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
	{{ $topStory->links() }}
</div>
@endsection