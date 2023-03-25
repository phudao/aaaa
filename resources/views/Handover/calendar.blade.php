@extends('layouts.master')


@section('content')
<div>&nbsp;</div>
<section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">

<!--start form edit: co nhieu item chua id trung nhau tren 2 form-->
            <div class="card p2" id="formEditExchange" style="display:none">
              <div class="card-header">
                <h4 class="card-title">SỬA ĐỔI CA</h4>
              </div>
            <form action="/addexchangeworklog" method="post"><div class="card-body">
              @csrf
                <div class="form-group">
                  <span class="control-label col-sm-4 float-left col-form-label-sm">Người đổi ca/trực thay</span>
                  <span class="float-left col-sm-4"><select class="form-control form-control-sm " name="data[changer_id]">
                    <option>-Người đổi ca-</option>
                    @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                  </select></span>
                  <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[replacer_id]">
                    <option>-Người trực thay-</option>
                    @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                  </select></span>
                </div>
                <div style="clear:both"></div>
                <div class="form-group ">
                  <span class="control-label col-sm-4 float-left col-form-label-sm">Ngày trực thay/ngày trả</span>
                  <span class="float-left col-sm-4"><input type="date" class="form-control form-control-sm" name="data[date_change]"></span>  
                  <span class="float-left col-sm-4"><input type="date" class="form-control form-control-sm" name="data[date_replace]" id="date_replace"></span>
                </div>
              <div style="clear:both"></div>
                  <div class="form-group">
                    <span class="control-label col-sm-4  float-left col-form-label-sm">Ca trực thay/trực trả</span>
                    <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[shift_change]"><option value="0">Ngày</option><option value="1">Đêm</option></select></span> 
                    <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[shift_replace]" id="shift_replace"><option value="0">Ngày</option><option value="1">Đêm</option></select></span>
                  </div>
                  <div style="clear:both"></div>
                  <div class="form-group">
                    <span class="control-label col-sm-4 col-form-label-sm">Trả ca sau</span>
                      <span class="float-right col-sm-8"><input id="doitlater" type="checkbox" name="data[doitlater]"></span>
                    </div>  
                  <div><button type="submit" class="btn btn-primary float-right btn-sm">Lưu</button></div>   
              
              <!-- /.card-body -->  
            </div></form>
              
          </div>  

          <!--end form edit-->

                      
      <div class="card p2" id="formexchange" style="display:none">
        <div class="card-header">
          <h4 class="card-title">FORM ĐỔI CA</h4>
        </div>
      <form action="/addexchangeworklog" method="post"><div class="card-body">
        @csrf
          <div class="form-group">
            <span class="control-label col-sm-4 float-left col-form-label-sm">Người đổi ca/trực thay</span>
            <span class="float-left col-sm-4"><select class="form-control form-control-sm " name="data[changer_id]">
              <option>-Người đổi ca-</option>
              @foreach($staffs as $staff)
              <option value="{{ $staff->id }}">{{ $staff->name }}</option>
              @endforeach
            </select></span>
            <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[replacer_id]">
              <option>-Người trực thay-</option>
              @foreach($staffs as $staff)
              <option value="{{ $staff->id }}">{{ $staff->name }}</option>
              @endforeach
            </select></span>
          </div>
          <div style="clear:both"></div>
          <div class="form-group ">
            <span class="control-label col-sm-4 float-left col-form-label-sm">Ngày trực thay/ngày trả</span>
            <span class="float-left col-sm-4"><input type="date" class="form-control form-control-sm" name="data[date_change]"></span>  
            <span class="float-left col-sm-4"><input type="date" class="form-control form-control-sm" name="data[date_replace]" id="date_replace"></span>
          </div>
        <div style="clear:both"></div>
            <div class="form-group">
              <span class="control-label col-sm-4  float-left col-form-label-sm">Ca trực thay/trực trả</span>
              <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[shift_change]"><option value="0">Ngày</option><option value="1">Đêm</option></select></span> 
              <span class="float-left col-sm-4"><select class="form-control form-control-sm" name="data[shift_replace]" id="shift_replace"><option value="0">Ngày</option><option value="1">Đêm</option></select></span>
            </div>
            <div style="clear:both"></div>
            <div class="form-group">
              <span class="control-label col-sm-4 col-form-label-sm">Trả ca sau</span>
                <span class="float-right col-sm-8"><input id="doitlater" type="checkbox" name="data[doitlater]"></span>
              </div>  
            <div><button type="submit" class="btn btn-primary float-right btn-sm">Lưu</button></div>   
        
        <!-- /.card-body -->  
      </div></form>
        
    </div>  


            <div class="card">
              <div class="card-header">
                <span><h4 class="card-title">DANH SÁCH ĐỔI CA</h4></span>
                <span><button id="addnew" type="button" class="btn btn-primary float-right btn-sm">Thêm mới</button></span>
              </div>
              <div class="card-body p-0">
                <table class="table table-striped table-sm text-sm">
                  <thead>
                    <tr>
                      <th style="padding-left:5px;padding-right:2px">ID</th>
                      <th style="padding-left:5px;padding-right:2px">Người đổi</th>
                      <th style="padding-left:5px;padding-right:2px">Ngày đổi</th>
                      <th style="padding-left:5px;padding-right:2px">Người thay</th>
                      <th style="padding-left:5px;padding-right:2px">Ngày trả</th>
                      <th style="padding-left:5px;padding-right:2px">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($exchanges as $exchange)
                    <tr>
                      <td style="padding-left:5px;padding-right:2px">{{ $exchange->id}}</td>
                      <td style="padding-left:5px;padding-right:2px"><a href="javascript:loadEdit('{{ $exchange->id}}')">{{ $exchange->change_name}}</a></td>
                      <td style="padding-left:5px;padding-right:2px"><span @if($exchange->shift_change == 1) class="badge bg-dark" @else class="badge bg-light" @endif>{{ $exchange->date_change}}<span></td>
                      <td style="padding-left:5px;padding-right:2px">{{ $exchange->replace_name}}</td>
                      <td style="padding-left:5px;padding-right:2px"><span @if($exchange->shift_replace == 1) class="badge bg-dark" @else class="badge bg-light" @endif>{{ $exchange->date_replace}}<span></td>
                      <td style="padding-left:5px;padding-right:2px"><a href="/delaaa/{{$exchange->id}}"><i class="fas fa-trash-alt fa-lg" id="trash" style="color:red;cursor: pointer;"></i></a>&nbsp;|&nbsp;<a href="/printexchangework/{{$exchange->id}}"><i class="fas fa-print fa-lg" id="printer" style="color:green;cursor: pointer;"></i></a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- the events -->
                <!--
                <div id="external-events">
                  <div class="external-event bg-success">Lunch</div>
                  <div class="external-event bg-warning">Go home</div>
                  <div class="external-event bg-info">Do homework</div>
                  <div class="external-event bg-primary">Work on UI design</div>
                  <div class="external-event bg-danger">Sleep tight</div>
                  <div class="checkbox">
                    <label for="drop-remove">
                      <input type="checkbox" id="drop-remove">
                      remove after drop
                    
                  </div>
                </div>-->


              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {!! $exchanges->links() !!}
              </div>
            </div>
            <!-- /.card -->
            <!--
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Đổi ca</h3>
              </div>
              <div class="card-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                  <ul class="fc-color-picker" id="color-chooser">
                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                  </ul>
                </div>
                
                <div class="input-group">
                  <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                  <div class="input-group-append">
                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                  </div>
                  
                </div>
               
              </div>
            </div>-->
        
          </div>

        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-body p-0">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  @endsection

  <?php //echo '<pre>';print_r($teams);die;?>
  @section('javascript')
  <script>
    function loadEdit(id)
    {
      //$('#formexchange').hide(1000);
      //$('#formEditExchange').show(2000);
      $.ajax({
        url: "/editexchange/"+id,
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            console.log(res.result);
            //alert(res);
        }
    });
    }
    $(document).ready(function() {
    
      $('#addnew').click(function(){
        $('#formEditExchange').hide(1000);
        $('#formexchange').show(2000);
    });

    

    $('#doitlater').change(function() {
        if(this.checked) {
          $('#shift_replace').hide();	
          $('#date_replace').hide();	
          $('#date_replace').attr('disabled', 'disabled');
          $('#shift_replace').attr('disabled', 'disabled');
        }else{
          $('#shift_replace').show();	
          $('#date_replace').show();	
          $('#date_replace').removeAttr("disabled");
          $('#shift_replace').removeAttr("disabled");
        }    
    });
});
    $(function () {
      
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {
  
          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }
  
          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)
  
          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex        : 1070,
            revert        : true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })
  
        })
      }
  
      //ini_events($('#external-events div.external-event'))
  
      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()
  
      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;
  
      //var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');
  
      // initialize the external events
      // -----------------------------------------------------------------
  
      /*
      new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
          };
        }
      });*/
      
      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
          @foreach($logs as $log)
            {
              title          : '{{ $log["title"] }}',
              @if($logs['shift'] = 'S')
                start : '{{$log["date"]}} 00:00:00',
              @else
                start : '{{$log["date"]}} 19:30:00',
              @endif
              backgroundColor: '{{ $log["backgroundColor"] }}',
              borderColor    : '{{ $log["borderColor"] }}',
              allDay         : true
            },
          @endforeach

          @foreach($teams as $team)
            {
              title          : '{{ $team["title"] }}',
              @if($team['C'] = 'S')
                start : new Date( y , m, {{ $team["D"] }} , 0, 0, 0),
              @else
                start : new Date( y , m, {{ $team["D"] }} , 19, 30, 0),
              @endif
              backgroundColor: '{{ $team["backgroundColor"] }}',
              borderColor    : '{{ $team["borderColor"] }}',
              allDay         : true
            },
          @endforeach

          @foreach($exchanges as $exchange)
          @php 
            $chName = explode(" ", $exchange->change_name );
            $chName = end( $chName);
            $reName = explode(" ", $exchange->replace_name );
            $reName = end( $reName);
            $pre    = ($exchange->shift_change == 0) ? 'S' : 'Đ';
            $pre1   = ($exchange->shift_replace == 0) ? 'S' : 'Đ';
          @endphp
            {
              title : '{{$exchange->id}}.{{$pre}}: {{$reName}} -> {{$chName}}' ,
              @if($exchange->shift_change == 0)
                start : '{{$exchange->date_change}} 00:00:00',
              @else
                start : '{{$exchange->date_change}} 19:30:01',
              @endif    
              backgroundColor: '#cc66ff',
              borderColor    : '#cc66ff',
              allDay         : true
            },
            {
              title : '{{$exchange->id}}.{{$pre1}}: {{$chName}} -> {{$reName}}' ,
              @if($exchange->shift_replace == 0)
                start : '{{$exchange->date_replace}} 00:00:00',
              @else
                start : '{{$exchange->date_replace}} 19:30:01',
              @endif
              backgroundColor: '#cc66ff',
              borderColor    : '#cc66ff',
              allDay         : true
            },
          @endforeach
         
        ],
        datesSet: event => {
          //var midDate = new Date((event.start.getTime() + event.end.getTime()) / 2).getMonth()
          //var month = `0${ midDate.getMonth() + 1 }`.splice(0, -1)
          //alert(midDate);
          //alert(month);
          //doSomethingOnThisMonth(month, midDate.getFullYear())
        },
        eventOrder: ["start"],
        editable  : false,
        droppable : false, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });
  
      calendar.render();
      // $('#calendar').fullCalendar()
  
      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }
  
        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color'    : currColor,
          'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)
  
        // Add draggable funtionality
        ini_events(event)
  
        // Remove event from text input
        $('#new-event').val('')
      })
    })

    function doSomethingOnThisMonth(month1, month2){

    }
  </script>
   @endsection