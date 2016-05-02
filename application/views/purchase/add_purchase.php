<script type="text/javascript">
            function Add() {
                var Text1 = document.getElementById("TextBox1").value;
                var Text2 = document.getElementById("TextBox2").value;

                var intV1;
                var intV2;

                if (Text1 == "") {
                    intV1 = 0
                } else {
                    intV1 = parseInt(Text1);
                }

                if (Text2 == "") {
                    intV2 = 0
                } else {
                    intV2 = parseInt(Text2);
                }

                var Text3 = document.getElementById("rm_weight");
                Text3.value = intV1 - intV2;
                return false;
            }
        
            function Sub() {
                var Text1 = document.getElementById("rm_weight").value;
                var Text2 = document.getElementById("bag_weight").value;

                var intV1;
                var intV2;

                if (Text1 == "") {
                    intV1 = 0
                } else {
                    intV1 = parseInt(Text1);
                }

                if (Text2 == "") {
                    intV2 = 0
                } else {
                    intV2 = parseInt(Text2);
                }

                var Text3 = document.getElementById("net_weight");
                Text3.value = intV1 - intV2;
                return false;
            }
        </script>



<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content fl_left" style="width:58%;">
      	<style type="text/css">
		body {
	
		
		#myselect {
			border: 2px solid red;
			padding: 4px;
			font-weight: bold;
			text-transform: uppercase;
			background-color: #CCC;
		}
	</style>
       
    <form id="add_purchase" method='post' action='<?=site_url('purchase/add_purchase');?>' enctype="multipart/form-data">
 <strong> New Purchase:</strong>
        <table>
            <tr>
                
<?php  //echo $this->purchase_model->get_order()?>
                
               
            </tr>
            
            <tr>
                <th> Date<span class='req_mark'></span>:</th>
                
                <td><input type='text' class="input_txt width_150 total_quantity number date_picker" name='date' value="<?=$_POST['date']?>"/></td>
            </tr>
                       
            <tr>
                <th> SL<span class='req_mark'></span>:</th>
                
                <td><input type='text' class="input_txt width_150 total_quantity number" name='sl_no' readonly value="<?php  echo $this->purchase_model->get_order()?>"/><?//=form_error('provider_name','<span>','</span>')?></td>
            </tr>
            
            <tr>
                <th> Order Number<span class='req_mark'></span>:</th>
                
                <td><input type='text' class="input_txt width_150 total_quantity number" name='order_no' readonly value="<?php  echo $this->purchase_model->get_order()?>"/><?//=form_error('provider_name','<span>','</span>')?></td>
            </tr>
            
             
             
            <tr>
                <th> Provider Name<span class='req_mark'></span>:</th>
                
               <td><!--<input type='text' class="input_txt width_150 total_quantity number" name='provider_name' id ="provider_name" value="<?=$_POST['provider_name']?>"/><?=form_error('provider_name','<span>','</span>')?>!-->
			
		<select id="myselect" name="provider_name">
		<?php  echo $this->purchase_model->get_party($_POST['provider_name'])?>
			
			</select>
			   
			
			
			   <p>			
			Append new option: <input type="text" id="str" value="" /> <input type="button" onclick="appendSelectOption($j('#str').val());" value="append" />
		</p>	
			   </td>
            </tr>
            <tr>
                <th> Contact Number<span class='req_mark'></span>:</th>
              
                <td><input type='text' id="contact_number" class="input_txt width_150 total_amount number"  name='contact_number' value="<?=$_POST['contact_number']?>" /></td>
            </tr>
             <tr>
                <th>ITEM<span class='req_mark'></span>:</th>

                <td><?php  echo $this->purchase_model->get_items($_POST['item_id'])?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Zone <span class='req_mark'></span>:</th>

                <td> <select name="zone"><option value="">Select</option><option value="Sylhet" <?php if($_POST['zone']=="Sylhet") echo 'selected'?>> SYLHET</option>
                    <option value="Dhaka"<?php if($_POST['zone']=="Dhaka") echo 'selected'?>>Dhaka</option>
                    <option value="khulna" <?php if($_POST['zone']=="khulna") echo 'selected'?>>Khulna</option>
                    <option value="Barisal" <?php if($_POST['zone']=="Barisal") echo 'selected'?>>Barisal</option>
                    <option value="Rajshahi" <?php if($_POST['zone']=="Rajshahi") echo 'selected'?>>Rajshahi</option>
                    <option value="Chittagong" <?php if($_POST['zone']=="Chittagong") echo 'selected'?>>Chittagong</option></select>
                </td>
            </tr>
            <tr>

                <th>Challan No <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="challan_no" class="input_txt width_150 discount number" name='challan_no' value="<?= $_POST['challan_no'] ?>" /><?=form_error('challan_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Truck no. <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="truck_no" class="input_txt width_150 discount number" name='truck_no' value="<?= $_POST['truck_no'] ?>" /></td>
            </tr>
             <tr>
                <th>Number of Bags <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="num_bags" class="input_txt width_150 discount number" name='num_bags' value="<?= $_POST['num_bags'] ?>" /><?=form_error('num_bags','<span>','</span>')?></td>
            </tr>
              <tr>
                <th>Sending Weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="sending_weight" class="input_txt width_150 discount number" name='sending_weight' value="<?= $_POST['sending_weight'] ?>" /><?=form_error('sending_weight','<span>','</span>')?></td>
            </tr>
                          <tr>
                <th>Gross Weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="TextBox1" class="input_txt width_150 discount number" name='gross_weight' value="<?= $_POST['gross_weight'] ?>" /><?=form_error('gross_weight','<span>','</span>')?></td>
            </tr>
                                <tr>
                <th>Only Truck weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="TextBox2" class="input_txt width_150 discount number" name='only_truck_weight' value="<?= $_POST['only_truck_weight'] ?>" /><?=form_error('only_truck_weight','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Raw Material Weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="rm_weight" OnClick="return Add()" class="input_txt width_150 discount number" name='rm_weight' value="<?= $_POST['rm_weight'] ?>" /><?=form_error('rm_weight','<span>','</span>')?></td>
            </tr>
                  <tr>
                <th>Bag  Weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="bag_weight" class="input_txt width_150 discount number" name='bag_weight' value="<?= $_POST['bag_weight'] ?>" /><?=form_error('bag_weight','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Net  Weight <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="net_weight" OnClick="return Sub()" class="input_txt width_150 discount number" name='net_weight' onclick="javascript:show();" value="<?= $_POST['net_weight'] ?>" /><?=form_error('net_weight','<span>','</span>')?></td>
            </tr>
            
             <tr>
                <th>Truck fee <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="truck_fee" class="input_txt width_150 discount number" name='truck_fee' value="<?= $_POST['truck_fee'] ?>" /><?=form_error('truck_fee','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Payable Amount <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="total_payment" class="input_txt width_150 discount number" name='total_payment' value="<?= $_POST['total_payment'] ?>" /><?=form_error('total_payment','<span>','</span>')?></td>
            </tr>
            
        </table>
       
        </div>
         <div class="portlet-content fl_right" style="width: 40%;border:1px ridge grey;height:250px;">
   
       <strong>Payments:</strong>
        <table>
       <input type="hidden" name="reason"/>
            <tr>
                <th> Invoice No:</th>
                <td><input type='text' class="input_txt width_150 " name='invoice_no'  readonly value="<?php  echo $this->purchase_model->get_invoice()?>"/><?//=form_error('invoice_no','<span>','</span>')?></td>
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
            <th>Pay By:</th>
            <td><select name="payby" ><option value="cash">Cash</option><option value="check">Check</option><select></td></tr>
               <tr>         
                       <th style="text-align:left;border:0px solid red;width:200px;">Next P. Date:</th> <td><input type='text' class="date_picker" name='next_payment_date' value="<?=$_POST['next_payment_date']?>"/></td></tr>
        </table>
       </div>
        </br>
        <div class="portlet-content fl_right" style="width: 40%;border:0px ridge grey;height:250px;margin-top: 50px;">
            <tr><th><strong>Comments:</strong></th></br>
            <td><textarea name="comments" style='width:97%;height:250px;'></textarea></td>
        </tr>
            
        </div>
        <div class="txt_center" style="clear:both;">
            </br></br>
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
  
  
    </form>

</div>