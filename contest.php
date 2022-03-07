<?php
include 'top.php';


$joesPondWinners = array(
    array(2020, 'Angela Buttura and Nancy Durand', 'Essex Junction and Hardwick, VT', '4/15/20', '6:07 a.m.'),
    array(2019,'Robynn L. Albert', 'Essex Junction, VT', '4/25/19', '5:29 a.m.'),
    array(2018, 'Michael S. Cody', 'Barre, VT', '5/4/18', '11:27 a.m.'),
    array(2017, 'Emily Wiggett', 'North Danville, VT', '4/23/17', '4:32 p.m.'),
    array(2016, 'Pamela Swift', 'Barre, VT', '4/12/16', '5:04 p.m.')
);

?>

<main>
    <article>
        <section>
            <p></p>
            
            <h3>Last <?php echo count($joesPondWinners) ?> Winners.</h3>
            
            <ol>
                <?php
                foreach ($joesPondWinners as $joesPondWinner) 
                {
                    print '<li>';
                    print $joesPondWinner[0] . ', ';
                    print $joesPondWinner[1] . ', ';
                    print $joesPondWinner[2] . ', ';
                    print $joesPondWinner[3] . ', ';
                    print $joesPondWinner[4];
                    print '</li>' . PHP_EOL;
                }
                ?>
            </ol>
        </section>
    </article>
</main>

<?php
include 'footer.php';
?>  
</body>
</html>