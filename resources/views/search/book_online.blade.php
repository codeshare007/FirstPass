@extends('layouts.app_guest')
@section('content')

    <style>
        .page_slider{position: relative}
        #search_modal .btn{
            font-size: 15px;
            padding: 10px;
            margin-right: 5px;
        }
        #search_modal .close{ top: 0px; right: 15px }
        #learner-price-table {
            -webkit-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border-radius: 10px;
            border: 2px solid #212A37;
            background: white;
            margin: 20px 0;
            padding: 0 3px;
        }
        .container-cr{
            max-width: 62.5rem;
            margin-right: auto;
            margin-left: auto;
            padding: 25px 5px;
        }


        .more_inst{
            background: orange;
        }
        .container-cr .teaser{
            /*border: 1px solid #ddd;
            border-radius: 5px;*/
        }
        .container-cr .teaser:hover{
            background-color: white !important;
        }
        .rounded-img{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            border-radius: 50%;
            overflow: hidden;

        }
        .teaser-box-section .title{
            color: orange !important;
        }
        .h190{
            height: 190px;
        }
        .container-cr .item a{
            webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            transition: all 0.2s ease;
            outline: 0;
        }
        .container-cr .item a:hover{
            -webkit-transform: translate(0, 1px);
            -moz-transform: translate(0, 1px);
            -ms-transform: translate(0, 1px);
            transform: translate(0, 1px);
        }
        .progres-bar-signup .progres .meter {
            position: relative;
            background: url({{ asset('assets/front/images/image-road-divider.png') }}) left center repeat-x;
        }
        .progres.radius .meter {
            border-radius: 4px;
        }
        .progres .meter {
            background: #ffc20e;
            display: block;
            height: 100%;
        }
        .bg-oil{background-color: #212A37 !important;}
        .progres-bar-signup {
            margin-top: -10px;
            text-align: center;
        }
        .va-b {
            vertical-align: middle !important;
        }
        .media-left, .media-right, .media-body {
            display: table-cell;
            vertical-align: top;
        }
        .media-left, .media>.pull-left {
            padding-right: 10px;
        }
        @media only screen and (min-width: 40.0625em) {
            .medium-padding-right-20 {
                padding-right: 20px !important;
            }
            .medium-margin-bottom-10 {
                margin-bottom: 10px !important;
            }
            h6 {
                font-size: 1rem;
            }

        }
        .media:first-child {
            margin-top: 0;
        }
        .media, .media-body {
            zoom: 1;
        }
        .media {
            margin-top: 15px;
            display: block!important;
        }
        .media-left, .media-right, .media-body {
            display: table-cell;
            vertical-align: top;
        }
        .media-body {
            width: 10000px;
        }
        .progres-bar-signup h6 {
            line-height: 1;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #212A37;
        }
        .text-oil {
            color: #212A37 !important;
        }
        .progres-bar-signup h6 small {
            display: block;
            padding: 5px 5px 10px;
            color: #212A37;
            font-size: 75%;
            line-height: 0;
        }
        .progres-bar-signup .progres {
            overflow: hidden;
        }
        .progres.radius {
            border-radius: 5px;
        }
        .small-height-50px {
            height: 50px;
        }
        .progres {
            background-color: rgba(255,255,255,0.5);
            border: 0 solid white;
            height: 0.625rem;
            margin-bottom: 0.625rem;
            padding: 0;
        }
        .progres-bar-signup .progres .meter .vehicle {
            position: absolute;
            left: 100%;
            min-width: 300px;
            margin-top: 5px;
            margin-left: -25px;
            text-align: left;
            line-height: 1;
            font-weight: bold;
            color: #212A37;
        }
        .media-middle {
            vertical-align: middle;
        }
        .media img {
            max-width: none;
        }
        .btn.oil {
            border-color: #212A37;
            margin-top: 20px;
        }

        .img-circle{
            border-radius: 50%;
            overflow: hidden;
        }
        .img-featured{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }

        .small-fontsize-14 {
            font-size: 0.875rem !important;
        }
        .small-padding-top-2 {
            padding-top: 2px !important;
        }

        .c-gutter-8{
            justify-content: center;
        }

    </style>

    <section class="" style="height: 130px">
    <div class="container"></div>
    </section>

    <section class="more_inst">
        <div class="container-cr">
            <div class="row">
                <div class="col-md-12">

                    <br><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="media medium-margin-bottom-10">
                                    <div class="media-left va-b medium-padding-right-20">
                                        <div><a class="btn btn-default tiny oil small-fontsize-14" href="javascript:history.back()"><i class="fa fa-angle-left fa-left"></i>Back</a></div>
                                    </div>
                                    <div class="media-body">
                                        <div class="progres-bar-signup">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h6 class="text-oil">
                                                        <small>Step 1</small>
                                                        Choose
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 2</small>
                                                        Book
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 3</small>
                                                        <span>
                                                            <span class="hide-for-small-only">Your</span>
                                                            Details
                                                            </span>
                                                    </h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6 class="small-opacity-40">
                                                        <small>Step 4</small>
                                                        Payment
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="progres col-md-12 radius small-height-50px">
                                                <span class="meter bg-oil" style="width: 13.5%">
                                                <div class="vehicle">
                                                    <div class="media media-middle">
                                                        <div class="media-left">
                                                             @if( $instructor->avatar == '')
                                                                <img class="img-circle img-featured" src="{{ url('assets/images/users/default.png') }}" alt="user" style="height: 40px; width: 40px">
                                                            @else
                                                                <img class="img-circle img-featured" src="{{ url('assets/images/users/'.$instructor->avatar) }}" alt="user" style="height: 40px; width: 40px">
                                                            @endif

                                                        </div>
                                                        <div class="media-body small-padding-top-2 small-fontsize-14">
                                                    Book with

                                                    <span>{{ ucfirst( $instructor->name ) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="ls container-cr">
        <div class="row c-gutter-8">
            <div class="col-sm-8">
                <div class="py-45 box-shadow mb-20 teaser" style="padding-left: 10px; padding-right: 10px">
                    <h4 class="text-center title">ADD PACKAGES TO YOUR CART</h4>
                   <div class="col-md-12">
                       <div class="row">
                           <form id="book_form" class="w-100">

                               <?php
                                $services_acc = json_decode($instructor->user_meta->services_accreditation);
                                //print_r($services_acc);
                               ?>

                               <input type="hidden" value="{{ $search_id }}" name="search_id">
                               <input type="hidden" value="{{ $instructor->id }}" name="instructor_id">
                               <button @if(isset($services_acc[0])) data-toggle="tooltip" data-title="{{ ucwords($instructor->name) }} only provides driving test packages to customers who take at least one driving lesson prior. To select a driving test package please also select at least 1 driving lesson." @endif type="button" onclick="$(this).find('input').click()" class="btn btn-rounded py-10 btn-block btn-dark text-uppercase">

                                    <?php
                                    if( in_array('1', $services_acc) && in_array('2', $services_acc) ){ ?>
                                        <input  name="lesson[]" type="checkbox" value="lesson"> DRIVING LESSON/S (1 & 2 HR)
                                    <?php }
                                    elseif( in_array('1', $services_acc) ){ ?>
                                        <input checked disabled  name="lesson[]" type="checkbox" value="lesson"> DRIVING LESSON/S (1 & 2 HR)
                                        <input type="hidden" name="lesson[]" value="lesson">
                                    <?php }
                                    else{ ?>
                                        <input  name="lesson[]" type="checkbox" value="lesson"> DRIVING LESSON/S (1 & 2 HR)
                                    <?php } ?>

                                   <?php /*
                                   <input @if(isset($services_acc[1]) || isset($services_acc[0])) checked disabled @endif <?php if()  name="lesson[]" type="checkbox" value="lesson"> DRIVING LESSON/S (1 & 2 HR)

                                    @if(isset($services_acc[1]) || isset($services_acc[0]))
                                       <input type="hidden" name="lesson[]" value="lesson">
                                    @endif */ ?>

                               </button>
                                <button type="button" onclick="$(this).find('input').click()" class="btn btn-rounded py-10 btn-block btn-dark text-uppercase">
                                   <input type="checkbox" value="test" name="lesson[]"> DRIVING TEST PACKAGE
                                </button>


                               <div class="main_continue">
                                    <div class="w-100 d-block mt-4">
                                        <button type="submit" class="btn btn-warning btn-rounded py-15 btn-block text-uppercase">Continue <span class="fa fa-spinner fa-spin hidden"></span> </button>
                                    </div>
                               </div>

                           </form>
                       </div>
                   </div>
            </div>

        </div>
            <!-- <div class="col-sm-5">
                <div class="p-3 box-shadow mb-20 teaser">
                    <div class="col-md-12">
                        <div class="row">

                            <div>
                                <div class="media media-middle">
                                    <div class="media-left small-padding-right-10">
                                        <svg class="oil small-margin-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" stroke-width="2"><g stroke-width="2" transform="translate(0, 0)"><line data-cap="butt" fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" x1="23.192" y1="23.192" x2="31" y2="31" stroke-linejoin="miter" stroke-linecap="butt"></line> <circle fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="14" cy="14" r="13" stroke-linejoin="miter"></circle> <path data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M20,20 v-0.983c0-0.71-0.372-1.363-0.983-1.725C18.044,16.717,16.358,16,14,16c-2.388,0-4.064,0.713-5.026,1.288 C8.368,17.65,8,18.301,8,19.007V20H20z" stroke-linejoin="miter"></path> <circle data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="14" cy="10" r="3" stroke-linejoin="miter"></circle></g></svg>
                                    </div>
                                <div class="media-body">
                                    <h6 class="small-margin-0">Instructor choice</h6>
                                    <p class="small-fontsize-13 small-margin-0">Choose your instructor, change online anytime.</p>
                                </div>
                            </div>
                            <div class="media media-middle">
                                <div class="media-left small-padding-right-10">
                                    <svg class="oil small-margin-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" stroke-width="2"><g stroke-width="2" transform="translate(0, 0)"><polyline data-color="color-2" points="19 27 22 30 29 23" fill="none" stroke="#444444" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="miter"></polyline> <line x1="9" y1="1" x2="9" y2="5" fill="none" stroke="#444444" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="miter"></line> <line x1="23" y1="1" x2="23" y2="5" fill="none" stroke="#444444" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="miter"></line> <line data-cap="butt" x1="31" y1="11" x2="1" y2="11" fill="none" stroke="#444444" stroke-miterlimit="10" stroke-width="2" stroke-linecap="butt" stroke-linejoin="miter"></line> <polyline points="13 29 1 29 1 5 31 5 31 17" fill="none" stroke="#444444" stroke-linecap="square" stroke-miterlimit="10" stroke-width="2" stroke-linejoin="miter"></polyline></g></svg>
                                </div>
                                <div class="media-body">
                                    <h6 class="small-margin-0">Book now or later</h6>
                                    <p class="small-fontsize-13 small-margin-0">Buy a package, make bookings now or later.</p>
                                </div>
                            </div>
                            <div class="media media-middle">
                                <div class="media-left small-padding-right-10">
                                    <svg class="oil small-margin-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" stroke-width="2"><g stroke-width="2" transform="translate(0, 0)"><path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M14,20 c-5.57,0-9.247,1.165-11.227,2.043C1.69,22.524,1,23.598,1,24.783V30h13" stroke-linejoin="miter"></path> <path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M7,8c0-3.866,3.134-7,7-7 s7,3.134,7,7s-3.134,8-7,8S7,11.866,7,8z" stroke-linejoin="miter"></path> <circle data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="24" cy="24" r="7" stroke-linejoin="miter"></circle> <polyline data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" points=" 24,21 24,24 27,24 " stroke-linejoin="miter"></polyline></g></svg>
                                </div>
                                <div class="media-body">
                                    <h6 class="small-margin-0">Real-time availability</h6>
                                    <p class="small-fontsize-13 small-margin-0">Book directly into your instructor’s calendar.</p>
                                </div>
                            </div>
                            <div class="media media-middle">
                                <div class="media-left small-padding-right-10">
                                    <svg class="oil small-margin-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="32px" height="32px" viewBox="0 0 32 32" stroke-width="2"><g stroke-width="2" transform="translate(0, 0)"><polyline data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" points=" 9,1 5,1 5,5 " stroke-linejoin="miter"></polyline> <polyline data-color="color-2" fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" points=" 22,5 22,1 18,1 " stroke-linejoin="miter"></polyline> <path fill="none" stroke="#444444" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M27,31l2.036-9.5 c0.509-2.377-1.202-4.655-3.626-4.828L16,16V7.5C16,6.119,14.881,5,13.5,5h0C12.119,5,11,6.119,11,7.5V24l-4.396-3.664 c-0.908-0.757-2.244-0.696-3.08,0.14l0,0c-0.856,0.856-0.896,2.23-0.092,3.135L10,31H27z" stroke-linejoin="miter"></path></g></svg>
                                </div>
                                <div class="media-body">
                                    <h6 class="small-margin-0">Booking flexibility</h6>
                                    <p class="small-fontsize-13 small-margin-0">Reschedule online FREE up to 5 hrs before a booking.</p>
                                </div>
                            </div>
                            <hr class="small-margin-bottom-0">

                                <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fa fa-info-circle fa-lg small-margin-right-5"></i>
                                    <u>More info about bookings</u>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <ol class="bg-info">
                                        <li>At the completion of the booking process you can leave notes for your instructor about your preferences (optional).</li>
                                        <li>
                                            Your online account is created during the booking process:
                                            <ul class="small-fontsize-14">
                                                <li>Review / edit your bookings &amp; profile details</li>
                                                <li>Book / purchase additional lessons or a test package</li>
                                                <li>Reschedule or cancel bookings at no cost (&gt;5 hrs before start time)</li>
                                                <li>Change your instructor or pick up address</li>
                                            </ul>
                                        </li>
                                        <li>Your instructor's contact details are displayed in your online account, the instructor also receives your contact details.</li>
                                        <li>Your chosen instructor will meet you with their dual controlled vehicle at the location/date/time selected - no need to confirm.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>

    </section>

    <section id="video" class="ls">
        <div class="container">
            <div class="clearfix"></div>
        </div>

    </section>

    <div class="button_fix_area">
        <div class="continue_submit_btn w-100 d-block mt-4">
            <button type="submit" class="btn btn-warning btn-rounded py-15 btn-block text-uppercase">Continue <span class="fa fa-spinner fa-spin hidden"></span> </button>
        </div>
    </div>


@endsection

@section('script')


    <script>

        function show_inf(id){
            $('.intl_conv, .your_car, .logbook, .driving_test').hide();
            $('.'+id).show();
            $('#info_modal').modal('show');
        }

        $(document).ready(function (){

            //=== sticky continue click
            $(".button_fix_area .btn").click(function(){
                $('#book_form').submit();
            });
            //===========

            $('#book_form').submit(function (){

                if( $('#book_form').find('input[type=checkbox]:checked').length ==0 ){
                    swal('Alert!', 'Please select one of the options', 'warning');
                    return false;
                }

                $('.fa-spinner').removeClass('hidden');

                var data = new FormData(this);

                data.append("search_type", '2');

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){

                            let url = "{{ url("/book-online/cart/$search_id/instructor/$instructor->id") }}";
                            window.location.href=url;

                        }else if(res.success == false){
                            swal('oops!', res.message, 'warning');

                        }
                        $('.fa-spinner').addClass('hidden');
                    },
                    error: function () {
                        $('.fa-spinner').addClass('hidden');
                        swal('oops!', 'something went wrong', 'warning');
                    }
                });

                return false;
            });

        })


    </script>
@endsection
