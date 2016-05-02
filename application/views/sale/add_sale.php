<SCRIPT LANGUAGE="JavaScript">
      $j(document).ready(function(){document.getElementById( "poultry" ).style.display = "none"; });
function Showhide20(){
document.getElementById( "fish" ).style.display = "block"; 
document.getElementById( "poultry" ).style.display = "none"; 
 }

function Showhide21(){
document.getElementById( "fish" ).style.display = "none"; 
document.getElementById( "poultry" ).style.display = "block"; 
 }



function change(id)
{
	if(id==1)
		Showhide20();
	else if(id==2)
		Showhide21();
}
</script>


<div class="portlet-content">Category:<select name="main_category" class="main_category1" onchange="change(this.value)">
 <option value="1" >Fish Feed</option>
<option value="2" >Poultri Feed</option></select>
<form id="add_sale" method='POST' action='<?=site_url('sale/add_sale');?>' enctype="multipart/form-data">
 Date: <input type='text' class="date_picker" name='date' value="<?=$_POST['date']?>"/>
 Sl No: <input type='text' class="" name='serial_id' readonly value="<?php  echo $this->sale_model->get_sl()?>"/>
 Order No: <input type='text' class="" name='order_no' readonly value="<?php  echo $this->sale_model->get_sl()?>"/>
 Do no.<input type='text' class="number" name='do_no' readonly value="<?php  echo $this->sale_model->get_sl()?>"/>
 <br/><font color="red"><?=form_error('date','<span>','</span>')?></font></div>
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">

   <div class="portlet-content fl_left">   
       
        <table>
            
            <tr>
                <th> Chalan No:</th>
                <td><input type='text' class="input_txt width_150" name='chalan' value="<?=$_POST['chalan']?>"/><?=form_error('challan_no','<span>','</span>')?></td>
            </tr>
        
            <tr>
                <th> Name</th>
                <td><input type='text' class="input_txt width_150" name='name' value="<?=$_POST['name']?>"/><?=form_error('name','<span>','</span>')?></td>
            </tr>
        
   
            <tr>
                <th>Address</th>           
                <td><textarea name="address" rows="1" cols="25"><?=$_POST['address']?></textarea></td>
            </tr>
             <tr>
                <th>Zone <span class='req_mark'></span>:</th>
                <td> <select name="zone"><option value="">Select</option><option value="Sylhet" <?php if($_POST['zone']=="Sylhet") echo 'selected'?>> SYLHET</option>
                    <option value="Dhaka"<?php if($_POST['zone']=="Dhaka") echo 'selected'?>>Dhaka</option>
                    <option value="khulna" <?php if($_POST['zone']=="khulna") echo 'selected'?>>Khulna</option>
                    <option value="Barisal" <?php if($_POST['zone']=="Barisal") echo 'selected'?>>Barisal</option></select><?=form_error('zone','<span>','</span>')?>
                </td>
            </tr>
           
        </table>
       </div>
   <div class="portlet-content fl_left" style="width: 40%;border:1px ridge grey;height:250px;">
   
       <strong>Payment:</strong>
        <table>
       <input type="hidden" name="reason" value="Sale"/>
            <tr>
                <th> Invoice No:</th>
                <td><input type='text' class="input_txt width_150 " name='invoice_no'  readonly value="<?php  echo $this->sale_model->get_invoice()?>"/><?=form_error('invoice_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th> Amount:</th>
                <td><input type='text' class="input_txt width_150 number" name='amount'/></td>
            </tr>
             <tr>
                <th>Unpaid:</th>
                <td><input type='text' class="input_txt width_150 number" name='pending_amount'/></td>
            </tr>
            
            <tr>
            <th>Payby:</th>
            <td><select name="payby" ><option value="cash">Cash</option><option value="check">Check</option><select></td></tr>
               <tr>         
                       <th style="text-align:left;border:0px solid red;width:200px;">Next P. Date:</th> <td><input type='text' class="date_picker" name='next_payment_date' value="<?=$_POST['next_payment_date']?>"/></td></tr>
        </table>
       </div>
    
    <div id="fish" tyle='position:relative;border:1px solid red;margin-top:10px;'>
    <?php  for($i=0;$i<count($fish_products);$i++) {?>
        <? $res=sql::row('finished_product_category','id='.$fish_products[$i]['category_id']); ?>
        <div class="portlet-content fl_left" style="width: 40%;border:1px solid grey;margin:10px;padding:10px;"><? echo $res['category_name']; ?><table> <tbody><tr>
                <th><?=$fish_products[$i]['product_name']?></th>
                <td><input class="input_txt width_100 number " name="quantity[]" type="text"></td>
                   <td><input class="input_txt width_100 number " name="product_id[]" value="<?= $fish_products[$i]['id']?>" type="hidden"></td>
           
</tr> </tbody></table></div><?php } ?>
   
    
    
</div>
     <div id="poultry">
    <?php  for($i=0;$i<count($poultry_products);$i++) {?>
         <? $res=sql::row('finished_product_category','id='.$poultry_products[$i]['category_id']); ?>
    <div class="portlet-content fl_left" style="width: 40%;border:1px solid grey;margin:10px;padding:10px;"><? echo $res['category_name']; ?><table> <tbody><tr>
                <th><?=$poultry_products[$i]['product_name']?></th>
                <td><input class="input_txt width_100 number" name="quantity[]" type="text"></td>
                   <td><input class="input_txt width_100 number" name="product_id[]" value="<?= $poultry_products[$i]['id']?>" type="hidden"></td>
           
</tr> </tbody></table></div><?php } ?>
         
         
    
    
</div>
    
   
    
  <div class="portlet-content fl_left" style='clear:both;'> </br></br>
   <table>          
<tr>
       <th>Item Cost:</th> 
<td><input type='text' class="" name='item_cost' /><?=form_error('item_cost','<span>','</span>')?></td>
</tr>
<tr>
<th>Transport Cost:</th>  
<td><input type='text' class="" name='transport_cost' /><?=form_error('transport_cost','<span>','</span>')?></td>
   </tr>
   <tr>
<th> TT Cost:</th>
<td><input type='text' class="number" name='tt_cost' /><?=form_error('tt_cost','<span>','</span>')?></td>
   </tr>
   <tr>
<th> Total Bag:</th>
<td><input type='text' class="number" name='total_bag' /><?=form_error('total_bag','<span>','</span>')?></td>
<tr>
<tr>
<th>Payble Amount:</th>
<td><input type='text' class="number" name='payble_amount' /> <?=form_error('payble_amount','<span>','</span>')?></td>
   </tr>
   </table></br></br>
  </div> 
     <div class="clear">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    
</div>




</form>