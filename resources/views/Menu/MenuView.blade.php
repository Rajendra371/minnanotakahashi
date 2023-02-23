<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Menu Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Menu Title:</label>
            <span>{{$data->menu_name}}</span>
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Alias:</label>
            <span>{{$data->menu_slug}}</span>
         </div>
        <div class="col-md-4 col-sm-4">
            <label>Parent Menu:</label>
            <select name="menu_parent" id="menu_parent" class="form-control">
               <option>--Select--</option>
               @if(!empty($menu_data)) 
               @foreach($menu_data as $cat)
                   <option value="{{$cat->id}}" @if($data->menu_parent==$cat->id) {{"selected=selected"}} @endif  >{{$cat->menu_name}} </option>
               @endforeach
               @endif
           </select>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Menu Item Type:</label>
            <span>{{$data->menu_typeid}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
         <label>URL:</label>
         <span>{{$data->menu_url}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Display Order:</label>
         <span>{{$data->menu_order}}</span>
      </div> 
      <div class="col-md-4 col-sm-4">
         <label>Is Publish:</label>
         <span>{{$data->menu_isactive}}</span>
      </div> 
       <div class="col-md-4 col-sm-4">
          <label>Menu Location Top :</label>
          <span>{{$data->menu_istop}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
         <label>Menu Location Main :</label>
         <span>{{$data->menu_ismain}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Menu Location Footer :</label>
         <span>{{$data->menu_isfooter}}</span>
      </div>
   @endif
</div>
   
      