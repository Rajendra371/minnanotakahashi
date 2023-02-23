<div class="card">
    <h5 class="card-title">
        {{$master->title}}
    </h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-2 form-group">
                <label>Category: </label>
                <span>{{$master->category_title}}</span>
            </div>
            <div class="col-md-3 mb-2 form-group">
                <label>Content: </label>
                <span>{{$master->content}}</span>
            </div>
            <div class="col-md-3 mb-2 form-group">
                <label>Order: </label>
                <span>{{$master->order ?? ''}}</span> 
            </div>
            <div class="col-md-3 mb-2 form-group">
                <label>Posted Date: </label>
                <span>{{$master->postdatebs}}</span>
            </div>
        </div>
        <input type="hidden" id="master_id" value="{{$master->id}}">
        @if (!empty($details))
        <div class="row">
            @foreach ($details as $detail)
            @if ( !empty($detail->image_file) && file_exists(public_path("uploads/gallery_image/$detail->image_file")) )
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image" id="image_{{$detail->id}}">
                    <div class="img-wrapper">
                    <a data-fancybox="gallery" data-src="{{asset("uploads/gallery_image/$detail->image_file")}}">
                    <img src="{{ asset("uploads/gallery_image/$detail->image_file") }}" height='200px' width='200px'>     
                    </a>  
                    <button class="btn btn-sm btn-danger removeImageBtn" data-id="{{$detail->id}}"><i class="fa fa-trash"></i></button>            
                    </div> 
                </div>
                @endif
            @endforeach
        </div>
        @endif
    </div>
</div>
<script>
    Fancybox.bind('[data-fancybox="gallery"]', {
        infinite: false,
    });

    $(document).off('click','.removeImageBtn');
    $(document).on('click','.removeImageBtn',function(){
        let id = $(this).data('id');
        let master_id = $('#master_id').val();
        if (confirm('Delete Image ?')) {
            axios.post('/api/gallery/delete_single_image',{id,master_id})
            .then((response)=>{
                if (response.data.status == 'success') {
                    $('#image_'+id).remove();
                }else{
                    $(this).html('Failed');
                }
            })
        }
    });
</script>