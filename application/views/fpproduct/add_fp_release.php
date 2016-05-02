
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('fpproduct/add_fp_release');?>' enctype="multipart/form-data">
  Finished Product Insert
        <table>
            <tr>
                <th>Insert Date<span class='req_mark'>*</span>:</th>
                
                <td><input type='text' id="released_date" class="input_txt width_150 total_quantity number date_picker" name='released_date' value="<?=$_POST['released_date']?>"/><?=form_error('released_date','<span>','</span>')?></td>
            </tr>
            
            <tr>

                <th>Insert By <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="operator" class="input_txt width_150 discount number" name='operator' readonly value="<?= $this->session->userdata('user_name'); ?>" /><?=form_error('operator','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>ITEM<span class='req_mark'></span>:</th>

                <td><?php  echo $this->fp_model->get_items($_POST['item_id'])?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>

                <th>Insert Amount(K.G.) <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="released_amount" class="input_txt width_150 discount number" name='released_amount' value="<?= $_POST['released_amount'] ?>" /><?=form_error('released_amount','<span>','</span>')?></td>
            </tr>
           
                         
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <a href="javascript:void()" onclick="location.href('http://localhost/inventorysoftware/fpproduct/release_report');"><input type='button' value='Cancel' class="cancel" /></a>
        </div>
    </form>
</div>
</div>