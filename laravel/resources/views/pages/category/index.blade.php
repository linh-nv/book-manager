@extends('layouts.layout')

@section('content')


<section class="dashboard-content">
    <div class="heading">
        <h1>Category</h1>
    </div>
    <a href="{{route('category.create')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        Create Category
    </a>
    <div class="list">
        <table id="table">
            <tr class="table-title bg-slate-200">
                <th>Slug</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach ($category as $index => $cate)    
            <tr class="{{ $index % 2 == 0 ? 'bg-slate-100' : '' }}">
                <td class="table-content-slug">{{ $cate->slug }}</td>
                <td class="table-content-name">{{ $cate->name }}</td>
                <td class="table-content-description">{{ $cate->description }}</td>
                <td class="p-10">
                    <div class="action">
                        <a href="{{ route('category.edit', $cate) }}" class="edit">
                            <img src="{{ asset('icons/pencil-write.svg') }}" alt="icon-edit">
                        </a>
                        <form action="{{ route('category.destroy', $cate) }}" method="post" class="delete" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <div>
                                    <img src="{{ asset('icons/bin.svg') }}" alt="icon-delete">
                                </div>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {{ $category->links('vendor.pagination.pagination') }}     
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        typePage('Category');
    });
</script>
@endsection