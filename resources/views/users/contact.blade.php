 @extends('layouts.app')
 @section('content')

<!-- Begin Main -->
		<div role="main" class="main">
		
			<!-- Begin page top -->
	<section class="page-top" >
		<div class="container" >
			<div class="page-top-in" >
				<h2><span> GET IN TOUCH </span></h2>
			</div>
		</div>
	</section>
			<!-- End page top -->
			<div class="container">
				<div class="row">
				<div class="col-sm-2"></div>
					<div class="col-sm-6 animation"> 
						<div class="contact-content">
						<h4>Contact Form</h4>
@if(Session::has('contact_error'))

    <div class="alert alert-danger " style="width: 48%">
        {{Session::get('contact_error')}}
    </div>

<?php Session::forget('contact_error') ?> 
@endif

@if(Session::has('contact_message'))

    <div class="alert alert-success"  style="width: 48%">
        {{Session::get('contact_message')}}
    </div>

<?php Session::forget('contact_message') ?>
@endif
<br />
							
							<form id="contact-form" name="form1" method="post" action="{{action('UserController@postSendContact')}}">
								{!! csrf_field() !!}
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
                                            <label for="subject">Subject<b style="color:red; font-size: 1.8em">*</b></label>
                                            <input name="subject" type="text" id="subject" class="form-control" value="" data-msg-required="Please enter the subject." required>
                                        </div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-xs-6">
											<label for="name">Your Name<b style="color:red; font-size: 1.8em">*</b></label>
											<input name="name" type="text" id="name" class="form-control" value="{{$name}}" data-msg-required="Please enter your name." required>
										</div>
										<div class="col-xs-6">
											<label for="email">Your Email<b style="color:red; font-size: 1.8em">*</b></label>
											<input name="email" type="text" id="mail" class="form-control" value="{{$email}}" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." required>
										</div>

									</div>
								</div>
								<div class="form-group">
									<label for="message">Your Message<b style="color:red; font-size: 1.8em">*</b></label>
									<textarea name="message" id="message" class="form-control" rows="3" data-msg-required="Please enter your message." required></textarea>
								</div>
								<div class="form-group">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-3 animation">
						<div class="contact-content">
							<address>
								<i class="fa fa-map-marker"></i> Address:1 Claret Drive<br>
								Irvine CA.92614<br>
								<i class="fa fa-envelope"></i> <a href="mailto:mail@domainname.com">Email:hello@ohscarlett.com</a>
							</address>
						</div>
					</div>
				</div>
			</div>
			<!-- Google Map -->
			<!-- <div class="animation" id="googlemaps"></div> -->
		</div>
		<!-- End Main -->

 @endsection