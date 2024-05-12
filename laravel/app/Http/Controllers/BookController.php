<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\Book\BookRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ImageController;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $book = $this->bookRepository->getPaginate();   
        
        return view('pages.book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $select = $this->bookRepository->getAllCategoriesAuthorsPublishers();   

        return view('pages.book.form', compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->has([
                'name', 
                'slug', 
                'quantity', 
                'description', 
                'front_image', 
                'thumbnail', 
                'rear_image', 
                'category_id', 
                'author_id',  
                'publisher_id', 
                'price'
            ])) {
        
            $uploadImages = new ImageController();
            $arrPathImages = $uploadImages->uploadBookImage($request);

            $this->bookRepository->create([
                'name' => $request->name,
                'slug' => $request->slug, 
                'quantity' => $request->quantity,
                'description' => $request->description,
                'front_image' => $arrPathImages['front_image'], 
                'thumbnail' => $arrPathImages['thumbnail'], 
                'rear_image' => $arrPathImages['rear_image'], 
                'category_id' => $request->category_id, 
                'author_id' => $request->author_id,  
                'publisher_id' => $request->publisher_id, 
                'price' => $request->price, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('book.index');
        }

        return redirect()->back()->with(['error' => 'Create book false!!']); 
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
    public function edit(Book $book): View
    {
        $select = $this->bookRepository->getAllCategoriesAuthorsPublishers();   
        $book = $this->bookRepository->loadAllRelationship($book);

        return view('pages.book.form', compact('book', 'select'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        // return response()->json($request->all());
        if ($request->has([
                'name', 
                'slug', 
                'quantity', 
                'description',  
                'category_id', 
                'author_id',  
                'publisher_id', 
                'price'
            ])) {
    
            $uploadImages = new ImageController();
            $arrPathImages = $uploadImages->uploadBookImage($request);

            $this->bookRepository->update($book->id, [
                'name' => $request->name ?? $book->name,
                'slug' => $request->slug ?? $book->slug,
                'quantity' => $request->quantity ?? $book->quantity,
                'description' => $request->description ?? $book->description,
                'category_id' => $request->category_id ?? $book->category_id,
                'author_id' => $request->author_id ?? $book->author_id,
                'publisher_id' => $request->publisher_id ?? $book->publisher_id,
                'price' => $request->price ?? $book->price,
                'front_image' => $arrPathImages['front_image'] ?? $book->front_image,
                'thumbnail' => $arrPathImages['thumbnail'] ?? $book->thumbnail,
                'rear_image' => $arrPathImages['rear_image'] ?? $book->rear_image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            return redirect()->route('book.index');
        }
        return redirect()->back()->with(['error' => 'Update book false!!']); 
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $this->bookRepository->delete($book->id);
        
        return redirect()->route('book.index');
    }
}
