@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	{{ csrf_field() }}
</form>
<div class="sc-header padding-10px">
	<div class="sc-place pos-fix">
		<div class="sc-block">
			<div class="sc-col-1">
				<h1 class="ttl-head ctn-main-font ctn-sans-serif ctn-bold ctn-desc">Setting</h1>
			</div>
		</div>
	</div>
</div>
<div class="frame-edit">
	<div class="compose" id="create">
		<div class="main">
			<div class="edit-body">
				<div class="edit-block">
					<p>Account</p>
					<ul>
						<a href="{{ url('/me/setting/profile') }}">
						    <li>
						    	<span class="ed-1">
						    		Edit Profile
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
					    </a>
					    <a href="{{ url('/me/setting/password') }}">
						    <li>
						    	<span class="ed-1">
						    		Change Password
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-caret-right"></span>
						    	</span>
						    </li>
						</a>
					</ul>
				</div>
				<div class="edit-block">
					<p>Others</p>
					<ul>
					    <li>
					    	<span class="ed-1">
					    		Delete this Account
					    	</span>
					    	<span class="ed-2">
					    		<span class="fa fa-lg fa-trash-o"></span>
					    	</span>
					    </li>
					    <a href="{{ route('logout') }}" 
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
						    <li>
						    	<span class="ed-1">
						    		Logout
						    	</span>
						    	<span class="ed-2">
						    		<span class="fa fa-lg fa-power-off"></span>
						    	</span>
						    </li>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-full other-footer">
	@include('main.footer')
</div>
@endsection