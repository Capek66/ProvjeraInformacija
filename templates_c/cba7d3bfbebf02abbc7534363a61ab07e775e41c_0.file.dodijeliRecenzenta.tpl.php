<?php
/* Smarty version 4.0.0, created on 2022-06-13 11:25:01
  from '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/dodijeliRecenzenta.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a7026da756b6_60428590',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cba7d3bfbebf02abbc7534363a61ab07e775e41c' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/dodijeliRecenzenta.tpl',
      1 => 1655105863,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a7026da756b6_60428590 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <a href="./upravljanjeKategorijama.php"><li>Upravljanje kategorijama</li></a>
                        <a href="./upravljanjeRecenzijama.php"><li class="aktivan">Upravljanje recenzijama</li></a>
                        <a href="./virtualnoVrijeme.php"><li>Promjena vremena</li></a>
                        <a href="./pregledDnevnika.php"><li>Dnevnik</li></a>
                    </ul>
                </div>
            </nav>
        </header>
        <section>
            <span><a href="./upravljanjeRecenzijama.php" class="natrag">Natrag</a></span>
            <div id="h3Centar">
                <h3>Dodijela recenzenta</h3>
            </div>
            <div id="vijestRecenzent">
                <?php echo $_smarty_tpl->tpl_vars['vijest']->value;?>

            </div>
            <br>
            <div class="forma">
                <span id="greskaRec"></span>
                <form id="dodaj_recenzenta" method="post" name="forma_dodaj_recenzenta" action="./skripte/azurirajRecenzenta.php" novalidate>
                    <input type="hidden" id="vijestID" name="id" value="<?php echo $_smarty_tpl->tpl_vars['vijest_id']->value;?>
">
                    <label for="recenzent">Moderatori kategorije</label><br>
                    <input kategorija="<?php echo $_smarty_tpl->tpl_vars['kategorija_id']->value;?>
" type="text" id="recenzentForma" name="recenzent" list="moguciRecenzenti"><br>
                    <datalist id="moguciRecenzenti">
                        <?php echo $_smarty_tpl->tpl_vars['opcije']->value;?>

                    </datalist>
                    <br><br>
                    <input type="submit" id="pridruziRecenzenta" value="Pridruži recenzenta" disabled="true">
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







<?php }
}
