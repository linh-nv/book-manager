@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Create Role</h1>
    </div>
    <div class="list">
        <input type="hidden" id="id_delete_category" value="">
        <table id="table">
            <tr class="table-title">
                <th>ID</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>00001</td>
                <td>Category</td>
                <td>
                    <div class="action">
                        <div class="edit">
                            <img src="{{asset('icons/pencil-write.svg')}}" alt="edit-icon">
                        </div>
                        <div class="delete">
                            <img src="{{asset('icons/bin.svg')}}" alt="delete-icon">
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>       
</section>
@endsection