@extends('Layout.Main')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumbs" style="background-image:url('{{asset('frontend/img/breadcrumbs-bg.jpg')}}'">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<!-- Bread Menu -->
					<div class="bread-menu">
						<ul>
							<li>
								<a href="{{route('home')}}">Home</a>
							</li>
							<li>Client Referral Form</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Client Referral Form</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Form Us -->
		<section class="contact-us section-space">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<!-- Contact Form -->
						<div class="contact-form-area referral-form">
							<form class="form" id="referralForm" method="post" action="{{route('referral-form')}}" enctype="multipart/form-data">
								<div class="row">
									{{ csrf_field() }}
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>First Name <span>*</span></label>
											<input type="text" name="first_name" required>
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>Middle Name </label>
											<input type="text" name="middle_name">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>Last Name <span>*</span></label>
											<input type="text" name="last_name" required>
										</div>
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-12">
										<div class="form-group">
											<label>Age</label>
											<input type="number" name="age" min="0" max="150">
										</div>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-9 col-12">
										<div class="form-group">
											<label>Identifies as</label>
											<select name="identity_id" id="identifies_as">
                                                <option class="option" value="">--Select--</option>
												@if (!empty($identities) && count($identities))
												@foreach ($identities as $identity)
                                                <option class="option" data-id="{{$identity->slug}}" value="{{$identity->id}}">{{$identity->name}}</option>
												@endforeach	
												@endif
                                            </select>
										</div>
									</div>
									<div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12 identity_other_div" style="display: none">
										<div class="form-group">
											<label>Identity (Other)</label>
											<input type="text" name="identity_other">
										</div>
									</div>
									<div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label>Preferred Language</label>
											<input type="text" name="language">
										</div>
									</div>
									<div class="col-xl-4 col-lg-3 col-md-3 col-sm-4 col-12">
										<div class="form-group">
											<label>Telephone Number</label>
											<input type="number" name="telephone" min="0">
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-12">
										<div class="form-group">
											<label>Mobile Number</label>
											<input type="number" name="mobile" min="0">
										</div>
									</div>
									<div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Email Address <span>*</span></label>
											<input type="email" name="email" required>
										</div>
									</div>

									<div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-12">
		                                <div class="form-group">
		                                	<label>Preferred method of contact</label>
											<div class="row">
		                                		<div class="col-sm-6 col-6 agree-label">
			                                        <input type="radio" name="contact_method" id="email" value="email">
			                                        <label for="email">
			                                            Email
			                                        </label>
			                                    </div>
			                                    <div class="col-sm-6 col-6  agree-label">
			                                        <input type="radio" name="contact_method" id="phone" value="phone">
			                                        <label for="phone">
			                                            Phone
			                                        </label>
			                                    </div>
		                                	</div>
		                                </div>
		                            </div>
		
									<div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 col-12">
										<div class="form-group">
											<label>Current Address </label>
											<input type="text" name="current_address">
										</div>
									</div>
									
		                            
									<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
		                                <div class="form-group">
		                                	<label>Guardian/Next of Kin:</label>
		                                	<div class="row">
		                                		<div class="col-md-3 col-sm-6">
			                                        <input type="number" name="gk_telephone" placeholder="Telephone" min="0">
			                                    </div>
			                                    <div class="col-md-3 col-sm-6">
			                                        <input type="number" name="gk_mobile" placeholder="Mobile" min="0">
			                                    </div>
			                                    <div class="col-md-6 col-sm-12">
			                                        <input type="text" name="gk_email" placeholder="Email Address">
			                                    </div>
		                                	</div>
		                                </div>
		                            </div>

		                            <div class="col-xl-4 col-lg-5 col-md-7 col-sm-7 col-12">
										<div class="form-group">
											<label>Service Looking For<span>*</span></label>
											<select name="service_id" required>
                                                <option class="option" value="">--Select--</option>
												@if (!empty($services_menu) && count($services_menu))
													@foreach ($services_menu as $service)
													<option class="option" value="{{$service->id}}">{{$service->service_name}}</option>
													@endforeach
                                                <option class="option" value="0">Other</option>
												@endif
                                            </select>
										</div>
									</div>
		                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5 col-12">
										<div class="form-group">
											<label>Plan Management</label>
											<select name="plan_management">
                                                <option class="option" value="">--Select--</option>
                                                <option class="option" value="Self-managed">Self-managed</option>
                                                <option class="option" value="Plan-managed">Plan-managed</option>
                                                <option class="option" value="NDIA managed">NDIA managed</option>
                                                <option class="option" value="I am New">I am New</option>
                                            </select>
										</div>
									</div>
									<div class="col-xl-5 col-lg-4 col-md-8 col-sm-12 col-12">
		                                <div class="form-group">
		                                	<label>Do you have NDIS Participant Number</label>
		                                	<div class="row">
		                                		<div class="col-sm-6 col-6 agree-label">
			                                        <input type="radio" name="has_ndis" id="yes" value="Y">
			                                        <label for="yes">
			                                            Yes
			                                        </label>
			                                    </div>
			                                    <div class="col-sm-6 col-6 agree-label">
			                                        <input type="radio" name="has_ndis" id="no" value="N">
			                                        <label for="no">
			                                            No 
			                                        </label>
			                                    </div>
		                                	</div>
		                                </div>
		                            </div>
									<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
										<div class="form-group">
											<label>Plan Start From</label>
											<input type="date" name="start_date">
										</div>
									</div>
									<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 ">
										<div class="form-group">
											<label>Plan End Date</label>
											<input type="date" name="end_date">
										</div>
									</div>
			
									<div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12">
										<div class="form-group">
											<label>Upload Your Plan</label>
											<input type="file" name="plan_file" >
										</div>
									</div>

									<div class="col-12">
										<div class="form-group textarea">
											<label>NDIS approved diagnosis</label>
											<textarea type="textarea" name="ndis_diagnosis" rows="5"></textarea>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="form-group">
											<label>Referrer Name</label>
											<input type="text" name="referrer_name">
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="form-group">
											<label>Relationship with client</label>
											<select name="relation_with_client">
                                                <option class="option" value="">--Select--</option>
                                                <option class="option" value="Relative">Relative</option>
                                                <option class="option" value="Friend">Friend</option>
                                                <option class="option" value="Organization">Organization</option>
                                                <option class="option" value="Other">Other</option>
                                            </select>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="form-group">
											<label>Referral Position</label>
											<input type="text" name="referral_position">
										</div>
									</div>

									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		                                <div class="form-group">
		                                	<label>Organisation:</label>
		                                	<div class="row">
		                                		<div class="col-md-3 col-sm-5">
			                                        <input type="number" name="org_telephone" placeholder="Telephone" min="0">
			                                    </div>
			                                    <div class="col-md-4 col-sm-7">
			                                        <input type="email" name="org_email" placeholder="Email">
			                                    </div>
			                                    <div class="col-md-5 col-sm-12">
			                                        <input type="text" name="org_address" placeholder="Address">
			                                    </div>
		                                	</div>
		                                </div>
		                            </div>

									<div class="col-12">
										<div class="form-group textarea">
											<label>Reason for Referral</label>
											<textarea type="textarea" name="referral_reason" rows="5"></textarea>
										</div>
									</div>
									<div class="col-12 mt-2 py-2 form-messages"></div>
									<div class="col-12">
										<div class="form-group button">
											<button type="submit" class="homes-btn theme-1 save">Submit</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!--/ End form Form -->
					</div>
				</div>
			</div>
		</section>	
		<!--/ End form Us -->

@endsection

@section('scripts')
<script>
	$(document).off('change','#identifies_as');
	$(document).on('change','#identifies_as',function(){
		let slug = $(this).find(':selected').data('id');
		if (slug == 'other') {
			$('.identity_other_div').show();
		}else{
			$('.identity_other_div').hide();
		}
	});
</script>
@endsection