@extends('layouts.app')

@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Twilio Messages</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Twilio Messages</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="sent_message_form">
                                @csrf
                                <div class="form-group">
                                    <label for="">Number</label>
                                    <input class="form-control" type="text" name="number[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Message Body</label>
                                    <textarea name="body" cols="163" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right">Sent</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script>

        $(document).ready(function() {

            $('#sent_message_form').submit(function (){
                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('twilio.store')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success')
                            .then(function (e){
                                window.location.href = '';
                            });
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }
                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }
                });

                return false;
            });

        });
    </script>
@endsection
