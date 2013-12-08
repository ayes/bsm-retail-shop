<?php $this->load->view('app/includes/header'); ?>
<script language="JavaScript">
	function inputKlik(txt) {
		window.opener.document.form_matkul.kode_matkul.value = txt;
		window.close();
	}
</script>
<table class="table table-striped">
<tr>
    <th>NAME</th>
    <th>CODE</th>
    <th>PURCHASE PRICE</th>
    <th>SELLING PRICE</th>
    <th>STOCK</th>
    <th>UNIT</th>
    <th>GET</th>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php foreach($getProducts->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo $row->name; ?></td>
<td><?php echo $row->idcode; ?></td>
<td><?php echo number_format($row->purchase_price, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->selling_price, 0, ',', '.'); ?></td>
<td><?php echo $row->stock; ?></td>
<td><?php echo $row->unit; ?></td>


<td>
    <a href="#" onClick="javascript:inputKlik(<?php echo $row->idcode;?>)"><?php echo $row->idcode;?></a></td>
</td>
 
</tr>                                
 
<?php endforeach; ?>				
			</table>

<?php $this->load->view('app/includes/footer'); ?>