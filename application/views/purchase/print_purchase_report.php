

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
            
            <th align="left">Item Name:&nbsp;</th>
               <th align="left">Date&nbsp;</th>
               <th align="left">Name  of Party&nbsp;</th>
             <th align="left">Invoice Number:&nbsp;</th>
            <th align="left">Challan No:&nbsp;</th>
            <th align="left">Truck No:&nbsp;</th>
            <th align="left">Number of Bags:&nbsp;</th>
            <th align="right">Sending Weight:&nbsp;</th>
            <th  align="right">Gross Weight:&nbsp;</th>
          
            <th  align="left">Only Truck Weight:&nbsp;</th>
            <th  align="left">RM Weight:&nbsp;</th>
            <th align="right">Bags Weight:&nbsp;</th>
            <th align="right">Net Weight:&nbsp;</th>
            <th align="right">Truck Fee:&nbsp;</th>
        </tr>
        <?php if(count($rows)>0):
            
            foreach($rows as $row):
                $item_name=sql::row('stock_raw_material','id='.$row['item_id']); ?>
              
        <tr>
            <td><?php echo $item_name['row_material_name']?>&nbsp;</td>
            <td><?php echo $row['date']?>&nbsp;</td>
            <td><?php echo $row['provider_name']?>&nbsp;</td>
              <td><?php echo str_pad($row['id'],4,0,STR_PAD_LEFT)?>&nbsp;</td>
            <td><?php echo $row['challan_no']?>&nbsp;</td>
            <td><?php echo $row['truck_no']?>&nbsp;</td>
             <td><?php echo $row['num_bags']?>&nbsp;</td>
            <td  align="right"><?=number_format($row['sending_weight'],2,'.',',')?>&nbsp;</td>
            <td align="right"><?=number_format($row['gross_weight'],2,'.',',')?>&nbsp;</td>
            
         <td align="right"><?=number_format($row['only_truck_weight'],2,'.',',')?>&nbsp;</td>
            <td align="right"><?=number_format($row['rm_weight'],2,'.',',')?>&nbsp;</td>
            <td align="right" ><?=number_format($row['bag_weight'],2,'.',',')?>&nbsp;</td>
             <td align="right" ><?=number_format($row['net_weight'],2,'.',',')?>&nbsp;</td>
              <td align="right" ><?=number_format($row['truck_fee'],2,'.',',')?>&nbsp;</td>
        </tr>
            <?php
            endforeach;
            else: echo '<tr><td colspan="8">No Content Found!</td></tr>';

        endif;
        ?>
         
    </table>
</div>