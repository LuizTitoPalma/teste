<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Author" content="Luiz Tito Palma | tito@projetoecriacao.com.br">
        <meta name="Keywords" content="Form Lib Functions">
        <meta name="Description" content="Biblioteca de funções">
        <meta name="robots" content="index, follow">

        <style>
            .msg_erro {
                outline: none; 
                text-align: left;
                font-weight: normal;
                color: #ff0000;
                text-decoration: none;
            }
        </style>

        <script src="ltpform.js?<?php echo filemtime('ltpform.js'); ?>"></script>

        <title>Formulário de teste</title>
    </head>
    <body>
        <?php
        include_once ('db.php');
        $db_util = new db_util ();

        //$list = $db_util->lista_user_email("' OR '1'='1"); 
        $list = $db_util->lista_user_email("tito@alcateiaweb.com.br"); 
        
        if (!empty($list)) {
            $html = "<table border=1>";
            foreach ($list as $rs) {
                $html .= '<tr>';
                $html .= '<td>' . $rs ['nome'] . '</td>';
                $html .= '<td>' . $rs ['email'] . '</td>';
                $html .= '<td>' . $rs ['fone1'] . '</td>';
                $html .= '<td>' . $rs ['fone2'] . '</td>';
                $html .= '<td>' . $rs ['fone3'] . '</td>';
                $html .= '<td>' . $rs ['cep'] . '</td>';
                $html .= '<td>' . $rs ['endereco'] . '</td>';
                $html .= '<td>' . $rs ['num_comp'] . '</td>';
                $html .= '<td>' . $rs ['local'] . '</td>';
                $html .= '</tr>';
            }
            $html .= "</table>";
            echo $html;
        }
        ?>
    </body>
</html>