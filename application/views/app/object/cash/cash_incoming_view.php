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

<h1>Cash incoming</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Cash incoming</li>
            </ol>


          </div>
    <div class="col-lg-12">
<?php echo form_open('app/cash_incoming/save', array('role' => 'form')); ?>  
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
    <label for="description">DESCRIPTION</label>
    <input name="description" type="text" class="form-control" id="description" required="required" autofocus="autofocus">
      </div>
          <div class="form-group">
    <label for="value">VALUE</label>
    <input name="value" type="text" class="form-control" id="value" required="required">
      </div>
 <button type="submit" class="btn btn-primary">Submit</button>
	<?php echo form_close(); ?>
    </div>
<br />
<div class="col-lg-12">
<table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>DESCRIPTION</th>
    <th>VALUE</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($get_cash_incoming->result() as $row) : ?>                               

<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>

<td><?php echo $row->description; ?></td>
<td><?php echo number_format($row->value, 0, ',', '.'); ?></td>
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
  