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
					<div class="frame-comment comment-owner">\
						<div class="dt-1">\
							<a href="'+server_user+'" title="'+data[i].name+'">\
								<div class="image image-35px image-circle" style="background-image: url('+server_foto+')"></div>\
							</a>\
						</div>\
						<div class="dt-2">\
							<div class="desk comment-owner-radius">\
								<div class="comment-main">\
									<a href="'+server_user+'" title="'+data[i].name+'"><strong class="comment-name">'+data[i].name+'</strong></a>\
									<div>'+data[i].description+'</div>\
								</div>\
							</div>\
							<div class="tgl">\
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
	}
	$(document).ready(function() {
		$('#offset-comment').val(0);
		$('#limit-comment').val(5);
		getComment('{{ $story->idstory }}', 'add');

		$(window).scroll(function(event) {
			clearTimeout($.data(this, 'scrollTimer'));
			$('#tool-panel').hide();
			$.data(this, 'scrollTimer', setTimeout(function () {
				$('#tool-panel').show();
			}, 500));
		});

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
			<div class="place-cover">
				<div class="main" style="background-image: url({{ asset('/story/covers/'.$story->cover) }})"></div>
			</div>
			<div class="frame-story" id="main-story">
				<div class="pos mid">
					<div class="main-title padding-20px ctn-main-font ctn-sans-serif ctn-standar">
						<?php echo $story->title; ?>
					</div>
					<div class="content ctn-main-font ctn-serif ctn-desc">
						<?php echo $story->description; ?>
					</div>
				</div>
				<div class="pos bot">
					<div class="here-block">
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
					<div class="here padding-15px">
						<div class="ctn ctn-sans-serif">
							<strong class="ttl-main-color">Published to Story on {{ date('F d, Y h:i:sa', strtotime($story->created)) }}</strong>
						</div>
					</div>
					<div class="profile">
							<div class="foto">
								<a href="{{ url('/user/'.$story->id) }}">
									<div class="image image-50px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
								</a>
							</div>
							<div class="info">
								<div class="name">
									<div>
										<a href="{{ url('/user/'.$story->id) }}">
											{{ $story->name }}
										</a>
									</div>
								</div>
							</div>
							<div class="tool">
								@if ($story->id != Auth::id())
									@if (is_int($statusFolow))
										<input type="button" name="follow" class="btn btn-main3-color" id="add-follow-{{ $story->id }}" value="Unfollow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
									@else
										<input type="button" name="follow" class="btn btn-sekunder-color" id="add-follow-{{ $story->id }}" value="Follow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
									@endif
								@endif
							</div>
					</div>
					<div class="padding-bottom-15px"></div>
					<div class="here">
						<div class="here-block">
							<ul class="menu-share">
								<li class="mn btn btn-color-fb">
									<span class="fab fa-lg fa-facebook"></span>
								</li>
								<li class="mn btn btn-color-tw">
									<span class="fab fa-lg fa-twitter"></span>
								</li>
								<li class="mn btn btn-color-gg-2">
									<span class="fab fa-lg fa-pinterest"></span>
								</li>
								<li class="mn btn btn-color-gg">
									<span class="fab fa-lg fa-google-plus"></span>
								</li>
							</ul>
						</div>
					</div>
					<div class="panel-bottom fixed bdr-top" id="tool-panel">
						<div>
							<div class="pb-place">
								<div class="grid-1">
									<button class="btn btn-color-gg-2 btn-radius" id="frame-loves">
										<span class="far fa-lg fa-heart"></span>
										<span class="ttl-loves" id="ttl-loves">{{ $story->loves }}</span>
									</button>
									<button class="btn btn-sekunder-color btn-no-border">
										<span id="ttl-view">{{ $story->views }} Views</span>
									</button>
								</div>
								<div class="grid-2 text-right crs-default">
									<button class="btn btn-sekunder-color btn-no-border" onclick="toComment()">
										<span class="far fa-lg fa-comment"></span>
										<span class="ttl-loves">{{ $story->ttl_comment }}</span>
									</button>
									<button class="btn btn-circle btn-sekunder-color btn-no-border" onclick="addBookmark('{{ $story->idstory }}')">
										@if (is_int($check))
											<span class="fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
										@else
											<span class="far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
										@endif
									</button>
									<button class="btn btn-circle btn-sekunder-color btn-focus" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
										<span class="fa fa-lg fa-ellipsis-h"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="loved top-comment" id="tr-comment">
						@if (Auth::id())
							<form method="post" action="javascript:void(0)" id="comment-publish">
								<div class="comment-head bdr-bottom">
									<div>
										<textarea class="txt comment-text txt-sekunder-color" id="comment-description" placeholder="Type comment here.."></textarea>
									</div>
									<div class="place-btn">
										<button type="submit" name="btn-comment" class="btn btn-sekunder-color">
											<span>Send</span>
										</button>
									</div>
								</div>
							</form>
						@endif
						<div class="comment-content" id="place-comment"></div>
					</div>
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
@endforeach
<div class="col-full">
	<div class="block">
		<div class="post">
			@foreach ($allStory as $story)
			@include('main.post')
			@endforeach
		</div>
	</div>
</div>
<div class="padding-bottom"></div>
@endsection
