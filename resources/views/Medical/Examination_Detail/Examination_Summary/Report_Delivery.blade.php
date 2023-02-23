    <div class="form-group general_info white-box pad-5">
    <form method="post" class="form-horizontal" id="report_deliveryForm" action="api/examination_summary/delivery_store">
       @if(!empty($data))
       <input
          type="hidden"
          name="payment_master_id"
          id="payment_master_id"
          value="{{$data->id}}"
          />
       @endif
       <h5 class="navtab_header">Delivery Information</h5>
       <div class="row">
         <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                         <Label>From:</Label>
                         <input
                            type="text"
                            name="delivery_org"
                            id="delivery_org"
                            placeholder="Delivery Organization Name"
                            defaultValue=""
                            class="form-control"
                            />
                      </div>
                   </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                         <Label>To:</Label>
                         <input
                            type="text"
                            name="delivered_org"
                            id="delivered_org"
                            placeholder="Organization to be delivered...."
                            defaultValue=""
                            class="form-control"
                            />
                      </div>
                   </div>
                   </div>
                   <h6>Delivery Person Information </h6>
                     <div class="row">
                   <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                         <Label>Name:</Label>
                         <input
                            type="text"
                            name="delivery_person_name"
                            id="delivery_person_name"
                            placeholder="Delivery Person Name"
                            defaultValue=""
                            class="form-control"
                            />
                      </div>
                   </div>
                    <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                         <Label>Mobile Number:</Label>
                         <input
                            type="text"
                            name="delivery_person_number"
                            id="delivery_person_number"
                            placeholder="Delivery Person Mobile Number"
                            defaultValue=""
                            class="form-control"
                            />
                      </div>
                   </div>
                     <div class="col-md-4 col-sm-12">
                      <div class="form-group">
                         <Label>Depature Time:</Label>
                        <input name="departure_time" id="departure_time" type="datetime-local"  class="form-control">
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
       <div class="alert-success success"></div>
       <div class="alert-danger error" ></div>
    </form>

    