@extends('layouts.app')

@section('content')
{!! HTML::style( asset('new-css/proceed-to-checkout.css')) !!}
<div role="main" class="main">
	<section class="page-top">
		<div class="container">
			<div class="page-top-in">
				<h2><span> checkout </span></h2>
			</div>
		</div>
	</section>
	<div class="container">	
		<div class="row featured-boxes checkout-one col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
				<h3 >Your selection (<t class="items_count" value="{{$availableCount}}" data-currency="{{$currency_symbol}}">{{$availableCount}}</t> items)<br />
				<br/>Review order
				</h3>
				<div class="featured-box featured-box-cart table-responsive">
					<div class="box-content">
						<table cellspacing="0" class="table shop_table">
							<thead>
								<tr>
									<th class="product-thumbnail"> 
										Product
									</th>
									<th class="product-name">
										
									</th>
									<th class="product-price">
										Price
									</th>
									<th class="product-quantity">
										Quantity
									</th>
									<th class="product-subtotal">
										SubTotal
									</th>
									<th class="product-remove">
										&nbsp;
									</th>
								</tr>
							</thead>
							<tbody order="true">
								@foreach($items as $item)
								@if($item->pivot->status != 'ordered')
								<tr order="true" class="cart_table_item">
									<td  class="product-thumbnail">
										<a href="shop-product-sidebar.html">
										@if($item->main_image)
										<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}"><img class="checkout-main-image" alt="{{$item->alt}}" src="{{URL::asset('/uploads/'.$item->main_image)}}" ></a>
										@else
										<a href="{{URL::to('item/item',[$item->category->category, $userItem['item']->slug])}}"><img src="{{URL::asset('/default/default_img.jpg')}}" class="img-responsive" alt="{{$userItem['item']->alt}}"></a>

										@endif
										</a>
									</td>
									<td class="product-name">
										<a href="{{URL::to('item/item',[$item->category->category, $item->slug])}}">{{$item->title}}</a>
									</td>
									<td class="product-price">
										<span >${{$item->new_price}}</span>
									</td>
									<td class="product-quantity">
										<div class="quantity pull-left">
											<span>{{$item->pivot->quantity}}</span> 
										</div>										
									</td>
									<td class="product-subtotal">
										<span class="amount total_price" data-price="{{$item->price * $item->pivot->quantity}}"><t  data-price="{{$item->new_price * $item->pivot->quantity}}" class="{{$item->id}}price">
										${{$item->new_price * $item->pivot->quantity}}</t></span>
									</td>
									<td class="product-remove">
									    @if($item->pivot->order == "1")
                                       
                                            <button  class=" btn-primary true btn-xs" alt="{{$item->id}}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                     
                                            <button class=" default false btn-xs" alt="{{$item->id}}">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                        
                                        @else
                                       
                                            <button  class="default true btn-xs" alt="{{$item->id}}">
                                                <i class="fa fa-check"></i>
                                            </button>
                                      
                                            <button  class=" btn-danger false btn-xs" alt="{{$item->id}}">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </button>
                                        
                                        @endif
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="featured-box featured-box-secondary">
							<div class="box-content">
								<h4>Promotional Code</h4>
								<p>Enter promotional code if you have one</p>
								<form action="" id="" type="post">
									<div class="form-group">
										<label class="sr-only">Promotional code</label>
										<input type="text" value="" class="form-control" placeholder="Enter promotional code here">
									</div>
									<div class="form-group">
										<input type="submit" value="Apply Promotion" class="btn btn-grey btn-sm" data-loading-text="Loading...">
									</div>
								</form>
							</div>
						</div>
					</div>						
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
					@if(Session::has('message') )
					    <div class="alert alert-success">
					        {{Session::get('message')}}
					    </div>
					<?php Session::forget('message') ?>
					@endif
					@if(Session::has('errors') )
					        @foreach(Session::get('errors') as $error)
					        <div class="alert alert-danger">
					        {{$error}}
					        </div>
					        @endforeach
					<?php Session::forget('errors') ?>
					@endif
					@if(Session::has('error') )
						<div class="alert alert-danger">
					       {{Session::get('error')}}
				        </div>
						<?php Session::forget('error') ?>
					@endif
				<div class="featured-box featured-box-secondary sidebar featured-box-ship-to">
					<div class="box-content">
						<h4>Ship to:</h4>
						<table cellspacing="0" class="cart-totals shipping_address">
							<tbody>
								<tr>
									<th style="margin-bottom: 10px" class="product-name">
										Name
									</th>
									<td >
										{{$user->first_name}} {{$user->last_name}}
									</td>
								</tr>
								<tr >
									<th  class="product-name">
										Country
									</th>
									<td >
										{{$shipping->country}}
									</td>
								</tr>
								<tr >
									<th  class="product-name">
										City
									</th>
									<td>
										{{$shipping->city}}
									</td>
								</tr>
								<tr >
									<th  class="product-name">
										Address
									</th>
									<td>
										{{$shipping->address}}
									</td>
								</tr>
								<tr >
									<th  class="product-name">
										Postal code
									</th>
									<td >
										{{$shipping->postal_code}}
									</td>
								</tr>										
							</tbody>
						</table>
						<button class="btn btn-default btn-block btn-sm" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Edit</button>
						<div id="collapseThree" class="panel-collapse collapse ">
							<br />									
							{!! Form::model($user, ['action' => ['UserController@postEditShippingAddress', $user->id], 'files' => 'true','class' => 'login-form', 'role' => 'form' ]) !!}
								<b>Country</b>
								<select style="border-color:grey;width: 100%; height: 35px; padding-left: 10px;" value="{{$shipping->country}}" name="country" type="text">
									<option value="{{$shipping->country}}">{{$shipping->country}}</option>
									<option value="Afganistan">Afghanistan</option>
									<option value="Aland Islands">Aland Islands</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bonaire">Bonaire</option>
									<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
									<option value="Brunei  Darussalam">Brunei  Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>									
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Channel Islands">Channel Islands</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos  (Keeling) Island">Cocos  (Keeling) Island</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote DIvoire">Cote D'Ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Curaco">Curacao</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands  (Malvinas)">Falkland Islands  (Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Ter">French Southern Ter</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-Bissau">Guinea-Bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
									<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran">Iran</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jersey">Jersey</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea North">Korea North</option>
									<option value="Korea Sout">Korea South</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="People's Democratic Republic">Lao People's Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libya">Libya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macau">Macau</option>
									<option value="Macedonia">Macedonia</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Malawi">Malawi</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
									<option value="Moldova">Moldova</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Nambia">Nambia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Phillipines">Philippines</option>
									<option value="Pitcairn Island">Pitcairn Island</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Republic of Montenegro">Republic of Montenegro</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Rwanda">Rwanda</option>
									<option value="St Barthelemy">St Barthelemy</option>
									<option value="St Helena">St Helena</option>
									<option value="St Kitts-Nevis">St Kitts-Nevis</option>
									<option value="St Lucia">St Lucia</option>
									<option value="St Maarten">St Maarten</option>
									<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
									<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
									<option value="Saipan">Saipan</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Sint Maarten (Dutch)">Sint Maarten (Dutch)</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
									<option value="South Sudan">South Sudan</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syria</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-Leste">Timor-Leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Erimates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="USA">United States of America</option>
									<option value="Uraguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Vatican City State">Vatican City State</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Vietnam">Vietnam</option>
									<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
									<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
									<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
									<option value=""></option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select>
								<br />
								<b>City</b>
								<input class="form-control" value="{{$shipping->city}}" type="text" name="city"></input>
								<br />
								<b>State</b>
								<input class="form-control" value="{{$shipping->state}}" type="text" name="state"></input>
								<br />
								<b>Address</b>
								<input class="form-control" value="{{$shipping->address}}" type="text" name="address"></input>
								<br />
								<b>Postal Code</b>
								<input class="form-control" value="{{$shipping->postal_code}}" type="text" name="postal_code"></input>
								<br />
								<button type="submit" class="btn btn-default btn-block btn-sm">Save changes</button>
							{!!Form::close()!!} 
					
						</div>



					</div>
				</div>
				<div class="featured-box featured-box-secondary sidebar featured-box-confirm">
					<div class="box-content">
						<h4>Confirm your order</h4>
						<table cellspacing="0" class="cart-totals">
							<tbody>
								<tr class="cart-subtotal">
									<th class="product-name">
										Cart Subtotal(<t class="items_count">{{$orderCount}}</t> items)
									</th>
									<td class="product-price">
										<span class="amount" ><t class="subamount" data-amount="{{$orderSubtotal}}">${{$orderSubtotal}}</t></span>
									</td>
								</tr>
								<tr>
									<th class="product-name">
										Shipping
									</th>
									<td class="shipping" value="{{$shippingAmount}}" data-shipping="{{$shippingAmount}}">
										${{$shippingAmount}}<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
									</td>
								</tr>
								<tr >
									<th class="product-name">
										Total
									</th>
									<td class="product-price">
										<span class="amount"><t class="total" data-amount="{{$orderSubtotal}}">${{$orderSubtotal + $shippingAmount}}</t></span>
									</td>
								</tr>
							</tbody>
						</table>
						@if(Auth::check())
						<p><a href="{{action('PaymentController@getPayPal')}}"><button class="btn btn-primary btn-block btn-sm">Continue</button></a></p>
						@else
						<p class="login"><a href="javascript:void(0);"><button class="btn btn-primary btn-block btn-sm">Continue</button></a></p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
