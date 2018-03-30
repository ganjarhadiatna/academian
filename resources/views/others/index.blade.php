@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="sc-header padding-20px">
	<div class="sc-place">
		<div class="col-full">
			<div class="sc-grid sc-grid-1x">
				<div class="sc-col-2">
					<strong class="ttl-head-2 ttl-main-color ctn-serif ctn-up">{{ $title }}</strong>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="frame-home col-full">
	@if (count($topStory) == 0)
		@include('main.post-empty')
	@else
		<div class="post">
			@foreach ($topStory as $story)
			<a href="#">
				@include('main.post')
			</a>
			@endforeach
		</div>
		{{ $topStory->links() }}
	@endif
</div>
@endsection