@extends('layouts.app')
@section('content')
<div class="container">
			<div class="page-top">
				
			</div>
			<span style="font-size:2em">Catalog Advanced Search</span>
			<br /><br />
			{!! Form::open([ 'method' => 'GET' ,'action' => ['User\ItemController@getAdvancedSearchResult'], 'class' => 'form-horizontal']) !!}
			<div class="col-md-6">
		        <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>
                    <div class="col-md-6"> 
                        <input type="text" class="form-control" name="title" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="description" > 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">SKU</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="subtitle" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Price</label>
                    <div class="col-md-6">
                        <input type="number" min="0" name="price_min" style="width: 60px; border-color: #666666" placeholder=" min" value="{{old('price_min')}}" /> - <input type="number"  min="0" name = "price_max" value="{{old('price_max')}}" style="width: 60px; border-color:#666666" placeholder=" max" />
						@if($currency == 'USD') USD @endif
						@if($currency == 'EUR') EUR @endif
						@if($currency == 'GBP') GBP @endif 
                    </div>
                </div>
			
			</div>
			<div class="col-md-6">
				<div class="form-group">
                    <label class="col-md-4 control-label">Collection</label>
                    <div class="col-md-6">
                        <select class="form-control" name="collection">
                            <option value=""> -- select an option -- </option>
                        	@foreach($collections as $collection)
                        	<option value="{{$collection->id}}">{{$collection->name}}</option>
                        	@endforeach
                        </select>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-md-4 control-label">Category</label>
                    <div class="col-md-6">
                        <select class="form-control" name="category">
                            <option  value=""> -- select an option -- </option>
                        	@foreach($categories as $category)
                        	<option value="{{$category->id}}">{{$category->category}}</option>
                        	@endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Metals</label>
                    <div class="col-md-6">
							@foreach($metals as $key => $metal)
				            <label style="color:black">
				            	<input type="checkbox" name="metals[]" value="{{$metal->id}}" @if(isset($searchData['metals'][$key])) @if($searchData['metals'][$key] == $metal->id)checked="checked" @endif @endif>{{$metal->name}}
				            </label>		                            
				            @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Gemstones</label>
                    <div class="col-md-6">
							@foreach($gemstones as $key => $gemstone)
				            <label style="color:black">
				            	<input type="checkbox" name="gemstones[]" value="{{$gemstone->id}}" @if(isset($searchData['gemstones'][$key])) @if($searchData['gemstones'][$key] == $gemstone->id)checked="checked" @endif @endif>{{$gemstone->name}}
				            </label>		                            
				            @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-6">
						<button class="btn btn-">Search</button>
                    </div>
                </div>
			</div>
			{!! Form::close() !!}
	
</div>
@endsection