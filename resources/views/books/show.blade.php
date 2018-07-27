@extends('layouts.app')
@section('title', $book->title)
@section('content')
<div class="container">
   <div class="row">

   <div class="col-md-8 offset-md-2">
      @if (session('status'))
      <div class="alert alert-warning">
         {{ session('status') }}
      </div>
      @endif
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
               <form action="{{ route('rate', $book->id) }}" method="POST">
                  {!! csrf_field() !!}
                  <div id="rateYo" data-rateyo-rating="{{  $book->userSumRating or 0}}"> ></div>
                  <input name="rating" value='{{  $book->userSumRating  or 0 }}' type="hidden" id="val">
                  <button type="submit" class="btn btn-primary mt-2">submit</button>
               </form>

               <h6 class="mt-4">Overall ratings</h6>
               <div id="rateYo2" data-rateyo-rating="{{  $book->averageRating or 0}}"> ></div>

            </div>
         </div>
      </div>
</div>
@endsection