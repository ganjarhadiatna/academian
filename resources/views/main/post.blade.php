<div class="frame frame-post">
	<div class="main">
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $story->title); 
		?>
		@if ($story->cover != '')
			<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
				<div class="top" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})"></div>
			</a>
		@endif
		<div class="main-mid">
			<div class="mid">
				<div>
					<!--
					<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
						{{ $story->title }}
					</a>
					-->
					<?php 
						$ttl = explode('.', $story->title);
					?>
					@if (count($ttl) <= 1)
						<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
							{{ $story->title }}
						</a>
					@else
						<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
							{{ $ttl[0] }}
						</a>
						<div class="ctn-main-font ctn-normal ctn-date ctn-sans-serif">
							@for ($i = 1; $i < count($ttl); $i++)
								{{ $ttl[$i] }}
							@endfor
						</div>
					@endif
				</div>
				<div class="date">
					<span class="ttl-views">{{ date('F d, Y', strtotime($story->created)) }}</span>
				</div>
			</div>
			<div class="bot">
				<div class="bot-1">
					<div class="info">
						<a href="{{ url('/u/'.$story->id) }}">
							<span class="name">{{ $story->name }}</span>
						</a>
					</div>
				</div>
				<div class="bot-2">
					<button class="btn btn-circle btn-sekunder-color btn-no-border" key="{{ $story->idstory }}" onclick="addBookmark('{{ $story->idstory }}')">
						@if (is_int($story->is_save))
							<span class="bookmark-{{ $story->idstory }} fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
						@else
							<span class="bookmark-{{ $story->idstory }} far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
						@endif
					</button>
				</div>
			</div>
		</div>
	</div>
</div>