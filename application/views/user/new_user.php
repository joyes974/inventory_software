<div class="form_content portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="width:900px;margin:0 auto">
   <div class="portlet-header fixed ui-widget-header ui-corner-top"><?=$page_title?></div>
   <div class="portlet-content">
    
    <form id="valid_form" action='<?=site_url('user/new_user')?>' method='post'>
        <table>
            <tr>
                <th>First Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='first_name'  autocomplete="off" value='<?=set_value('first_name')?>' class='text ui-widget-content ui-corner-all width_200 required'  /><?=form_error('first_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Last Name <span class='req_mark'>*</span></th>
                <td><input type='text' name='last_name' autocomplete="off" value='<?=set_value('last_name')?>' class='text ui-widget-content ui-corner-all width_200 required' /><?=form_error('last_name','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>User ID <span class='req_mark'>*</span></th>
                <td><input type='text' name='user_name' autocomplete="off" value='<?=set_value('user_name')?>' class='text ui-widget-content ui-corner-all width_200 required' /> <?=form_error('user_name','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='pass' value='<?=set_value('pass')?>' class='text ui-widget-content ui-corner-all width_200 required' /> <?=form_error('pass','<span>','</span>')?></td>
            </tr>
             <tr>
                <th>Confirm Password <span class='req_mark'>*</span></th>
                <td><input type='password' name='conf_pass' autocomplete="off"  value='<?=set_value('conf_pass')?>' class='text ui-widget-content ui-corner-all width_200 required' /> <?=form_error('conf_pass','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Email <span class='req_mark'>*</span></th>
                <td><input type='text' name='email' autocomplete="off"  value='<?=set_value('email')?>' class='text ui-widget-content ui-corner-all width_200 required' /><?=form_error('email','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Designation <span class='req_mark'>*</span></th>
                <td><input type='text' name='designation' autocomplete="off"  value='<?=set_value('designation')?>' class='text ui-widget-content ui-corner-all width_200 required' /><?=form_error('designation','<span>','</span>')?></td>
            </tr>
            <tr>
                <th>Settings Permission</th>
                <td>
                    <span class='block b'>Site Settings</span>
                    <label class='block'><input type='checkbox' name='settings[]' value='1' checked /> Only View</label>
                    <label class='block'><input type='checkbox' name='settings[]' value='2' /> Add</label>
                    <label class='block'><input type='checkbox' name='settings[]' value='4' /> Update/Delete</label>
                </td>
            </tr>
            <tr>
                <th>Product Menu</th>
                <td>
                    <span class='block b'>Product Permission</span>
                    <label class='block'><input type='checkbox' name='product[]' value='1' checked /> Only View</label>
                    <label class='block'><input type='checkbox' name='product[]' value='2' /> Add</label>
                    <label class='block'><input type='checkbox' name='product[]' value='4' /> Update/Delete</label>
                </td>
            </tr>          
            <tr>
                <th>Product Sale Menu</th>
                <td>
                    <span class='block b'>Sale Permission</span>
                    <label class='block'><input type='checkbox' name='sale[]' value='1' checked /> Only View</label>
                    <label class='block'><input type='checkbox' name='sale[]' value='2' /> Add</label>
                    <label class='block'><input type='checkbox' name='sale[]' value='4' /> Update/Delete</label>
                </td>
            </tr>
            <tr>
                <th>Product Purchase Menu</th>
                <td>
                    <span class='block b'>Purchase Permission</span>
                    <label class='block'><input type='checkbox' name='purchase[]' value='1' checked /> Only View</label>
                    <label class='block'><input type='checkbox' name='purchase[]' value='2' /> Add</label>
                    <label class='block'><input type='checkbox' name='purchase[]' value='4' /> Update/Delete</label>
                </td>
            </tr>
            <tr>
                <th>Account Menu</th>
                <td>
                    <span class='block b'>Account Permission</span>
                    <label class='block'><input type='checkbox' name='account[]' value='1' checked /> Only View</label>
                    <label class='block'><input type='checkbox' name='account[]' value='2' /> Add</label>
                    <label class='block'><input type='checkbox' name='account[]' value='4' /> Update/Delete</label>
                </td>
            </tr>
            <tr><th>&nbsp;</th><td><input type='submit' name='save' value='Save' class='button' /> <input type='button' name='cancel' value='Cancel' class='cancel' /></td>
            </tr>
        </table>
    </form>
</div>
</div>