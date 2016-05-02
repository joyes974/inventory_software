<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Finished Product
 *
 * @author Joyes
 */
class fpproduct extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('fp_model');
        $this->load->library('grid');
    }

    function index() {
        $gridObj = new grid();
        $gridColumn = array("Category","Item name","Amount stock (KG)", "Rate(Per K.G.)","Total Value");
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
        
        $gridObj->setGridOptions("Finished Products Stock", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('fpproduct/load_fp_stock'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'index_2';
        $data['page_title'] = 'Finished Products Stock';
        $data['button']=1;
        $this->load->view('main', $data);
    }

    function load_fp_stock() {
        $this->fp_model->get_fp_grid();
    }
	
	function release_report() {
        $gridObj = new grid();
        $gridColumn = array("Category","Item Name", "Amount Stock(K.G.)","Release Date");
        $gridColumnModel = array(
            
             array("name" => "name1",
                "index" => "name1",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),

		array("name" => "name",
                "index" => "name",
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
            )
        );
       
        
        $gridObj->setGridOptions("Finished Products Stock Report", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('fpproduct/load_fp_release'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'index';
        $data['page_title'] = 'Finished Products Stock Report';
        $this->load->view('main', $data);
    }
	function load_fp_release() {
        $this->fp_model->get_fp_release_grid();
		
    }
	
    function add_product() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_product')) {
            if ($this->fp_model->add_product()) {
                $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                redirect('fpproduct');
            }
          }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'add_product';
        $this->load->view('main', $data);
    }

	function delete_product($id='') {
       
        if ($id == '') {
            redirect('fpproduct');
        }
        $this->fp_model->delete_product($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('fpproduct');
    }
	
	function add_fp_release() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_fp_release')) {
                 if ($this->fp_model->add_fp_release()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('fpproduct/release_report');
                }
                
                
            }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'add_fp_release';
        $this->load->view('main', $data);
    }
	
	function edit_fp_release($id='') {
        if ($_POST['save']) {
            if ($this->form_validation->run('edit_fp_release')) {
                 if ($this->fp_model->update_fp_release($id)) {
                    $this->session->set_flashdata('msg', 'Content Updated Successfully!!!');
                    redirect('fpproduct/release_report');
                }    
            }
        }
        $data=sql::row('realeased_finished_product_info','id='.$id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'fpproduct'; 
        $data['page'] = 'edit_fp_release';
        $this->load->view('main', $data);
    }
	
      function delete_fp_release($id='') {
       
        if ($id == '') {
            redirect('fpproduct/release_report');
        }
        $this->fp_model->delete_fp_release($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('fpproduct/release_report');
    }
    
    function show_fp_stock_report() {
        /*$serachoption = $this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }*/
        $data['rows'] = sql::rows('finished_product');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'print_fp_stock_report';
        $data['page_title'] = 'FP Stock Report';
        
        $this->load->view('print_main', $data);
    }
    
     function show_fp_release_report() {
        /*$serachoption = $this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }*/
        $data['rows'] = sql::rows('realeased_finished_product_info');
        $data['dir'] = 'fpproduct';
        $data['page'] = 'print_fp_release_report';
        $data['page_title'] = 'FP Insert Report';
        
        $this->load->view('print_main', $data);
    }


}

?>
