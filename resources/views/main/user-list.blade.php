<div class="frame-follow">
	<div class="ff-top top">
		<a href="{{ url('/user/'.$p->id) }}">
			<div class="image image-35px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$p->foto) }});"></div>
		</a>
	</div>
	<div class="ff-mid mid">
		<div class="fl-ttl">
			<a href="{{ url('/user/'.$p->id) }}">{{ $p->name }}</a>
		</div>
	</div>
	<div class="ff-bot bot">
		@if (Auth::id() != $p->id)
			@if (is_int($p->is_following))
				<input type="button" name="follow" class="btn btn-main3-color" id="add-follow-{{ $p->id }}" value="Unfollow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
			@else
				<input type="button" name="follow" class="btn btn-sekunder-color" id="add-follow-{{ $p->id }}" value="Follow" onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
			@endif
		@endif
	</div>
</div>