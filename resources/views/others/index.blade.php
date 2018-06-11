@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="col-full">
	<div class="padding-20px">
		<div class="padding-20px">
			<h1 class="ttl-head ctn-main-font ctn-sans-serif ctn-bold ctn-standar ctn-center ctn-sekunder-color">
				{{ $title }}
			</h1>
		</div>
	</div>
	@if (count($topStory) == 0)
		@include('main.post-empty')
	@else
		<div class="post">
			<?php $i = 1; ?>
			@foreach ($topStory as $story)
				@if ($i <= 4)
					@include('main.post-list')
				@else
					@include('main.post')
				@endif
				<?php $i += 1; ?>
			@endforeach
		</div>
		{{ $topStory->links() }}
	@endif
</div>
@endsection