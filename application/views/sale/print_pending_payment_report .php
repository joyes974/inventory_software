<div class="doc_wrapper">

<div class="table_content">
    
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td colspan="13">
                <?php if($track==1) {?>
               <font color="green"> <b>Zone:&nbsp; </b><?php echo $rows[0]['zone']; } else if(($track==2)) {?>
                <b>Provider Name:&nbsp; </b><?php echo $rows[0]['provider_name']; }?></font>
            </td>
        </tr>
        <tr>
            <th align="left">Order number:&nbsp;</th>
            <th align="left">Client name:&nbsp;</th>
               <th align="left">Zone&nbsp;</th>
               <th align="left">Total Amount&nbsp;</th>
               <th align="left">Pending Amount&nbsp;</th>
             <th align="left">Selling Date:&nbsp;</th>
            <th align="left">Agreed Date:&nbsp;</th>
            
           
        </tr>
        <?php if(count($rows)>0):
            
            foreach($rows as $row):
                 ?>
              
        <tr>
            <td><?php echo $row['order_no']?>&nbsp;</td>
            <td><?php echo $row['name']?>&nbsp;</td>
            <td><?php echo $row['zone']?>&nbsp;</td>
            <td><?php echo $row['payble_amount']?>&nbsp;</td>
            <td><?php echo $row['pending_amount']?>&nbsp;</td>            
            <td><?php echo $row['date']?>&nbsp;</td> 
            <td><?php echo $row['next_payment_date']?>&nbsp;</td> 
              
        </tr>
            <?php
            endforeach;
            else: echo '<tr><td colspan="8">No Content Found!</td></tr>';

        endif;
        ?>
         
    </table>

</div>
</div>