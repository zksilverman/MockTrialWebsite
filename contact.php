<?php
include 'top.php';
?> 

<main class="flexbox-layout">
    <table>
        <caption><strong>UVM Mock Trial Executive Board</strong></caption>
        <tr class="odd">
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Pronouns</th>
        </tr>

        <?php
            $sql = 'SELECT fldName, fldPronouns, fldEmail, fldRole FROM tblMockTrialContactInformation';

            $statement = $pdo->prepare($sql);
            $statement->execute();

            $records = $statement->fetchAll();

            foreach ($records as $record) {
                print '<tr>';
                print '<td>' . $record['fldName'] . '</td>';
                print '<td>' . $record['fldRole'] . '</td>';
                print '<td>' . $record['fldEmail'] . '</td>';
                print '<td>' . $record['fldPronouns'] . '</td>';
                print '</tr>' . PHP_EOL;
            }
        ?>

    </table>
</main>
<?php
include 'footer.php';
?>  