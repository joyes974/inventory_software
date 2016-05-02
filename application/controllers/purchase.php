<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase
 *
 * @author Tamal
 */
class purchase extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('purchase_model');
        $this->load->library('grid');
    }

    function index() {

        $gridObj = new grid();
        $gridColumn = array("Invoice number", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
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

    function load_purchase() {
        $this->purchase_model->get_purchase_grid();
    }

    function add_purchase() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_purchase')) {
                if ($this->purchase_model->add_purchase()) {
                    $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('purchase');
                }
           }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'add_purchase';
        $this->load->view('main', $data);
    }

    function edit_purchase($id = '') {
        if ($_POST['save']) {
            if ($this->form_validation->run('edit_purchase')) {
                if ($this->purchase_model->update_purchase($id)) {
                    $this->session->set_flashdata('msg', 'Content Updated Successfully!!!');
                    redirect('purchase');
                }
            }
        }
        $data = sql::row('purchase', 'id=' . $id);
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'edit_purchase';
        $this->load->view('main', $data);
    }

    function delete_purchase($id = '') {

        if ($id == '') {
            redirect('purchase');
        }
        $this->purchase_model->delete_purchase($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('purchase');
    }

    function purchase_report() {
         $gridObj = new grid();
        $gridColumn = array("Invoice number", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
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
    function show_report() {
        $serachoption = $this->session->userdata('purchase_search');

         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('purchase', $serachoption);
         $this->session->unset_userdata('purchase_search');
        $data['dir'] = 'purchase';
        $data['page'] = 'print_purchase_report';
        $data['page_title'] = 'Purchase Report';
        $this->load->view('print_main', $data);
    }

 function pending_payment() {
        $gridObj = new grid();
        $gridColumn = array("Invoice number", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
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
      
        if ($_POST['apply_filter']) {
            $condition = '';
            if ($_POST['searchField'] == 1) {
                $this->session->set_userdata('zone', '1');
                $condition.=" zone LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($_POST['searchField'] == 2) {
                $this->session->set_userdata('provider_name', '1');
                $condition.="  provider_name LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($condition != '') {
                $this->session->set_userdata('purchase_search', $condition);
            }
        }
        $gridObj->setGridOptions("Manage Purchases", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('purchase/load_pending_payment'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'pending_payment';
        $data['page_title'] = 'Manage purchases';
        $this->load->view('main', $data);
    }
 function load_pending_payment() {
        $this->purchase_model->get_pending_grid();
    }
    function pending_payment_report() {
        $serachoption = "unpaid!=0 ".$this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('purchase', $serachoption);
        $data['dir'] = 'purchase';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }
    
    function upcoming_payment() {
        $gridObj = new grid();
        $gridColumn = array("Invoice number", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
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
      
        if ($_POST['apply_filter']) {
            $condition = '';
            if ($_POST['searchField'] == 1) {
                $this->session->set_userdata('zone', '1');
                $condition.=" zone LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($_POST['searchField'] == 2) {
                $this->session->set_userdata('provider_name', '1');
                $condition.="  provider_name LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($condition != '') {
                $this->session->set_userdata('purchase_search', $condition);
            }
        }
        $gridObj->setGridOptions("Upcoming Payment", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('purchase/load_upcoming_payment'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'upcoming_payment';
        $data['page_title'] = 'Manage purchases';
        $this->load->view('main', $data);
    }
 function load_upcoming_payment() {
        $this->purchase_model->get_upcoming_grid();
    }
    function upcoming_payment_report() {
         $dd=date("y-m-d");
        $dd="'".$dd."'";
        $serachoption = "unpaid!=0 and upcoming_payment_date>=$dd ".$this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('purchase', $serachoption);
        $data['dir'] = 'purchase';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }
    
    function overdue_payment() {
        $gridObj = new grid();
        $gridColumn = array("Invoice number", "Provider name", "Contact number", "Challan no");
        $gridColumnModel = array(
            array("name" => "id",
                "index" => "id",
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
      
        if ($_POST['apply_filter']) {
            $condition = '';
            if ($_POST['searchField'] == 1) {
                $this->session->set_userdata('zone', '1');
                $condition.=" zone LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($_POST['searchField'] == 2) {
                $this->session->set_userdata('provider_name', '1');
                $condition.="  provider_name LIKE '%" . $_POST['searchValue'] . "%' ";
            }
            if ($condition != '') {
                $this->session->set_userdata('purchase_search', $condition);
            }
        }
        $gridObj->setGridOptions("Overdue Payment", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('purchase/load_overdue_payment'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'purchase';
        $data['page'] = 'overdue_payment';
        $data['page_title'] = 'Overdue';
        $this->load->view('main', $data);
    }
 function load_overdue_payment() {
        $this->purchase_model->get_overdue_grid();
    }
    function overdue_payment_report() {
       $dd=date("y-m-d");
        $dd="'".$dd."'";
        $serachoption = "unpaid!=0 and upcoming_payment_date<$dd ".$this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('purchase', $serachoption);
        $data['dir'] = 'purchase';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }


}

?>
