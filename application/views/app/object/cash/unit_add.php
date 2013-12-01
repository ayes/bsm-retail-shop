  <div class="row">
          <div class="col-lg-12">

<h1>Unit<small> Add</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Unit Add</li>
            </ol>


          </div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/unit/save', array('role' => 'form')); ?>    
  <div class="form-group">
    <label for="unit">Unit</label>
    <input name="unit" type="text" class="form-control" id="unit" placeholder="Unit" required="required">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>              
</div>
</div><!-- /.row -->

