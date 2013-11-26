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

<h1>Product</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Product</li>
            </ol>


          </div>
    <div class="col-lg-12">
<?php echo form_open('app/products/search'); ?>
	
				<?php $input 	= array('name' => 'keyword', 'size' => 20, 'type' => 'search', 'class' => 'form-control'); ?>
        <div class="row">
            <div class="col-xs-3">
                Search product name or code:
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
            <select name="option" class="form-control">
    <option value="id">Code</option>
    <option value="name">Name</option>
</select>
            </div>
        <div class="col-xs-3">
				<?php echo form_input($input); ?>
        </div>
                             <div class="col-xs-2">  
				<?php echo form_submit('Search','Search', 'class="btn btn-default btn-lx"');?>
                                    </div> 
        </div>
	
	<?php echo form_close(); ?>
    </div>
<div class="col-lg-12 text-right">
<a href="/app/products/add" class="btn btn-primary btn-lg" role="button">Add Product &raquo;</a></p>
</div>
<div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>CODE</th>
    <th>NAME</th>
    <th>PURCHASE PRICE</th>
    <th>SELLING PRICE</th>
    <th>STOCK</th>
    <th>UNIT</th>
    <th>EDIT</th>
    <th>DELETE</th>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($getProducts->result() as $row) : ?>                               
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo $row->idcode; ?></td>
<td><?php echo $row->name; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->selling_price, 0, ',', '.'); ?></td>
<td><?php echo $row->stock; ?></td>
<td><?php echo $row->unit; ?></td>


<td><?php echo anchor('app/products/edit/'.$row->idcode, 'EDIT', array('title'=>'Edit')); ?></td>
<td><?php echo anchor('app/products/delete/'.$row->id.'/'.$row->picture, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?></td>

</tr>                                
 
<?php endforeach; ?>				
			</table>
    <p>
Total Item : <?php echo $get_all_item; ?>   
    </p>
    <p>
Total All Stock : <?php echo $get_all_stock; ?>   
    </p>    
    <p>
Total All Purchase : <?php echo number_format($get_all_purchase, 0, ',', '.'); ?>   
    </p>
    <p>
Total All Sale : <?php echo number_format($get_all_selling, 0, ',', '.'); ?> 
    </p>
    <?php $total_profit = $get_all_selling - $get_all_purchase; ?>  
    <p>
Profit : <?php echo number_format($total_profit, 0, ',', '.'); ?> 
    </p>
</div>
</div>
<div id="pagination" align="right">
</div>    