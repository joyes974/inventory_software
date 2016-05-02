<div class="top_menu">
<?php if(common::is_logged_in()){?>  
    <ul class="sf-menu">
        <li><a href="<?= site_url('home') ?>" title='Home' class="white">Home</a></li>
		<li><a href="<?= site_url('user') ?>" title='Home' class="white">User</a></li>
       <?php if(common::purchase_permit()){?>   
	   <li class="current"><a href="<?=site_url('purchase')?>" class="white">Purchase</a>
            <ul>
			
                 <li><a href="<?=site_url('purchase')?>"> New Purchase</a> </li>
             <li><a href="<?=site_url('purchase/purchase_report')?>"> RM Received Report</a></li>
                <li><a href="<?=site_url('purchase/pending_payment')?>"> Pending Payment</a></li>
                <li><a href="<?=site_url('purchase/upcoming_payment')?>">Upcoming Payment</a></li>
                <li><a href="<?=site_url('purchase/overdue_payment')?>">Overdue Payment</a></li>
            </ul>
			
        </li>
		<?php } ?>
 <li class="current"><a class="white">Raw Materials</a>
            <ul>
                <li><a href="<?=site_url('rawmaterials')?>"> Stock RM</a> </li>
                <li><a href="<?=site_url('rawmaterials/rm_received_consumption')?>"> RM Received & Consumption</a></li>
                <li><a href="<?=site_url('rawmaterials/release_report')?>"> RM Release</a></li>     
            </ul>
        </li>
          <li class="current"><a class="white">Finished Product</a>
            <ul>
                <li><a href="<?=site_url('fpproduct')?>"> Stock FP</a> </li>
                <li><a href="<?=site_url('fpproduct/release_report')?>"> Insert  Fp </a></li>     
            </ul>
        </li>
		  <?php if(common::sale_permit()){?> 
                  <li class="current"><a href="#a" class="white">Sales</a>
            <ul>
                 <li><a href="<?=site_url('sale/add_sale')?>">New Sales</a> </li>
                <li><a href="<?=site_url('sale')?>"> Sales report</a></li>
                <li><a href="<?=site_url('sale/pending_payment')?>"> Due Payment </a></li>	
              <li><a href="<?=site_url('sale/upcoming_payment')?>"> Upcoming Payment </a></li>   
            </ul>
        </li>
		<?php } ?>
          <li class="current"><a href="#a" class="white">Accounts</a>
            <ul>
                <li><a href="<?=site_url('payment/add_payment')?>">Add Received Payment </a> </li>
                <li><a href="<?=site_url('payment/add_expense')?>">Add Expenditure </a></li>
                <li><a href="<?=site_url('payment')?>">Received Payment History</a> </li>
                <li><a href="<?=site_url('payment/expenditure')?>">Expenditure History</a></li>
                <li><a href="<?=site_url('payment/bank_deposit')?>">Bank Deposit </a></li>
                <li><a href="#user">Cash Statement</a></li>
                <li><a href="#user">Sales Collection & Outstanding </a></li>
            
            </ul>
        </li>
       
		 <li class="current"><a href="#a" class="white">Settings</a>
            <ul>
                <li><a href="<?=site_url('settings')?>">Add Category</a> </li>
                <li><a href="<?=site_url('settings/rm_rate')?>">Add RM Rate</a></li>
                <li><a href="<?=site_url('settings/product_rate')?>">Add FP Rate </a></li>	
            
            </ul>
        </li>
    </ul>
	<?php }?>
</div>
<div class="clear"></div>
