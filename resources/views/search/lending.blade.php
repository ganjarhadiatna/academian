@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#place-search-now').submit(function(event) {
			var ctr = $('#txt-search-now').val();
			window.location = "{{ url('/search/') }}"+'/'+ctr;
		});
	});
</script>
<div class="col-full">
	<div class="padding-20px">
		<div class="main-search bdr-bottom">
			<div class="field-search" id="field-search">
				<form id="place-search-now" action="javascript:void(0)">
					<input type="text" name="q" class="txt txt-main-color txt-radius txt-search" id="txt-search-now" placeholder="Search academian" required="true" autofocus="true">
				</form>
			</div>
		</div>
	</div>
	<div class="padding-10px"></div>
	<div>
		@if (count($topTags) != 0)
			<div class="ctn-main-font ctn-sekunder-color ctn-keep padding-bottom-10px">
				<label>Tranding Now's</label>
			</div>
			@foreach ($topTags as $tag)
				<?php 
					$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
					$title = str_replace($replace, '', $tag->tag); 
				?>
				<a href="{{ url('/tags/'.$title) }}">
					<div class="frame-top-tag">
						{{ $tag->tag }}
					</div>
				</a>
			@endforeach 
			<div class="padding-10px"></div>
		@endif
	</div>
</div>
@endsection