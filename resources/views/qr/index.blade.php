@extends('layouts.app')
@section('css')
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Uzyskaj odwołanie do pola opisu
            var descriptionField = document.querySelector('input[name="description"]');
            
            // Utwórz element do wyświetlania liczby znaków
            var characterCount = document.createElement('p');
            characterCount.innerHTML = 'Pozostało znaków: 255';
            
            // Dodaj element do DOM
            descriptionField.parentNode.appendChild(characterCount);

            // Dodaj nasłuchiwanie na zmiany w polu opisu
            descriptionField.addEventListener('input', function () {
                var remainingCharacters = 255 - descriptionField.value.length;
                characterCount.innerHTML = 'Pozostało znaków: ' + remainingCharacters;
            });
        });
    </script>

<script>
    function showLoadingMessage() {
        // Pokaż komunikat oczekiwania
        document.getElementById('loading-message').style.display = 'block';
    }
</script>

@endsection
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
               
               <h3> <div class="card-header">{{ __('Anna & Piotr') }}</div></h3>
               <img class="img-fluid mx-auto d-block" src="/test.png" alt="" width="95" height="105">
               <h3> <div class="card-header">{{ __('18.11.2023 r.') }}</div></h3>


</center>
<div id="loading-message" class="text-center" style="display: none;">
    <p>Trwa przetwarzanie danych...</p>
    <img src="load.gif" alt="Loading" width="50" height="50">
</div>
 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="card-body">

<form action="{{url('/test')}}" method="POST" enctype="multipart/form-data" onsubmit="showLoadingMessage()">
@csrf
<div class = "form-group mb-3">
<label for="image">Zdjęcie:</label>

<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" required autocomplete="image">
@error('image')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class = "form-group mb-3">
<label for="description">Wiadomość:</label>
<input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required autocomplete="description"></input>
@error('description')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class = "form-group mb-3">
<label for="name">Podpis:</label>
<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



<br>

<div class = "form-group mb-3 text-center">
<button type="submit" class="btn btn-dark btn-lg" style="background-color: #9fa6b2ff;"> Zapisz </button>
</div>
</form>
</div>


            </div>
        </div>
    </div>
</div>
@endsection
