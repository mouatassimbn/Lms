@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row p-3">
        <div class="col-3 card h-50">
            <div class="card-body">
                <h1 class="text-center card-title">Laboratories</h1>
                <div id="labs" class="accordion p-4">
                    <div class="card border border-dark rounded-lg" id="labTypes">
                        <!-- NYA -->
                        <div class="card-header bg-dark" id="headingNya">
                            <button class="btn btn-block bg-dark text-light" type="button" data-toggle="collapse" data-target="#collapseNya" aria-expanded="true" aria-controls="collapseNya">
                                NYA
                            </button>
                        </div>
                        <!-- DATA LAB -->
                        <div id="collapseNya" class="collapse hide" aria-labelledby="headingNya" data-parent="#labs">
                            <div class="card-body">
                                <div class=" reservations bg-primary text-light p-4 mt-1">Drag me1</div>
                                <div class="reservations bg-primary text-light p-4 mt-1">Drag me2</div>
                            </div>
                        </div>
                        <!-- NYB -->
                        <div class="card-header bg-dark" id="headingNya">
                            <button class="btn btn-block bg-dark text-light" type="button" data-toggle="collapse" data-target="#collapseNyb" aria-expanded="true" aria-controls="collapseNyb">
                                NYB
                            </button>
                        </div>
                        <!-- DATA LAB -->
                        <div id="collapseNyb" class="collapse hide" aria-labelledby="headingNyb" data-parent="#labs">
                            <div class="card-body">
                                <div class="reservations bg-primary text-light p-4 mt-1">Drag me3</div>
                                <div class="reservations bg-primary text-light p-4 mt-1">Drag me4</div>
                            </div>
                        </div>
                        <!-- NYC -->
                        <div class="card-header bg-dark" id="headingNya">
                            <button class="btn btn-block bg-dark text-light" type="button" data-toggle="collapse" data-target="#collapseNyc" aria-expanded="true" aria-controls="collapseNyc">
                                NYC
                            </button>
                        </div>
                        <!-- DATA LAB -->
                        <div id="collapseNyc" class="collapse hide" aria-labelledby="headingNyc" data-parent="#labs">
                            <div class="card-body">
                                <div class="reservations bg-primary text-light p-4 mt-1">Drag me5</div>
                                <div class="reservations bg-primary text-light p-4 mt-1">Drag me6</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 p-3">
            <calendar v-bind:event="{{ json_encode($calendar_details) }}"class="p-2"></calendar>
            <div class="p-4 row">
                <div class="col-8"></div>
                <div class="col-4 row">
                    <div class="col-6">
                    <button class="btn btn-light btn-block p-2" id="canceButton" onclick="window.location.reload()" >Cancel</button>
                    </div>
                    <div class="col-6">
                    <reserve></reserve>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection