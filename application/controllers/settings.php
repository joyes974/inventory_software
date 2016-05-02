<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *Settings*
 * @author Joyes
 */
class settings extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('settings_model');
		$this->load->model('fp_model');
		$this->load->library('grid');
    }

   
	
	function index() {
        $gridObj = new grid();
        $gridColumn = array("Category Name", "Parent Category");
        $gridColumnModel = array(
            array("name" => "category_name ",
                "index" => "category_name ",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "parent_id",
                "index" => "parent_id",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )
        );
       
        
        $gridObj->setGridOptions("Set Category", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('settings/category'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'index';
        $data['page_title'] = 'Set Category';
        $this->load->view('main', $data);
    }
	function category() {
        $this->settings_model->get_category_grid();
    }
	
	function add_category() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_category')) {
                 if ($this->settings_model->add_category()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('settings');
                }
                
                
           }
        }
         $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'add_category';
        $this->load->view('main', $data);
    }
/*
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
	*/
      function delete_category($id='') {
       
        if ($id == '') {
            redirect('settings');
        }
        $this->settings_model->delete_category($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('settings');
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
	
	
	function product_rate() {
        $gridObj = new grid();
        $gridColumn = array("Category","Item name","Rate(Per K.G.)");
        $gridColumnModel = array(
		
		        array("name" => "name1",
                "index" => "name1",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),

            array("name" => "product_name",
                "index" => "product_name",
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
        
        $gridObj->setGridOptions("Finished Products Rate", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('settings/load_product_rate'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'index_rate';
        $data['page_title'] = 'Finished Products Rate';
        $data['button']=1;
        $this->load->view('main', $data);
    }

    function load_product_rate() {
        $this->settings_model->get_product_rate_grid();
    }
	
	function add_product_rate() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_rate')) {
                 if ($this->settings_model->add_product_rate()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('settings/product_rate');
                }
                
                
            }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'add_product_rate';
        $this->load->view('main', $data);
    }
	
	function edit_product_rate($id='') {
        if ($_POST['save']) {
            if ($this->form_validation->run('edit_rate')) {
                 if ($this->settings_model->update_product_rate($id)) {
                    $this->session->set_flashdata('msg', 'Content Updated Successfully!!!');
                    redirect('settings/product_rate');
                }    
            }
        }
        $data=sql::row('finished_product','id='.$id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings'; 
        $data['page'] = 'edit_product_rate';
        $this->load->view('main', $data);
    }
    
     function delete_product_rate($id='') {
       
        if ($id == '') {
            redirect('settings');
        }
        $this->settings_model->delete_product_rate($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('settings/product_rate');
    }
    
     function rm_rate() {
        $gridObj = new grid();
        $gridColumn = array("Raw material name","Rate(Per K.G.)");
        $gridColumnModel = array(
            array("name" => "row_material_name",
                "index" => "row_material_name",
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
        
        $gridObj->setGridOptions("Raw Materials Item & Rate", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('settings/load_raw_materials_rate'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'index _rm';
        $data['page_title'] = 'Raw Materials Item & Rate';
        $this->load->view('main', $data);
    }

    function load_raw_materials_rate() {
        $this->settings_model->get_rm_rate_grid();
    }
    
    function add_rm_rate() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_rm_rate')) {
                 if ($this->settings_model->add_rm_rate()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('settings/rm_rate');
                }
                
                
            }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings';
        $data['page'] = 'add_rm_rate';
        $this->load->view('main', $data);
    }
    
    function edit_rm_rate($id='') {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_rm_rate')) {
                 if ($this->settings_model->update_rm_rate($id)) {
                    $this->session->set_flashdata('msg', 'Content Updated Successfully!!!');
                    redirect('settings/rm_rate');
                }    
            }
        }
        $data=sql::row('stock_raw_material','id='.$id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'settings'; 
        $data['page'] = 'edit_rm_rate ';
        $this->load->view('main', $data);
    }
    
    function delete_rm_rate($id='') {
       
        if ($id == '') {
            redirect('settings/rm_rate');
        }
        $this->settings_model->delete_rm_rate($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('settings/rm_rate');
    }
	
}

?>
