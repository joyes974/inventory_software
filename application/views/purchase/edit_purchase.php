<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content"> 
    <form id="edit_purchase" method='post' action='<?=site_url('purchase/edit_purchase/'.$id);?>' enctype="multipart/form-data">
  Edit Purchase:
        <table>
            <tr>
                <th> Provider Name<span class='req_mark'></span>:</th>      
                <td><input type='text' class="input_txt width_150 total_quantity number" name='provider_name' value="<?=$provider_name?>"/><?=form_error('provider_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th> Contact Number<span class='req_mark'></span>:</th>
              
                <td><input type='text' id="contact_number" class="input_txt width_150 total_amount number"  name='contact_number' value="<?=$contact_number?>" /></td>
            </tr>
             <tr>
                <th> ITEM<span class='req_mark'></span>:</th>

                <td><?php  echo $this->purchase_model->get_items($item_id)?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
            <tr>
                <th> Zone <span class='req_mark'></span>:</th>

                <td> <select name="zone"><option value="">Select</option><option value="Sylhet" <?php if($zone=="Sylhet") echo 'selected'?>> SYLHET</option>
                    <option value="Dhaka"<?php if($zone=="Dhaka") echo 'selected'?>>Dhaka</option>
                    <option value="khulna" <?php if($zone=="khulna") echo 'selected'?>>Khulna</option>
                    <option value="Barisal" <?php if($zone=="Barisal") echo 'selected'?>>Barisal</option></select>
                </td>
            </tr>
            <tr>

                <th> Challan No: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="challan_no" class="input_txt width_150 discount number" name='challan_no' value="<?= $challan_no ?>" /><?=form_error('challan_no','<span>','</span>')?></td>
            </tr>
            <tr>
                <th> Truck no.: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="truck_no" class="input_txt width_150 discount number" name='truck_no' value="<?= $truck_no ?>" /></td>
            </tr>
             <tr>
                <th> Number of Bags: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="num_bags" class="input_txt width_150 discount number" name='num_bags' value="<?= $num_bags ?>" /><?=form_error('num_bags','<span>','</span>')?></td>
            </tr>
              <tr>
                <th> Sending Weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="sending_weight" class="input_txt width_150 discount number" name='sending_weight' value="<?= $sending_weight ?>" /><?=form_error('sending_weight','<span>','</span>')?></td>
            </tr>
                          <tr>
                <th> Gross Weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="gross_weight" class="input_txt width_150 discount number" name='gross_weight' value="<?= $gross_weight ?>" /><?=form_error('gross_weight','<span>','</span>')?></td>
            </tr>
                                <tr>
                <th> Only Truck weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="only_truck_weight" class="input_txt width_150 discount number" name='only_truck_weight' value="<?= $only_truck_weight ?>" /><?=form_error('only_truck_weight','<span>','</span>')?></td>
            </tr>
             <tr>
                <th> Raw Material Weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="rm_weight" class="input_txt width_150 discount number" name='rm_weight' value="<?= $rm_weight ?>" /><?=form_error('rm_weight','<span>','</span>')?></td>
            </tr>
                  <tr>
                <th> Bag  Weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="bag_weight" class="input_txt width_150 discount number" name='bag_weight' value="<?= $bag_weight?>" /><?=form_error('bag_weight','<span>','</span>')?></td>
            </tr>
             <tr>
                <th> Net Weight: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="net_weight" class="input_txt width_150 discount number" name='net_weight' value="<?= $net_weight ?>" /><?=form_error('net_weight','<span>','</span>')?></td>
            </tr>
            
             <tr>
                <th> Truck fee: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="truck_fee" class="input_txt width_150 discount number" name='truck_fee' value="<?= $truck_fee ?>" /><?=form_error('truck_fee','<span>','</span>')?></td>
            </tr>
             <tr>
                <th> Total Payment: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="total_payment" class="input_txt width_150 discount number" name='total_payment' value="<?= $total_payment ?>" /><?=form_error('total_payment','<span>','</span>')?></td>
            </tr>
             <tr>
                <th> Total Paid: <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="total_paid" class="input_txt width_150 discount number" name='total_paid' value="<?= $total_paid ?>" /><?=form_error('total_paid','<span>','</span>')?></td>
            </tr>
        <hr />
        </table>
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button"/> 
            <input type='button' value='Cancel' class="cancel"/>
        </div>
    </form>
</div>
</div>