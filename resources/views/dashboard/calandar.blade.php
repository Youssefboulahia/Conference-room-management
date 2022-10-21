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

@if($rooms->count()===0)
  <div class="container">
      <div class="centered text-center">
          <img src="{{ asset('assets/empty-box.png') }}" alt="aucun sprint" style="width:10%" class="mb-2">
          <h3 class="text-muted">You have to create a Room first</h3>
            <div class="mt-3 bg-white" style="display:inline-block">
                <a href="{{ route('home') }}" type="button" class="btn btn-outline-dark pull-right"style="font-size:14.5px"><i class="fa fa-plus"></i> Create room</a>
            </div>
      </div>
  </div>
    

  @else

  <div class="container">
        <div class="row">

                @foreach ($rooms as $room )
                <div class="col-sm-4 mt-4">
                        <div class="card border-left-primary shadow h-100 pt-2 border-right-primary border-top-primary" style="border:solid 1px #4E73DF">
                          <div class="card-body">
                            
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2" style="z-index:10">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <div class="row  justify-content-around"style="position:relative;top:-7px;">
                                                <div class="col text-center" style="font-size:14.5px">
                                                        <div style="position:relative;top:5px">
                                                                <span class=" mr-1" style="font-size:18px;color:#4E73DF">Room:</span> <span style="color:#7a7374;font-size:18px; text-transform: capitalize">{{ $room->title }}</span>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
        
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                             
                            </div>
                          </div>
        
                          <a href="{{ route('calandar.room',$room->id) }}">
                                <div class="card-footer text-center" style="cursor:pointer;  border-bottom-left-radius: 0px; background-color:#4E73DF">
                                      <div class="h5 mb-0 text-white" style="font-size:18px">
                                        
                                          <i class="fa fa-arrow-right mr-1 text-white" style="font-size:16.5px"></i>
                                          Select
                                                
                                      </div>
                                  </div>
                              </a> 
                            
                        </div>
                      </div>
                      @endforeach

  </div>
  </div>


@endif

   
@endsection

   
