@extends('layouts.app')

@section('content')
	<div class="container">
	@if(count($projects)>0)
	<div class="card-deck">
		@foreach($projects as $project)	
		<div class="col-4 my-3">
			<div class="card ccd" style="width: 20rem;">
				<ul class="icon-bar">
					<li>@include('projects._deleteForm')</li>
					<li>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProjectModal-{{ $project->id }}">
						<i class="fa fa-btn fa-cog"></i>
						</button>
					</li>
				</ul>
				<img src="{{ asset('storage/thumbs/cropped').'/'.$project->thumbnail }}"
				class="card-img-top" alt="缩略图">
				@include('projects._editModal')
				<div class="card-body">
					<h5 class="card-title">{{ $project->name }}</h5>
					<a href="projects/{{ $project->id }}" class="btn btn-primary">查看任务</a>
				</div>
			</div>
		</div>
		@endforeach
		<div class="col-4 my-3">
			<div class="card ccd" style="width: 20rem;height :16rem">
				<div class="card-body d-flex align-items-center justify-content-center ">
					@include('projects._createProjectModal')
				</div>
			</div>
		</div>
	</div>
	@else
		<div><h3>当前用户无项目,点击创建一个</h3></div>
		@include('projects._createProjectModal')
	@endif
	</div>
@endsection

@section('customJS')
<script type="text/javascript">
	$(document).ready(function(){
		$('.icon-bar').hide();

		$('.ccd').hover(function(){
			$(this).find('.icon-bar').toggle();
			});
	});
</script>
@endsection