<?php

class table{


public function __construct()
    {
        add_shortcode('risiriTable', array($this, 'shortcode'));
    }

    public function shortcode()
    {
        include(plugin_dir_path(__FILE__) . '/include.php');
        include(plugin_dir_path(__FILE__) . '/roleCheck.php');
        include(plugin_dir_path(__FILE__) . '/db.php');
        ?>

        <?php if ($view === TRUE) { //show content  ?>

        <div class="navbar-logo">
            <?php the_custom_logo(); ?>
        </div>

        <script>
            $(function () {
                $("#tabs").tabs();
                $("#tabs").show();
            });
        </script>

        <div id="success"></div>

        <div id="tabs">

            <ul id="table-nav">
                <li><a href="#tab-artikelen">Artikelen</a></li>
                <li><a href="#tab-klanten">Klanten</a></li>
            </ul>

            <?php include(plugin_dir_path(__FILE__) . '/tableArtikelen.php'); ?>
            <?php include(plugin_dir_path(__FILE__) . '/tableKlanten.php'); ?>


        </div>

        <!-- only for test -->

        <form name="sentMessage" id="addArtikel"
              action="<?php echo plugins_url(); ?>/risiriWidget/classes/handler/addArtikel.php/?ajax=true"

              method="POST">
            <input class="form-control" id="Artikelnaam" required
                   data-validation-required-message="Please enter your name.">
            <input class="form-control" id="omschrijving" required data-validation-required-message="sorry">


            <button type="submit" id="addArtikelButton">Send</button>

        </form>


    <?php }  //end view
    }
}

$risiriTable = new table();

    ?>


