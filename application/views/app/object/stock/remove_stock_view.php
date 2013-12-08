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

<h1>Remove Stock</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Remove Stock</li>
            </ol>


          </div>
    <div class="col-lg-12">
<?php echo form_open('app/remove_stock/search'); ?>
	

        <div class="row">
            <div class="col-xs-3">
                Search product name or code:
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
            <select name="option" class="form-control">
                <option value="name">Name</option>
    <option value="tp.id">Code</option>
    
</select>
            </div>
        <div class="col-xs-3">
            <?php $input = array('name' => 'keyword', 'size' => 20, 'type' => 'search', 'class' => 'form-control'); ?>
				<?php echo form_input($input); ?>
        </div>
                             <div class="col-xs-2">  
				<?php echo form_submit('Search','Search', 'class="btn btn-default btn-lx"');?>
                                    </div> 
        </div>
	
	<?php echo form_close(); ?>
    </div>
<br />
<div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>NAME</th>
    <th>CODE</th>
    <th>PURCHASE PRICE</th>
    <th>SELLING PRICE</th>
    <th>STOCK</th>
    <th>UNIT</th>
    <th>ADD</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_remove_stock->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->idcode; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->selling_price, 0, ',', '.'); ?></td>
<td><?php echo $row->stock; ?></td>
<td><?php echo $row->unit; ?></td>


<td><?php echo anchor('app/remove_stock/add/'.$row->idcode, 'REMOVE', array('title'=>'Edit')); ?></td>
<?php 
/*
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
  