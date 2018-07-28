@extends('layouts.app')

@section('title', 'All Books')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-book"> Books</i>
                </div>

                <div class="card-body">
                    @if ($books->isEmpty())
                        <p>There are currently no Books.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                             
                                    <th>Title</th>
                                    <th>Last Updated</th>
                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>
                                        <a href="{{ url('books/'. str_slug($book->slug)) }}">
                                            #{{ $book->id }} -  {{ $book->title }}
                                        </a>
                                    </td>
                            
                                    <td>{{ $book->updated_at }}</td>
                               
                                   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $books->render() }}
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection