<?php
$organismos = array('asamblea general de las naciones unidas',
'conferencia de las naciones unidas sobre comercio y desarrollo- unctad',
'consejo de seguridad de las naciones unidas',
'consejo económico y social de las naciones unidas - ecosoc',
'comisión de derecho internacional',
'Organización de los Estados Americanos OEA - Asamblea General',
'Organización de los Estados Americanos OEA - Oficina de Derecho Internacional',
'Organización de Estados Americanos OEA - Consejo Permanente',
'organización de estados americanos%comité jurídico interamericano',
'Organización de Estados Americanos OEA - Comité Interamericano contra el Terrorismo CICTE',
'Comunidad Andina - CAN, El Consejo Andino de Ministros de Relaciones Exteriores',
'Comunidad Andina - CAN, La Comisión de la Comunidad Andina.',
'Comunidad Andina - CAN, La Secretaría General de la Comunidad Andina',
'comunidad andina%tribunal de justicia',
'comisión interamericana de derechos humanos',
'corte interamericana de derechos humanos',
'conferencia de derecho internacional privado de la haya',
'organización para la cooperación y el desarrollo económicos%ocde',
'organización mundial del comercio%omc',
'organización internacional del trabajo%oit',
'consejo de estado',
'corte constitucional de colombia',
'corte suprema de justicia',
'ministerio de comercio exterior de colombia',
'ministerio de comercio, industria y turismo',
'ministerio de relaciones exteriores de colombia',
'corte internacional de justicia',
'corte permanente de arbitraje - cpa',
'centro internacional de arreglo de diferencias relativas a inversiones%ciadi',
'corte penal internacional',
'tribunal especial para libano',
'tribunal extraordinario para camboya',
'tribunal internacional para el derecho del mar%tidm',
'tribunal penal internacional para la antigua yugoslavia - tpiy',
'tribunal penal internacional para ruanda - tpir',
'tribunal penal para sierra leona',
'mecanismo internacional residual para los tribunales penales');

require_once 'connection.php';
$db     = new DBConnection();
foreach($organismos as $org){
    $result = DBConnection::query("SELECT organismo FROM cavelier_ficha WHERE lower(organismo) like '%$org%'");
    if(isset($result[0]['organismo']))
        echo "<p>
            {$result[0]['organismo']}
        </p>";
    else {
        echo "<p>
            NO ENCONTRADO ****
        </p>";
    }
}
