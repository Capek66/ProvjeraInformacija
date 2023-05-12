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
            <span><a href="./mojeVijesti.php" class="natrag">Natrag</a></span>
            <div class="forma">
                <h3>{$naslovStranice}</h3>
                <p id="greske">{$greska}</p>
                <br>
                <form id="nova_vijest" method="post" name="forma_vijest" action="{$putanja}" enctype="multipart/form-data" novalidate>
                    <label for="kategorija">Kategorija*</label><br>
                    <select id="kategorija" name="kategorija">
                        <option value="0">Odaberite</option>
                    </select><br>
                    <br>
                    <label for="naslov">Naslov*</label><br>
                    <input type="text" id="naslov" name="naslov" value="{$naslov}"><br>
                    <br>
                    <label for="autor">Autor*</label><br>
                    <input type="text" id="autor" name="autor" value="{$autor}"><br>
                    <br>
                    <label for="clanak">Clanak*</label><br>
                    <textarea id="clanak" rows="15" cols="30" name="clanak" placeholder="Vijest ...">{$clanak}</textarea><br>
                    <br>
                    <label for="izvor">Izvor</label><br>
                    <input type="text" id="izvor" name="izvor" placeholder="www.google.com" value="{$izvor}"><br>
                    <br>
                    <label for="slika">Slika*</label><br>
                    <input type="file" id="slika" name="slika"><br>
                    <br>
                    <label for="medij">Video/audio</label><br>
                    <input type="file" id="medij" name="medij"><br>
                    <br>
                    <input type="submit" id="{$gumbID}" value="{$gumbTekst}">
                </form>
                <span><p id="napomena">* obavezna polja</p></span>
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


