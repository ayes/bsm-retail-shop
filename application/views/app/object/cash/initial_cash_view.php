  <div class="row">
          <div class="col-lg-12">

<h1>Initial<small> Cash</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Initial Cash</li>
            </ol>
          </div>
       <div class="col-lg-12">
<?php $flashmessage = $this->session->flashdata('message'); ?>
    <?php echo ! empty($flashmessage) ? 
    '<div class="alert alert-dismissable alert-success">'
    . '<button type="button" class="close" data-dismiss="alert">&times;</button>'
    .$flashmessage
    .'</div>' : ''; ?>          
</div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/initial_cash/update', array('role' => 'form')); ?>    
              <?php foreach($get_initial_cash->result() as $row) : ?>
  <div class="form-group">
    <label for="initial_cash">Initial Cash</label>
    <input name="initial_cash" type="text" class="form-control" id="initial_cash" value="<?php echo $row->balance; ?>" required="required">
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
  <hr />
  Initial Cash : <?php echo number_format($row->balance, 0, ',', '.'); ?>
  <?php endforeach; ?>
</form>              
</div>
</div><!-- /.row -->

