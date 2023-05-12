<?php
/* Smarty version 4.0.0, created on 2022-06-11 11:52:13
  from 'C:\xampp\htdocs\WebDiP_Projekt\moderatoriKategorije.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a465cdcd19c9_58790359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbc1cbfd87780763d391a7f242141e449a29122d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\moderatoriKategorije.tpl',
      1 => 1654902696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a465cdcd19c9_58790359 (Smarty_Internal_Template $_smarty_tpl) {
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
                <h3>Moderatori kategorije <?php echo $_smarty_tpl->tpl_vars['kategorijaNaziv']->value;?>
</h3>
                <br>
                <div id="modDiv">
                    <div>
                        <span id="error"></span><br>
                        <input kategorija="<?php echo $_smarty_tpl->tpl_vars['kategorijaID']->value;?>
" type="text" list="listaKorisnika" id="izborModeratora">
                        <datalist id="listaKorisnika">
                            <?php echo $_smarty_tpl->tpl_vars['listaKorisnika']->value;?>

                        </datalist>
                        <button id="dodajMod" class="gumb" disabled="true">Dodaj moderatora</button>
                    </div>
                    <table id="moderatoriKat">
                        <tr><th>Korisničko ime</th><th>Prezime i ime</th><th>Ukloni</th></tr>
                        <tbody>
                            <?php echo $_smarty_tpl->tpl_vars['prikazModeratora']->value;?>

                        </tbody>
                    </table> 
                    <br>                    
                </div>
            </div>
            <div id="">
            </div>
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






<?php }
}
