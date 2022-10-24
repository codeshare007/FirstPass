@extends('layouts.app')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Faqs</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Faqs</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h5 class="mb-0" style="color: #ffffff;">
            Faqs
            <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                <i class="fas fa-plus"></i>
            </a>
        </h5>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')

@endsection
