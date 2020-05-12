<div style="position: fixed; left: 0; top: 0; width: 100%; height: 100%; background-color: lightcoral;">
    <table style="position: relative; margin: auto;">
        <tr>
            <th colspan="2">
                <h4><?php echo $sql_err['message']?></h4>
            </th>
        </tr>
        <?php
        echo "<tr><td><b>Код ошибки:</b></td><td>" . $sql_err['code'] . "</td></tr>";
        echo "<tr><td><b>Текст ошибки:</b></td><td>" . $sql_err['error'] . "</td></tr>";
        ?>
    </table>
</div>