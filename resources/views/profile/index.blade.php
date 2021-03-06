@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#post-nav ol li').each(function(index, el) {
			$(this).removeClass('active');
			$('#{{ $nav }}').addClass('active');
		});
	});
</script>
<div class="frame-profile">
	<div class="block pp-top">
		@foreach ($profile as $p)
			<div class="profile">
				<div class="foto">
					<div class="image image-150px image-circle" id="place-picture" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});"></div>
				</div>
				<div class="info">
						<h1 class="user-name ctn-main-font ctn-standar" id="edit-name">{{ $p->name }}</h1>
						<div>
							<p id="edit-about">{{ $p->about }}</p>
						</div>
						<div class="other">
							<a class="link" href="{{ $p->website }}" target="_blank">{{ $p->website }}</a>
						</div>
						<div>
							<div class="other mrg-bottom">
								<ul>
									<li>
										<a href="{{ url('/user/'.$p->id.'/story') }}">
											<div class="val">{{ $p->ttl_story }}</div>
											<div class="ttl">Stories</div>
										</a>
									</li>
									<li>
										<a href="{{ url('/user/'.$p->id.'/following') }}">
											<div class="val">{{ $p->ttl_following }}</div>
											<div class="ttl">Following</div>
										</a>
									</li>
									<li>
										<a href="{{ url('/user/'.$p->id.'/followers') }}">
											<div class="val">{{ $p->ttl_followers }}</div>
											<div class="ttl">Followers</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="other">
							@if (Auth::id() == $p->id)
								<a href="{{ url('/me/setting/profile') }}">
									<input type="button" name="edit" class="btn-1 btn btn-sekunder-color" id="btn-edit-profile" value="Edit Profile">
								</a>
								<a href="{{ url('/me/setting') }}">
									<button class="btn-2 btn btn-sekunder-color">
										<span class="fas fa-lg fa-cog"></span>
									</button>
								</a>
							@else
								@if (!is_int($statusFolow))
									<input type="button" name="edit" class="btn btn-sekunder-color" id="add-follow-{{ $p->id }}" value="Follow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
								@else
									<input type="button" name="edit" class="btn btn-main3-color" id="add-follow-{{ $p->id }}" value="Unfollow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
								@endif
							@endif
						</div>
					</div>
				</div>
		@endforeach
	</div>
	<div class="padding-20px">
		<div class="post-nav width-small radius" id="post-nav">
			<ol>
				<a href="{{ url('/user/'.$p->id.'/story') }}"><li class="active" id="story">Stories</li></a>
			    <a href="{{ url('/user/'.$p->id.'/bookmark') }}"><li id="bookmark">Saved</li></a>
			</ol>
		</div>
	</div>
	<div class="pp-bot col-full">
		<div class="padding-5px"></div>
		@if (count($userStory) == 0)
			@include('main.post-empty')
		@else
			<div class="post">
				@foreach ($userStory as $story)
				@include('main.post')
				@endforeach
			</div>
			{{ $userStory->links() }}
		@endif
	</div>
</div>
@endsection