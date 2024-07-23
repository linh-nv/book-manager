@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Book</h1>
    </div>
    <a href="{{route('book.index')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        List book
    </a>
    <div class="add-content">
        <form id="form-book" action="{{ isset($book) ? route('book.update', $book) : route('book.store') }}" method="POST" enctype="multipart/form-data" class="form-box">
            @csrf 
            @if(isset($book))
                @method('PUT')
            @endif
            <div class="form-upload-box flex justify-center gap-96 mb-20">
                <div class="form-upload relative">
                    <div class="upload">
                        <input id="upload-front_image" type="file" class="upload-photo" name="front_image" accept="image/*">
                        @if (isset($book))
                            <label for="upload-front_image">
                                <img class="w-40 h-40" src="{{ asset($book->front_image) }}" alt="">
                            </label>
                        @else
                            <label for="upload-front_image" class="upload-icon bg-blue-100">
                                <i class="fa-solid fa-image fa-xl text-blue-500"></i>
                            </label>
                        @endif
                    </div>
                    <label for="upload-front_image" class="label-text truncate overflow-ellipsis overflow-hidden whitespace-nowrap w-36 text-center">Front image</label>
                </div>
                <div class="form-upload relative">
                    <div class="upload">
                        <input id="upload-thumbnail" type="file" class="upload-photo" name="thumbnail" accept="image/*">
                        @if (isset($book))
                            <label for="upload-thumbnail">
                                <img class="w-40 h-40" src="{{ asset($book->thumbnail) }}" alt="">
                            </label>
                        @else
                            <label for="upload-thumbnail" class="upload-icon bg-blue-100">
                                <i class="fa-solid fa-panorama fa-xl text-blue-500"></i>
                            </label>
                        @endif
                    </div>
                    <label for="upload-thumbnail" class="label-text truncate overflow-ellipsis overflow-hidden whitespace-nowrap w-36 text-center">Thumbnail</label>
                </div>
                <div class="form-upload relative">
                    <div class="upload">
                        <input id="upload-rear_image" type="file" class="upload-photo" name="rear_image" accept="image/*">
                        @if (isset($book))
                            <label for="upload-rear_image">
                                <img class="w-40 h-40" src="{{ asset($book->rear_image) }}" alt="">
                            </label>
                        @else
                            <label for="upload-rear_image" class="upload-icon bg-blue-100">
                                <i class="fa-solid fa-images fa-xl text-blue-500"></i>
                            </label>
                        @endif
                    </div>
                    <label for="upload-rear_image" class="label-text truncate overflow-ellipsis overflow-hidden whitespace-nowrap w-36 text-center">Rear image</label>
                </div>
                
                <script>

                </script>
                
            </div>
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="name">Name</label>
                    <input oninput="changeToSlug()" value="{{ $book->name ?? '' }}" type="text" name="name" id="name" placeholder="Enter book name">
                </div>
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="slug">Slug</label>
                    <input value="{{ $book->slug ?? '' }}" type="text" name="slug" id="slug" placeholder="Enter book slug">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="Enter book description">{{ $book->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="quantity">Quantity</label>
                    <input value="{{ $book->quantity ?? '' }}" type="number" min=1 name="quantity" id="quantity" placeholder="Enter book quantity">
                </div>
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="price">Price</label>
                    <input value="{{ $book->price ?? '' }}" type="number" min=1000 name="price" id="price" placeholder="Enter book price">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="category">Category</label>
                    <select name="category_id" id="category">
                        @if (isset($book))
                            <option value="{{$book->category->id}}">{{$book->category->name}}</option>                            
                        @else
                            <option value="" disabled selected hidden>-- Select publisher --</option>
                        @endif

                        @foreach ($select['categories'] as $categoryId => $categoryName)
                            <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                        @endforeach
                    </select>                            
                </div>
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="author">Author</label>
                    <select name="author_id" id="author">
                        @if (isset($book))
                            <option value="{{$book->author->id}}">{{$book->author->name}}</option>                            
                        @else
                            <option value="" disabled selected hidden>-- Select publisher --</option>
                        @endif
                        
                        @foreach ($select['authors'] as $authorId => $authorName)
                            <option value="{{ $authorId }}">{{ $authorName }}</option>
                        @endforeach
                    </select>                            
                </div>
                <div class="form-group">
                    <span class="message text-red-500">&nbsp;</span>
                    <label for="publisher">Publisher</label>
                    <select name="publisher_id" id="publisher">
                        @if (isset($book))
                            <option value="{{$book->publisher->id}}">{{$book->publisher->name}}</option>                            
                        @else
                            <option value="" disabled selected hidden>-- Select publisher --</option>
                        @endif
                
                        @foreach ($select['publishers'] as $publisherId => $publisherName)
                            <option value="{{ $publisherId }}">{{ $publisherName }}</option>
                        @endforeach
                    </select>                            
                </div>
            </div>
            <div class="form-button flex justify-center items-center">
                <button type="submit" class="bg-blue-500 rounded-lg mt-20 px-12 py-6 text-white font-semibold">
                    {{ isset($book) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadNameFilesUpload();
        Validator({
            form: '#form-book',
            formGroupSelector: '.form-input',
            errorSelector: '.message',
            rules: [
                Validator.isName('#name'),
                Validator.isRequired('#slug'),
                Validator.isRequired('#description'),
                Validator.isNumber('#price'),
            ],
            onSubmit: function (data) {
                document.getElementById('form-category').submit();
            }
        });

        slug ? document.getElementById('name').addEventListener('input', changeToSlug) : '';
    });
</script>
@endsection
