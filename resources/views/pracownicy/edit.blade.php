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
            <h3>    <div class="card-header">{{ __('Edytuj dane użytkownika') }}</div> </h3>
                 </center>
                <div class="card-body">

<form method="post" action = "{{action('UserController@update', $id)}}">
{{csrf_field()}}
<input type="hidden" name="_method" value="PATCH" />

<div class = "form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right"><b>{{ __('Imię:') }}</b></label>
<div class="col-md-6">
<input type = "text" name="name" class="form-control" value="{{$user->name}}" placeholder = "Uzupełnij imię" />
</div>
</div>

<div class = "form-group row">
<label for="surname" class="col-md-4 col-form-label text-md-right"><b>{{ __('Nazwisko:') }}</b></label>
<div class="col-md-6">
<input type = "text" name="surname" class="form-control" value="{{$user->surname}}" placeholder = "Uzupełnij nazwisko" />
</div>
</div>

<div class = "form-group row">
<label for="email" class="col-md-4 col-form-label text-md-right"><b>{{ __('Adres e-mail:') }}</b></label>
<div class="col-md-6">
<input type = "text" name="email" class="form-control" value="{{$user->email}}" placeholder = "Uzupełnij email" />
</div>
</div>

<div class = "form-group row">
<label for="guest_url" class="col-md-4 col-form-label text-md-right"><b>{{ __('URL:') }}</b></label>
<div class="col-md-6">
<input type = "text" name="guest_url" class="form-control" value="{{$user->guest_url}}" placeholder = "Uzupełnij URL" />
</div>
</div>

<div class="form-group row">
<label for="permissions" class="col-md-4 col-form-label text-md-right"><b>{{ __('Uprawnienia:') }}</b></label>
<div class="col-md-6">

@if($user->permissions == 'Administrator')
<input type="radio" name="permissions" value="Administrator"  checked> Administrator <br/>
<input type="radio" name="permissions" value="Pracownik"> Użytkownik <br/>
@endif

@if($user->permissions == 'Pracownik')
<input type="radio" name="permissions" value="Administrator"> Administrator <br/>
<input type="radio" name="permissions" value="Pracownik" checked> Użytkownik <br/>
@endif

 @error('permissions')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>


<div class="form-group row">
<label for="pdf" class="col-md-4 col-form-label text-md-right"><b>{{ __('PDF:') }}</b></label>
<div class="col-md-6">

@if($user->pdf == 'Nie')
<input type="radio" name="pdf" value="Nie"  checked> Nie <br/>
<input type="radio" name="pdf" value="Tak"> Tak <br/>
@endif

@if($user->pdf == 'Tak')
<input type="radio" name="pdf" value="Nie"> Nie <br/>
<input type="radio" name="pdf" value="Tak" checked> Tak <br/>
@endif

 @error('pdf')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>


<br>



<div class = "form-group">
<center>
<input type = "submit" class="btn btn-primary" value="Zapisz zmiany" />
<a href="{{url()->previous()}}" type="button" class="btn btn-danger">Anuluj</a>
</center>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection
