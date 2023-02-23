<div class="single-service">
    <div class="service-head"> <img src="{{asset("uploads/training_image/$train->training_image")}}" alt="{{$train->title}}">
    </div>
    <div class="service-content">
        <h4><a href="{{route('training-details',"$train->slug-$train->id")}}">{{$train->title}}</a></h4>
        <p>{{$train->short_description}}</p>
        <a href="{{route('training-details',"$train->slug-$train->id")}}" class="icon-bg">
            <i class="fa fa-arrow-circle-o-right"></i>
        </a> 
    </div>
</div>