 <div class="row">
         

          <div class="col-lg-12">

<h1>Cash Book</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Cash Book</li>
            </ol>
          </div>
     
 <div class="col-lg-12">
<?php echo form_open('app/cash_book/search'); ?>
        <?php $data1 = array('01' => 'Januari','02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' ); ?>
     <?php $data2 = array(
                        'name' => 'tahun',
                        'size' => 5,
                        'maxlength' => 4,
                        'required' => 'required',
                        'type' => 'search',
                        'value' => set_value('tahun')
                    ); ?>
						
    Bulan: <?php echo form_dropdown('bulan', $data1, set_value('bulan')); ?> 
    Tahun: <?php echo form_input($data2); ?>  
    <?php echo form_submit('Search','Search', 'class="btn btn-default btn-lx"');?>
	<?php echo form_close(); ?>
    </div>
     <br />
     <div class="col-lg-12">
         <table class="table table-striped">
<tr>
    <th>DATE</th>
    <th>CASH CODE</th>
    <th>DESC</th>
  <?php //  <th>DESC CODE</th> ?>
    <th>INCOMING</th>
    <th>OUTGOING</th>
    <th>BALANCE</th>
    <?php // <th>DELETE</th> ?>
</tr>                   
<?php $no = $this->uri->segment(3); ?>
<?php $total = 0; ?>
<?php foreach($get_cash_book->result() as $row) : ?>                               
<?php /* 
 * <td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
 */ ?>
<td><?php echo date("d-m-Y",strtotime($row->date)); ?></td>
<td><?php echo $row->cash_code; ?></td>
<td><?php echo $row->description; ?></td>
<?php /* <td><?php echo $row->description_code; ?></td> ; */?>
<td><?php echo number_format($row->incoming, 0, ',', '.'); ?></td>
<td><?php echo number_format($row->outgoing, 0, ',', '.');  ?></td>
<td><?php echo number_format($row->balance, 0, ',', '.');  ?></td>

<?php 
/*
<td><?php echo anchor('app/products/delete/'.$row->id.'/'.$row->picture, 'DELETE', array('title'=>'Hapus', 'onClick'=>"return confirm('Anda yakin ingin menghapus?')")); ?></td>
*/
  ?>
 
</tr>                                
<?php $total = $total + ($row->incoming - $row->outgoing); ?>
<?php endforeach; ?>				
			</table>
     </div>
     <p class="text-right">
         
         <strong><?php echo 'TOTAL: '.number_format($total, 0, ',', '.'); ?></strong>
        
     </p>
     <div class="paginationx text-right">
    <?php echo $this->pagination->create_links(); ?>
</div>
