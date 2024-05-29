@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Author</h1>
    </div>
    <a href="{{route('author.index')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        List author
    </a>
    <div class="add-content">
        <form id="form-author" action="{{ isset($author) ? route('author.update', $author) : route('author.store') }}" method="POST" class="form-box">
            @csrf 
            @if(isset($author))
                @method('PUT')
            @endif
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="name">Name</label>
                    <input value="{{ $author->name ?? '' }}" type="text" name="name" id="name" placeholder="Enter author name">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Enter author description">{{ $author->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="form-button flex justify-center items-center">
                <button type="submit" class="bg-blue-500 rounded-lg mt-10 px-12 py-6 text-white font-semibold">
                    {{ isset($author) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    validate('#form-author');
});
</script>
@endsection
