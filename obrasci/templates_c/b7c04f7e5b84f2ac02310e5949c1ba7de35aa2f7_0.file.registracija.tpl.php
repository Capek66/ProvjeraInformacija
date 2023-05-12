<?php
/* Smarty version 4.0.0, created on 2022-06-13 00:44:12
  from 'C:\xampp\htdocs\WebDiP_Projekt\obrasci\registracija.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_62a66c3c6cb440_40731560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7c04f7e5b84f2ac02310e5949c1ba7de35aa2f7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\obrasci\\registracija.tpl',
      1 => 1655073601,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a66c3c6cb440_40731560 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="hr">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Dino Capek"/>
        <meta name="date.created" content="2022-05-30"/>
        <meta name="keywords" content="WebDiP, FOI, Projekt, Registracija"/>
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
        <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>
        <link rel="stylesheet" type="text/css" href="../css/dcapek.css" />
        <?php echo '<script'; ?>
 type="text/javascript" src="../js/dcapek.js"><?php echo '</script'; ?>
>
        <title>Provjera informacija</title>
    </head>
    <body>
        <header>
            <h1>Provjera informacija</h1>
            <nav>
                <ul>
                    <a href="../index.php"><li>Početna</li></a>
                    <a href="../oAutoru.php"><li>O Autoru</li></a>
                    <a href="../dokumentacija.php"><li>Dokumentacija</li></a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['navigacija_putanja']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['navigacija']->value;?>
</a>
                    <li class="menu" id="menuButton"><img src="../materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./registracija.php"><li class="aktivan">Registracija</li></a>
                        <?php echo $_smarty_tpl->tpl_vars['nav']->value;?>

                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <h2><?php echo $_smarty_tpl->tpl_vars['naslov']->value;?>
</h2>
                <br>
                <h4 id="greska"><?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
</h4>
                <form id="registracija" method="post" name="forma_registracija" action="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['prikaz']->value;?>
 novalidate>
                        <label for="ime">Ime</label><br>
                        <input type="text" id="ime" name="ime" autofocus="autofocus" required="required" value="<?php echo $_smarty_tpl->tpl_vars['ime']->value;?>
"><br>
                        <br>
                        <label for="prezime">Prezime</label><br>
                        <input type="text" id="prezime" name="prezime" required="required" value="<?php echo $_smarty_tpl->tpl_vars['prezime']->value;?>
"><br>
                        <br>
                        <label for="korisnicko_ime">Korisničko ime</label><br>
                        <input type="text" id="korisnicko_ime" name="korisnicko_ime" maxlength="25" required="required" value="<?php echo $_smarty_tpl->tpl_vars['korisnicko_ime']->value;?>
"><br><span id="provjera"></span>
                        <br>
                        <label for="email">Email adresa</label><br>
                        <input type="email" id="email" name="email_adresa" placeholder="idap@foi.hr" required="required" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
"><br>
                        <br>
                        <label for="lozinka">Lozinka</label><br>
                        <input type="password" id="lozinka" name="lozinka" maxlength="50" required="required" value="<?php echo $_smarty_tpl->tpl_vars['lozinka']->value;?>
"><br>
                        <br>
                        <label for="lozinka2">Potvrda lozinke</label><br>
                        <input type="password" id="lozinka2" name="potvrda_lozinke" maxlength="50" required="required" value="<?php echo $_smarty_tpl->tpl_vars['potvrda_lozinke']->value;?>
"><br>
                        <br>
                        <div class="g-recaptcha recaptcha" data-sitekey="6LcPszwgAAAAALYD4-IoODNjv7e84R4qW3Bo9eJc"></div>
                        <br><br>
                        <input type="submit" id="registriraj" value="Registriraj se">
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
