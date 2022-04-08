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
        

        <table id="tableShowLinks" class="table table-bordered table-sm">
            <thead>
                <th>ID</th>
                <th>Сокращённая ссылка</th>
                <th>Ссылка</th>
               
            </thead>
            <tbody>
               
               
              
               
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

    $.ajax({
      type: "get",
      url: "http://127.0.0.1:8000/showShortLinkAllRecords",
     
      success: function(result){
        //  console.log(result);
       
       // $('#tableShowLinks tr').empty();
     
       var body = $('#tableShowLinks tbody');
       
       // Body
       for (var d in result) {
        var data = result[d];
        console.log(result);
          $('#tableShowLinks tbody').append($('<tr>')
              .append($('<td>', { text: data.id }))
              .append($('<a href="'+data.link+' " target="_blank"> '+data.code+"</a>"))
              .append($('<td>', { text: data.link }))
              
          )
       }

	}
    
    });


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
      success: function(result){
        
        var body = $('#tableShowLinks tbody');
       
       // Body
       for (var d in result) {
        var data = result[d];
        console.log(result);
          $('#tableShowLinks tbody').append($('<tr>')
              .append($('<td>', { text: data.id }))
              .append($('<a href="'+data.link+' " target="_blank"> '+data.code+"</a>"))
              .append($('<td>', { text: data.link }))
              
          )
       }

	}
    
    });
  });
});

</script>