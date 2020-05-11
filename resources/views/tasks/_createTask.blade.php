<div class="col-auto">

{!! Form::open(['route'=>['tasks.store','project_id'=>$project->id],'method'=>'POST']) !!}
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
            <i class="fa fa-plus"></i>
        </div>
      </div>
    {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'请填写一个任务']) !!}
    {{-- {!! Form::hidden('project_id', $project->id) !!} //使用hidden表单的方法--}}
    </div>
    {!! $errors->create->first('name','<div class="alert alert-danger">
      :message
      </div>') !!}
    {!! $errors->create->first('project_id','<div class="alert alert-danger">
      :message
      </div>') !!}
{!! Form::close() !!}

</div>