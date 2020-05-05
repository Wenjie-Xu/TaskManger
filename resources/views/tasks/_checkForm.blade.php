{!! Form::open(['route'=>['tasks.check',$todo->id],'method'=>'POST']) !!}

	<button type="submit" class="btn btn-success btn-sm">
		<i class="fa fa-check"></i>
	</button>

{!! Form::close() !!}