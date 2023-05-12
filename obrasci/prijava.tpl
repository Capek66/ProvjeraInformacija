<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Dino Capek"/>
        <meta name="date.created" content="2022-05-30"/>
        <meta name="keywords" content="WebDiP, FOI, Projekt, Registracija"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" type="text/css" href="../css/dcapek.css" />
        <script type="text/javascript" src="../js/dcapek.js"></script>
        <title>Provjera informacija</title>
    </head>
    <body>
        <header>
            <h1>Provjera informacija</h1>
            <nav>
                <ul>
                    <a href="../index.php"><li>Početna</li></a>
                    <a href="../oAutoru.php"><li>O Autoru</li></a>
                    <a href="../dokumentacija.php"><li>Dokumentacija</li></a>
                    <a href="./prijava.php"><li class="aktivan">Prijavi se</li></a>
                    <li class="menu" id="menuButton"><img src="../materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./registracija.php"><li>Registracija</li></a>
                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <h2>PRIJAVA</h2>
                <br>
                <h4>{$poruka}</h4>
                <form id="prijava" method="post" name="forma_prijava" action="{$putanja}" novalidate>
                        <label for="korisnicko_ime">Korisničko ime</label><br>
                        <input type="text" id="kor_ime" name="korisnicko_ime" maxlength="25" required="required" value="{$korisnicko_ime}"><br>
                        <br>
                        <label for="lozinka">Lozinka</label><br>
                        <input type="password" id="lozinka" name="lozinka" maxlength="50" required="required"><br>
                        <br>
                        <label>Zapamti me?</label><br>
                        <input type="radio" id="zapamti_da" name="zapamti" value="da" {$zapamti_da}>
                        <label for="zapamti_da">Da</label>
                        <input type="radio" id="zapamti_ne" name="zapamti" value="ne" {$zapamti_ne}>
                        <label for="zapamti_ne">Ne</label>
                        <br><br>
                        <input type="submit" id="prijavise" value="Prijavi se">
                        <br><br>
                        <hr>
                        <a id="zabLoz">Zaboravljena lozinka?</a><br>
                    </form>
            </div>
        </section>
        
        <footer>
            <div class="footerText">
                <address class="footerA">
                    Kontakt: <a href="mailto:dcapek@foi.hr">dcapek@foi.hr</a>
                </address>
                <p class="footerP" style>
                    <a href="mailto:dcapek@foi.hr">Dino Capek</a> &copy; 2022.
                </p>
            </div>
        </footer>
    </body>
</html>

