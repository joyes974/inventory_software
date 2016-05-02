<div class="doc_wrapper">
<div class="table_content">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td colspan="13">

        </td>
        </tr>
        <tr>

        <th align="left">Item Name:&nbsp;</th>
        <th align="left">Release Amount(K.G.):&nbsp;</th>
        <th align="left">Release Date:&nbsp;</th>
        <th align="left">Operator Name:&nbsp;</th>
      

        </tr>
        <?php
        if (count($rows) > 0):

            foreach ($rows as $row):
            $item_name=sql::row('stock_raw_material','id='.$row['item_id']);
                ?>

                <tr>
                <td><?php echo $item_name['row_material_name'] ?>&nbsp;</td>
                <td><?php echo $row['amount'] ?>&nbsp;</td>
                <td><?php echo $row['date'] ?>&nbsp;</td>
                <td><?php echo $row['operator'] ?>&nbsp;</td>
               
                </tr>
                <?php
            endforeach;
        else: echo '<tr><td colspan="8">No Content Found!</td></tr>';

        endif;
        ?>

    </table>
</div>
</div>