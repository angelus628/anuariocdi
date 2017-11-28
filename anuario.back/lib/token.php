<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    if($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET['id'])){
        die("No data sent");
    }

    require_once 'connection.php';
    $db     = new DBConnection();

    $sql    = "select * from cavelier_ficha where id = :id";
    $id     = array(
        ':id' => $_GET['id'],
    );
    $result = DBConnection::prepared_query($sql, $id);
    $result = $result[0];

    if(empty($result['fuente'])){
        $url = '';
    }
    else {
        $comp = parse_url($result['fuente']);
        $url  = empty($comp['scheme'])? '' : $comp['scheme'] . '://';
        $url .= empty($comp['host'])? '' : $comp['host'];
    }

    $result['anexo']  = empty($result['anexo'])? 'No hay anexo disponible' : '<a href="../pdf/' . $result['anexo'] . '"><img src="../Imagenes/PDFDownload.gif" border="0"></a>';
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
            <tr><th valign="top">Tema:</th><td><?php echo $result['temas']; ?></td></tr>
            <tr><th valign="top">Organismo/Entidad:</th><td><?php echo $result['organismo']; ?></td></tr>
            <tr><th valign="top">Fecha:</th><td><?php echo $result['fecha']; ?></td></tr>
            <tr><th valign="top">Tipo de documento:</th><td><?php echo $result['tipo']; ?></td></tr>
            <tr><th valign="top">N&uacute;mero:</th><td><?php echo $result['numero']; ?></td></tr>
            <tr><th valign="top">Ponente:</th><td><?php echo $result['ponente']; ?></td></tr>
            <tr><th valign="top">Partes:</th><td><?php echo $result['partes']; ?></td></tr>
            <tr><th valign="top">Hechos/Antecendentes:</th><td><?php echo $result['hechos']; ?></td></tr>
            <tr><th valign="top">Tesis Principal y Secundarias:</th><td><?php echo $result['tesis']; ?></td></tr>
            <tr><th valign="top">Decisi&oacute;n:</th><td><?php echo $result['decisiones']; ?></td></tr>
            <tr><th valign="top">Fuente:</th><td><a href="<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></td></tr>
            <tr><th valign="top">Anexos:</th>
                <td>
                    <?php echo $result['anexo']; ?>
        	    </td>
            </tr>
        </table>
    </body>
</html>
