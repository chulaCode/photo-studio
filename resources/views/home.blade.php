@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
      <div class="show"></div>
      <div id="errMsg"></div>
        <div class="card">
            <div class="card-body">
                <form id="form" name="myForm" class="" method="post" action="{{route('album.store')}}"
                enctype="multipart/form-data">@csrf
                    <div class="form-group">
                    <label for="Name">Name of Album</label>
                    <input type="text" name="album" class="form-control">
                    </div>
                
                    <div class=" mb-3 input-group control-group initial-add-more">
                        <input type="file" name="image[]" class="form-control"
                        id="image">
                        <div class=input-group-btn>
                            <button class="btn btn-success btn-add-more" type="button">
                            Add</button>

                        </div>
                </div>
                    <div class="copy " style="display:none">
                            <div id="input-file" class="input-group control-group add-more mb-3">
                                <input type="file" name="image[]" class="form-control"
                                id="image">
                                <div class=input-group-btn>
                                    <button class="btn btn-danger remove" type="button">
                                    Remove</button>
                                </div>

                            </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success mt-3" type="submit">
                        Submit </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
       
    </div>
</div>
@endsection
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/
jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready((e)=>{
    $(".btn-add-more").click(()=>{
        let html=$(".copy").html();
        //display the button before copy div
        $(".initial-add-more").after(html);
    })
    $("body").on("click",".remove",()=>{
        $("#input-file").remove();
    })
});
</script>
<script>
	$(document).ready(()=> {
 		$("#form").on('submit',((e)=>{
  		e.preventDefault();


		$.ajax({
       	url: "/album",
	   	type: "POST",
	   	data:  new FormData(myForm),
	   	contentType: false,
	         cache: false,
             //processData must be set to false when 
             //processing multipart data
	   	processData:false,
	   
	    success:(response)=>
	    {
	    	console.log(response);
	     	$('.show').html(response);
	     	$("#form")[0].reset(); 
	     	$("#errMsg").empty()


	     },
	    error:(data)=> {
	    	//console.log(data.responseJSON)
	    	let error = data.responseJSON;
            console.log(error)
            $("#errMsg").empty()
	    	$.each(error.errors,(key,value)=>{
	    		$("#errMsg").append('<p class="text-center text-danger">'+value+'</p>');

	    	});

	    	
		}
  
     
    });
 }));
});


</script>
<style>
.text-danger{
	color: red;
}
<style>
	

</style>