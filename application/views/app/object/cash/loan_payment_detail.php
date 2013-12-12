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

<h1>Pembayaran Dana Pinjaman</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Pembayaran Dana Pinjaman</li>
            </ol>


          </div>
    
<br />
<div class="col-lg-12">
<table class="table table-striped">
<tr>
   <th>DATE</th>
    <th>TOTAL</th>
    <th>SISA</th>
    <th>KETERANGAN</th>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_loan_payment_id->result() as $row) : ?>                               
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 
<td><?php echo number_format($row->value, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->residual, 0, ',', '.'); ?></td>

<td><?php echo $row->description; ?></td>
</tr>        
<?php $id = $row->id; ?>
<?php $sisa = $row->residual; ?>
<?php endforeach; ?>				
</table>
</div>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
        
<?php echo form_open('app/loan_payment/pay', array('role' => 'form')); ?>  
         <?php echo form_hidden('id', $id); ?>
         <?php echo form_hidden('sisa', $sisa); ?>
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
    <label for="dibayar">Jumlah Bayar</label>
    <input name="dibayar" type="text" class="form-control" id="dibayar" placeholder="Jumlah bayar" required="required">
      </div>     
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" class="form-control" rows="2"></textarea>
      </div>
       <button type="submit" class="btn btn-primary">Submit</button>
</form>      
        
        
    </div>
</div>

<br />
<div class="row">
    <div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>DIBAYAR</th>
    <th>KETERANGAN</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_payment_of_loan->result() as $row) : ?>                               
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo number_format($row->dibayar, 0, ',', '.'); ?></td>
<td><?php echo $row->description; ?></td>
</tr>                                
<?php endforeach; ?>				
</table>
    </div>
</div>
    

 