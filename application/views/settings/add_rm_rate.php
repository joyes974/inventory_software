
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('settings/add_rm_rate');?>' enctype="multipart/form-data">
  Add New Raw Materials Item & Rate:</br>
        <table>
             <tr>
                <th>Item Name<span class='req_mark'></span>:</th>

               <td><input type='text' id="row_material_name" class="input_txt width_150 discount number" name='row_material_name' value="<?= $_POST['row_material_name'] ?>" /><?=form_error('row_material_name','<span>','</span>')?></td>
            
            </tr>
           
            <tr>

                <th>Current Rate <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="rate" class="input_txt width_150 discount number" name='rate' value="<?= $_POST['rate'] ?>" /><?=form_error('rate','<span>','</span>')?></td>
            </tr>
           
                         
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>