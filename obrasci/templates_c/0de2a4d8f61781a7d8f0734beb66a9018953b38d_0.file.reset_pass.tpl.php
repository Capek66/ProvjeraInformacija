<?php
/* Smarty version 4.0.0, created on 2022-06-03 12:16:41
  from 'C:\xampp\htdocs\WebDiP_Projekt\obrasci\reset_pass.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_6299df897a4088_40899266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0de2a4d8f61781a7d8f0734beb66a9018953b38d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\WebDiP_Projekt\\obrasci\\reset_pass.tpl',
      1 => 1654250874,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6299df897a4088_40899266 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <li>Link 2</li>
                    <li>Link 3</li>
                    <a href="./prijava.php"><li>Prijavi se</li></a>
                    <li class="menu" id="menuButton"><img src="../materijali/icons-menu.png" alt="Menu Icon" height="20px" width="auto"></li>
                </ul>
                <div class="izbornik" id="hidden">
                    <ul>
                        <a href="./registracija.php"><li>Registracija</li></a>
                        <li>Link 2</li>
                        <li>Link 3</li>
                        <li>Link 4</li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="forma">
                <h2>Zaboravljena lozinka</h2>
                <br>
                <h4><?php echo $_smarty_tpl->tpl_vars['poruka']->value;?>
</h4>
                <form id="reset" method="post" name="forma_reset" action="<?php echo $_smarty_tpl->tpl_vars['putanja']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['prikaz']->value;?>
 novalidate>
                        <label for="lozinka">Lozinka</label><br>
                        <input type="password" id="lozinka" name="lozinka" maxlength="50" required="required"><br>
                        <br>
                        <label for="lozinka">Ponovite lozinku</label><br>
                        <input type="password" id="lozinka2" name="ponovljena_lozinka" maxlength="50" required="required"><br>

                        <br><br>
                        <input type="submit" id="promijeni" value="Promijeni lozinku">
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
