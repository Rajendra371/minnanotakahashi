<!-- Appointment -->
<section class="faqs section-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="section-title default text-center">
                    <div class="section-top">
                        <h2>
                            {{-- <span>Get Appointment</span>  --}}
                            <b> Get an Appointment</b>
                        </h2>
                    </div>
                </div>
                <div class="contact-form-area">
                    <div class="appointment_head">
                        <h6> <span> ABROAD STUDY </span> : Australia | Canada | South Korea | Japan | UK | New Zealand</h6>
                        <h6><span> TEST PREPARATION </span> : IELTS | PTE | Japanese Language | Korean Language</h6>
                    </div>
                    <form class="form" id="appointmentForm" method="post" action="{{ route('appointment') }}">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input type="text" name="full_name" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="icon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" name="email" placeholder="Enter E-Mail" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <div class="icon"><i class="fa fa-phone"></i></div>
                                    <input type="number" name="contact_number" placeholder="Enter Number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" name="address" placeholder="Address" required>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Street Address 2</label>
                                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" name="address2" placeholder="Street Address 2" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>City</label>
                                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" name="city" placeholder="City" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>State/Region/Province</label>
                                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                                    <input type="text" name="state" placeholder="State/Region/Province" required>
                                </div>
                            </div> --}}
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Applying Country</label>
                                    <div class="icon"><i class="fa fa-flag"></i></div>
                                    <select class="form-control" aria-placeholder="Choose Country" name="country">
                                        <option value="0">Choose Country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Canada">Canada</option>
                                        <option value="South Korea">South Korea</option>
                                        <option value="UK">UK</option>
                                        <option value="Japan">Japan</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Applying Level</label>
                                    <div class="icon"><i class="fa fa-book"></i></div>
                                    <select class="form-control" aria-placeholder="Choose Level" name="level">
                                        <option value="0">Choose Level</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Bachelors">Bachelors</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Ph.D">Ph.D</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nearest Branch</label>
                                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                                    <select class="form-control" aria-placeholder="Nearest Branch" name="nearest_branch">
                                        <option value="0">Nearest Branch</option>
                                        <option value="Putalisadak">Putalisadak</option>
                                        <option value="Kalanki">Kalanki</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Appointment(Date & Time)</label>
                                    <div class="icon"><i class="fa fa-clock-o"></i></div>
                                    <input type="datetime" name="appointmentdate" placeholder="Appointment(Date & Time)">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <div class="icon"><i class="fa fa-envelope"></i></div>
                                    <textarea type="textarea" name="message" rows="5"></textarea>
                                    {{-- <input type="datetime" name="appointmentdate" placeholder="Appointment(Date & Time)"> --}}
                                </div>
                            </div>
                            <ul class="col-lg-12 col-md-12 col-12 form-messages mt-2"></ul>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group button">
                                    <button type="submit" class="homes-btn theme-1 save">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!--/ End Appointment  -->