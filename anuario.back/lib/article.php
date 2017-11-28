<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET['id']) || empty($_GET['type'])){
        die("No data sent");
    }

    require_once 'connection.php';
    $db     = new DBConnection();

    switch($_GET['type']){
        case 'autor':
            $sql = "select * from cavelier_autores where id = :id";
            break;
        case 'artículo':
            $sql = "SELECT
                        an.ID,
                        an.ANUARIO,
                        au.AUTOR,
                        an.ARTICULO,
                        an.UBICACION
                    FROM
                        cavelier_anuarios an
                    INNER JOIN cavelier_autores au ON
                        an.AUTOR = au.ID
                    WHERE
                        an.id = :id";
            break;
    }

    $id     = array(
        ':id' => $_GET['id'],
    );
    $result = DBConnection::prepared_query($sql, $id);
    $result = $result[0];
    $result['UBICACION'] = empty($result['UBICACION'])? 'No hay anexo disponible'
    : '<a href="http://anuariocdi.org' . $result['UBICACION'] . '"><img src="../Imagenes/PDFDownload.gif" border="0"></a>';
?>

<html>
    <head>
        <title>Ficha</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/main.css" rel="stylesheet" type="text/css">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>
    <body style="margin:0; padding:0;">
        <img src="../Imagenes/top.gif" longdesc="top.gif" width="1000" height="100" align="rigth">
        <table class="table table-sm results" border="1" cellspacing="0" width="750">
            <?php
            if(empty($result['ARTICULO'])){
            ?>
                <tr><th valign="top">Autor:</th><td><?php echo $result['AUTOR']; ?></td></tr>
                <tr><th valign="top">País:</th><td><?php echo $result['PAIS']; ?></td></tr>
                <tr><th valign="top">Anexos:</th>
                    <td>
                        <?php echo $result['UBICACION']; ?>
            	    </td>
                </tr>
            <?php
            }
            else {
            ?>
                <tr><th valign="top">Anuario:</th><td><?php echo $result['ANUARIO']; ?></td></tr>
                <tr><th valign="top">Autor:</th><td><?php echo $result['AUTOR']; ?></td></tr>
                <tr><th valign="top">Artículo:</th><td><?php echo $result['ARTICULO']; ?></td></tr>
                <tr><th valign="top">Anexos:</th>
                    <td>
                        <?php echo $result['UBICACION']; ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>
