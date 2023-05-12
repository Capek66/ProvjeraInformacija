<?php
/* Smarty version 4.0.0, created on 2022-06-13 11:44:52
  from '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/blokirajKorisnika.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a70714d0d629_19595686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1d9e830219a2f0279d0e16c5fb35ad809429d0a' => 
    array (
      0 => '/var/www/webdip.barka.foi.hr/2021_projekti/WebDiP2021x017/blokirajKorisnika.tpl',
      1 => 1655105862,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a70714d0d629_19595686 (Smarty_Internal_Template $_smarty_tpl) {
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
            <span><a href="<?php echo $_smarty_tpl->tpl_vars['natrag']->value;?>
" class="natrag">Natrag</a></span>
            <div id="h3Centar">
                <h3>Blokiranje korisnika</h3>
            </div>
            <div class="forma formaRec">
                <p id="greskaBlock"><?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
</p>
                <form id="blokiranjeKorisnika" method="post" name="forma_blokiraj" action="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
" novalidate>
                    <input type="hidden" name="kategorija_id" value="<?php echo $_smarty_tpl->tpl_vars['kategorija_id']->value;?>
">
                    <input type="hidden" name="autor_id" value="<?php echo $_smarty_tpl->tpl_vars['autor_id']->value;?>
">
                    <label for="razlog">Razlog</label><br>
                    <textarea id="razlogBlok" name="razlog" rows="15" cols="20" placeholder="Razlog blokiranja ..."><?php echo $_smarty_tpl->tpl_vars['razlog']->value;?>
</textarea>
                    <br><br>
                    <label for="blokiran_do">Blokiraj do</label><br>
                    <input type="text" id="blokiran_do" name="blokiran_do" placeholder="yyyy-mm-dd hh:mm:ss" value="<?php echo $_smarty_tpl->tpl_vars['dodatuma']->value;?>
">
                    <br><br>
                    <input type="submit" id="blokirajSubmit" value="<?php echo $_smarty_tpl->tpl_vars['gumbTekst']->value;?>
">
                </form>
                <hr <?php echo $_smarty_tpl->tpl_vars['deblokiraj']->value;?>
>
                <a href="<?php echo $_smarty_tpl->tpl_vars['deblokirajLink']->value;?>
"><button class='gumb' id="deblokiraj" <?php echo $_smarty_tpl->tpl_vars['deblokiraj']->value;?>
>Deblokiraj</button><a>
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
