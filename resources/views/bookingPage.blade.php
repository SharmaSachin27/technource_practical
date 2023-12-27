@extends('layouts.master')
@section('content')

<div class="row mt-5 justify-content-center">
    <div class="col-md-8">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" type="text" class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" name="email" type="email" class="form-control">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="booking_type" class="form-label">Booking Type</label>
                        <select id="booking_type" name="booking_type" class="form-control">
                            <option value="Full Day">Full Day</option>
                            <option value="Half Day">Half Day</option>
                        </select>
                        @error('booking_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input id="booking_date" name="booking_date" type="date" class="form-control">
                        @error('booking_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="booking_slot" class="form-label">Booking Slot</label>
                        <select id="booking_slot" name="booking_slot" class="form-control">
                            <option value="Morning" class="morning">Morning</option>
                            <option value="Evening" class="evening">Evening</option>
                        </select>
                        @error('booking_slot')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="booking_time" class="form-label">Booking Time</label>
                        <input id="booking_time" name="booking_time" type="time" class="form-control">
                        @error('booking_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
    $(document).ready(function() {
        $('#booking_time').on('change', function() {
            var selectedTime = $(this).val();
            var selectedHour = parseInt(selectedTime.split(':')[0]);
            // here added logic only morning and evening slot
            if (selectedHour >= 6 && selectedHour < 12) {
                console.log("Dkdk");
                $('#booking_slot option.evening').prop('selected', false);
                $('#booking_slot option.morning').prop('selected', true);
            } else if (selectedHour >= 18 && selectedHour <= 23) {
                console.log("abcd");
                $('#booking_slot option.morning').prop('selected', false);
                $('#booking_slot option.evening').prop('selected', true);
            }
        });
    });
</script>
@endsection

