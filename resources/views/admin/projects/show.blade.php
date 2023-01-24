@extends('layouts.app')

@section('content')

   @if (session('message'))

    <div class="container d-flex justify-content-center pt-5">
        <div class=" w-25 alert alert-info" role="alert">
            {{session('message')}}
          </div>
    </div>

   @endif

    <div class="container mt-5 show d-flex align-items-center justify-content-center ">
        <div class="np-card mt-5 col-6  d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex pt-4 justify-content-between">
                <div class="d-flex align-items-center" >
                    <p>
                        ID: {{$project->id}}
                    </p>

                    <h3 class="project-title ms-3">
                        {{$project->name}}
                    </h3>
                    @if (isset($project->type->id))
                    <div class=" badge mx-3 {{$project->type?->slug}}"> {{$project->type?->name}}</div>
                    @endif
                    <div class="edit-discard">
                        @include('widgets.delete',
                        [
                        'route' => 'projects',
                        'delete_message' => "Confermi l'eliminazione del progetto: $project->name",
                        'delete_title' => 'Eliminazione progetto',
                        'entity' => $project

                        ])
                        @include('widgets.modify')
                        @include('widgets.previous')
                    </div>
                </div>
            </div>
            @if ($project->cover_image)
            <div class="thumb my-4">
                <img src="{{asset('storage/'.$project->cover_image)}}" alt="{{$project->original_image_name}}">
            </div>
            @endif
            @if (is_null($project->cover_image))
            <div class="thumb my-4">
                <img src="https://i.pinimg.com/originals/c6/f6/32/c6f6326eaf98a219d264b4be08926cc7.jpg" alt="no-image">
            </div>
            @endif

            <div class="content px-4">
                <p class="summary">
                    {!!$project->summary!!}
                </p>
                <p class="client">
                    Lavoro commisionato da: <span>{{$project->client_name}}</span>
                </p>

                <div class="client d-flex ">
                    <p>
                        Data creazione: <span>{{date("d-m-Y h:i", strtotime($project->created_at))}}</span>
                    </p>
                    <p class="ps-3">
                        Data ultima modifica: <span>{{date("d-m-Y h:i", strtotime($project->updated_at))}}</span>
                    </p>
                </div>
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
@endsection
