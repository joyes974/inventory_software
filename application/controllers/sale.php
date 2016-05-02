<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sale
 *
 * @author Mohaimen
 */
class sale extends Controller {
    function __construct() {
        parent::Controller();
        $this->load->model('sale_model');
        $this->load->library('grid');
    }
    
    function index() {
        $gridObj = new grid();
        $gridColumn = array("Zone Name", "Name");
        $gridColumnModel = array(
            array("name" => "zone",
                "index" => "zone",
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
            )
        );
       
        
        $gridObj->setGridOptions("Set Category", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('sale/sale_report'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'sale';
        $data['page'] = 'index';
        $data['page_title'] = 'Sales Report';
        $this->load->view('main', $data);
    }
	function sale_report() {
        $this->sale_model->get_sales_grid();
    }
    
    function add_sale() {      
        if($_POST['save'])
                    {
             if ($this->form_validation->run('add_sale')) {
            if($this->sale_model->add_sale()){
            $this->session->set_flashdata('msg', 'Content Added Successfully!!!');
                    redirect('sale');
        }  
             }
        }
      $data['fish_products']=$this->sale_model->get_products(1);
     $data['poultry_products']=$this->sale_model->get_products(2);

        $data['dir'] = 'sale';
        $data['page'] = 'add_sale';
        $this->load->view('main', $data);
    }
    
function pending_payment() {
        $gridObj = new grid();
        $gridColumn = array("Order number", "Client name", "Zone", "Total Amount", "Pending Amount", "Selling Date", "Agreed Date");
        $gridColumnModel = array(
            array("name" => "order_no",
                "index" => "order_no",
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
            array("name" => "zone",
                "index" => "zone",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "payble_amount",
                "index" => "payble_amount",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "pending_amount",
                "index" => "pending_amount",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "date",
                "index" => "date",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "next_payment_date",
                "index" => "next_payment_date",
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
        $gridObj->setGridOptions("Sales Pending Report", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('sale/load_pending_payment'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'sale';
        $data['page'] = 'pending_payment';
        $data['page_title'] = 'Sales Pending Report';
        $this->load->view('main', $data);
    }
 function load_pending_payment() {
        $this->sale_model->get_pending_grid();
    }
    function pending_payment_report() {

        $sql = "select * from sale,seller where pending_amount!=0 and sale.id=seller.id ORDER BY sale.id desc";

        $rows = $this->db->query($sql);
        $rows = $rows->result_array();
        $data['rows']=$rows;
        $data['dir'] = 'sale';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }
    
    
    function upcoming_payment() {
        $gridObj = new grid();
        $gridColumn = array("Order number", "Client name", "Zone", "Total Amount", "Pending Amount", "Selling Date", "Agreed Date");
        $gridColumnModel = array(
            array("name" => "order_no",
                "index" => "order_no",
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
            array("name" => "zone",
                "index" => "zone",
                "width" => 100,
                "sortable" => true,
                "align" => "left",
                "editable" => true
            ),
            array("name" => "payble_amount",
                "index" => "payble_amount",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "pending_amount",
                "index" => "pending_amount",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "date",
                "index" => "date",
                "width" => 80,
                "sortable" => true,
                "align" => "center",
                "editable" => true
            ),
            array("name" => "next_payment_date",
                "index" => "next_payment_date",
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
        $gridObj->setGridOptions("Sales Upcoming Report", 880, 200, "id", "desc", $gridColumn, $gridColumnModel, site_url('sale/load_upcoming_payment'), true);
        $data['grid_data'] = $gridObj->getGrid();
        $data['msg'] = $this->session->flashdata('msg');
        $data['dir'] = 'sale';
        $data['page'] = 'upcoming_payment';
        $data['page_title'] = 'Sales Upcoming Report';
        $this->load->view('main', $data);
    }
    
    function load_upcoming_payment() {
        $this->sale_model->get_upcoming_grid();
    }
    function upcoming_payment_report() {

        $dd=date("y-m-d");
        $dd="'".$dd."'";
        $sql = "select * from sale,seller where pending_amount!=0 and next_payment_date>=$dd and sale.id=seller.id ORDER BY sale.id desc";

        $rows = $this->db->query($sql);
        $rows = $rows->result_array();
        $data['rows']=$rows;
        $data['dir'] = 'sale';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }
 /*function load_pending_payment() {
        $this->sale_model->get_pending_grid();
    }
    function pending_payment_report() {

        $sql = "select * from sale,seller where pending_amount!=0 and sale.id=seller.id ORDER BY sale.id desc";

        $rows = $this->db->query($sql);
        $rows = $rows->result_array();
        $data['rows']=$rows;
        $data['dir'] = 'sale';
        $data['page'] = 'print_pending_payment_report ';
        $data['page_title'] = 'Pending Payment Report';
        $this->load->view('print_main', $data);
    }*/

}

?>
