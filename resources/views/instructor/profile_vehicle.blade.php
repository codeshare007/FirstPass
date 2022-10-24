@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #4798e8;
        }
        .select2-selection--single{
            height: 37px !important;
            border: 1px solid #e9ecef !important;
        }
        span.select2.select2-container.select2-container--default.select2-container {
            width: 100% !important;
        }
        span.select2-selection.select2-selection--single {
            width: 100%;
        }
        select {
            width: 100% !important;
        }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">MY PROFILE & VEHICLE DETAILS</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">MY PROFILE & VEHICLE DETAILS</li>
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
                        <div class="col-12">
                            <form id="edit_instructor">
                                <div id="instrutor-profile-container">
                                    <p class="lead">This is the information that will be viewable by the learner driver when they are choosing their instructor.</p>
                                        <div class="row">
                                            <div class="col-md-6 small-margin-top-5">
                                                <div class="img-circle img-featured small-width-200px small-margin-auto">
                                                    @if( auth()->user()->avatar == '')
                                                        <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="rounded-circle" width="200">
                                                    @else
                                                        <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" class="rounded-circle" width="200">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="row field-wrap text optional instructor_user_instructor_bio">
                                                        <label class="text optional" for="instructor_user_instructor_bio">Your instructor bio <i data-toggle="tooltip" class="fa fa-info-circle" title="This is an opportunity to talk about yourself and stand out"></i> </label>

                                                    <div class="input-group">
                                                        <textarea maxlength="1600" rows="8" class="form-control" name="bio" spellcheck="false"> {{ @$user->user_meta->bio }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="">
                                                    <label class="" for="instructor_user_language_spoken">Spoken Language(s)</label>
                                                    <div class="input-group">
                                                        <?php
                                                        $lang=[];
                                                        if(@$user->user_meta->language!=""){
                                                            $lang = json_decode(@$user->user_meta->language,true);
                                                        }
                                                        ?>
                                                        <select name="language[]" id="language" multiple="" class="form-control select2">
                                                            <option @if( in_array('Afrikaans', $lang) ) selected @endif value="Afrikaans">Afrikaans</option>
                                                            <option @if( in_array('Akan', $lang) ) selected @endif value="Akan">Akan</option>
                                                            <option @if( in_array('Albanian', $lang) ) selected @endif value="Albanian">Albanian</option>
                                                            <option @if( in_array('Amharic', $lang) ) selected @endif value="Amharic">Amharic</option>
                                                            <option @if( in_array('Arabic', $lang) ) selected @endif value="Arabic">Arabic</option>
                                                            <option @if( in_array('Armenian', $lang) ) selected @endif value="Armenian">Armenian</option>
                                                            <option @if( in_array('Assamese', $lang) ) selected @endif value="Assamese">Assamese</option>
                                                            <option @if( in_array('Azerbaijani', $lang) ) selected @endif value="Azerbaijani">Azerbaijani</option>
                                                            <option @if( in_array('Balochi', $lang) ) selected @endif value="Balochi">Balochi</option>
                                                            <option @if( in_array('Basque', $lang) ) selected @endif value="Basque">Basque</option>
                                                            <option @if( in_array('Belarusian', $lang) ) selected @endif value="Belarusian">Belarusian</option>
                                                            <option @if( in_array('Bengali', $lang) ) selected @endif value="Bengali">Bengali</option>
                                                            <option @if( in_array('Bhojpuri', $lang) ) selected @endif value="Bhojpuri">Bhojpuri</option>
                                                            <option @if( in_array('Bulgarian', $lang) ) selected @endif value="Bulgarian">Bulgarian</option>
                                                            <option @if( in_array('Burmese', $lang) ) selected @endif value="Burmese">Burmese</option>
                                                            <option @if( in_array('Cantonese', $lang) ) selected @endif value="Cantonese">Cantonese</option>
                                                            <option @if( in_array('Catalan', $lang) ) selected @endif value="Catalan">Catalan</option>
                                                            <option @if( in_array('Central', $lang) ) selected @endif value="Central Khmer">Central Khmer</option>
                                                            <option @if( in_array('Chaldean', $lang) ) selected @endif value="Chaldean">Chaldean</option>
                                                            <option @if( in_array('Chewa', $lang) ) selected @endif value="Chewa">Chewa</option>
                                                            <option @if( in_array('Chhattisgarhi', $lang) ) selected @endif value="Chhattisgarhi">Chhattisgarhi</option>
                                                            <option @if( in_array('Chinese', $lang) ) selected @endif value="Chinese">Chinese</option>
                                                            <option @if( in_array('Chittagonian', $lang) ) selected @endif value="Chittagonian">Chittagonian</option>
                                                            <option @if( in_array('Croatian', $lang) ) selected @endif value="Croatian">Croatian</option>
                                                            <option @if( in_array('Czech', $lang) ) selected @endif value="Czech">Czech</option>
                                                            <option @if( in_array('Danish', $lang) ) selected @endif value="Danish">Danish</option>
                                                            <option @if( in_array('Dari', $lang) ) selected @endif value="Dari">Dari</option>
                                                            <option @if( in_array('Deccan', $lang) ) selected @endif value="Deccan">Deccan</option>
                                                            <option @if( in_array('Dhundhari', $lang) ) selected @endif value="Dhundhari">Dhundhari</option>
                                                            <option @if( in_array('Dutch', $lang) ) selected @endif value="Dutch">Dutch</option>
                                                            <option @if( in_array('English', $lang) ) selected @endif value="English">English</option>
                                                            <option @if( in_array('Estonian', $lang) ) selected @endif value="Estonian">Estonian</option>
                                                            <option @if( in_array('Fijian', $lang) ) selected @endif value="Fijian">Fijian</option>
                                                            <option @if( in_array('Filipino', $lang) ) selected @endif value="Filipino">Filipino</option>
                                                            <option @if( in_array('Finnish', $lang) ) selected @endif value="Finnish">Finnish</option>
                                                            <option @if( in_array('French', $lang) ) selected @endif value="French">French</option>
                                                            <option @if( in_array('Fula', $lang) ) selected @endif value="Fula">Fula</option>
                                                            <option @if( in_array('Georgian', $lang) ) selected @endif value="Georgian">Georgian</option>
                                                            <option @if( in_array('German', $lang) ) selected @endif value="German">German</option>
                                                            <option @if( in_array('Gujarati', $lang) ) selected @endif value="Gujarati">Gujarati</option>
                                                            <option @if( in_array('Hakka', $lang) ) selected @endif value="Hakka">Hakka</option>
                                                            <option @if( in_array('Haryanvi', $lang) ) selected @endif value="Haryanvi">Haryanvi</option>
                                                            <option @if( in_array('Hausa', $lang) ) selected @endif value="Hausa">Hausa</option>
                                                            <option @if( in_array('Hebrew', $lang) ) selected @endif value="Hebrew">Hebrew</option>
                                                            <option @if( in_array('Hindi', $lang) ) selected @endif value="Hindi">Hindi</option>
                                                            <option @if( in_array('Hmong', $lang) ) selected @endif value="Hmong">Hmong</option>
                                                            <option @if( in_array('Hungarian', $lang) ) selected @endif value="Hungarian">Hungarian</option>
                                                            <option @if( in_array('Icelandic', $lang) ) selected @endif value="Icelandic">Icelandic</option>
                                                            <option @if( in_array('Indonesian', $lang) ) selected @endif value="Indonesian">Indonesian</option>
                                                            <option @if( in_array('Irish', $lang) ) selected @endif value="Irish">Irish</option>
                                                            <option @if( in_array('Italian', $lang) ) selected @endif value="Italian">Italian</option>
                                                            <option @if( in_array('Japanese', $lang) ) selected @endif value="Japanese">Japanese</option>
                                                            <option @if( in_array('Javanese', $lang) ) selected @endif value="Javanese">Javanese</option>
                                                            <option @if( in_array('Kannada', $lang) ) selected @endif value="Kannada">Kannada</option>
                                                            <option @if( in_array('Kazakh', $lang) ) selected @endif value="Kazakh">Kazakh</option>
                                                            <option @if( in_array('Kinyarwanda', $lang) ) selected @endif value="Kinyarwanda">Kinyarwanda</option>
                                                            <option @if( in_array('Konkani', $lang) ) selected @endif value="Konkani">Konkani</option>
                                                            <option @if( in_array('Korean', $lang) ) selected @endif value="Korean">Korean</option>
                                                            <option @if( in_array('Kurdish', $lang) ) selected @endif value="Kurdish">Kurdish</option>
                                                            <option @if( in_array('Latin', $lang) ) selected @endif value="Latin">Latin</option>
                                                            <option @if( in_array('Latvian', $lang) ) selected @endif value="Latvian">Latvian</option>
                                                            <option @if( in_array('Lebanese', $lang) ) selected @endif value="Lebanese">Lebanese</option>
                                                            <option @if( in_array('Lithuanian', $lang) ) selected @endif value="Lithuanian">Lithuanian</option>
                                                            <option @if( in_array('Macedonian', $lang) ) selected @endif value="Macedonian">Macedonian</option>
                                                            <option @if( in_array('Madurese', $lang) ) selected @endif value="Madurese">Madurese</option>
                                                            <option @if( in_array('Magahi', $lang) ) selected @endif value="Magahi">Magahi</option>
                                                            <option @if( in_array('Maithili', $lang) ) selected @endif value="Maithili">Maithili</option>
                                                            <option @if( in_array('Malay', $lang) ) selected @endif value="Malay">Malay</option>
                                                            <option @if( in_array('Malayalam', $lang) ) selected @endif value="Malayalam">Malayalam</option>
                                                            <option @if( in_array('Maltese', $lang) ) selected @endif value="Maltese">Maltese</option>
                                                            <option @if( in_array('Maori', $lang) ) selected @endif value="Maori">Maori</option>
                                                            <option @if( in_array('Marathi', $lang) ) selected @endif value="Marathi">Marathi</option>
                                                            <option @if( in_array('Marwari', $lang) ) selected @endif value="Marwari">Marwari</option>
                                                            <option @if( in_array('Modern', $lang) ) selected @endif value="Modern Greek (1453-)">Modern Greek (1453-)</option>
                                                            <option @if( in_array('Mongolian', $lang) ) selected @endif value="Mongolian">Mongolian</option>
                                                            <option @if( in_array('Mossi', $lang) ) selected @endif value="Mossi">Mossi</option>
                                                            <option @if( in_array('Nepali', $lang) ) selected @endif value="Nepali">Nepali</option>
                                                            <option @if( in_array('Norwegian', $lang) ) selected @endif value="Norwegian">Norwegian</option>
                                                            <option @if( in_array('Odia', $lang) ) selected @endif value="Odia">Odia</option>
                                                            <option @if( in_array('Panjabi', $lang) ) selected @endif value="Panjabi">Panjabi</option>
                                                            <option @if( in_array('Pashto', $lang) ) selected @endif value="Pashto">Pashto</option>
                                                            <option @if( in_array('Persian', $lang) ) selected @endif value="Persian">Persian</option>
                                                            <option @if( in_array('Polish', $lang) ) selected @endif value="Polish">Polish</option>
                                                            <option @if( in_array('Portuguese', $lang) ) selected @endif value="Portuguese">Portuguese</option>
                                                            <option @if( in_array('Punjabi', $lang) ) selected @endif value="Punjabi">Punjabi</option>
                                                            <option @if( in_array('Quechua', $lang) ) selected @endif value="Quechua">Quechua</option>
                                                            <option @if( in_array('Romanian', $lang) ) selected @endif value="Romanian">Romanian</option>
                                                            <option @if( in_array('Russian', $lang) ) selected @endif value="Russian">Russian</option>
                                                            <option @if( in_array('Samoan', $lang) ) selected @endif value="Samoan">Samoan</option>
                                                            <option @if( in_array('Serbian', $lang) ) selected @endif value="Serbian">Serbian</option>
                                                            <option @if( in_array('Shona', $lang) ) selected @endif value="Shona">Shona</option>
                                                            <option @if( in_array('Sindhi', $lang) ) selected @endif value="Sindhi">Sindhi</option>
                                                            <option @if( in_array('Sinhalese', $lang) ) selected @endif value="Sinhalese">Sinhalese</option>
                                                            <option @if( in_array('Slovak', $lang) ) selected @endif value="Slovak">Slovak</option>
                                                            <option @if( in_array('Slovenian', $lang) ) selected @endif value="Slovenian">Slovenian</option>
                                                            <option @if( in_array('Somali', $lang) ) selected @endif value="Somali">Somali</option>
                                                            <option @if( in_array('Spanish', $lang) ) selected @endif value="Spanish">Spanish</option>
                                                            <option @if( in_array('Sundanese', $lang) ) selected @endif value="Sundanese">Sundanese</option>
                                                            <option @if( in_array('Swahili', $lang) ) selected @endif value="Swahili">Swahili</option>
                                                            <option @if( in_array('Swedish', $lang) ) selected @endif value="Swedish">Swedish</option>
                                                            <option @if( in_array('Tagalog', $lang) ) selected @endif value="Tagalog">Tagalog</option>
                                                            <option @if( in_array('Taiwanese', $lang) ) selected @endif value="Taiwanese">Taiwanese</option>
                                                            <option @if( in_array('Tamil', $lang) ) selected @endif value="Tamil">Tamil</option>
                                                            <option @if( in_array('Tatar', $lang) ) selected @endif value="Tatar">Tatar</option>
                                                            <option @if( in_array('Telugu', $lang) ) selected @endif value="Telugu">Telugu</option>
                                                            <option @if( in_array('Thai', $lang) ) selected @endif value="Thai">Thai</option>
                                                            <option @if( in_array('Tibetan', $lang) ) selected @endif value="Tibetan">Tibetan</option>
                                                            <option @if( in_array('Tonga', $lang) ) selected @endif value="Tonga (Tonga Islands)">Tonga (Tonga Islands)</option>
                                                            <option @if( in_array('Turkish', $lang) ) selected @endif value="Turkish">Turkish</option>
                                                            <option @if( in_array('Turkmen', $lang) ) selected @endif value="Turkmen">Turkmen</option>
                                                            <option @if( in_array('Ukrainian', $lang) ) selected @endif value="Ukrainian">Ukrainian</option>
                                                            <option @if( in_array('Urdu', $lang) ) selected @endif value="Urdu">Urdu</option>
                                                            <option @if( in_array('Uyghur', $lang) ) selected @endif value="Uyghur">Uyghur</option>
                                                            <option @if( in_array('Uzbek', $lang) ) selected @endif value="Uzbek">Uzbek</option>
                                                            <option @if( in_array('Vietnamese', $lang) ) selected @endif value="Vietnamese">Vietnamese</option>
                                                            <option @if( in_array('Visayan', $lang) ) selected @endif value="Visayan">Visayan</option>
                                                            <option @if( in_array('Welsh', $lang) ) selected @endif value="Welsh">Welsh</option>
                                                            <option @if( in_array('Xhosa', $lang) ) selected @endif value="Xhosa">Xhosa</option>
                                                            <option @if( in_array('Yoruba', $lang) ) selected @endif value="Yoruba">Yoruba</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="" for="">Member of a driving instructor association?</label>
                                                <div class="input-group">
                                                    <select class="form-control" required="required" name="association_member" id="association_member">
                                                        <option {{ @$user->user_meta->association_member == "No"? 'selected' : '' }} value="No">No</option>
                                                        <option {{ @$user->user_meta->association_member == "Australia Driver Trainers Association (NSW & QLD)"? 'selected' : '' }} value="Australia Driver Trainers Association (NSW &amp; QLD)">Australia Driver Trainers Association (NSW &amp; QLD)</option>
                                                        <option {{ @$user->user_meta->association_member == "NSW Driver Trainers Association"? 'selected' : '' }} value="NSW Driver Trainers Association">NSW Driver Trainers Association</option>
                                                        <option {{ @$user->user_meta->association_member == "Australian Driver Trainers Association (Victoria) Inc"? 'selected' : '' }} value="Australian Driver Trainers Association (Victoria) Inc">Australian Driver Trainers Association (Victoria) Inc</option>
                                                        <option {{ @$user->user_meta->association_member == "Other"? 'selected' : '' }} value="Other">Other</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-6" id="member_input" style="display: none;">
                                                <div class="field-wrap">
                                                    <div class="">
                                                        <label class="" for="instructor_user_instructor_association_member">Name of your association</label>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{ @$user->user_meta->association_name }}" name="association_name" id="association_member">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Are you accredited for the 'Keys2Drive' program?</label>
                                                <div class="input-group ">
                                                    <select class="form-control" required="required" name="keys2drive">
                                                        <option {{ @$user->user_meta->keys2drive == "true"? 'selected' : '' }} value="true">Yes</option>
                                                        <option {{ @$user->user_meta->keys2drive == "false"? 'selected' : '' }} value="false">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>How long have you been a licensed driving instructor?</label>
                                                    <div class="input-group">
                                                        <input class="form-control" required="required" placeholder="No. of years" type="number" value="{{ @$user->user_meta->years_for_instructing }}" name="years_for_instructing" >
                                                    </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 m-t-5">
                                                <label>Services &amp; Accreditation</label>

                                                <div class="input-group">
                                                    <?php

                                                        $services_accreditation=[];
                                                        if(@$user->user_meta->services_accreditation!=""){
                                                            $services_accreditation = json_decode(@$user->user_meta->services_accreditation);
                                                        }
                                                    ?>
                                                    <label for="instructor_user_1">
                                                        <input type="checkbox" @if( @in_array(1, $services_accreditation)) checked @endif value="1" name="services_accreditation[]" id="instructor_user_1"> Driving test package: existing customers</label>
                                                    </div>
                                                <div class="input-group">
                                                <label for="instructor_user_2">
                                                            <input type="checkbox" @if( @in_array(2, $services_accreditation)) checked @endif value="2" name="services_accreditation[]" id="instructor_user_2"> Driving test package: new customers</label>
                                                    </div>
                                                <div class="input-group">
                                                <label for="instructor_user_12">
                                                    <input type="checkbox" @if( @in_array(3, $services_accreditation))  checked @endif value="3" name="services_accreditation[]" id="instructor_user_12"> Manual Instructor accredited - no vehicle</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr>
                                                <h3>VEHICLES</h3>

                                                <label>Which transmission(s) do you offer?</label>
                                                <div class="input-group ">
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_0">
                                                            <input class="radio_buttons optional" type="radio" @if(@$user->user_meta->transmission_type == "auto") checked @endif value="auto" name="transmission_type" id="ansmission_type_0"> Auto </label>
                                                    </div>
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_1">
                                                            <input class="radio_buttons optional" type="radio" @if(@$user->user_meta->transmission_type == "manual") checked @endif value="manual" name="transmission_type" id="ansmission_type_1"> Manual </label>
                                                    </div>
                                                    <div class="radio m-r-5">
                                                        <label for="ansmission_type_2">
                                                            <input class="radio_buttons optional" type="radio" @if(@$user->user_meta->transmission_type == "both") checked @endif value="both" name="transmission_type" id="ansmission_type_2"> Both Transmissions </label>
                                                    </div>
                                                </div>

                                                <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_auto" >
                                                    <div class="fields" style="display: block;">
                                                        <center>
                                                            <h4>Vehicle for Auto</h4>
                                                            <hr>
                                                        </center>
                                                        <div class="vehicle_container" style="display: block;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                        ANCAP safety rating</label>

                                                                    <div class="input-group">
                                                                        <select class="form-control" name="ancap_rating_vehicle_auto" id="">
                                                                            <option @if(@$user->user_vehicle_auto->ancap_rating =="1") selected @endif value="1">1 Star</option>
                                                                            <option @if(@$user->user_vehicle_auto->ancap_rating =="2") selected @endif value="2">2 Stars</option>
                                                                            <option @if(@$user->user_vehicle_auto->ancap_rating =="3") selected @endif value="3">3 Stars</option>
                                                                            <option @if(@$user->user_vehicle_auto->ancap_rating =="4") selected @endif value="4">4 Stars</option>
                                                                            <option @if(@$user->user_vehicle_auto->ancap_rating =="5") selected @endif value="5">5 Stars</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                       Do you instruct with 'dual controls'?</label>
                                                                        <div class="input-group ">
                                                                            <select class="form-control"  name="dual_controls_vehicle_auto" id="">
                                                                                <option @if(@$user->user_vehicle_auto->dual_controls =="true") selected @endif value="true">Yes</option>
                                                                                <option @if(@$user->user_vehicle_auto->dual_controls =="false") selected @endif value="false">No</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Vehicle registration number</label>

                                                                    <div class="input-group">
                                                                        <input class=" form-control"  type="text" value="{{ @$user->user_vehicle_auto->registration_number }}" name="registration_number_vehicle_auto">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Transmission</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control" readonly="readonly" name="transmission_vehicle_auto" id="transmission_vehicle_auto">
                                                                            <option value="Auto" selected>Auto</option>
                                                                            {{-- <option @if(@$user->user_vehicle_auto->dual_controls =="manual") selected @endif value="Manual">Manual</option> --}}
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Make</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control vehicle_make"  name="vehicle_make_vehicle_auto" id="vehicle_make_vehicle_auto">
                                                                            <option value=""></option>
                                                                            @foreach($car_make as $make)
                                                                                <option @if(@$user->user_vehicle_auto->vehicle_make == $make->id) selected @endif  value="{{$make->id}}">{{$make->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Model</label>
                                                                    <div class="input-group ">
                                                                        <select class=" form-control"  name="vehicle_model_vehicle_auto" id="vehicle_model_vehicle_auto">
                                                                            @if(!empty($car_models_auto))
                                                                            @foreach($car_models_auto as $modl)
                                                                                <option @if(@$user->user_vehicle_auto->vehicle_model == $modl->id) selected @endif  value="{{$modl->id}}">{{$modl->title}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">

                                                                    <label class="" for="">Year</label>

                                                                    <div class="input-group ">
                                                                        <select class="form-control"  name="vehicle_year_vehicle_auto" id="vehicle_year_vehicle_auto">
                                                                            @if(!empty($car_years_auto))
                                                                            @foreach($car_years_auto as $yer)
                                                                                <option @if(@$user->user_vehicle_auto->vehicle_year == $yer->title) selected @endif  value="{{$yer->title}}">{{$yer->title}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 30px;">
                                                        <div class="col-md-3">
                                                            <div class="form-group m-t-10">
                                                                <h4>Vehicle Image</h4>
                                                                <!-- <input type="hidden" name="vehicle_img" id="vehicle_img" value=""> -->
                                                            </div>
                                                            <img src="{{ @$user->user_vehicle_auto->vehicle_image !=""? asset('assets/images/cars/'.$user->user_vehicle_auto->vehicle_image) : '' }} " alt="" class="image_preview img-responsive" id="image_preview">
                                                        </div>
                                                        
                                                        <?php /*
                                                        <div class="col-md-6 v-status">
                                                            <h4>Vehicle Status</h4>
                                                            @if(@$user->user_meta->vehicle_status==1)
                                                                <button class="btn btn-success" disabled>Approved</button>
                                                            @else
                                                                <button class="btn btn-danger" disabled>Car Image Pending for Admin Approval</button>
                                                            @endif
                                                        </div>
                                                        */ ?>

                                                    </div>
                                                </div>
                                                <div class="nested-field-blocks bordered d-none" id="instructor_user_vehicle_manual" >
                                                    <div class="fields" style="display: block;">
                                                        <center>
                                                            <h4>Vehicle for Manual</h4>
                                                            <hr>
                                                        </center>
                                                        <div class="vehicle_container" style="display: block;">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                        ANCAP safety rating</label>

                                                                    <div class="input-group">
                                                                        <select class="form-control"  name="ancap_rating_vehicle_manual" id="">
                                                                            <option @if(@$user->user_vehicle_manual->ancap_rating =="1") selected @endif value="1">1 Star</option>
                                                                            <option @if(@$user->user_vehicle_manual->ancap_rating =="2") selected @endif value="2">2 Stars</option>
                                                                            <option @if(@$user->user_vehicle_manual->ancap_rating =="3") selected @endif value="3">3 Stars</option>
                                                                            <option @if(@$user->user_vehicle_manual->ancap_rating =="4") selected @endif value="4">4 Stars</option>
                                                                            <option @if(@$user->user_vehicle_manual->ancap_rating =="5") selected @endif value="5">5 Stars</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">
                                                                       Do you instruct with 'dual controls'?</label>
                                                                        <div class="input-group ">
                                                                            <select class="form-control" name="dual_controls_vehicle_manual" id="">
                                                                                <option @if(@$user->user_vehicle_manual->dual_controls =="true") selected @endif value="true">Yes</option>
                                                                                <option @if(@$user->user_vehicle_manual->dual_controls =="false") selected @endif value="false">No</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Vehicle registration number</label>

                                                                    <div class="input-group">
                                                                        <input class=" form-control"  type="text" value="{{ @$user->user_vehicle_manual->registration_number }}" name="registration_number_vehicle_manual">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="" for="">Transmission</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control" readonly="readonly" name="transmission_vehicle_manual" id="transmission_vehicle_manual">
                                                                            {{-- <option @if(@$user->user_vehicle_manual->dual_controls =="auto") selected @endif  value="Auto">Auto</option> --}}
                                                                            <option value="Manual" selected>Manual</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="row m-t-10">
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Make</label>
                                                                    <div class="input-group">
                                                                        <select class="form-control vehicle_make"  name="vehicle_make_vehicle_manual" id="vehicle_make_vehicle_manual">
                                                                            <option value=""></option>
                                                                            @foreach($car_make as $make)
                                                                                <option @if(@$user->user_vehicle_manual->vehicle_make == $make->id) selected @endif  value="{{$make->id}}">{{$make->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="" for=""> Model</label>
                                                                    <div class="input-group ">
                                                                        <select class=" form-control"   name="vehicle_model_vehicle_manual" id="vehicle_model_vehicle_manual">
                                                                            @if(!empty($car_models_manual))
                                                                            @foreach($car_models_manual as $modl)
                                                                                <option @if(@$user->user_vehicle_manual->vehicle_model == $modl->id) selected @endif  value="{{$modl->id}}">{{$modl->title}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">

                                                                    <label class="" for="">Year</label>

                                                                    <div class="input-group ">
                                                                        <select class="form-control"  name="vehicle_year_vehicle_manual" id="vehicle_year_vehicle_manual">
                                                                            @if(!empty($car_years_manual))
                                                                            @foreach($car_years_manual as $yer)
                                                                                <option @if(@$user->user_vehicle_manual->vehicle_year == $yer->title) selected @endif  value="{{$yer->title}}">{{$yer->title}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 30px;">
                                                        <div class="col-md-3">
                                                            <div class="form-group m-t-10">
                                                                <h4>Vehicle Image</h4>
                                                                <!-- <input type="hidden" name="vehicle_img" id="vehicle_img" value=""> -->
                                                            </div>
                                                            <img src="{{ @$user->user_vehicle_manual->vehicle_image !=""? asset('assets/images/cars/'.$user->user_vehicle_manual->vehicle_image) : '' }} " alt="" class="image_preview img-responsive" id="image_preview">
                                                        </div>
                                                        
                                                        <?php /*
                                                        <div class="col-md-6 v-status">
                                                            <h4>Vehicle Status</h4>
                                                            @if(@$user->user_vehicle_manual->vehicle_status==1)
                                                                <button class="btn btn-success" disabled>Approved</button>
                                                            @else
                                                                <button class="btn btn-danger" disabled>Car Image Pending for Admin Approval</button>
                                                            @endif
                                                        </div>
                                                        */ ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-t-10">
                                            <button class="btn btn-success">SAVE</button>
                                        </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <center>
                    <h4>Vehicle History</h4>
                    <hr>
                </center>
                <hr>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Rating</th>  
                            <th>Dual Controls</th>    
                            <th>registration number</th>     
                            <th>Transmission</th> 
                            <th>Make</th> 
                            <th>Model</th> 
                            <th>Year</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicle_notifications as $notify)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $notify->instructer_vehicles->ancap_rating }} Star</td>
                                <td>
                                    @if ($notify->instructer_vehicles->dual_controls =="false")
                                        {{ 'No' }}
                                    @else
                                        {{ 'Yes' }}
                                    @endif
                                </td>
                                <td>{{ $notify->instructer_vehicles->registration_number }}</td>
                                <td>{{ $notify->instructer_vehicles->vehicle_type }}</td>
                                <td>{{ carMake($notify->instructer_vehicles->vehicle_make) }}</td>

                                <td>{{ carModel($notify->instructer_vehicles->vehicle_model) }}</td>

                                <td>{{ $notify->instructer_vehicles->vehicle_year }}</td>
                                <td>{{ $notify->notify_status }}</td>
                            </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.modal -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    
    <style>
        .v-status{
            text-align: center;
        }
        .v-status button{
            margin-top: 15px;
            padding: 10px 30px;
            text-transform: uppercase;
        }
    </style>

    <script>

        $(document).ready(function() {

            $('#language').select2();
            $('#vehicle_make_vehicle_auto').select2({
                placeholder: "Select vehicle Make",
            });
            $('#vehicle_make_vehicle_manual').select2({
                placeholder: "Select vehicle Make",
            });

            $('#vehicle_model_vehicle_auto').select2({
                placeholder: "Select vehicle Model",
            });

            $('#vehicle_model_vehicle_manual').select2({
                placeholder: "Select vehicle Model",
            });

            $('#vehicle_year_vehicle_auto').val('{{ @$user->user_vehicle_auto->vehicle_year}}');
            $('#vehicle_model_vehicle_auto').val('{{ @$user->user_vehicle_auto->vehicle_model}}');
            $('#vehicle_make_vehicle_auto').val('{{ @$user->user_vehicle_auto->vehicle_make}}');

            $('#vehicle_year_vehicle_manual').val('{{ @$user->user_vehicle_manual->vehicle_year}}');
            $('#vehicle_model_vehicle_manual').val('{{ @$user->user_vehicle_manual->vehicle_model}}');
            $('#vehicle_make_vehicle_manual').val('{{ @$user->user_vehicle_manual->vehicle_make}}');


            var association_member= "{{ $user->association_member }}";

            if(association_member == "Other"){
                $('#member_input').show();
            }


            $('#vehicle_make_vehicle_auto').change(function (){
                var make_id = $(this).val();
                if(make_id == ''){
                    $('#vehicle_model_vehicle_auto').html("<option value=''></option>");
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('make_id', make_id )

                $.ajax({
                    url: "{{Route('get_vehicle_model')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_model_vehicle_auto').html(res.options);
                            $('#vehicle_year_vehicle_auto').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

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

            $('#vehicle_make_vehicle_manual').change(function (){
                var make_id = $(this).val();
                if(make_id == ''){
                    $('#vehicle_model_vehicle_manual').html("<option value=''></option>");
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('make_id', make_id )

                $.ajax({
                    url: "{{Route('get_vehicle_model')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_model_vehicle_manual').html(res.options);
                            $('#vehicle_year_vehicle_manual').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

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

            //=================================================================


            $('#vehicle_model_vehicle_auto').change(function (){

                var model_id = $(this).val();
                if(model_id == ''){
                    $('#vehicle_year_vehicle_auto').html("<option value=''></option>");
                    //$('#image_preview').attr("src", "");
                    //$('#vehicle_img').val('');
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id )

                $.ajax({
                    url: "{{Route('get_vehicle_year')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_year_vehicle_auto').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

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

            $('#vehicle_model_vehicle_manual').change(function (){

                var model_id = $(this).val();
                if(model_id == ''){
                    $('#vehicle_year_vehicle_manual').html("<option value=''></option>");
                    //$('#image_preview').attr("src", "");
                    //$('#vehicle_img').val('');
                    return ;
                }

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id )

                $.ajax({
                    url: "{{Route('get_vehicle_year')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_year_vehicle_manual').html(res.options_year);
                            //$('#vehicle_img').val(res.image_id);
                            //$('#image_preview').attr("src", "assets/images/cars/"+res.image);

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

            //=================================================================


            /*
            $('#vehicle_year').change(function (){

                var model_id = $('#vehicle_model').val();
                var yeartitle = $(this).val();

                $('#loading').show();

                var data = new FormData();

                data.append('model_id', model_id );
                data.append('year', yeartitle );

                $.ajax({
                    url: "{{Route('get_vehicle_model_img')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            $('#vehicle_img').val(res.image_id);
                            $('#image_preview').attr("src", "assets/images/cars/"+res.image);

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
            */

            //======================================================================

            $('#edit_instructor').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                if($('input[name="services_accreditation[]"]:checked').length == 0){
                    data.append('services_accreditation', '[]');
                }

                $.ajax({
                    url: "{{Route('save_instructor_vehicle')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            //swal('Success', res.message, 'success');
                            swal('Success', res.message, 'success').then((value) => {
                                //location.reload(true); 
                                
                                window.location.assign("{{Route('home')}}");
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

            $('#association_member').change(function (){
                if($(this).val() == 'Other'){
                    $('#member_input').show();
                }else{
                    $('#member_input').hide();
                }
            })

            var transmission_type = $("input[type='radio'][name='transmission_type']:checked").val();
            if(transmission_type == 'auto') {
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').addClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = false; 
                document.getElementById("transmission_vehicle_manual").disabled = true;
                $("input[name='registration_number_vehicle_auto']").attr('required', '');
                $("input[name='registration_number_vehicle_manual']").removeAttr('required');
            }else if(transmission_type == 'manual'){
                $('#instructor_user_vehicle_auto').addClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = true; 
                document.getElementById("transmission_vehicle_manual").disabled = false;
                $("input[name='registration_number_vehicle_manual']").attr('required', '');
                $("input[name='registration_number_vehicle_auto']").removeAttr('required');
            }else{
                $('#instructor_user_vehicle_auto').removeClass('d-none');
                $('#instructor_user_vehicle_manual').removeClass('d-none');
                document.getElementById("transmission_vehicle_auto").disabled = false; 
                document.getElementById("transmission_vehicle_manual").disabled = false;
                $("input[name='registration_number_vehicle_auto']").attr('required', '');
                $("input[name='registration_number_vehicle_manual']").attr('required', '');
            }

            $('input:radio[name="transmission_type"]').change(function() {
                var transmission_type = $("input[type='radio'][name='transmission_type']:checked").val();
                if(transmission_type == 'auto') {
                    $('#instructor_user_vehicle_auto').removeClass('d-none');
                    $('#instructor_user_vehicle_manual').addClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = false; 
                    document.getElementById("transmission_vehicle_manual").disabled = true;

                    $("input[name='registration_number_vehicle_auto']").attr('required', '');
                    $("input[name='registration_number_vehicle_manual']").removeAttr('required');

                }else if(transmission_type == 'manual'){
                    $('#instructor_user_vehicle_auto').addClass('d-none');
                    $('#instructor_user_vehicle_manual').removeClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = true; 
                    document.getElementById("transmission_vehicle_manual").disabled = false;
                    $("input[name='registration_number_vehicle_manual']").attr('required', '');
                    $("input[name='registration_number_vehicle_auto']").removeAttr('required');

                }else{
                    $('#instructor_user_vehicle_auto').removeClass('d-none');
                    $('#instructor_user_vehicle_manual').removeClass('d-none');
                    document.getElementById("transmission_vehicle_auto").disabled = false; 
                    document.getElementById("transmission_vehicle_manual").disabled = false;

                    $("input[name='registration_number_vehicle_auto']").attr('required', '');
                    $("input[name='registration_number_vehicle_manual']").attr('required', '');
                }
            });

        });
    </script>
@endsection
