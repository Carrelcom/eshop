<?php

if($connected && $mail <> ""){


$arrListes = Engine::GetListes(array('mail_admin'=>$mail));


?>

<p>liste</p>







<div id="content-wrapper">
    <section id="about-us" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-12 fade-up">
<!-- DEBUT INCLUDE -->
                <!-- <ul class="portfolio-filter fade-down center">
                    <li><a class="btn btn-outlined btn-primary active" href="#" data-filter="*">All</a></li>
                    <li><a class="btn btn-outlined btn-primary" href="#" data-filter=".bootstrap">Bootstrap</a></li>
                    <li><a class="btn btn-outlined btn-primary" href="#" data-filter=".html">HTML</a></li>
                    <li><a class="btn btn-outlined btn-primary" href="#" data-filter=".wordpress">Wordpress</a></li>
                </ul> -->
                <!--/#portfolio-filter-->
                <table class="table table-bg table-bordered" id="mylists">
                    <thead>
                        <tr>
                            <th class="text-center">Label</th>
                            <th class="text-center">Created</th>
                            <th class="text-center">End</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($arrListes as $liste) {
                          echo "<tr>";

                          echo "    <td>".$liste->getListeName()."</td>";
                          echo "    <td class='text-center'>".$liste->getcreationDate()."</td>";
                          echo "    <td class='text-center'>".$liste->getEndDate()."</td>";
                          echo "    <td class='text-center'><span class='label label-info'><a href='page.php?page=showlist&listeUrl=".$liste->getUrl()."'>See</a> </span>&nbsp;<span class='label label-warning'><a href='page.php?page=updatelist&listeUrlAdmin=".$liste->getAdminUrl()."'>Update</a></span></td>";
                        //  echo "    <td class='text-center'><a href='page.php?page=updatelist&listeUrlAdmin=".$liste->getAdminUrl()."'>Update</a></td>";
                          echo "</tr>";
                        }

                       ?>

                    </tbody>
                </table>


<!-- FIN INCLUDE -->
                </div>
            </div>
          </div>
    </section>
</div>





<?php } ?>
