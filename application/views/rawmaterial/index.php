<div class="form_content">
   
    <form name="search_purchase" action="<?=site_url('rawmaterials/release_report')?>" method="POST">
    <table>
        <tr>
            <th>Search Field</th><td>
                 
               
                <select name="searchField">
                              <?php  echo $this->raw_model->get_rm_items($_POST['searchField'])?>
            </td>
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

        <button id="add" title="rawmaterials/add_rm_release"  class="jadd_button">Add</button>

        <button title="rawmaterials/edit_rm_release" class="jedit_button">Edit</button>
        <button title="rawmaterials/delete_rm_release" class="jdelete_button">Delete</button>


    </div>
    <div class="tooolbars">
        <?php if ($button == 1) { ?>
            <button id="add" title="rawmaterials/show_rm_stock_report"  class="jadd_button">Show Report</button>
        <?php } else { ?>

            <button id="add" title="rawmaterials/show_rm_release_report"  class="jadd_button">Show Report</button>

        <?php } ?>
    </div>
    <hr />
    <?php echo $grid_data ?>
</div>