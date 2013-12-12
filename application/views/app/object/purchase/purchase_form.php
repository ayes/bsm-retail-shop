  <div class="row">
       <div class="col-lg-12">
<?php $flashmessage = $this->session->flashdata('message'); ?>
    <?php echo ! empty($flashmessage) ? 
    '<div class="alert alert-dismissable alert-success">'
    . '<button type="button" class="close" data-dismiss="alert">&times;</button>'
    .$flashmessage
    .'</div>' : ''; ?>          
</div>
          <div class="col-lg-12">

<h1>Purchase<small> Add</small></h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Purchase Add</li>
            </ol>


          </div>
        </div><!-- /.row -->
<div class="row">
          <div class="col-lg-6">
<?php echo form_open('app/purchase/save', array('role' => 'form')); ?>    
              <?php foreach($getEdit->result() as $row) : ?>
              <?php echo form_hidden('id', $row->id); ?>
              <?php echo form_hidden('selling_price', $row->selling_price); ?>
              <?php echo form_hidden('purchase_price', $row->purchase_price); ?>
              <?php echo form_hidden('no_faktur', $this->tools_model->no_faktur_purchase()); ?>
              
          <div class="form-group">
    <label for="name">CODE</label>
    <input name="code" readonly="readonly" type="text" class="form-control" id="code" value="<?php echo $row->id; ?>" required="required">
      </div>
          
 <div class="form-group">
    <label for="name">Product Name</label>
    <input name="name" readonly="readonly" type="text" class="form-control" id="name" value="<?php echo $row->name; ?>" required="required">
      </div>
      
              <div class="form-group">
    <label for="purchase_price">Purchase Price</label>
    <input name="purchase_pricex" readonly="readonly" type="text" class="form-control" id="purchase_pricex" value="<?php echo number_format($row->purchase_price, 0, ',', '.'); ?>" required="required">
      </div>
              <div class="form-group">
    <label for="qty">QTY</label>
    <input name="qty" type="text" class="form-control" id="qty" required="required" autofocus>
      </div>
              <div class="form-group">
    <label for="discount">DISCOUNT</label>
    <input name="discount" value="0" type="text" class="form-control" id="discount" required="required">
      </div>
               
             
  <button type="submit" class="btn btn-primary">Submit</button>
  <?php endforeach; ?>
</form>              
</div>
    <div class="col-lg-6">
        <?php echo form_open('app/purchase/save_fix', array('role' => 'form')); ?> 
        <?php echo form_hidden('total', $this->tools_model->total_purchase_temp()); ?>
        <div class="form-group">
            <label>No. Faktur</label>
            <input class="form-control" readonly="readonly" name="no_faktur" value="<?php echo $this->tools_model->no_faktur_purchase(); ?>">
        </div>
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
    <label for="status">Status</label>
    <?php $data = array(0 => '- Status -',1 => 'Hutang'); ?>
     <?php echo form_dropdown('status',$data, set_value('status')); ?>
              </div>
         <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" rows="2"></textarea>
      </div>
        <div class="form-group">
            <label>Total</label>
            <input class="form-control" readonly="readonly" name="total_form" value="<?php echo number_format($this->tools_model->total_purchase_temp(), 0, ',', '.'); ?>">
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
 
</form>  
    </div>
</div><!-- /.row -->
<br />
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
<tr>
    <th>NAME</th>
    <th>CODE</th>
    <th>PURCHASE PRICE</th>
    <th>QTY</th>
    <th>DISCOUNT</th>
    <th>TOTAL</th>
    <th>DELETE</th>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_purchase_temp->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->product_id; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo $row->qty; ?></td>
<td><?php echo number_format($row->discount, 0, ',', '.'); ?></td>
<?php $total = ($row->purchase_price * $row->qty) - $row->discount; ?>
<td><?php echo number_format($total, 0, ',', '.'); ?></td>
<?php 
/*
<td><?php  echo anchor('app/selling/selling_form/'.$row->idcode, 'SALE', array('title'=>'Edit')); ?></td>
*/ ?>
<td><?php echo anchor('app/purchase/delete_temp/'.$row->id, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?></td>

 
</tr>                                
 
<?php endforeach; ?>				
			</table>
    </div>
</div>

