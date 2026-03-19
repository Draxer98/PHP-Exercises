<head>
    <style>
        .giallo { background: yellow; }
        .verde { background: green; }
    </style>
</head>

<?php
function disegnaTabella($righe, $colonne)
{
    echo "<table width=30% border=1>";
    for($r=0; $r<$righe;$r++){
        echo "<tr>";
        for($c=0; $c<$colonne;$c++){
            if($c%2==0){
                if($r%2==0){
                    echo "<td class='giallo'>&nbsp;</td>";
                } else {
                    echo "<td class='verde'>&nbsp;</td>";
                }
            } else {
                if($r%2==0){
                    echo "<td class='verde'>&nbsp;</td>";
                }else {
                    echo "<td class='giallo'>&nbsp;</td>";
                }
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>