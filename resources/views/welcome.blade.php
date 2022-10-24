@extends('layouts.app_guest')
@section('content')

    <link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/js/calendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/daygrid/main.css') }}" rel='stylesheet' />

    <link href='{{ url('assets/js/calendar/packages/core/main.css') }}' rel='stylesheet' />
    <link href='{{ url('assets/js/calendar/packages/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ url('assets/js/calendar/packages/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ url('assets/js/calendar/packages/list/main.css') }}' rel='stylesheet' />

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
        .fc-bbg{
            display: inline-block;
            border: 1px solid #8a8a8a;
            height: 20px;
            width: 20px;
            border-radius: 50%;
        }
        .fc-bbg.red{
            background: #8a8a8a;
        }
        .calendar-extra{
            text-align: center;
        }
        .calendar-extra ul{
            display: flex;
            justify-content: space-evenly;
            margin-top: 10px;
        }
        .calendar-extra .btn{
            display: inline-block;
            max-width: 300px;
            margin-top: 15px;
        }
    </style>

    <section class="page_slider">
        <div class="form_container">
            <form class="form_section" action="" id="searchForm">
                <input type="hidden" name="search_type" value="1">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class=""><span class="">Find driving instructor</h6>
                        <!-- <p class="text-dark">Including availability, pricing & bookings</p> -->

                        <!-- Search Section Starts -->
                        
                            <div class="divider-sm-0 divider-md-30"></div>
                            <div class="search_section_area">
                                <div class="form-group type switch_wrap">
                                    
                                    <?php if(isset($search_id) && isset($search->t_type)){
                                        if($search->t_type == "manual"){ $sType = "checked"; }
                                        else{ $sType = ""; }
                                    }
                                    else{ $sType = ""; } ?>

                                    <div class="switch_section">
                                        <p class="firstC active">Auto</p>
                                        <label class="switch">
                                            <input id="type_checkbox" type="checkbox" <?php echo $sType; ?>>
                                            <span class="slider round"></span>
                                            <input type="hidden" name="type" id="hidden_type" value="auto">
                                        </label>
                                        <p class="secondC">Manual</p>
                                    </div>
                                    
                                    <?php /*
                                    <button onclick="$(this).find('input').prop('checked', true); $('i.ato').removeClass('hidden'); $('i.mnl').addClass('hidden');" type="button" id="contact_form_submit active" class="btn btn-outline-darkgrey">
                                        <input type="radio" name="type" value="auto" @if($search_id)  @if($search->t_type == "auto") checked @endif   @else checked @endif class="hidden">
                                        <i class="fa fa-check text-success ato @if($search_id)  @if($search->t_type == "manual") hidden @endif @endif"></i> AUTO
                                    </button>

                                    <button onclick="$(this).find('input').prop('checked', true); $('i.mnl').removeClass('hidden'); $('i.ato').addClass('hidden');" type="button" id="contact_form_submit" class="btn btn-outline-darkgrey">
                                        <input type="radio" name="type" value="manual" class="hidden" @if($search_id)  @if($search->t_type == "manual") checked @endif @endif>
                                        <i class="fa fa-check text-success @if($search_id)  @if($search->t_type == "auto") hidden @endif @else hidden @endif mnl"></i>
                                        MANUAL
                                    </button>
                                    */ ?>

                                </div>

                                <div class="form-group select_area">
                                    <select name="region" id="" required class="select2">
                                        @if($search_id)
                                        <option value="{{$region->id}}">{{$region->title}}</option>
                                        @else
                                            <option value=""></option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group search_point">
                                    <button class="submit_btn"><i class="fa fa-search"></i> <i class="fa fa-spinner fa-spin hidden"></i></button>
                                </div>
                                @if(Session::has('success'))
                                    <p class="text-center mt-2 text-success">{{ Session::get('success') }}</p>
                                @endif
                                @if(Session::has('error'))
                                    <p class="text-center mt-2 text-danger">{{ Session::get('error') }}</p>
                                @endif
                        </div>
                        <!-- Search Section Ends -->

                    </div>
                </div>
            </form>
        </div>

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
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>

                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide02.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper intro_text_bottom">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
                                            </ul>
                                        </div>

                                    </div> <!-- eof .intro_layers -->
                                </div> <!-- eof .intro_layers_wrapper -->
                            </div> <!-- eof .col-* -->
                        </div><!-- eof .row -->
                    </div><!-- eof .container-fluid -->
                </li>
                <li class="cs cover-image flex-slide">
                    <img src="{{ asset('assets/front/images/slide03.jpg')}}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="intro_layers_wrapper intro_text_bottom">
                                    <div class="intro_layers">
                                        <div class="intro_layer" data-animation="fadeInRight">
                                            <h1>
                                                Original Provider
                                            </h1>
                                            <h1 class="after-title">
                                                for Online<span> Driving Licence</span>
                                            </h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>No Time Requirements, Study at Your Own Pace</li>
                                                <li>California DMV Licensed & Court Accepted</li>
                                                <li>Avoid Points & License Suspension</li>
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

    <section class="ls teaser-box-section">
        <div class="container">
            <div class="row c-gutter-8">
                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 cs teaser" href="#">
                        <i class="ico icon-professor fs-40 px-10"></i>
                        <h6 class="fw-300">Find Driving Instructors</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-event fs-40 px-10"></i>
                        <h6 class="fw-300">Book Driving Lessons</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-steering-wheel fs-40 px-10"></i>
                        <h6 class="fw-300">Learn to Drive</h6>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a class="text-center py-45 box-shadow mb-20 teaser" href="#">
                        <i class="ico icon-clock fs-40 px-10"></i>
                        <h6 class="fw-300">Manage Driving Lessons</h6>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="video" class="ls">

        <div class="cover-image s-cover-left"></div><!-- half image background element -->
        <div class="container">
            <div class="row align-items-center c-gutter-60">
                <div class="col-md-12 col-lg-6">
                    <div class="item-media">
                        <div class="embed-responsive">
                            <a href="images/square/home-video.html" class="photoswipe-link" data-width="800" data-height="800" data-iframe="//www.youtube.com/embed/mcixldqDIEQ">
                                <img src="{{ asset('assets/front/images/home-video.jpg')}}" alt="">
                            </a>
                        </div>
                        <!-- <iframe width="1000" height="460" src="https://www.youtube.com/embed/mcixldqDIEQ" allowfullscreen></iframe> -->
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">


                    <div class="divider-30 divider-md-70 divider-xl-75"></div>


                    <h3 class="mt-0"><span class="color-main">Ready For</span> A Safe, Fun Driving Experience?</h3>
                    <p class="after-title subtitle">The school offers the following services for teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    <div class="row c-gutter-30">
                        <div class="col-md-12 col-lg-6">
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-shield fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Best Safety Measures
                                        </h6>
                                        <p>
                                            Our Instructors are Highly Trained in the latest Safety
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-30 divider-lg-42"></div>
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-event fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Perfect Timing
                                        </h6>
                                        <p>
                                            Now is the perfect time to start your In Class.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider-30 d-lg-none d-md-block"></div>
                        <div class="col-md-12 col-lg-6">
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-steering-wheel fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Class Formats
                                        </h6>
                                        <p>
                                            We offer In Classroom Drivers Education.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="divider-30 divider-lg-42"></div>
                            <div class="icon-box">
                                <div class="media">
                                    <div class="icon-styled color-main fs-24">
                                        <i class="ico icon-credit-card fs-40"></i>
                                    </div>

                                    <div class="media-body">
                                        <h6 class="fw-300">
                                            Affordable Fee
                                        </h6>
                                        <p>
                                            We know this process can be expensive.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider-0 divider-md-0 divider-xl-75"></div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <section id="section_testimonials" class="container-fluids-mw ls">
        <div class="container-fluid">
            <div class="row c-gutter-50 mobile-padding-normal">
                <div class="divider-70 divider-xl-140"></div>
                <div class="col-md-12">
                    <div class="text-center">
                        <h3>What <span class="color-main">Client Says</span><br>About Us</h3>
                        <p class="after-title subtitle width-xl-50 width-100">The school offers the following services for Teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    </div>

                    <div class="testimonials-slider owl-carousel mt-60" data-autoplay="true" data-loop="true" data-responsive-lg="3" data-responsive-md="3" data-responsive-sm="1" data-responsive-xs="1" data-nav="false" data-dots="false" data-margin="50" data-center="true">
                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_01.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    Stephanie Wall is dedicated to make sure all individuals have an equally great experience with traffic school. Her devotion to the company is evident, with the countless amount of positive experiences.
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Sidney W. Yarber</cite>
                                <span class="color-main">Manager</span>
                            </footer>
                            <!--<p class="color-darkgrey">-->
                            <!--Sidney W. Yarber-->
                            <!--</p>-->
                            <!--<p class="color-main">-->
                            <!--Manager-->
                            <!--</p>-->
                        </div>


                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_02.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    As founder of FirstPass, Abdi Moalim draws on more then 5 years of business management experience. He graduated from San Diego State University with a degree in Political Science
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Terence M. Witzel</cite>
                                <span class="color-main">Businessman</span>
                            </footer>
                        </div>


                        <div class="quote-item">
                            <div class="quote-image">
                                <img src="{{ asset('assets/front/images/team/testimonials_03.png')}}" alt="">
                            </div>
                            <p>
                                <i class="ico icon-left-quote"></i>
                                <em>
                                    John is a fantastic instructor and made him feel really comfortable. They focused on everything important and when it came test time my nephew wasn't nervous at all because he had been trained so well.
                                </em>
                            </p>
                            <footer>
                                <cite class="color-dark">Kayla H. Seaman</cite>
                                <span class="color-main">Co & Founder</span>
                            </footer>
                        </div>

                    </div><!-- .testimonials-slider -->

                </div>
                <div class="divider-50 divider-xl-120"></div>
            </div>
        </div>
    </section>

    <section id="countdown-section" class="ds">
        <div class="container">
            <div class="row c-gutter-50 mobile-padding-normal">
                <div class="divider-70 divider-xl-90"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="1489" data-speed="1500">0</span>
                        <span class="counter-add">+</span>
                    </h3>

                    <p>Graduates received the right</p>
                </div>

                <div class="divider-40 d-sm-block d-md-none"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="94" data-speed="2500">0</span>
                    </h3>

                    <p>Years on the market</p>
                </div>

                <div class="divider-40 d-md-block d-lg-none "></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="96" data-speed="3000">0</span>
                    </h3>

                    <p>Training hours</p>
                </div>

                <div class="divider-40 d-sm-block d-md-none"></div>

                <div class="col-sm-12 col-md-6 col-lg-3 text-center">
                    <h3 class="counter-wrap color-main">
                        <span class="counter" data-from="0" data-to="99" data-speed="2800">0</span>
                    </h3>

                    <p>Number of teachers</p>
                </div>

                <div class="divider-80 divider-xl-100"></div>
            </div>
        </div>
    </section>

    <section class="ls s-py-70 s-py-xl-141">
        <div class="container">
            <div class="row c-gutter-135 mobile-padding-normal">

                <div class="col-md-12">
                    <div class="text-center mb-45">
                        <h3>How <span class="color-main">Should Get</span><br>Driving Lessons</h3>
                        <p class="subtitle width-100 width-xl-60">The FirstPass offers the following services for Teenage first-time drivers, new adult learners and existing drivers with lapsed licenses.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <h1 class="color-main fw-500"><i class="ico icon-circle fs-8"></i>01</h1>
                            <h6 class="color-dark mt-28 after-title2">Find Driving Instructors</h6>
                            <p>View instructor profiles & real-time availability in your area, compare to get the perfect fit.</p>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="divider-30 divider-md-0 divider-xl-0"></div>
                            <h1 class="grey-color fw-500 mt-0"><i class="ico icon-circle fs-8"></i>02</h1>
                            <h6 class="color-dark mt-28 after-title2">Book Driving Lessons</h6>
                            <p>Choose your instructor and book your driving lessons online. Buy a package and save.</p>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="divider-30 divider-md-0 divider-xl-0"></div>
                            <h1 class="grey-color fw-500 mt-0"><i class="ico icon-circle fs-8"></i>03</h1>
                            <h6 class="color-dark mt-28 after-title2">Learn to Drive</h6>
                            <p>Done, you're ready to learn! Your instructor will pick you up from your chosen address.</p>
                        </div>
                    </div>
                </div>
                <div class="divider-5 d-lg-block d-xl-5"></div>
            </div>
        </div>
    </section>

    <section id="information-block" class="ds s-pt-xl-90 s-pb-xl-94 s-pt-60 s-pb-60">
        <div class="container">
            <div class="row c-gutter-50">

                <div class="divider-10 divider-lg-10 divider-xl-5"></div>
                <div class="col-md-9 col-lg-6 col-sm-12">
                    <h3 class="after-title">Just looking <span class="color-main">for lessons?</span></h3>

                    <p class="subtitle">Whether you are an existing driver or a new driver who needs help preparing for road test we have package options that can help you.</p>
                    <div class="mt-45">
                        <button type="button" class="btn btn-outline-darkgrey small fw-400">Get Started</button><span class="m-25"> or </span><a href="#" class="btn btn-link">Learn more</a>
                    </div>
                    <div class="divider-20 divider-lg-20 divider-xl-5"></div>
                </div>


            </div>
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
                        <p>We have <strong> <span class="total_inst">0</span> <span class="final_type">auto</span> instructors</strong> available in <strong class="area"></strong></p>
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

    <!-- ================================================= -->
    <div class="modal fade" id="availability_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-100" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100"> Check Instructor Availability <div class="pull-right"> <div class="fc-bbg red"></div> <small>Booked out</small> <div class="fc-bbg"></div> <small>Available</small> </div>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                            <div class="row calendar-extra">
                                <div class="col-md-12">
                                    <ul class="list-inline text-center small-margin-bottom-20 small-fontsize-12">
                                        <li>• Driving lesson duration = 1 hour or 2 hours</li>
                                        <li>• Driving test package duration = 2.5 hours</li>
                                        <li>• Booking start times are in 15 minute increments</li>
                                    </ul>
                                    <a id="book_btn" href="" class="btn btn-block btn-warning text-uppercase"><span id="show_name"></span></a>
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

<style>
        .fc{direction:ltr;text-align:left}.fc-rtl{text-align:right}body .fc{font-size:1em}.fc-unthemed th,.fc-unthemed td,.fc-unthemed thead,.fc-unthemed tbody,.fc-unthemed .fc-divider,.fc-unthemed .fc-row,.fc-unthemed .fc-content,.fc-unthemed .fc-popover,.fc-unthemed .fc-list-view,.fc-unthemed .fc-list-heading td{border-color:#ddd}.fc-unthemed .fc-popover{background-color:#fff}.fc-unthemed .fc-divider,.fc-unthemed .fc-popover .fc-header,.fc-unthemed .fc-list-heading td{background:#eee}.fc-unthemed .fc-popover .fc-header .fc-close{color:#666}.fc-unthemed td.fc-today{background:#fcf8e3}.fc-highlight{background:#bce8f1;opacity:.3}.fc-bgevent{background:#8fdf82;opacity:.3}.fc-nonbusiness{background:#8a8a8a}.fc-unthemed .fc-disabled-day{background:#d7d7d7;opacity:.3}.ui-widget .fc-disabled-day{background-image:none}.fc-icon{display:inline-block;height:1em;line-height:1em;font-size:1em;text-align:center;overflow:hidden;font-family:"Courier New", Courier, monospace;-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.fc-icon:after{position:relative}.fc-icon-left-single-arrow:after{content:"\02039";font-weight:bold;font-size:200%;top:-7%}.fc-icon-right-single-arrow:after{content:"\0203A";font-weight:bold;font-size:200%;top:-7%}.fc-icon-left-double-arrow:after{content:"\000AB";font-size:160%;top:-7%}.fc-icon-right-double-arrow:after{content:"\000BB";font-size:160%;top:-7%}.fc-icon-left-triangle:after{content:"\25C4";font-size:125%;top:3%}.fc-icon-right-triangle:after{content:"\25BA";font-size:125%;top:3%}.fc-icon-down-triangle:after{content:"\25BC";font-size:125%;top:2%}.fc-icon-x:after{content:"\000D7";font-size:200%;top:6%}.fc button{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;margin:0;height:2.1em;padding:0 .6em;font-size:1em;white-space:nowrap;cursor:pointer}.fc button::-moz-focus-inner{margin:0;padding:0}.fc-state-default{border:1px solid}.fc-state-default.fc-corner-left{border-top-left-radius:4px;border-bottom-left-radius:4px}.fc-state-default.fc-corner-right{border-top-right-radius:4px;border-bottom-right-radius:4px}.fc button .fc-icon{position:relative;top:-0.05em;margin:0 .2em;vertical-align:middle}.fc-state-default{background-color:#f5f5f5;background-image:-moz-linear-gradient(top, #fff, #e6e6e6);background-image:-webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));background-image:-webkit-linear-gradient(top, #fff, #e6e6e6);background-image:-o-linear-gradient(top, #fff, #e6e6e6);background-image:linear-gradient(to bottom, #fff, #e6e6e6);background-repeat:repeat-x;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-color:rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);color:#333;text-shadow:0 1px 1px rgba(255,255,255,0.75);box-shadow:inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05)}.fc-state-hover,.fc-state-down,.fc-state-active,.fc-state-disabled{color:#333333;background-color:#e6e6e6}.fc-state-hover{color:#333333;text-decoration:none;background-position:0 -15px;-webkit-transition:background-position 0.1s linear;-moz-transition:background-position 0.1s linear;-o-transition:background-position 0.1s linear;transition:background-position 0.1s linear}.fc-state-down,.fc-state-active{background-color:#cccccc;background-image:none;box-shadow:inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05)}.fc-state-disabled{cursor:default;background-image:none;opacity:0.65;box-shadow:none}.fc-button-group{display:inline-block}.fc .fc-button-group>*{float:left;margin:0 0 0 -1px}.fc .fc-button-group>:first-child{margin-left:0}.fc-popover{position:absolute;box-shadow:0 2px 6px rgba(0,0,0,0.15)}.fc-popover .fc-header{padding:2px 4px}.fc-popover .fc-header .fc-title{margin:0 2px}.fc-popover .fc-header .fc-close{cursor:pointer}.fc-ltr .fc-popover .fc-header .fc-title,.fc-rtl .fc-popover .fc-header .fc-close{float:left}.fc-rtl .fc-popover .fc-header .fc-title,.fc-ltr .fc-popover .fc-header .fc-close{float:right}.fc-unthemed .fc-popover{border-width:1px;border-style:solid}.fc-unthemed .fc-popover .fc-header .fc-close{font-size:.9em;margin-top:2px}.fc-popover>.ui-widget-header+.ui-widget-content{border-top:0}.fc-divider{border-style:solid;border-width:1px}hr.fc-divider{height:0;margin:0;padding:0 0 2px;border-width:1px 0}.fc-clear{clear:both}.fc-bg,.fc-bgevent-skeleton,.fc-highlight-skeleton,.fc-helper-skeleton{position:absolute;top:0;left:0;right:0}.fc-bg{bottom:0}.fc-bg table{height:100%}.fc table{width:100%;box-sizing:border-box;table-layout:fixed;border-collapse:collapse;border-spacing:0;font-size:1em}.fc th{text-align:center}.fc th,.fc td{border-style:solid;border-width:1px;padding:0;vertical-align:top}.fc td.fc-today{border-style:double}a[data-goto]{cursor:pointer}a[data-goto]:hover{text-decoration:underline}.fc .fc-row{border-style:solid;border-width:0}.fc-row table{border-left:0 hidden transparent;border-right:0 hidden transparent;border-bottom:0 hidden transparent}.fc-row:first-child table{border-top:0 hidden transparent}.fc-row{position:relative}.fc-row .fc-bg{z-index:1}.fc-row .fc-bgevent-skeleton,.fc-row .fc-highlight-skeleton{bottom:0}.fc-row .fc-bgevent-skeleton table,.fc-row .fc-highlight-skeleton table{height:100%}.fc-row .fc-highlight-skeleton td,.fc-row .fc-bgevent-skeleton td{border-color:transparent}.fc-row .fc-bgevent-skeleton{z-index:2}.fc-row .fc-highlight-skeleton{z-index:3}.fc-row .fc-content-skeleton{position:relative;z-index:4;padding-bottom:2px}.fc-row .fc-helper-skeleton{z-index:5}.fc-row .fc-content-skeleton td,.fc-row .fc-helper-skeleton td{background:none;border-color:transparent;border-bottom:0}.fc-row .fc-content-skeleton tbody td,.fc-row .fc-helper-skeleton tbody td{border-top:0}.fc-scroller{-webkit-overflow-scrolling:touch}.fc-scroller>.fc-day-grid,.fc-scroller>.fc-time-grid{position:relative;width:100%}.fc-event{position:relative;display:block;font-size:.85em;line-height:1.3;border-radius:3px;border:1px solid #3a87ad;font-weight:normal}.fc-event,.fc-event-dot{background-color:#3a87ad}.fc-event,.fc-event:hover,.ui-widget .fc-event{color:#fff;text-decoration:none}.fc-event[href],.fc-event.fc-draggable{cursor:pointer}.fc-not-allowed,.fc-not-allowed .fc-event{cursor:not-allowed}.fc-event .fc-bg{z-index:1;background:#fff;opacity:.25}.fc-event .fc-content{position:relative;z-index:2}.fc-event .fc-resizer{position:absolute;z-index:4}.fc-event .fc-resizer{display:none}.fc-event.fc-allow-mouse-resize .fc-resizer,.fc-event.fc-selected .fc-resizer{display:block}.fc-event.fc-selected .fc-resizer:before{content:"";position:absolute;z-index:9999;top:50%;left:50%;width:40px;height:40px;margin-left:-20px;margin-top:-20px}.fc-event.fc-selected{z-index:9999 !important;box-shadow:0 2px 5px rgba(0,0,0,0.2)}.fc-event.fc-selected.fc-dragging{box-shadow:0 2px 7px rgba(0,0,0,0.3)}.fc-h-event.fc-selected:before{content:"";position:absolute;z-index:3;top:-10px;bottom:-10px;left:0;right:0}.fc-ltr .fc-h-event.fc-not-start,.fc-rtl .fc-h-event.fc-not-end{margin-left:0;border-left-width:0;padding-left:1px;border-top-left-radius:0;border-bottom-left-radius:0}.fc-ltr .fc-h-event.fc-not-end,.fc-rtl .fc-h-event.fc-not-start{margin-right:0;border-right-width:0;padding-right:1px;border-top-right-radius:0;border-bottom-right-radius:0}.fc-ltr .fc-h-event .fc-start-resizer,.fc-rtl .fc-h-event .fc-end-resizer{cursor:w-resize;left:-1px}.fc-ltr .fc-h-event .fc-end-resizer,.fc-rtl .fc-h-event .fc-start-resizer{cursor:e-resize;right:-1px}.fc-h-event.fc-allow-mouse-resize .fc-resizer{width:7px;top:-1px;bottom:-1px}.fc-h-event.fc-selected .fc-resizer{border-radius:4px;border-width:1px;width:6px;height:6px;border-style:solid;border-color:inherit;background:#fff;top:50%;margin-top:-4px}.fc-ltr .fc-h-event.fc-selected .fc-start-resizer,.fc-rtl .fc-h-event.fc-selected .fc-end-resizer{margin-left:-4px}.fc-ltr .fc-h-event.fc-selected .fc-end-resizer,.fc-rtl .fc-h-event.fc-selected .fc-start-resizer{margin-right:-4px}.fc-day-grid-event{margin:1px 2px 0;padding:0 1px}tr:first-child>td>.fc-day-grid-event{margin-top:2px}.fc-day-grid-event.fc-selected:after{content:"";position:absolute;z-index:1;top:-1px;right:-1px;bottom:-1px;left:-1px;background:#000;opacity:.25}.fc-day-grid-event .fc-content{white-space:nowrap;overflow:hidden}.fc-day-grid-event .fc-time{font-weight:bold}.fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer,.fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer{margin-left:-2px}.fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer,.fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer{margin-right:-2px}a.fc-more{margin:1px 3px;font-size:.85em;cursor:pointer;text-decoration:none}a.fc-more:hover{text-decoration:underline}.fc-limited{display:none}.fc-day-grid .fc-row{z-index:1}.fc-more-popover{z-index:2;width:220px}.fc-more-popover .fc-event-container{padding:10px}.fc-now-indicator{position:absolute;border:0 solid red}.fc-unselectable{-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-touch-callout:none;-webkit-tap-highlight-color:transparent}.fc-toolbar{text-align:center}.fc-toolbar.fc-header-toolbar{margin-bottom:1em}.fc-toolbar.fc-footer-toolbar{margin-top:1em}.fc-toolbar .fc-left{float:left}.fc-toolbar .fc-right{float:right}.fc-toolbar .fc-center{display:inline-block}.fc .fc-toolbar>*>*{float:left;margin-left:.75em}.fc .fc-toolbar>*>:first-child{margin-left:0}.fc-toolbar h2{margin:0}.fc-toolbar button{position:relative}.fc-toolbar .fc-state-hover,.fc-toolbar .ui-state-hover{z-index:2}.fc-toolbar .fc-state-down{z-index:3}.fc-toolbar .fc-state-active,.fc-toolbar .ui-state-active{z-index:4}.fc-toolbar button:focus{z-index:5}.fc-view-container *,.fc-view-container *:before,.fc-view-container *:after{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}.fc-view,.fc-view>table{position:relative;z-index:1}.fc-basicWeek-view .fc-content-skeleton,.fc-basicDay-view .fc-content-skeleton{padding-bottom:1em}.fc-basic-view .fc-body .fc-row{min-height:4em}.fc-row.fc-rigid{overflow:hidden}.fc-row.fc-rigid .fc-content-skeleton{position:absolute;top:0;left:0;right:0}.fc-day-top.fc-other-month{opacity:0.3}.fc-basic-view .fc-week-number,.fc-basic-view .fc-day-number{padding:2px}.fc-basic-view th.fc-week-number,.fc-basic-view th.fc-day-number{padding:0 2px}.fc-ltr .fc-basic-view .fc-day-top .fc-day-number{float:right}.fc-rtl .fc-basic-view .fc-day-top .fc-day-number{float:left}.fc-ltr .fc-basic-view .fc-day-top .fc-week-number{float:left;border-radius:0 0 3px 0}.fc-rtl .fc-basic-view .fc-day-top .fc-week-number{float:right;border-radius:0 0 0 3px}.fc-basic-view .fc-day-top .fc-week-number{min-width:1.5em;text-align:center;background-color:#f2f2f2;color:#808080}.fc-basic-view td.fc-week-number{text-align:center}.fc-basic-view td.fc-week-number>*{display:inline-block;min-width:1.25em}.fc-agenda-view .fc-day-grid{position:relative;z-index:2}.fc-agenda-view .fc-day-grid .fc-row{min-height:3em}.fc-agenda-view .fc-day-grid .fc-row .fc-content-skeleton{padding-bottom:1em}.fc .fc-axis{vertical-align:middle;padding:0 4px;white-space:nowrap}.fc-ltr .fc-axis{text-align:right}.fc-rtl .fc-axis{text-align:left}.ui-widget td.fc-axis{font-weight:normal}.fc-time-grid-container,.fc-time-grid{position:relative;z-index:1}.fc-time-grid{min-height:100%}.fc-time-grid table{border:0 hidden transparent}.fc-time-grid>.fc-bg{z-index:1}.fc-time-grid .fc-slats,.fc-time-grid>hr{position:relative;z-index:2}.fc-time-grid .fc-content-col{position:relative}.fc-time-grid .fc-content-skeleton{position:absolute;z-index:3;top:0;left:0;right:0}.fc-time-grid .fc-business-container{position:relative;z-index:1}.fc-time-grid .fc-bgevent-container{position:relative;z-index:2}.fc-time-grid .fc-highlight-container{position:relative;z-index:3}.fc-time-grid .fc-event-container{position:relative;z-index:4}.fc-time-grid .fc-now-indicator-line{z-index:5}.fc-time-grid .fc-helper-container{position:relative;z-index:6}.fc-time-grid .fc-slats td{height:1.5em;border-bottom:0}.fc-time-grid .fc-slats .fc-minor td{border-top-style:dotted}.fc-time-grid .fc-slats .ui-widget-content{background:none}.fc-time-grid .fc-highlight-container{position:relative}.fc-time-grid .fc-highlight{position:absolute;left:0;right:0}.fc-ltr .fc-time-grid .fc-event-container{margin:0 2.5% 0 2px}.fc-rtl .fc-time-grid .fc-event-container{margin:0 2px 0 2.5%}.fc-time-grid .fc-event,.fc-time-grid .fc-bgevent{position:absolute;z-index:1}.fc-time-grid .fc-bgevent{left:0;right:0}.fc-v-event.fc-not-start{border-top-width:0;padding-top:1px;border-top-left-radius:0;border-top-right-radius:0}.fc-v-event.fc-not-end{border-bottom-width:0;padding-bottom:1px;border-bottom-left-radius:0;border-bottom-right-radius:0}.fc-time-grid-event{overflow:hidden}.fc-time-grid-event.fc-selected{overflow:visible}.fc-time-grid-event.fc-selected .fc-bg{display:none}.fc-time-grid-event .fc-content{overflow:hidden}.fc-time-grid-event .fc-time,.fc-time-grid-event .fc-title{padding:0 1px}.fc-time-grid-event .fc-time{font-size:.85em;white-space:nowrap}.fc-time-grid-event.fc-short .fc-content{white-space:nowrap}.fc-time-grid-event.fc-short .fc-time,.fc-time-grid-event.fc-short .fc-title{display:inline-block;vertical-align:top}.fc-time-grid-event.fc-short .fc-time span{display:none}.fc-time-grid-event.fc-short .fc-time:before{content:attr(data-start)}.fc-time-grid-event.fc-short .fc-time:after{content:"\000A0-\000A0"}.fc-time-grid-event.fc-short .fc-title{font-size:.85em;padding:0}.fc-time-grid-event.fc-allow-mouse-resize .fc-resizer{left:0;right:0;bottom:0;height:8px;overflow:hidden;line-height:8px;font-size:11px;font-family:monospace;text-align:center;cursor:s-resize}.fc-time-grid-event.fc-allow-mouse-resize .fc-resizer:after{content:"="}.fc-time-grid-event.fc-selected .fc-resizer{border-radius:5px;border-width:1px;width:8px;height:8px;border-style:solid;border-color:inherit;background:#fff;left:50%;margin-left:-5px;bottom:-5px}.fc-time-grid .fc-now-indicator-line{border-top-width:1px;left:0;right:0}.fc-time-grid .fc-now-indicator-arrow{margin-top:-5px}.fc-ltr .fc-time-grid .fc-now-indicator-arrow{left:0;border-width:5px 0 5px 6px;border-top-color:transparent;border-bottom-color:transparent}.fc-rtl .fc-time-grid .fc-now-indicator-arrow{right:0;border-width:5px 6px 5px 0;border-top-color:transparent;border-bottom-color:transparent}.fc-event-dot{display:inline-block;width:10px;height:10px;border-radius:5px}.fc-rtl .fc-list-view{direction:rtl}.fc-list-view{border-width:1px;border-style:solid}.fc .fc-list-table{table-layout:auto}.fc-list-table td{border-width:1px 0 0;padding:8px 14px}.fc-list-table tr:first-child td{border-top-width:0}.fc-list-heading{border-bottom-width:1px}.fc-list-heading td{font-weight:bold}.fc-ltr .fc-list-heading-main{float:left}.fc-ltr .fc-list-heading-alt{float:right}.fc-rtl .fc-list-heading-main{float:right}.fc-rtl .fc-list-heading-alt{float:left}.fc-list-item.fc-has-url{cursor:pointer}.fc-list-item:hover td{background-color:#f5f5f5}.fc-list-item-marker,.fc-list-item-time{white-space:nowrap;width:1px}.fc-ltr .fc-list-item-marker{padding-right:0}.fc-rtl .fc-list-item-marker{padding-left:0}.fc-list-item-title a{text-decoration:none;color:inherit}.fc-list-item-title a[href]:hover{text-decoration:underline}.fc-list-empty-wrap2{position:absolute;top:0;left:0;right:0;bottom:0}.fc-list-empty-wrap1{width:100%;height:100%;display:table}.fc-list-empty{display:table-cell;vertical-align:middle;text-align:center}.fc-unthemed .fc-list-empty{background-color:#eee}.select2-container{box-sizing:border-box;display:inline-block;margin:0;position:relative;vertical-align:middle}.select2-container .select2-selection--single{box-sizing:border-box;cursor:pointer;display:block;height:28px;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--single .select2-selection__rendered{display:block;padding-left:8px;padding-right:20px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-selection--single .select2-selection__clear{position:relative}.select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered{padding-right:8px;padding-left:20px}.select2-container .select2-selection--multiple{box-sizing:border-box;cursor:pointer;display:block;min-height:32px;user-select:none;-webkit-user-select:none}.select2-container .select2-selection--multiple .select2-selection__rendered{display:inline-block;overflow:hidden;padding-left:8px;text-overflow:ellipsis;white-space:nowrap}.select2-container .select2-search--inline{float:left}.select2-container .select2-search--inline .select2-search__field{box-sizing:border-box;border:none;font-size:100%;margin-top:5px;padding:0}.select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-dropdown{background-color:white;border:1px solid #aaa;border-radius:4px;box-sizing:border-box;display:block;position:absolute;left:-100000px;width:100%;z-index:1051}.select2-results{display:block}.select2-results__options{list-style:none;margin:0;padding:0}.select2-results__option{padding:6px;user-select:none;-webkit-user-select:none}.select2-results__option[aria-selected]{cursor:pointer}.select2-container--open .select2-dropdown{left:0}.select2-container--open .select2-dropdown--above{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--open .select2-dropdown--below{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-search--dropdown{display:block;padding:4px}.select2-search--dropdown .select2-search__field{padding:4px;width:100%;box-sizing:border-box}.select2-search--dropdown .select2-search__field::-webkit-search-cancel-button{-webkit-appearance:none}.select2-search--dropdown.select2-search--hide{display:none}.select2-close-mask{border:0;margin:0;padding:0;display:block;position:fixed;left:0;top:0;min-height:100%;min-width:100%;height:auto;width:auto;opacity:0;z-index:99;background-color:#fff;filter:alpha(opacity=0)}.select2-hidden-accessible{border:0 !important;clip:rect(0 0 0 0) !important;-webkit-clip-path:inset(50%) !important;clip-path:inset(50%) !important;height:1px !important;overflow:hidden !important;padding:0 !important;position:absolute !important;width:1px !important;white-space:nowrap !important}.select2-container--default .select2-selection--single{background-color:#fff;border:1px solid #aaa;border-radius:4px}.select2-container--default .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--default .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold}.select2-container--default .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--default .select2-selection--single .select2-selection__arrow{height:26px;position:absolute;top:1px;right:1px;width:20px}.select2-container--default .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow{left:1px;right:auto}.select2-container--default.select2-container--disabled .select2-selection--single{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear{display:none}.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--default .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text}.select2-container--default .select2-selection--multiple .select2-selection__rendered{box-sizing:border-box;list-style:none;margin:0;padding:0 5px;width:100%}.select2-container--default .select2-selection--multiple .select2-selection__rendered li{list-style:none}.select2-container--default .select2-selection--multiple .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-top:5px;margin-right:10px}.select2-container--default .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{color:#999;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover{color:#333}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice,.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-search--inline{float:right}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice{margin-left:5px;margin-right:auto}.select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--default.select2-container--focus .select2-selection--multiple{border:solid black 1px;outline:0}.select2-container--default.select2-container--disabled .select2-selection--multiple{background-color:#eee;cursor:default}.select2-container--default.select2-container--disabled .select2-selection__choice__remove{display:none}.select2-container--default.select2-container--open.select2-container--above .select2-selection--single,.select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple{border-top-left-radius:0;border-top-right-radius:0}.select2-container--default.select2-container--open.select2-container--below .select2-selection--single,.select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--default .select2-search--dropdown .select2-search__field{border:1px solid #aaa}.select2-container--default .select2-search--inline .select2-search__field{background:transparent;border:none;outline:0;box-shadow:none;-webkit-appearance:textfield}.select2-container--default .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--default .select2-results__option[role=group]{padding:0}.select2-container--default .select2-results__option[aria-disabled=true]{color:#999}.select2-container--default .select2-results__option[aria-selected=true]{background-color:#ddd}.select2-container--default .select2-results__option .select2-results__option{padding-left:1em}.select2-container--default .select2-results__option .select2-results__option .select2-results__group{padding-left:0}.select2-container--default .select2-results__option .select2-results__option .select2-results__option{margin-left:-1em;padding-left:2em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-2em;padding-left:3em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-3em;padding-left:4em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-4em;padding-left:5em}.select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option{margin-left:-5em;padding-left:6em}.select2-container--default .select2-results__option--highlighted[aria-selected]{background-color:#5897fb;color:white}.select2-container--default .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic .select2-selection--single{background-color:#f7f7f7;border:1px solid #aaa;border-radius:4px;outline:0;background-image:-webkit-linear-gradient(top, white 50%, #eee 100%);background-image:-o-linear-gradient(top, white 50%, #eee 100%);background-image:linear-gradient(to bottom, white 50%, #eee 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic .select2-selection--single:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--single .select2-selection__rendered{color:#444;line-height:28px}.select2-container--classic .select2-selection--single .select2-selection__clear{cursor:pointer;float:right;font-weight:bold;margin-right:10px}.select2-container--classic .select2-selection--single .select2-selection__placeholder{color:#999}.select2-container--classic .select2-selection--single .select2-selection__arrow{background-color:#ddd;border:none;border-left:1px solid #aaa;border-top-right-radius:4px;border-bottom-right-radius:4px;height:26px;position:absolute;top:1px;right:1px;width:20px;background-image:-webkit-linear-gradient(top, #eee 50%, #ccc 100%);background-image:-o-linear-gradient(top, #eee 50%, #ccc 100%);background-image:linear-gradient(to bottom, #eee 50%, #ccc 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0)}.select2-container--classic .select2-selection--single .select2-selection__arrow b{border-color:#888 transparent transparent transparent;border-style:solid;border-width:5px 4px 0 4px;height:0;left:50%;margin-left:-4px;margin-top:-2px;position:absolute;top:50%;width:0}.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__clear{float:left}.select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__arrow{border:none;border-right:1px solid #aaa;border-radius:0;border-top-left-radius:4px;border-bottom-left-radius:4px;left:1px;right:auto}.select2-container--classic.select2-container--open .select2-selection--single{border:1px solid #5897fb}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow{background:transparent;border:none}.select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b{border-color:transparent transparent #888 transparent;border-width:0 4px 5px 4px}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--single{border-top:none;border-top-left-radius:0;border-top-right-radius:0;background-image:-webkit-linear-gradient(top, white 0%, #eee 50%);background-image:-o-linear-gradient(top, white 0%, #eee 50%);background-image:linear-gradient(to bottom, white 0%, #eee 50%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--single{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0;background-image:-webkit-linear-gradient(top, #eee 50%, white 100%);background-image:-o-linear-gradient(top, #eee 50%, white 100%);background-image:linear-gradient(to bottom, #eee 50%, white 100%);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0)}.select2-container--classic .select2-selection--multiple{background-color:white;border:1px solid #aaa;border-radius:4px;cursor:text;outline:0}.select2-container--classic .select2-selection--multiple:focus{border:1px solid #5897fb}.select2-container--classic .select2-selection--multiple .select2-selection__rendered{list-style:none;margin:0;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__clear{display:none}.select2-container--classic .select2-selection--multiple .select2-selection__choice{background-color:#e4e4e4;border:1px solid #aaa;border-radius:4px;cursor:default;float:left;margin-right:5px;margin-top:5px;padding:0 5px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove{color:#888;cursor:pointer;display:inline-block;font-weight:bold;margin-right:2px}.select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover{color:#555}.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice{float:right;margin-left:5px;margin-right:auto}.select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove{margin-left:2px;margin-right:auto}.select2-container--classic.select2-container--open .select2-selection--multiple{border:1px solid #5897fb}.select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple{border-top:none;border-top-left-radius:0;border-top-right-radius:0}.select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple{border-bottom:none;border-bottom-left-radius:0;border-bottom-right-radius:0}.select2-container--classic .select2-search--dropdown .select2-search__field{border:1px solid #aaa;outline:0}.select2-container--classic .select2-search--inline .select2-search__field{outline:0;box-shadow:none}.select2-container--classic .select2-dropdown{background-color:white;border:1px solid transparent}.select2-container--classic .select2-dropdown--above{border-bottom:none}.select2-container--classic .select2-dropdown--below{border-top:none}.select2-container--classic .select2-results>.select2-results__options{max-height:200px;overflow-y:auto}.select2-container--classic .select2-results__option[role=group]{padding:0}.select2-container--classic .select2-results__option[aria-disabled=true]{color:grey}.select2-container--classic .select2-results__option--highlighted[aria-selected]{background-color:#3875d7;color:white}.select2-container--classic .select2-results__group{cursor:default;display:block;padding:6px}.select2-container--classic.select2-container--open .select2-dropdown{border-color:#5897fb}/*! fancyBox v2.1.5 fancyapps.com | fancyapps.com/fancybox/#license */.fancybox-wrap,.fancybox-skin,.fancybox-outer,.fancybox-inner,.fancybox-image,.fancybox-wrap iframe,.fancybox-wrap object,.fancybox-nav,.fancybox-nav span,.fancybox-tmp{padding:0;margin:0;border:0;outline:none;vertical-align:top}.fancybox-wrap{position:absolute;top:0;left:0;z-index:8020}.fancybox-skin{position:relative;background:#f9f9f9;color:#444;text-shadow:none;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.fancybox-opened{z-index:8030}.fancybox-opened .fancybox-skin{-webkit-box-shadow:0 10px 25px rgba(0,0,0,0.5);-moz-box-shadow:0 10px 25px rgba(0,0,0,0.5);box-shadow:0 10px 25px rgba(0,0,0,0.5)}.fancybox-outer,.fancybox-inner{position:relative}.fancybox-inner{overflow:hidden}.fancybox-type-iframe .fancybox-inner{-webkit-overflow-scrolling:touch}.fancybox-error{color:#444;font:14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;margin:0;padding:15px;white-space:nowrap}.fancybox-image,.fancybox-iframe{display:block;width:100%;height:100%}.fancybox-image{max-width:100%;max-height:100%}#fancybox-loading,.fancybox-close,.fancybox-prev span,.fancybox-next span{background-image:url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/fancybox_sprite-b9d6fddb0988440902fcfc72f371ecfa80ee2eb36073f9eebc17449ee41c886f.png)}#fancybox-loading{position:fixed;top:50%;left:50%;margin-top:-22px;margin-left:-22px;background-position:0 -108px;opacity:0.8;cursor:pointer;z-index:8060}#fancybox-loading div{width:44px;height:44px;background:url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/fancybox_loading-b8681cce947f5b28ed3181b11601e2470b40811722a49564d1271e7b40015064.gif) center center no-repeat}.fancybox-close{position:absolute;top:-18px;right:-18px;width:36px;height:36px;cursor:pointer;z-index:8040}.fancybox-nav{position:absolute;top:0;width:40%;height:100%;cursor:pointer;text-decoration:none;background:transparent url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/blank-b1442e85b03bdcaf66dc58c7abb98745dd2687d86350be9a298a1d9382ac849b.gif);-webkit-tap-highlight-color:transparent;z-index:8040}.fancybox-prev{left:0}.fancybox-next{right:0}.fancybox-nav span{position:absolute;top:50%;width:36px;height:34px;margin-top:-18px;cursor:pointer;z-index:8040;visibility:hidden}.fancybox-prev span{left:10px;background-position:0 -36px}.fancybox-next span{right:10px;background-position:0 -72px}.fancybox-nav:hover span{visibility:visible}.fancybox-tmp{position:absolute;top:-99999px;left:-99999px;visibility:hidden;max-width:99999px;max-height:99999px;overflow:visible !important}.fancybox-lock{overflow:hidden !important;width:auto}.fancybox-lock body{overflow:hidden !important}.fancybox-lock-test{overflow-y:hidden !important}.fancybox-overlay{position:absolute;top:0;left:0;overflow:hidden;display:none;z-index:8010;background:url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/fancybox_overlay-a163bab86035b0ba62c98fbbd4d8b4f5edabbbb774eca0b5e9e5081b5711b2ab.png)}.fancybox-overlay-fixed{position:fixed;bottom:0;right:0}.fancybox-lock .fancybox-overlay{overflow:auto;overflow-y:scroll}.fancybox-title{visibility:hidden;font:normal 13px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;position:relative;text-shadow:none;z-index:8050}.fancybox-opened .fancybox-title{visibility:visible}.fancybox-title-float-wrap{position:absolute;bottom:0;right:50%;margin-bottom:-35px;z-index:8050;text-align:center}.fancybox-title-float-wrap .child{display:inline-block;margin-right:-100%;padding:2px 20px;background:transparent;background:rgba(0,0,0,0.8);-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px;text-shadow:0 1px 2px #222;color:#FFF;font-weight:bold;line-height:24px;white-space:nowrap}.fancybox-title-outside-wrap{position:relative;margin-top:10px;color:#fff}.fancybox-title-inside-wrap{padding-top:10px}.fancybox-title-over-wrap{position:absolute;bottom:0;left:0;color:#fff;padding:10px;background:#000;background:rgba(0,0,0,0.8)}@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (min--moz-device-pixel-ratio: 1.5), only screen and (min-device-pixel-ratio: 1.5){#fancybox-loading,.fancybox-close,.fancybox-prev span,.fancybox-next span{background-image:url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/fancybox_sprite@2x-6ab68245606bbe6ad87ea3f6a044c93f6c21a07e70924b35b68bfb3786d94cf0.png);background-size:44px 152px}#fancybox-loading div{background-image:url(https://ezlicence-assets.s3-ap-southeast-2.amazonaws.com/assets/fancybox_loading@2x-73b27f9aeb7bc6ee3c4bd20742382f015efd89981a3706d2a29a50867849629c.gif);background-size:24px 24px}}.owl-carousel{display:none;width:100%;-webkit-tap-highlight-color:transparent;position:relative;z-index:1}.owl-carousel .owl-stage{position:relative;-ms-touch-action:pan-Y;-moz-backface-visibility:hidden}.owl-carousel .owl-stage:after{content:".";display:block;clear:both;visibility:hidden;line-height:0;height:0}.owl-carousel .owl-stage-outer{position:relative;overflow:hidden;-webkit-transform:translate3d(0px, 0px, 0px)}.owl-carousel .owl-wrapper,.owl-carousel .owl-item{-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-webkit-transform:translate3d(0, 0, 0);-moz-transform:translate3d(0, 0, 0);-ms-transform:translate3d(0, 0, 0)}.owl-carousel .owl-item{position:relative;min-height:1px;float:left;-webkit-backface-visibility:hidden;-webkit-tap-highlight-color:transparent;-webkit-touch-callout:none}.owl-carousel .owl-item img{display:block;width:100%}.owl-carousel .owl-nav.disabled,.owl-carousel .owl-dots.disabled{display:none}.owl-carousel .owl-nav .owl-prev,.owl-carousel .owl-nav .owl-next,.owl-carousel .owl-dot{cursor:pointer;cursor:hand;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.owl-carousel.owl-loaded{display:block}.owl-carousel.owl-loading{opacity:0;display:block}.owl-carousel.owl-hidden{opacity:0}.owl-carousel.owl-refresh .owl-item{visibility:hidden}.owl-carousel.owl-drag .owl-item{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.owl-carousel.owl-grab{cursor:move;cursor:grab}.owl-carousel.owl-rtl{direction:rtl}.owl-carousel.owl-rtl .owl-item{float:right}.no-js .owl-carousel{display:block}.owl-carousel .animated{animation-duration:1000ms;animation-fill-mode:both}.owl-carousel .owl-animated-in{z-index:0}.owl-carousel .owl-animated-out{z-index:1}.owl-carousel .fadeOut{animation-name:fadeOut}@keyframes fadeOut{0%{opacity:1}100%{opacity:0}}.owl-height{transition:height 500ms ease-in-out}.owl-carousel .owl-item .owl-lazy{opacity:0;transition:opacity 400ms ease}.owl-carousel .owl-item img.owl-lazy{transform-style:preserve-3d}.owl-carousel .owl-video-wrapper{position:relative;height:100%;background:#000}.owl-carousel .owl-video-play-icon{position:absolute;height:80px;width:80px;left:50%;top:50%;margin-left:-40px;margin-top:-40px;background:url("owl.video.play.png") no-repeat;cursor:pointer;z-index:1;-webkit-backface-visibility:hidden;transition:transform 100ms ease}.owl-carousel .owl-video-play-icon:hover{-ms-transform:scale(1.3, 1.3);transform:scale(1.3, 1.3)}.owl-carousel .owl-video-playing .owl-video-tn,.owl-carousel .owl-video-playing .owl-video-play-icon{display:none}.owl-carousel .owl-video-tn{opacity:0;height:100%;background-position:center center;background-repeat:no-repeat;background-size:contain;transition:opacity 400ms ease}.owl-carousel .owl-video-frame{position:relative;z-index:1;height:100%;width:100%}.datepicker{display:none;position:absolute;padding:4px;margin-top:1px;direction:ltr}.datepicker.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;float:left;display:none;min-width:160px;list-style:none;background-color:#fff;border:1px solid rgba(0,0,0,0.2);-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);box-shadow:0 5px 10px rgba(0,0,0,0.2);-webkit-background-clip:padding-box;-moz-background-clip:padding;background-clip:padding-box;*border-right-width:2px;*border-bottom-width:2px;color:#333;font-size:13px;line-height:18px}.datepicker.dropdown-menu th,.datepicker.dropdown-menu td{padding:4px 5px}.datepicker table{border:0;margin:0;width:auto}.datepicker table tr td span{display:block;width:23%;height:54px;line-height:54px;float:left;margin:1%;cursor:pointer}.datepicker td{text-align:center;width:20px;height:20px;border:0;font-size:12px;padding:4px 8px;background:#fff;cursor:pointer}.datepicker td.active.day,.datepicker td.active.year{background:#2ba6cb}.datepicker td.old,.datepicker td.new{color:#999}.datepicker td span.active{background:#2ba6cb}.datepicker td.day.disabled{color:#eee}.datepicker td span.month.disabled,.datepicker td span.year.disabled{color:#eee}.datepicker td .nonMilitaryTime{font-size:9px;height:35px;line-height:35px}.datepicker th{text-align:center;width:20px;height:20px;border:0;font-size:12px;padding:4px 8px;background:#fff;cursor:pointer}.datepicker th.active.day,.datepicker th.active.year{background:#2ba6cb}.datepicker th.date-switch{width:145px}.datepicker th span.active{background:#2ba6cb}.datepicker .cw{font-size:10px;width:12px;padding:0 2px 0 5px;vertical-align:middle}.datepicker.days div.datepicker-days,.datepicker.months div.datepicker-months,.datepicker.years div.datepicker-years{display:block}.datepicker thead tr:first-child th{cursor:pointer}.datepicker thead tr:first-child th.cw{cursor:default;background-color:transparent}.datepicker tfoot tr:first-child th{cursor:pointer}.datepicker-inline{width:220px}.datepicker-rtl{direction:rtl}.datepicker-rtl table tr td span{float:right}.datepicker-dropdown{top:0;left:0}.datepicker-dropdown:before{content:'';display:inline-block;border-left:7px solid transparent;border-right:7px solid transparent;border-bottom:7px solid #ccc;border-bottom-color:1px solid rgba(0,0,0,0.2);position:absolute;top:-7px;left:6px}.datepicker-dropdown:after{content:'';display:inline-block;border-left:6px solid transparent;border-right:6px solid transparent;border-bottom:6px solid #fff;position:absolute;top:-6px;left:7px}.datepicker>div{display:none}.datepicker-dropdown::before,.datepicker-dropdown::after{display:none}.datepicker-close{position:absolute;top:-30px;right:0;width:15px;height:30px;padding:0;display:none}.table-striped .datepicker table tr td,.table-striped .datepicker table tr th{background-color:transparent}._hDateRangeGrouping{background-color:#dfdfdf;background-image:none;border:1px solid transparent;border-radius:4px;cursor:pointer;display:inline-block;float:right;font-size:12px;line-height:1.5;margin:0 2px 5px 2px;padding:4px}._hDateRangeGrouping.active{background-color:#acacac}._hDateRangeGrouping:focus,._hDateRangeGrouping:active{outline:0}html,body{width:100%;min-height:100vh}body.no-scroll .fc-scroller{overflow-y:hidden !important}body.no-scroll .reveal-modal{position:fixed;top:1.875rem !important;bottom:0 !important;overflow-y:auto;overflow-x:hidden}@media only screen and (max-width: 40em){body.no-scroll .reveal-modal{top:0 !important;padding-bottom:80px}body.no-scroll .reveal-modal form .form-actions{margin:0;position:fixed;left:0;right:0;bottom:0;background:#FFFFFF;-webkit-box-shadow:0 -2px 10px rgba(0,0,0,0.1);-moz-box-shadow:0 -2px 10px rgba(0,0,0,0.1);-ms-box-shadow:0 -2px 10px rgba(0,0,0,0.1);box-shadow:0 -2px 10px rgba(0,0,0,0.1)}}body.no-scroll .reveal-modal.show-scroll::-webkit-scrollbar{width:12px;background:#FFFFFF}body.no-scroll .reveal-modal.show-scroll::-webkit-scrollbar-thumb{background:#c0c0c0;border-radius:15px}#main{background:white;width:100%}@media only screen and (max-width: 40em){#main{overflow-x:hidden}}a,button,.button,input,select,.select2-selection{-webkit-transition:all 0.2s ease;-moz-transition:all 0.2s ease;-ms-transition:all 0.2s ease;transition:all 0.2s ease;outline:0}a:hover{-webkit-transform:translate(0, 1px);-moz-transform:translate(0, 1px);-ms-transform:translate(0, 1px);transform:translate(0, 1px)}ol>li{margin-bottom:0.3125rem}ul.lower-alpha{list-style-type:lower-alpha}ul.disc{list-style-type:disc}ul.circle{list-style-type:circle}ul.square{list-style-type:square}ul.no-list-type li{list-style-type:none !important}hr.small{margin-top:0.5rem;margin-bottom:0.5rem}hr.large{margin-top:3rem;margin-bottom:3rem}.page-nav{margin-bottom:1.25rem;font-size:0.875rem}@media only screen and (min-width: 40.0625em){.page-nav{font-size:0.8125rem}}.page-nav a:not(.button){color:#6E7271;font-weight:500;text-decoration:underline}.page-nav a:not(.button) .fa{margin-right:5px}.page-nav a:not(.button):hover{color:#212A37}.page-nav .button{margin-bottom:0}.divider{position:relative;border-top:1px solid #ddd;margin:1.25rem 0}.divider.or{border-width:2px}.divider.or:after{-webkit-transform:translate(-50%, -50%);-moz-transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);transform:translate(-50%, -50%);position:absolute;top:50%;left:50%;width:100%;content:'OR';display:inline-block;text-align:center;background:white;padding:1rem;width:auto;margin-top:-1px;color:#808D8E}.oversized-table{width:100%;overflow:scroll}table{width:100%;border-spacing:0}table.tooltip-auto-width th,table.tooltip-auto-width td{color:#FFFFFF !important;padding:4px !important}table.text-oil td{color:#212A37}table.pdf-table{border-collapse:collapse;border:1px solid #ddd}table.pdf-table td,table.pdf-table th{border:1px solid #ddd;padding:0.625rem 0.5rem !important}table tr.small th,table tr.small td{padding-top:3px;padding-bottom:3px;font-size:0.875rem}table tr th a{color:#454545}table tr th:first-child,table tr td:first-child{padding-left:0}table tr th:last-child,table tr td:last-child{padding-right:0}table tr td.empty{text-align:center;font-style:italic}table tbody td{font-weight:300}table tbody td a{display:inline-block;color:#6E7271;font-weight:500;border-bottom:1px dotted #808D8E}table tbody td a:hover{color:#212A37}table tbody td ul.f-dropdown a{border-bottom:none}table tfoot td{font-size:1rem}table .actions{width:30px;text-align:right}table+.pagination-centered,.responsive-table+.pagination-centered{margin-top:1rem}table .hover-show-border tbody tr:not(.hover-no-border):hover,.responsive-table .hover-show-border tbody tr:not(.hover-no-border):hover{outline-style:solid;outline-width:2px;outline-color:#000000}.pagination-info{margin-top:1.875rem;text-align:center;font-size:0.75rem;color:#6E7271}fieldset{padding:0;border:0}.relative{position:relative}.absolute{position:absolute !important}.block{display:block}.hide{display:none !important}.inline-block{display:inline-block !important}.inline{display:inline !important}.relative{position:relative}.static{position:static !important}.va-t{vertical-align:top !important}.va-m{vertical-align:middle !important}.va-b{vertical-align:bottom !important}.transit,.videoplayer:before,.videoplayer:after,.img-featured,body.public_instructors-show .owl-carousel-div .owl-item a img,.accordion .accordion-navigation>a:after,.well,footer#footer .main-links a svg *{-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease;-ms-transition:all 0.3s ease;transition:all 0.3s ease}.no-events{pointer-events:none}.f-dropdown:focus{outline:none}.margin-top-auto{margin-top:auto}.flex-container{display:flex}.flex-container.flex-column{flex-direction:column}.flex-container.va-t{align-items:flex-start !important}.flex-container.va-m{align-items:center !important}.flex-container.va-b{align-items:flex-end !important}.flex-container.ha-m{justify-content:center !important}.flex-container.ha-r{justify-content:flex-end !important}.table-block,.progress-bar{margin:0;padding:0;position:static;display:table;width:100%;background-size:cover;table-layout:fixed}.table-block.va-t>.table-cell,.va-t.progress-bar>.table-cell{vertical-align:top}.table-block.va-b>.table-cell,.va-b.progress-bar>.table-cell{vertical-align:bottom}.table-block.large>.table-cell,.large.progress-bar>.table-cell{padding:5.625rem}.table-block.medium>.table-cell,.medium.progress-bar>.table-cell{padding:3.75rem}.table-block.small>.table-cell,.small.progress-bar>.table-cell{padding:0.9375rem}.table-block.tiny>.table-cell,.tiny.progress-bar>.table-cell{padding:0.625rem}.table-block.collapse>.table-cell,.collapse.progress-bar>.table-cell{padding:0 !important}.table-block>.table-cell,.progress-bar>.table-cell{display:table-cell;vertical-align:middle;padding:1.875rem;height:100%}.row{max-width:none}.row .row{margin-left:-0.9375rem;margin-right:-0.9375rem}.row .row[class*='collapse']{margin-left:0;margin-right:0}.title-box{background:#FF6238;padding:3rem 0;margin-bottom:2.5rem}.title-box *{color:white;margin-bottom:0}.title-box+section.section{padding-top:0}@media only screen and (max-width: 40em){.container{padding:0}}section.section{padding:1.5rem 1rem}@media only screen and (max-width: 40em){section.section{padding:1.5625rem 0.625rem}}@media only screen and (min-width: 64.0625em){section.section:not(.small){padding:3rem 1rem}}section.section.page p{font-size:1rem;margin:0.5rem 0 1rem}section.section.page ol{margin-bottom:1rem}section.section.page ol li{margin-bottom:0.5rem}article.container{max-width:850px !important;margin:0 auto}article.html-content{padding-bottom:2rem}@media only screen and (max-width: 40em){article.html-content h1{margin-top:0.3125rem}}article.html-content h1,article.html-content h2,article.html-content h3{margin:1.25rem 0 0.625rem}article.html-content h3{margin-bottom:1.25rem 0 0.625rem}article.html-content p strong{color:#454545}article.html-content ol,article.html-content ul{margin-bottom:0.625rem}article.html-content ul{margin-left:1.5rem}article.html-content ul li{margin-bottom:0.5rem}article.html-content ul li ul{margin-left:1.5rem}article.html-content ul:not(.lower-alpha) li{list-style:disc}article.html-content ol{list-style-type:none;counter-reset:item;margin:0;padding:0}article.html-content ol>li{display:table;counter-increment:item;margin-bottom:0.6em}article.html-content ol>li:before{font-size:1.25rem;font-weight:500;content:counters(item, ".") ". ";display:table-cell;padding-right:0.6em;color:#454545}article.html-content ol>li ol,article.html-content ol>li ul{margin-top:10px}article.html-content ol>li ol{margin-left:10px}article.html-content ol>li ol li.note{font-style:italic}article.html-content ol>li ol li.note:before{content:"*Note: "}article.html-content ol>li ol li:before{content:counters(item, ".") " ";font-size:1rem;color:#6E7271}article.html-content hr{margin:1.25rem 0}article.html-content img{display:inherit;margin:0 auto;width:auto;height:auto;max-width:100%;max-height:600px}article.html-content a:not(.button){text-decoration:underline}article.html-content #pricing,article.html-content .article-instructor-search{margin:1.875rem 0;padding-left:1.25rem !important;padding-right:1.25rem !important;border:2px solid #212A37}@media only screen and (max-width: 40em){article.html-content #pricing,article.html-content .article-instructor-search{margin:1.25rem 0 !important;padding:0 0.625rem 0 1.25rem !important}}article.html-content #pricing .form-heading,article.html-content .article-instructor-search .form-heading{color:#212A37;margin:0 0 10px;font-size:1.375rem !important}article.html-content #pricing .button-group,article.html-content .article-instructor-search .button-group{max-width:400px}article.html-content #pricing .button-group input:checked+label,article.html-content .article-instructor-search .button-group input:checked+label{background:white}article.html-content #pricing{padding-top:1.25rem;padding-bottom:1.25rem;background:#ffc20e;border:none}@media only screen and (max-width: 40em){article.html-content #pricing{padding:0.625rem 1.25rem 1.5625rem !important}}article.html-content #pricing #pricing-search-form{float:none;width:100%}article.html-content #pricing #pricing-search-form .button-group{max-width:400px}article.html-content #pricing #pricing-search-form .select2 .select2-selection{margin-top:0}article.html-content #pricing .cta-text{display:none}article.html-content .article-instructor-search{background:#f5f4f3}article.html-content .article-instructor-search .button-group,article.html-content .article-instructor-search .container-input-suburb{padding-right:10px !important}article.html-content .article-instructor-search .button-group{width:auto !important;display:block !important}article.html-content .article-instructor-search .button-group .button{min-width:110px}article.html-content .article-instructor-search .container-inputs{float:none !important;width:100% !important;padding-top:15px;padding-bottom:20px}@media only screen and (max-width: 40em){article.html-content .article-instructor-search .container-inputs{width:auto !important;margin-right:0 !important;padding-top:0}}.show-more .morecontent span{display:none}.show-more .morelink{display:block}ul.tabs{display:flex;flex-direction:row;justify-content:center;margin-bottom:1rem !important}ul.tabs li.tab-title{flex:1;text-align:center;font-weight:bold;line-height:1;padding-right:0.9375rem}ul.tabs li.tab-title:last-child{padding-right:0}ul.tabs li.tab-title a{border-radius:10px;padding-left:10px;padding-right:10px}.accordion{margin:0}.accordion .accordion-navigation{position:relative;border-bottom:1px solid #ddd;border-radius:5px}.accordion .accordion-navigation a:after{display:none !important}.accordion .accordion-navigation>a{position:relative}.accordion .accordion-navigation>a:after{display:block !important;position:absolute;right:0;top:50%;margin-top:-14px;width:1rem;font-family:'FontAwesome';content:"\f105";font-size:110%;text-align:center;color:#808D8E}.accordion .accordion-navigation.active>a:after{content:"\f107"}.accordion.unstyled .accordion-navigation{border:none}.accordion.unstyled .accordion-navigation a:after{display:none !important}.accordion.panel{padding:0}.accordion.panel .accordion-navigation{border:0}.accordion.panel .accordion-navigation a.panel-heading{margin:0;padding:20px;border:none}.accordion.panel .accordion-navigation a.panel-heading:after{margin-top:-8px;right:15px}.accordion.panel .accordion-navigation .panel-body{margin:-5px 20px 20px 20px;padding-top:20px;background-color:white !important;border-top:1px solid #ddd}#global-alert{position:fixed;z-index:9999;bottom:0;right:0;margin:1rem;width:30%;min-width:300px}#global-alert .close{font-size:1rem;zoom:1;filter:alpha(opacity=50);opacity:0.5}.well{border-radius:5px;border:2px solid #ddd;padding:25px;background:white;-webkit-box-shadow:0 5px 15px rgba(0,0,0,0.1);-moz-box-shadow:0 5px 15px rgba(0,0,0,0.1);-ms-box-shadow:0 5px 15px rgba(0,0,0,0.1);box-shadow:0 5px 15px rgba(0,0,0,0.1)}.well:hover{-webkit-box-shadow:0 10px 25px rgba(0,0,0,0.05);-moz-box-shadow:0 10px 25px rgba(0,0,0,0.05);-ms-box-shadow:0 10px 25px rgba(0,0,0,0.05);box-shadow:0 10px 25px rgba(0,0,0,0.05);-webkit-transform:scale(1.01);-moz-transform:scale(1.01);-ms-transform:scale(1.01);transform:scale(1.01)}.alert-box{text-align:center}.alert-box+section.section{margin-top:-1.25rem}@media only screen and (max-width: 40em){.alert-box{padding:10px;line-height:1.3}.alert-box+.alert-box{margin-top:-10px}}@media only screen and (max-width: 40em){.small-sticky{position:fixed;z-index:999;left:0;right:0;bottom:0;margin-bottom:0 !important}}.sticky-bottom{position:fixed;z-index:999;left:0;right:0;bottom:0}.sticky-bottom .button{-webkit-box-shadow:0 0 10px rgba(0,0,0,0.3);-moz-box-shadow:0 0 10px rgba(0,0,0,0.3);-ms-box-shadow:0 0 10px rgba(0,0,0,0.3);box-shadow:0 0 10px rgba(0,0,0,0.3);border-radius:0;margin-bottom:0}.panel{border:1px solid #ddd;border-radius:5px;position:relative}.panel .panel-heading{border-bottom:1px solid rgba(0,0,0,0.15);padding-bottom:0.625rem;margin-bottom:1.25rem;text-transform:uppercase;font-weight:500;line-height:1.1;font-size:20px}.panel .panel-heading small.right,.panel .panel-heading strong.right,.panel .panel-heading .form{letter-spacing:0;font-size:14px;text-transform:none;color:#c0c0c0}.panel .panel-heading .button,.panel .panel-heading input,.panel .panel-heading select{margin-bottom:0}.panel .panel-heading .button.right,.panel .panel-heading input.right,.panel .panel-heading select.right{margin-top:-8px}.panel.bottom-cta{border-radius:5px 5px 0 0;border-bottom:0;margin-bottom:0}.panel.bottom-cta+.button{border-radius:0 0 5px 5px !important;min-width:0;padding-left:1rem !important;padding-right:1rem !important}.panel.bottom-cta+.button .fa{float:right}.panel.bottom-cta+.row .button{border-radius:0 0 5px 5px;min-width:0}.panel .panel-body .stat-heading{font-weight:500;margin-bottom:0.3125rem}.panel .panel-body .stat-body{font-size:2.375rem;font-weight:300;line-height:1.1}.panel .panel-body .stat-body.small{font-size:1.75rem}.panel .panel-body .stat-body small{margin-left:0.3125rem;font-size:1.5rem;color:#6E7271}.form-actions{text-align:right;margin-top:20px}@media only screen and (max-width: 40em){.reveal-modal{min-height:40vh;left:20px;right:20px;margin-top:20px;width:auto}}.reveal-modal.flex{max-width:none}.reveal-modal.fix{max-width:40rem}.reveal-modal .row{width:auto;margin-left:-0.9375rem;margin-right:-0.9375rem}.reveal-modal .close-reveal-modal{z-index:999;top:5px;right:10px;font-size:22px;color:#c0c0c0}.reveal-modal .form-actions{position:static;margin:1.25rem -1.25rem -1.25rem -1.25rem;padding:0.9375rem 1.25rem;box-shadow:none;border-top:1px solid #ddd}.reveal-modal .form-actions .button{margin-bottom:0 !important}.reveal-modal .form-actions .button.small{text-transform:none;margin-top:3px}.reveal-modal .form-actions .button.hollow{min-width:0}.reveal-modal .panel{margin-bottom:0}.reveal-modal .panel+.panel{margin-top:1.25rem}.reveal-modal .panel .form-actions{margin:1.25rem -1.25rem -1.25rem -1.25rem}.reveal-modal .panel.reveal-panel{padding:0}.reveal-modal .panel.reveal-panel .panel-heading{height:50px;display:flex;align-items:center;padding:0 20px;margin:0}.reveal-modal .owl-carousel .owl-stage-outer{overflow:visible}.pac-container{z-index:9999}.owl-carousel:not(.not-flex) .owl-stage{display:flex;align-items:center}.owl-carousel .owl-dots{text-align:center}.owl-carousel .owl-dots .owl-dot{display:inline-block;width:12px;height:12px;border-radius:50%;background:rgba(0,0,0,0.3);border:1px solid rgba(255,255,255,0.3);margin:0 5px}.owl-carousel .owl-dots .owl-dot:hover{background:#6E7271;cursor:pointer}.owl-carousel .owl-dots .owl-dot.active,.owl-carousel .owl-dots .owl-dot.active:hover{width:12px;height:12px;background:#ffc20e;cursor:default}.owl-carousel#gift-cards-carousel .owl-dots{display:block;margin-top:0.9375rem}.progress-bar{list-style:none;margin:0 0 2rem}.progress-bar li{display:table-cell;position:relative;text-align:center;width:33%;line-height:1}.progress-bar li .item-link{position:absolute;top:0;left:0;width:100%;height:100%;background:transparent;z-index:3}.progress-bar li span{font-weight:500;font-size:0.75rem;letter-spacing:1px;text-transform:uppercase}.progress-bar li:before{color:#FFFFFF;content:attr(data-step);display:block;margin:30px auto 10px;background:#6E7271;width:3.125rem;height:3.125rem;text-align:center;line-height:3.125rem;border-radius:100%;position:relative;z-index:2;font-size:1.25rem}.progress-bar li:after{display:block;content:'';position:absolute;top:45%;left:50%;background:#6E7271;width:100%;height:0.3125rem}.progress-bar li:last-child:after{display:none}.progress-bar li.is-complete{color:#ffc20e}.progress-bar li.is-complete:before,.progress-bar li.is-complete:after{background:#ffc20e}.progress-bar li.is-complete:before{font-family:'FontAwesome';content:"\f00c";color:#FFFFFF !important}.progress-bar li.is-active{color:#ffc20e}.progress-bar li.is-active:before{color:#FFF;background:#ffc20e}a[id*='_lesson_button']{display:block}a[id*='_lesson_button'] ul.pricing-table{-webkit-box-shadow:none !important;-moz-box-shadow:none !important;-ms-box-shadow:none !important;box-shadow:none !important}a[id*='_lesson_button']:hover{-webkit-transform:translate(0, -3px);-moz-transform:translate(0, -3px);-ms-transform:translate(0, -3px);transform:translate(0, -3px)}a[id*='_lesson_button']:hover ul.pricing-table{-webkit-box-shadow:0 10px 20px rgba(0,0,0,0.1) !important;-moz-box-shadow:0 10px 20px rgba(0,0,0,0.1) !important;-ms-box-shadow:0 10px 20px rgba(0,0,0,0.1) !important;box-shadow:0 10px 20px rgba(0,0,0,0.1) !important;border-color:#808D8E}a[id*='_lesson_button'].active ul.pricing-table,a[id*='_lesson_button'].active:hover ul.pricing-table{-webkit-box-shadow:0 8px 15px rgba(0,0,0,0.2) !important;-moz-box-shadow:0 8px 15px rgba(0,0,0,0.2) !important;-ms-box-shadow:0 8px 15px rgba(0,0,0,0.2) !important;box-shadow:0 8px 15px rgba(0,0,0,0.2) !important;background:#ffc20e !important;border-color:#ffc20e}ul.pricing-table{-webkit-transition:all 0.15s ease-in-out;-moz-transition:all 0.15s ease-in-out;-ms-transition:all 0.15s ease-in-out;transition:all 0.15s ease-in-out;background:white;border-radius:5px;margin-left:0.3125rem;margin-right:0.3125rem}ul.pricing-table.primary{-webkit-box-shadow:0 10px 20px rgba(0,0,0,0.2);-moz-box-shadow:0 10px 20px rgba(0,0,0,0.2);-ms-box-shadow:0 10px 20px rgba(0,0,0,0.2);box-shadow:0 10px 20px rgba(0,0,0,0.2);border:2px solid #ffc20e}ul.pricing-table.primary .badge-yellow{border:1px solid white}ul.pricing-table li.title{height:70px;text-transform:uppercase;font-weight:500}ul.pricing-table li.title small{display:block;font-weight:400;font-size:0.8125rem;line-height:1.625rem}ul.pricing-table li.price small{font-size:1rem;font-weight:300;margin-top:0.625rem}ul.pricing-table li.price small.saved{display:block;color:#FF6238;font-weight:500;text-transform:uppercase;margin-top:1.25rem;font-size:1.0625rem}@media only screen and (max-width: 40em){ul.pricing-table li.title,ul.pricing-table li.price{padding-left:0.625rem;padding-right:0.625rem}ul.pricing-table li.price{font-size:1.5rem}}#pricing .owl-carousel{width:auto;margin:0 -1.25rem 1.25rem}#pricing .owl-carousel .owl-stage-outer{padding:0 1.875rem}#pricing .owl-carousel .owl-stage-outer .owl-stage{padding:1.875rem 0 0}#pricing .owl-carousel .owl-stage-outer .owl-stage .owl-item .item{margin:0}.payment-label{display:flex;align-items:center;margin-bottom:0}.payment-label>input{margin:0 8px 0 0}.payment-label .payment-icon{margin-right:8px}.payment-label .payment-icon svg,.payment-label .payment-icon img{height:60px;width:auto}@media only screen and (max-width: 40em){.owl-carousel ul.pricing-table{margin-left:0;min-width:170px}}.gm-style .gm-style-pbt{color:white;font-size:1.5rem;line-height:1.2}[data-test-id='ChatWidgetMobileNotification']{z-index:1004 !important}[data-test-id='ChatWidgetMobileUnreadCountBadge']{z-index:1003 !important}[data-test-id='ChatWidgetMobileButton']{z-index:1002 !important}#loading-box{position:fixed;top:50%;left:50%;transform:translate(-50%, -50%);-webkit-transform:translate(-50%, -50%);-moz-transform:translate(-50%, -50%);-o-transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);z-index:9999;display:none}@media only screen and (max-width: 40em){.media.collapse-small>[class*='media-']{float:none;display:block;width:auto}.media.collapse-small>[class*='media-'].media-left{padding-right:0;margin-bottom:10px}.media.collapse-small>[class*='media-'].media-right{padding-left:0;margin-bottom:10px}.table-block.collapse-small>.table-cell,.collapse-small.progress-bar>.table-cell{display:block;height:auto;padding-top:1.875rem;padding-bottom:1.875rem}}@media only screen and (min-width: 40.0625em) and (max-width: 64em){.table-block.collapse-medium>.table-cell,.collapse-medium.progress-bar>.table-cell{display:block;height:auto;padding-top:1.875rem;padding-bottom:1.875rem}}@media only screen and (max-width: 40em), only screen and (min-width: 40.0625em) and (max-width: 64em){.well{padding:1rem}.table-block.large .table-cell,.large.progress-bar .table-cell{padding:1.875rem}.table-block.medium .table-cell,.medium.progress-bar .table-cell{padding:0.9375rem}.table-block.small .table-cell,.small.progress-bar .table-cell{padding:0.625rem}.table-block.tiny .table-cell,.tiny.progress-bar .table-cell{padding:0.46875rem}.table-block>.table-cell,.progress-bar>.table-cell{padding:0.75rem}}body[class*='admin']{color:#212A37;line-height:1.2}body[class*='admin'] #main{padding-left:192px !important}body[class*='admin'] #main section.section{padding:1rem 0.5rem !important}body[class*='admin'] nav#sidenav{width:192px}body[class*='admin'] nav#sidenav ul>li>a{text-align:left;padding:0.375rem 0.3125rem 0.375rem 0.5rem;font-size:0.875rem;font-weight:400}body[class*='admin'] nav#sidenav ul>li>a svg{display:inline-block;vertical-align:middle;width:1rem;height:1rem;margin:-0.125rem 0.1875rem 0 0}body[class*='admin'] nav#sidenav .accordion .accordion-navigation{border:none}body[class*='admin'] nav#sidenav .accordion .accordion-navigation a:hover{background:#efefef}body[class*='admin'] nav#sidenav .accordion .accordion-navigation a:after{display:none !important}body[class*='admin'] nav#sidenav .accordion .content{background:none;padding-left:3px;margin-top:-2px;margin-bottom:2px}body[class*='admin'] nav#sidenav .accordion .content ul{list-style:none}body[class*='admin'] nav#sidenav .accordion .content ul>li>a{display:block;padding-top:4px;padding-bottom:4px;color:#454545;font-size:0.8125rem}body[class*='admin'] aside.search-filters{width:380px}body[class*='admin'] aside.search-filters form .radio,body[class*='admin'] aside.search-filters form .checkbox{margin-bottom:0.5rem}body[class*='admin'] #main .panel .panel-heading .right .button,body[class*='admin'] #main .panel .panel-heading .button.right{margin:-0.5rem 0 0 !important;padding:0.3125rem 0.625rem !important;text-transform:none}body[class*='admin'] #main .panel .panel-body .button:last-of-type{margin-bottom:0}body[class*='admin']:not([class*='call_centre']) #main .button:not(.tiny){padding:0.75rem 1.25rem !important}body[class*='admin']:not([class*='call_centre']) #main .button:not(.tiny).right{margin-left:0.625rem}body[class*='admin'] table:not(.table-condensed):not(.no-hover) tr:hover{background:#f5f4f3}body[class*='admin'] table:not(.table-condensed) thead tr:hover{background:none !important}body[class*='admin'] table:not(.table-condensed) tr th small,body[class*='admin'] table:not(.table-condensed) tr th .label,body[class*='admin'] table:not(.table-condensed) tr th body.booking-view_products #product_selection .panel .panel-body label.sku-option .saved,body.booking-view_products #product_selection .panel .panel-body label.sku-option body[class*='admin'] table:not(.table-condensed) tr th .saved,body[class*='admin'] table:not(.table-condensed) tr th #learner-price-table .lessons .saved,#learner-price-table .lessons body[class*='admin'] table:not(.table-condensed) tr th .saved,body[class*='admin'] table:not(.table-condensed) tr td small,body[class*='admin'] table:not(.table-condensed) tr td .label,body[class*='admin'] table:not(.table-condensed) tr td body.booking-view_products #product_selection .panel .panel-body label.sku-option .saved,body.booking-view_products #product_selection .panel .panel-body label.sku-option body[class*='admin'] table:not(.table-condensed) tr td .saved,body[class*='admin'] table:not(.table-condensed) tr td #learner-price-table .lessons .saved,#learner-price-table .lessons body[class*='admin'] table:not(.table-condensed) tr td .saved{font-size:10px;padding:4px;margin:0 2px 3px 0}body[class*='admin'] table:not(.table-condensed) tr th{text-transform:uppercase;font-size:11px;line-height:1.1;vertical-align:top;min-width:50px;max-width:300px}body[class*='admin'] table:not(.table-condensed) tr th.highlighted{border-width:2px 2px 0 2px;border-style:solid;border-color:#ddd}body[class*='admin'] table:not(.table-condensed) tr td{font-size:11px;padding-top:5px;padding-bottom:5px;color:#454545;line-height:1.2}body[class*='admin'] table:not(.table-condensed) tr td.highlighted{border-width:0 2px 0 2px;border-style:solid;border-color:#000000}body[class*='admin'] table:not(.table-condensed) tr td a{color:#000000}body[class*='admin'] table:not(.table-condensed) .f-dropdown{-webkit-box-shadow:0 3px 15px rgba(0,0,0,0.3);-moz-box-shadow:0 3px 15px rgba(0,0,0,0.3);-ms-box-shadow:0 3px 15px rgba(0,0,0,0.3);box-shadow:0 3px 15px rgba(0,0,0,0.3)}body[class*='admin'] table:not(.table-condensed) .drag-icon{color:#6E7271;cursor:move;text-align:center}body[class*='admin'] table:not(.table-condensed) .drag-icon:hover{color:#ffc20e}body[class*='admin'] .fixed-sidebar{position:fixed;width:10px;height:110px;z-index:10;right:0;top:50%;background:#ffc20e;padding:10px 15px 10px 10px;-webkit-transition:all 0.3s ease;-moz-transition:all 0.3s ease;-ms-transition:all 0.3s ease;transition:all 0.3s ease;-webkit-box-shadow:inset 0 -3px 5px rgba(0,0,0,0.2);-moz-box-shadow:inset 0 -3px 5px rgba(0,0,0,0.2);-ms-box-shadow:inset 0 -3px 5px rgba(0,0,0,0.2);box-shadow:inset 0 -3px 5px rgba(0,0,0,0.2)}body[class*='admin'] .fixed-sidebar .sidebar-icon{position:absolute;transform:translate(0, -50%);left:0;top:50%;font-size:24px}body[class*='admin'] .fixed-sidebar a.goto-anchor{display:block;color:#000000;opacity:0;width:0;white-space:nowrap}body[class*='admin'] .fixed-sidebar a.goto-anchor:hover{text-decoration:underline}body[class*='admin'] .fixed-sidebar:hover{width:285px}body[class*='admin'] .fixed-sidebar:hover .sidebar-icon{display:none}body[class*='admin'] .fixed-sidebar:hover .goto-anchor{opacity:1;width:100%}body[class*='admin'] .graph-button-group{display:flex;align-items:center;justify-content:flex-end}body[class*='admin'] .graph-button-group .graph-button{color:#FFFFFF;background-color:#DFDFDF;border-radius:5px;padding:4px;font-size:12px;line-height:1.5;margin:0 2px 5px 2px}body[class*='admin'] .graph-button-group .graph-button:hover{background-color:#ffc20e;transition:none;transform:none}body[class*='admin'] .graph-button-group .graph-button.active{background-color:#ACACAC !important}body[class*='admin'] #main .advance-search{position:relative;margin-bottom:15px;max-width:720px}body[class*='admin'] #main .advance-search input.select2-search__field{width:100% !important}body[class*='admin'] #main .advance-search.has-search-icon input.main-search-input,body[class*='admin'] #main .advance-search.has-search-icon select.main-search-input{padding-left:45px !important;padding-right:140px !important;margin-bottom:0 !important}body[class*='admin'] #main .advance-search.has-search-icon:before{position:absolute;z-index:999;top:11px;left:12px;font-family:'FontAwesome';font-size:18px;content:"\f002";color:#808D8E}body[class*='admin'] #main .advance-search .f-dropdown .text-right .button{margin-top:10px}body[class*='admin'] #main .advance-search .f-dropdown .text-right .button.hollow.gray,body[class*='admin'] #main .advance-search .f-dropdown .text-right body[class*='blog_posts'] article .updated svg.button.hollow,body[class*='blog_posts'] article .updated body[class*='admin'] #main .advance-search .f-dropdown .text-right svg.button.hollow{border:none !important;box-shadow:none}body[class*='admin'] #main .advance-search .f-dropdown .text-right .button.hollow.gray:hover,body[class*='admin'] #main .advance-search .f-dropdown .text-right body[class*='blog_posts'] article .updated svg.button.hollow:hover,body[class*='blog_posts'] article .updated body[class*='admin'] #main .advance-search .f-dropdown .text-right svg.button.hollow:hover{background:#efefef}body[class*='admin'] #main .advance-search .button:not(.tiny){text-transform:none;padding:10px !important}body[class*='admin'] #main .advance-search .clear-search{position:absolute;top:0;right:130px}body[class*='admin'] #main .advance-search .clear-search a{margin-top:7px;display:inline-block;border-radius:100%;width:30px;height:30px;padding:5px}body[class*='admin'] #main .advance-search .clear-search a:hover{background:#efefef;-webkit-transform:none;-moz-transform:none;-ms-transform:none;transform:none}body[class*='admin'] #main .advance-search a.more-filters{position:absolute;top:0;right:0;line-height:1;padding:15px 15px 12px 15px;color:#808D8E;font-size:14px}body[class*='admin'] #main .advance-search a.more-filters svg *{fill:#808D8E}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters{width:100%;max-width:unset;left:0 !important;margin-top:-2px !important;padding:15px;-webkit-box-shadow:0 3px 8px rgba(0,0,0,0.15);-moz-box-shadow:0 3px 8px rgba(0,0,0,0.15);-ms-box-shadow:0 3px 8px rgba(0,0,0,0.15);box-shadow:0 3px 8px rgba(0,0,0,0.15)}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters:focus{outline:none}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters:before,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters:after{display:none}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters label,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input:not(.button),body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-container{margin-bottom:15px !important;line-height:1.2 !important;border-radius:0 !important}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input:not(.button),body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection{-webkit-box-shadow:none;-moz-box-shadow:none;-ms-box-shadow:none;box-shadow:none;padding:3px !important;border:0;border-radius:0 !important;border-bottom:1px solid #ddd;font-size:0.8rem !important;height:1.4rem !important;min-height:0}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select:focus,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input:not(.button):focus,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection:focus{border-color:#ffc20e}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select.not_chosen,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input:not(.button).not_chosen,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection.not_chosen{color:#ccc}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select .select2-search__field,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input:not(.button) .select2-search__field,body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection .select2-search__field{margin:0 !important;padding:0 !important;border:0 !important;height:auto !important}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection{height:auto !important}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters .select2-selection .select2-selection__choice{margin:0 5px 5px 0}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters select{padding-top:0 !important;padding-bottom:0 !important}body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input[type='radio'],body[class*='admin'] #main .advance-search a.more-filters+.f-dropdown#more-filters input[type='checkbox']{height:10px !important;margin-top:6px}body[class*='admin'] #main .advance-search .label-column{padding-top:0 !important;padding-bottom:0 !important;height:1.4rem !important;display:table}body[class*='admin'] #main .advance-search .label-column>label{display:table-cell;vertical-align:middle;color:#454545;font-size:0.8rem !important;font-weight:normal}body[class*='admin'] .timeline{position:relative;width:660px;margin:0 auto;margin-top:20px;padding:1em 0;list-style-type:none}body[class*='admin'] .timeline:before{position:absolute;left:50%;top:0;content:" ";display:block;width:6px;height:100%;margin-left:-3px;background:#efefef;z-index:5}body[class*='admin'] .timeline li{padding:15px 0}body[class*='admin'] .timeline li:after{content:"";display:block;height:0;clear:both;visibility:hidden}body[class*='admin'] .timeline li .flag{position:relative;display:inline;background:#efefef;padding:6px 10px;border-radius:5px;font-weight:600;text-align:left;-webkit-box-shadow:0 1px 3px rgba(0,0,0,0.15);-moz-box-shadow:0 1px 3px rgba(0,0,0,0.15);-ms-box-shadow:0 1px 3px rgba(0,0,0,0.15);box-shadow:0 1px 3px rgba(0,0,0,0.15)}body[class*='admin'] .timeline li .direction-l{position:relative;width:296px;float:left;text-align:right}body[class*='admin'] .timeline li .direction-l .flag:before{position:absolute;top:50%;right:-40px;content:" ";display:block;width:12px;height:12px;margin-top:-10px;background:#FFFFFF;border-radius:10px;border:4px solid #6E7271;z-index:10}body[class*='admin'] .timeline li .direction-r{position:relative;width:296px;float:right}body[class*='admin'] .timeline li .direction-r .flag:before{position:absolute;top:50%;right:-40px;content:" ";display:block;width:12px;height:12px;margin-top:-10px;background:#FFFFFF;border-radius:10px;border:4px solid #6E7271;z-index:10;left:-40px}body[class*='admin'] .timeline li .flag-wrapper{position:relative;display:inline-block;text-align:center}body[class*='admin'] .timeline li .time-wrapper{display:inline;line-height:1em;font-size:0.66666em;color:#fa5050;vertical-align:middle}body[class*='admin'] .timeline li .direction-l .time-wrapper{float:left}body[class*='admin'] .timeline li .direction-r .time-wrapper{float:right}body[class*='admin'] .timeline li .direction-r .desc{margin:1em 0 0 0.75em}body[class*='admin'] .timeline li .time{display:inline-block;padding:5px;background:#efefef}body[class*='admin'] .timeline li .desc{margin:1em 0.75em 0 0;font-size:0.77777em;font-style:italic;line-height:1.5em}#overlay-loading-fullscreen{position:fixed;z-index:9998;top:0;bottom:0;left:0;right:0;background:rgba(0,0,0,0.4)}#overlay-loading-fullscreen:after{-webkit-transform:translate(-50%, -50%);-moz-transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);transform:translate(-50%, -50%);position:absolute;top:50%;left:50%;width:100%;position:fixed;z-index:9999;text-align:center;display:block;margin-top:50px;content:'LOADING';letter-spacing:1px;color:white;font-size:0.875rem;font-weight:bold}body.app header#header nav.top-bar li a:not(.button){font-weight:500 !important}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main{background:#f5f4f3;padding-left:120px}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main footer#footer{padding:1.5rem 0;margin:0 1.5rem;border-top:1px solid rgba(0,0,0,0.1)}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .count-sum{position:absolute;top:-10px;left:3px;color:#FFFFFF;background:#ffc20e;font-size:10px;padding:3px;line-height:1;border-radius:5px;margin-bottom:0}@media only screen and (min-width: 40.0625em){body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .main-content{min-height:calc(100vh - 70px - 75px)}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main footer#footer{height:70px}}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main section.section{padding:2rem 1rem}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar{margin:0;position:relative;padding-left:45px;list-style:none}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item{position:relative}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item:not(:last-child){padding-bottom:20px}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item::before{display:inline-block;content:'';position:absolute;left:-30px;height:100%;width:10px;border-left:1px solid #6E7271}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item::after{content:'';display:inline-block;position:absolute;top:5px;left:-34px;width:10px;height:10px;border-radius:50%;background-color:#808D8E}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item.yellow::before{border-left:1px solid #ffc20e}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item.yellow::after{background-color:#ffc20e}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item.black::before{border-left:1px solid #000000}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main .v-progress-bar .item.black::after{background-color:#000000}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #learner-price-table{border:1px solid #ddd;margin:0 0 1rem}@media only screen and (max-width: 40em), only screen and (min-width: 40.0625em) and (max-width: 64em){body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index){padding-top:0}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main{padding-left:0 !important}body.app:not(.public_instructors-index):not(.public_instructors-instructor_time_base_index) #main section.section{padding:1rem 0}}body[class*='blog_posts'] article .excerpt,body[class*='blog_posts'] article .excerpt *{margin-bottom:5px}body[class*='blog_posts'] article .author,body[class*='blog_posts'] article .updated{color:#6E7271;font-size:0.8125rem;letter-spacing:1px;font-weight:300}body[class*='blog_posts'] article .updated svg{display:inline-block;vertical-align:middle;margin:-3px 2px 0 15px}body[class*='blog_posts'] article .featured-image{margin-bottom:1rem}@media only screen and (min-width: 64.0625em){body[class*='blog_posts'] article .featured-image{float:right;width:50%;height:auto;margin:5px 0 1rem 1rem}}body[class*='blog_posts'] article .cta-banner{display:block;margin:30px -20px}@media only screen and (min-width: 64.0625em){body[class*='blog_posts'] article .cta-banner{margin-left:-30px;margin-right:-30px}}body[class*='blog_posts'] article .cta-banner img{width:100%;height:auto}.fc .fc-agendaWeek-view .fc-day-header.fc-today:after{display:block;content:'TODAY';background:#ffc20e;padding:2px;font-size:11px}.fc .fc-today{position:relative;background-color:transparent !important}.fc .fc-today .fc-day-number{background:#ffc20e;border-radius:100%}.fc .fc-day-number{margin:3px;padding:2px 0;min-width:22px;text-align:center}.fc .fc-toolbar .fc-center h2{margin-top:5px;font-size:1.5rem !important}.fc .fc-toolbar .fc-state-default,.fc .fc-toolbar .fc-state-default:hover,.fc .fc-toolbar .fc-state-default:focus{font-size:12px;color:#6E7271;vertical-align:middle;border-radius:5px;font-weight:500;letter-spacing:1px;text-transform:uppercase;--box-shadow-color:rgba(0,0,0,0.6);-webkit-box-shadow:inset 0 -4px 4px -4px var(--box-shadow-color);-moz-box-shadow:inset 0 -4px 4px -4px var(--box-shadow-color);-ms-box-shadow:inset 0 -4px 4px -4px var(--box-shadow-color);box-shadow:inset 0 -4px 4px -4px var(--box-shadow-color);font-weight:400;padding:0.5rem 0.625rem;min-width:0 !important;white-space:pre;border-color:#6E7271;background:white;height:auto;margin:0 3px;line-height:1}.fc .fc-toolbar .fc-state-default:hover,.fc .fc-toolbar .fc-state-default:hover:hover,.fc .fc-toolbar .fc-state-default:focus:hover{--box-shadow-color:transparent;-webkit-transform:translate(0, 2px);-moz-transform:translate(0, 2px);-ms-transform:translate(0, 2px);transform:translate(0, 2px)}.fc .fc-toolbar .fc-state-default:hover.no-hover,.fc .fc-toolbar .fc-state-default:hover.disabled,.fc .fc-toolbar .fc-state-default:hover[disabled],.fc .fc-toolbar .fc-state-default:hover:hover.no-hover,.fc .fc-toolbar .fc-state-default:hover:hover.disabled,.fc .fc-toolbar .fc-state-default:hover:hover[disabled],.fc .fc-toolbar .fc-state-default:focus:hover.no-hover,.fc .fc-toolbar .fc-state-default:focus:hover.disabled,.fc .fc-toolbar .fc-state-default:focus:hover[disabled]{-webkit-transform:none;-moz-transform:none;-ms-transform:none;transform:none;-webkit-box-shadow:none;-moz-box-shadow:none;-ms-box-shadow:none;box-shadow:none;cursor:default}.fc .fc-toolbar .fc-state-default.disabled,.fc .fc-toolbar .fc-state-default[disabled],.fc .fc-toolbar .fc-state-default:hover.disabled,.fc .fc-toolbar .fc-state-default:hover[disabled],.fc .fc-toolbar .fc-state-default:focus.disabled,.fc .fc-toolbar .fc-state-default:focus[disabled]{background-color:#878c8b !important;color:rgba(255,255,255,0.8) !important}.fc .fc-toolbar .fc-state-default,.fc .fc-toolbar .fc-state-default.disabled,.fc .fc-toolbar .fc-state-default[disabled],.fc .fc-toolbar .fc-state-default:hover,.fc .fc-toolbar .fc-state-default:hover.disabled,.fc .fc-toolbar .fc-state-default:hover[disabled],.fc .fc-toolbar .fc-state-default:focus,.fc .fc-toolbar .fc-state-default:focus.disabled,.fc .fc-toolbar .fc-state-default:focus[disabled]{background-color:transparent;border-color:#6E7271;color:#6E7271}.fc .fc-toolbar .fc-state-default:hover,.fc .fc-toolbar .fc-state-default:focus,.fc .fc-toolbar .fc-state-default:hover:hover,.fc .fc-toolbar .fc-state-default:hover:focus,.fc .fc-toolbar .fc-state-default:focus:hover,.fc .fc-toolbar .fc-state-default:focus:focus{border-color:#616564;color:#616564}.fc .fc-toolbar .fc-state-default.fc-state-active{background:#efefef;border-color:#808D8E;color:#808D8E}.fc .fc-toolbar .fc-corner-left{border-top-left-radius:5px !important;border-bottom-left-radius:5px !important}.fc .fc-toolbar .fc-corner-right{border-top-right-radius:5px !important;border-bottom-right-radius:5px !important}.fc .fc-event.unconfirmed_lesson,.fc .fc-event.proposed_lesson{background-color:#efefef !important;border-color:#ddd !important;color:#808D8E !important}.fc .fc-event.lesson{background-color:#ffc20e !important;border-color:#f4b600 !important;color:#212A37 !important}.fc .fc-event.lesson .fc-time:before{font-family:'FontAwesome';content:"\f00c";color:#2fa750;margin-right:5px}.fc .fc-event.proposed_lesson .fc-time:before{font-family:'FontAwesome';content:"\f252";color:#FF6238;margin-right:5px}.fc .fc-scroller .fc-time{font-size:13px;font-weight:500;color:#212A37}.fc .fc-scroller .fc-time-grid .fc-slats td{height:11px !important}@media only screen and (max-width: 40em){.calendar-section{padding:1rem 0 !important}.fc .fc-toolbar{margin-bottom:10px}.fc .fc-toolbar .fc-center{display:block;text-align:center}.fc .fc-toolbar .fc-center h2{float:none;padding-top:5px;font-size:20px !important;}.fc .fc-toolbar .fc-left,.fc .fc-toolbar .fc-right{margin-bottom:5px;display:inline-block !important}.fc .fc-toolbar .fc-left button.fc-today-button,.fc .fc-toolbar .fc-right button.fc-today-button{width:0;height:0;border:0;padding:0;overflow:hidden}.fc .fc-event .fc-time{white-space:normal}.fc .fc-view-container .fc-body .fc-scroller{height:auto !important}.fc .fc-view-container .fc-body .fc-scroller .fc-time-grid .fc-slats td{height:10px !important;font-size:14px}body.app.calendar-index .fc .fc-toolbar .fc-center:before{display:block;content:"";clear:both}}body[class*='call_centre']:not(.call_centre-pay_later) table tr th,body[class*='call_centre']:not(.call_centre-pay_later) table tr td{vertical-align:top}body[class*='call_centre']:not(.call_centre-pay_later) p.empty{text-align:center;padding:1.25rem}body[class*='call_centre']:not(.call_centre-pay_later) #main{padding-left:360px !important;padding-right:360px !important}body[class*='call_centre']:not(.call_centre-pay_later) #main,body[class*='call_centre']:not(.call_centre-pay_later) #main .main-content{min-height:100vh !important}
</style>
@endsection

@section('script')
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/libs/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>

    <script>

    function openCal(inst_id, inst_name, search_id){
        //$('#search_modal').modal('hide');
        $('#calendar').html('');

        //let inst_id = $(this).attr('data-id');
        $('#availability_modal').modal('show');
        $('#show_name').html('Book With '+inst_name);
        $('#book_btn').attr("href", "book-online/"+search_id+"/instructor/"+inst_id);

        jQuery.ajax({
            url: '{{ url('load_events') }}',
            type: 'POST',
            data: {
                type: 'check_availability',
                id: inst_id,
            },
            success: function(response) {
                myCalendar(response.events, response.avl);
            }
        });

        return false;
    }

    function myCalendar(events_ar, avl_ar){

        let ev = events_ar;
        let avl = avl_ar;
        console.log(avl);
        //Object.assign({}, avl);
        //const myJSON = JSON.stringify(avl);

        var today = moment().format("YYYY-MM-DD");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'timeGrid','momentPlugin' ],
            //height: 650,
            contentHeight:"auto",
            minTime: "05:00:00",
            maxTime: "22:00:00",
            columnHeader: true,
            columnHeaderText: function(date) {
                    return moment(date).format('ddd DD/M');
                },
            //viewSkeletonRender: renderViewColumns,
            header: {
                left: 'prev',
                right: 'next',
                center: 'title',
            },
            initialView: 'timeGridWeek',
            defaultDate: today,
            editable: false,
            navLinks: false, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events:ev,
            views: {
                month: {
                    columnFormat: 'ddd' // set format for month here
                },
                week: {
                    columnFormat: 'ddd D/M' // set format for week here
                },
                day: {
                    columnFormat: 'ddd' // set format for day here
                }
            },
            businessHours: avl,
        });

        calendar.render();
    }

        $(document).ready(function (){
            $('#type_checkbox').change(function() {
                if(this.checked) {
                    $("#hidden_type").val("manual");
                    $(".secondC").addClass("active");
                    $(".firstC").removeClass("active");
                }    
                else{
                    $("#hidden_type").val("auto");
                    $(".secondC").removeClass("active");
                    $(".firstC").addClass("active");
                }
            });



            @if($search_id)
            setTimeout(function() {
                $('#searchForm').submit();
            }, 2000);

            @endif


            $('.select2').select2({
                placeholder: 'Enter your suburb',
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

            //$('#search_modal').modal('show');

            $('#searchForm').submit(function (){

                $('.fa-spinner').removeClass('hidden');

                var data = new FormData(this);

                data.append("search_id", 1);

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){

                            // $('.total_inst').html(res.total);
                            // $('.final_type').html(res.t_type);

                            // $('.area').text(res.title);

                            // $('#load_instructors').html(res.view);
                            // $('#search_modal').modal('show');

                           // window.history.replaceState("", "", "{{url('/')}}/"+res.search_id);
                           var search_url = "{{url('/instructors/search_id')}}/"+res.search_id;
                            window.location = search_url;

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



            $('#availability_modal').on('hidden.bs.modal', function () {
              $('#search_modal').modal('hide');
            })

        })


    </script>
@endsection
