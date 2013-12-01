<div class="row">
          <div class="col-lg-12">
<?php $flashmessage = $this->session->flashdata('message'); ?>
    <?php echo ! empty($flashmessage) ? 
    '<div class="alert alert-dismissable alert-success">'
    . '<button type="button" class="close" data-dismiss="alert">&times;</button>'
    .$flashmessage
    .'</div>' : ''; ?>          
</div><!-- /.row -->
<div class="col-lg-12 text-right">
<a href="/app/unit/add" class="btn btn-primary btn-lg" role="button">Add Unit &raquo;</a></p>
</div>
<div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>NO.</th>
    <th>UNIT</th>
    <th>EDIT</th>
    <th>DELETE</th>
 
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_unit->result() as $row) : ?>                               
<td><?php echo $no=$no+1; ?></td>
<td><?php echo $row->unit; ?></td>

<td><?php echo anchor('app/unit/edit/'.$row->id, 'EDIT', array('title'=>'Edit')); ?></td>

<td>
    <?php if ($this->unit_model->count_product_unit($row->id) == 0) { ;?>
<?php echo anchor('admin/product_category/delete/'.$row->id, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?>
<?php } else { ?>
 <?php echo 'CANNOT DELETE'; ?>
 <?php } ?>
</td>

</tr>                                
 
<?php endforeach; ?>				
			</table>

<div id="pagination" align="right">
</div>    