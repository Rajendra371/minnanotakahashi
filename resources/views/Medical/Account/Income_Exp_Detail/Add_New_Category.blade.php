<form method="post" class="form-horizontal" id="income_exp_categoryForm" action="api/income_exp_category/store">
        <div class="payment_wrapper">
           <h5 class="navtab_header">Income Expenditure Category</h5>
              <div class="row">
                 <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                       <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Select Category:</span>
                      <select class="form-control" name="parent_id" id="parent_id">
                        <option value="0">-- Select --</option>
                        @foreach ($data as $value)
                            <option value="{{ $value->id }}"> {{ $value->title }} </option>
                        @endforeach    
                    </select>
                    </div>
                 </div>
                 <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                       <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Title:</span>
                       <input
                          type="text"
                          name="title"
                          id="title"
                          defaultValue=""
                          class="form-control required_field"
                          />
                    </div>
                 </div>
              </div>
           </div>
           <div class="clearfix">
              <div class="float-left">
                 <button
                    type="submit"
                    size="md"
                    color="primary"
                    class="save btn btn-primary btn-md"
                    >
                 <i class="fa fa-dot-circle-o"></i> Save
                 </button>
              </div>
           </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error" ></div>
     </form>