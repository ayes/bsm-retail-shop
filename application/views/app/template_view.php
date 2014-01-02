<?php $this->load->view('app/includes/header'); ?>

<nav class="navbar navbar-default navbar-collapse navbar-fixed-top" role="navigation">
 <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href='/'><?php echo $this->tools_model->getShopName(); ?></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Master <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/app/products"><span class="glyphicon glyphicon-time"></span> Products</a></li>
                <li class="divider"></li>
                <li><a href="/app/product_category"><span class="glyphicon glyphicon-time"></span> Category</a></li> 
                <li><a href="/app/unit"><span class="glyphicon glyphicon-time"></span> Unit</a></li>
            </ul>
        </li>
    </ul>
      <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Transaksi <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/app/selling"><span class="glyphicon glyphicon-time"></span> Penjualan</a></li>
                <li><a href="/app/purchase"><span class="glyphicon glyphicon-time"></span> Pembelian</a></li>
                <li class="divider"></li>
                <li><a href="/app/return_selling"><span class="glyphicon glyphicon-time"></span> Retur Penjualan</a></li>
                <li><a href="/app/return_purchase"><span class="glyphicon glyphicon-time"></span> Retur Pembelian</a></li>
            </ul>
        </li>
    </ul> 
      <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Stock <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/app/stock_card"><span class="glyphicon glyphicon-time"></span> Stock Card</a></li>
            <li class="divider"></li>
                <li><a href="/app/added_stock"><span class="glyphicon glyphicon-time"></span> Added Stock</a></li>
                <li><a href="/app/remove_stock"><span class="glyphicon glyphicon-time"></span> Remove Stock</a></li>
            </ul>
        </li>
    </ul> 
      <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Finance <b class="caret"></b></a>
            <ul class="dropdown-menu">
               <?php // <li><a href="/app/initial_cash"><span class="glyphicon glyphicon-time"></span> Initial Cash</a></li> ?>
                <li><a href="/app/cash_incoming"><span class="glyphicon glyphicon-time"></span> Cash Incoming</a></li>
                <li><a href="/app/cash_outgoing"><span class="glyphicon glyphicon-time"></span> Cash Outgoing</a></li>
                <li class="divider"></li>
                <li><a href="/app/loan"><span class="glyphicon glyphicon-time"></span> Dana Pinjaman</a></li>
                <li><a href="/app/loan_payment"><span class="glyphicon glyphicon-time"></span> Pengembalian Dana Pinjaman</a></li>
                <li class="divider"></li>
                <li><a href="/app/debit_purchase"><span class="glyphicon glyphicon-time"></span> Debit Purchase (Hutang Pembelian)</a></li>
                <li><a href="/app/receivables_sales"><span class="glyphicon glyphicon-time"></span> Receivables Sales (Piutang Penjualan)</a></li>
                <li class="divider"></li>
                <li><a href="/app/cash_book"><span class="glyphicon glyphicon-time"></span> Cash Book</a></li>
            </ul>
        </li>
    </ul> 
       <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Statistic <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/app/counter"><span class="glyphicon glyphicon-time"></span> Counter</a></li>
                <li class="divider"></li>
                <li><a href="/app/fast_moving"><span class="glyphicon glyphicon-time"></span> Fast Moving</a></li>
                <li><a href="/app/slow_moving"><span class="glyphicon glyphicon-time"></span> Slow Moving</a></li>
            </ul>
        </li>
    </ul>  
    <ul class="nav navbar-nav navbar">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-time"></span> Report <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/app/income"><span class="glyphicon glyphicon-time"></span> Income</a></li>
                <li><a href="/app/products/print_product" target="_blank"><span class="glyphicon glyphicon-time"></span> Print Product</a></li>
            </ul>
        </li>
    </ul>  
     
        
                
      
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-usd"></span> <?php echo number_format($this->tools_model->get_last_cash(), 0, ',', '.'); ?></a></li>
      <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('name'); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/admin/profile"><span class="glyphicon glyphicon-user"></span> Shop Profile</a></li>
                <li><a href="/admin/setting"><span class="glyphicon glyphicon-time"></span> Setting</a></li>
                <li class="divider"></li>
                <li><a href="/app-panel/logout"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
              </ul>
            </li>
    </ul>
      
    
     
  </div><!-- /.navbar-collapse -->
</nav>      

      
<div class="container">
              
           <?php $this->load->view($content); ?>   
    
    
    
           
              
              

     
<?php $this->load->view('app/includes/footer'); ?>


  </body>
</html>