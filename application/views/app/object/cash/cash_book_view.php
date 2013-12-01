 <div class="row">
         

          <div class="col-lg-12">

<h1>Cash Book</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Cash Book</li>
            </ol>
          </div>
     <div class="col-lg-12">
         <table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>CASH CODE</th>
    <th>DESC</th>
    <th>DESC CODE</th>
    <th>INCOMING</th>
    <th>OUTGOING</th>
    <th>BALANCE</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_cash_book->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo $row->cash_code; ?></td>
<td><?php echo $row->description; ?></td>
<td><?php echo $row->description_code; ?></td>
<td><?php echo number_format($row->incoming, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->outgoing, 0, ',', '.');  ?></td>
<td><?php echo number_format($row->balance, 0, ',', '.');  ?></td>

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
