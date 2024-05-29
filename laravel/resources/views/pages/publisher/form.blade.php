@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Publisher</h1>
    </div>
    <a href="{{route('publisher.index')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        List publisher
    </a>
    <div class="add-content">
        <form action="{{ isset($publisher) ? route('publisher.update', $publisher) : route('publisher.store') }}" method="POST" class="form-box">
            @csrf 
            @if(isset($publisher))
                @method('PUT')
            @endif
            <div class="form-input">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="{{ $publisher->name ?? '' }}" type="text" name="name" id="name" placeholder="Enter publisher name">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Enter publisher description">{{ $publisher->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="form-button flex justify-center items-center">
                <button type="submit" class="bg-blue-500 rounded-lg mt-10 px-12 py-6 text-white font-semibold">
                    {{ isset($publisher) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        typePage('Publisher');
    });
</script>
@endsection
