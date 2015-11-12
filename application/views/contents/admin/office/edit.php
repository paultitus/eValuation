<?php echo form_open('admin/office/edit/'.$office->office_id,array('class'=>'form-horizontal','role'=>'form'))?>
	<div class="panel panel-warning form-container">
		<div class="panel-heading">
			<h3 class="panel-title">Edit Office</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label for="name" class="col-sm-4 control-label">Office Name</label>
				<div class="col-sm-8">
					<input value="<?php echo set_value('name', $office->name); ?>" id="name" name="name" type="text" class="form-control" placeholder="Office Name">
					<?php echo form_error('name','<p class="text-danger">','</p>');?>
				</div>
			</div>
			<div class="form-group">
				<label for="chair" class="col-sm-4 control-label">Chair</label>
				<div class="col-sm-8">
					<input value="<?php echo set_value('chair', $chair->last_name.', '.$chair->first_name); ?>" id="chair" name="chair" type="text" class="form-control" placeholder="Chair (Last Name, First Name)" list="teachers">
					<datalist id="teachers">
						<?php foreach ($teachers as $teacher):?>
							<option value="<?php echo $teacher->last_name.', '.$teacher->first_name?>">
						<?php endforeach;?>
					</datalist>
					<?php echo form_error('chair','<p class="text-danger">','</p>');?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<button type="submit" class="btn btn-warning">Edit Office</button>
					<a href="<?php echo base_url('admin/Office/view')?>" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</div>
	</div>
</form>