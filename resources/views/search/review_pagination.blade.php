<?php
foreach ($rating as $rate){
?>
<div class="media">
    <div class="media-left">
        <div class="small-width-180px">
            <strong class="badge badge-warning"></strong> &nbsp;
            @for($i=1; $i <= $rate->score; $i++)
                <i class="fa fa-star text-warning fa-lg"></i>
            @endfor
        </div>
    </div>

</div>
<p class="w-100 pl-2 mt-2">{{ $rate->review }}</p>
<small class="pull-right bold">{{ ucfirst($rate->name. ' '. $rate->lname) }}</small>
<div class="clearfix"></div>
<hr class="mt-2">
<?php } ?>
{!! $rating->links() !!}
