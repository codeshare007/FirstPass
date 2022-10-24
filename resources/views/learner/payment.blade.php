@extends('layouts.app_guest')
@section('content')
<link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://www.google.com/recaptcha/api.js"></script>
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
            border: 1px solid #ddd;
            border-radius: 5px;
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

        .select2-selection__rendered {
            line-height: 35px !important;
        }
        .select2-container .select2-selection--single {
            height: 40px !important;
            border-color: #e8e8eb !important;
        }
        .select2-selection__arrow {
            height: 40px !important;
        }
    </style>

    <section class="" style="height: 130px">
    <div class="container"></div>
    </section>

    <section class="more_inst">
        <div class="container-cr">
            <div class="row">
                <div class="col-md-12">
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
                                                <span class="meter bg-oil" style="width: 86%">
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

    <section class="ls container container-cr mt-4">
        <div class="row c-gutter-8">
            <div class="col-sm-7">

                @if(auth()->user())
                    @if(auth()->user()->type !='learner')
                    <div class="alert alert-danger">
                        <p><strong class="text-white">Alert!</strong> You haven't permission to proceed! </p>
                    </div>
                    @endif
                @endif
                <form method="post" id="payment-form">
                    <input type="hidden" name="search_id" value="{{ $search_id }}">
                    <?php
                    $step_5 = $search->step_5;
                    $s = json_decode($step_5);
                    $address = '';
                    if( is_object($s) ){
                        $address = $s->address;
                        $address_detail = $s->address_detail;
                    }
                    ?>

                    <input type="hidden" value="{{ @$address_detail->city }}" id="truecity" name="address_detail[city]">
                    <input type="hidden" value="{{ @$address_detail->state }}" id="administrative_area_level_1" name="address_detail[state]">
                    <input type="hidden" value="{{ @$address_detail->country }}" id="country" name="address_detail[country]">
                    <input type="hidden" value="{{ @$address_detail->lat }}" id="lat" name="address_detail[lat]">
                    <input type="hidden" value="{{ @$address_detail->lng }}" id="lng" name="address_detail[lng]">
                    <input type="hidden" value="{{ @$address_detail->country_code }}" id="countryCode" name="address_detail[country_code]"/>
                    <input type="hidden" value="{{ @$address_detail->query }}" id="query" name="address_detail[query]"/>
                    <input type="hidden" value="{{ @$address_detail->postcode }}" id="postcode" name="address_detail[postcode]"/>
                    <input type="hidden" value="{{ @$address_detail->suburb }}" id="suburb" name="address_detail[suburb]"/>

                    <div class="box-shadow mb-20 teaser p-3">
                        <h5 class="text-center title text-uppercase">Billing Details</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Billing name<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" @if($user) value="{{ $user->name }} {{ $user->lname }}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Address<span class="text-danger">*</span></label>
                            <input id="searchTextField" class="form-control" type="text" name="address" value="{{ $address }}" >
                            <small class=" address_hint" data-original-title="" data-toggle="tooltip" data-title="Address details"> <i class="fa fa-address-book"></i> <strong> Detail: </strong> city: {{ @$address_detail->city }}, postcode: {{ @$address_detail->postcode }}, suburb: {{ @$address_detail->suburb }} </small>
                        </div>

                        <div class="alert alert-danger error-alert hidden mt-4 mb-4">
                            <p><strong class="text-white">Please fix following errors</strong></p>
                            <ul class="error_body"></ul>
                        </div>

                        <hr>
                        <h5 class="text-center title text-uppercase mt-0">Billing Details</h5>

                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element"class="form-control" style="width: 100%;display: block;padding: 15px; height: 50px; border-radius: 5px;">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>

                            <div class="w-100">
                                <img src="{{ asset('assets/images/payments.png') }}" alt="">
                            </div>

                        </div>

                        <div class="form-groups mt-10 w-100">
                            <button class="btn btn-lg btn-block btn-warning"> <span class="fa fa-spin fa-spinner hidden"></span> CONTINUE </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-5">
                <div class="p-3 box-shadow mb-20 teaser" style="min-height: 100px">
                    <div class="col-md-12">
                        <div class="row">
                            <h6 class="title"><i class="fa fa-shopping-cart"></i> YOUR SELECTED PACKAGE</h6>

                            <?php
                            $total=0;
                            $search_step_2 = json_decode($search->step_2);
                            if(is_array($search_step_2)){
                                foreach ($search_step_2 as $item){
                            ?>
                                @if($item == 'test')
                                <?php
                                $total = $total+$test_package->price;
                                ?>
                                    <div class="row sd">
                                        <div class="col-md-8">Driving Test</div>
                                        <div class="col-md-4 text-right">${{ $test_package->price }}</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr class="w-100 m-0">
                                @endif

                                @if($item == 'lesson')
                                    <?php

                                    $hour=$price=0;
                                    $search_step_3 = json_decode($search->step_3);
                                    //print_r($search_step_3);
                                    $hour = @$search_step_3->hour;
                                    $price = @$hour*$search_step_3->hourly_rate;
                                    $total = $total+$price;
                                    ?>
                                        <div class="row sd">
                                            <div class="col-md-8">Driving Lesson x {{ $hour }} hour</div>
                                            <div class="col-md-4 text-right">${{ $price }}</div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr class="w-100 m-0">
                                @endif
                                
                            <?php
                                }
                            }
                            ?>
                            <div class="row sd">
                                <div class="col-md-8"><strong>Total</strong></div>
                                <div class="col-md-4 text-right"><strong>${{ $total }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <section id="video" class="ls">
        <div class="container">
            <div class="clearfix"></div>
        </div>
    </section>



@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.6"></script>
    <script>
        (function() {
            var placesAutocomplete = places({
                appId: 'plDAML4GXDMT',
                apiKey: '384c249023210b735270be1a32b31358',
                minLength: 3,
                container: document.querySelector('#searchTextField'),
                templates: {
                    value: function(suggestion) {
                        return suggestion.name;
                    }
                }
            }).configure({
                type: 'address',
                language: 'en',
                countries: ['au'],
            });
            placesAutocomplete.on('change', function resultSelected(e) {
                console.log(e);
                document.querySelector('#truecity').value = e.suggestion.city || '';
                document.querySelector('#country').value = e.suggestion.country || '';
                document.querySelector('#administrative_area_level_1').value = e.suggestion.administrative || '';
                document.querySelector('#countryCode').value = e.suggestion.countryCode || '';
                document.querySelector('#lat').value = e.suggestion.latlng.lat || '';
                document.querySelector('#lng').value = e.suggestion.latlng.lng || '';
                document.querySelector('#query').value = e.query || '';
                document.querySelector('#postcode').value = e.suggestion.postcode || '';
                document.querySelector('#suburb').value = e.suggestion.suburb || '';
                $('.address_hint').html(e.query+ '<strong> Detail: </strong> city: '+ e.suggestion.city+ ', postcode: '+e.suggestion.postcode+ ', suburb: '+ e.suggestion.suburb).removeClass('hidden');

            });
        })();

        $(document).ready(function (){

            @if(auth()->user())
                @php
                    $dob = explode('-',$user->dob);
                @endphp
                $('select[name=year]').val({{ @$dob[0] }});
                $('select[name=month]').val({{ @$dob[1] }});
                $('select[name=day]').val({{ @$dob[2] }});
            @endif



            //=== sticky continue click
            $(".button_fix_area .btn").click(function(){
                $('#payment-form').submit();
            });
            //===========

        });
    </script>

    <!-- stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        var stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            $('#loading').show();
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            var data = new FormData(form);

            $.ajax({
                url: "{{ route('stripe_payment') }}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(res){
                    $('#loading').hide();

                    if(res.success == true)
                    {
                        swal("Good!", res.message, "success");
                        let url = "{{ url("/home") }}";
                        window.location.href=url;
                    }else
                    {
                        swal("Note!", res.message, "warning");
                    }
                },
                error: function (res) {
                    swal("Note!", res.message, "warning");
                }
            });
            return false;
        }

    </script>
@endsection
