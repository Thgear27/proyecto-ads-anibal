<?php
class pantalla
{
  protected function cabeceraShow($titulo, $javasctiptUrl = "")
  {
?>
    <html>

    <head>
      <!-- Import javasctipUrl -->
      <?php
      if ($javasctiptUrl != "") {
        echo "<script src='$javasctiptUrl' defer></script>";
      }
      ?>
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