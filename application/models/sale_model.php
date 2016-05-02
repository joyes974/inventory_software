<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sale_model
 *
 * @author Mohaimen
 */
class sale_model extends Model {

    function __construct() {
        parent::Model();
    }
    
    function get_sales_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            $this->session->unset_userdata('purchase_search');
        }
        
		

        $sql = "select * from seller where " . $serachoption . $sort;

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('seller', '1');
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
            $responce->rows[$i]['id'] = $row['id'];
			
		
            $responce->rows[$i]['cell'] = array($row['zone'], $row['name']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author:Mohaimen khan");
        header("Email: joyes@sec.ac.bd");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }

    
  function get_products($id='')
  {
  $sql = "SELECT * from finished_product_category where parent_id=" . $id;
        $res = $this->db->query($sql);
        $final = $res->result_array();
   
        if (count($final) > 0) {
            for ($i = 0; $i < count($final); $i++) {
                $arr[$i] = $final[$i]['id'];
            }
            $str = implode(',', $arr);
            $sql1 = "select * from finished_product where category_id IN ( " . $str . ")";
           
            $res1 = $this->db->query($sql1);
            $res1=$res1->result_array();
      return $res1;
  }}
  
  function add_sale(){
      
       $sql = "insert into payment set                                    
                                     invoice_no={$this->db->escape($_POST['invoice_no'])},     
                                     reason={$this->db->escape($_POST['reason'])},
                                     order_num={$this->db->escape($_POST['order_no'])},
                                     date={$this->db->escape($_POST['date'])},     
                                     operator={$this->db->escape('default')},
                                     amount={$this->db->escape($_POST['amount'])},
                                     payby={$this->db->escape($_POST['payby'])}";
         $this->db->query($sql);
         
      
         $sql = "insert into sale set                                    
                                     date={$this->db->escape($_POST['date'])},     
                                     do_no={$this->db->escape($_POST['do_no'])},
                                     order_no={$this->db->escape($_POST['order_no'])},
                                     pending_amount={$this->db->escape($_POST['pending_amount'])},
                                     next_payment_date={$this->db->escape($_POST['next_payment_date'])},
                                     item_cost={$this->db->escape($_POST['item_cost'])},
                                     transport_cost={$this->db->escape($_POST['transport_cost'])},     
                                     tt_cost={$this->db->escape($_POST['tt_cost'])},
                                     total_bag={$this->db->escape($_POST['total_bag'])},
                                     payble_amount={$this->db->escape($_POST['payble_amount'])}";
         $this->db->query($sql);
         
      
      
      $i=$_POST['product_id'];
      $j=$_POST['quantity'];
      $k=count($_POST['quantity']);
      
      for($l=0;$l<$k; $l++){
          if($j[$l]!=null){
          
      $sql = "insert into sale_details set
                                    
                                     product_id={$this->db->escape($i[$l])},                                     
                                     amount={$this->db->escape($j[$l])}";
         $this->db->query($sql);
        $res= sql::row('finished_product','id='.$i[$l]);
         
        $current_stock= $res['current_stock']-$j[$l];
        
        $sql = "update finished_product set
                                    current_stock={$this->db->escape($current_stock)} where id=" . $i[$l];
         $this->db->query($sql);
         
        }
        
        }
        $sql = "insert into seller set                                    
                                     chalan={$this->db->escape($_POST['chalan'])},     
                                     name={$this->db->escape($_POST['name'])},
                                     address={$this->db->escape($_POST['address'])},
                                     zone={$this->db->escape($_POST['zone'])}";
         return $this->db->query($sql);
  }
  
  function get_sl() {
        $sql_order="select max(id) as sl from sale";
        $sql_sl = $this->db->query($sql_order);
       $row_order = $sql_sl->result_array();
       foreach ($row_order as $raw) {
       $raw1= 1+$raw['sl'];
       }
       
       echo $raw1;
}

  function get_invoice() {
        $sql_order="select max(id) as sl from payment";
        $sql_sl = $this->db->query($sql_order);
       $row_order = $sql_sl->result_array();
       foreach ($row_order as $raw) {
       $raw1= 1+$raw['sl'];
       }
       
       echo $raw1;
}

function get_pending_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            //$this->session->unset_userdata('purchase_search');
        }
        $sql = "select * from sale,seller where pending_amount!=0 and sale.id=seller.id ORDER BY sale.id desc";
     
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('sale', '1');
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
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['order_no'], $row['name'], $row['zone'], $row['payble_amount'],$row['pending_amount'],$row['date'],$row['next_payment_date']);
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
    
    function get_upcoming_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            //$this->session->unset_userdata('purchase_search');
        }
        $dd=date("y-m-d");
        $dd="'".$dd."'";
        $sql = "select * from sale,seller where pending_amount!=0 and next_payment_date>=$dd and sale.id=seller.id ORDER BY sale.id desc";
     
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('sale', '1');
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
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['order_no'], $row['name'], $row['zone'], $row['payble_amount'],$row['pending_amount'],$row['date'],$row['next_payment_date']);
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
  /*  function get_products($id = '') {
           $html="";
        $sql = "SELECT * from finished_product_category where parent_id=" . $id;
        $res = $this->db->query($sql);
        $final = $res->result_array();
        if (count($final) > 0) {
            for ($i = 0; $i < count($final); $i++) {
                $arr[$i] = $final[$i]['id'];
            }
            $str = implode(',', $arr);
            $sql1 = "select * from finished_product where category_id IN ( " . $str . ")";
            $res1 = $this->db->query($sql1);
            $res1=$res1->result_array();
            for ($j = 0; $j < count($final); $j++) {
                $html.= "<div class=" . '"' . "portlet-content fl_left" . '"' . " style=" . '"' . "width: 40%;border:1px solid grey;margin:10px;padding:10px;" . '"' . ">" .
                $final[$j]['category_name'];
                if(count($res1>0)){
                      $html.=  "<table>";
                for ($k = 0; $k < count($res1); $k++) {    
           $html.= " <tr>
                <th>".$res1[$k]['product_name'] ."</th>
                <td><input type=" .'"'. 'text'.'"' . "class=" .'"'. "input_txt width_100 number ".'"' . "name=" .'"'."amount[]" .'"' . "/></td>
                   <td><input type=" .'"'. 'hidden'.'"' . "class=" .'"'. "input_txt width_100 number ".'"' . "name=" .'"'."product_id[]" .'"' ."value= ".$res1[$k]['id'] . "/></td>
           
</tr>";
           
      }
                     
         $html.= "</table>";
         $html.= "</div>";
         
         } 
     
            }
             
            echo $html;
        } else {
           echo  "<div class=".'"'."clear".'"'.">";
            echo  'NO Products Found!!!!';
        }
    }*/

}

?>
