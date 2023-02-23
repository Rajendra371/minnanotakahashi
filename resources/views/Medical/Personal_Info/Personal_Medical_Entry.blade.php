  <?php 
      error_reporting(0);
      $general_exam=$data['general_exam'];
      $systemic_exam=$data['systemic_exam'];
      $laboratory_exam=$data['laboratory_exam'];
  ?>
     <div class="form-group general_info white-box pad-5">
        <form method="post" class="form-horizontal" id="medicaldataForm" action="api/examination/medical_data_store">
           <input
              type="hidden"
              name="person_id"
              id="person_id"
              value="{{$data['person_id']}}"
              />
           <div class="clear"></div>
           <div class="exam-table">
              <div class="row">
                 <div class="col-md-4">
                    <div class="card-header"><h5 class="card-title">General Information</h5></div>
                    <div class="exam-table-wrapper">
                       <table class="exam_table" border="1">
                          <thead>
                             <tr>
                                <th>S.N</th>
                                <th>Examination</th>
                                <th>Result</th>
                             </tr>
                          </thead>
                          <tbody>
                    
                        @if(!empty($general_exam))
                             @foreach($general_exam as $key=>$row)
                             <tr>
                                <td>{{$key+1}}</td>
                                 <td>{{$row->examination_name}}</td>
                                <td>
                                    <input
                                    type="text"
                                    name="examination_id[]"
                                    id="examination_id"
                                    class="form-control"
                                    value="{{$row->id}}"
                                    hidden
                                    />
                                   <input
                                      type="text"
                                      name="checkup_data[]"
                                      id="checkup_data[]"
                                      placeholder="Enter data......."
                                      class="form-control"
                                      />
                                </td>
                             </tr>
                             @endforeach
                             @else
                             <h6>No exam is selected</h6>
                             @endif
                          </tbody>
                       </table>
                    </div>
                 </div>
                   <div class="col-md-4">
                       <div class="card-header"><h5 class="card-title">Systemic Examination</h5></div>
                    <div class="exam-table-wrapper">
                       <table class="exam_table">
                          <thead>
                             <tr>
                                <th>S.N</th>
                                <th>Examination</th>
                                <th>Result</th>
                             </tr>
                          </thead>
                          <tbody>
                              @if(!empty($systemic_exam))
                             @foreach($systemic_exam as $gkey=>$grow)
                             <tr>
                                <td>{{$gkey+1}}</td>
                                 <td>{{$grow->examination_name}}</td>
                                <td>
                                    <input
                                    type="text"
                                    name="examination_id[]"
                                    id="examination_id[]"
                                    class="form-control"
                                    value="{{$grow->id}}"
                                    hidden
                                    />
                                   <input
                                      type="text"
                                      name="checkup_data[]"
                                      id="checkup_data[]"
                                      placeholder="Enter data......."
                                      class="form-control"
                                      />
                                </td>
                             </tr>
                             @endforeach
                              @else
                             <h6>No exam is selected</h6>
                             @endif
                          </tbody>
                       </table>
                    </div>
                 </div>
                   <div class="col-md-4">
                       <div class="card-header"><h5 class="card-title">Laboratory Examination</h5></div>
                    <div class="exam-table-wrapper">
                       <table class="exam_table" border="1">
                          <thead>
                             <tr>
                                <th>S.N</th>
                                <th>Examination</th>
                                <th>Result</th>
                             </tr>
                          </thead>
                          <tbody>
                                @if(!empty($laboratory_exam))
                             @foreach($laboratory_exam as $lkey=>$lrow)
                             <tr>
                                <td>{{$lkey+1}}</td>
                                 <td>{{$lrow->examination_name}}</td>
                                <td>
                                    <input
                                    type="text"
                                    name="examination_id[]"
                                    id="examination_id[]"
                                    class="form-control"
                                    value="{{$lrow->id}}"
                                    hidden
                                    />
                                   <input
                                      type="text"
                                      name="checkup_data[]"
                                      id="checkup_data[]"
                                      placeholder="Enter data......."
                                      class="form-control"
                                      />
                                </td>
                             </tr>
                             @endforeach
                              @else
                             <h6>No exam is selected</h6>
                             @endif
                          </tbody>
                       </table>
                    </div>
                 </div>
                 <div class="clearfix">
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
     </div>
     </div>
     </form>
     </div>
     <div class="clearfix"></div>
     <div class="alert-success success"></div>
     <div class="alert-danger error"></div>