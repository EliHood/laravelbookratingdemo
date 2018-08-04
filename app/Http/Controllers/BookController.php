<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rate;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $books = Book::paginate(10);

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'title'     => 'required',
                'description'  => 'required'
        ]);

        $book = new Book([
            'title'     => strip_tags($request['title']),
            'slug'      => $request['title'],
            'user_id'   => auth()->user()->id,
            'description' => strip_tags($request['description'])
        ]);

        $book->save();

        return redirect('/home');
    }


    public function rate(Request $request, $book_id)
    {

        $book = Book::find($book_id);

        $constraints = [
            'user_id' => auth()->id(),
            'book_id' => $book_id
        ];

        // checks if the user has not left a rating for this particular book
        if ($book->ratings()->where($constraints)->doesntExist()) {
            $ratings = new Rating();
            $ratings->book_id = $book_id;
            $ratings->rating =  $request['rating'];
            $ratings->user_id = auth()->id();
            $ratings->type = Book::RATED;
            $book->ratings()->save($ratings);

            return json_encode($book);
        } 


        else {
            return response()->json(['status' => 'You already left a review']);
        } 
        
    }

 

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($book_name)
    {
        $books = Book::GetBook($book_name)->get();


        $data = $books->map(function(Book $book){


            $book['rated'] =  $book->type; 
                           
            return $book;
         
        });

        return view('books.show', compact('data', $data));
    }

    public function rating($rating)
    {
        $book = Book::getRatingAttribute($rating)->userSumRating() ;

        return json_encode($book);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
