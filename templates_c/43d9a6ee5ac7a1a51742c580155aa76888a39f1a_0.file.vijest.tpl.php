<?php
/* Smarty version 4.0.0, created on 2022-06-11 12:25:04
  from 'C:\xampp\htdocs\WebDiP_Projekt\vijest.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a46d80ab4ab4_78820960',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '43d9a6ee5ac7a1a51742c580155aa76888a39f1a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\vijest.tpl',
      1 => 1654943063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a46d80ab4ab4_78820960 (Smarty_Internal_Template $_smarty_tpl) {
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
            <span><a href="./mojeVijesti.php" class="natrag">Natrag</a></span>
            <div class="forma">
                <h3><?php echo $_smarty_tpl->tpl_vars['naslovStranice']->value;?>
</h3>
                <p id="greske"><?php echo $_smarty_tpl->tpl_vars['greska']->value;?>
</p>
                <br>
                <form id="nova_vijest" method="post" name="forma_vijest" action="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
" enctype="multipart/form-data" novalidate>
                    <label for="kategorija">Kategorija*</label><br>
                    <select id="kategorija" name="kategorija">
                        <option value="0">Odaberite</option>
                    </select><br>
                    <br>
                    <label for="naslov">Naslov*</label><br>
                    <input type="text" id="naslov" name="naslov" value="<?php echo $_smarty_tpl->tpl_vars['naslov']->value;?>
"><br>
                    <br>
                    <label for="autor">Autor*</label><br>
                    <input type="text" id="autor" name="autor" value="<?php echo $_smarty_tpl->tpl_vars['autor']->value;?>
"><br>
                    <br>
                    <label for="clanak">Clanak*</label><br>
                    <textarea id="clanak" rows="15" cols="30" name="clanak" placeholder="Vijest ..."><?php echo $_smarty_tpl->tpl_vars['clanak']->value;?>
</textarea><br>
                    <br>
                    <label for="izvor">Izvor</label><br>
                    <input type="text" id="izvor" name="izvor" placeholder="www.google.com" value="<?php echo $_smarty_tpl->tpl_vars['izvor']->value;?>
"><br>
                    <br>
                    <label for="slika">Slika*</label><br>
                    <input type="file" id="slika" name="slika"><br>
                    <br>
                    <label for="medij">Video/audio</label><br>
                    <input type="file" id="medij" name="medij"><br>
                    <br>
                    <input type="submit" id="<?php echo $_smarty_tpl->tpl_vars['gumbID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['gumbTekst']->value;?>
">
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


<?php }
}
