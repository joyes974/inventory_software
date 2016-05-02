<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settings_model
 *
 * @author Joyes
 */
class settings_model extends Model {

    function __construct() {
        parent::Model();
    }

    function get_category_grid() {
        $sortname = common::getVar('sidx', 'id');
        $sortorder = common::getVar('sord', 'desc');
        $sort = "ORDER BY $sortname $sortorder";
        $serachoption = '1 ';
        if ($this->session->userdata('purchase_search') != '') {
            $serachoption = $this->session->userdata('purchase_search');
            $this->session->unset_userdata('purchase_search');
        }
        
		

        $sql = "select * from finished_product_category where " . $serachoption . $sort;

        $page = common::getVar('page', 1);
        $limit = common::getVar('rows');
        $i = 0;
        $count = sql::count('finished_product_category', '1');
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
			$res=sql::row('finished_product_category','id='.$row['parent_id']);
		
            $responce->rows[$i]['cell'] = array($row['category_name'], $res['category_name']);
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

    

    function get_item() {
        $opt = '<select name="item_id">';
        $sql = "select * from finished_product_category WHERE parent_id='0' ";
        $sql_query = $this->db->query($sql);
        $rows = $sql_query->result_array();
        $opt.='<option value="">Select</option>';
        foreach ($rows as $row) {
           if($con==$row['id'])
           $opt.='<option value=' . $row['id'] . ' selected>' . $row['category_name'] . '</option>';
           else
                $opt.='<option value=' . $row['id'] . '>' . $row['category_name'] . '</option>';
            
        }
        $opt.='</select>';
        echo $opt;
    }

    function add_category() {
        //$date = date("Y/m/d");
        $sql = "insert into finished_product_category set
                                     parent_id ={$this->db->escape($_POST['item_id'])},                                     
                                     category_name ={$this->db->escape($_POST['category_name'])}";
        return $this->db->query($sql);
        
    }
/*
    function update_rm_release($id = '') {
        $date = date("Y/m/d");
        $sql = "update released_row_material_info set
                                     item_id={$this->db->escape($_POST['item_id'])},                                     
                                     amount={$this->db->escape($_POST['amount'])},
                                     date ={$this->db->escape($date)} where id=" . $id;
        return $this->db->query($sql);
    }
*/
    function delete_category($id = '') {
        $sql = "delete from finished_product_category where id=" . $id;
        return $this->db->query($sql);
    }
	
	
	
	function get_product_rate_grid()
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
		$res=sql::row('finished_product_category','id='.$row['category_id']);
            $responce->rows[$i]['id'] =  $row['id'];
            $responce->rows[$i]['cell'] = array($res['category_name'],$row['product_name'], $row['rate']);
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
   
   function add_product_rate() {

        $sql = "insert into finished_product set
                                     category_id={$this->db->escape($_POST['item_id'])},                                     
                                     rate={$this->db->escape($_POST['product_rate'])}";
        return $this->db->query($sql);
    }

    function update_product_rate($id = '') {

        $sql = "update finished_product set
                                    id={$this->db->escape($_POST['item_id'])},                                     
                                     rate={$this->db->escape($_POST['product_rate'])} where id=" . $id;
        return $this->db->query($sql);
    }
    
     function delete_product_rate($id = '') {
        $sql = "delete from finished_product where id=" . $id;
        return $this->db->query($sql);
    }
    
    function get_rm_rate_grid() {
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
            $responce->rows[$i]['cell'] = array($row['row_material_name'], $row['rate']);
            $i++;
        }
        header("Expires: Sat, 17 Jul 2010 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Author:Mohaimenkhan");
        header("Email: joyes@sec.ac.bd");
        header("Content-type: text/x-json");
        echo json_encode($responce);
        return '';
    }
    
    function add_rm_rate() {

        $sql = "insert into stock_raw_material set
                                     row_material_name={$this->db->escape($_POST['row_material_name'])},                                     
                                     rate={$this->db->escape($_POST['rate'])}";
        return $this->db->query($sql);
    }
    
    function update_rm_rate($id = '') {

        $sql = "update stock_raw_material set
                                    row_material_name={$this->db->escape($_POST['row_material_name'])},                                     
                                     rate={$this->db->escape($_POST['rate'])} where id=" . $id;
        return $this->db->query($sql);
    }
    
     function delete_rm_rate($id = '') {
        $sql = "delete from stock_raw_material where id=" . $id;
        return $this->db->query($sql);
    }


}

?>
