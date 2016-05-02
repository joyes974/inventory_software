
<div class='grid_area'>
    
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        
        <button id="add" title="fpproduct/add_fp_release"  class="jadd_button">Add</button>
     
        <button title="fpproduct/edit_fp_release" class="jedit_button">Edit</button>
        <button title="fpproduct/delete_fp_release" class="jdelete_button">Delete</button>
      
      
    </div>
    
    <div class="tooolbars">
        <?php if ($button!= 1) { ?>
            <button id="add" title="fpproduct/show_fp_release_report"  class="jadd_button">Show Report</button>
        <?php } else { ?>

            <button id="add" title="fpproduct/show_fp_stock_report"  class="jadd_button">Show Report</button>

        <?php } ?>
    </div>
    <hr />
<?php echo $grid_data ?>
</div>