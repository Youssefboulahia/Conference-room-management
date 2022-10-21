@extends('layouts.admin',['roomId'=>$roomId])



@section('css')

<link href={{ asset('roomBooking/packages/main.css') }} rel='stylesheet' />
<script src={{ asset('roomBooking/packages/main.js') }}></script>



<style>
#calendar {
    width: 80%;
    margin: 0 auto;
    background-color:#fff;
    height:100vh;
  }
</style>

@endsection

    
@section('content')

<div id='calendar'></div>

@endsection




@section('js')

<script src={{ asset('roomBooking/packages/locales-all.js') }}></script>



<script>

function agenda(response)
{
        
          var calendarEl = document.getElementById('calendar');
      
          var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGridWeek',
      initialDate: response.date,
      nowIndicator: true,
      allDaySlot:false,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      navLinks: true, // can click day/week names to navigate views

      slotLabelFormat: [
        {
            hour: '2-digit',
            minute: '2-digit',
            hour12:false
        }
        ],
 
      dayMaxEvents: true, // allow "more" link when too many events
      events: response.data,
      eventTimeFormat: { // like '14:30:00'
      hour: '2-digit',
      minute: '2-digit',
      hour12:false
    },
      businessHours:[ {
        // days of week. an array of zero-based day of week integers (0=Sunday)
        daysOfWeek: [ 1, 2, 3, 4,5,6,7 ], // Monday - Thursday
        startTime: '06:00', // a start time (10am in this example)
        endTime: '21:00', // an end time (6pm in this example)
       },
      ]

   
    });

    calendar.render(); 
     
        }






( function ( $ ) {

    
    var roomId = {!! json_encode($roomId) !!};
    var calendarEl = document.getElementById('alert');

        var charts = {
            init: function () {
                
                $.ajax({
        
        url: "http://localhost/booking_system_main/public/allDataAgenda",
        type:"GET",
        data: { 
            id:roomId,
        },
        success:function(response){
          agenda(response);
        },
       });


            },
        };
    
        charts.init();

    
    } )( jQuery );




      
      </script>
      
@endsection