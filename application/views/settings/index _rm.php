
<div class='grid_area'>

    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">

       <button id="add" title="settings/add_rm_rate"  class="jadd_button">Add</button>

        <button title="settings/edit_rm_rate" class="jedit_button">Edit</button>
        <button title="settings/delete_rm_rate" class="jdelete_button">Delete</button>


    </div>
   
    <hr />
    <?php echo $grid_data ?>
</div>