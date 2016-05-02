<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Raw_Material_model
 *
 * @author Joyes
 */
class raw_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_rm_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            $this->session->unset_userdata('purchase_search');
        }


        $sql = "select * from stock_raw_material where " . $serachoption . $sort;

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('stock_raw_material', '1');
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
            $responce->rows[$i]['cell'] = array($row['row_material_name'], $row['current_stock'], $row['rate'], $row['current_stock'] * $row['rate']);
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

    function get_rm_release_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";

        $serachoption = "released_row_material_info.item_id=stock_raw_material.id ";


        if ($this->session->userdata('rm_search') != '') {
            $search = $this->session->userdata('rm_search');
            $serachoption.=$search;
            //$this->session->unset_userdata('purchase_search');
        }

        $sql = "SELECT batch,operator,released_row_material_info.id AS id, released_row_material_info.item_id AS item_id, released_row_material_info.date AS date, released_row_material_info.amount AS amount, stock_raw_material.id AS raw_id, stock_raw_material.row_material_name AS name FROM released_row_material_info, stock_raw_material WHERE " . $serachoption . " order by released_row_material_info.id";

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('stock_raw_material', '1');
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
            $responce->rows[$i]['cell'] = array($row['name'], $row['batch'], $row['amount'], $row['date'], $row['operator']);
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
    
    function get_rm_items($con = '') {
       
        $sql = "select * from stock_raw_material";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt='<option value="">Select</option>';
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

    function add_rm_release() {
        //$date = date("Y/m/d");
        $sql = "insert into released_row_material_info set
                                     item_id={$this->db->escape($_POST['item_id'])},     
                                     batch={$this->db->escape($_POST['batch'])},                                
                                     amount={$this->db->escape($_POST['amount'])},
                                     date ={$this->db->escape($_POST['date'])},
                                     operator ={$this->db->escape($_POST['operator'])}";
        $this->db->query($sql);
        $val = sql::row('stock_raw_material', 'id=' . $_POST['item_id']);
        $relesed = $val['current_stock'] - $_POST['amount'];
        $update_sql = "update  stock_raw_material set 
             current_stock=" . $relesed.' where id=' . $_POST['item_id'];
        return $this->db->query($update_sql);
    }

    function update_rm_release($id = '') {
        //$date = date("Y/m/d");
        $data1=sql::row('released_row_material_info','id='.$id);
        if($data1['amount']==$_POST['amount']){
        $sql = "update released_row_material_info set
                                     item_id={$this->db->escape($_POST['item_id'])},
                                     batch={$this->db->escape($_POST['batch'])},                                     
                                     amount={$this->db->escape($_POST['amount'])},
                                     date ={$this->db->escape($_POST['date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=" . $id;
        return $this->db->query($sql);
        }
        else if($data1['amount']<$_POST['amount']){
            $sql = "update released_row_material_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     amount={$this->db->escape($_POST['amount'])},
                                     date ={$this->db->escape($_POST['date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=" . $id;
         $this->db->query($sql);
        $u_amm=  $_POST['amount'] -  $data1['amount'];  
        $val = sql::row('stock_raw_material', 'id=' . $_POST['item_id']);
        $relesed = $val['current_stock'] - $u_amm;
        $update_sql = "update  stock_raw_material set 
             current_stock=" . $relesed.' where id=' . $_POST['item_id'];
        return $this->db->query($update_sql);
        }
        
         else if($data1['amount']>$_POST['amount']){
            $sql = "update released_row_material_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     amount={$this->db->escape($_POST['amount'])},
                                     date ={$this->db->escape($_POST['date'])},
                                     operator ={$this->db->escape($_POST['operator'])} where id=" . $id;
         $this->db->query($sql);
        $u_amm = $data1['amount'] - $_POST['amount'];  
        $val = sql::row('stock_raw_material', 'id=' . $_POST['item_id']);
        $relesed = $val['current_stock'] + $u_amm;
        $update_sql = "update  stock_raw_material set 
             current_stock=" . $relesed.' where id=' . $_POST['item_id'];
        return $this->db->query($update_sql);
        }
        
    }

    function delete_rm_release($id = '') {
        
        $val = sql::row('released_row_material_info', 'id=' . $id);
        $val1 = sql::row('stock_raw_material', 'id=' . $val['item_id']);
        $relesed = $val1['current_stock'] + $val['amount'];
        $update_sql = "update  stock_raw_material set 
             current_stock=" . $relesed.' where id=' . $val['item_id'];
         $this->db->query($update_sql);
        $sql = "delete from released_row_material_info where id=" . $id;
        return $this->db->query($sql);
    }
    
     function get_rm_received_consumption_grid() {
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
            $val = sql::row('stock_raw_material', 'id=' .$row['item_id']);
           
            $responce->rows[$i]['id'] = $row['id'];
            $responce->rows[$i]['cell'] = array($row['item_id'] ,$row['provider_name'], $row['contact_number'], $row['challan_no']);
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
