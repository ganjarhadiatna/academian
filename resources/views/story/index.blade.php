@extends('layout.index')
@section('title',$title)
@section('path',$path)
@section('content')
@foreach ($getStory as $story)
<script type="text/javascript">
	var id = '{{ Auth::id() }}';
	var server = '{{ url("/") }}';

	function getComment(idstory, stt) {
		var offset = $('#offset-comment').val();
		var limit = $('#limit-comment').val();
		if (stt == 'new') {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/0/'+offset;
		} else {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/'+offset+'/'+limit;
		}
		$.ajax({
			url: url_comment,
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_user = server+'/user/'+data[i].id;
				if (data[i].id == id) {
					var op = '<span class="fa fa-lg fa-circle"></span>\
							<span class="del pointer" onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+data[i].idcomment+")'"+')" title="Delete comment.">Delete</span>';
				} else {
					var op = '';
				}
				dt += '\
					<div class="frame-comment">\
						<div class="grid-2x padding-bottom-5px">\
							<div class="dt-1">\
								<a href="'+server_user+'" title="'+data[i].name+'">\
									<div class="image image-40px image-circle" style="background-image: url('+server_foto+')"></div>\
								</a>\
							</div>\
							<div class="dt-2">\
								<a href="'+server_user+'" title="'+data[i].name+'">\
									<span class="name ctn-main-font ctn-normal ctn-bold ctn-main-color">'+data[i].name+'</span>\
								</a>\
							</div>\
						</div>\
						<div>\
							<div class="ctn-main-font ctn-normal ctn-thin ctn-main-color">\
								'+data[i].description+'\
							</div>\
							<div class="tgl ctn-main-font ctn-date ctn-thin ctn-sek-color">\
								<span>'+data[i].created+'</span>\
								'+op+'\
							</div>\
						</div>\
					</div>\
				';
			}
			if (stt === 'new') {
				$('#place-comment').html(dt);
			} else {
				$('#place-comment').append(dt);

				var ttl = (parseInt($('#offset-comment').val()) + 5);
				$('#offset-comment').val(ttl);
			}
			if (data.length >= limit) {
				$('#frame-more-comment').show();
			} else {
				$('#frame-more-comment').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function deleteComment(idcomment) {
		$.ajax({
			url: '{{ url("/delete/comment") }}',
			type: 'post',
			data: {'idcomment': idcomment},
		})
		.done(function(data) {
			if (data === 'success') {
				getComment('{{ $story->idstory }}', 'new');
			} else {
				opAlert('open', 'Deletting comment failed.');
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		}).
		always(function() {
			opQuestion('hide');
		});
	}
	function toComment() {
		var top = $('#tr-comment').offset().top;
		$('html, body').animate({scrollTop : (Math.round(top) - 70)}, 300);
		$('#comment-description').focus();
	}
	function toUp() {
		$('html, body').animate({scrollTop : 0}, 300);
	}
	$(document).ready(function() {
		$('#offset-comment').val(0);
		$('#limit-comment').val(5);
		getComment('{{ $story->idstory }}', 'add');

		hideElement('#tool-panel');

		$('#frame-loves').on('click', function(event) {
			$.ajax({
				url: '{{ url("/loves/add") }}',
				type: 'post',
				data: {'idstory': '{{ $story->idstory }}', 'ttl-loves': 1},
			})
			.done(function(data) {
				$('#ttl-loves').html(data);
			});
		});

		$('#comment-publish').submit(function(event) {
			var idstory = '{{ $story->idstory }}';
			var desc = $('#comment-description').val();
			if (desc === '') {
				$('#comment-description').focus();
			} else {
				$.ajax({
					url: '{{ url("/add/comment") }}',
					type: 'post',
					data: {
						'description': desc,
						'idstory': idstory
					},
				})
				.done(function(data) {
					if (data === 'failed') {
						opAlert('open', 'Sending comment failed.');
						$('#comment-description').focus();
					} else {
						$('#comment-description').val('');
						//refresh comment
						getComment('{{ $story->idstory }}', 'new');
					}
				})
				.fail(function(data) {
					console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		});

		$('#load-more-comment').on('click', function(event) {
			getComment('{{ $story->idstory }}', 'add');
		});

	});
</script>
<div class="place-story">
	<div class="main">
		<div class="place">
			<div class="frame-story" id="main-story">
				<div class="pos top">
					<div class="profile padding-20px">
						<div class="foto">
							<a href="{{ url('/user/'.$story->id) }}">
								<div class="image image-50px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
							</a>
						</div>
						<div class="info">
							<div class="name">
								<div>
									<span class="mn">
										<a href="{{ url('/user/'.$story->id) }}">{{ $story->name }}</a>
									</span>
									<span>
										@if ($story->id != Auth::id())
											@if (is_int($statusFolow))
												<input type="button" name="follow" class="btn btn-main3-color" id="add-follow-{{ $story->id }}" value="Unfollow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
											@else
												<input type="button" name="follow" class="btn btn-sekunder-color" id="add-follow-{{ $story->id }}" value="Follow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
											@endif
										@endif
									</span>
								</div>
								<div class="ctn-main-font ctn-sekunder-color ctn-thin ctn-sans-serif ctn-date">Published on {{ date('F d, Y h:i:sa', strtotime($story->created)) }}</div>
							</div>
						</div>
					</div>
				</div>
				<div class="padding-5px"></div>
				<div class="pos mid">
					<?php 
						$ttl = explode('.', $story->title);
					?>
					<div>
						@if (count($ttl) <= 1)
							<div class="main-title padding-bottom-10px">
								<h1 class="ctn-main-font ctn-main-color ctn-sans-serif ctn-title">
									{{ $story->title }}
								</h1>
							</div>
						@else
							<div class="main-title padding-bottom-10px">
								<h1 class="ctn-main-font ctn-main-color ctn-sans-serif ctn-small ctn-bold">
									{{ $ttl[0] }}
								</h1>
							</div>
							<div class="ctn-main-font ctn-sekunder-color ctn-sans-serif ctn-desc ctn-skip-link padding-bottom-20px">
								@for ($i = 1; $i < count($ttl); $i++)
									{{ $ttl[$i] }}
								@endfor
							</div>
						@endif
					</div>
					@if ($story->cover != '')
						<div class="story-cover padding-bottom-20px">
							<img src="{{ asset('/story/covers/'.$story->cover) }}" alt="{{ $story->title }}">
						</div>
					@endif
					<div class="content ctn-main-font ctn-main-color ctn-serif ctn-desc ctn-skip-link">
						<?php echo $story->description; ?>
					</div>
					<div class="padding-20px">
						@if (count($tags) > 0)
							@foreach($tags as $tag)
							<?php 
								$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
								$title = str_replace($replace, '', $tag->tag); 
							?>
							<a href="{{ url('/tags/'.$title) }}" class="frame-top-tag">
								<div>{{ $tag->tag }}</div>
							</a>
							@endforeach
						@endif
					</div>
				</div>
				<div class="bot">
					<div class="top-comment" id="tr-comment">
						@if (Auth::id())
							<form method="post" action="javascript:void(0)" id="comment-publish">
								<div class="comment-head">
									<div>
										<textarea class="txt comment-text txt-sekunder-color ctn-main-font ctn-date" id="comment-description" placeholder="Type comment here.."></textarea>
									</div>
									<div class="place-btn">
										<button type="submit" name="btn-comment" class="btn btn-sekunder-color">
											<span>Send</span>
										</button>
									</div>
								</div>
							</form>
						@endif
					</div>
				</div>
				<div class="pos mid">
					<div class="comment-content" id="place-comment"></div>
					<div class="frame-more" id="frame-more-comment">
						<input type="hidden" name="offset" id="offset-comment" value="0">
						<input type="hidden" name="limit" id="limit-comment" value="0">
						<button class="btn btn-sekunder-color btn-radius" id="load-more-comment">
							<span class="Load More Comment">Load More</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel-bottom fixed" id="tool-panel">
	<div class="pb-place col-900px">
		<div class="grid-1">
			<ul class="nav-list">
				<li>
					<button class="btn btn-sekunder-color btn-no-border btn-radius btn-pad-5px" id="frame-loves">
						<span class="fas fa-lg fa-heart"></span>
						<span class="ttl-view" id="ttl-loves">{{ $story->loves }}</span>
					</button>
				</li>
				<li>
					<button class="btn btn-sekunder-color btn-no-border btn-radius btn-pad-5px" onclick="toComment()">
						<span class="far fa-lg fa-comment"></span>
						<span class="ttl-view">{{ $story->ttl_comment }}</span>
					</button>
				</li>
				<li class="need-pad">
					<span class="ttl-view">{{ $story->views }} Reads</span>
				</li>
			</ul>
		</div>
		<div class="grid-2 text-right crs-default">
			<button class="btn btn-circle btn-sekunder-color btn-no-border">
				<span class="fab fa-lg fa-facebook-f"></span>
			</button>
			<button class="btn btn-circle btn-sekunder-color btn-no-border">
				<span class="fab fa-lg fa-twitter"></span>
			</button>
			<button class="btn btn-circle btn-sekunder-color btn-no-border" onclick="addBookmark('{{ $story->idstory }}')">
				@if (is_int($story->is_save))
					<span class="bookmark-{{ $story->idstory }} fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
				@else
					<span class="bookmark-{{ $story->idstory }} far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
				@endif
			</button>
			<button class="btn btn-circle btn-primary-color btn-focus" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
				<span class="fa fa-lg fa-ellipsis-h"></span>
			</button>
		</div>
	</div>
</div>
@endforeach
<div class="col-full">
	<div class="padding-15px">
		<div class="need-mrg-left ttl-main-color padding-bottom-15px">
			<label class="ctn-up">Related Story</label>
		</div>
		<div class="post">
		<?php $i = 1; ?>
			@foreach ($allStory as $story)
				@if ($i <= 4)
					@include('main.post-list')
				@else
					@include('main.post')
				@endif
				<?php $i += 1; ?>
			@endforeach
		</div>
	</div>
</div>
<div class="padding-20px"></div>
@endsection
