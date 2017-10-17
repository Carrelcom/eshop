<?php
$display = false;
if($connected && $mail <> ""){
  $display = true;
}

$arrListes = Engine::GetListes(array('mail_admin'=>$mail));


?>

<p>liste</p>

<div id="shortcode-table">
        <table class="table table-bg table-bordered">
            <thead>
                <tr>
                    <th class="text-center">listes</th>
                    <th class="text-center">Création</th>
                    <th class="text-center">Echeance</th>
                </tr>
            </thead>
            <tbody>
              <?php
                foreach ($arrListes as $liste) {
                  echo "<tr>";

                  echo "    <td><a href='page.php?page=listeManagement&listeUrlAdmin=".$liste->getAdminUrl()."'>".$liste->getListeName()."</a></td>";
                  echo "    <td class='text-center'><strong>".$liste->getcreationDate()."</strong></td>";
                  echo "    <td class='text-center'><strong>".$liste->getEndDate()."</strong></td>";
                  echo "</tr>";
                }

               ?>


            </tbody>
        </table>

</div>
