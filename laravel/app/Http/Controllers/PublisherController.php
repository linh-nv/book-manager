<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Repositories\Publisher\PublisherRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class PublisherController extends Controller
{
    protected $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $publisher = $this->publisherRepository->getPaginate();   
        
        return view('pages.publisher.index', compact('publisher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('pages.publisher.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled(['name', 'description'])) {
            $this->publisherRepository->create([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return redirect()->route('publisher.index');
        }

        return redirect()->back()->with(['error' => 'Create publisher false!!']); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher): View
    {

        return view('pages.publisher.form', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher): RedirectResponse
    {
        if ($request->has(['name', 'description'])) {
            $this->publisherRepository->update($publisher->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return redirect()->route('publisher.index');
        }

        return redirect()->back()->with(['error' => 'Update publisher failed!']);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher): RedirectResponse
    {
        $this->publisherRepository->delete($publisher->id);
        
        return redirect()->route('publisher.index');
    }
}