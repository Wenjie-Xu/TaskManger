{!! Form::open(['route'=>['projects.destory',$project->id],'method'=>'DELETE']) !!}
		<button type="submit" class="btn btn-default">
			<i class="fa fa-btn fa-times"></i>
		</button>
{!! Form::close() !!}