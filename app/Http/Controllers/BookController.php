<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('perPage', 10); 
        $search = request('search');

        $query = Book::with('author', 'category', 'ratings')
            ->whereHas('ratings', function ($query) {
                $query->where('rating', '>', 0);
            });
            
            
            if ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('author', function ($authorQuery) use ($search) {
                            $authorQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            }

            $topBooks = $query->withCount(['ratings' => function ($ratingQuery) {
                $ratingQuery->select(\DB::raw('count(distinct user_id)'));
            }])
            ->orderByDesc('ratings_count')
            ->orderByDesc(\DB::raw('COALESCE((SELECT AVG(rating) FROM ratings WHERE book_id = books.id), 0)'))
            ->limit(10)
            ->get();
            
            
            $books = $query->withCount(['ratings' => function ($ratingQuery) {
                $ratingQuery->select(\DB::raw('count(distinct user_id)'));
            }])
            ->orderByDesc('ratings_count')
            ->orderByDesc(\DB::raw('COALESCE((SELECT AVG(rating) FROM ratings WHERE book_id = books.id), 0)'))
            ->paginate($perPage);
            
            if ($books->isEmpty() && $topBooks->isNotEmpty()) {
                $books = $topBooks->paginate($perPage);
            }
    
    
            return view('books.index', compact('books'));
        }


    public function topAuthors()
    {
        $topAuthors = Author::withCount(['books' => function ($bookQuery) {
            $bookQuery->whereHas('ratings', function ($ratingQuery) {
                $ratingQuery->where('rating', '>', 5);
            });
        }])
        ->orderByDesc('books_count')
        ->limit(10)
        ->get();

    
        return view('authors.top', compact('topAuthors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
