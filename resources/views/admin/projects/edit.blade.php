@extends('layouts.app')

@section('content')

<div class="container pb-5 form-container ">
    <h3 class="text-center">Modifica {{$project->name}}</h3>
    <div class="row">

        <div class="col-5 offset-3">
            @include('widgets.delete',
            [
            'route' => 'projects',
            'delete_message' => "Confermi l'eliminazione del progetto: $project->name",
            'delete_title' => 'Eliminazione progetto',
            'entity' => $project

            ])
            <form class="mt-3" action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror resize" id="name" name="name" value="{{old('name',$project->name)}}" aria-describedby="emailHelp">

                @error('name')
                <p class="invalid-feedback">
                  {{$message}}
                </p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="name" class="form-label">Categoria</label>
                <select class="form-select resize" name="type_id" name="name" value="{{old('name')}}" aria-describedby="emailHelp">
                    <option value=""> Selezionare una categoria </option>
                    @foreach ($types as $type )
                    <option
                    @if ($type->id == old('type_id', $project->type?->id) )
                    selected
                    @endif
                    value="{{$type->id}}" > {{$type->name}} </option>
                    @endforeach
                </select>
              </div>

              <div class="mb-2">
                <p class="form-label">Technologys</p>
                @foreach ($technologies as  $technology)
                    <input name="technologies[]"
                     id="technology{{$loop->iteration}}"
                     class="mx-2" type="checkbox"
                     value="{{$technology->id}}"
                    @if (!$errors->all() && $project->technologies->contains($technology))
                        checked
                    @elseif($errors->all() && in_array($technology->id, old('technologies',[])))
                    @endif
                     >
                    <label for="technology{{$loop->iteration}}">{{$technology->name}}</label>
                @endforeach
          </div>

              <div class="mb-3">
                <label for="client_name" class="form-label">Cliente</label>
                <input type="text" class="form-control  @error('client_name') is-invalid @enderror resize" name="client_name"  value="{{old('client_name',$project->client_name)}}"  id="client_name">

                @error('client_name')
                <p class="invalid-feedback">
                  {{$message}}
                </p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="cover_image" class="form-label">Thumb</label>
                <input  onchange="showImage(event)" type="file" class="form-control  @error('cover_image') is-invalid @enderror" name="cover_image" placeholder="Carica un'immagine"  value="{{old('cover_image',$project->cover_image)}}"  id="cover_image">


                @error('cover_image')
                <p class="invalid-feedback">
                  {{$message}}
                </p>
                @enderror
              </div>

              <div>
                <img width="200" id="show-image" src="" alt="">
              </div>

              <div class="mb-3">
                <label for="summary" class="form-label">Sommario</label>
               <textarea class=" editor" name="summary" id="summary" cols="30" rows="10">{{old('summary',$project->summary)}}</textarea>

               @error('summary')
               <p class="invalid-feedback">
                 {{$message}}
               </p>
               @enderror
              </div>

              <button type="submit" class="btn np-btn">invio</button>



        </form>

    </div>
        <div class="col-4">
            @if ($errors->any())

            <div class="ms-5 alert alert-danger" role="alert">
                <ul>
                    @foreach ( $errors->all() as $error )
                        <li class="py-1">{{$error}}</li>
                    @endforeach
                </ul>
            </div>

            @endif
        </div>

    </div>


</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#summary' ) ,{
            toolbar:  [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        })
        .catch( error => {
            console.error( error );
        } );
</script>

<script>

    function showImage(event){
            const technologyImage = document.getElementById('show-image');
            technologyImage.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>



@endsection
