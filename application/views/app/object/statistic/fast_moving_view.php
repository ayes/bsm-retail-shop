 <div class="row">
         

          <div class="col-lg-12">

<h1>Fast Moving</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Fast Moving</li>
            </ol>
          </div>
     <div class="col-lg-12">
         <table class="table table-striped">
<tr>
    <th>PRODUCT CODE</th>
    <th>NAME</th>
    <th>FAST MOVING</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_fast_moving->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>

<td><?php echo $row->product_id; ?></td>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->fm; ?></td>

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
