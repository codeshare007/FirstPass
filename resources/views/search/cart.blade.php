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
        .ls.container-cr{
            /*max-width: 80rem!important;*/
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

        table thead td{
            color: #2b2b2b;
            font-weight: bold;
        }
        .container-cr .pricing-plan .plan-features {
            margin: 20px 0 0px;
            padding-top: 30px;
            position: relative;
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
            <div class="col-sm-12">
                <div class="py-45 box-shadow mb-20 teaser" style="padding-left: 10px; padding-right: 10px">
                    <h4 class="text-center title">SELECT YOUR PACKAGE</h4>
                   <div class="col-md-12">
                       <div class="row">
                           <div class="card w-100">
                               <div class="card-body">
                                   <div class="table-responsive">
                                       <table class="table">
                                           <thead>
                                           <tr bgcolor="#f1f1f1">
                                               <td>Hours</td>
                                               <td>price/hour</td>
                                               <td align="right">Total</td>
                                               <td align="right"></td>
                                           </tr>
                                           </thead>
                                           <tbody>
                                           <?php
                                               $net_total = 0;
                                               $test=$lesson=false;
                                               $search_d = $search->step_2;

                                               if($search_d!=''){
                                                   $search_d = json_decode($search_d);
                                               }
                                               if(is_array($search_d)){
                                                   if( in_array( 'test', $search_d ) ){
                                                       $test = true;
                                                       $net_total = $net_total+ $test_package->price;
                                                   }
                                                   if( in_array( 'lesson', $search_d ) ){
                                                       $lesson = true;
                                                       $net_total = $net_total+ $region->price;
                                                   }
                                               }

                                                $services_acc = json_decode($instructor->user_meta->services_accreditation);
                                           ?>
                                           <tr class="driving_lesson @if($lesson === false ) hidden @else active @endif">
                                               <td>
                                                   <div class="row">
                                                       <div class="col-sm-6">
                                                           <div class="input-group">
                                                            <span class="input-group-btn">
                                                              <button type="button" class="btn btn-danger btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                                  <span class="fa fa-minus"></span>
                                                                </button>
                                                            </span>
                                                               <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="100" id="hr">
                                                               <span class="input-group-btn">
                                                              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[1]">
                                                                  <span class="fa fa-plus"></span>
                                                                </button>
                                                            </span>
                                                           </div>
                                                       </div>
                                                       <div class="col-sm-6">
                                                           <h6 class="mt-2">Driving Lesson Hour/s</h6>
                                                       </div>
                                                   </div>
                                               </td>
                                               <td>$<span class="price">{{ $region->price }}</span> <span class="badge badge-success hidden p_off">0</span></td>
                                               <td align="right">$<span class="total tt">{{ $region->price }}</span></td>
                                               <td align="right">
                                                   @if(!isset($services_acc[0]))
                                                   <a onclick="removePackage(this)" href="javascript:void(0)"><strong class="fa fa-times"></strong></a>
                                                   @endif
                                               </td>
                                           </tr>

                                           <tr id="test_pkg_row" bgcolor="#f0fff0" style="display: @if($test === false) none @endif">
                                               <td><strong>1 {{ ucwords( $test_package->title ) }}</strong></td>
                                               <td></td>
                                               <td align="right">$<span class="total_test tt">{{ $test_package->price}}</span></td>
                                               <td align="right"><a onclick="removeTest(this)" href="javascript:void(0)"><strong class="fa fa-times"></strong></a></td>
                                           </tr>

                                           </tbody>

                                           <tfoot>
                                           <tr bgcolor="#d2d2d2">
                                               <td></td>
                                               <td></td>
                                               <td align="right"><strong>$<span class="net_total">{{ $net_total }}</span></strong></td>
                                               <td align="right"></td>
                                           </tr>
                                           </tfoot>
                                       </table>
                                   </div>
                               </div>
                           </div>
                           <?php
                           $base_price = $region->price ==''? 0: $region->price;
                           function get_package($base_price, $perc, $lessons){
                               $pkg_1 = round( ($base_price*$perc)/100);
                               $package_p = $base_price-$pkg_1;
                               $total = $package_p * $lessons;
                               $res = ['per' => $perc, 'lessons' => $lessons, 'after_dis' => $package_p, 'total' => $total];
                               return $res;
                           }
                           ?>
                           <div class="row c-gutter-0">
                               <div class="divider-20 divider-md-20 divider-xl-20"></div>
                               <h4 class="mt-3 text-center w-100">ADD MORE TO SAVE!</h4>
                               <div class="divider-10 divider-md-10 divider-xl-10"></div>
                               <div class="col-sm-3 col-lg-3 col-sm-4 pkg-container  basic">
                                   <div class="pricing-plan box-shadow">
                                       <div class="plan-name">
                                           <h3>
                                               Basic Driving Courses
                                           </h3>
                                       </div>
                                       <div class="price-wrap color-main">
                                           <span class="plan-price">5</span><span class="plan-decimals">%</span><span class="plan-sign">OFF</span>
                                       </div>
                                       <div class="plan-description">
                                           @php
                                               $pkg_1 = get_package($base_price, 5, 5);
                                           @endphp
                                           <strong>${{ $pkg_1['after_dis'] }}</strong> / hr
                                           <br>
                                           <span class="text-success">Total ${{ $pkg_1['total'] }}</span>
                                       </div>
                                       <div class="plan-features">

                                       </div>
                                       <div class="plan-button">
                                           <a href="javascript:void(0)" onclick="add_package(this, 'basic', 5)" class="btn btn-outline-darkgrey">5 Lessons</a>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-sm-3 col-lg-3 col-sm-4 pkg-container  silver">

                                   <div class="pricing-plan plan-featured box-shadow">
                                       <div class="plan-name">
                                           <h3>
                                               Silver Driving Courses
                                           </h3>
                                       </div>
                                       <div class="price-wrap">
                                           <span class="plan-price">10</span><span class="plan-decimals">%</span><span class="plan-sign">OFF</span>
                                       </div>
                                       <div class="plan-description color-darkgrey">
                                           @php
                                               $pkg_2 = get_package($base_price, 10, 10);
                                           @endphp
                                           <strong>${{ $pkg_2['after_dis'] }}</strong> / hr
                                           <br>
                                           <span class="text-success">Total ${{ $pkg_2['total'] }}</span>
                                       </div>
                                       <div class="plan-features">
                                       </div>
                                       <div class="plan-button">
                                           <a href="javascript:void(0)" onclick="add_package(this, 'silver', 10)" class="btn btn-outline-darkgrey">10 Lessons</a>
                                       </div>
                                   </div>

                               </div>
                               <div class="col-sm-3 col-lg-3 col-sm-4 pkg-container  gold">
                                   <div class="pricing-plan box-shadow">
                                       <div class="plan-name">
                                           <h3>
                                               Gold Driving Courses
                                           </h3>
                                       </div>
                                       <div class="price-wrap color-main">
                                           <span class="plan-price">12.5</span><span class="plan-decimals">%</span><span class="plan-sign">OFF</span>
                                       </div>
                                       <div class="plan-description">
                                           @php
                                               $pkg_3 = get_package($base_price, 12.5, 20);
                                           @endphp
                                           <strong>${{ $pkg_3['after_dis'] }}</strong> / hr
                                           <br>
                                           <span class="text-success">Total ${{ $pkg_3['total'] }}</span>
                                       </div>
                                       <div class="plan-features">

                                       </div>
                                       <div class="plan-button">
                                           <a href="javascript:void(0)" onclick="add_package(this, 'gold', 20)" class="btn btn-outline-darkgrey">20 Lessons</a>
                                       </div>
                                   </div>

                               </div>
                               <div class="col-sm-3 col-lg-3 col-sm-4 pkg-container  premium">

                                   <div class="pricing-plan box-shadow plan-featured danger">
                                       <div class="plan-name">
                                           <h3>
                                               Premium Driving Courses
                                           </h3>
                                       </div>
                                       <div class="price-wrap color-main">
                                           <span class="plan-price">20</span><span class="plan-decimals">%</span><span class="plan-sign">OFF</span>
                                       </div>
                                       <div class="plan-description">
                                           @php
                                               $pkg_3 = get_package($base_price, 20, 100);
                                           @endphp
                                           <strong>${{ $pkg_3['after_dis'] }}</strong> / hr
                                           <br>
                                           <span class="text-white">Total ${{ $pkg_3['total'] }}</span>
                                       </div>
                                       <div class="plan-features">

                                       </div>
                                       <div class="plan-button">
                                           <a href="javascript:void(0)" onclick="add_package(this, 'premium', 100)" class="btn btn-outline-darkgrey">100 Lessons</a>
                                       </div>
                                   </div>
                               </div>

                               <input type="checkbox" style="display: none" name="is_test" id="is_test" value="yes" @if($test == true) checked @endif>
                               <input type="checkbox" style="display: none" name="is_lesson" id="is_lesson" value="yes" @if($lesson == true) checked @endif>
                              
                               @if($test==false)
                                   @if(isset($test_package))
                                   <div class="col-sm-3 col-lg-3 col-sm-4 test-container  mx-sm-auto test @if($test == true) active @endif">

                                       <div class="pricing-plan box-shadow">
                                           <div class="plan-name">
                                               <h3>
                                                   {{ ucwords( $test_package->title ) }}
                                               </h3>
                                           </div>
                                           <div class="price-wrap color-main">
                                               <span class="plan-price">${{ $test_package->price }}  </span>
                                           </div>

                                           <div class="plan-features">

                                           </div>
                                           <div class="plan-button">
                                               <a href="javascript:void(0)" onclick="add_package(this, 'test', '', 100)" class="btn btn-outline-darkgrey">Test Package</a>
                                           </div>
                                       </div>

                                   </div>
                                   @endif
                               @endif
                               <div class="divider-60 divider-xl-60"></div>
                               <div class="clearfix"></div>
                               
                                    <div class="main_continue w-100 text-center">
                                        <button id="next_step" class="btn btn-warning w-50">CONTINUE (TOTAL $<span class="net_total">{{ $net_total }}</span>) <span class="fa fa-spin fa-spinner hidden"></span></button>
                                    </div>
                               
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

    <div class="button_fix_area">
        <div class="continue_submit_btn w-100">
            <button id="next_step_sticky" class="btn btn-warning w-50">CONTINUE <span class="fa fa-spin fa-spinner hidden"></span></button>
        </div>
    </div>


@endsection

@section('script')

    <script>
        let is_test = false;
        let base_price = {{$base_price}};
        let test_price = {{ $test_package->price }};

        function add_package(e, type, hour){

            if(type == 'test') {
                $('.'+type).addClass('active');
                $('#test_pkg_row').show();

                let t = $('.total').text();
                let total_pri = parseInt(t) + parseInt(test_price);
                $('.net_total').text(total_pri);
                $('#is_test').prop('checked', true);
            }else{
                $('input[name="quant[1]"]').val(hour);

                package_change(hour);
                $('.pkg-container').removeClass('active');
                $('.'+type).addClass('active');
                $('tr.driving_lesson').removeClass('hidden').addClass('active');
                $('#is_lesson').prop('checked', true);
            }
        }

        function removePackage(x){
            $(x).parent().parent().addClass('hidden');

            if( $('.test-container').hasClass('active') ){
                $('.net_total').text(test_price);
            }else{
                $('.net_total').text(0);
            }
            $('.pkg-container.active').removeClass('active');
            $('#is_lesson').prop('checked', false);
            $('tr.driving_lesson').removeClass('active');
        }

        function removeTest(e){
            $(e).parent().parent().hide();
            $('.test-container').removeClass('active');

            if( $('tr.driving_lesson').hasClass('hidden') ){
                $('.net_total').text(0);
            }else{
                let t = $('.total').text();
                $('.net_total').text(t);

            }
            $('#is_test').prop('checked', false);
        }


        function package_change(valueCurrent){
            if(valueCurrent<6) {
                let total = parseInt(base_price) * valueCurrent;

                if(is_test==true){
                    total = total+ parseInt(test_price)
                }

                $('.total').text(total);
                $('.p_off').addClass('hidden');
                $('.price').text(base_price);
            }else if(valueCurrent >5 && valueCurrent < 10 ){

                let pkg = Math.round( (base_price*5)/100);
                let package_p = base_price-pkg;
                let total = package_p * valueCurrent;
                $('.total').text(total)
                $('.price').text(package_p);
                $('.p_off').text('5% OFF').removeClass('hidden');

            }else if(valueCurrent >=10 && valueCurrent < 20 ){

                let pkg = Math.round( (base_price*10)/100);
                let package_p = base_price-pkg;
                let total = package_p * valueCurrent;
                $('.total').text(total)
                $('.price').text(package_p);
                $('.p_off').text('10% OFF').removeClass('hidden');

            }else if(valueCurrent >=20 && valueCurrent < 50 ){

                let pkg =(base_price*12.5)/100;
                let package_p = base_price-pkg;
                let total = package_p * valueCurrent;
                $('.total').text(total)
                $('.price').text(package_p);
                $('.p_off').text('12.5% OFF').removeClass('hidden');

            }else if(valueCurrent >=50 && valueCurrent < 70 ){

                let pkg = Math.round( (base_price*15)/100);
                let package_p = base_price-pkg;
                let total = package_p * valueCurrent;
                $('.total').text(total)
                $('.price').text(package_p);
                $('.p_off').text('15% OFF').removeClass('hidden');

            }else if(valueCurrent >69 && valueCurrent <= 100 ){
                let pkg = Math.round( (base_price*20)/100);
                let package_p = base_price-pkg;
                let total = package_p * valueCurrent;
                $('.total').text(total)
                $('.price').text(package_p);
                $('.p_off').text('20% OFF').removeClass('hidden');
            }
            setTimeout(
                function()
                {
                    ttl()
                }, 1000);

        }
        function ttl(){
            let l_t = false;
            if( ($('.test-container').hasClass('active') || $('.total_test').length) && $('.driving_lesson').hasClass('active') ){
                let t = parseInt( $('.total').text() );
                
                let test = 0;
                if($('#test_pkg_row:visible').length == 1){ test = parseInt( $('.total_test').text() ); }

                $('.net_total').text( t+test );
            }else if($('.driving_lesson').hasClass('active')){
                let t = parseInt( $('.total').text() );
                $('.net_total').text( t );
            }
        }

        function show_inf(id){
            $('.intl_conv, .your_car, .logbook, .driving_test').hide();
            $('.'+id).show();
            $('#info_modal').modal('show');
        }

        $(document).ready(function (){

            $('#next_step').click(function (){
                let net_total = parseInt($('.net_total').text());
                let p_off = parseInt($('.p_off').text());
                if(net_total == 0){
                    swal('Oops!', 'Please select your package', 'warning');
                    return false;
                }

                $('.fa-spinner').removeClass('hidden');
                var data = new FormData();
                data.append("search_type", '3');
                data.append("total", net_total);
                data.append("dis", p_off);
                data.append("hr", $('#hr').val());
                data.append("hourly_rate", $('.price').text());
                data.append("is_test", $('#is_test:checked').val());
                data.append("is_lesson", $('#is_lesson:checked').val());
                data.append("search_id", '{{$search_id}}');

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){
                            let url = "{{ url("/book-online/book/$search_id/instructor/$instructor->id") }}";
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

            $('#next_step_sticky').click(function (){
                let net_total = parseInt($('.net_total').text());
                let p_off = parseInt($('.p_off').text());
                if(net_total == 0){
                    swal('Oops!', 'Please select your package', 'warning');
                    return false;
                }

                $('.fa-spinner').removeClass('hidden');
                var data = new FormData();
                data.append("search_type", '3');
                data.append("total", net_total);
                data.append("dis", p_off);
                data.append("hr", $('#hr').val());
                data.append("hourly_rate", $('.price').text());
                data.append("is_test", $('#is_test:checked').val());
                data.append("is_lesson", $('#is_lesson:checked').val());
                data.append("search_id", '{{$search_id}}');

                $.ajax({
                    url: "{{Route('search')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {

                        if(res.success == true){
                            let url = "{{ url("/book-online/book/$search_id/instructor/$instructor->id") }}";
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




            $('.btn-number').click(function(e){
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type      = $(this).attr('data-type');
                var input = $("input[name='"+fieldName+"']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if(type == 'minus') {

                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if(type == 'plus') {

                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function(){
                $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {
                minValue =  parseInt($(this).attr('min'));
                maxValue =  parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if(valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                    return ;
                }
                if(valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                    return ;
                }
                package_change(valueCurrent);
            });

            $(".input-number").keydown(function (e) {

                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
                ttl()
            });

        });
    </script>
@endsection
