<div class="doc_wrapper">
<div class="table_content">
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
        <td colspan="13">

        </td>
        </tr>
        <tr>
        <th align="left">Category Name:&nbsp;</th>
        <th align="left">Item Name:&nbsp;</th>
        <th align="left">Amount stock (KG):&nbsp;</th>
        <th align="left">Rate(Per K.G.):&nbsp;</th>
        <th align="left">Total Value:&nbsp;</th>

        </tr>
        <?php
        if (count($rows) > 0):

            foreach ($rows as $row):
            $cat_name = sql::row('finished_product_category', 'id=' . $row['category_id']);
                ?>

                <tr>
                <td><?php echo $cat_name['category_name'] ?>&nbsp;</td>
                <td><?php echo $row['product_name'] ?>&nbsp;</td>
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