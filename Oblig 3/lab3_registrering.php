<!DOCTYPE html>
<html lang="no">
<head>
    <title>Deltaker registrering</title>
</head>
<body>
<div class="container">
<?php
require_once ('Deltaker.class.php');
    $validate = false;
    $fornavn = "";
    $etternavn = "";
    $faar = "";
    $yrker= ["IT-konsulent", "Lærer", "Bonde", "Sekretær", "Snekker", "Elektriker"];


    if ( isset($_POST['submit'])  ) {   //false f�rste gang
        if (is_numeric($_POST['fAar'])) {
            $forNavn = htmlspecialchars($_POST['forNavn']);
            $etterNavn = htmlspecialchars($_POST['etterNavn']);
            $fAar = $_POST['fAar'];
            $yrke = $_POST['yrke'];
            $aarDiff = date('Y') - $fAar;
            $deltaker = new Deltaker($forNavn, $etterNavn, $fAar);
            $deltaker->settYrke($yrke);
            echo "<h3>" . $forNavn . ", " . $etterNavn . "</h3>";
            echo "<p>Din alder er: " . $aarDiff . "år" . "</p>";
            echo "<p>Du er registrert " . date('H:i, jS F Y') . "</p>";
            echo "<p>Ditt yrke er: " . $deltaker->hentYrke() . "</p>";


            $validate = true;
        } else {
            echo "<p>Årstall må være numerisk</p>";
            $validate = false;
            $fornavn = $_POST['forNavn'];
            $etternavn = $_POST['etterNavn'];
            $faar = $_POST['fAar'];
        }
    }
    if(!$validate) {
    ?>
            <form id="contact" method="post">
                <h3>Konferansen IKT i undervisning</h3>
                <h4>Registrering</h4>
                <fieldset>
                    <input name="forNavn" placeholder="Ditt fornavn" type="text" value="<?php echo $fornavn ?>" tabindex="1" required autofocus>
                </fieldset>
                <fieldset>
                    <input name="etterNavn" placeholder="Ditt etternavn" type="text" value="<?php echo $etternavn ?>" tabindex="2" required autofocus>
                </fieldset>
                <fieldset>
                    <input name="fAar" placeholder="Ditt fødselsår" type="text" value="<?php echo $faar ?>" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <select name="yrke">
                        <?php
                            foreach ($yrker as $yrke)
                            {
                                echo '<option name="' . $yrke . '">' . $yrke . '</option>';
                            }
                        ?>
                    </select>
                </fieldset>
                <fieldset>
                <button name="submit" type="submit" id="registrering_submit" data-submit="...Sending">Submit</button>
                </fieldset>
                <p class="copyright">Designed by Jonas Sætre</p>
            </form>
        </div>
    <?php
}
?>
</body>
</html>