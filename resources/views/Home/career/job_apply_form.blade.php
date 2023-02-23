<div class="modal fade" id="applyNowModal" tabindex="-1" role="dialog" aria-labelledby="applyNowModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="applyNowModalTitle">Apply For {{$career->job_title ?? 'Job'}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="contact-form-area">
            <form class="form" id="applyJobForm" method="post" action="{{route('apply-job')}}">
                <div class="row">
                    <input type="hidden" name="job_id" value="{{$career->id ?? ''}}">
                    <div class="col-xl-4 col-lg-4 col-md-7 col-sm-7 col-12"> 
                        <div class="form-group">
                            <label>Full Name <span>*</span></label>
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <input type="text" name="full_name" required>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5 col-12">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <input type="number" name="contact_number">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12  col-sm-12 col-12">
                        <div class="form-group">
                            <label>Email Address <span>*</span></label>
                            <div class="icon"><i class="fa fa-envelope"></i></div>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Upload Resume<span>*</span></label>
                            <div class="icon"><i class="fa fa-file"></i></div>
                            <input type="file" name="cv" required>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="form-group">
                            <label>Upload Cover Letter<span>*</span></label>
                            <div class="icon"><i class="fa fa-file"></i></div>
                            <input type="file" name="cover_letter" required>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-2 py-2 form-messages"></div>
                    <div class="col-12">
                        <div class="form-group button">
                            <button type="submit" class="homes-btn theme-1 save">Apply</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>