<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Raw Materials
 *
 * @author Joyes
 */
class rawmaterials extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('raw_model');
		$this->load->model('purchase_model');
        $this->load->library('grid');
    }

    function index() {
        $gridObj = new grid();
        $gridColumn = array("Raw material name", "Current Stock(K.G.)","Rate(Per K.G.)","Total Value");
        $gridColumnModel = array(
            array("name" => "row_material_name",
                "index" => "row_material_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "current_stock",
                "index" => "current_stock",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "rate",
                "index" => "rate",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "",
                "index" => "",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
        if ($_POST['apply_filter']) { 
                $condition = '';


                if ($_POST['searchField'] == 1) {
                    $condition.=" zone LIKE '%" . $_POST['searchValue'] . "%' ";
                }
                if ($_POST['searchField'] == 2) {
                    $condition.="  provider_name LIKE '%" . $_POST['searchValue'] . "%' ";
                }
                if ($condition != '') {
                    $this->session->set_userdata('purchase_search', $condition);
                }
               
            }
        
        $gridObj->setGridOptions("Raw Materials Stock", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('rawmaterials/load_raw_materials'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'rawmaterial';
        $data['page'] = 'index_stock';
        $data['page_title'] = 'Manage purchases';
        $data['button']=1;
        $this->load->view('main', $data);
    }

    function load_raw_materials() {
        $this->raw_model->get_rm_grid();
    }
	
	function release_report() {
        $gridObj = new grid();
        $gridColumn = array("Item Name","Batch", "Amount Release(K.G.)","Release Date","Operator Name");
        $gridColumnModel = array(
            array("name" => "name",
                "index" => "name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "batch",
                "index" => "batch",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "amount",
                "index" => "amount",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "date",
                "index" => "date",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "operator",
                "index" => "operator",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )
        );
       
         $this->session->unset_userdata('rm_search');
      // $this->session->unset_userdata('zone');
       $this->session->unset_userdata('rm_name');
       $this->session->unset_userdata('stating_date');
       $this->session->unset_userdata('ending_date');
       
        if ($_POST['apply_filter']) {
            
            $condition = '';
            $track=0;
            if ($_POST['searchField']) {
                $condition.="and stock_raw_material.id= " . $_POST['searchField']." ";
                $track=1;
            }
           
  
            if($_POST['starting_date']&&$_POST['ending_date'])
            {
                          
            
               $condition.='and ' ;
            
               $condition.= ' released_row_material_info.date between '."'".$_POST['starting_date']."'".' and '."'".$_POST['ending_date']."'";
            }
            if($_POST['starting_date']&&!($_POST['ending_date'])){
                          
               $condition.='and ' ;
            
               $condition.= ' date >= '."'".$_POST['starting_date']."'"; 
            }
              if($_POST['ending_date']&&!($_POST['starting_date'])){
                            
               $condition.='and ' ;
            
               $condition.= ' date <= '."'".$_POST['ending_date']."'"; 
            }
         
           
         
            if ($condition != '') {
                $this->session->set_userdata('rm_search', $condition);
                
                //echo $condition;
                //exit;
            }
            
            
        }
        
        
        $gridObj->setGridOptions("Raw Materials Stock Report", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('rawmaterials/load_rm_release'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'rawmaterial';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage Raw Materials';
        $this->load->view('main', $data);
    }
	function load_rm_release() {
        $this->raw_model->get_rm_release_grid();
    }
	
	function add_rm_release() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_rm_release')) {
                 if ($this->raw_model->add_rm_release()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('rawmaterials/release_report');
                }
                
                
            }
        }
         $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'rawmaterial';
        $data['page'] = 'add_rm_release';
        $this->load->view('main', $data);
    }

	function edit_rm_release($id='') {
        if ($_POST['save']) {
            if ($this->form_validation->run('edit_rm_release')) {
                 if ($this->raw_model->update_rm_release($id)) {
                    $this->session->set_flashdata('msg', 'Content Updated Successfully!!!');
                    redirect('rawmaterials/release_report');
                }    
            }
        }
        $data=sql::row('released_row_material_info','id='.$id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'rawmaterial'; 
        $data['page'] = 'edit_rm_release';
        $this->load->view('main', $data);
    }
	
      function delete_rm_release($id='') {
       
        if ($id == '') {
            redirect('rawmaterials/release_report');
        }
        $this->raw_model->delete_rm_release($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('rawmaterials/release_report');
    }
	
	function show_rm_stock_report() {
        /*$serachoption = $this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }*/
        $data['rows'] = sql::rows('stock_raw_material');
        $data['dir'] = 'rawmaterial';
        $data['page'] = 'print_rm_stock_report';
        $data['page_title'] = 'RM Stock Report';
        
        $this->load->view('print_main', $data);
    }
    
    function show_rm_release_report() {
        /*$serachoption = $this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }*/
        $data['rows'] = sql::rows('released_row_material_info');
        $data['dir'] = 'rawmaterial';
        $data['page'] = 'print_rm_release_report';
        $data['page_title'] = 'RM Release Report';
        $this->load->view('print_main', $data);
    }
    
    function rm_received_consumption() {
         $gridObj = new grid();
        $gridColumn = array("Material's Name", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "item_id",
                "index" => "item_id",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "provider_name",
                "index" => "provider_name",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "contact_number",
                "index" => "contact_number",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "challan_no",
                "index" => "challan_no",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            )
        );
       $this->session->unset_userdata('purchase_search');
       $this->session->unset_userdata('zone');
       $this->session->unset_userdata('provider_name');
       $this->session->unset_userdata('stating_date');
       $this->session->unset_userdata('ending_date');
        if ($_POST['apply_filter']) {
            $condition = '';
            $track=0;
            if ($_POST['searchField'] == 1&& $_POST['searchValue']) {
                $condition.=" zone LIKE '%" . $_POST['searchValue'] . "%' ";
                $track=1;
            }
            if ($_POST['searchField'] == 2&&  $_POST['searchValue']) {
                $condition.="  provider_name LIKE '%" . $_POST['searchValue'] . "%' ";
                $track=1;
            }
  
            if($_POST['starting_date']&&$_POST['ending_date'])
            {
                          if($track)
            {
               $condition.='and ' ;
            }
               $condition.= ' date between '."'".$_POST['starting_date']."'".' and '."'".$_POST['ending_date']."'";
            }
            if($_POST['starting_date']&&!($_POST['ending_date'])){
                          if($track)
            {
               $condition.='and ' ;
            }
               $condition.= ' date >= '."'".$_POST['starting_date']."'"; 
            }
              if($_POST['ending_date']&&!($_POST['starting_date'])){
                            if($track)
            {
               $condition.='and ' ;
            }
               $condition.= ' date <= '."'".$_POST['ending_date']."'"; 
            }
         
           
         
            if ($condition != '') {
                $this->session->set_userdata('purchase_search', $condition);
            }
        }
        $gridObj->setGridOptions("Manage Purchases", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('purchase/load_purchase'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'index';
        $data['page_title'] = 'Manage purchases';
        $this->load->view('main', $data);
    }
	function load_received_consumption() {
            
            /*$row=1;
             $val = sql::row('stock_raw_material', 'id=' .$row);
             echo $val['row_material_name'];*/
        $this->raw_model->get_rm_received_consumption_grid();
       // print_r($responce);
    }
}

?>
