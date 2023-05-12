<?php
/* Smarty version 4.0.0, created on 2022-06-13 10:28:38
  from '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/pregledDnevnika.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a6f536419067_44479921',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0b7ad14600bf426270092b26b847d7690eef2f0' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/pregledDnevnika.tpl',
      1 => 1655105865,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a6f536419067_44479921 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <label for="tipFilter">Filtrirajte po tipu: </label>
                <select id="tipFilter" name="tipFilter">
                    <option value="odaberite" selected>Odaberite</option>
                    <?php echo $_smarty_tpl->tpl_vars['tipFilter']->value;?>

                </select><br><br>
                <label for="korisniciFilter">Filtrirajte po korisnicima: </label>
                <select id="korisniciFilter" name="korisniciFilter">
                    <option value="odaberite" selected>Odaberite</option>
                    <?php echo $_smarty_tpl->tpl_vars['korisniciFilter']->value;?>

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

<?php }
}
