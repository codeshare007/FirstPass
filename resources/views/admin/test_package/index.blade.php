@extends('layouts.app')

@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Test Package</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Test Package</li>
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
                        <form id="test_package_form">
                        <div class="col-6">
                            @csrf
                            <input type="hidden" name="id" value="{{ @$test->id }}">
                            <div class="form-group">
                                <label for="">Package Name</label>
                                <input class="form-control" type="text" name="title" value="{{ @$test->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Price ($)</label>
                                <input class="form-control" type="number" name="price" value="{{ @$test->price }}" required>
                            </div>

                        </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Detail</label>
                                    <textarea id="detail">{!! @$test->detail !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success pull-right">Save</button>
                                </div>

                            </div>

                        </form>
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

            tinymce.init({
                relative_urls: false,
                remove_script_host: false,
                selector: "textarea#detail",
                browser_spellcheck: true,
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link lists charmap print hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
                    "save table contextmenu directionality emoticons paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | print fullpage | forecolor backcolor emoticons ",
            });

            $('#test_package_form').submit(function (){
                $('#loading').show();

                var data = new FormData(this);

                data.append("detail", tinymce.editors['detail'].getContent());

                $.ajax({
                    url: "{{Route('save-test-package')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success');
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
