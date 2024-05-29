@extends('layouts.layout')

@section('content')


<section class="dashboard-content">
    <div class="heading">
        <h1>Author</h1>
    </div>
    <a href="{{route('author.create')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        Create author
    </a>
    <div class="list">
        <table id="table">
            <tr class="table-title bg-slate-200">
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach ($author as $index => $cate)    
            <tr class="{{ $index % 2 == 0 ? 'bg-slate-100' : '' }}">
                <td class="table-content-name">{{ $cate->name }}</td>
                <td class="table-content-description">{{ $cate->description }}</td>
                <td class="flex justify-center items-center p-10">
                    <div class="action">
                        <a href="{{ route('author.edit', $cate) }}" class="edit">
                            <img src="{{ asset('icons/pencil-write.svg') }}" alt="icon-edit">
                        </a>
                        <form action="{{ route('author.destroy', $cate) }}" method="post" class="delete" onsubmit="return confirm('Are you sure you want to delete this author?');">
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
    {{ $author->links('vendor.pagination.pagination') }}     
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        typePage('Author');
    });
</script>
@endsection