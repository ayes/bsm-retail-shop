  <div class="row">
          <div class="col-lg-12">

<h1>Selling<small> Add</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Selling Add</li>
            </ol>


          </div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/selling/save', array('role' => 'form')); ?>    
              <?php foreach($getEdit->result() as $row) : ?>
              <?php echo form_hidden('id', $row->id); ?>
              <?php echo form_hidden('purchase_price', $row->purchase_price); ?>
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
    <label for="name">CODE</label>
    <input name="code" readonly="readonly" type="text" class="form-control" id="code" value="<?php echo $row->id; ?>" required="required">
      </div>
          
 <div class="form-group">
    <label for="name">Product Name</label>
    <input name="name" readonly="readonly" type="text" class="form-control" id="name" value="<?php echo $row->name; ?>" required="required">
      </div>
      
              <div class="form-group">
    <label for="selling_price">Selling Price</label>
    <input name="selling_price" readonly="readonly" type="text" class="form-control" id="selling_price" value="<?php echo $row->selling_price; ?>" required="required">
      </div>
              <div class="form-group">
    <label for="qty">QTY</label>
    <input name="qty" type="text" class="form-control" id="qty" required="required" autofocus>
      </div>
              <div class="form-group">
    <label for="discount">DISCOUNT</label>
    <input name="discount" value="0" type="text" class="form-control" id="discount" required="required">
      </div>
               <div class="form-group">
    <label for="status">Status</label>
    <?php $data = array(0 => '- Status -',1 => 'Piutang'); ?>
     <?php echo form_dropdown('status',$data, set_value('status')); ?>
              </div>
              <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" rows="2"></textarea>
      </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php endforeach; ?>
</form>              
</div>
</div><!-- /.row -->

