@extends('layouts.admin')

@section('content')

@if($rooms->count()===0)
  <div class="container">
      <div class="centered text-center">
          <img src="{{ asset('assets/empty-box.png') }}" alt="aucun sprint" style="width:10%" class="mb-2">
          <h3 class="text-muted">There's no Room at the moment</h3>
            <div class="mt-3 bg-white" style="display:inline-block">
                <button type="button" class="btn btn-outline-dark pull-right"data-toggle="modal" data-target="#createUserStory" style="font-size:14.5px"><i class="fa fa-plus"></i> Create room</button>
            </div>
      </div>
  </div>



  <!--MODAL-->
  <div class="modal fade" id="createUserStory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create room</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('room.store')}}" method="POST">
            @csrf

            <div class="form-group">
              <label for="description" class="col-form-label">Title:</label>
              <textarea type="text" class="form-control" id="description" name="title" required></textarea>
            </div>
       
            <div class="form-group">
                    <label for="éstimation" class="col-form-label">Capacity:</label>
                    <input type="number" class="form-control" id="éstimation" name="capacity" required>
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
       </form>
      </div>
    </div>
  </div>


@else
@if(Session::has('flash_message'))
          <div class="alert alert-danger" role="alert" style="text-align: center">
            {{ Session::get('flash_message') }}
          </div>
        @endif
     <!-- TO DO List -->
     <div class="box bg-white py-3" style="padding:10px;box-shadow: 1px 1px 5px rgba(0,0,0,.2);">
         <div class="container">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>

          <h4 class="box-title">List of rooms:</h4>

        </div>
        <!-- /.box-header -->
        <div class="box-body mt-3">
          <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
          <ul class="todo-list">
                @foreach ($rooms as $room)
               
                    <li class="sortable">
                          <!-- drag handle -->
                          <span class="handle">
                                <h5> {{ $loop->iteration }}</h5>
                              </span>
                        
                          <!-- todo text -->
                          <span class="text">{{ $room->title }}</span>
                          <!-- Emphasis label -->
                          <small class="badge badge-primary"><i class="fas fa-users"></i> {{ $room->capacity}}</small>
                          <!-- General tools such as edit or delete-->
                          <div class="tools">
                            <i class="fa fa-edit text-info"style="font-size:19px" data-id="{{ $room->id }}" data-title="{{ $room->title }}" data-capacity="{{ $room->capacity }}" data-toggle="modal" data-target="#edit"></i>
                            <i class="far fa-trash-alt"style="font-size:19px" data-id="{{ $room->id }}" data-toggle="modal" data-target="#delete"></i>
                          </div>
                        </li>

              @endforeach

          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border mt-3">
          <button type="button" class="btn btn-outline-dark pull-right"data-toggle="modal" data-target="#createUserStory" style="font-size:13.5px"><i class="fa fa-plus"></i> Create room</button>
        </div>
    </div>
      </div>
      <!-- /.box -->

      





      <!--MODAL-->
      <div class="modal fade" id="createUserStory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create room</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{route('room.store')}}" method="POST">
                    @csrf
        
                    <div class="form-group">
                      <label for="description" class="col-form-label">Title:</label>
                      <textarea type="text" class="form-control" id="description" name="title" required></textarea>
                    </div>
               
                    <div class="form-group">
                            <label for="éstimation" class="col-form-label">Capacity:</label>
                            <input type="number" class="form-control" id="éstimation" name="capacity" required>
                    </div>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
               </form>
              </div>
            </div>
          </div>

          <!--/MODAL-->




            <!--MODAL-->
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update room</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('room.update') }}" method="POST">
                    @csrf

                    <div class="form-group">
                      <label for="description" class="col-form-label">Title: </label>
                      <textarea type="text" class="form-control" id="editTitle" name="title" required></textarea>
                    </div>
                    <div class="form-group">
                            <label for="éstimation" class="col-form-label">Capacity:</label>
                            <input type="number" class="form-control" id="editCapacity" name="capacity" required>
                    </div>

                    <input type="text" name="roomId" id="editRoomId" hidden >
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-primary">Modifer</button>
                </div>
               </form>
              </div>
            </div>
          </div>

          <!--/MODAL-->





           <!-- Modal -->
           <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete room</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">      
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <form action="{{ route('room.delete') }}" method="POST">
                          @csrf
                          <button class="btn btn-primary" >Yes</button>
                          <input type="text" name="roomId" id="roomId" hidden>
                          </form>
                    </div>
                  </div>
                </div>
              </div>


    

@endif
@endsection

   
@section('js')
              

<script>
  $('#delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $("#roomId").val(id);
  })


  $('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var title = button.data('title') // Extract info from data-* attributes
    var capacity = button.data('capacity') // Extract info from data-* attributes
    var id = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    $("#editTitle").val(title);
    $("#editCapacity").val(capacity);
    $("#editRoomId").val(id);
  })
  

  
</script>

@endsection
