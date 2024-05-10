@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Category</h1>
    </div>
    <a href="{{route('category.index')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        List Category
    </a>
    <div class="add-content">
        <form action="{{ isset($category) ? route('category.update', $category) : route('category.store') }}" method="POST" class="form-box">
            @csrf 
            @if(isset($category))
                @method('PUT')
            @endif
            <div class="form-input">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input oninput="changeToSlug()" value="{{ $category->name ?? '' }}" type="text" name="name" id="name" placeholder="Enter category name">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input value="{{ $category->slug ?? '' }}" type="text" name="slug" id="slug" placeholder="Enter category slug">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Enter category description">{{ $category->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="form-button flex justify-center items-center">
                <button type="submit" class="bg-blue-500 rounded-lg mt-10 px-12 py-6 text-white font-semibold">
                    {{ isset($category->slug) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        
    </div>
</section>
@endsection
