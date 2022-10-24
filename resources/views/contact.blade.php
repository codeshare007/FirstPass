@extends('layouts.app_guest')
@section('content')

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
                                                Contact Us
                                            </h1><br>
                                            <h1 class="after-title"></h1>
                                        </div>
                                        <div class="intro_layer" data-animation="fadeInUp">
                                            <ul class="slider-list">
                                                <li>Our team is happy to answer your questions.</li>
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

    <section class="ls ms s-py-75">
        <div class="container">
            <div class="row">

                <div class="divider-60 d-none d-xl-block"></div>

                <div class="col-lg-8 animate" data-animation="scaleAppear">

                    <div class="hero-bg p-40">

                        <form id="contact-form" class="contact-form c-mb-15 c-gutter-15">

                            <div class="row">

                                <div class="col-sm-12">
                                    <h2>Contact Form</h2>
                                    <small>Fill out the form and we'll be in touch.</small>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label for="name">First Name <span class="required">*</span></label>
                                        <input type="text" name="f_name" required class="form-control" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label for="phone">Last Name<span class="required">*</span></label>
                                        <input type="text" name="l_phone" required class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label for="email">Email address<span class="required">*</span></label>
                                        <input type="email" name="email" required class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label>Mobile<span class="required">*</span></label>
                                        <input type="number" name="mobile_number" required class="form-control" placeholder="Enter Mobile Number">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label>Postcode<span class="required">*</span></label>
                                        <input type="text" name="postcode" required class="form-control" placeholder="Enter Post Code">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group has-placeholder">
                                        <label>Subject<span class="required">*</span></label>
                                        <input type="text" name="subject" required class="form-control" placeholder="Enter Subject">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="form-group has-placeholder">
                                        <label for="message">Tell us how we can help</label>
                                        <textarea aria-required="true" rows="6" cols="45" required name="message" id="message" class="form-control" placeholder="Tell us how we can help"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12">
                                    <label><small>I am ...</small></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" required name="user_type" id="inlineRadio1" value="learner_driver">
                                        <label class="form-check-label" for="inlineRadio1"><small>Learner driver</small></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="inlineRadio2" value="driving_instructor">
                                        <label class="form-check-label" for="inlineRadio2"><small>Driving instructor</small></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="user_type" id="inlineRadio3" value="other">
                                        <label class="form-check-label" for="inlineRadio3"><small>Other</small></label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="form-group has-placeholder mt-25">
                                        <button type="submit" id="contact_form_submit" name="contact_submit" class="btn btn-outline-darkgrey btn-block">Send Message
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <!--.col-* -->

                <div class="col-lg-4 animate" data-animation="scaleAppear">
                    <div class="hero-bg p-40">

                        <h4>Contact Info</h4>

                        <div class="media mb-20">
                            <div class="icon-styled color-main fs-20">
                                <i class="fa fa-map-marker"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="mt-0">
                                    Address:
                                </h6>
                                <p>
                                    567 Jacksotts street, San Diego, CA
                                </p>
                            </div>
                        </div>

                        <div class="media mb-20">
                            <div class="icon-styled color-main fs-20">
                                <i class="fa fa-phone"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="mt-0">
                                    Phone:
                                </h6>
                                <p>
                                    1(800)168-2159
                                </p>
                            </div>
                        </div>

                        <div class="media mb-20">
                            <div class="icon-styled color-main fs-20">
                                <i class="fa fa-pencil"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="mt-0">
                                    Email:
                                </h6>
                                <p>
                                    mail@example.com
                                </p>
                            </div>
                        </div>

                        <h4>Social Links</h4>

                        <div class="social-icons">

                            <a href="#" class="fa fa-facebook" title="facebook"></a>
                            <a href="#" class="fa fa-twitter" title="twitter"></a>
                            <a href="#" class="fa fa-instagram" title="instagram"></a>
                            <a href="#" class="fa fa-google" title="google"></a>

                        </div>

                    </div>
                </div>
                <!--.col-* -->


                <div class="divider-40 d-none d-xl-block"></div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{ route('save-contact-form') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success')
                                .then(function() {
                                    location.reload();
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
