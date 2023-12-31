@extends('layouts.app')

@section('content')
<style>

            html, body{
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 80vh;
                margin: 0;
            }
</style>
<style>
            .card-header
            {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
            }
        </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <center>
            <h3>    <div class="card-header">{{ __('Edytuj wydarzenie') }}</div> </h3>
                 </center>
                <div class="card-body">
                @if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
@endif
<form method="post" action = "{{action('TaskController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa wydarzenia:') }}</label>

                            <div class="col-md-6">
                         
<input type = "text" name="name" class="form-control" value="{{$task->name}}" placeholder = "Uzupełnij nazwę wydarzenia" />

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Data:') }}</label>

                            <div class="col-md-6">
                         
<input type = "date" name="date" class="form-control" value="{{$task->date}}" placeholder = "Uzupełnij datę projektu" />

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                  
<br>
                        <div class="form-group row mb-0">
                        <div class = "form-group">
                        <center>
<input type = "submit" class="btn btn-primary" value="Zapisz zmiany" />
<a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj</a>
</center>
</div>

</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection