
<div class='grid_area'>

    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">

        <button id="add" title="payment/show_deposit_report"  class="jadd_button">Show Report</button>

        <!--<button title="rawmaterials/edit_rm_release" class="jedit_button">Edit</button>
        <button title="payment/delete_expense" class="jdelete_button">Delete</button>-->


    </div>
   
    <hr />
    <?php echo $grid_data ?>
</div>