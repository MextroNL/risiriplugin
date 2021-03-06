<?php
/**
 * Created by PhpStorm.
 * User: Erwin Jobse
 * Date: 9/25/2018
 * Time: 10:03 AM
 */ ?>

<div id="tab-artikelen">
    <script type="text/javascript">
        $(
            function() {
                $("#artikelen-table").FullTable({
                    "alwaysCreating":true,
                    "selectable":false,
                    "fields": {
                        "Artikelnummer":{
                            "mandatory":false,
                            "disabled": true,
                            "placeholder": "N.V.T.",
                        },
                        "Artikelnaam":{
                            "mandatory":true,
                            "placeholder": "Artikelnaam",
                            "errors":{
                                "mandatory":"Vul alle verplichte velden in",
                            }
                        },
                        "AanmaakDatum":{
                            "mandatory":false,
                            "disabled":true,
                            "placeholder": "N.V.T.",
                        },
                        "omschrijving":{
                            "mandatory":false,
                            "placeholder": "Omschrijving",
                        },


                    }
                });
                $("#artikelen-table-add-row").click(function() {
                    $("#artikelen-table").FullTable("addRow");
                });
                $("#artikelen-table-get-value").click(function() {
                    console.log($("#artikelen-table").FullTable("getData"));
                });
                $("#artikelen-table").FullTable("on", "error", function(errors) {
                    for (var error in errors) {
                        error = errors[error];
                        console.log(error);
                        $("#melding").show();
                        document.getElementById("meldingT").innerHTML = error;
                    }
                });
                $("#artikelen-table").FullTable("draw");
            }
        );
    </script>


    <div id="jquery-script-menu">
        <div class="jquery-script-center">

            <div class="jquery-script-clear"></div>
        </div>
    </div>
    <div class="container">
        <table class="fulltable fulltable-editable" id="artikelen-table">
            <thead>
            <tr>
                <th fulltable-field-name="Artikelnummer">Artikelnummer</th>
                <th fulltable-field-name="Artikelnaam">Artikelnaam</th>
                <th fulltable-field-name="AanmaakDatum">Aanmaakdatum</th>
                <th fulltable-field-name="omschrijving" >Omschrijving</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($getArtikel as $row) { ?>
            <tr class="row-return">
                <td><span><?php echo $row->Artikelnummer; ?></span></td>
                <td><span><?php echo $row->Artikelnaam; ?></span></td>
                <td><span><?php echo $row->Aanmaakdatum; ?></span></td>
                <td class="textarea"><span><?php echo $row->omschrijving; ?></span></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

</div>


