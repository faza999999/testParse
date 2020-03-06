<table border="1">
    <tr>
        <th>Model</th>
        <th>Title</th>
        <th>URL</th>
        <th>Price</th>
        <th>Shipping</th>
    </tr>
    <?foreach ($resultArr as $model => $results):?>
        <?foreach ($results as $row):?>
            <tr>
                <td><?=$model;?></td>
                <td><?=$row['title']?></td>
                <td><?=$row['url']?></td>
                <td><?=$row['price']?></td>
                <td><?=$row['shipping']?></td>
            </tr>
            <?endforeach;?>
    <?endforeach;?>

</table>