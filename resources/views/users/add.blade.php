@extends('layouts.app')
@section('content')
    
<div class="container p-5">



    <div class="row  justify-content-center mb-5">
        
    </div>
    
    <form action="{{ route('user.store') }}"  method="post">
    
    @csrf

    

    <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" required>
    </div>

    <div class="form-group">
        <label for="password">E-Mail Address:</label>
    <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail" required >

        @if(session()->has('warning_mail'))
            <div class="alert alert-warning">
                {{ session()->get('warning_mail') }}
            </div> 
        @endif
                              
    </div>


    <div class="form-group">
            <label for="password">Password:</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>

        @if(session()->has('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div> 
        @endif
                                  
    </div>

    <div class="form-group">
        <label for="password">Confirm password:</label>
        <input id="confPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="confPassword" autocomplete="new-password" required>                     
    </div>
        

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>



@endsection
   

