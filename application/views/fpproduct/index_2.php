
<div class='grid_area'>
    
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        
        <button id="add" title="fpproduct/add_product"  class="jadd_button">Add</button>
     
       
      
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