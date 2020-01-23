@extends('layouts.app')

@section('content')

    <!--Add image-->
    @include('fraction')
       <div class="container">
    <!--end add image-->
@if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
    @endif

<h1>{{$albums->name}}({{$albums->images->count()}})</h1>

   
    <div class="row">
        @foreach($albums->images as $album)
            <div class="col-sm-4">
                <div class="item">
                <img src="{{asset('storage/'.$album->name)}}"
                class="thumbnail" style="width:300px;height:300px;border:2px solid red;">
                </div>
                <!-- Button trigger modal -->
                @if(Auth::check()&&Auth::user()->user_type=='admin')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$album->id}}">
                Delete</button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                         <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete?
                            </div>
                            <div class="modal-footer">
                                    <form action="{{route('image.delete')}}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{$album->id}}">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        
           <!--modal ends-->
      
        @endforeach
    </div>


</div>

@endsection

<style>
    .item{
        left: 0;
        top: 0;
        position: relative;
        overflow: hidden;
        margin-top: 50px;
    }
    .item img{
        -webkit-transition:0.6s ease;
        transition: 0.6s ease;
    }
    .item img:hover{
        -webkit-transform:scale(1.2);
        transform:scale(1.2);
    }
    .centered{
        position: absolute;
        top: 50%;
        left: 50%;
        transform:translate(-50%,-50%);
        color: #fff;
        font-size: 24px;
        font-weight: bold;

    }
    .img-thumbnail{
        border: 0px;
        border-radius: 0px;
    }

</style>