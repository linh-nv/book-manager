@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Role</h1>
    </div>
    <button class="px-10 py-8 bg-blue-500 text-white rounded-lg">
        <a href="{{route('role.create')}}">
            Create Role
        </a>
    </button>
    <div class="add-content">
        <div class="form-box-category">
            <div class="form-input">
                <div class="form-group form-category">
                    <label for="category-title">Category ID</label>
                    <input type="text" name="id" id="category-id" placeholder="Enter category id">
                </div>
                <div class="form-group form-category">
                    <label for="category-title">Category Name</label>
                    <input type="text" name="title" id="category-title" placeholder="Enter category name">
                </div>
            </div>
            <div class="form-button">
                <button id="submid-category" onclick="submitCategory()">
                    Submit
                </button>
            </div>
        </div>
    </div>    
</section>
<section id="paginate">
    <!-- <div id="prev-page" onclick="prevPage()">
        <img src="./assets/icons/prev.svg" alt="">
    </div>
    <div id="page-link">
        <span>1</span>
    </div>
    <div id="next-page" onclick="nextPage()">
        <img src="./assets/icons/next.svg" alt="">
    </div> -->
</section>
@endsection
