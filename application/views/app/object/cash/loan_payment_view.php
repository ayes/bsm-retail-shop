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

<h1>Pengembalian Dana Pinjaman</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Pengembalian Dana Pinjaman</li>
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
    <th>DETAIL</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_loan_payment->result() as $row) : ?>                               

<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 
<td><?php echo number_format($row->value, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->residual, 0, ',', '.'); ?></td>

<td><?php echo $row->description; ?></td>

<td><?php echo anchor('app/loan_payment/detail/'.$row->id, 'DETAIL', array('title'=>'Edit')); ?></td>


<?php 
/*
 * <td><?php echo anchor('app/receivables_sales/pay/'.$row->id, 'PAY', array('title'=>'Edit')); ?></td>
<td><?php echo anchor('app/products/delete/'.$row->id.'/'.$row->picture, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?></td>
*/
  ?>
 
</tr>                                
 
<?php endforeach; ?>				
			</table>
   
</div>
</div>
<div class="paginationx text-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
 