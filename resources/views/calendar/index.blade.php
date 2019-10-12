@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row p-3">
        <div class="col-3">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Welcome!</strong> You can drag and drop the Labs you want to reserve.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card h-100" style="background-color:#FDFFFC;">
                <div class="card-body">
                    <h1 class="text-center card-title">Laboratories</h1>
                    <div id="labs" class="accordion p-4">
                        <div class="rounded-lg" id="labTypes">
                            <!-- NYA -->
                            <div class="m-2" id="headingNya">
                                <button class="btn btn-block labType text-dark p-3" type="button" data-toggle="collapse" data-target="#collapseNya" aria-expanded="true" aria-controls="collapseNya">
                                    NYA
                                </button>
                            </div>
                            <!-- DATA LAB -->
                            <div id="collapseNya" class="collapse hide" aria-labelledby="headingNya" data-parent="#labs">
                                <div class="card-body">
                                    <div class="reservations text-light p-2 mt-1">NYA - Lab 1</div>
                                    <div class="reservations text-light p-2 mt-1">NYA - Lab 2</div>
                                </div>
                            </div>
                            <!-- NYB -->
                            <div class="m-2" id="headingNya">
                                <button class="btn btn-block labType text-dark p-3" type="button" data-toggle="collapse" data-target="#collapseNyb" aria-expanded="true" aria-controls="collapseNyb">
                                    NYB
                                </button>
                            </div>
                            <!-- DATA LAB -->
                            <div id="collapseNyb" class="collapse hide" aria-labelledby="headingNyb" data-parent="#labs">
                                <div class="card-body">
                                    <div class="reservations text-light p-2 mt-1">NYB - Lab 1</div>
                                    <div class="reservations text-light p-2 mt-1">NYB - Lab 2</div>
                                </div>
                            </div>
                            <!-- NYC -->
                            <div class="m-2" id="headingNya">
                                <button class="btn btn-block labType text-dark p-3" type="button" data-toggle="collapse" data-target="#collapseNyc" aria-expanded="true" aria-controls="collapseNyc">
                                    NYC
                                </button>
                            </div>
                            <!-- DATA LAB -->
                            <div id="collapseNyc" class="collapse hide" aria-labelledby="headingNyc" data-parent="#labs">
                                <div class="card-body">
                                    <div class="reservations text-light p-2 mt-1">NYC - Lab 1</div>
                                    <div class="reservations text-light p-2 mt-1">NYC - Lab 2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 p-2 rounded-lg" style="background-color:white;">
            <calendar class="p-2"></calendar>
        </div>
    </div>
    <div class="fixed-bottom" id="calendarViewFooter">
        <div class="p-4 row">
            <div class="col-8"></div>
            <div class="col-4 row">
                <div class="col-6">
                    <button class="btn btn-light btn-block p-2" id="canceButton" onclick="window.location.reload()">Cancel</button>
                </div>
                <div class="col-6">
                    <reserve></reserve>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection