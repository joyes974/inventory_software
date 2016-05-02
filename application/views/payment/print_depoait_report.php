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
            <th align="left">Invoice Number:&nbsp;</th>
            <th align="left">Order number:&nbsp;</th>
            <th align="left">Reason:&nbsp;</th>
               <th align="left">Operator:&nbsp;</th>
               <th align="left">Category:&nbsp;</th>
               <th align="left">Amount:&nbsp;</th>
             <th align="left">Date:&nbsp;</th>
           
            
           
        </tr>
        <?php if(count($rows)>0):
            
            foreach($rows as $row):
                 ?>
              
        <tr>
            <td><?php echo $row['invoice_num']?>&nbsp;</td>
            <td><?php echo $row['order_num']?>&nbsp;</td>
            <td><?php echo $row['reason']?>&nbsp;</td>
            <td><?php echo $row['operator']?>&nbsp;</td>
            <td><?php echo $row['category']?>&nbsp;</td> 
            <td><?php echo $row['amount']?>&nbsp;</td> 
            <td><?php echo $row['date']?>&nbsp;</td> 
            
              
        </tr>
            <?php
            endforeach;
            else: echo '<tr><td colspan="8">No Content Found!</td></tr>';

        endif;
        ?>
         
    </table>

</div>
</div>