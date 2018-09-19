<?php
/**
 * Template Name: index
 *
 * @package WordPress
 */
global $wpdb;

$user = wp_get_current_user();

$tableKlant = 'risiri_klanten';
$tableArtikel = 'risiri_artikelen';

$getKlant = $wpdb->get_results( "SELECT * FROM $tableKlant" );
$getArtikel = $wpdb->get_results( "SELECT * FROM $tableArtikel" );




//check functions based on role
if ( in_array( 'admin', (array) $user->roles ) ) { //admin role
    $view = true;
    $edit = true;
    $delete = true;
    $add = true;
}
if ( in_array( 'beheerder', (array) $user->roles ) ) { //beheerder role
    $view = true;
    $edit = true;
    $add = true;

} else { //everybody else
    $view = true;
}
?>



<?php get_header(); ?>

    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script>


    <div id="tabs">

        <ul id="table-nav">
            <li><a href="#tab-artikelen">Artikelen</a></li>
            <li><a href="#tab-klanten">Klanten</a></li>
        </ul>

        <div id="tab-artikelen">
            <table id="data-table" cellspacing="0">
                <tr>
                    <th width="12%">Artikelnummer</th>
                    <th width="15%">Artikelnaam</th>
                    <th width="15%">Aanmaakdatum</th>
                    <th width="44%">Omschrijving</th>
                    <?php
                    if ( is_user_logged_in() ) { ?>
                        <th width="7%">Actie</th>
                    <?php } ?>
                </tr>

                <?php
                if ( is_user_logged_in() ) { // add artikel row ?>

                    <tr>
                        <form method="post">
                            <td>laaste row++</td>
                            <td><input type="text" name="Artikelnaam" placeholder="Artikelnaam"></td>
                            <td id="date">.</td>
                            <td><input type="text" name="omschrijving" placeholder="Omschrijving"></td>
                            <td><button type="submit" class="actionbutton" name="submitArtikel"><i class="fa fa-plus plus"></i></button></td>

                        </form>
                    </tr>

                <?php } ?>

                <?php foreach ($getArtikel as $row){  ?>

                  <?php  if ( is_user_logged_in() ) { ?>
                    <tr>
                        <form method="post">
                            <td><input type="text" name="Artikelnummer" value="<?php echo $row->Artikelnummer;?>"></td>
                            <td ><input type="text" name="Artikelnaam" value="<?php echo $row->Artikelnaam;?>"></td>
                            <td><?php echo $row->Aanmaakdatum;?></td>
                            <td><input type="text" name="omschrijving" value="<?php echo $row->omschrijving;?>"></td>
                            <td><div class="action-buttons"><button type="submit" class="actionbutton" name="editArtikel" value="edit"><i class="fas fa-pen pen"></i></button><a class="fas fa-trash-alt trash"  href="index.php?delArtikel=<?php echo $row->Artikelnummer;?>" name="delete" ></a></div></td>

                        </form>
                    </tr>
                    <?php } else{?>
                      <tr>
                              <td><?php echo $row->Artikelnummer;?></td>
                              <td><?php echo $row->Artikelnaam;?></td>
                              <td><?php echo $row->Aanmaakdatum;?></td>
                              <td><?php echo $row->omschrijving;?></td>
                      </tr>
                      <?php } ?>

                <?php }  //close artikelen loop?>

            </table>
        </div>
        <div id="tab-klanten">
            <table id="data-table" cellspacing="0">
                <tr>
                    <th width="8%">Klantnummer</th>
                    <th width="10%">Voornaam</th>
                    <th width="10%">Tussenvoegsel</th>
                    <th width="10%">Achternaam</th>
                    <th width="50%">Email</th>
                    <?php  if ( is_user_logged_in() ) { ?>
                    <th width="7%">Actie</th>
                    <?php } ?>
                </tr>
                <?php  if ( is_user_logged_in() ) {  //add klant row?>
                <tr>
                    <form method="post">
                        <td>Laatste row ++</td>
                        <td><input type="text" name="voorNaam"></td>
                        <td><input type="text" name="TussenVoegsel"></td>
                        <td><input type="text" name="Achternaam"></td>
                        <td><input type="text" name="email"></td>
                        <td><button type="submit" class="actionbutton" name="submitKlant"><i class="fa fa-plus plus"></i></button></td>

                    </form>
                </tr>
                <?php } ?>
                <?php foreach ($getKlant as $row){ ?>

                    <?php  if ( is_user_logged_in() ) { ?>
                        <tr>
                            <form method="post">
                                <td><input type="text" name="klantnummer" value="<?php echo $row->klantnummer;?>"></td>
                                <td><input type="text" name="voorNaam" value="<?php echo $row->voorNaam;?>""></td>
                                <td><input type="text" name="TussenVoegsel" value="<?php echo $row->TussenVoegsel;?>"></td>
                                <td><input type="text" name="Achternaam" value="<?php echo $row->Achternaam;?>"></td>
                                <td><input type="text" name="email" value="<?php echo $row->email;?>"></td>
                                <td><div class="action-buttons"><button type="submit" class="actionbutton" name="editKlant" value="edit"><i class="fas fa-pen pen"></i></button><a class="fas fa-trash-alt trash"  href="index.php?delArtikel=<?php echo $row->klantnummer;?>" name="delete" ></a></div></td>

                            </form>
                        </tr>
                    <?php } else{?>
                        <tr>

                            <td><?php echo $row->klantnummer;?></td>
                            <td><?php echo $row->voorNaam;?></td>
                            <td><?php echo $row->TussenVoegsel;?></td>
                            <td><?php echo $row->Achternaam;?></td>
                            <td><?php echo $row->email;?></td>
                        </tr>
                    <?php } ?>

                <?php } //close klanten loop ?>

                </tr>
            </table>
        </div>
    </div>




<?php

//add artikel
if ( isset( $_POST['submitArtikel'] ) ) {


    if (!empty($_POST['Artikelnaam'])) {
        $wpdb->insert($tableArtikel, array(

            'Artikelnaam' => $_POST['Artikelnaam'],
            'omschrijving' => $_POST['omschrijving'],
            'Aanmaakdatum' => date('Y-m-d'),

        ),
            array('%s', '%s')
        );


    }
    echo "<meta http-equiv='refresh' content='0'>";


}

//add klant
if ( isset( $_POST['submitKlant'] ) ) {



    if (!empty($_POST['voorNaam'])) {
        $wpdb->insert($tableKlant, array(

            'voorNaam' => $_POST['voorNaam'],
            'TussenVoegsel' => $_POST['TussenVoegsel'],
            'Achternaam' => $_POST['Achternaam'],
            'email' => $_POST['email']

        ),
            array('%s', '%s', '%s', '%s')


        );
        echo "<meta http-equiv='refresh' content='0'>";



    }

}
//delete Artikel
if (isset($_GET['delArtikel'])) {
    $del = $_GET['delArtikel'];
    //SQL query for deletion.
    $wpdb->delete( $tableArtikel, array( 'Artikelnummer' => $del ) );

}

//delete klant
if (isset($_GET['delKlant'])) {
    $del = $_GET['delKlant'];
    //SQL query for deletion.
    $wpdb->delete( $tableKlant, array( 'Klantnummer' => $del ) );

}

//EDIT Artikel
if (isset($_GET['editArtikel'])) {
    $del = $_GET['editArtikel'];
    //SQL query for deletion.
    $wpdb->delete( $tableArtikel, array( 'Artikelnummer' => $del ) );

}

//edit artikel
if ( isset( $_POST['editArtikel'] ) ) {



    if (!empty($_POST['Artikelnaam'])) {

        $wpdb->update($tableArtikel, array(

            'Artikelnummer' => $_POST['Artikelnummer'],
            'Artikelnaam' => $_POST['Artikelnaam'],
            'omschrijving' => $_POST['omschrijving']

        ),
            array('Artikelnummer' => $_POST['Artikelnummer'])
        );
        echo "<meta http-equiv='refresh' content='0'>";





    }

}

//edit klant
if ( isset( $_POST['editKlant'] ) ) {

    if (!empty($_POST['voorNaam'])) {

        $wpdb->update($tableKlant, array(

            'voorNaam' => $_POST['voorNaam'],
            'Tussenvoegsel' => $_POST['TussenVoegsel'],
            'Achternaam' => $_POST['Achternaam'],
            'email' => $_POST['email']

        ),
            array('klantnummer' => $_POST['klantnummer'])
        );
        echo "<meta http-equiv='refresh' content='0'>";

    }

}



?>

<?php get_footer(); ?>