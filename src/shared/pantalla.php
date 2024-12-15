<?php
    class pantalla
    {
        protected function cabeceraShow($titulo)
        {
            ?>
                <html>
                    <head>
                        <title><?php echo $titulo;?></title>
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