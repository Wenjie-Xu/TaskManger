{!! Form::open(['route'=>['tasks.destroy',$todo->id],'method'=>'DELETE']) !!}
<button type="submit" class="btn btn-danger btn-sm">
	<i class="fas fa-times"></i>
</button>
{!! Form::close() !!}