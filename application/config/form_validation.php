<?php

$config = array(
    'add_purchase' => array(   
        array('field' => 'provider_name', 'label' => 'Provider Name', 'rules' => 'required'),
        array('field' => 'challan_no', 'label' => 'Challan No', 'rules' => 'required'),
        array('field' => 'num_bags', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'sending_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'gross_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'only_truck_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'rm_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'bag_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'net_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'truck_fee', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'total_payment', 'label' => '', 'rules' => 'required|is_numeric')
        
        
     
    ),
	 'valid_login' => array(
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required')
    ),
       'edit_purchase' => array(   
        array('field' => 'provider_name', 'label' => 'Provider Name', 'rules' => 'required'),
        array('field' => 'challan_no', 'label' => 'Challan No', 'rules' => 'required'),
        array('field' => 'num_bags', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'sending_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'gross_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'only_truck_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'rm_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'bag_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'net_weight', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'truck_fee', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'total_payment', 'label' => '', 'rules' => 'required|is_numeric'),
        array('field' => 'total_paid', 'label' => '', 'rules' => 'required|is_numeric')
        
        
     
    ),
	 'valid_user' => array(
        array('field' => 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field' => 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field' => 'user_name', 'label' => 'User Name', 'rules' => 'required'),
        array('field' => 'email', 'label' => 'Email', 'rules' => ''),
        array('field' => 'password', 'label' => 'Password', 'rules' => 'required'),
        array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]')
    ),
	'add_rm_release' => array(   //Joyes
	array('field' => 'batch', 'label' => 'Batch', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Release Amount', 'rules' => 'required|is_numeric'),
		array('field' => 'operator', 'label' => 'Operator Name', 'rules' => 'required'),
		array('field' => 'date', 'label' => 'Released Date', 'rules' => 'required'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'edit_rm_release' => array(   //Joyes
	array('field' => 'batch', 'label' => 'Batch', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Release Amount', 'rules' => 'required|is_numeric'),
		array('field' => 'operator', 'label' => 'Operator Name', 'rules' => 'required'),
		array('field' => 'date', 'label' => 'Released Date', 'rules' => 'required'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'add_fp_release' => array(   //Joyes
        array('field' => 'released_amount', 'label' => 'Release Amount', 'rules' => 'required|is_numeric'),
		array('field' => 'operator', 'label' => 'Operator Name', 'rules' => 'required'),
		array('field' => 'released_date', 'label' => 'Insert Date', 'rules' => 'required'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'edit_fp_release' => array(   //Joyes
        array('field' => 'released_amount', 'label' => 'Release Amount', 'rules' => 'required|is_numeric'),
		array('field' => 'operator', 'label' => 'Operator Name', 'rules' => 'required'),
		array('field' => 'released_date', 'label' => 'Insert Date', 'rules' => 'required'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'add_product' => array(   //Joyes
        array('field' => 'product_name', 'label' => 'Product Name', 'rules' => 'required'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'add_category' => array(   //Joyes
        array('field' => 'category_name', 'label' => 'Category Name', 'rules' => 'required')
         //array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'add_rate' => array(   //Joyes
        array('field' => 'product_rate', 'label' => 'Product Rate', 'rules' => 'required|is_numeric'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'edit_rate' => array(   //Joyes
        array('field' => 'product_rate', 'label' => 'Product Rate', 'rules' => 'required|is_numeric'),
         array('field' => 'item_id', 'label' => 'Item', 'rules' => 'required')    	
    ),
	
	'add_rm_rate' => array(   //Joyes
        array('field' => 'rate', 'label' => 'Current Rate', 'rules' => 'required|is_numeric'),
         array('field' => 'row_material_name', 'label' => 'Item Name', 'rules' => 'required')    	
    ),
	
	'add_sale' => array(   
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        //array('field' => 'challan_no', 'label' => 'Challan No', 'rules' => 'required'),
        array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
        array('field' => 'zone', 'label' => 'Zone', 'rules' => 'required'),
        array('field' => 'invoice_no', 'label' => 'Invoice Number', 'rules' => 'required|is_numeric'),
        array('field' => 'payby', 'label' => 'Payment Method', 'rules' => 'required'),
        array('field' => 'item_cost', 'label' => 'Item Cost', 'rules' => 'required|is_numeric'),
        array('field' => 'transport_cost', 'label' => 'Transport Cost', 'rules' => 'required|is_numeric'),
        array('field' => 'tt_cost', 'label' => 'TT Cost', 'rules' => 'required|is_numeric'),
        array('field' => 'total_bag', 'label' => 'Total Bag', 'rules' => 'required'),
        array('field' => 'payble_amount', 'label' => 'Payble Amount', 'rules' => 'required|is_numeric')
            
    ),
	
	'add_payment' => array(   
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'reason', 'label' => 'Reason', 'rules' => 'required'),
        //array('field' => 'order', 'label' => 'Order No', 'rules' => 'required|is_numeric'),
        array('field' => 'invoice_no', 'label' => 'Invoice Number', 'rules' => 'required|is_numeric'),
        array('field' => 'payby', 'label' => 'Payment Method', 'rules' => 'required'),
        array('field' => 'operator', 'label' => 'Operator', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Amount', 'rules' => 'required|is_numeric')
            
    ),
	
	'add_expense' => array(   
        array('field' => 'date', 'label' => 'Date', 'rules' => 'required'),
        array('field' => 'reason', 'label' => 'Reason', 'rules' => 'required'),
        array('field' => 'order_num', 'label' => 'Order No', 'rules' => 'required|is_numeric'),
        array('field' => 'invoice_no', 'label' => 'Invoice Number', 'rules' => 'required|is_numeric'),
        //array('field' => 'category', 'label' => 'Payment Method', 'rules' => 'required'),
        array('field' => 'operator', 'label' => 'Operator', 'rules' => 'required'),
        array('field' => 'amount', 'label' => 'Amount', 'rules' => 'required|is_numeric')
            
    ),
    
);
?>