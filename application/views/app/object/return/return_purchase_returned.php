  <div class="row">
          <div class="col-lg-12">

<h1>Return <small>Purchase</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Return Purchase</li>
            </ol>


          </div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/return_purchase/save', array('role' => 'form')); ?>    
              <?php foreach($getEdit->result() as $row) : ?>
              <?php echo form_hidden('id', $row->id); ?>
              <?php echo form_hidden('status', $row->status); ?>
              <?php echo form_hidden('selling_price', $row->selling_price); ?>
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
    <label for="name">CODE PRODUCT</label>
    <input name="code" readonly="readonly" type="text" class="form-control" id="code" value="<?php echo $row->product_id; ?>" required="required">
      </div>
          
 <div class="form-group">
    <label for="name">Product Name</label>
    <input name="name" readonly="readonly" type="text" class="form-control" id="name" value="<?php echo $row->name; ?>" required="required">
      </div>
      
              <div class="form-group">
    <label for="purchase_price">Purchase Price</label>
    <input name="purchase_price" readonly="readonly" type="text" class="form-control" id="purchase_price" value="<?php echo $row->purchase_price; ?>" required="required">
      </div>
              <div class="form-group">
    <label for="qty">QTY</label>
    <input name="qty" readonly="readonly" type="text" class="form-control" id="qty" required="required" value="<?php echo $row->qty; ?>">
      </div>
              <div class="form-group">
    <label for="discount">DISCOUNT</label>
    <input name="discount" readonly="readonly" type="text" class="form-control" id="discount"  value="<?php echo $row->discount; ?>">
      </div>
               <div class="form-group">
    <label for="status">Status</label>
    <?php if ($row->status == 0)  : ?>
<?php $status = 'TUNAI'; ?>
<?php else: ?>
<?php $status = 'PIUTANG'; ?>
<?php endif; ?>
    <?php echo $status; ?>
              </div>
              <div class="form-group">
    <label for="description">Description</label>
    <textarea readonly="readonly" name="description" class="form-control" rows="2"><?php echo $row->description; ?></textarea>
      </div>
  <button type="submit" class="btn btn-primary">Return</button>
  <?php endforeach; ?>
</form>              
</div>
</div><!-- /.row -->

