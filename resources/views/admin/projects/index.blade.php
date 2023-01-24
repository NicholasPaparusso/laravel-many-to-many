@extends('layouts.app')

@section('content')
{{-- @dd(Auth::id()) --}}
    <div class="container index pb-5">
        {{-- @dd(session('update')) --}}

        <div class="d-flex justify-content-center align-items-center">
            <h3 class="mx-4">
                Lista dei progetti
            </h3>
            {{$projects->links()}}
        </div>

        @if (session('deleted'))

        <div class="container d-flex justify-content-center pt-5">
            <div class=" text-center w-25 alert alert-info" role="alert">
                {{session('deleted')}}
              </div>
        </div>

       @endif

       @if (session('message'))

       <div class="container d-flex justify-content-center pt-5">
           <div class=" text-center w-25 alert alert-info" role="alert">
            {{session('message')}}
             </div>
       </div>

      @endif

        <div class="d-flex justify-content-center" >
            <a class="btn np-btn-order" href="{{ route('admin.projects.orderby' , ['name',  $direction])}}">Ordina per titolo</a>
            <a class="btn np-btn-order" href="{{ route('admin.projects.orderby' , ['id',  $direction])}}">Ordina per Id</a>
            <a class="btn np-btn-order" href="{{ route('admin.projects.orderby' , ['updated_at',  $direction])}}">Ordina per data di modifica</a>
        </div>
            <div class="row">
            @forelse ($projects as $project )

                <div class="col-3">
                        <div class="d-flex flex-column align-items-center justify-content-center np-card my-4 index-card ">
                            <div class="d-flex justify-content-around w-100">
                                <h5 class="mt-2">ID: {{$project->id}}</h5>
                                @if (isset($project->type->id))
                                <div class="mt-2 badge  {{$project->type?->slug}}"> {{$project->type?->name}}</div>
                                @endif

                            </div>
                            @if (!is_null($project->cover_image))
                            <div class="thumb mt-3">
                                <img src="{{asset('storage/'.$project->cover_image)}}" alt="{{$project->original_image_name}}">
                            </div>
                            @endif

                            @if (is_null($project->cover_image))
                            <div class="thumb mt-3">
                                <img src="https://i.pinimg.com/originals/c6/f6/32/c6f6326eaf98a219d264b4be08926cc7.jpg" alt="no-image">
                            </div>
                            @endif
                            <div class="content px-4">
                                <h3 class="project-title">
                                    <a href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a>
                                </h3>
                            </div>
                            <div class="edit-discard w-100 px-5 pb-2 d-flex justify-content-around">
                                @include('widgets.delete',
                                [
                                'entity' => $project,
                                'route' => 'projects',
                                'delete_message' => "Confermi l'eliminazione del progetto: $project->name",
                                'delete_title' => 'Eliminazione progetto'
                                ])

                                @include('widgets.info')
                                @include('widgets.modify')
                            </div>
                            <div class="d-flex">
                                @if ($project->technologies)
                                @forelse ($project->technologies as $technology )
                                        <p class="m-2 technology"> {{$technology->name}}</p>
                                @empty
                                    <span class="py-2 my-2 technology">nessuna technology presente</span>
                                @endforelse

                                @endif
                            </div>
                        </div>

                </div>
            @empty
                <span>Nessun progetto trovato</span>
            @endforelse

            </div>
    </div>
@endsection
