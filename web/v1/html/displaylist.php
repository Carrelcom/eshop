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
                    <th class="text-center">id</th>
                    <th class="text-center">Label</th>
                    <th class="text-center">Admin</th>
                </tr>
            </thead>
            <tbody>
              <?php
                foreach ($arrListes as $liste) {
                  echo "<tr>";
                  echo "<td>".$liste->getIdListe()."</td>";
                  echo "    <td><a href='page.php?page=displayOneListe&listUrl=".$liste->getUrl()."'>".$liste->getListeName()."</a></td>";
                  echo "    <td class='text-center'><strong>".$liste->getAdminName()."</strong></td>";
                  echo "</tr>";
                }

               ?>


            </tbody>
        </table>

</div>
