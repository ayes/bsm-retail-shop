 <div class="row">
         

          <div class="col-lg-12">

<h1>Counter</h1>
 <ol class="breadcrumb">
              <li><a href="/app/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
              <li class="active"><span class="glyphicon glyphicon-edit"></span> Counter</li>
            </ol>


          </div>
 <div class="col-lg-12">
         

<p>
Total Item : <?php echo $get_all_item; ?>   
    </p>
    <p>
Total Semua Stock : <?php echo $get_all_stock; ?>   
    </p>    
    <p>
        <?php 
        $total_purchase = 0;
        foreach($get_all_purchase_selling->result() as $row) :
           $total_purchase = $total_purchase + ($row->purchase_price * $row->stock);
        endforeach; ?>
Total Semua Pembelian : <?php echo number_format($total_purchase, 0, ',', '.'); ?>   
    </p>
    <p>
        <?php 
        $total_selling = 0;
        foreach($get_all_purchase_selling->result() as $row) :
           $total_selling = $total_selling + ($row->selling_price * $row->stock);
        endforeach; ?>
Total Semua Penjualan : <?php echo number_format($total_selling, 0, ',', '.'); ?> 
    </p>
    <?php $total_profit = $total_selling - $total_purchase; ?>  
    <p>
Profit : <?php echo number_format($total_profit, 0, ',', '.'); ?> 
    </p>
         </div>