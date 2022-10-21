@extends('layouts.admin')

@section('css')
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
    <style>
    ._jw-tpk-container{
        height: fit-content;
    }
    </style>
    
@endsection

@section('content')

@if($rooms->count()===0  )
  <div class="container">
      <div class="centered text-center">
          <img src="{{ asset('assets/empty-box.png') }}" alt="aucun sprint" style="width:10%" class="mb-2">
            @if(Auth()->user()->isSecretary())
              <h3 class="text-muted">You have to create a Room first</h3>
              <div class="mt-3 bg-white" style="display:inline-block">
                <a href="{{ route('home') }}" type="button" class="btn btn-outline-dark pull-right"style="font-size:14.5px"><i class="fa fa-plus"></i> Create room</a>
              </div>
            @else
              <h3 class="text-muted">There's no room created</h3>
            @endif
      </div>
  </div>
@elseif($reservations->count()===0)
    <div class="container">
        <div class="centered text-center">
            <img src="{{ asset('assets/empty-box.png') }}" alt="aucun sprint" style="width:10%" class="mb-2">
            <h3 class="text-muted">There's no Reservation at the moment</h3>
            <div class="mt-3 bg-white" style="display:inline-block">
                <button type="button" class="btn btn-outline-dark pull-right"data-toggle="modal" data-target="#createUserStory" style="font-size:14.5px"><i class="fa fa-plus"></i> Add reservation</button>
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
        <form action="{{route('reservation.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="éstimation" class="col-form-label">Room:</label>
                <select id="inputState" class="form-control" required name="room">
                  <option value="" disabled selected hidden>Select a room</option>
                  @foreach ($rooms as $room )
                      <option>{{ $room->title }}</option>
                  @endforeach
                </select>
            </div>
       
            <div class="form-group">
                    <label for="éstimation" class="col-form-label">Description:</label>
                    <input  class="form-control" id="éstimation" required name="description">
            </div>

            <div class="form-group">
                <label for="éstimation" class="col-form-label">Day:</label>
                <input type="date" class="form-control" id="éstimation" name="day" required>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="éstimation" class="col-form-label">Start:</label>
                        <input autocomplete="off" id="time" class="form-control" name="start" required placeholder="Pick hour" >
                        <span style="position:absolute;bottom:6px;right:23px"><i class="far fa-clock"></i></span>
                    </div>
                    <div class="col-6">
                        <label for="éstimation" class="col-form-label">End:</label>
                        <input autocomplete="off" id="time2" class="form-control" name="end" required placeholder="Pick hour" >
                        <span style="position:absolute;bottom:6px;right:23px"><i class="far fa-clock"></i></span>
                    </div>
                </div>
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

  <div class="container">
        <div class="bg-white d-inline-block mb-4" >
            <button type="button" class="btn btn-outline-dark pull-right"data-toggle="modal" data-target="#createUserStory" style="font-size:14.5px"><i class="fa fa-plus"></i> Add reservation</button>
        </div>  

        @if(Session::has('flash_message'))
          <div class="alert alert-danger" role="alert" style="text-align: center">
            {{ Session::get('flash_message') }}
          </div>
        @endif

        <form action="{{ route('reservation.filter') }}" method="GET">
                <div class="row justify-content-end mb-2" style="position:relative;top:6px">
                        <div class="col-auto">
                                <div class="form-group d-inline-block border-zero">
                                        <select name="filterRoom" class="form-control border-zero" id="exampleFormControlSelect1" style="height:30px; min-width:200px; font-size:13px ">
                                          <option value="" disabled selected hidden >Choose room</option>
                                          @foreach ($rooms as $room )
                                              <option>{{ $room->title }}</option>
                                          @endforeach
                                        </select>
                                      </div>               
                        </div>
                        <div class="col-auto" style="margin-left:-30px">
                                <button type="submit" class="btn btn-labeled btn-primary" style=" height:30px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
                                        <i class="fa fa-filter btn-label" aria-hidden="true"></i>
                                    <span class="ml-n2">Filter</span>
                                </button>
                        </div>
                
                
                    </div>
                </form>
        
        <div class="bg-white">
              <table class="table table-hover">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" style="width:4%">#</th>
                          <th scope="col" style="width:20%">Room</th>
                          <th scope="col" style="width:24%">Description</th>
                          <th scope="col" style="width:22%">Day</th>
                          <th scope="col" style="width:9%">Start</th>
                          <th scope="col" style="width:13%">End</th>
                          <th scope="col" style="width:15%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                              @foreach ($reservations as $reservation)
                              <tr >
                                      @if ($reservationFilter==="false")
                                        <th data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show" scope="row">{{ $loop->iteration+$skipped }}</th>
                                      @elseif($reservationFilter==="true")
                                        <th data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show" scope="row">{{ $loop->iteration }}</th>
                                      @endif
                              
                                      <td  data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show">{{ $reservation->room->title }}</td>
                                      <td  data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show">{{ $reservation->description }}</td>
                                      <td  data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show">{{ $reservation->day }}</td>
                                      <td  data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show">{{ $reservation->start }}</td>
                                      <td  data-toggle="modal" data-name="{{ $reservation->user->name }}" data-email="{{ $reservation->user->email }}" data-created_at="{{ $reservation->created_at->format('d-m-yy') }}" data-target="#show">{{ $reservation->end }}</td>
                                      
                                      @if(Auth()->user()->isSecretary())
                                        <td><button type="submit" class="btn btn-outline-danger btn-sm btn_delete" data-toggle="modal" data-target="#delete" data-id="{{ $reservation->id }}"><i class="fas fa-trash-alt"></i></button>  </td>  
                                      @elseif(!Auth()->user()->isSecretary() && Auth()->user()->myReservation($reservation->id))
                                        <td><button type="submit" class="btn btn-outline-danger btn-sm btn_delete" data-toggle="modal" data-target="#delete" data-id="{{ $reservation->id }}"><i class="fas fa-trash-alt"></i></button>  </td> 
                                      @endif                                      
                                  </tr>
                              @endforeach
                      </tbody>
                    </table>
                    @if ($reservationFilter==="false")
                        {{ $reservations->links() }}
                    @endif
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
                <form action="{{route('reservation.store')}}" method="POST">
                    @csrf
        
                    <div class="form-group">
                        <label for="éstimation" class="col-form-label">Room:</label>
                        <select id="inputState" class="form-control" required name="room">
                          <option value="" disabled selected hidden>Select a room</option>
                          @foreach ($rooms as $room )
                              <option>{{ $room->title }}</option>
                          @endforeach
                        </select>
                    </div>
               
                    <div class="form-group">
                            <label for="éstimation" class="col-form-label">Description:</label>
                            <input  class="form-control" id="éstimation" required name="description">
                    </div>
        
                    <div class="form-group">
                        <label for="éstimation" class="col-form-label">Day:</label>
                        <input type="date" class="form-control" required id="éstimation" name="day">
                    </div>
        
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="éstimation" class="col-form-label">Start:</label>
                                <input autocomplete="off" id="time" required class="form-control" name="start" placeholder="Pick hour" >
                                <span style="position:absolute;bottom:6px;right:23px"><i class="far fa-clock"></i></span>
                            </div>
                            <div class="col-6">
                                <label for="éstimation" class="col-form-label">End:</label>
                                <input autocomplete="off" id="time2" required class="form-control" name="end" placeholder="Pick hour" >
                                <span style="position:absolute;bottom:6px;right:23px"><i class="far fa-clock"></i></span>
                            </div>
                        </div>
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





              <!-- Modal -->
       <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete reservation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">      
                    Are you sure?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <form action="{{ route('reservation.delete') }}" method="POST">
                      @csrf
                      <button class="btn btn-primary" >Yes</button>
                      <input type="text" name="reservationId" id="reservationId" hidden>
                      </form>
                </div>
              </div>
            </div>
          </div>



             <!-- Modal -->
             <div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">      
                      
                      <div class="container p-2">
                        <p class="text-center font-weight-bold mb-4">Reserved by</p>
                          <div class="row align-items-center my-3">
                              <div class="col-sm-3 text-dark" style="font-size:16px;font-weight:bold">Name:</div>
                              <div class="col-sm-9"><p id="name_show" class="d-inline"></p></div>
                          </div>

                          <div class="row align-items-center my-3">
                              <div class="col-sm-3 text-dark" style="font-size:16px;font-weight:bold">Email:</div>
                              <div class="col-sm-9"><p id="email_show" class="d-inline"></p></div>
                          </div>

                          <div class="row align-items-center my-3">
                                  <div class="col-sm-3 text-dark" style="font-size:16px;font-weight:bold">In:</div>
                                  <div class="col-sm-9"><p id="created_at_show" class="d-inline"></p></div>
                          </div>

                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>

@endif

   
@endsection

   
@section('js')
<script src="//cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>

<script>



let time = document.getElementById('time');
let t = document.getElementById('time2');

    let timepicker = new TimePicker(['time', 'time2'], {
    lang: 'en',
    theme: 'dark'
  });
  timepicker.on('change', function(evt) {
    
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;
  
  });


</script>

    
      <script>

    $('#show').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('name') // Extract info from data-* attributes
      var email = button.data('email') // Extract info from data-* attributes
      var date = button.data('created_at') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      $("#name_show").text(name);
      $("#email_show").text(email);
      $("#created_at_show").text(date);
  })





      $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      $("#reservationId").val(id);
    })
        
      </script>
      

@endsection
