<div class="form_content">
   
    <form name="search_purchase" action="<?=site_url('purchase')?>" method="POST">
    <table>
        <tr>
            <th>Search Field</th><td><select name="searchField">
                    
                    <option value="1" <?php if($_POST['searchField']==1) echo 'selected' ?>>Zone</option><option value="2" <?php if($_POST['searchField']==2) echo 'selected'?>>Provider name</option>
                </select>
            </td>
            <th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value=<?=$_POST['searchValue'] ?> ></td>
        </tr>
      
    <tr>
          <th style="text-align:left;border:0px solid red;width:200px;">Starting Date:</th> <td>
         <input type='text' class="date_picker" name='starting_date' value="<?=$_POST['starting_date']?>"/></td>
    <th style="text-align:left;border:0px solid red;width:200px;">Ending Date:</th> <td>
         <input type='text' class="date_picker" name='ending_date' value="<?=$_POST['ending_date']?>"/></td></tr>
        <tr>
              <tr><th colspan="4"><input type="submit" name="apply_filter" value="Apply Filter" class="button" /></th></tr>
    </table>
        
    </form>
</div>
 
<div class='grid_area'>
    
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        
        <button id="add" title="purchase/add_purchase"  class="jadd_button">Add</button>
        <button id="add" title="purchase/show_report"  class="jadd_button">Show Report</button>
     <!--
        <button title="purchase/edit_purchase" class="jedit_button">Edit</button>
        <button title="purchase/delete_purchase" class="jdelete_button">Delete</button>-->
      
      
    </div>
    <hr />
<?php echo $grid_data ?>
</div>