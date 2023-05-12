<!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Dino Capek"/>
        <meta name="date.created" content="2022-05-30"/>
        <meta name="keywords" content="WebDiP, FOI, Projekt, Index"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/dcapek.css" />
        <script type="text/javascript" src="./js/dcapek.js"></script>
        <title>Provjera informacija</title>
    </head>
    <body>
        <header>
            <h1>Provjera informacija</h1>
            <nav>
                <ul>
                    <a href="./index.php"><li>Početna</li></a>
                    <a href="./oAutoru.php"><li>O Autoru</li></a>
                    <a href="./dokumentacija.php"><li>Dokumentacija</li></a>
                    <a href="{$navigacija_putanja}">{$navigacija}</a>
                    <li class="menu" id="menuButton"><img src="./materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./obrasci/registracija.php"><li>Registracija</li></a>
                        {$nav}
                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <label for="tipFilter">Filtrirajte po tipu: </label>
                <select id="tipFilter" name="tipFilter">
                    <option value="odaberite" selected>Odaberite</option>
                    {$tipFilter}
                </select><br><br>
                <label for="korisniciFilter">Filtrirajte po korisnicima: </label>
                <select id="korisniciFilter" name="korisniciFilter">
                    <option value="odaberite" selected>Odaberite</option>
                    {$korisniciFilter}
                </select><br><br>
                <label for="dnevnik_razdoblje_od">Zapisi u razdoblju od: </label>
                <input type="text" id="dnevnik_razdoblje_od" name="dnevnik_razdoblje_od" placeholder="yyyy-mm-dd" style="width: 25%">
                <label for="dnevnik_razdoblje_do">do: </label>
                <input type="text" id="dnevnik_razdoblje_do" name="dnevnik_razdoblje_do" placeholder="yyyy-mm-dd" style="width: 25%">
                <br><br>
                <button class="gumb" id="dnevnik_resetGumb">Reset</button>
            </div>
            <div id="dnevnik"></div>
            <br>
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

