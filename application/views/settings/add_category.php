
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('settings/add_category');?>' enctype="multipart/form-data">
 Add New Category:
        <table>
             <tr>
                <th>Parent Category:<span class='req_mark'></span>:</th>

                <td><?php   $this->settings_model->get_item();?>
                <?=form_error('item_id','<span>','</span>')?></td>
            </tr>
           
            <tr>
                <th>Category Name: <span class='req_mark'></span>:</th>
             
 			    <td><input type='text' id="category_name" class="input_txt width_150 discount number" name='category_name' value="<?= $_POST['category_name'] ?>" /><?=form_error('category_name','<span>','</span>')?></td>
            </tr>
			
			
			</table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>