@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="sc-header">
	<div class="sc-place no-border">
		<div class="padding-20px">
			<div class="sc-block">
				<div class="sc-col-1">
					<h1 class="ttl-head ctn-main-font ctn-serif ctn-bold ctn-standar ctn-main-color">
						Everything's are Knowledge.
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-full">
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