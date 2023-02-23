<div class="section-title default text-center">
    <div class="section-top">
      <h1><span>Take a Quick 1-minute Self-Assessment</span><b class="text-animate">Find out what disability care support you qualify for?</b></h1>
    </div>
</div>
  <div class="quiz-sec">
        <form id="quickEvaluationForm" method="POST" action="{{route('submit.evaluation_form')}}" enctype="multipart/form-data"> 
            <h4>Gifted Hands Home Care Service</h4>
            <div class="progress">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <div class="col-12 mt-2 py-2 form-messages"></div>
            <div class="qns">
                <fieldset>
                    <div class="form-group">
                        <label>Who is the care required for?<span>*</span></label>
                        <div class="agree-label">
                            <input type="radio" name="care_for" id="self" value="self" class="required_field">
                            <label for="self">
                                For myself
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="care_for" id="other" value="other" class="required_field">
                            <label for="other">
                                Inquiring for family member/relative/friend
                            </label>
                        </div>
                    </div>
                    <div class="form-group button">
                        <button type="button" class="homes-btn theme-1 next" data-keys="care_for">Next 
                            <i class="fa fa-angle-double-right"></i> 
                        </button>
                    </div>
                </fieldset>
                <fieldset style="display: none">
                <div class="form-group">
                    <label>What kind of service are you looking for?(Check all that apply)<span>*</span></label>
                    @if (!empty($form_services))
                        @foreach ($form_services as $key => $service)
                        <div class="agree-label">
                            <input type="checkbox" name="interested_services[]" id="{{"service_$key"}}" value="{{$service->id}}">
                            <label for="{{"service_$key"}}">
                                {{$service->service_name}}
                            </label>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="form-group button">
                    <button type="button" class="homes-btn theme-1 next" data-keys="interested_services[]">Next 
                        <i class="fa fa-angle-double-right"></i> 
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                        <i class="fa fa-angle-double-left"></i> 
                    </button>
                    {{-- <a href="#" class="btn btn-secondary btn-sm">
                        <i class="fa fa-angle-double-left"></i> Go Back
                    </a> --}}
                </div>
                </fieldset>
                <fieldset style="display: none">
                <div class="form-group">
                    <label>Are you a NDIS registered consumer?<span>*</span></label>
                    <div class="agree-label">
                        <input type="radio" name="ndis_registered" id="ndis_yes" value="yes">
                        <label for="ndis_yes">
                           Yes
                        </label>
                    </div>
                    <div class="agree-label">
                        <input type="radio" name="ndis_registered" id="ndis_no" value="no">
                        <label for="ndis_no">
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group button">
                    <button type="button" class="homes-btn theme-1 next" data-keys="ndis_registered">Next 
                        <i class="fa fa-angle-double-right"></i> 
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                        <i class="fa fa-angle-double-left"></i> 
                    </button>
                </div>
                </fieldset>
                <fieldset style="display: none">
                <div class="form-group">
                    <label>How many hours minimum a day will you require assistance?<span>*</span></label>
                    <div class="agree-label">
                        <input type="radio" name="hours" id="upto_four" value="0-4 Hours a Day">
                        <label for="upto_four">
                            0-4 Hours a Day
                        </label>
                    </div>
                    <div class="agree-label">
                        <input type="radio" name="hours" id="upto_eight" value="4-8 Hours a Day">
                        <label for="upto_eight">
                            4-8 Hours a Day
                        </label>
                    </div>
                    <div class="agree-label">
                        <input type="radio" name="hours" id="upto_twelve" value="8-12 Hours a Day">
                        <label for="upto_twelve">
                            8-12 Hours a Day
                        </label>
                    </div>
                    <div class="agree-label">
                        <input type="radio" name="hours" id="upto_twentyfour" value="12-24 Hours a Day">
                        <label for="upto_twentyfour">
                            12-24 Hours a Day
                        </label>
                    </div>
                    <div class="agree-label">
                        <input type="radio" name="hours" id="hours_unsure" value="Unsure">
                        <label for="hours_unsure">
                            Unsure
                        </label>
                    </div>
                </div>
                <div class="form-group button">
                    <button type="button" class="homes-btn theme-1 next" data-keys="hours">Next 
                        <i class="fa fa-angle-double-right"></i> 
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                        <i class="fa fa-angle-double-left"></i> 
                    </button>
                </div>
                </fieldset>
                <fieldset style="display: none">
                <div class="form-group">
                    <label>How often will you need support in a week?<span>*</span></label>
                    @for ($i = 1; $i <= 7; $i++)
                    <div class="agree-label">
                        <input type="radio" name="days" id="{{"day_$i"}}" value="{{$i}}">
                        <label for="{{"day_$i"}}">
                            {{$i}}
                        </label>
                    </div> 
                    @endfor
                    <div class="agree-label">
                        <input type="radio" name="days" id="days_unsure" value="Unsure">
                        <label for="days_unsure">
                            Unsure
                        </label>
                    </div>
                </div>
                <div class="form-group button">
                    <button type="button" class="homes-btn theme-1 next" data-keys="days">Next 
                        <i class="fa fa-angle-double-right"></i> 
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                        <i class="fa fa-angle-double-left"></i> 
                    </button>
                </div>
                </fieldset>
                <fieldset style="display: none">
                    <div class="form-group">
                        <label>How long do you think you'll need assistance?<span>*</span></label>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_1" value="30 days or less">
                            <label for="duration_1">
                                30 days or less
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_2" value="1-3 Months">
                            <label for="duration_2">
                                1-3 Months
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_3" value="3-6 Months">
                            <label for="duration_3">
                                3-6 Months
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_4" value="6-12 Months">
                            <label for="duration_4">
                                6-12 Months
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_5" value="Over 12 Months">
                            <label for="duration_5">
                                Over 12 Months
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="duration" id="duration_not_sure" value="Not Sure">
                            <label for="duration_not_sure">
                                Not Sure
                            </label>
                        </div>
                    </div>
                    <div class="form-group button">
                        <button type="button" class="homes-btn theme-1 next" data-keys="duration">Next 
                            <i class="fa fa-angle-double-right"></i> 
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                            <i class="fa fa-angle-double-left"></i> 
                        </button>
                    </div>
                </fieldset> 
                <fieldset style="display: none">
                    <div class="form-group">
                        <label>Last but not least, when do you want to start receiving care?<span>*</span></label>
                        <div class="agree-label">
                            <input type="radio" name="start_period" id="start_period_1" value="Immediately">
                            <label for="start_period_1">
                                Immediately
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="start_period" id="start_period_2" value="Within 30 Days">
                            <label for="start_period_2">
                                Within 30 Days
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="start_period" id="start_period_3" value="In 30-60 Days">
                            <label for="start_period_3">
                                In 30-60 Days
                            </label>
                        </div>
                        <div class="agree-label">
                            <input type="radio" name="start_period" id="start_period_unsure" value="Unsure">
                            <label for="start_period_unsure">
                                Unsure
                            </label>
                        </div>
                        <label>Your Name<span>*</span></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                        
                        <label>Postcode<span>*</span></label>
                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Post Code">

                        <label>To Which Email Address Shall We Send The Quote To? <span>*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                        <br>
                        <label>We will get in touch with you as soon as possible.</label>
                    </div>
                    <div class="form-group button">
                        <button type="button" class="homes-btn theme-1 save">Submit 
                            <i class="fa fa-angle-double-right"></i> 
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm previous">Previous 
                            <i class="fa fa-angle-double-left"></i> 
                        </button>
                    </div>
                </fieldset>
            </div>
        </form>
</div>
@push('script')
<script src="{{asset('frontend/js/validate.js')}}"></script>
<script>

$(function(){

    let constraints_list = {
        care_for: {
            presence: true,
        },
        "interested_services[]":{
            presence:true,
        },
        ndis_registered:{
            presence:true,
        },
        hours:{
            presence:true,
        },
        days:{
            presence:true,
        },
        duration:{
            presence:true,
        },
        start_period:{
            presence:true,
        },
        first_name:{
            presence:true,
        },
        last_name:{
            presence:true,
        },
        postcode:{
            presence:true,
        },
        email:{
            presence:true,
        },
    };

    let current_fs, next_fs, previous_fs, current_question; //fieldsets
    let opacity;
    let question_count = $('fieldset').length;
    let progress_bar = $("#progress-bar");
    let form = $("#quickEvaluationForm");
    let progress = 0;
    let validation_string = [];
    
    $(".next").click(function(){ 
        
        let constraints = {};
        current_fs = $(this).parent().parent();
        next_fs = $(this).parent().parent().next();
        current_question = $("fieldset").index(current_fs) + 1;
        progress = parseInt((current_question/question_count)*100);
        keys = $(this).data('keys');
        validation_string = keys.split(',');
        
        Object.entries(constraints_list).forEach(([key, value]) => {
            if (keys.includes(key)) {
                constraints[key] = value;
            }
        });
        // console.log(constraints);
        // return false;
        // validate the form against the constraints
        var errors = validate(form, constraints);
        // then we update the form to reflect the results
        if (!errors) {
            console.log('success');
            //Increase progress status.
            progress_bar.width(`${progress}%`).attr('aria-valuenow', progress)
            progress_bar.html(`${progress}%`);

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
            step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
            'display': 'none',
            'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
            },
            duration: 600
            });
        }else{
            console.log(errors);
            console.log('error');
            form.find(".form-messages").addClass("alert alert-danger").html('Please Fill The Required Fields');
            setTimeout(() => {
                form.find(".form-messages").removeClass("alert alert-danger").html('');
            }, 2000);
        }    
    });

    $(".previous").click(function(){

        current_fs = $(this).parent().parent();
        previous_fs = $(this).parent().parent().prev();
        current_question = $("fieldset").index(previous_fs);  

        //Decrease Progress Status
        progress = parseInt((current_question/question_count)*100);
        //Increase progress status.
        progress_bar.width(`${progress}%`).attr('aria-valuenow', progress)
        progress_bar.html(`${progress}%`);

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
        step: function(now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
        'display': 'none',
        'position': 'relative'
        });
        previous_fs.css({'opacity': opacity});
        },
        duration: 600
        });
    });
});
</script>
@endpush
