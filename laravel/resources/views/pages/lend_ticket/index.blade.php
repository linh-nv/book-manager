@extends('layouts.layout')

@section('content')

<section class="dashboard-content">
    <div class="heading">
        <h1>Lend Ticket</h1>
    </div>
    <a href="{{route('lend_ticket.create')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        Create ticket
    </a>
    <div class="list">
        <table id="table">
            <tr class="table-title bg-slate-200">
                <th>User</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Note</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($lendTickets as $lend)    
            {{-- <tr class="{{ $index % 2 == 0 ? 'bg-slate-100' : '' }}"> --}}
                <td class="p-10">{{ $lend->user->name }}</td>
                <td class="p-10">{{ $lend->start_date }}</td>
                <td class="p-10">{{ $lend->end_date }}</td>
                <td class="p-10">{{ $lend->note }}</td>
                <td class="p-10">{{ $lend->status }}</td>
                <td class="flex justify-center items-center p-10">
                    <div class="action">
                        <a href="{{ route('lend_ticket.edit', $lend) }}" class="edit">
                            <img src="{{ asset('icons/pencil-write.svg') }}" alt="icon-edit">
                        </a>
                        <form action="{{ route('lend_ticket.destroy', $lend) }}" method="post" class="delete" onsubmit="return confirm('Are you sure you want to delete this book?');">
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
    {{ $lendTickets->links('vendor.pagination.pagination') }}     
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        typePage('Lend Ticket');
    });
</script>
@endsection