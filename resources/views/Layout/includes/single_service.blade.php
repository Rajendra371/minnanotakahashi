<div class="single-service">
    <div class="service-head"> <img src="{{asset("uploads/service_image/$service->image")}}" alt="{{$service->service_name}}">
    </div>
    <div class="service-content">
        <h4><a href="{{route('service-details',"$service->slug-$service->id")}}">{{$service->service_name}}</a></h4>
        <p>{{$service->short_content}}</p>
        <a href="{{route('service-details',"$service->slug-$service->id")}}" class="icon-bg">
            <i class="fa fa-arrow-circle-o-right"></i>
        </a> 
    </div>
</div>
