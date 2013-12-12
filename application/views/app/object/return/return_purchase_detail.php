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

<h1>Return Purchase Detail</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Return Purchase Detail</li>
            </ol>


          </div>
    
<br />
<div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>NO. FAKTUR</th>
    <th>TOTAL</th>

    <th>STATUS</th>
    <th>DESC</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_return_detail_index->result() as $row) : ?>                               
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo $row->no_faktur; ?></td>
<td><?php echo number_format($row->total, 0, ',', '.'); ?></td>
<?php if ($row->status == 0)  : ?>
<?php $status = 'TUNAI'; ?>
<?php else: ?>
<?php $status = 'HUTANG'; ?>
<?php endif; ?>
<td><?php echo $status; ?></td>
<td><?php echo $row->description; ?></td>
</tr>        
<?php $nofak = $row->no_faktur; ?>
<?php endforeach; ?>				
</table>
</div>
</div>
<br />
<div class="row">
    <div class="text-right col-lg-12">
         <?php echo anchor('app/return_purchase/save_return/'.$nofak, 'RETURN PURCHASE'); ?>
    </div>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>PRODUCT CODE</th>
    <th>NAME</th>
    <th>PURCHASE PRICE</th>
    <th>QTY</th>
    <th>DISCOUNT</th>
    <th>TOTAL</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_return_detail_content->result() as $row) : ?>                               
<td><?php echo $row->product_id; ?></td>
<td><?php echo $row->name; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo $row->qty; ?></td>
<td><?php echo number_format($row->discount, 0, ',', '.'); ?></td>
<?php $total = ($row->selling_price * $row->qty) - $row->discount; ?>
<td><?php echo number_format($total, 0, ',', '.'); ?></td>
</tr>                                
<?php endforeach; ?>				
</table>
</div>

</div>

    

 