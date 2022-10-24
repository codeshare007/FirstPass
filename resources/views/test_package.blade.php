@extends('layouts.app_guest')
@section('content')
    <link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

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

        .search_form{
            background-color: #eeeeee;
            margin-bottom: 30px;
        }
        ul.tabs {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-bottom: 1rem !important;
        }
        ul.list-unstyled, ol.list-unstyled {
            list-style: none;
            margin: 0;
        }
        .tabs {
            margin-bottom: 0 !important;
            margin-left: 0;
        }
        .small-width-50 {
            width: 50% !important;
            margin: 5px;
        }
        .button.yellow, header#header div:not(.fixed) nav.top-bar section.top-bar-section ul.nav.right a.button.yellow {
            background-color: #ffc20e;
            border-color: #ffc20e;
        }
        .button.expand {
            padding-left: 0.3125rem !important;
            padding-right: 0.3125rem !important;
        }
        .medium-padding-5 {
            padding: 5px !important;
        }
        a, button, .button, input, select, .select2-selection {
            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            transition: all 0.2s ease;
            outline: 0;
        }
        .button {
            background-color: #000000;
            border: 1px solid #000000;
            color: #FFFFFF;
            vertical-align: middle;
            border-radius: 5px !important;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            -webkit-box-shadow: inset 0 -4px 4px -4px var(--box-shadow-color);
            -moz-box-shadow: inset 0 -4px 4px -4px var(--box-shadow-color);
            -ms-box-shadow: inset 0 -4px 4px -4px var(--box-shadow-color);
            box-shadow: inset 0 -4px 4px -4px var(--box-shadow-color);
            --box-shadow-color: rgba(0,0,0,0.6);
            padding: 10px 10px;
        }
        #test_package_ga_click, #test_package_with_lesson_ga_click{ opacity: 0.5 }
        #test_package_ga_click.active, #test_package_with_lesson_ga_click.active{ opacity: 1; }

        .block:hover {
            -webkit-transform: translate(0, 1px);
            -moz-transform: translate(0, 1px);
            -ms-transform: translate(0, 1px);
            transform: translate(0, 1px);
        }
        .button:hover {
            --box-shadow-color: transparent;
            -webkit-transform: translate(0, 2px);
            -moz-transform: translate(0, 2px);
            -ms-transform: translate(0, 2px);
            transform: translate(0, 2px);
        }
        .text-oil {
            color: #212A37 !important;
        }
        .transform-none {
            text-transform: none !important;
        }
        svg.size-50 {
            width: 50px !important;
            height: 50px !important;
        }
        .va-m {
            vertical-align: middle !important;
        }
        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
        }
        .select2-selection__arrow {
            height: 39px !important;
        }
        #test_location{
            background-color:white;
            border:1px solid black;
            margin-top: 10px;
        }
        .c-gutter-0 li{list-style: none}
    </style>

    <section class="page_slider">
        <div class="flexslider">
            <ul class="slides">
                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide01.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Test Package
                                            </h1><br>
                                            <h1 class="after-title">
                                                Driving Test &<span> Driving Lesson Packages</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>Ready for your driving test?</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>
            </ul>
        </div> <!-- eof flexslider -->
    </section>


    <section class="ls s-py-xl-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h3><span class="color-main">Test</span> Package</h3>
                        <p class="subtitle width-xl-60 width-100">The school offers the following services for Teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    </div>

                    <div class="row c-gutter-0">
                        <div class="divider-30"></div>
                        <div class="col-lg-4 col-md-4"></div>
                        <div class="col-lg-4 col-md-4">
                            <div class="pricing-plan plan-featured box-shadow">

                                <div class="price-wrap">
                                        <span class="plan-price">${{ $TestPackageDetail->price }}</span><span class="plan-sign">ONLY</span>
                                </div>
                                <div class="plan-description color-darkgrey">
                                    Driving test package includes:
                                </div>
                                <div class="plan-features">
                                    {!! $TestPackageDetail->detail !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="small-fontsize-26 text-center small-margin-20">Select from the two options below</h4>
                    <ul class="tabs list-unstyled" data-equalizer="" data-tab="">
                        <li class="small-width-50 active">
                            <label for="both" class="block small-padding-2 medium-padding-5" id="button-test_package_with_lesson"  style="height: 149px; width: 100%">
                                <div class="active button yellow expand transform-none text-oil text-center" style='height: 150px;padding-top: 27px;' id="test_package_with_lesson_ga_click">
                                    <input type="radio" name="test_type" style='display:none' onclick="radio_function(1)" checked value="1" id="both" class="hide">
                                    <p>
                                        <svg class="va-m fill-oil size-50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64"><g transform="translate(0, 0)"><path data-color="color-2" fill="#444444" d="M32,1c-3.314,0-6,2.686-6,6v13c0,0.552,0.448,1,1,1h10c0.552,0,1-0.448,1-1V7 C38,3.686,35.314,1,32,1z M32,9c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S33.105,9,32,9z"></path> <path fill="#444444" d="M61,15H40v6c0,1.105-0.895,2-2,2H26c-1.105,0-2-0.895-2-2v-6H3c-1.105,0-2,0.895-2,2v44c0,1.105,0.895,2,2,2 h58c1.105,0,2-0.895,2-2V17C63,15.895,62.105,15,61,15z M21,30c2.757,0,5,2.243,5,5c0,2.757-2.243,5-5,5c-2.757,0-5-2.243-5-5 C16,32.243,18.243,30,21,30z M31,53H11c-0.552,0-1-0.448-1-1c0-4.962,4.038-9,9-9h4c4.962,0,9,4.038,9,9C32,52.552,31.552,53,31,53z M53,48H39c-0.552,0-1-0.448-1-1s0.448-1,1-1h14c0.552,0,1,0.448,1,1S53.552,48,53,48z M53,38H39c-0.552,0-1-0.448-1-1s0.448-1,1-1 h14c0.552,0,1,0.448,1,1S53.552,38,53,38z"></path></g></svg>
                                        <span class="inline-block va-m small-margin-top-5 small-margin-left-10">+</span>
                                        <svg class="va-m fill-oil size-50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64"><g transform="translate(0, 0)"><path d="M22,11a10,10,0,0,1,20,0c0,7-4.477,12-10,12S22,18,22,11Z" fill="#444444"></path> <path d="M51,53V35.063a6.976,6.976,0,0,0-1.586-4.41L13.659,53Z" fill="#444444"></path> <path d="M43.132,27.5A44.091,44.091,0,0,0,32,26a45.54,45.54,0,0,0-14.239,2.43A6.992,6.992,0,0,0,13,35.063V46.337Z" fill="#444444"></path> <path d="M13,59v3a1,1,0,0,0,1,1H50a1,1,0,0,0,1-1V59Z" fill="#444444"></path> <path d="M58,57H9.931a2.931,2.931,0,0,1-1.555-5.415L55.47,22.152a1,1,0,1,1,1.061,1.7L9.438,53.28A.931.931,0,0,0,9.931,55H58a1,1,0,0,1,0,2Z" fill="#444444" data-color="color-2"></path></g></svg>
                                    </p>
                                    Driving test package with driving lessons
                                </div>
                            </label></li>
                        <li class="small-width-50">
                            <label for="test" class="block small-padding-2 medium-padding-5" id="button-test_package" style="height: 149px; width: 100%">
                                <div class="button oil expand transform-none text-center" id="test_package_ga_click" style='height: 150px;padding-top: 27px;'>
                                    <input type="radio" name="test_type" style='display:none' onclick="radio_function(2)" value="2" id="test" class="hide">
                                    <p>
                                        <svg class="va-m fill-white size-50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64"><g transform="translate(0, 0)"><path data-color="color-2" fill="#444444" d="M32,1c-3.314,0-6,2.686-6,6v13c0,0.552,0.448,1,1,1h10c0.552,0,1-0.448,1-1V7 C38,3.686,35.314,1,32,1z M32,9c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S33.105,9,32,9z"></path> <path fill="#444444" d="M61,15H40v6c0,1.105-0.895,2-2,2H26c-1.105,0-2-0.895-2-2v-6H3c-1.105,0-2,0.895-2,2v44c0,1.105,0.895,2,2,2 h58c1.105,0,2-0.895,2-2V17C63,15.895,62.105,15,61,15z M21,30c2.757,0,5,2.243,5,5c0,2.757-2.243,5-5,5c-2.757,0-5-2.243-5-5 C16,32.243,18.243,30,21,30z M31,53H11c-0.552,0-1-0.448-1-1c0-4.962,4.038-9,9-9h4c4.962,0,9,4.038,9,9C32,52.552,31.552,53,31,53z M53,48H39c-0.552,0-1-0.448-1-1s0.448-1,1-1h14c0.552,0,1,0.448,1,1S53.552,48,53,48z M53,38H39c-0.552,0-1-0.448-1-1s0.448-1,1-1 h14c0.552,0,1,0.448,1,1S53.552,38,53,38z"></path></g></svg>
                                    </p>
                                    Stand alone driving test package
                                </div>
                            </label></li>
                    </ul>
                    <div class="" id="search_test_package">
                        <div class="container">
                            <div class="text-center">
                                <p class="with_lesson">Please select your pickup suburb &amp; transmission type. You can then review our instructors in your area &amp; book online.</p>
                                <p class="no_lesson" style="display: none">1. Please enter your pickup suburb &amp; transmission type into the search tool below.</p>
                            </div>

                            <div class="medium-padding-5 search_form">

                                <form action="" id="searchForm">
                                    <input type="hidden" name="search_type" value="1">

                                        <div class="col-sm-12">
                                            <div class="divider-sm-0 divider-md-30"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group type text-center">
                                                        <button onclick="$(this).find('input').prop('checked', true); $('i.ato').removeClass('hidden'); $('i.mnl').addClass('hidden');" type="button" id="contact_form_submit active" class="btn btn-outline-darkgrey">
                                                            <input type="radio" name="type" value="auto" checked class="hidden">
                                                            <i class="fa fa-check text-success ato"></i> AUTO
                                                        </button>

                                                        <button onclick="$(this).find('input').prop('checked', true); $('i.mnl').removeClass('hidden'); $('i.ato').addClass('hidden');" type="button" id="contact_form_submit" class="btn btn-outline-darkgrey">
                                                            <input type="radio" name="type" value="manual" class="hidden" checked>
                                                            <i class="fa fa-check text-success hidden mnl"></i>
                                                            MANUAL
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select name="region" id="region-test" onchange="get_test_location(this)" required class="select2">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group text-center">
                                                        <button class="btn btn-block btn-success" style="display:none">Search <i class="fa fa-spinner fa-spin hidden"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style='text-align: center;'>
                                                    <p class='test-text' style='margin-top:20px;display:none'>2. Please select your test centre below, if you haven't booked your test please select 'Any test location'</p>

                                                    <div class="append_new col-md-4" style='display: none; text-align: center;margin-left: 30%;'>

                                                    </div>
                                                </div>

                                            </div>

                                            @if(Session::has('success'))
                                                <p class="text-center mt-2 text-success">{{ Session::get('success') }}</p>
                                            @endif
                                            @if(Session::has('error'))
                                                <p class="text-center mt-2 text-danger">{{ Session::get('error') }}</p>
                                            @endif
                                        </div>

                                    <div class="divider-sm-0 divider-md-30">
                                        <p class="test-test" style='display:none;font-size:11px'>Please note that only a limited number of our instructors offer stand alone driving test packages. If you are able to complete at least one ordinary driving lesson first you will gain access to greater availability.</p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls">
        <div class="container">
            <div class="row">
                <div class="divider-20 d-md-block d-lg-none"></div>
                <div class="col-sm-12 text-center">
                    <h3>Book a driving <span class="color-main">Test Package </span> now!</h3>

                </div>
            </div>
            <div class="divider-50 divider-xl-52"></div>
            <div class="row c-gutter-30">
                <div class="col-sm-6 col-md-6">
                    <div class="icon-box">
                        <div class="media">
                            <div class="icon-styled color-main fs-40">
                                <i class="ico icon-team"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="fw-300">
                                    Book a driving test package now!
                                </h6>
                                <p>
                                    Get a pre-test warm up lesson before your driving test and use your driving instructor's vehicle on the day.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <img class="img-fluid pull-right" src="{{ asset('assets/front/images/car_img.png') }}" width="70%" alt="">
                </div>
            </div>
            <hr>
        </div>
    </section>


    <section class="ls">
        <div class="container">
            <div class="divider-50 divider-xl-52"></div>
            <div class="row c-gutter-30">
                <div class="col-sm-4 col-md-4">
                    <img class="img-fluid pull-right" src="{{ asset('assets/front/images/car_rider.png') }}" width="60%" alt="">
                </div>
                <div class="col-sm-8 col-md-8">
                    <div class="icon-box">
                        <div class="media">
                            <div class="icon-styled color-main fs-40">
                                <i class="ico icon-team"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="fw-300">
                                    Not quite ready for your driving test?
                                </h6>
                                <p>
                                    We also provide standard driving school packages that will help you prepare to pass the
                                    driving test. With FirstPass driving instructor training you can book driving lessons and
                                    begin learning to drive in a vehicle you can later use in your driving test. For more
                                    information, enter your suburb in the search tool below and view our driving lesson packages
                                    now.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>

    <div class="modal fade" id="search_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-85" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Book Instructor Online </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div style="background: #ffc457; padding: 18px 0">
                    <div class="col-md-12">
                        <h5 class="font-condensed small-margin-top-20 small-margin-bottom-10">
                            <small class="caps">Step 2<br></small>
                            Choose your instructor
                        </h5>
                        <p>We have <strong> <span class="total_inst">28</span> auto instructors</strong> available in <strong class="area"></strong></p>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="instructor-profile-banner small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="load_instructors"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>

<script>
    $('.select2').select2({

        placeholder: 'Select your suburb',
        ajax: {
            url: '{{ url('autocomplete-regions') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.title,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    function radio_function(obj)
    {
        if(obj==1)
        {
            $('.append_new').hide();
            $(".test-text").hide();
            $('.test-test').hide();
            var html='Please select your pickup suburb &amp; transmission type. You can then review our instructors in your area &amp; book online.';
            $('.with_lesson').html(html);
        }
        else{
            $(".test-text").show();
            var html='1. Please enter your pickup suburb & transmission type into the search tool below.';
            $('.with_lesson').html(html);
            $('.test-test').show();
            $('.append_new').show();
        }
    }
    function get_test_location(obj)
    {
        $('.append_new').hide();
        var obj=$(obj).val();
        var check_input=$('input[name=test_type]:checked').val();
        if(check_input==1 || check_input==2)
        {
            $.ajax({
                url: "{{Route('test_location')}}",
                data: {id: obj},
                //dataType: "json",
                //contentType: 'application/json',
                type: 'get',
                success: function (returnedData) {
                   if(returnedData!='')
                   {
                        $('.append_new').html(returnedData);
                        if(check_input == 2){
                            $('.append_new').show();
                        }
                         $('.btn-success').show();
                   }
                },
                error: function () {
                    $('.fa-spinner').addClass('hidden');
                }
            });
        }
        else{
        }

    }
    $(document).ready(function (){

        $('#test_package_ga_click').click(function (){
           $(this).addClass('active');
           $('#test_package_with_lesson_ga_click').removeClass('active');

        });

        $('#test_package_with_lesson_ga_click').click(function (){
           $(this).addClass('active');
           $('#test_package_ga_click').removeClass('active');

        });
         $("body").on("change","#test_location",function(event){
             console.log('in the change event');
            $('.btn-success').show();
            });


        $('#searchForm').submit(function (){

            $('.fa-spinner').removeClass('hidden');

            var data = new FormData(this);

            data.append("search_id", 1);
            data.append("test_type", $('input[name=test_type]:checked').val());
            data.append("test_location", $('#test_location').val());

            $.ajax({
                url: "{{Route('search')}}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        $('.total_inst').html(res.total);

                        $('.area').text(res.title);

                        $('#load_instructors').html(res.view);
                        $('#search_modal').modal('show');

                        // window.history.replaceState("", "", "{{url('/')}}/"+res.search_id);

                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');

                    }
                    $('.fa-spinner').addClass('hidden');
                },
                error: function () {
                    $('.fa-spinner').addClass('hidden');
                }
            });

            return false;
        });
    });

</script>

@endsection
