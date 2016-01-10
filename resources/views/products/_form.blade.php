{!! csrf_field() !!}
<div class="form-group">
	<label for="name" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>
	<div class="col-sm-10{{ $errors->has('name') ? ' has-error' : '' }}">
		<input type="text" class="form-control" id="name" name="name" placeholder="Product Name" value="@if(isset($product->name)){{ $product->name }}@else{{ old('name') }}@endif">
		@if ($errors->has('name'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<label for="model" class="col-sm-2 control-label">Model</label>
	<div class="col-sm-10{{ $errors->has('model') ? ' has-error' : '' }}">
		<input type="text" class="form-control" id="model" name="model" placeholder="Product Model" value="@if(isset($product->model)){{ $product->model }}@else{{ old('model') }}@endif">
		@if ($errors->has('model'))
		<span class="help-block">
			<strong>{{ $errors->first('model') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<label for="parent" class="col-sm-2 control-label">Category <span style="color:red">*</span></label>
	<div class="col-sm-10{{ $errors->has('category_id') ? ' has-error' : '' }}">
		<select class="form-control multiselect" id="category_id" name="category_id[]" data-placeholder="Please select category" multiple="multiple">
		@if(count(old('category_id')) == 0 && !isset($product))
			{!! recursiveArraySelect2($categories) !!}
		@elseif(count(old('category_id')) == 0 && isset($product))
			{!! recursiveArraySelect2($categories, $categories_id) !!}
		@else
			{!! recursiveArraySelect2($categories, old('category_id')) !!}
		@endif
		</select>
		@if ($errors->has('category_id'))
		<span class="help-block">
			<strong>{{ $errors->first('category_id') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<label for="photo" class="col-sm-2 control-label">Photo</label>
	<div class="col-sm-10{{ $errors->has('photo') ? ' has-error' : '' }}">
		<input type="file" id="photo" name="photo">
		@if ($errors->has('photo'))
		<span class="help-block">
			<strong>{{ $errors->first('photo') }}</strong>
		</span>
		@endif
		@if(isset($product))
			<img src="{{ isset($product->photo) ? asset('img/'.$product->photo) : asset('img/not_available.png') }}" width="500" class="img-responsive img-rounded" alt="{{ $product->name }}" style="margin-top: 15px;">
		@endif
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">Save</button>
	</div>
</div>
