@extends('layouts.app')
@section('content')
    
<div class="container p-5">

    <a href="{{ route('user.add') }}" class="btn btn-primary mb-4">Add user</a >

    <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">E-Mail Address</th>
            <th scope="col">Reservations</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->reservations->count() }}</td>
            <td><button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete" data-id="{{ $user->id }}"><i class="fas fa-trash-alt"></i></button>  </td>
          </tr>
          @endforeach
        </tbody>
      </table>


              <!-- Modal -->
              <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">      
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <form action="{{ route('user.delete') }}" method="POST">
                          @csrf
                          <button class="btn btn-primary" >Yes</button>
                          <input type="text" name="userId" id="userId" hidden>
                          </form>
                    </div>
                  </div>
                </div>
              </div>


@endsection
   

@section('js')

    <script>
        $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $("#userId").val(id);
        })
    </script>

@endsection