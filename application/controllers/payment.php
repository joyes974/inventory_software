<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payment
 *
 * @author Joyes
 */
class Payment extends Controller {
    function __construct() {
        parent::Controller();
        $this->load->model('payment_model');
        $this->load->library('grid');
    }
    
    function index() {
        $gridObj = new grid();
        $gridColumn = array("Invoice","Order Number", "Reason","Operator", "Payment Method","Amount", "Date","Bank Name","Remarks");
        $gridColumnModel = array(
            array("name" => "invoice_no",
                "index" => "invoice_no",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
             array("name" => "order_num",
                "index" => "order_num",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "reason",
                "index" => "reason",
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
            ),
            array("name" => "payby",
                "index" => "payby",
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
            array("name" => "bank",
                "index" => "bank",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "comments",
                "index" => "comments",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )
        );
        
         $this->session->unset_userdata('receive_search');
       $this->session->unset_userdata('zone');
       $this->session->unset_userdata('provider_name');
       $this->session->unset_userdata('stating_date');
       $this->session->unset_userdata('ending_date');
       
        if ($_POST['apply_filter']) {
            $condition = '';
            $track=0;
            if ($_POST['searchField'] == "cash") {
                $condition.=" payby LIKE '%" . $_POST['searchField'] . "%' ";
                $track=1;
            }
            if ($_POST['searchField'] == "check") {
                $condition.="  payby LIKE '%" . $_POST['searchField'] . "%' ";
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
                $this->session->set_userdata('receive_search', $condition);
                
            }
            
        }
       
        
        $gridObj->setGridOptions("Payment", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('payment/received_payment_report'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'payment';
        $data['page'] = 'index';
        $data['page_title'] = 'Received Payment Report';
        $this->load->view('main', $data);
    }
	
    
    function show_received_report() {
        $serachoption =$this->session->userdata('receive_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('payment', $serachoption);
        $data['dir'] = 'payment';
        $data['page'] = 'received_report';
        $data['page_title'] = 'Received Payment Report';
        $this->load->view('print_main', $data);
    }
    function received_payment_report() {
        $this->payment_model->get_payment_grid();
    }
    
     function add_payment() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_payment')) {
            if ($this->payment_model->add_payment()) {
                $this->session->set_flashdata('msg', 'Payment Received Successfully!!!');
                redirect('payment');
            }
          }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'payment';
        $data['page'] = 'add_payment';
        $this->load->view('main', $data);
    }
    
    function delete_payment($id='') {
       
        if ($id == '') {
            redirect('payment');
        }
        $this->payment_model->delete_payment($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('payment');
    }
    
    function expenditure() {
        $gridObj = new grid();
        $gridColumn = array("Invoice","Order Number", "Reason","Operator", "Category","Amount", "Date");
        $gridColumnModel = array(
            array("name" => "invoice_num",
                "index" => "invoice_num",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
             array("name" => "order_num",
                "index" => "order_num",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "reason",
                "index" => "reason",
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
            ),
            array("name" => "category",
                "index" => "category",
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
            )/**,
            array("name" => "payby",
                "index" => "payby",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            )*/
            );
       $this->session->unset_userdata('expense_search');
       $this->session->unset_userdata('zone');
       $this->session->unset_userdata('provider_name');
       $this->session->unset_userdata('stating_date');
       $this->session->unset_userdata('ending_date');
        
       if ($_POST['apply_filter']) {
            $condition = '';
            $track=0;
            if ($_POST['searchField'] == "cash") {
                $condition.=" payby LIKE '%" . $_POST['searchField'] . "%' ";
                $track=1;
            }
            if ($_POST['searchField'] == "check") {
                $condition.="  payby LIKE '%" . $_POST['searchField'] . "%' ";
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
                $this->session->set_userdata('expense_search', $condition);
            }
            
        }
        
        $gridObj->setGridOptions("Payment", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('payment/expenditure_report'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'payment';
        $data['page'] = 'index_expense';
        $data['page_title'] = 'Expenditure Report';
        $this->load->view('main', $data);
    }
	
    function expenditure_report() {
        $this->payment_model->get_expenditure_grid();
    }
    
     function show_expenditure_report() {
        $serachoption =$this->session->userdata('expense_search');
       
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('expenditure', $serachoption);
        //print_r($data['rows']);
        $data['dir'] = 'payment';
        $data['page'] = 'print_depoait_report';
        $data['page_title'] = 'Expenditure Report';
        $this->load->view('print_main', $data);
    }
    
    function add_expense() {
        if ($_POST['save']) {
            if ($this->form_validation->run('add_expense')) {
            if ($this->payment_model->add_expense()) {
                $this->session->set_flashdata('msg', 'Expenditure Entry Successfull!!!');
                redirect('payment/expenditure');
            }
          }
        }
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'payment';
        $data['page'] = 'add_expense';
        $this->load->view('main', $data);
    }
    
    function delete_expense($id='') {
       
        if ($id == '') {
            redirect('payment/expenditure');
        }
        $this->payment_model->delete_payment($id); //Don't Change
        $this->session->set_flashdata('msg', 'Successfully Deleted!!!');
        redirect('payment/expenditure');
    }
    
    
    function bank_deposit() {
        $gridObj = new grid();
        $gridColumn = array("Invoice","Order Number", "Reason","Operator", "Category","Amount", "Date");
        $gridColumnModel = array(
            array("name" => "invoice_num",
                "index" => "invoice_num",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
             array("name" => "order_num",
                "index" => "order_num",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "reason",
                "index" => "reason",
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
            ),
            array("name" => "category",
                "index" => "category",
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
       
        
        $gridObj->setGridOptions("Bank Deposit", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('payment/bank_deposit_report'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'payment';
        $data['page'] = 'bank_deposit';
        $data['page_title'] = 'Expenditure Report';
        $this->load->view('main', $data);
    }
	
    function bank_deposit_report() {
        $this->payment_model->get_deposit_grid();
    }
    
     function show_deposit_report() {
        $serachoption ="category='deposit' ". $this->session->userdata('purchase_search');
         $data['track']=0;
        if ($this->session->userdata('zone') == 1) {
            $data['track'] = 1;
        } else   if ($this->session->userdata('provider_name') == 1){
            $data['track'] = 2;
        }
        $data['rows'] = sql::rows('expenditure', $serachoption);
        $data['dir'] = 'payment';
        $data['page'] = 'print_depoait_report';
        $data['page_title'] = 'Bank Deposit Report';
        $this->load->view('print_main', $data);
    }
    
}