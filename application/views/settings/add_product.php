
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('fpproduct/add_product');?>' enctype="multipart/form-data">
 Add Rate:
        <table>
             <tr>
                <th>Category:<span class='req_mark'></span>:</th>

                <td><?php   $this->fp_model->get_category();?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>
                <th>Product Name: <span class='req_mark'></span>:</th>
             
 			    <td><input type='text' id="product_name" class="input_txt width_150 discount number" name='product_name' value="<?= $_POST['product_name'] ?>" /><?=form_error('product_name','<span>','</span>')?></td>
            </tr>
			
			
			</table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>