  <div class="row">
          <div class="col-lg-12">

<h1>Unit<small> Edit</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Unit Edit</li>
            </ol>


          </div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/unit/update', array('role' => 'form')); ?>    
              <?php foreach($getEdit->result() as $row) : ?>
              <?php echo form_hidden('id', $row->id); ?>
  <div class="form-group">
    <label for="unit">Unit</label>
    <input name="unit" type="text" class="form-control" id="unit" value="<?php echo $row->unit; ?>" required="required">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php endforeach; ?>
</form>              
</div>
</div><!-- /.row -->

