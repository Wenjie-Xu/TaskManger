<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo" role="tab" aria-controls="todo" aria-selected="true">待完成</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">已完成</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="todo" role="tabpanel" aria-labelledby="todo-tab">
    <table class="table table-striped">
      <tr>
        @include('tasks._createTask')
      </tr>
    @if(count($todos))
        @foreach($todos as $todo)
          <tr>
            <td class="col-9 pl-5">{{ $todo->name }}</td>
            <td class="col-1">@include('tasks._checkForm')</td>
            <td class="col-1">@include('tasks._editModal')</td>
            <td class="col-1">@include('tasks._deleteTask')</td>
          </tr>
        @endforeach
    @endif
    </table>
  </div>

  <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
    @if(count($dones))
      <table class="table table-striped">
        @foreach($dones as $done)
          <tr>
            <td>{{ $done->name }}</td>
            <td>@include('tasks._deleteDone')</td>
          </tr>
        @endforeach
      </table>
    @endif
  </div>
</div>