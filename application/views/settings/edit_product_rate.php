
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('settings/edit_product_rate/'.$id);?>' enctype="multipart/form-data">
 Edit Rate:
        <table>
             <tr>
                <th><font color="green">Category:</font><span class='req_mark'></span></th>

                <td><?php   $this->fp_model->get_items($id); ?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>
                <th>Product Rate <span class='req_mark'></span>:</th>
             
 			    <td><input type='text' id="product_rate" class="input_txt width_150 discount number" name='product_rate' value="<?=$rate?>" /><?=form_error('product_rate','<span>','</span>')?></td>
            </tr>
			
			
			</table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>