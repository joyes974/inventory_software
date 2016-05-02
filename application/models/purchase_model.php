<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase_model
 *
 * @author Tamal
 */
class purchase_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_purchase_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            //$this->session->unset_userdata('purchase_search');
        }
        $sql = "select * from purchase where " . $serachoption . $sort;
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('purchase', '1');
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
            $responce->rows[$i]['cell'] = array($row['id'], $row['provider_name'], $row['contact_number'], $row['challan_no']);
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

    function get_order() {
        $sql_order="select max(id) as sl from purchase";
        $sql_sl = $this->db->query($sql_order);
       $row_order = $sql_sl->result_array();
       foreach ($row_order as $raw) {
       $raw1= 1+$raw['sl'];
       }
       
       echo $raw1;
}
    

function get_party($con = '') {
       
        $sql = "select * from purchase";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt='<option value="">Select Name</option>';
        foreach ($rows as $row) {
            if ($con == $row['provider_name'])
                $opt.='<option value=' . $row['provider_name'] . ' selected>' . $row['provider_name'] . '</option>';
            else {

                $opt.='<option value=' . $row['provider_name'] . '>' . $row['provider_name'] . '</option>';
            }
        }
        
        echo $opt;
    }
   
    function get_items($con = '') {
        $opt = '<select name="item_id">';
        $sql = "select * from stock_raw_material";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt.='<option value="">Select</option>';
        foreach ($rows as $row) {
            if ($con == $row['id'])
                $opt.='<option value=' . $row['id'] . ' selected>' . $row['row_material_name'] . '</option>';
            else {

                $opt.='<option value=' . $row['id'] . '>' . $row['row_material_name'] . '</option>';
            }
        }
        $opt.='</select>';
        echo $opt;
    }

    function add_purchase() {
    
     $sql = "insert into expenditure set
                                     date={$this->db->escape($_POST['date'])},
                                     order_num={$this->db->escape($_POST['order_no'])},
                                     invoice_num={$this->db->escape($_POST['invoice_no'])},
                                     amount={$this->db->escape($_POST['amount'])},
                                     operator={$this->db->escape('x')},
                                     category={$this->db->escape('category')},
                                     reason={$this->db->escape('reason')}";
                                     $this->db->query($sql);
    

        $sql = "insert into purchase set
                                     date={$this->db->escape($_POST['date'])},
                                     provider_name={$this->db->escape($_POST['provider_name'])},
                                     contact_number={$this->db->escape($_POST['contact_number'])},
                                     item_id={$this->db->escape($_POST['item_id'])},
                                     zone={$this->db->escape($_POST['zone'])},
                                     challan_no={$this->db->escape($_POST['challan_no'])},
                                     truck_no={$this->db->escape($_POST['truck_no'])},
                                     num_bags={$this->db->escape($_POST['num_bags'])},
                                     sending_weight={$this->db->escape($_POST['sending_weight'])},
                                     gross_weight={$this->db->escape($_POST['gross_weight'])},
                                     only_truck_weight={$this->db->escape($_POST['only_truck_weight'])},
                                     rm_weight={$this->db->escape($_POST['rm_weight'])},
                                     bag_weight={$this->db->escape($_POST['bag_weight'])},
                                     net_weight={$this->db->escape($_POST['net_weight'])},
                                     truck_fee={$this->db->escape($_POST['truck_fee'])},
                                     total_payment={$this->db->escape($_POST['total_payment'])},
                                     unpaid={$this->db->escape($_POST['pending_amount'])},
                                     comments={$this->db->escape($_POST['comments'])},
                                     upcoming_payment_date={$this->db->escape($_POST['next_payment_date'])}";
        $this->db->query($sql);
        $val = sql::row('stock_raw_material', 'id=' . $_POST['item_id']);
        $add = $val['current_stock'] + $_POST['net_weight'];
        $update_sql = "update  stock_raw_material set 
             current_stock=" . $add . ' where id=' . $_POST['item_id'];
        return $this->db->query($update_sql);
    }

    function update_purchase($id = '') {
        $sql = "update  purchase set
                                     provider_name={$this->db->escape($_POST['provider_name'])},
                                     contact_number={$this->db->escape($_POST['contact_number'])},
                                     item_id={$this->db->escape($_POST['item_id'])},
                                     zone={$this->db->escape($_POST['zone'])},
                                     challan_no={$this->db->escape($_POST['challan_no'])},
                                     truck_no={$this->db->escape($_POST['truck_no'])},
                                     num_bags={$this->db->escape($_POST['num_bags'])},
                                     sending_weight={$this->db->escape($_POST['sending_weight'])},
                                     gross_weight={$this->db->escape($_POST['gross_weight'])},
                                     only_truck_weight={$this->db->escape($_POST['only_truck_weight'])},
                                     rm_weight={$this->db->escape($_POST['rm_weight'])},
                                     bag_weight={$this->db->escape($_POST['bag_weight'])},
                                     net_weight={$this->db->escape($_POST['net_weight'])},
                                     truck_fee={$this->db->escape($_POST['truck_fee'])},
                                     total_payment={$this->db->escape($_POST['total_payment'])},
                                     total_paid={$this->db->escape($_POST['total_paid'])} where id=" . $id;


        return $this->db->query($sql);
    }

    function delete_purchase($id = '') {
        $sql = "delete from expenditure where order_num=" . $id;
        $this->db->query($sql);
        $sql = "delete from purchase where id=" . $id;
        return $this->db->query($sql);
    }
    
    function get_invoice() {
        $sql_order="select max(id) as sl from expenditure";
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
        $sql = "select * from purchase where unpaid!=0 "  . $sort;
       
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('purchase', '1');
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
            $responce->rows[$i]['cell'] = array($row['id'], $row['provider_name'], $row['contact_number'], $row['challan_no']);
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
        
        //$sql = "select * from purchase where upcoming_payment_date BETWEEN $dd DATEADD(day, 7, $dd)  "  . $sort;
        
        $sql = "select * from purchase where unpaid!=0 and upcoming_payment_date>=$dd  "  . $sort;
        
       
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('purchase', '1');
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
            $responce->rows[$i]['cell'] = array($row['id'], $row['provider_name'], $row['contact_number'], $row['challan_no']);
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
    
    function get_overdue_grid() {
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
                
        $sql = "select * from purchase where unpaid!=0 and upcoming_payment_date<$dd  "  . $sort;
             
        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('purchase', '1');
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
            $responce->rows[$i]['cell'] = array($row['id'], $row['provider_name'], $row['contact_number'], $row['challan_no']);
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



}

?>
