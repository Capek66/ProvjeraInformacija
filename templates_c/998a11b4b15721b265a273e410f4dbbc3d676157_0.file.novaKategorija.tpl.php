<?php
/* Smarty version 4.0.0, created on 2022-06-11 01:12:48
  from 'C:\xampp\htdocs\WebDiP_Projekt\novaKategorija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a3cff0ecddb4_93167846',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '998a11b4b15721b265a273e410f4dbbc3d676157' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\novaKategorija.tpl',
      1 => 1654902684,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a3cff0ecddb4_93167846 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <li>Link 2</li>
                    <li>Link 3</li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['navigacija_putanja']->value;?>
"><li><?php echo $_smarty_tpl->tpl_vars['navigacija']->value;?>
</li></a>
                    <li class="menu" id="menuButton"><img src="./materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./obrasci/registracija.php"><li>Registracija</li></a>
                        <a href="./mojeVijesti.php"><li>Moje Vijesti</li></a>
                        <a href="./mojeKategorije.php"><li>Moje Kategorije</li></a>
                        <a href="./upravljanjeKategorijama.php"><li class="aktivan">Upravljanje kategorijama</li></a>
                        <a href="./upravljanjeRecenzijama.php"><li>Upravljanje recenzijama</li></a>
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
