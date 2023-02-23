<div class="single-service">
    <div class="service-head"> <img src="{{asset("uploads/study_destinations/$dest->image")}}" alt="{{$dest->title}}">
    </div>
    <div class="service-content">
        <h4><a href="{{route('destination-details',"$dest->slug-$dest->id")}}">{{$dest->title}}</a></h4>
        <p>{{$dest->short_content}}</p>
        <a href="{{route('destination-details',"$dest->slug-$dest->id")}}" class="icon-bg">
            <i class="fa fa-arrow-circle-o-right"></i>
        </a> 
    </div>
</div>