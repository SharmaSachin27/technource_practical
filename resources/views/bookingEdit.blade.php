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
            <form action="{{route('booking.update',$bookingItem->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" value="{{$bookingItem->name}}">
                    @error('name')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" value="{{$bookingItem->email}}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Type</label>
                    <select name="booking_type" class="form-control">
                        
                        <option value="">SELECT Booking Type</option>    
                        <option value="Full Day" @if($bookingItem->booking_type == "Full Day")  selected @endif>Full Day</option>
                        <option value="Half Day" @if($bookingItem->booking_type == "Half Day")  selected @endif>Half Day</option>
                        @error('booking_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Date</label>
                    <input type="date" id="booking_date" value="{{$bookingItem->booking_date}}" name="booking_date" class="form-control">
                    @error('booking_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Slot</label>
                    <select name="booking_slot" class="form-control">
                        <option value="">SELECT Booking Slot</option>
                        <option value="Morning" class="morning"  @if($bookingItem->booking_slot == "Morning") selected="" @endif>Morning</option>
                        <option value="Evening"class="evening"  @if($bookingItem->booking_slot == "Evening") selected="" @endif>Evening</option>
                    </select>
                    @error('booking_slot')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Time</label>
                    <input type="time" id="booking_time" value="{{$bookingItem->booking_time}}" name="booking_time" class="form-control">
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
     $(document).ready(function() {
        $(".alert").alert('close');
        $('#booking_time').on('change', function() {
            var selectedTime = $(this).val();
            var selectedHour = parseInt(selectedTime.split(':')[0]);

            // Reset all options and remove 'selected' attribute
            $('#booking_slot option').prop('selected', false).hide();

            // Show/hide and select options based on the selected time
            if (selectedHour >= 6 && selectedHour < 12) {
                $('#booking_slot option.morning').show().prop('selected', true);
            } else if (selectedHour >= 18 && selectedHour <= 23) {
                $('#booking_slot option.evening').show().prop('selected', true);
            }
        });
     })
</script>
@endsection