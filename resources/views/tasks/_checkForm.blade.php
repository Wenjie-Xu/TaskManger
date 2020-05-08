{!! Form::open(['route'=>['tasks.check',$todo->id],'method'=>'POST']) !!}

	<button type="submit" class="btn btn-success btn-sm">
		<i class="fas fa-check"></i>
	</button>

{!! Form::close() !!}
