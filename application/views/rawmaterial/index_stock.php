
<div class='grid_area'>

    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    
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