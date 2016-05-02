<SCRIPT LANGUAGE="JavaScript">
function Showhide20(){
document.getElementById( "check" ).style.display = "block"; 
//document.getElementById( "myId21" ).style.display = "none"; 
}
function Showhide21(){
document.getElementById( "check" ).style.display = "none"; 
//document.getElementById( "myId21" ).style.display = "none"; 
}
function change(id)
{
	if(id=="check")
		Showhide20();
	else if(id=="cash")
		Showhide21();
}

</script>

<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('payment/add_expense');?>' enctype="multipart/form-data">
  Expenditure Form
        <table>
            <tr>
                <th> Date<span class='req_mark'>*</span>:</th>
                
                <td><input type='text' id="date" class="input_txt width_150 total_quantity number date_picker" name='date' value="<?=$_POST['date']?>"/><?=form_error('date','<span>','</span>')?></td>
            </tr>
            
             <tr>

                <th>Expending For <span class='req_mark'>*</span>:</th>
             
                <td><select name="reason" ><option value="sell">Sell</option><option value="earn">Earn</option></select></td>
            
                     </tr>
            
             <tr>

                <th>Order No :</th>
             
                <td><input type='text' id="order_num" class="input_txt width_150 discount number" name='order_num' value="<?= $_POST['order_num'] ?>" /><?//=form_error('reason','<span>','</span>')?></td>
            </tr>
             <tr>

                <th>Invoice No :</th>
             
                <td><input type='text' id="invoice_no" class="input_txt width_150 discount number" name='invoice_no' readonly value="<?php  echo $this->payment_model->get_invoice()?>" /><?//=form_error('reason','<span>','</span>')?></td>
            </tr>
            <tr>

                <th>Insert By <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="operator" class="input_txt width_150 discount number" name='operator' readonly value="<?= $this->session->userdata('user_name'); ?>" /><?=form_error('operator','<span>','</span>')?></td>
            </tr>
            
               <tr>
            <th>Category<span class='req_mark'></span>:</th>
            <td><input type="text" class="input_txt width_150 discount number" name="category" value="<?= $_POST['category'] ?>" /></td></tr>
           
            <tr>

                <th>Amount <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="amount" class="input_txt width_150 discount number" name='amount' value="<?= $_POST['amount'] ?>" /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
           
                 <tr>
            <th>Pay By<span class='req_mark'>*</span>:</th>
            <td><select name="payby" onchange="change(this.value)"><option value="cash">Cash</option><option value="check">Check</option><select></td></tr>
                       
                    <tr>
                         
            <th ><span class='req_mark'></span></th>
            <td><div><select id="check" style="display:none;" name="bank" ><option value="dbl">DBL</option><option value="scb">SCB</option></select></div></td></tr>
                
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <a href="javascript:void()" onclick="location.href('http://localhost/inventorysoftware/fpproduct/release_report');"><input type='button' value='Cancel' class="cancel" /></a>
        </div>
    </form>
</div>
</div>