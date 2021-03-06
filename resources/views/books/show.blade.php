@extends('layouts.app')

@section('title')
@section('content')
@foreach ($data as $book)
<div class="container">
   <div class="row">

   <div class="col-md-8 offset-md-2">
      <div id="flash-message" class="alert alert-warning">
        
      </div>


      <div class="card">
         <div class="card-header">
            {{ $book->title }}
         </div>
         <div class="card-body">
            <div class="card-info">
               <h6 style="font-style: italic;">Book Description</h6>
               <p>{{ $book->description }}</p>
               <hr>
               <p>Created: {{ $book->created_at->diffForHumans() }}</p>
               <h6>Ratings</h6>
               <form id="sub" data="{{ $book }}">
                  {!! csrf_field() !!}
                  <div id="rateYo" data-rateyo-read-only="{{ $book->rated }}" data-rateyo-rating="{{  $book->userSumRating or 0}}"></div>
                  <input name="rating" value='{{  $book->userSumRating  or 0 }}' type="hidden" id="val">
                  <button type="submit" class="btn btn-primary mt-2">submit</button>
               </form>

               <h6 class="mt-4">Overall ratings</h6>
               <div id="rateYo2" data-rateyo-rating="{{  $book->averageRating or 0}}"> ></div>

            </div>
         </div>
      </div>
      @endforeach
</div>


@endsection