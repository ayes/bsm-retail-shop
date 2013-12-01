 <div class="row">
         

          <div class="col-lg-12">

<h1>Stock Card</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Stock Card</li>
            </ol>
          </div>
     <div class="col-lg-12">
         <table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>PRODUCT CODE</th>
    <th>DESC</th>
    <th>DESC CODE</th>
    <th>STOCK ENTRY</th>
    <th>STOCK OUT</th>
    <th>BALANCE</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_stock_card->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo $row->product_id; ?></td>
<td><?php echo $row->description; ?></td>
<td><?php echo $row->description_code; ?></td>
<td><?php echo $row->stock_entry; ?></td>
<td><?php echo $row->stock_out; ?></td>
<td><?php echo $row->balance; ?></td>

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
