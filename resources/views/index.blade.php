<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="/site.webmanifest">
    <base href="/" />
     <?php $base_url=\URL::to('/'); ?>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/css/modal.css')}}" rel="stylesheet">
    <link href="{{asset('/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/plugin/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('/plugin/nepalidatepicker/nepali.datepicker.v2.2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/plugin/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/plugin/select2/select2.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{asset('/plugin/template/all.css')}}" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="{{asset('/plugin/autocomplete/jquery-ui.css')}}">
    <link href="{{ asset('/plugin/Trumbo/dist/ui/trumbowyg.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
   
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
        var base_url="<?php echo $base_url;  ?>";
    </script>
   
</head>
<body class="header-fixed sidebar-lg-show sidebar-fixed aside-menu-fixed aside-menu-off-canvas sidebar-minimized brand-minimized">
<div id="app">
    @yield('content')
   
</div>
<div class="notify notification">
</div>
<div class="notify notification_error">
</div>
<!-- Scripts -->
<script>
function load_datepicker(isloadcurdate='Y')
{
     
     setTimeout(function() {
     $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        todayHighlight:true
        })
    }, 700);
    if(isloadcurdate=='Y'){
        load_current_date();
    }
}

function load_np_datepicker()
{
    setTimeout(function() {
        $(".npdatepicker").nepaliDatePicker({
        npdMonth: true,
        npdYear: true,
        npdYearCount: 10 // Options | Number of years to show
        })
        }, 1000); 
}

function load_current_date()
{

    var url='api/common/current_date';
    axios
    .get(url)
    .then(response => {
         var resp = response.data;
        if(resp.status=='success')
        {
            $('.datepicker').val(resp.current_date);
        }
        else{
             $('.datepicker').val();
        }
          })
    .catch(error => {
      console.log(error);
    });
}


function load_datatable()
{
     setTimeout(function() {
          $('.dataTable').DataTable();
         }, 2000);
}
function load_select2()
{
     setTimeout(function() {
          $('.select2').select2();
         }, 2100);
}

// function load_ckeditor()
// {
//     setTimeout(function() {
//     //remove all editor instance first
//     for(name in CKEDITOR.instances)
//     {
//         CKEDITOR.instances[name].destroy(true);
//     } 
//     $('.ckeditor').each(function(e){
//         CKEDITOR.replace( this.id,{
//         resize_dir: 'vertical',
//         resize_maxHeight: 500,
//         });
//     })
//     }, 500);
// }

function load_ckeditor() {
    setTimeout(function() {
        console.log('ckeditor called');
        $(".ckeditor").trumbowyg({
            btns: [
                ["viewHTML"],
                ["undo", "redo"], // Only supported in Blink browsers
                ["formatting"],
                ["strong", "em", "del"],
                ["superscript", "subscript"],
                ["link"],
                ["insertImage"],
                ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
                ["unorderedList", "orderedList"],
                ["horizontalRule"],
                ["removeformat"],
                ["fullscreen"],
                ["base64"],
            ],
            autogrow: true,
            removeformatPasted: true,
            tagsToRemove: ["script"],
            defaultLinkTarget: "_blank",
        });
    }, 500);
}

function checkValidValue(value=false,selector=false){
        if(isNaN(value) || value == "" || value == 'Infinity'){
            value = 0;
            if(selector){
                $('#'+selector).val(0);
                $('#'+selector).select();    
            }
        }else{
            value = parseFloat(value);
        }
        return value;
 }

</script>
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<script src="{{mix('/js/app.js')}}"></script>
<script src="{{asset('/plugin/autocomplete/jquery-1.12.4.js')}}"></script>
<script src="{{asset('/plugin/autocomplete/jquery-ui.js')}}"></script>
<script src="{{asset('/plugin/nepalidatepicker/nepali.datepicker.v2.2.min.js')}}"></script>
 <script src="{{asset('/plugin/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/js/custom.js')}}"></script>
 <script src="{{asset('/plugin/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugin/datatables/jquery.dataTables.columnFilter.js')}}"></script>
<script src="{{asset('/plugin/datatables/dataTables.fixedColumns.min.js')}}"></script>
<script src="{{asset('/plugin/print/printthis.js')}}"></script>
<script src="{{asset('/plugin/select2/select2.min.js')}}"></script>
<script src="{{asset('/js/modal.js')}}"></script>
<script src="{{asset('/plugin/print/printthis.js')}}"></script>
{{-- <script src="{{asset('/plugin/ckeditor/ckeditor.js')}}"></script>  --}}
<script src="{{ asset('/plugin/Trumbo/dist/trumbowyg.js') }}"></script>
<script src="{{ asset('plugin/Trumbo/dist/plugins/base64/trumbowyg.base64.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>


<script>

$(document).ready(function() {
    $(document).on("click",".nav-link",function() {
        $('.nav-link').removeClass('show');
    });
   
});


</script>
<div
    className="modal fade modal_view modal_md" id="myView"
        tabIndex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
     <div class="main_modal modal_lg">
    <div className="modal-dialog modal-lg">
    <a href="#" class="close-button"><i class="fa fa-times"></i></a>
        <div className="modal-content xyz-modal-123">
            <div className="modal-header">
                <h4 className="modal-title" id="modal_head"></h4>
            </div>
            
            <div class="modal-body displyblock" id="modal_body">
                <!-- <div class="scroll"></div> -->
            </div>
        </div>
        <!-- <div class="close_btn clearfix">
            <a href="#" class="modalclose_btn pull-right btn btn-info">Close</a>
        </div> -->
    </div>
</div>
</div>
</body>
</html>

<script>
$(document).off('click','.link');
$(document).on('click','.link',function(e){
    // alert($(this).attr("href"));
     $(this).addClass("selected");
     $('.link').not(this).removeClass('selected');
})
</script>
