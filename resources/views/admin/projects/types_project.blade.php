@extends('layouts.app')

@section('content')
{{-- @dd($types) --}}
<div class="container-fluid py-5 types">
    <h1>Lista dei progetti nelle rispettive categorie</h1>
    @foreach ($types as $type )

        <div class="type py-5 row d-flex flex-column  my-5 ">
            <div class="my-2 badge col-1 offset-5 py-3   {{$type?->slug}}">
                 {{$type?->name}}
            </div>
            <div class="card-container d-flex row">
                @foreach ($type->projects as $type_project)
                <div class="col-2">
                    <div class="d-flex flex-column align-items-center justify-content-center np-card my-2 index-card ">
                        <div class="content text-center">
                            <h3 class="project-title ">
                                <a href="{{route('admin.projects.show', $type_project)}}">{{$type_project->name}}</a>
                            </h3>
                        </div>
                        @if (!is_null($type_project->cover_image))
                        <div class="thumb my-3">
                            <img src="{{asset('storage/'.$type_project->cover_image)}}" alt="{{$type_project->original_image_name}}">
                        </div>
                        @endif

                        @if (is_null($type_project->cover_image))
                        <div class="thumb my-3">
                            <img src="https://i.pinimg.com/originals/c6/f6/32/c6f6326eaf98a219d264b4be08926cc7.jpg" alt="no-image">
                        </div>
                        @endif


                    </div>

            </div>
            @endforeach
        </div>

    </div>

    @endforeach
</div>
@endsection

