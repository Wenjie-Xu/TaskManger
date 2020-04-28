@if($errors->any()){{-- 如果存在错误信息 --}}
	<ul class="alert alert-danger">
		@foreach($errors->all() as $error){{-- 遍历出所有的错误信息--}}
			<li>{{ $error }}</li>
		@endforeach
	</ul>
@endif