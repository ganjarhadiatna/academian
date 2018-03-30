<div class="more-menu" id="more-menu">
	<ul>
		@if (Auth::id())
			<a href="{{ url('/timelines') }}">
				<li class="icn-mobile bdr-bottom" id="timelines">Timelines</li>
			</a>
		@endif
		<a href="{{ url('/fresh') }}">
			<li class="icn-mobile bdr-bottom" id="fresh">Fresh</li>
		</a>
		<a href="{{ url('/popular') }}">
			<li class="icn-mobile bdr-bottom" id="popular">Popular</li>
		</a>
		<a href="{{ url('/trending') }}">
			<li class="icn-mobile" id="trending">Trending</li>
		</a>
	</ul>
</div>