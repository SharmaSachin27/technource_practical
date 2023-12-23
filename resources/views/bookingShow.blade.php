@extends('layouts.master')
@section('content')

<div class="row mt-5 justify-content-center">
  <div class="col-md-8">
      <div class="card">
          <div class="card-body">
                <div class="mb-2">
                    <label for="" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" readonly value="{{$bookingItem->name}}">
                    
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" readonly value="{{$bookingItem->email}}">
                    
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Type</label>
                    <select name="booking_type" disabled class="form-control">
                        
                        <option value="">SELECT Booking Type</option>    
                        <option value="Full Day" @if($bookingItem->booking_type == "Full Day")  selected @endif>Full Day</option>
                        <option value="Half Day" @if($bookingItem->booking_type == "Half Day")  selected @endif>Half Day</option>
                        
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Date</label>
                    <input type="date" id="booking_date" readonly value="{{$bookingItem->booking_date}}" name="booking_date" class="form-control">
                    
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Slot</label>
                    <select name="booking_slot" disabled class="form-control">
                        <option value="">SELECT Booking Slot</option>
                        <option value="Morning" @if($bookingItem->booking_slot == "Morning") selected @endif>Morning</option>
                        <option value="Evening" @if($bookingItem->booking_slot == "Evening") selected @endif>Evening</option>
                    </select>
                    
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Booking Time</label>
                    <input type="time" readonly id="booking_time" value="{{$bookingItem->booking_time}}" name="booking_time" class="form-control">
                   
                </div>
               
          </div>
      </div>
  </div>
</div>
@endsection