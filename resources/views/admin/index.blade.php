@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="justify-content-center">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucess!</strong> {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">Reserved Labs</div>

                <div class="card-body">
                    <div class="card-columns">
                        @foreach($reservations as $reservation)
                        <div class="card">
                            <div class="p-1 m-1 row">
                                <div class="col-10">
                                    <h6 class="lead">{{ $reservation->reservation_name }} </h6>
                                    <p> {{ $reservation->start }} </p>
                                    <p > For : {{ $reservation->user->name }} </p>
                                    <p>Status :
                                        @if($reservation->canceld == 0)
                                        <span class="border border-success m-1 p-1 text-success rounded-lg">Active</span>
                                        @else
                                        <span class="border border-danger m-1 p-1 text-danger rounded-lg">Canceled</span>
                                        @endif
                                    </p>
                                </div>
                                <form action="/calendar/ {{ $reservation->id }}" method="POST" class="col-2 pt-2">
                                    {{ csrf_field() }}
                                    @if($reservation->canceld == 0)
                                    {{ method_field('PATCH') }}
                                    <div class="field ">
                                        <div class="control">
                                            <button type="submit" class="btn btn-danger">X</button>
                                        </div>
                                    </div>
                                    @else
                                    {{ method_field('DELETE') }}
                                    <div class="field">
                                        <div class="control">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                    @endif
                                    <input type="hidden" name="reservation" value="{{ $reservation->id }}">
                                </form>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                    <p>Want to see the calendar?</p>
                    <a href="/calendar" class="btn btn-primary btn-block">Calendar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection