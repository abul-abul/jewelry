@if (Session::has('errors'))
<div class="col-sm-8">
    <div class="alert alert-danger">
       @foreach ($errors->all() as $error)
           {{ $error }}<BR>       
       @endforeach
   </div>
</div>
  <?php Session::forget('errors') ?>
@endif

@if (Session::has('errorMessages'))
<div class="col-sm-8">
    <div class="alert alert-danger">
       @foreach (Session::get('errorMessages') as $error)
           @foreach($error as $value)
           {{$value}}<BR>
           @endforeach       
       @endforeach
   </div>
</div>
  <?php Session::forget('errorMessages') ?>
@endif

@if(Session::has('error') )

    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>

<?php Session::forget('error') ?>
@endif

@if(Session::has('error_danger'))
<div class="col-sm-8">
    <div class="alert alert-danger">
        {{Session::get('error_danger')}}
    </div>
</div>
<?php Session::forget('error_danger') ?>
@endif

@if(Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>

<?php Session::forget('message') ?> 
@endif


@if(Session::has('footer_error'))

    <div class="alert alert-danger">
        {{Session::get('footer_error')}}
    </div>

<?php Session::forget('footer_error') ?>
@endif

@if(Session::has('review_error'))

    <div class="alert alert-danger">
        {{Session::get('review_error')}}
    </div>

<?php Session::forget('review_error') ?>
@endif

@if(Session::has('review_message'))

    <div class="alert alert-success">
        {{Session::get('review_message')}}
    </div>

<?php Session::forget('review_message') ?>
@endif

@if(Session::has('contact_error'))

    <div class="alert alert-danger">
        {{Session::get('contact_error')}}
    </div>

<?php Session::forget('contact_error') ?> 
@endif

@if(Session::has('contact_message'))

    <div class="alert alert-success">
        {{Session::get('contact_message')}} 
    </div>

<?php Session::forget('contact_message') ?>
@endif

@if(Session::has('acoount_error'))

    <div class="alert alert-danger">
        {{Session::get('acoount_error')}}
    </div>

<?php Session::forget('acoount_error') ?> 
@endif

@if(Session::has('account_message'))

    <div class="alert alert-success">
        {{Session::get('account_message')}}
    </div>

<?php Session::forget('account_message') ?>
@endif

@if(Session::has('password_error'))

    <div class="alert alert-danger">
        {{Session::get('password_error')}}
    </div>

<?php Session::forget('password_error') ?> 
@endif

@if(Session::has('password_message'))

    <div class="alert alert-success">
        {{Session::get('password_message')}}
    </div>

<?php Session::forget('password_message') ?>
@endif