
 
<div class='grid_area'>
    
    <?php
    if ($msg != "") {
        echo "<div class='success'>$msg</div>";
    }
    ?>
    <div class="tooolbars">
        
        <button id="add" title="purchase/overdue_payment_report"  class="jadd_button">Show Report</button>
     
        
      
      
    </div>
    <hr />
<?php echo $grid_data ?>
</div>