 <div class="row">
         

          <div class="col-lg-12">

<h1>Income</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Income</li>
            </ol>
          </div>
     <div class="col-lg-12">
         <table class="table table-striped">
<tr>
    <th>PRODUCT CODE</th>
    <th>NAME</th>
    <th>PURHASE PRICE</th>
    <th>SELLING PRICE</th>
    <th>QTY</th>
    <th>PP</th>
    <th>SP</th>
    <th>DISC</th>
    <th>HPP</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_income->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>

<td><?php echo $row->product_id; ?></td>
<td><?php echo $row->name; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->selling_price, 0, ',', '.'); ?></td>
<td><?php echo $row->qty; ?></td>
<?php  $pp = $row->purchase_price * $row->qty; ?>
<?php  $sp = ($row->selling_price * $row->qty) - $row->discount; ?>
<td><?php echo number_format($pp, 0, ',', '.'); ?></td>
<td><?php echo number_format($sp, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->discount, 0, ',', '.'); ?></td>
<?php $hpp = $sp - $pp; ?>
<td><?php echo number_format($hpp, 0, ',', '.'); ?></td>
<?php 
/*
<td><?php echo anchor('app/products/delete/'.$row->id.'/'.$row->picture, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?></td>
*/
  ?>
 
</tr>                                
 
<?php endforeach; ?>				
			</table>
     </div>
     
     <div class="paginationx text-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
