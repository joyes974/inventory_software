
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('fpproduct/edit_fp_release/'.$id);?>' enctype="multipart/form-data">
  Raw Materials Release
        <table>
            <tr>
                <th>Insert Date<span class='req_mark'>*</span>:</th>
                
                <td><input type='text' id="released_date" class="input_txt width_150 total_quantity number date_picker" name='released_date' value="<?=$released_date?>"/><?=form_error('released_date','<span>','</span>')?></td>
            </tr>
            
            <tr>

                <th>Insert By <span class='req_mark'>*</span>:</th>
             
                <td><input type='text' id="operator" class="input_txt width_150 discount number" name='operator' value="<?= $operator ?>" /><?=form_error('operator','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>ITEM<span class='req_mark'></span>:</th>

                <td><?php  echo $this->fp_model->get_items($item_id)?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>

                <th>Release Amount(K.G.) <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="released_amount" class="input_txt width_150 discount number" name='released_amount' value="<?= $released_amount?>" /><?=form_error('released_amount','<span>','</span>')?></td>
            </tr>
           
                         
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>