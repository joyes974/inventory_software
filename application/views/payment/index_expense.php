<div class="form_content">
   
    <form name="search_purchase" action="<?=site_url('payment/expenditure')?>" method="POST">
    <table>
        <tr>
            <th>Search Field</th><td><select name="searchField">
                    
                    <option value="cash" <?php if($_POST['searchField']=="cash") echo 'selected' ?>>Cash</option><option value="check" <?php if($_POST['searchField']=="check") echo 'selected'?>>Check</option>
                </select>
            </td>
            <!--<th>Search Keyword</th><td><input type="text" name="searchValue" class="text ui-widget-content ui-corner-all width_160" value=<?=$_POST['searchValue'] ?> ></td>-->
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

        <button id="add" title="payment/add_expense"  class="jadd_button">Add</button>

        <!--<button title="rawmaterials/edit_rm_release" class="jedit_button">Edit</button>-->
        <button title="payment/delete_expense" class="jdelete_button">Delete</button>

        <button id="add" title="payment/show_expenditure_report"  class="jadd_button">Show Report</button>

    </div>
   
    <hr />
    <?php echo $grid_data ?>
</div>