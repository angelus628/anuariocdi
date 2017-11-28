<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^E_WARNING);

    class Search {
        const FILE = 'result_general.html';

        public static function general_search($post){
            $post       = trim($post);
            $db         = new DBConnection();
            $query      = "%{$post}%";

            $sql  = "select id, temas, 'ficha' as type from cavelier_ficha where upper(temas) like :param1 ";
            $sql .= "or upper(organismo) like :param2 or upper(tipo) like :param3 ";
            $sql .= "or upper(numero) like :param4 or upper(ponente) like :param5 ";
            $sql .= "or upper(partes) like :param6 or upper(hechos) like :param7 ";
            $sql .= "or upper(tesis) like :param8 or upper(decisiones) like :param9 ";
            $sql .= "union all ";
            $sql .= "select id, AUTOR as temas, 'autor' as type ";
            $sql .= "from cavelier_autores ";
            $sql .= "where upper(AUTOR) like :autor order by id";

            $params = array(
                ':param1'   => strtoupper($query),
                ':param2'   => strtoupper($query),
                ':param3'   => strtoupper($query),
                ':param4'   => strtoupper($query),
                ':param5'   => strtoupper($query),
                ':param6'   => strtoupper($query),
                ':param7'   => strtoupper($query),
                ':param8'   => strtoupper($query),
                ':param9'   => strtoupper($query),
                ':autor'    => strtoupper($query),
                #':articulo' => strtoupper($query),
            );

            $result = DBConnection::prepared_query($sql, $params);

            $sql  = "select id, ARTICULO as temas, 'artículo' as type ";
            $sql .= "from cavelier_anuarios ";
            $sql .= "where upper(ARTICULO) like :articulo ";
            $sql .= "order by id";

            $params = array(
                ':articulo' => strtoupper($query),
            );

            $articles = DBConnection::prepared_query($sql, $params);

            if(!is_array($result) && is_array($articles))
                $result = $articles;
            elseif(is_array($result) && is_array($articles))
                $result = array_merge($result, $articles);

            $hfile = fopen(self::FILE, 'w');

            fwrite($hfile, '<html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link href="../css/main.css" rel="stylesheet" type="text/css">
                <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
            </head>
            <body style="padding-top:18px;">
                <table class="table table-sm results">
                    <thead class="thead-grey">
                        <tr>
                            <th colspan="4">Resultados de la búsqueda</th>
                        </tr>
                    </thead>
                    <tbody>');

            if(!$result || !is_array($result)){
                fwrite($hfile, '<tr>
                    <td colspan="4">No se encontraron datos con el valor dado</td>
                </tr>');
                $close  = self::crawl($post);
                $close .= '</tbody>
                </table>
                    <script src="../js/jquery.js"></script>
                    <script src="../js/main.js"></script>
                </body>
                </html>';
                fwrite($hfile, $close);
                fclose($hfile);

                echo self::FILE;
                exit();
            }

            foreach($result as $index => $record){
                $record['temas'] = self::transform($record['temas'], $post);

                if($record['type'] == 'ficha'){
                    $tr = '<tr>
                        <td>' . ($index+1) . '</td>
                        <td>' . $record['type'] . '</td>
                        <td>' . $record['temas'] . '</td>
                        <td><a href="token.php?id=' . $record['id'] .'" target="_blank">[Ver ficha]</a></td>
                    </tr>';
                }
                else {
                    $url = 'article.php?' . http_build_query(array(
                        'id'   => $record['id'],
                        'type' => $record['type'],
                    ));
                    $tr = '<tr>
                        <td>' . ($index+1) . '</td>
                        <td>' . $record['type'] . '</td>
                        <td>' . $record['temas'] . '</td>
                        <td>
                            <a href="' . $url . '" target="_blank">[Ver ' . $record['type'] . ']</a>
                        </td>
                    </tr>';
                }

                fwrite($hfile, $tr);
            }

            $close  = self::crawl($post);
            $close .= '</tbody>
            </table>
                <script src="../js/jquery.js"></script>
                <script src="../js/main.js"></script>
            </body>
            </html>';
            fwrite($hfile, $close);
            fclose($hfile);

            echo self::FILE;
            exit();
        }

        private static function transform($frase, $query){
            return preg_replace("/($query)/i", '<strong><em>$1</em></strong>', $frase);
        }

        public static function organization_themes($organization, $year){
            $db  = new DBConnection();
            $sql = "SELECT DISTINCT
                        id,
                        fecha,
                        temas
                    FROM
                        cavelier_ficha
                    WHERE
                        organismo LIKE :organization
                        AND EXTRACT(YEAR FROM fecha) = :year
                    ORDER BY
                        fecha
                    DESC";
            $params = array(
                ':organization' => "%{$organization}%",
                ':year'         => $year,
            );

            $aResult = DBConnection::prepared_query($sql, $params);

            if(!is_array($aResult)){
                echo json_encode($aResult);
                exit();
            }

            $hfile = fopen(self::FILE, 'w');

            fwrite($hfile, '<html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link href="../css/main.css" rel="stylesheet" type="text/css">
                <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
            </head>
            <body style="padding-top:18px;">
                <table class="table table-sm results">
                    <thead class="thead-grey">
                        <tr>
                            <th colspan="4">Resultados para: ' . $organization . ', ' . $year . '</th>
                        </tr>
                    </thead>
                    <tbody>');

            if(!$aResult || !is_array($aResult)){
                fwrite($hfile, '<tr>
                    <td colspan="4">No se encontraron datos con el valor dado</td>
                </tr>');
                fwrite($hfile, "</tbody>
                </table>
                </body>
                </html>");
                fclose($hfile);

                echo self::FILE;
                exit();
            }

            foreach($aResult as $index => $theme){
                fwrite($hfile, '<tr>
                    <td>' . ($index+1) . '</td>
                    <td>' . $theme['fecha'] . '</td>
                    <td>' . $theme['temas'] . '</td>
                    <td><a href="token.php?id=' . $theme['id'] .'" target="_blank">[Ver ficha]</a></td>
                </tr>');
            }
            fwrite($hfile, "</tbody>
            </table>
            </body>
            </html>");
            fclose($hfile);

            echo self::FILE;
            exit();
        }

        public static function crawl($query){
            $crawl = new Crawl();
            $finds = $crawl->startCrawl($query);

            $tr = '<thead class="thead-grey">
                <tr>
                    <th colspan="2">Tipo</th>
                    <th>No. Coincidencias</th>
                    <th>Enlace</th>
                </tr>
            </thead>';
            if(!isset($finds[0]['records']) || $finds[0]['records'] == 0){
                $tr .= '<tr><td colspan="4">No hay resultados en las páginas.</td></tr>';
                return $tr;
            }

            foreach($finds as $index => $page){
                $tr .= '<tr>
                    <td colspan="2">Página</td>
                    <td>Hay ' . $page['records'] . ' coincidencias en: ' . $page['page'] . '</td>
                    <td>
                        <a class="page-find-results" data-url="' . $page['page'] . '" href="#">[Ver página]</a>
                    </td>
                </tr>';
            }

            return $tr;
        }
    }

    /**
    * Logica que instancia la clase de Busqueda
    *
    **/

    if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
        require_once 'connection.php';
        require_once 'crawler.php';

        #Realiza una busqueda general en las tablas del anuario
        if(!empty($_POST['general-search'])){
            $query = $_POST['general-search'];
            Search::general_search($query);
        }

        #Carga las diferentes organizaciones que aparecen el selectro
        if(!empty($_POST['organizations'])){
            $db     = new DBConnection();
            $result = DBConnection::query('SELECT DISTINCT organismo FROM cavelier_ficha ORDER BY organismo');

            if(!is_array($result)){
                echo json_encode($result);
                exit();
            }

            $organizations = array();
            foreach($result as $index => $organization){
                $organizations[] = $organization['organismo'];
            }

            echo json_encode($organizations);
            exit();
        }

        #Obtiene los anios disponibles para cada organizacion
        if(!empty($_POST['organization'])){
            $db = new DBConnection();
            $sql = "SELECT DISTINCT
                        EXTRACT(YEAR FROM fecha) as anio
                    FROM
                        cavelier_ficha
                    WHERE
                        organismo LIKE :organization
                    ORDER BY
                        fecha
                    DESC";
            $params = array(
                ':organization' => "%{$_POST['organization']}%",
            );

            $aYears = DBConnection::prepared_query($sql, $params);

            if(!is_array($aYears)){
                echo json_encode($aYears);
                exit();
            }

            $years = array();
            foreach($aYears as $index => $year){
                $years[] = $year['anio'];
            }

            echo json_encode($years);
            exit();
        }

        #Obtiene los datos por observatorios y anio
        if(!empty($_POST['Organismo']) && !empty($_POST['anio'])){
            Search::organization_themes($_POST['Organismo'], $_POST['anio']);
        }
    }

    die("No data sent");
