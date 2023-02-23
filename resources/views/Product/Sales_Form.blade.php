<div class="card">
<div class="card-header">
<h5 class="card-title">Sales Setup Form</h5>
</div>
<div class="card-body">
<form class="form-horizontal" id="productcatForm" action="api/sales_setup/store" method="POST">
<div class="row">
<input type="hidden" name="id" value="" />
<div  class="col-md-6 form-group">
<Label>
Parent Category:<code>*</code>
</Label>
{!! $category_list !!}
</div>
<div class="col-md-6 form-group">
<Label>
Products<code>*</code>:
</Label>
<select
type="select"
name="product_select"
class="required_field form-control"
id="product_select"
>
<option value="all">All</option>
<option value="custom">Custom Select</option>
</select>
</div>
<div id="product_list_wrapper" class="col-md-12">
    <div id="product_list"></div>
</div>   
<div class="col-md-6 form-group">
<Label>
Discount Percent<code>*</code>:
</Label>
<input
type="text"
name="discount_percent"
placeholder="Discount Percent (%)"
class="required_field form-control"
id=""
/>
</div>
<div class="col-md-6 form-group">
<Label>Start Date:</Label>
<input
type="text"
name="start_datead"
id="start_datead"
placeholder="YYYY-MM-DD"
class="datepicker required_field form-control"
/>
</div>
<div class="col-md-6 form-group">
<Label>End Date:</Label>
<input
type="text"
name="end_datead"
id="end_datead"
placeholder="YYYY-MM-DD"
class="datepicker required_field form-control"
/>
</div>
</div>
<div class="col-md-6">
    <div class="form-group">            
    <div class="checkbox">
    <input type="checkbox" id="is_active" name="is_active" value="Y"  />
    <label></label>
    <span>Is Publish</span>
    </div>
    </div>
</div>
<div class="card-footer">
    <div class="col-md-12">
        <div class="float-right">
            <button type="submit" class="save btn btn-primary btn-md" > 
            <i class="fa fa-dot-circle-o mr-1"></i>Save</button>
            <button type="button" class="btnreset btn btn-danger btn-md">
            <i class="fa fa-ban mr-1"></i>Reset</button>  
        </div>
    </div>
    <div class="alert-success success"></div>
    <div class="alert-danger error"></div>
</div>
</form>
</div>
</div>

<script>
    load_datepicker();

    $(document).off('change','#product_select,#category_id');
    $(document).on('change','#product_select,#category_id',function(){
            let category_id = $('#category_id').val();
            let product_select = $('#product_select').val();
            if( category_id !== "0" && product_select == "custom" ){
                axios
                .post(constvar.api_url + "sales_setup/get_product_list", {
                category_id: category_id,
                })
                .then((res) => {
                if (res.data.status == "success") {
                    $('#product_list_wrapper').show();
                    $('#product_list').html(res.data.data);
                } 
                });
            } else if(product_select == 'all') {
                $('#product_list_wrapper').hide();
            }else{
                $("#category_id").focus();
                $('#product_list_wrapper').hide();
            }
                
    });

</script>
