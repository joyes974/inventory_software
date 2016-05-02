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
            <th align="left">Amount Stock(K.G.):&nbsp;</th>
            <th align="left">Release Date:&nbsp;</th>
            <th align="left">Operator Name:&nbsp;</th>


            </tr>
            <?php
            if (count($rows) > 0):

                foreach ($rows as $row):
                    $item_name = sql::row('finished_product', 'id=' . $row['item_id']);
                    $cat_name = sql::row('finished_product_category', 'id=' . $item_name['category_id']);
                    ?>

                    <tr>
                    <td><?php echo $cat_name['category_name'] ?>&nbsp;</td>
                    <td><?php echo $item_name['product_name'] ?>&nbsp;</td>
                    <td><?php echo $row['released_amount'] ?>&nbsp;</td>
                    <td><?php echo $row['released_date'] ?>&nbsp;</td>
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