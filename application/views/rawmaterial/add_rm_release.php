<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('rawmaterials/add_rm_release');?>' enctype="multipart/form-data">
  Raw Materials Release
        <table>
                   
            <tr>
                <th>Released Date<span class='req_mark'>*</span>:</th>
                
                <td><input type='text' id="date" class="input_txt width_150 total_quantity number date_picker" name='date' value="<?=$_POST['date']?>"/><?=form_error('date','<span>','</span>')?></td>
            </tr>
            
             <tr>
                <th>Released Item<span class='req_mark'>*</span>:</th>

                <td><?php  echo $this->raw_model->get_items($_POST['item_id'])?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>

                <th>Batch <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="batch" class="input_txt width_150 discount number" name='batch' value="<?= $_POST['batch'] ?>" /><?=form_error('batch','<span>','</span>')?></td>
            </tr>
            
            <tr>
            
            <tr>

                <th>Released Amount(K.G.) <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="amount" class="input_txt width_150 discount number" name='amount' value="<?= $_POST['amount'] ?>" /><?=form_error('amount','<span>','</span>')?></td>
            </tr>
            
            <tr>

                <th>Released By <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="operator" class="input_txt width_150 discount number" name='operator' readonly value="<?= $this->session->userdata('user_name'); ?>" /><?=form_error('operator','<span>','</span>')?></td>
            </tr>
           
                         
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>