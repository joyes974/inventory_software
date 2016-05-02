
<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin-top:50px;">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
   
    <form id="rm_release" method='post' action='<?=site_url('settings/edit_rm_rate/'.$id);?>' enctype="multipart/form-data">
  Edit Raw Materials Item & Rate:</br>
        <table>
             <tr>
                <th>Item Name<span class='req_mark'></span>:</th>

               <td><input type='text' id="row_material_name" class="input_txt width_150 discount number" name='row_material_name' value="<?= $row_material_name ?>" /><?=form_error('row_material_name','<span>','</span>')?></td>
            
            </tr>
           
            <tr>

                <th>Current Rate <span class='req_mark'></span>:</th>
             
                <td><input type='text' id="rate" class="input_txt width_150 discount number" name='rate' value="<?= $rate ?>" /><?=form_error('rate','<span>','</span>')?></td>
            </tr>
           
                         
           
           
        </table>
        <hr />
        <div class="txt_center">
            <input type='submit' name='save' value='Save' class="button" /> <input type='button' value='Cancel' class="cancel" />
        </div>
    </form>
</div>
</div>