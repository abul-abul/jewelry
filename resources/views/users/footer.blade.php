 {!! HTML::style( asset('/new-css/footer.css')) !!}
<!-- Begin footer -->
<footer class="footer">
    <div class="container">
        <div class="upper-foot">
            <div class="row footer_container">
                <div class="col-xs-6 col-sm-3">
                    <h4 style="color: #1C1C1C">ABOUT
                        <span class="footer_ohscarlett"> 
                            <span class="footer_ohscarlett1">OHSCARLETT!</span>
                            <span class="footer_ohscarlett2">JEWELRY</span>
                         </span>
                    </h4>
                    <p class="about">Welcome and thank you for taking an interest in Oh Scarlett. After many years producing by hand for other brand names, it was time to introduce a more proprietary and personal line of jewelry to the marketplace.</p>
                    <a href="{{action('UserController@getAboutShop')}}">
                        <button class="btn hidden-md btn-sm info">Read More</button>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3">
                    <b class="bb">MENU</b>
                    <ul class="list-unstyled"> 
                        <li>
                            <a href="{{action('UserController@getAboutShop')}}">ABOUT US</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getCustomerService')}}" >CUSTOMER SERVICE</a>
                        </li>
                        <li class="footer-login">
                            <a href="javascript:void(0);" >LOGIN</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getRegistration')}}">REGISTER</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getFaq')}}">FAQ</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getContact')}}">CONTACT US</a>
                        </li>
                        <li>
                            <a href="{{action('UserController@getCleanPieaces')}}">HOW TO CLEAN THE PIECES?</a>
                        </li>
                        <li>
                            <a href="#">SALES REPRESENTATIVE</a> 
                        </li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <b class="bb">KEY FEATURES</b>
                    <ol  type="1" class="list-unstyled">
                        <li>
                            <span class="footer_number">1.</span>Proprietary and personal line jewelry
                        </li>
                        <li>
                            <span class="footer_number">2.</span>High standarts using only quality materials
                        </li>
                        <li>
                            <span class="footer_number">3.</span>Diverse designs one can wear and enjoy repeatedly
                        </li>
                        <li>
                            <span class="footer_number">4.</span>All of our stones are semi precious of fresh water pearls.
                        </li>
                    </ol>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <b class="bb">COMPANY INFO</b>
                    <div class="list-unstyled">
                        <span class="about1">Call us :</span><span class="footer_number"> 949-864-6055</span><br />
                        <span class="about1">E-mail : </span><span class="about">hello@ohscarlett.com</span>
                        <br />
                        <div > 
                            <ul class="list-inline social-list social">
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="Facebook" href="https://www.facebook.com/Oh-Scarlett-Jewelry-558620630923781/?fref=ts&ref=br_tf" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li> 
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="Twitter" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="Google+" href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="Pinterest" href="https://www.pinterest.com/ohscarlettt/" target="_blank"><i class="fa fa-pinterest"></i></a>
                                </li>
                                <li>
                                    <a data-toggle="tooltip" data-placement="top" title="Instagram" href="https://www.instagram.com/oh_scarlett_jewelry/" target="_blank"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul> 
                        </div>

                        <input type="hidden" class="sessionCheck">

                        <div style="display: none" class="newsletter-success alert alert-success footer-one">
                        </div>

                        <div style="display: none" class="newsletter-danger alert alert-danger footer-one">
                        </div>

                        <form class="form-inline form-newsletter home-letter" type="POST">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Please enter your email" name="user_email" /> 
                                <input type="hidden" name="footer" value="footer">
                            </div>
                            <button type="submit" class="btn email_btn"><i class="fa fa-caret-right"></i></button>
                        </form>
                        <img alt="paypal" src="/assets/images/Paypal-icon.png" class="paypall">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="below-foot col-md-12">
        <div class="row">
            <div class="footer_menu">
                <a href="{{action('UserController@getSiteMap')}}"> Site Map </a> |  
                <a href="{{action('User\ItemController@getAdvancedSearchPage')}}"> Advanced Search </a> | 
                <a href="#"> Orders and Returns </a> | 
                <a href="{{action('UserController@getAboutShop')}}"> About Us </a> | 
                <a href="{{action('UserController@getCustomerService')}}"> Costomer Service </a>
                <br />
                © 2016 Oh Scarlett Store. All rights reserved.
            </div>
            <br />
        </div>
    </div>
</footer>
<!-- End footer -->
<!-- Begin Search -->
<div class="modal fade bs-example-modal-lg search-wrapper" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p class="clearfix"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></p>
            <form class="form-inline form-search">
                <div class="form-group">
                    <label class="sr-only" for="textsearch">Enter text search</label>
                    <input type="text" class="form-control input-lg" id="textsearch" />Enter text search
                </div>
                <button type="submit" class="btn btn-white">Search</button>
            </form>
        </div>
    </div>
</div>
    <!-- End Search -->
