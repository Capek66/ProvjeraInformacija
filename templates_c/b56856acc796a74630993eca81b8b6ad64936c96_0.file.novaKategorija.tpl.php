<?php
/* Smarty version 4.0.0, created on 2022-06-13 10:25:36
  from '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/novaKategorija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a6f480f18823_59381354',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b56856acc796a74630993eca81b8b6ad64936c96' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/novaKategorija.tpl',
      1 => 1655105864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a6f480f18823_59381354 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Dino Capek"/>
        <meta name="date.created" content="2022-05-30"/>
        <meta name="keywords" content="WebDiP, FOI, Projekt, Index"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.css"/>
	<?php echo '<script'; ?>
 type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10/datatables.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"><?php echo '</script'; ?>
>
        <link rel="stylesheet" type="text/css" href="./css/dcapek.css" />
        <?php echo '<script'; ?>
 type="text/javascript" src="./js/dcapek.js"><?php echo '</script'; ?>
>
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
                    <a href="<?php echo $_smarty_tpl->tpl_vars['navigacija_putanja']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['navigacija']->value;?>
</a>
                    <li class="menu" id="menuButton"><img src="./materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./obrasci/registracija.php"><li>Registracija</li></a>
                        <a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>
                        <a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>
                        <a href="./upravljanjeKategorijama.php"><li class="aktivan">Upravljanje kategorijama</li></a>
                        <a href="./upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>
                        <a href="./virtualnoVrijeme.php"><li>Promjena vremena</li></a>
                        <a href="./pregledDnevnika.php"><li>Dnevnik</li></a>
                    </ul>
                </div>
            </nav>
        </header>
        <section>
            <span><a href="./upravljanjeKategorijama.php" class="natrag">Natrag</a></span>
            <div id="h3Centar">
                <h3><?php echo $_smarty_tpl->tpl_vars['naslov']->value;?>
</h3>
                <p id="greskeKat"></p>
            </div>
            <div class="forma">
                <form id="nova_kategorija" method="post" name="forma_nova_kategorija" action="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
" novalidate>
                    <input type="hidden" id="katID" name="id" value="<?php echo $_smarty_tpl->tpl_vars['kategorija_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['ukljucena']->value;?>
>
                    <label for="naziv">Naziv kategorije</label><br>
                    <input type="text" id="naziv" name="naziv" value="<?php echo $_smarty_tpl->tpl_vars['naziv']->value;?>
"><br>
                    <br>
                    <label for="opisKat">Opis kategorije</label><br>
                    <textarea id="opisKat" name="opisKat" rows="15" cols="30" placeholder="Kratak opis kategorije ..."><?php echo $_smarty_tpl->tpl_vars['opis']->value;?>
</textarea>
                    <br><br>
                    <input type="submit" id="dodajKategorijuGumb" value="<?php echo $_smarty_tpl->tpl_vars['gumbTekst']->value;?>
">
                </form>
                <br <?php echo $_smarty_tpl->tpl_vars['prikazujeSe']->value;?>
>
                <hr <?php echo $_smarty_tpl->tpl_vars['prikazujeSe']->value;?>
>
                <br <?php echo $_smarty_tpl->tpl_vars['prikazujeSe']->value;?>
>
                <button id="obrisiKategoriju" class="gumb" <?php echo $_smarty_tpl->tpl_vars['prikazujeSe']->value;?>
>Obriši kategoriju</button>
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






<?php }
}
