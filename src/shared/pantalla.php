<?php
class pantalla
{
  protected function cabeceraShow($titulo)
  {
?>
    <html>

    <head>
      <link rel="stylesheet" href="/assets/styles.css">
      <title><?php echo $titulo; ?></title>
    </head>

    <body>
      <hr>
    <?php
  }
  protected function pieShow()
  {
    ?>
      <hr>

  <?php
  }
}
  ?>