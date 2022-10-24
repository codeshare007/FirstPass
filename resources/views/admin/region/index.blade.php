@extends('layouts.app')

@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">All Regions</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">All Regions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Sales Summery -->
        <!-- ============================================================== -->
        <div class="card-group">
            <div class="card">
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
                                        <th width="50%">Title</th>
                                        <th>Code</th>
                                        <th>Price ($)/1 hour</th>
                                        <th>Actions</th>
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

    <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Edit Regions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="" id="region_form">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="">Region Name</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="">Region Code</label>
                            <input type="text" class="form-control" name="code" id="code">
                        </div>

                        <div class="form-group">
                            <label for="">Price ($)/30 Minutes</label>
                            <input type="number" class="form-control" name="price" id="price">
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
    <!-- /.modal -->
@endsection

@section('scripts')
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>

        function edit_region(id){

            $('#loading').show();

            $('#region_form')[0].reset();

            $.post('{{ route('edit-region') }}',
                {id:id},
                function (data) {
                    if(data.success == true){

                        $('#create_modal #title').val(data.region.title);
                        $('#create_modal #code').val(data.region.code);
                        $('#create_modal #price').val(data.region.price);
                        $('#create_modal #id').val(data.region.id);

                    }else{
                        swal('OOPs', data.message, 'error');
                    }
                    $('#loading').hide();

                    $('#create_modal').modal('show');
                });


        }

        $(document).ready(function() {

            $('#region_form').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('save-region')}}",
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
            })

            var table =  $('#datatable_table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
                "drawCallback": function () {
                    $('.myswitch').change(function () {

                        var id = $(this).val();
                        var obj = $(this).attr('data-obj');

                        var status = 0;

                        if(this.checked) {
                            status = 1;
                        }
                        $.post('{{ route('update-status') }}',
                            {id:id, obj:obj, status:status},
                            function (data) {
                                if(data.success == true){
                                    $('#datatable_table').DataTable().ajax.reload();
                                }else{
                                    swal('OOPs', data.message, 'error');
                                }
                            });
                    });
                },
                "ajax": "{{ route('get-regions') }}",
                "columns":[
                    { "data": "id", name:'id' },
                    { "data": "title", name:'title' },
                    { "data": 'code', name:'code' },
                    { "data": 'price', name:'price' },
                    { "data": "action", name:'Actions', searchable: false, orderable: false },
                ]
            });
            /*edit use*/

        });
    </script>
@endsection
