@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="sc-header padding-20px">
	<div class="sc-place">
		<div class="sc-block">
			<div class="sc-col-1">
				<h1 class="ttl-head ctn-main-font ctn-serif ctn-upp ctn-bold ctn-standar ctn-main-color">{{ $title }}</h1>
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