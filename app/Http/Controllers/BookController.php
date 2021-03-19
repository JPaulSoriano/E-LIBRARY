<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //


        $categories = Category::all();

        $books = Book::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if(($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%'. $term . '%')->get();
                    $query->orWhere('author', 'LIKE', '%'. $term . '%')->get();
                }
            }]
        ])

            ->orderBy("id", "desc")
            ->paginate(5);

        return view('books.index',compact('books', 'categories'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'pdf' => 'required|mimes:pdf',
            'cover' => 'required|mimes:jpg,png|max:2048'
        ]);

        $pdf = new Book;
        $pdf->title = $request->title;
        $pdf->author = $request->author;
        $pdf->category_id = $request->category_id;
        
        if($request->file()) {
            $pdfname = time().'_'.$request->pdf->getClientOriginalName();
            $covername = time().'_'.$request->cover->getClientOriginalName();
            $pdfpath = $request->file('pdf')->storeAs('uploads', $pdfname, 'public');
            $coverpath = $request->file('cover')->storeAs('uploads', $covername, 'public');
            $pdf->pdf_path = $pdfpath;
            $pdf->cover_path = $coverpath;
        }

        $pdf->save();

        return redirect()->route('books.index')
        ->with('success','File has been uploaded.');

    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        $categories = Category::all();
        return view('books.show',compact('book', 'categories'));
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
        $categories = Category::all();
        return view('books.edit',compact('book', 'categories'));
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
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required'
        ]);
  
        $book->update($request->all());
  
        return redirect()->route('books.index')
                        ->with('success','Book updated successfully');
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
        $book->delete();
  
        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }

    public function categorize(Category $category)
    {
        $categories = Category::all();

        $books = Book::where('category_id', $category->id)->latest()->paginate(5);

        return view('books.index',compact('books', 'categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

   
}
