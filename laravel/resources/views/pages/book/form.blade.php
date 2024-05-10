@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Book</h1>
    </div>
    <div class="add-content">
        <div class="form-box">
            <div class="form-input">
                <div class="form-group">
                    <label for="book-id">ID</label>
                    <input type="text" name="book-id" id="book-id" placeholder="Enter book id">
                </div>
                <div class="form-group">
                    <label for="your-email">Image Path</label>
                    <input type="text" name="book-image" id="book-image" placeholder="Enter image path">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="fist-name">Title</label>
                    <input type="text" name="title" id="book-title" placeholder="Enter book title">
                </div>
                <div class="form-group">
                    <label for="last-name">Author</label>
                    <input type="text" name="book-author" id="book-author" placeholder="Enter book author">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="your-email">Publisher</label>
                    <input type="text" name="book-publisher" id="book-publisher" placeholder="Enter publisher">
                </div>
                <div class="form-group">
                    <label for="phone-number">Price</label>
                    <input type="text" name="book-price" id="book-price" placeholder="Enter book price">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category">
                        <option value="" disabled selected hidden>-- Select category --</option>
    
                    </select>                            
                </div>
            </div>
            <div class="form-button">
                <button onclick="submitBook()">
                    Submit
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
