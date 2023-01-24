{{-- --}}

<button type="button" class="btn np-btn delete" data-bs-toggle="modal" data-bs-target="#modal{{$entity->id}}">
    <i class="fa-solid fa-trash"></i>
  </button>


  <div class="modal fade" id="modal{{$entity->id}}" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            {{$delete_title}}
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{$delete_message}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
          <form
          class="d-inline"
          action="{{route( 'admin.'.$route. '.destroy' , $entity)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn np-btn delete" href="#">Elimina</button>
      </form>
        </div>
      </div>
    </div>
  </div>


