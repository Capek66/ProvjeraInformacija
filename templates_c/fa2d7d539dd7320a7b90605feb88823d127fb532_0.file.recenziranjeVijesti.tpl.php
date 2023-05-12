<?php
/* Smarty version 4.0.0, created on 2022-06-11 12:17:59
  from 'C:\xampp\htdocs\WebDiP_Projekt\recenziranjeVijesti.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a46bd7bb5f44_72712709',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa2d7d539dd7320a7b90605feb88823d127fb532' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\recenziranjeVijesti.tpl',
      1 => 1654942659,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a46bd7bb5f44_72712709 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

                    </ul>
                </div>
            </nav>
        </header>
        <section>
            <span><a href="./mojeKategorije.php" class="natrag">Natrag</a></span>
            <div id="h3Centar">
                <h3>Recenziranje</h3>
            </div>
            <div id="vijestRecenziranja">
            </div>
            <br>
            <div class="forma formaRec">
                <h4 id="greskaRecenzija"></h4>
                <form id="recenzija" method="post" name="forma_recenzija" action="./skripte/azurirajRecenziju.php" novalidate>
                        <input type="hidden" name="vijest_id" value="<?php echo $_smarty_tpl->tpl_vars['vijest_id']->value;?>
">
                        <label for="recenzija">Recenzija</label><br>
                        <textarea id="recenzijaUnos" name="recenzija" rows="15" cols="50" placeholder="Osvrt na vijest ..."></textarea>
                        <br><br>
                        <input type="checkbox" id="cinjenicne" name="cinjenicne" value="1">
                        <label for="cinjenicne">Činjenične pogreške</label><br><br>
                        
                        <input type="checkbox" id="gramaticke" name="gramaticke" value="1">
                        <label for="gramaticke">Gramatičke pogreške</label><br><br>
                        
                        <input type="checkbox" id="nedostatak_mat" name="nedostatak_mat" value="1">
                        <label for="nedostatak_mat">Nedostatak materijala</label><br><br>
                        
                        <input type="checkbox" id="nedostatak_izv" name="nedostatak_izv" value="1">
                        <label for="nedostatak_izv">Nedostatak izvora</label><br><br>
                        
                        <input type="radio" id="prihv" name="statusVijesti" value="1">
                        <label for="prihv">Prihvaćena</label>
                        
                        <input type="radio" id="odb" name="statusVijesti" value="2">
                        <label for="odb">Odbijena</label>
                        
                        <input type="radio" id="rec" name="statusVijesti" value="3" checked>
                        <label for="rec">Recenzija</label>
                        
                        <input type="radio" id="dorad" name="statusVijesti" value="4">
                        <label for="dorad">Dorada</label>

                        <br><br>
                        <input type="submit" id="recenziraj" value="Recenziraj">
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
