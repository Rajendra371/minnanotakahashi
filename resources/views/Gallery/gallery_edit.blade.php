@php
    $images = []; 
    if (!empty($details)) {
        foreach ($details as $key => $detail) {
            if (file_exists(public_path('uploads/gallery_image/'.$detail->image_file))) {
                $images[$key]['path'] = asset('uploads/gallery_image/'.$detail->image_file); 
                $images[$key]['name'] = $detail->image_file;
                $images[$key]['id'] = $detail->id;
                $images[$key]['master_id'] = $master->id;
                $images[$key]['size'] = filesize(public_path('uploads/gallery_image/'.$detail->image_file));
            }
        }
    }
@endphp
<script>
    var files = [];
    @if(count($images))
        files = {!! json_encode($images) !!};
    @endif
</script>
<div class="card">
    <div class="card-header">
        <div class="card-title">Gallery Edit</div>
    </div>
    <div class="card-body">
    <form action="api/gallery_setup/store" id="gallerySetupForm" method="POST" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id" value="{{$master->id}}">
        <div class="col-md-6 mb-2 form-group">
            <label>Gallery Category<code>*</code>: </label>
            <select name="gly_catid" id="gly_catid" class="form-control required_field">
                <option value="">--Select--</option>
            @if (!empty($categories)) 
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ $master->gallery_category_id == $category->id ? 'selected' :''}}>{{$category->title}}</option>
                @endforeach
            @endif
            </select>
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Image Title<code>*</code>: </label>
            <input type="text" name="gly_title" id="gly_title" value="{{$master->title}}" class="form-control required_field" placeholder="Enter Image Title">
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Content<code>*</code>: </label>
            <input type="text" name="gly_content" id="gly_content" value="{{$master->content}}" class="form-control required_field" placeholder="Enter Content">
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Display Order: </label>
            <input type="text" name="order" id="order" value="{{$master->order ?? ''}}" class="form-control" placeholder="Enter Display Order"> 
        </div> 
        <div class="col-md-12 form-group">
            <label for="document">Images</label>
            <div class="needsclick dropzone" id="gallery-edit-dropzone">
            </div>
        </div>
        </div>
        <div class="row">
       
        <div class="col-md-3">
            <div class="form-group">            
                <div class="checkbox">
                <input type="checkbox" id="is_display" name="is_display" {{$master->is_display == 'Y' ? 'checked' : ''}} value="Y" />
                <label></label>
                <span>Display</span>
                </div>
            </div>
        </div>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
            <div class="alert-success success"></div>
            <div class="alert-danger error"></div>
            </div>
            <div class="col-md-12">
                <div class="float-right">
                    <button type="button" class="save btn btn-primary btn-md" data-is_table_refresh="Y" data-target_btn="btnRefresh" data-redirect_type='form' data-targetdiv="gallerySetupFormDiv"> <i class="fa fa-dot-circle-o mr-1"></i>Save</button>
                   
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
    const auth_token = localStorage.getItem("backend-jwt-token");
    var galleryEditDropzone = undefined;
    // Dropzone.autoDiscover = false;
    // function initializeDropzone() {
        var uploadedDocumentMap = [];
        galleryEditDropzone = new Dropzone("div#gallery-edit-dropzone",  { url: '{{ route('gallery.upload_image')}}',
        maxFilesize: 5, // MB
            addRemoveLinks: true,
            acceptedFiles:".jpeg, .png, .gif, .jpg", 
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Authorization': 'Bearer'+ auth_token 
            },
            
            success: function (file, response) {
            $('form#gallerySetupForm').append('<input type="hidden" class="images" name="images[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
            },
          
            removedfile: function (file) {
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            let image = $('form#gallerySetupForm').find('input[name="images[]"][value="' + name + '"]');
            let id = $(image).data('id');
            let master_id = $(image).data('masterid');
            axios.post(base_url+"/api/gallery/delete_uploaded_file",{file:name,id,master_id})
            .then((response) => {
                if (response.data.status == 'success') {
                    file.previewElement.remove();
                    $('form#gallerySetupForm').find('input[name="images[]"][value="' + name + '"]').remove()
                }else{
                    alert(response.data.message);
                }
                });
            },
            init: function () {
                console.log('init');
                if(files != undefined && files.length > 0){
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.path);
                        file.previewElement.classList.add('dz-success');
                        file.previewElement.classList.add('dz-complete');
                        $('form#gallerySetupForm').append(`<input type="hidden" data-id="${file.id}" data-masterid="${file.master_id}" name="images[]" value="${file.name}">`)
                        uploadedDocumentMap[file.name] = file.name;
                    }
                }
            }
        } ); 

    
    $(function(){
        var uploadedDocumentMap = [];
    });

</script>
