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
                    <a href="{$navigacija_putanja}">{$navigacija}</a>
                    <li class="menu" id="menuButton"><img src="../materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./registracija.php"><li class="aktivan">Registracija</li></a>
                        {$nav}
                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <h2>{$naslov}</h2>
                <br>
                <h4 id="greska">{$poruka}</h4>
                <form id="registracija" method="post" name="forma_registracija" action="{$putanja}" {$prikaz} novalidate>
                        <label for="ime">Ime</label><br>
                        <input type="text" id="ime" name="ime" autofocus="autofocus" required="required" value="{$ime}"><br>
                        <br>
                        <label for="prezime">Prezime</label><br>
                        <input type="text" id="prezime" name="prezime" required="required" value="{$prezime}"><br>
                        <br>
                        <label for="korisnicko_ime">Korisničko ime</label><br>
                        <input type="text" id="korisnicko_ime" name="korisnicko_ime" maxlength="25" required="required" value="{$korisnicko_ime}"><br><span id="provjera"></span>
                        <br>
                        <label for="email">Email adresa</label><br>
                        <input type="email" id="email" name="email_adresa" placeholder="idap@foi.hr" required="required" value="{$email}"><br>
                        <br>
                        <label for="lozinka">Lozinka</label><br>
                        <input type="password" id="lozinka" name="lozinka" maxlength="50" required="required" value="{$lozinka}"><br>
                        <br>
                        <label for="lozinka2">Potvrda lozinke</label><br>
                        <input type="password" id="lozinka2" name="potvrda_lozinke" maxlength="50" required="required" value="{$potvrda_lozinke}"><br>
                        <br>
                        <div class="g-recaptcha recaptcha" data-sitekey="6LcPszwgAAAAALYD4-IoODNjv7e84R4qW3Bo9eJc"></div>
                        <br><br>
                        <input type="submit" id="registriraj" value="Registriraj se">
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
