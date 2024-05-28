<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Repositories\Author\AuthorRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $author = $this->authorRepository->getPaginate();   
        
        return view('pages.author.index', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('pages.author.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled(['name', 'description'])) {
            $this->authorRepository->create([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('author.index');
        }

        return redirect()->back()->with(['error' => 'Create author false!!']); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author): View
    {

        return view('pages.author.form', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse
    {
        if ($request->has(['name', 'description'])) {
            $this->authorRepository->update($author->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->route('author.index');
        }

        return redirect()->back()->with(['error' => 'Update author failed!']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $this->authorRepository->delete($author->id);
        
        return redirect()->route('author.index');
    }
}
