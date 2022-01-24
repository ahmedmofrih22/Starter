@extends('layouts.app')

@section('content')
<div class="container">

      <div class="flex-center position-ref full-height">
            <!-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->



<!-- form -->




            <div class="content">
                <div class="title m-b-md">
                  {{__('messages.Add your offer')}} 
                </div>
         @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
               {{Session::get('success')}} 
                </div>
                @endif
                        <br>
                <form method='' action="POST" id="offerForm" enctype="multipart/form-data">
                @csrf
                {{--  <!-- <input name="_token" value="{{csrf_token()}}"> -->  --}}
                <div class="form-group">
                        <label for="exampleInputEmail1">اختر الصوره</label>
                        <input type="file" class="form-control" name='photo'>
                       
                        <small id="photo_error" class="form-text  text-danger"></small>
                       
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name='name_ar' placeholder="{{__('messages.Offer Name ar')}}">
                       
                        <small id="name_ar_error" class="form-text  text-danger"></small>
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name='name_en' placeholder="{{__('messages.Offer Name en')}}">
                       
                        <small id="name_en_error" class="form-text  text-danger"></small>
                      
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> {{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name='price' placeholder="{{__('messages.Offer Price')}}">
                       
                        <small id="price_error" class="form-text  text-danger"></small>
                     
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details ar')}} </label>
                        <input type="text" class="form-control" name='details_ar' placeholder="{{__('messages.Offer details ar')}}">
                        
                        <small id="details_ar_error" class="form-text text-danger"></small>
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details en')}} </label>
                        <input type="text" class="form-control" name='details_en' placeholder="{{__('messages.Offer details en')}}">
                      
                        <small id="details_en_error" class="form-text text-danger"></small>
                      
                    </div>
                    <div class="alert alert-success" id="success_msg" style="display: none;">
                        تم الحفظ بنجاح

                    </div>

                    <button id="save-offer"  class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>
             
            </div>
        </div>

</div>
@stop

@section('scripts')
    <script>
$(document).on('click','#save-offer',function(e){
    e.preventDefault();
    $('#photo_error').text('');
      $('#name_ar_error').text('');
        $('#name_en_error').text('');
          $('#price_error').text('');
            $('#details_ar_error').text('');
              $('#details_en_error').text('');
              
    var formData = new FormData($('#offerForm')[0]);
     $.ajax({

          type: 'post',
          url : "{{route('ajax.offers.store')}}",
          enctype:'multipart/form-data',
          processData:false,
          contentType:false,
          cache:false,

        //  data:{
          //    '_token':"{{csrf_token()}}",  
          
           // 'name_ar': $("input[name='name_ar']").val(),
           // 'name_en': $("input[name='name_en']").val(),
           // 'price': $("input[name='price']").val(),
           // 'details_ar': $("input[name='details_ar']").val(),
           // 'details_en': $("input[name='details_en']").val(),
          //},

         data : formData,
          success : function(data){
              if(data.status == true) {
                  $('#success_msg').show();
              }
                 
              
          }, error:function(reject){
              var response = $.parseJSON(reject.responseText);
              $.each(response.errors,function(key,val){
                  $("#" + key + "_error").text(val[0]);
                  //$('#details_ar_error').text(val[0])

              });

          }




    });

})

   
    </script>
@stop