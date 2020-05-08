{!! Form::open(['route'=>['tasks.destroy',$done->id],'method'=>'DELETE']) !!}
<button type="submit" class="btn btn-danger btn-sm">
	<i class="fas fa-times"></i>
</button>
{!! Form::close() !!}