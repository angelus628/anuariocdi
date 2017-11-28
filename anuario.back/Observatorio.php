<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Observatorio</title>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />
<!--
<link href="css/observ.css" rel="stylesheet">
 -->
</head>

<body>
	<div class="modal fade" id="observatory-modal" tabindex="-1" role="dialog" aria-labelledby="smal-modal">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h6 class="modal-title" id="gridSystemModalLabel"></h6>
			     </div>
			    <div class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<table width="1000" cellspacing="0">
		<thead class="thead-grey">
			<tr>
		    	<th>Observatorio de Derecho Internacional</th>
			</tr>
		</thead>
	  	<tr>
			<td>
				<form class="form-inline" action="lib/search.php" method="post" name="observ-form" id="observ-form" title="Organismos">
					<div class="form-group"  style="width:60%;">
						<label for="Organismo">Organizaciones:</label>
						<select class="form-control" name="Organismo" size="1" id="Organismo" style="width:70%;">
						   <option value="1">Asamblea General de las Naciones Unidas</option>
						   <option value="2">Conferencia de las Naciones Unidas</option>
						   <option value="3">Consejo de Seguridad de las Naciones Unidas</option>
						   <option value="4">Consejo Económico y Social de las Naciones Unidas</option>
						   <option value="5">Corte Internacional de Justicia</option>
						   <option value="6">Corte Permanente de Arbitraje - CPA</option>
						   <option value="7">ONU, Consejo de Seguridad</option>
						   <option value="8">ONU, Comisión de Derecho Internacional</option>
						   <option value="9">Organización Internacional del Trabajo</option>
						</select>
					</div>
					<div class="form-group">
						<label for="anio">Año:</label>
						<select class="form-control" name="anio" size="1" id="anio">
							<option value="1">2008</option>
							<option value="2">2009</option>
							<option value="3">2010</option>
							<option value="4">2010 Especial</option>
							<option value="5">2011</option>
							<option value="6">2012</option>
							<option value="7">2013</option>
							<option value="8">2014</option>
							<option value="9">2015</option>
							<option value="10">2016</option>
						</select>
					</div>
					<button type="submit" class="btn btn-anuario" name="observ" id="observ">Buscar</button>
				</form>
			</td>
	  	</tr>
	</table>
	<img src="Imagenes/observatorio.png" width="999" height="1140" longdesc="observatorio.png" usemap="#observatory-img" />
	<map name="observatory-img" id="observatory-img">
		<!-- NACIONES UNIDAS -->
		<area class="graph-observ" data-organization="Asamblea General de las Naciones Unidas" shape="rect" coords="454,60,999,78" href="javascript:void(0);" alt="Asamblea General de las Naciones Unidas" title="Asamblea General de las Naciones Unidas" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Conferencia de las Naciones Unidas sobre comercio y desarrollo- UNCTAD" shape="rect" coords="454,78,999,96" href="javascript:void(0);" alt="Conferencia de las Naciones Unidas sobre Comercio y Desarrollo - UNCTAD" title="Conferencia de las Naciones Unidas sobre Comercio y Desarrollo - UNCTAD" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Consejo de Seguridad de las Naciones Unidas" shape="rect" coords="454,96,999,114" href="javascript:void(0);" alt="Consejo de Seguridad de las Naciones Unidas" title="Consejo de Seguridad de las Naciones Unidas" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Consejo Económico y Social de las Naciones Unidas - ECOSOC" shape="rect" coords="454,114,999,132" href="javascript:void(0);" alt="Consejo Económico y Social de las Naciones Unidas - ECOSOC" title="Consejo Económico y Social de las Naciones Unidas - ECOSOC" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización de Naciones Unidas - ONU, Comisión de Derecho Internacional" shape="rect" coords="454,132,999,150" href="javascript:void(0);" alt="Comisión de Derecho Internacional" title="Comisión de Derecho Internacional" data-toggle="modal" data-target="#observatory-modal" />
		<!-- ORGANIZACIONES REGIONALES Y DE INTEGRACIÓN LATINOAMERICANA -->
		<area class="graph-observ" data-organization="Organización de los Estados Americanos OEA - Asamblea General" shape="rect" coords="454,202,999,220" href="javascript:void(0);" alt="Organización de los Estados Americanos - Asamblea General" title="Organización de los Estados Americanos - Asamblea General" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización de los Estados Americanos OEA - Oficina de Derecho Internacional" shape="rect" coords="454,220,999,238" href="javascript:void(0);" alt="Organización de los Estados Americanos - Oficina de Derecho Internacional" title="Organización de los Estados Americanos - Oficina de Derecho Internacional" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización de Estados Americanos OEA - Consejo Permanente" shape="rect" coords="454,238,999,256" href="javascript:void(0);" alt="Organización de Estados Americanos - Consejo Permanente" title="Organización de Estados Americanos - Consejo Permanente" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización de Estados Americanos OEA -Comite Jurídico Interamericano" shape="rect" coords="454,256,999,274" href="javascript:void(0);" alt="Organización de Estados Americanos - Comité Jurídico Interamericano" title="Organización de Estados Americanos - Comité Jurídico Interamericano" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización de Estados Americanos OEA - Comité Interamericano contra el Terrorismo CICTE" shape="rect" coords="454,274,999,292" href="javascript:void(0);" alt="Organización de Estados Americanos - Comité Interamericano contra el Terrorismo - CICTE" title="Organización de Estados Americanos - Comité Interamericano contra el Terrorismo - CICTE" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Comunidad Andina - CAN, El Consejo Andino de Ministros de Relaciones Exteriores" shape="rect" coords="454,292,999,310" href="javascript:void(0);" alt="Comunidad Andina - El Consejo Andino de Ministros de Relaciones Exteriores" title="Comunidad Andina - El Consejo Andino de Ministros de Relaciones Exteriores" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Comunidad Andina - CAN, La Comisión de la Comunidad Andina." shape="rect" coords="454,310,999,328" href="javascript:void(0);" alt="Comunidad Andina - La Comisión de la Comunidad Andina" title="Comunidad Andina - La Comisión de la Comunidad Andina" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Comunidad Andina - CAN, La Secretaría General de la Comunidad Andina" shape="rect" coords="454,328,999,346" href="javascript:void(0);" alt="Comunidad Andina - La Secretaría General de la Comunidad Andina" title="Comunidad Andina - La Secretaría General de la Comunidad Andina" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Comunidad Andina - CAN, Tribunal de Justicia" shape="rect" coords="454,346,999,364" href="javascript:void(0);" alt="Comunidad Andina - Tribunal de Justicia" title="Comunidad Andina - Tribunal de Justicia" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Comision Interamericana de Derechos Humanos" shape="rect" coords="454,364,999,382" href="javascript:void(0);" alt="Comisión Interamericana de Derechos Humanos" title="Comisión Interamericana de Derechos Humanos" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Corte Interamericana de Derechos Humanos" shape="rect" coords="454,382,999,402" href="javascript:void(0);" alt="Corte Interamericana de Derechos Humanos" title="Corte Interamericana de Derechos Humanos" data-toggle="modal" data-target="#observatory-modal" />
		<!-- DERECHO INTERNACIONAL PRIVADO Y DERECHO INTERNACIONAL ECONÓMICO -->
		<area class="graph-observ" data-organization="Conferencia de Derecho Internacional Privado de la Haya" shape="rect" coords="454,469,999,487" href="javascript:void(0);" alt="Conferencia de Derecho Internacional Privado de la Haya" title="Conferencia de Derecho Internacional Privado de la Haya" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización para la Cooperación y el Desarrollo Económicos OCDE" shape="rect" coords="454,487,999,505" href="javascript:void(0);" alt="Organización para la Cooperación y el Desarrollo Económicos - OCDE" title="Organización para la Cooperación y el Desarrollo Económicos - OCDE" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organización Mundial del Comercio OMC" shape="rect" coords="454,505,999,523" href="javascript:void(0);" alt="Organización Mundial del Comercio - OMC" title="Organización Mundial del Comercio - OMC" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Organizacion Internacional del Trabajo-OIT" shape="rect" coords="454,523,999,542" href="javascript:void(0);" alt="Organización Internacional del Trabajo - OIT" title="Organización Internacional del Trabajo - OIT" data-toggle="modal" data-target="#observatory-modal" />
		<!-- VACÍO -->
		<area class="graph-observ" data-organization="Consejo de Estado" shape="rect" coords="454,626,999,644" href="javascript:void(0);" alt="Consejo de Estado" title="Consejo de Estado" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Corte Constitucional de Colombia" shape="rect" coords="454,644,999,662" href="javascript:void(0);" alt="Corte Constitucional de Colombia" title="Corte Constitucional de Colombia" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Corte Suprema de Justicia" shape="rect" coords="454,662,999,680" href="javascript:void(0);" alt="Corte Suprema de Justicia" title="Corte Suprema de Justicia" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Ministerio de Comercio Exterior de Colombia" shape="rect" coords="454,680,999,698" href="javascript:void(0);" alt="Ministerio de Comercio Exterior de Colombia" title="Ministerio de Comercio Exterior de Colombia" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Ministerio de Comercio, Industria y Turismo" shape="rect" coords="454,698,999,716" href="javascript:void(0);" alt="Ministerio de Comercio, Industria y Turismo" title="Ministerio de Comercio, Industria y Turismo" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Ministerio de Relaciones Exteriores de Colombia" shape="rect" coords="454,716,999,735" href="javascript:void(0);" alt="Ministerio de Relaciones Exteriores de Colombia" title="Ministerio de Relaciones Exteriores de Colombia" data-toggle="modal" data-target="#observatory-modal" />
		<!-- DERECHO INTERNACIONAL PÚBLICO -->
		<area class="graph-observ" data-organization="Corte Internacional de Justicia" shape="rect" coords="454,835,999,853" href="javascript:void(0);" alt="Corte Internacional de Justicia" title="Corte Internacional de Justicia" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Corte Permanente de Arbitraje - CPA" shape="rect" coords="454,853,999,871" href="javascript:void(0);" alt="Corte Permanente de Arbitraje - CPA" title="Corte Permanente de Arbitraje - CPA" data-toggle="modal" data-target="#observatory-modal" />
		<!-- ARBITRAJE INTERNACIONAL DE INVERSIÓN -->
		<area class="graph-observ" data-organization="Centro Internacional de arreglo de diferencias relativas a inversiones -CIADI" shape="rect" coords="454,938,999,958" href="javascript:void(0);" alt="Centro Internacional de Arreglo de Diferencias Relativas a Inversiones - CIADI" title="Centro Internacional de Arreglo de Diferencias Relativas a Inversiones - CIADI" data-toggle="modal" data-target="#observatory-modal" />
		<!-- DERECHO PENAL INTERNACIONAL -->
		<area class="graph-observ" data-organization="Corte Penal Internacional" shape="rect" coords="454,995,999,1013" href="javascript:void(0);" alt="Corte Penal Internacional" title="Corte Penal Internacional" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal Especial para Libano" shape="rect" coords="454,1013,999,1031" href="javascript:void(0);" alt="Tribunal Especial para Libano" title="Tribunal Especial para Libano" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal Extraordinario para Camboya" shape="rect" coords="454,1031,999,1049" href="javascript:void(0);" alt="Tribunal Extraordinario para Camboya" title="Tribunal Extraordinario para Camboya" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal Internacional para el Derecho del Mar- TIDM" shape="rect" coords="454,1049,999,1067" href="javascript:void(0);" alt="Tribunal Internacional para el Derecho del Mar - TIDM" title="Tribunal Internacional para el Derecho del Mar - TIDM" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal Penal Internacional para la Antigua Yugoslavia - TPIY" shape="rect" coords="454,1067,999,1085" href="javascript:void(0);" alt="Tribunal Penal Internacional para la Antigua Yugoslavia - TPIY" title="Tribunal Penal Internacional para la Antigua Yugoslavia - TPIY" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal penal Internacional para Ruanda - TPIR" shape="rect" coords="454,1085,999,1103" href="javascript:void(0);" alt="Tribunal Penal Internacional para Ruanda - TPIR" title="Tribunal Penal Internacional para Ruanda - TPIR" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Tribunal Penal para Sierra Leona" shape="rect" coords="454,1103,999,1121" href="javascript:void(0);" alt="Tribunal Penal para Sierra Leona" title="Tribunal Penal para Sierra Leona" data-toggle="modal" data-target="#observatory-modal" />
		<area class="graph-observ" data-organization="Mecanismo Internacional Residual para los Tribunales Penales " shape="rect" coords="454,1121,999,1139" href="javascript:void(0);" alt="Mecanismo Internacional Residual para los Tribunales Penales" title="Mecanismo Internacional Residual para los Tribunales Penales" data-toggle="modal" data-target="#observatory-modal" />
	</map>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
