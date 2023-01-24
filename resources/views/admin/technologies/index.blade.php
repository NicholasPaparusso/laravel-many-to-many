@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex flex-column align-items-center type-panel ">
    <h3>
        Gestione delle Technologies
    </h3>
    <div>
        <form action="{{route('admin.technologies.store')}}" method="POST">
            @csrf
            <div class="input-group my-3">
                <input type="text" name="name" class="form-control" placeholder="Inserisci nuova technologies" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn np-btn send" type="submit" id="button-addon2">Invio</button>
              </div>
        </form>
    </div>
    @if (session('message'))

    <div class="container d-flex justify-content-center pt-5">
        <div class=" text-center w-25 alert alert-info" role="alert">
         {{session('message')}}
          </div>
    </div>

   @endif
 <table class="table table-borderless  w-75 my-3  ">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome technology</th>
            <th scope="col">Projects Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($technologies as $technology )
        <tr class="">

            <td>
                {{$technology->id}}
            </td>

            <td class="d-flex">
                <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input class="type-name" name="name" type="text" value="{{$technology->name}}">
                    <button class="btn np-btn send mx-3" type="submit" >Invio</button>
                </form>
                @include('widgets.delete',
                [
                'route' => 'technologies',
                'delete_message' => "Confermi l'eliminazione del progetto: $technology->name",
                'delete_title' => 'Eliminazione progetto',
                'entity' => $technology

                ])
            </td>


            <td>
                {{count($technology->projects)}}
            </td>

        </tr>
        @endforeach
    </tbody>
 </table>
</div>
@endsection
