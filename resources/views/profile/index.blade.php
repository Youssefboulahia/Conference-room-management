@extends('layouts.app')
@section('content')
    
<div class="container p-5">



    <div class="row  justify-content-center mb-5">
        <div class="col-md-3">
          <img src="{{ asset('assets/secretary.png') }}" alt="Photo de profile"style="border-radius:50%;width:70%;" class="ml-5">
        </div>
        
    </div>
    
    <form action="{{ route('profile.store') }}"  method="post">
    
    @csrf

    

    <div class="form-group">
            <label for="name">Name:</label>
            <input value="{{ $user->name }}" type="text" class="form-control" name="name">
    </div>

    <div class="form-group">
        <label for="password">E-Mail Address:</label>
    <input id="mail" type="email" class="form-control @error('mail') is-invalid @enderror" name="mail"  >

        @if(session()->has('warning_mail'))
            <div class="alert alert-warning">
                {{ session()->get('warning_mail') }}
            </div> 
        @endif
                              
    </div>


    <div class="form-group">
            <label for="password">Password:</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" >

        @if(session()->has('warning'))
            <div class="alert alert-warning">
                {{ session()->get('warning') }}
            </div> 
        @endif
                                  
    </div>

    <div class="form-group">
        <label for="password">Confirm password:</label>
        <input id="confPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="confPassword" autocomplete="new-password" >                     
    </div>
        

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>



@endsection
   

