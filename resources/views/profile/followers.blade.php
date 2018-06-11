@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="sc-header padding-20px">
	<div class="sc-place">
		<div class="sc-block">
			<div class="sc-col-1">
				<h1 class="ttl-head ctn-main-font ctn-sans-serif ctn-bold">
					{{ $ttl_followers }} Followers
				</h1>
			</div>
		</div>
	</div>
</div>
<div class="frame-home">
	<div class="place-follow">
		<div>
			@foreach ($profile as $p)
				@include('main.user-list')
			@endforeach
		</div>
	</div>
</div>
@endsection