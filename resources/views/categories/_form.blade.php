{!! csrf_field() !!}
<div class="form-group">
	<label for="title" class="col-sm-2 control-label">Name <span style="color:red">*</span></label>
	<div class="col-sm-10{{ $errors->has('title') ? ' has-error' : '' }}">
		<input type="text" class="form-control" id="title" name="title" placeholder="Category Name" value="@if(isset($category->title)){{ $category->title }}@else{{ old('title') }}@endif">
		@if ($errors->has('title'))
		<span class="help-block">
			<strong>{{ $errors->first('title') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<label for="description" class="col-sm-2 control-label">Description</label>
	<div class="col-sm-10{{ $errors->has('description') ? ' has-error' : '' }}">
		<textarea class="form-control" rows="3" id="description" name="description" placeholder="Category Description">@if(isset($category->description)){{ $category->description }}@else{{ old('description') }}@endif</textarea>
		@if ($errors->has('description'))
		<span class="help-block">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<label for="parent" class="col-sm-2 control-label">Parent <span style="color:red">*</span></label>
	<div class="col-sm-10{{ $errors->has('id') ? ' has-error' : '' }}">
		<select class="form-control" id="id" name="id" placeholder="Parent Category">
			<option value="">Root category</option>
			@if(isset($category->id))
				{!! recursiveArraySelect($categories, $category->parent_id) !!}
			@else
				{!! recursiveArraySelect($categories) !!}
			@endif
		</select>
		@if ($errors->has('id'))
		<span class="help-block">
			<strong>{{ $errors->first('id') }}</strong>
		</span>
		@endif
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">Save</button>
	</div>
</div>
