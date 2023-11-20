@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pl.min.js"></script>
  <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  


	<script type="text/javascript" src="documentation-assets/jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="documentation-assets/jquery.timepicker.css" />
	<script type="text/javascript" src="documentation-assets/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="documentation-assets/bootstrap-datepicker.css" />


  @endsection

  @if(Auth::User()->permissions == 'Pracownik')

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
    <div class="card vertical-center">
    <center>
 <h3>    <div class="card-header vertical-center">
 @foreach ($eventtask as $object)
 <span class="glyphicon glyphicon-heart-empty"></span>

    {{ $object->task->name}}
    <span class="glyphicon glyphicon-heart-empty"></span>
    
   

@endforeach

 </div> </h3>
 </center>

 <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($event as $item)
    <tr>
      <td> <img src="uploads/{{Auth::User()->guest_url}}/{{$item->image}}" class="img img-responsive text-center" /></td>
     
    </tr>

     
      <td><i>{{ $item->description }}</i></td>
     
 
      <tr>
    </tr>

   
      <td>{{ $item->name}}</td>
   
      <thead>
    <tr>
    </tr>
  </thead>

    @endforeach
  
  </tbody>
</table>
    </div>
    <div>
@endsection

@endif


@if(Auth::User()->permissions == 'Administrator')

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
      
         
                <center>
            <h3>    <div class="card-header" >{{ __('QR event - lista wydarzeń') }}</div> </h3>
                 </center>
           
<table class="table" id="evTable">
  <thead>
    <tr>
      
    <th scope="col">Lp</th>
      <th scope="col">Wydarzenie</th>
      <th scope="col">Data</th>
      <th scope="col">Użytkownik</th>
      <th scope="col">Adres e-mail</th>
      <th scope="col">Panel gości</th>
      <th scope="col">Panel użytkownika</th>
      <th scope="col">PDF</th>
      <th scope="col">Zdjęcia</th>




    </tr>
  </thead>
  <tbody>
  @foreach($event2 as $ev) 

        
    <tr>
    <td class="table-row">{{ $loop->iteration }}.</td>
    <td class="table-row">{{$ev->task->name}}</td>
    <td class="table-row">{{$ev->task->date}}</td>
      <td class="table-row">{{$ev->user->name}} {{$ev->user->surname}}</td>
      <td class="table-row">{{$ev->user->email}}</td>
      <td class="table-row"><b><a href='/{{$ev->user->guest_url}}'>127.0.0.1:8000/{{$ev->user->guest_url}}</a></b></td>
      <td class="table-row"><b><a href="{{URL::to('/home/qrevents/details/'.$ev->id)}}">127.0.0.1:8000/home/qrevents/details/{{$ev->user->guest_url}}</a></b></td>
@if($ev->user->pdf == 'Tak')
<td class="table-row"><b><a download href='uploads/{{$ev->user->guest_url}}.pdf'>Pobierz</a></b></td>
@else
<td class="table-row">W trakcie realizacji</td>
@endif
<td class="table-row"><b><a href="{{URL::to('/home/qrevents/zip/'.$ev->user->id)}}">Pobierz</a></b></td>

    </tr>


    @endforeach
</tbody>
</table>
<script>
$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczone wydarzenie?"))
{
return true;
}
else
{
return false;
}
});
});
</script>
</div>
</div>

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
    $('#evTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba wydarzeń: _TOTAL_",
      emptyTable: "Brak zdefiniowanych wydarzeń",
      search: "Szukaj:" ,
    
      "paginate": {
      previous: "Poprzednia strona",
      next: "Następna strona"
    }
   
    },
    "oLanguage": {
      sLengthMenu: "Wyświetl _MENU_ rekordów",
    },
      "ordering": false,
      "pageLength": 25

      
    });
} );
</script>
@endpush
@endsection

@endif