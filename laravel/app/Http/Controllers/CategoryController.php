<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryRepository->getAll();   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->filled(['name', 'slug', 'description'])) {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return redirect()->route('category.index');
        }
        return redirect()->back()->with(['error' => 'Create category false!!']); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('pages.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($request->has(['name', 'slug', 'description'])) {
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
            ]);
            return redirect()->route('category.index');
        }
        return redirect()->back()->with(['error' => 'Update category failed!']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
