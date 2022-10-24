@extends('layouts.app')

@section('content')
<link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Notification</h4>
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
                        <li class="breadcrumb-item active" aria-current="page">All Notifications</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div id="accordion">

        <div class="card">
            
            {{-- <div class="card-header" id="headingOne" style="background: #4bd396;">
                <h5 class="mb-0" style="color: #ffffff;">
                    ALL CARS
                    <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                        <i class="fas fa-plus"></i>
                    </a>
                </h5>
            </div> --}}
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
                                        <th>Instructor Name</th>
                                        <th >Notify Type</th>
                                        <th >Status</th>
                                        <th >Notify Request Date</th>
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

</div>



@endsection

@section('scripts')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>

$(document).ready(function() {

    var table =  $('#datatable_table').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
        "ajax": "{{ route('get_notifications') }}",
        "columns":[
            { "data": "id", name:'id' },
            { "data": "user_name", name:'Instructor Name' },
            { "data": "notify_type", name:'notify_type' },
            { "data": "notify_status", name:'notify_status' },
            { "data": "notify_request_date", name:'notify_request_date' },
            { "data": "action", name:'Actions', searchable: false, orderable: false },
        ]
    });  

});

</script>
<script>
    $(document).on('click', '.notify_view_status', function (e) {
        let notificationId = $(this).data('id');
        let user_id = $(this).data('user_id');
        $.ajax({
            url: "{{ url('/view_notification') }}"+"/"+notificationId,
            // data: notificationId,
            contentType: false,
            processData: false,
            type: 'get',
            success: function (res) {
                if(res.success == true){
                    var search_url = "{{url('/instructor-details')}}/"+user_id+"/"+res.notify_type;
                    window.location = search_url;
                }else if(res.success == false){
                    swal('Warning!', res.message, 'error');
                }
            }
        });
    });
</script>
@endsection
