@extends('layouts.app')

@section('content')
<link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Models</h4>
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
                        <li class="breadcrumb-item">
                            <a href="{{url('cars')}}">Cars</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $make_detail->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="main_body" data-car="{{ $car }}">

    <div id="accordion">

        <div class="card">
            
                <div class="card-header" id="headingTwo" style="background:#6b5fb5;">
                    <h5 class="mb-0" style="color: #ffffff;">
                        ADD MODEL
                        <a  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="float: right;">
                            <i class="fas fa-plus"></i>
                        </a>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <form class="m-t-40" id="add_model_form" method="post" >
                                    <input type="hidden" name="id" class="form-control" >
                                    <input type="hidden" name="make_id" value="{{ $car }}" >
                                    <div class="form-group">
                                        <h5>Car Title <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" id="name" class="form-control" required >
                                        </div>
                                    </div>
                                    <div class="text-xs-right mb-3 m-t-10">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>

        <div class="card">
            
            <div class="card-header" id="headingOne" style="background: #4bd396;">
                <h5 class="mb-0" style="color: #ffffff;">
                    ALL MODELS
                    <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                        <i class="fas fa-plus"></i>
                    </a>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-right">

                                <button class="refresh-btn btn btn-xs m-b-5 btn-primary m-b-5" data-toggle="tooltip" data-title="Refresh data" onclick="$('#datatable_table').DataTable().ajax.reload();"><i class="fas fa-sync-alt"></i></button>
                            </div>

                            <div class="table-responsive">
                                <table  id="datatable_table" class="table table-striped table-bordered display">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="45%">Title</th>
                                        <th width="35%">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

</div>

<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Model</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="" id="model_edit_form">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success pull-right">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="delete_model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Delete Model</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <form action="" id="model_delete_form">
                    <p style="text-align: center;"><strong>Are you sure want to delete this model and all the years under it ?</strong></p>
                    <input type="hidden" class="form-control" name="model_id" id="model_id">
                    <div class="form-group">
                        <button class="btn btn-success pull-right">Confirm</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('scripts')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>

function edit_model(id){

    $('#loading').show();

    $('#model_edit_form')[0].reset();

    $.post('{{ route('edit-model') }}',
        {id:id},
        function (data) {
            if(data.success == true){

                $('#create_modal #title').val(data.model.title);
                $('#create_modal #id').val(data.model.id);

            }else{
                swal('OOPs', data.message, 'error');
            }
            $('#loading').hide();

            $('#create_modal').modal('show');
        });


}



function delete_model(id){

    $('#loading').show();

    $('#model_delete_form')[0].reset();
    $('#loading').hide();
    $('#delete_model #model_id').val(id);
    $('#delete_model').modal('show');
}



$(document).ready(function() {

    var car = $('#main_body').attr('data-car');

    $('#model_edit_form').submit(function (){

        $('#loading').show();

        var data = new FormData(this);
        $.ajax({
            url: "{{Route('save-model')}}",
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (res) {
                if(res.success == true){
                    swal('Success', res.message, 'success');
                    $('#create_modal').modal('hide');
                    $('#datatable_table').DataTable().ajax.reload();
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

    var table =  $('#datatable_table').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
        
        "ajax": "{{ route('get-cars') }}/"+car+"/getmodels/",
        "columns":[
            { "data": "id", name:'id' },
            { "data": "title", name:'title' },
            { "data": "action", name:'Actions', searchable: false, orderable: false },
        ]
    });
    


    $('#add_model_form').submit(function (){

        $('#loading').show();

        var data = new FormData(this);
        $.ajax({
            url: "{{Route('add-model')}}",
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (res) {
                if(res.success == true){
                    swal('Success', res.message, 'success');
                    $('#add_model_form')[0].reset();
                    $(".collapse").slideToggle();
                    $('#datatable_table').DataTable().ajax.reload();
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


    $('#model_delete_form').submit(function (){

        $('#loading').show();

        var data = new FormData(this);
        $.ajax({
            url: "{{Route('delete-model')}}",
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (res) {
                if(res.success == true){
                    swal('Success', res.message, 'success');
                    $('#delete_model').modal('hide');
                    $('#datatable_table').DataTable().ajax.reload();
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
