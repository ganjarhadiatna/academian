@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="frame-guess">
	<div class="banner bdr-bottom">
		<div class="cover">
			<div class="title">
				<div class="mn-title ctn-serif">Everything's are Knowledge.</div>
				<div class="frame-info width-all">
					<div class="padding-15px">
						<strong>Join Academian today.</strong>
					</div>
					<a href="{{ url('/login') }}">
						<button class="mrg-bottom create btn btn-main2-color" id="compose">
							<span class="ttl-post">Login</span>
						</button>
					</a>
					<a href="{{ url('/register') }}">
						<button class="btn btn-main-color" id="compose">
							<span class="ttl-post">Register</span>
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="block theme-2 bdr-bottom">
		<div class="frame-info">
			<div class="pos top">
				<div class="icn far fa-lg fa-lightbulb"></div>
			</div>
			<div class="mid">
				Find your idea and knowledge.
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fa fa-lg fa-pencil-alt"></div>
			</div>
			<div class="mid">
				Create and share your story.
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn far fa-lg fa-comments"></div>
			</div>
			<div class="mid">
				Join the conversations.
			</div>
		</div>
	</div>
	<div class="block">
		<div class="cover">
			<div class="frame-info width-all">
				<div>
					<h2>Let's get Started.</h2>
				</div>
				<div class="padding-10px"></div>
				<a href="{{ url('/login') }}">
					<button class="mrg-bottom create btn btn-main2-color" id="compose">
						<span class="ttl-post">Login</span>
					</button>
				</a>
				<a href="{{ url('/register') }}">
					<button class="btn btn-main-color" id="compose">
						<span class="ttl-post">Register</span>
					</button>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection