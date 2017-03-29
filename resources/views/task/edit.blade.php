@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Edit task</div>

                    <div class="card-block">
                        <form class="form-horizontal" role="form" method="POST" action="/tasks/{{$task->id}}">
                            {{ csrf_field() }}
                            {{method_field("PUT")}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-2 col-form-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" value="{{$task->name}}" name="name"
                                           required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-2 col-form-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" rows="5"
                                              class="form-control"
                                              name="description"
                                              required>{!! trim($task->description) !!}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection