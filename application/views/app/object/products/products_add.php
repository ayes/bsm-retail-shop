  <div class="row">
          <div class="col-lg-12">

<h1>Product<small> Add</small></h1>
 <ol class="breadcrumb">
              <li><a href="/admin/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Product Add</li>
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
       <div class="col-lg-12">
      <?php if(validation_errors()) : ?>
	<div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
           </div>
        </div><!-- /.row -->
 
       

        
        
<div class="row">
          <div class="col-lg-6">
<?php echo form_open_multipart('app/products/save', array('role' => 'form')); ?>    
  <div class="form-group">
      <div class="form-group">
        <label for="date">Date</label>
        <?php $data = array(
            'name' => 'date',
            'class' => 'form-control',
            'size' => 10,
            'required' => 'required',
            'readonly' => 'readonly',
            'id' => 'date',
            'value' => set_value('date', date('d-m-Y'))
        ); ?>
        <?php echo form_input($data); ?> 
        <div class="text-right">
            <img src="/dtpicker/img/cal.gif" onclick="javascript:NewCssCal ('date','ddMMyyyy')" style="cursor:pointer"/>
            </div>
        </div>
      <div class="form-group">
          <label for="product_category_id">Category</label>
    <select class="form-control" name="product_category_id">
                                            <?php foreach($getProductCategory->result() as $rcat) : ?>
                                            <?php if($rcat->id == $this->session->flashdata('ses_save_category')) {
                                            $select = 'selected="selected"';
                                            } else {
                                                $select = '';
                                            } ?>
                                            <option value="<?php echo $rcat->id; ?>" <?php echo $select; ?>><?php echo $rcat->category ;?></option>
                                            <?php endforeach ?>
                                            </select>
      </div>
      <div class="form-group">
          <label for="unit_id">Unit</label>
    <select class="form-control" name="unit_id">
                                            <?php foreach($get_unit->result() as $rcat) : ?>
                                            <?php if($rcat->id == $this->session->flashdata('ses_save_unit')) {
                                            $select = 'selected="selected"';
                                            } else {
                                                $select = '';
                                            } ?>
                                            <option value="<?php echo $rcat->id; ?>" <?php echo $select; ?>><?php echo $rcat->unit ;?></option>
                                            <?php endforeach ?>
                                            </select>
      </div>
      <div class="form-group">
    <label for="code">Code</label>
    <input name="code" maxlength="15" type="text" class="form-control" id="code" placeholder="Code" required="required" autofocus>
      </div>
      <div class="form-group">
    <label for="name">Product Name</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Product Name" required="required">
      </div>
      <div class="form-group">
    <label for="purchase_price">Purchase Price</label>
    <input name="purchase_price" type="text" class="form-control" id="purchase_price" placeholder="Purchase Price" required="required">
      </div>
      <div class="form-group">
    <label for="selling_price">Selling Price</label>
    <input name="selling_price" type="text" class="form-control" id="selling_price" placeholder="Selling Price" required="required">
      </div>
      <div class="form-group">
    <label for="stock">Stock</label>
    <input name="stock" type="text" class="form-control" id="stock" placeholder="Stock" required="required">
      </div>
      <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" rows="2"></textarea>
      </div>
      <div class="form-group">
    <label for="picture">Picture</label>
    <?php echo form_upload('userfile'); ?>
    <p class="help-block">Size 227px * 170px.</p>
      </div>
  </div>
 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>              
</div>
</div><!-- /.row -->

