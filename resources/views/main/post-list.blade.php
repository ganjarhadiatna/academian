<div class="frame frame-post-list">
	<div class="main">
		<?php 
			$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
			$title = str_replace($replace, '', $story->title); 
		?>
		<div class="sd-right">
			<div class="mid">
				<div>
					<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}" class="mn-ttl tclr ttl-post ctn-sans-serif">
						{{ $story->title }}
					</a>
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
		<div class="sd-left">
			<a href="{{ url('/story/'.$story->idstory.'/'.$title) }}">
				<div class="top" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }})">
				</div>
			</a>
		</div>
	</div>
</div>