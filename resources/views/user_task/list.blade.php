@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
                <center>
            <h3>    <div class="card-header">{{ __('Przypisywanie uprawnień użytkowników do wydarzeń') }}</div> </h3>
                 </center>
                <div class="card-body">
<form action="{{action('UserTaskController@store')}}" method="POST" role="form">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<div class="form-group text-center">
<label for="user_id"><b>Użytkownik:</b></label>
<div>
<select name="user_id">
@foreach ($users as $users)
<option  value="{{$users->id}}">{{$users->name}} {{$users->surname}}</option>
@endforeach
</select>
</div>
<br>
<div class="form-group text-center">
<label for="task_id"><b>Wydarzenie:</b></label>
<div>
<select name="task_id">
@foreach ($tasks as $tasks)
<option  value="{{$tasks->id}}">{{$tasks->name}} {{$tasks->date}}</option>
@endforeach
</select>
<br>
<br>   

</div>
</div>
                        

                        <div class="form-group row mb-0">
                            
                            <button type="submit" class="btn btn-success">
                                <center>
                                    {{ __('Przypisz') }}
</center>
                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
      
         
                <center>
            <h3>    <div class="card-header">{{ __('Lista przypisanych wydarzeń') }}</div> </h3>
                 </center>
           
<table class="table" id="taskTable">
  <thead>
    <tr>
      
     
      <th scope="col">Wydarzenie</th>
      <th scope="col">Data</th>
      <th scope="col">Przypisany użytkownik</th>
      <th scope="col">Ścieżka URL dla gości</th>
    <th scope="col">ID wydarzenia</th>

      <th scope="col">Usuń</th>



    </tr>
  </thead>
  <tbody>
  @foreach($zlecenias as $zlecenia) 

        
    <tr>
     
      <td class="table-row"><b>{{ $loop->iteration }}. {{$zlecenia->task->name}}</b></td>
      <td class="table-row"><b>{{$zlecenia->task->date}}</b></td>
      <td class="table-row"><b>{{$zlecenia->user->name}} {{$zlecenia->user->surname}}</b></td>
      <td class="table-row"><b><a href='/{{$zlecenia->user->guest_url}}'>127.0.0.1:8000/{{$zlecenia->user->guest_url}}</a></b></td>
      <td class="table-row"><b>{{$zlecenia->id}}</b></td>


    <td class="table-row">
      <form method = "post" class="delete_from" action="{{action('UserTaskController@delete',$zlecenia['id'] )}}" title="Usuń">
      {{csrf_field()}}
      <input type = "hidden" name="_method" value="DELETE " />
      <button type = "submit" class="btn btn-danger"><span class="bi bi-trash"></span></button>
      </form>
      </td> 
    </tr>


    @endforeach
</tbody>
</table>
<script>
$(document).ready(function()
{
$('.delete_from').on('submit', function(){
if(confirm("Czy na pewno chcesz usunąć zaznaczone przypisanie?"))
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
    $('#taskTable').DataTable({
      "language": {
      infoEmpty:"",
      info: "Liczba przypisań: _TOTAL_",
      emptyTable: "Brak zdefiniowanych przypisań",
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
