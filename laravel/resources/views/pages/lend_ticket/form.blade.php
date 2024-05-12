@extends('layouts.layout')

@section('content')
<section class="dashboard-content">
    <div class="heading">
        <h1>Lend Ticket</h1>
    </div>
    <a href="{{route('lend_ticket.index')}}" class="px-12 py-6 bg-blue-500 rounded-lg text-white">
        List Lend Ticket
    </a>
    <div class="add-content">
        <form action="{{ isset($lendTicketed) ? route('lend_ticket.update', $lendTicketed) : route('lend_ticket.store') }}" method="POST" class="form-box">
            @csrf 
            @if(isset($lendTicketed))
                @method('PUT')
            @endif
            <div class="form-input">
                <div class="form-group">
                    <label for="user">User</label>
                    <select name="user_id" id="user">
                        @if (isset($lendTicketed))
                            <option value="{{$lendTicketed->user->id}}">{{$lendTicketed->user->name}}</option>                            
                        @else
                            <option value="" disabled selected hidden>-- Select user --</option>
                        @endif

                        @foreach ($lendTickets as $lend)
                            <option value="{{ $lend->user->id }}">{{ $lend->user->name }}</option>
                        @endforeach
                    </select>                            
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        @if (isset($lendTicketed))
                            <option value="{{$lendTicketed->status}}">{{App\Enum\LendTicketStatus::from($lendTicketed->status)->label()}}</option>                            
                        @else
                            <option value="" disabled selected hidden>-- Select status --</option>
                        @endif

                        @foreach (App\Enum\LendTicketStatus::values() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>                            
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="start_date">Start_date</label>
                    <input value="{{ $lendTicketed->start_date ?? '' }}" type="date" name="start_date" id="start_date" placeholder="Enter lend_ticket start_date">
                </div>
                <div class="form-group">
                    <label for="end_date">End_date</label>
                    <input value="{{ $lendTicketed->end_date ?? '' }}" type="date" name="end_date" id="end_date" placeholder="Enter lend_ticket end_date">
                </div>
            </div>
            <div class="form-input">
                <div class="form-group">
                    <label for="note">Note</label>
                    <input value="{{ $lendTicketed->note ?? '' }}" type="text" name="note" id="note" placeholder="Enter lend_ticket note">
                </div>
            </div>
            <div class="form-button flex justify-center items-center">
                <button type="submit" class="bg-blue-500 rounded-lg mt-10 px-12 py-6 text-white font-semibold">
                    {{ isset($lendTicketed) ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
        
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        typePage('Lend Ticket');
    });
</script>
@endsection
