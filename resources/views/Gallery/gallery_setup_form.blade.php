@php
    $images = []; 
    // if (!empty($details)) {
    //     foreach ($details as $key => $file) {
    //         if (file_exists(public_path('uploads/cv_path/'.$file))) {
    //             $images[$key]['path'] = asset('uploads/cv_path/'.$file); 
    //             $images[$key]['name'] = $file;
    //             $images[$key]['size'] = filesize(public_path('uploads/cv_path/'.$file));
    //         }
    //     }
    // }
@endphp
<script>
    var files = [];
    @if(isset($cv_data) && count($images))
        files = {!! json_encode($images) !!};
    @endif
</script>
<div class="card">
    <div class="card-header">
        <div class="card-title">Gallery Setup</div>
    </div>
    <div class="card-body">
    <form action="api/gallery_setup/store" id="gallerySetupForm" method="POST" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id" value="">
        <div class="col-md-6 mb-2 form-group">
            <label>Gallery Category<code>*</code>: </label>
            <select name="gly_catid" id="gly_catid" class="form-control required_field">
                <option value="">--Select--</option>
            @if (!empty($categories)) 
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            @endif
            </select>
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Image Title<code>*</code>: </label>
            <input type="text" name="gly_title" id="gly_title" value="" class="form-control required_field" placeholder="Enter Image Title">
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Content<code>*</code>: </label>
            <input type="text" name="gly_content" id="gly_content" value="" class="form-control required_field" placeholder="Enter Content">
        </div> 
        <div class="col-md-6 mb-2 form-group">
            <label>Display Order: </label>
            <input type="text" name="order" id="order" value="" class="form-control" placeholder="Enter Display Order">
        </div> 
        <div class="col-md-12 form-group">
            <label for="document">Images</label>
            <div class="needsclick dropzone" id="document-dropzone">
                {{-- <div class="dz-message">
                    <h4>Drag Files to Upload</h4>
                    <span>Or click to browse</span>
                </div> --}}
            </div>
        </div>
        </div>
        <div class="row">
       
        <div class="col-md-3">
            <div class="form-group">            
                <div class="checkbox">
                <input type="checkbox" id="is_display" name="is_display" value="Y" />
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
    var documentDropzone = undefined;
    var files = undefined;
    // Dropzone.autoDiscover = false;
    // function initializeDropzone() {
        var uploadedDocumentMap = [];
        documentDropzone = new Dropzone("div#document-dropzone",  { url: '{{ route('gallery.upload_image')}}',
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
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            axios.post(base_url+"/api/gallery/delete_temp_files",{temp_files:[name]}).then(response => {
                console.log(response.data.status); 
            });
            $('form#gallerySetupForm').find('input[name="images[]"][value="' + name + '"]').remove()
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
                        $('form#gallerySetupForm').append('<input type="hidden" name="images[]" value="' + file.name + '">')
                        uploadedDocumentMap[file.name] = file.name;
                    }
                }
            }
        } );

    
    $(function(){
        var uploadedDocumentMap = [];
    });

</script>
