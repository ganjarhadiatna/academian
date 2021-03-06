<?php use App\ProfileModel; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Academian - @yield('title')</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('img/2.png') }}" rel='SHORTCUT ICON'/>

	<!-- sass -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css/fontawesome-all.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('sass/main.css') }}">

	<!-- font 
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif|Lora|Noto+Serif|Playfair+Display|Slabo+27px" rel="stylesheet"> -->

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
	<script type="text/javascript">
		var iduser = '{{ Auth::id() }}';

		function setScroll(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll');
			} else {
				$('html').removeClass('set-scroll');
			}
		}
		function opSearch(stt) {
			if (stt === 'open') {
				$('#search').show();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search').hide();
				setScroll('show');
			}
		}
		function opCreateStory(stt) {
			if (stt === 'open') {
				$('#create').show();
				setScroll('hide');
			} else {
				$('#create').hide();
				setScroll('show');
			}
		}
		function opToggle(stt) {
			var tr = $('#'+stt).attr('class');
			if (tr === 'toggle fa fa-lg fa-toggle-off') {
				$('#'+stt).attr('class', 'toggle tgl-active fa fa-lg fa-toggle-on');
			} else {
				$('#'+stt).attr('class', 'toggle fa fa-lg fa-toggle-off');
			}
		}
		function addBookmark(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can save this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/bookmark") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'bookmark') {
						//opAlert('open', 'Story has been saved to bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' fas fa-lg fa-bookmark');
					} else if (data === 'unbookmark') {
						//opAlert('open', 'Story removed from bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' far fa-lg fa-bookmark');
					} else if (data === 'failedadd') {
						//opAlert('open', 'Failed to save story to bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' far fa-lg fa-bookmark');
					} else if (data === 'failedremove') {
						//opAlert('open', 'Failed to remove story from bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' fas fa-lg fa-bookmark');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
				})
				.fail(function(data) {
					//console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}
		function toLink(path) {
			window.location = path;
		}
		function cekNotif() {
			$.get('{{ url("/notif/cek") }}', function(data) {
				//console.log('notif: '+data);
				if (data != 0) {
					$('#main-notif-sign').show();
				} else {
					$('#main-notif-sign').hide();
				}
			});
		}
		
		function goBack() {
			window.history.back();
		}

		function toLeft() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (sc >= 0) {
				$('#ctnTag').animate({scrollLeft: (sc - wd)}, 500);
			}
		}
		function toRight() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (true) {
				$('#ctnTag').animate({scrollLeft: (sc + wd)}, 500);
			}
		}

		function hideElement(path) { 
			var didScroll;
			var lastScrollTop = 0;
			var delta = 5;
			var navbarHeight = $('#header').outerHeight();

			$(window).scroll(function(event) {
				didScroll = true;
			});

			setInterval(function () { 
				if (didScroll) {
					//do some stuff
					var st = $(this).scrollTop();
					if (st > lastScrollTop && st > navbarHeight) {
						$(path).hide();
					} else {
						$(path).show();
					}
					lastScrollTop = st;
					didScroll = false;
				}
			}, 250);
		}

		function opSearchPopup(stt) {
			if (stt == 'open') {
				$('#search-popup').show();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search-popup').hide();
				setScroll('show');
			}
		}

		window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).on('click', function(event) {
			$('#more-menu').hide();
			$('#nav-more-target').removeClass('active');
		});
		$(document).ready(function() {
			var pth = "@yield('path')";

			if (iduser) {
				setInterval('cekNotif()', 3000);
			}

			hideElement('#header .place');

			$('#main-menu a li').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});

			$('#place-search').submit(function(event) {
				var ctr = $('#txt-search').val();
				window.location = "{{ url('/search/') }}"+'/'+ctr;
			});

			$('#nav-more-target').on('click', function(event) {
				var tr = $(this).attr('key');
				if (tr == 'hide') {
					event.stopPropagation();
					$('#more-menu').show();
					$('#notifications').hide();
					$(this).addClass('active');
					$(this).attr('key', 'open');
				} else {
					$('#more-menu').hide();
					$(this).removeClass('active');
					$(this).attr('key', 'hide');
				}
			});

			$('#more-menu *').on('click', function(event) {
				event.stopPropagation();
				$('#more-menu').show();
				$('#notifications').hide();
				$('#nav-more-target').addClass('active');
				$('#nav-more-target').attr('key', 'open');
			});

			/*$('.btn-save-now').on('click', function(event) {
				var ctr = $(this).find('#bookmark').attr('class');
				if (ctr == 'fas fa-lg fa-bookmark') {
					$(this).find('#bookmark').attr('class','far fa-lg fa-bookmark');
				} else {
					$(this).find('#bookmark').attr('class','fas fa-lg fa-bookmark');
				}
				//alert(ctr);
			});*/
		});
	</script>
</head>
<body>
	<div id="header">
		<div class="place">
			<div class="menu col-full">
				<div class="pos lef">
					<a href="{{ url('/') }}">
						<div class="logo">
							<div class="ttl ctn-sans-serif">Academian</div>
							<!--<img src="{{ asset('/img/1.2.png') }}" alt="Academian">-->
						</div>
					</a>
				</div>
				<div class="pos rig">
					<div class="main-menu" id="nav-more">
						<a href="{{ url('/search') }}">
							<button class="btn btn-circle btn-sekunder-color btn-no-border" id="home-search">
								<span class="fas fa-lg fa-search"></span>
							</button>
						</a>
					</div>
					@if (is_null(Auth::id()))
						<a href="{{ url('/login') }}">
							<button class="btn btn-sekunder-color btn-no-border" id="login">
								<span class="fas fa-lg fa-sign-in-alt"></span>
							</button>
						</a>
						<a href="{{ url('/register') }}">
							<button class="create btn btn-sekunder-color" id="login">
								<span class="fas fa-lg fa-user-plus"></span>
								<span class="ttl-post">Register</span>
							</button>
						</a>
					@else
						<button class="btn btn-circle btn-sekunder-color btn-no-border" id="op-notif">
							<div class="notif-icn absolute fas fa-lg fa-circle" id="main-notif-sign" key="hide"></div>
							<span class="far fa-lg fa-bell"></span>
						</button>
						@foreach (ProfileModel::UserSmallData(Auth::id()) as $dt)
							<a href="{{ url('/user/'.$dt->id) }}">
								<button class="btn btn-circle btn-sekunder-color btn-no-border" id="profile">
									<span class="far fa-lg fa-user"></span>
								</button>
							</a>	
						@endforeach
						<a href="{{ url('/compose') }}">
							<button class="create btn btn-sekunder-color" id="compose">
								<span class="fas fa-lg fa-plus-circle"></span>
								<span>Create Story</span>
							</button>
						</a>
					@endif
				</div>
				@include('main.notifications')
			</div>
		</div>
		<div class="search-popup" id="search-popup">
			<button class="close btn btn-circle btn-sekunder-color btn-no-border" onclick="opSearchPopup('hide')">
				<span class="fas fa-2x fa-times"></span>
			</button>
			<div class="main-search">
				<div class="field-search" id="field-search">
					<form id="place-search" action="javascript:void(0)">
						<input type="text" name="q" class="txt txt-main-color txt-radius txt-search" id="txt-search" placeholder="Search academian" required="true">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="body">
		@yield("content")
	</div>

	@include('main.loading-bar')
	@include('main.post-menu')
	@include('main.question-menu')
	@include('main.alert-menu')

</body>
</html>
