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
            <div class="row col-sm-2" style="float: right">
              <a href="{{route('booking.create')}}" class="btn btn-success">Add+</a>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Booking Date</th>
                  <th scope="col">Booking time</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookingList as $value)
                <tr>
                  <th scope="row">{{$value->id}}</th>
                  <td>{{$value->name}}</td>
                  <td>{{$value->booking_date}}</td>
                  <td>{{$value->booking_time}}</td>
                  <td>
                    <div class="row">
                      <div class="col-sm-2">
                        <a href="{{route('booking.edit',$value->id)}}"><i class="fas fa-edit"></i></a>
                      </div>
                      <div class="col-sm-2">
                        <a href="{{route('booking.show',$value->id)}}"><i class="far fa-eye"></i></a>
                      </div>
                      <div class="col-sm-2">
                        <form action="{{route('booking.destroy',$value->id)}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" onclick="return confirm('Are you sure you want to delete this booking?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
  </div>
</div>
<script>
  @if(session('success'))
      toastr.success('{{ session('success') }}');
  @endif
</script>
@endsection