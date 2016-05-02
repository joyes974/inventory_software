<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Finished products Model
 *
 * @author Joyes
 */
class fp_model  extends Model{
   function __construct() {
       parent::Model();
   }
    function get_fp_grid()
   {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption='1 ';
        if( $this->session->userdata('purchase_search')!='')
                {
                    $serachoption=$this->session->userdata('purchase_search');
                    $this->session->unset_userdata('purchase_search');
                }
            
                    
        $sql = "select * from finished_product where ".$serachoption.$sort;
      
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 	1;
        $count = sql::count('finished_product', '1');
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
		$total_stock=0;
		  foreach ($rows as $row) { 
		$res=sql::row('finished_product_category','id='.$row['category_id']);
$total_stock+=$row['current_stock']*$row['rate'];
}
		$responce->rows[0]['cell'] = array('->','->','->','->',"Total = ".$total_stock);
        foreach ($rows as $row) { 
		$res=sql::row('finished_product_category','id='.$row['category_id']);

		$responce->rows[$i]['id'] =  $row['id'];
            $responce->rows[$i]['cell'] = array($res['category_name'],$row['product_name'], $row['current_stock'], $row['rate'],$row['current_stock']*$row['rate']);
            $i++;
        }
		 
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author:Tamal Kanti Ghose");
        header("Email: tamal@flammabd.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
   }
   
   function get_fp_release_grid()
   {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
       
	$serachoption="realeased_finished_product_info.item_id=finished_product.id";
               
            
                    
        $sql = "SELECT realeased_finished_product_info.id AS id, realeased_finished_product_info.item_id AS item_id, realeased_finished_product_info.released_date AS date, realeased_finished_product_info.released_amount AS amount, finished_product.id AS raw_id,finished_product.category_id AS cat_id, finished_product.product_name AS name FROM realeased_finished_product_info, finished_product WHERE ".$serachoption." order by realeased_finished_product_info.id";
        
		$page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('finished_product', '1');
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 5;
        }
        if ($page > $total_pages)
            $page = $total_pages;

        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit;
        if ($start < 0)
            $start = 0;

        $sql_query = $this->db->query($sql . " limit $start, $limit");
        $rows = $sql_query->result_array();

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        foreach ($rows as $row) { 
            $res=sql::row('finished_product_category','id='.$row['cat_id']);
            
		    $responce->rows[$i]['id'] =  $row['id'];
            $responce->rows[$i]['cell'] = array($res['category_name'],$row['name'], $row['amount'], $row['date']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author:Tamal Kanti Ghose");
        header("Email: tamal@flammabd.com");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
   }
   
   function get_category($con='') {
   
        $opt = '<select name="item_id">';
        $sql = "select * from finished_product_category";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt.='<option value="">Select</option>';
        foreach ($rows as $row) {
		$res=sql::row('finished_product_category','id='.$row['parent_id']);
            if($con==$row['id'])
            $opt.='<option value=' . $row['id'] . ' selected>' .$res['category_name'].'->'. $row['category_name'] . '</option>';
        else {
            
         $opt.='<option value=' . $row['id'] . '>' .$res['category_name'].'->'. $row['category_name'] . '</option>';}
        }
        $opt.='</select>';
        echo $opt;
    }
	
	
    function get_items($con='') {
        $opt = '<select name="item_id">';
        $sql = "select * from finished_product";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt.='<option value="">Select</option>';
        foreach ($rows as $row) {
		$res=sql::row('finished_product_category','id='.$row['category_id']);
            if($con==$row['id'])
            $opt.='<option value=' . $row['id'] . ' selected>'.$res['category_name'].'->'. $row['product_name'] . '</option>';
        else {
            
         $opt.='<option value=' . $row['id'] . '>'.$res['category_name'].'->' . $row['product_name'] . '</option>';}
        }
        $opt.='</select>';
        echo $opt;
    }
	
	function add_product() {
       
        $sql = "insert into finished_product set
                                     category_id={$this->db->escape($_POST['item_id'])},                                     
                                     product_name={$this->db->escape($_POST['product_name'])}";
        return $this->db->query($sql);
    }
  
     function delete_product($id='')
    {
      $sql="delete from finished_product where id=".$id;  
         return $this->db->query($sql);
    }
 
    function add_fp_release() {
        //$date = date("Y/m/d");
        $sql = "insert into realeased_finished_product_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     released_amount={$this->db->escape($_POST['released_amount'])},
                                     released_date ={$this->db->escape($_POST['released_date'])},
                                     operator ={$this->db->escape($_POST['operator'])}";
         $this->db->query($sql);
         
        $val = sql::row('finished_product', 'id=' . $_POST['item_id']);
       
        $relesed = $val['current_stock'] + $_POST['released_amount'];
      
        $update_sql = "update  finished_product set current_stock=" . $relesed.' where id=' .$_POST['item_id'];
        return $this->db->query($update_sql);
    }
 
   function update_fp_release($id='') {
       //$date=date("Y/m/d");
       $data1=sql::row('realeased_finished_product_info','id='.$id);
       if($data1['released_amount']==$_POST['released_amount']){
        $sql = "update realeased_finished_product_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     released_amount={$this->db->escape($_POST['released_amount'])},
                                      released_date ={$this->db->escape($_POST['released_date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=".$id;
        return $this->db->query($sql);
       }
       else if ($data1['released_amount'] < $_POST['released_amount']) {
            $sql = "update realeased_finished_product_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     released_amount={$this->db->escape($_POST['released_amount'])},
                                     released_date ={$this->db->escape($_POST['released_date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=".$id;
         $this->db->query($sql);
         $u_ammount=  $_POST['released_amount'] - $data1['released_amount']; 
         $val = sql::row('finished_product', 'id=' . $_POST['item_id']);
       
        $relesed = $val['current_stock'] + $u_ammount;
      
        $update_sql = "update  finished_product set current_stock=" . $relesed.' where id=' .$_POST['item_id'];
        return $this->db->query($update_sql);
       
   }
   
   else if ($data1['released_amount'] > $_POST['released_amount']) {
            $sql = "update realeased_finished_product_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     released_amount={$this->db->escape($_POST['released_amount'])},
                                     released_date ={$this->db->escape($_POST['released_date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=".$id;
         $this->db->query($sql);
         $u_ammount= $data1['released_amount'] - $_POST['released_amount']; 
         $val = sql::row('finished_product', 'id=' . $_POST['item_id']);
       
        $relesed = $val['current_stock'] - $u_ammount;
      
        $update_sql = "update  finished_product set current_stock=" . $relesed.' where id=' .$_POST['item_id'];
        return $this->db->query($update_sql);
       
   }
   
    }
   
   function delete_fp_release($id='')
    {
       
       $res= sql::row('realeased_finished_product_info','id='.$id);
         $res1=sql::row('finished_product','id='.$res['item_id']);
         $current_amount=$res1['current_stock']-$res['released_amount'];
         $sql = "update finished_product set
                                    current_stock={$this->db->escape($current_amount)} where id=" . $res['item_id'];
         $this->db->query($sql);
         
                    
        $sql="delete from realeased_finished_product_info where id=".$id;  
        return $this->db->query($sql);
    }
 
   }

?>
