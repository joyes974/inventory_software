
<div class='grid_area'>

    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">

        <button id="add" title="settings/add_category"  class="jadd_button">Add</button>

        <!--<button title="rawmaterials/edit_rm_release" class="jedit_button">Edit</button>-->
        <button title="settings/delete_category" class="jdelete_button">Delete</button>


    </div>
   
    <hr />
    <?php echo $grid_data ?>
</div>