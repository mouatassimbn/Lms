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
                        <div class="card p-2">
                            <form action="/calendar/ {{ $reservation->id }}" method="POST">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}
                                <input type="hidden" name="reservation" value="{{ $reservation->id }}">

                                <div class="p-2 m-1 row">
                                    <div class=" col-10">
                                        <h6 class="lead"> {{ $reservation->reservation_name }} </h6>
                                        <p> {{ $reservation->start }} </p>
                                    </div>
                                    <div class="field col-2">
                                        <div class="control">
                                            <button type="submit" class="btn btn-danger">X</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
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
                    <p>Want to reserve labs ?</p>
                    <a href="/calendar" class="btn btn-primary btn-block">Reserve</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection