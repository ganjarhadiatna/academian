@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-home">
	<div class="col-full">
		<div class="block">
			<div class="post-home grid grid-2x">
				<div class="grid-1">
					<div class="need-mrg-left ttl-main-color padding-bottom-20px">
						<label class="ctn-up">Featured</label>
					</div>
					@foreach ($allStory as $story)
					@include('main.post-list')
					@endforeach
				</div>
				<div class="grid-2">
					<div class="follow mg-bottom place-follow">
						<div class="ttl-main-color padding-bottom-20px">
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
						<div class="ttl-main-color padding-bottom-20px">
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
		<div class="block">
			<div class="need-mrg-left ttl-main-color padding-bottom-20px">
				<label class="ctn-up">Fresh</label>
			</div>
			<div class="post">
				@foreach ($allStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<div class="need-mrg-left ttl-main-color padding-bottom-20px">
				<label class="ctn-up">Populars</label>
			</div>
			<div class="post post-2">
				@foreach ($popularStory as $story)
				@include('main.post-list')
				@endforeach
			</div>
			<div class="post">
				@foreach ($popularStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<div class="need-mrg-left ttl-main-color padding-bottom-20px">
				<label class="ctn-up">Trandings</label>
			</div>
			<div class="post post-2">
				@foreach ($trendingStory as $story)
				@include('main.post-list')
				@endforeach
			</div>
			<div class="post">
				@foreach ($trendingStory2 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
		<div class="block">
			<div class="need-mrg-left ttl-main-color padding-bottom-15px">
				<label class="ctn-up">Top Stories</label>
			</div>
			<div class="post">
				@foreach ($topStory9 as $story)
				@include('main.post')
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection