@extends('layouts.app')

<script src="{{ mix('js/app.js') }}"></script>
@section('content')
<div class="container">
    <h1>Создайте сокращённую ссылку</h1>
    <div class="card-header">
        <form id="formForGettingShortLink"> 
           
            <div class="input-group mb-3">
            <input type="text" id="link" name="link" class="form-control" placeholder="URL">
          
            <div class="input-group-append">
                <button id="submit" class="btn btn-success"  >Сократить ссылку</button>
            </div>
            </div>
    </form>
    </div>

    <div class="card-body">
        @if(Session::has('success'))
        <div class="alert alert-success">
            <p>{{Session::get('success')}}</p>
        </div>
        @endif

        <table class="table table-bordered table-sm">
            <thead>
                <th>ID</th>
                <th>Сокращённая ссылка</th>
                <th>Ссылка</th>
                <th>Переходов</th>
            </thead>
            <tbody>
                @foreach($shortLinks as $link)
                <tr>
                    <td>{{$link->id}}</td>
                    <td>
                        <a href="{{route('shorten.link', $link->code)}}" target="_blank">
                            {{route('shorten.link', $link->code)}}</a>
                    </td>
                    <td>{{$link->link}}</td>
                    <td>{{$link->count}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<script>
/*$("#formForGettingShortLink").on("submit", function(){
    var link = {
            link: $("#link").val()
           
            
        }
        alert(JSON.stringify(link));
	$.ajax({
	url: 'http://127.0.0.1:8000/cc/post',
	method: 'post',
	dataType: 'json',
    contentType: 'application/json',
    data: JSON.stringify(link),
	success: function(data){
		alert(data.text);    
		alert(data.error);   
	},
    error: function (data) {
        var errors = $.parseJSON(data.responseText);
        $.each(errors, function (key, value) {
            $('#' + key).parent().addClass('error');
        });
    }
    
});
});*/

$(document).ready(function() {
  $("#submit").click(function() {
    var link =  $("#link").val();
    var query = {
        link : $("#link").val()      
    };
           
         // alert(query);  

    $.ajax({
      type: "POST",
      url: "http://127.0.0.1:8000/cc/post",
      data: query,
      success: function(data){
		alert(data);    
		//alert(data.error);   
	}
    
    });
  });
});

</script>