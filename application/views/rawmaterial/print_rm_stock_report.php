
<div class="doc_wrapper">
<div class="table_content">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td colspan="13">

        </td>
        </tr>
        <tr>

        <th align="left">Item Name:&nbsp;</th>
        <th align="left">Current Stock(K.G.:&nbsp;</th>
        <th align="left">Rate(Per K.G.):&nbsp;</th>
        <th align="left">Total Value:&nbsp;</th>

        </tr>
        <?php
        if (count($rows) > 0):

            foreach ($rows as $row):
                ?>

                <tr>
                <td><?php echo $row['row_material_name'] ?>&nbsp;</td>
                <td><?php echo $row['current_stock'] ?>&nbsp;</td>
                <td><?php echo $row['rate'] ?>&nbsp;</td>
                <td><?php echo $row['rate']*$row['current_stock'] ?>&nbsp;</td>
                </tr>
                <?php
            endforeach;
        else: echo '<tr><td colspan="8">No Content Found!</td></tr>';

        endif;
        ?>

    </table>
</div>
</div>