<?php
/* Smarty version 4.0.0, created on 2022-06-11 18:11:52
  from 'C:\xampp\htdocs\WebDiP_Projekt\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a4bec802a5f6_41985917',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c7029a75d0fc29e32efae6b949f1649d2974ce7e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\index.tpl',
      1 => 1654963686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a4bec802a5f6_41985917 (Smarty_Internal_Template $_smarty_tpl) {
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
        <?php echo $_smarty_tpl->tpl_vars['uvjeti_koristenja']->value;?>

        <header>
            <h1>Provjera informacija</h1>
            <nav>
                <ul>
                    <a href="./index.php"><li class="aktivan">Početna</li></a>
                    <li>Link 2</li>
                    <li>Link 3</li>
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
                <label for="sort">Sortirajte po: </label>
                <select id="sort" name="sort">
                    <option value="odaberite" selected>Odaberite</option>
                    <option value="kategorija_id">Kategorija</option>
                    <option value="broj_pregleda;ASC">Broj pregleda - rastući</option>
                    <option value="broj_pregleda;DESC">Broj pregleda - padajući</option>
                </select><br><br>
                <label for="tagoviFilter">Filtrirajte po: </label>
                <input type="text" id="tagoviFilter" name="tagoviFilter" placeholder="svijet,vijesti,...">
                <br><br>
                <label for="razdoblje_od">Rang lista vijesti od: </label>
                <input type="text" id="razdoblje_od" name="razdoblje_od" placeholder="yyyy-mm-dd" style="width: 25%">
                <label for="razdoblje_do">do: </label>
                <input type="text" id="razdoblje_do" name="razdoblje_do" placeholder="yyyy-mm-dd" style="width: 25%">
                <br><br>
                <button class="gumb" id="resetGumb">Reset</button>
            </div>
            <div id="vijest"></div>
            
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
