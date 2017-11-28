<?php

if (!defined('MAIN'))

        die ("<i>Unauthorized Access</i>");



//Constants

$SITE_ROOT 		= "http://204.12.4.183";



//Library



class DBConnection {



  private $host = "204.12.14.92";

  private $user = "anuariocdior";

  private $pass = "Np849376";

  private $keyWord;

  private $resultSet;

  private $link;



  public function __construct(){

    $this->makeConnection();

  }

  

  public function getLink(){

    return $this->link;

  }

  

  public function getResultSet(){

    return $this->resultSet;

  }

  

  public function getResultSetFrom($sql){

  	return mysql_query($sql, $this->getLink());

  }  

  

  

  public function makeConnection(){

    $this->link = @mysql_connect($this->host, $this->user, $this->pass);

      if (!$this->link) {

        die('Could not connect: ' . mysql_error());

      }

      mysql_select_db('anuariocdior', $this->link);

  }

 

  public function processInsert($sql, $message){

  	mysql_query($sql, $this->getLink());

	 if (mysql_affected_rows($this->getLink()) == 1){

	 	echo '<center><div class="message"><h3>' . $message . '</h3></div></center>';

	 }else{

	 	echo '<center><div class="error"><h3>Error al procesar la solicitud</h3></div></center>';

		die();

	 }

	}

	

  public function processQuery($sql){

  	mysql_query($sql, $this->getLink());

  }

    

  public function setKeyword($keyWord){

    $this->keyWord = $keyWord;

  }

  

  public function getKeyword(){

    return $this->keyWord;

  }

  

  public function processSimpleQuery(){

    $sql = "SELECT distinct id, temas FROM cavelier_ficha WHERE temas like '%".$this->getKeyword()."%' " 

    . "or organismo like '%".$this->getKeyword()."%' or tipo like '%".$this->getKeyword()."%' "

    . "or numero like '%".$this->getKeyword()."%' or  ponente like '%".$this->getKeyword()."%' "

    . "or partes like '%".$this->getKeyword()."%' or hechos like '%".$this->getKeyword()."%' "

    . "or tesis like '%".$this->getKeyword()."%' or decisiones like '%".$this->getKeyword()."%' "

    . "or fuente like '%".$this->getKeyword()."%' or anexo like '%".$this->getKeyword()."%' order by id";

    $this->resultSet = mysql_query($sql, $this->getLink());

  }


  public function ObtieneOrganismos(){

    $sql = "SELECT distinct organismo FROM cavelier_ficha";
    return mysql_query($sql, $this->getLink());

  }
  

  public function processOrganismoQuery($year){

  //ausmerley
		$sql = "SELECT distinct id, fecha, temas FROM cavelier_ficha WHERE organismo  = '".$this->getKeyword()."' and fecha like '".$year."%' order by fecha desc";

	$this->resultSet = mysql_query($sql, $this->getLink());

  }

  

  public function processOrganismoResult(){

  	$num_rows =  mysql_num_rows($this->resultSet);

	if ($num_rows > 0){

		echo "<ol>";

		for ($i = 0; $i<$num_rows; $i++){

	        $row = mysql_fetch_array($this->resultSet, MYSQL_ASSOC);

			echo '<li>'.$row['fecha'].' '.$row['temas'].' ';

			echo '<a href="ficha.php?vf='.$row['id'].'" target="_blank"><small>[Ver ficha]</small></a></li>';

		}

		echo "</ol>";

	}

  }

  

  public function processAdvancedQuery($sql){

       $this->resultSet = mysql_query($sql, $this->getLink());

   }

  

  public function processResult(){

	$num_rows =  mysql_num_rows($this->resultSet);

	  if ($num_rows > 0){

	  	  // add to autocompletion list

		  @mysql_query("insert into cavelier_consultas values ('', '".$this->getKeyword()."')", $this->getLink());

		  // end of adding

		  echo '<h2>Resultados</h2>';	

	      echo '<table border="0" width="100%">';

		  echo '<tr><th colspan="3">Resultados de la b&uacute;squeda</th></tr>';

	      for ($i = 0; $i<$num_rows; $i++){

	        $row = mysql_fetch_array($this->resultSet, MYSQL_ASSOC);

	        print '<tr><td valign="top">' . ($i+1) . '</td>' . '<td>' . $row['temas'] . '</td><td valign="top">'.

    	    '<a href="ficha.php?vf='.$row['id'].'" target="_blank">[Ver ficha]</a>'.

	        '</td></tr>';

    	    print '<tr><td colspan="3"><hr noshade size="1" color="#762C1F"></td></tr>';

      	}

      echo '</table>';

	  }else{

	  	echo "<h2>No hubo resultados, intente con la siguiente opci&oacute;n</h2>";

		//include "adv.php";

		?>

                <h2>B&uacute;squeda Avanzada</h2>

        <div>

          Ingrese los criterios de b&uacute;squeda <strong>exacto o parcial</strong>

          <br />Especifique su b&uacute;squeda por las opciones indicadas o seleccione alguna otra opci&oacute;n

          <br />&nbsp;

        </div>

        <form name="bavanzada" action="resultados.php" method="get"> 

        <center>

<table border="0">

  <tr>

    <td><div align="right">Tema:</div></td>

    <td><input type="text" name="ab_tema" size="30"></td>

    </tr>

  <tr>

    <td><div align="right">Organismo/Entidad:</div></td>

    <td><input type="text" name="ab_organismo" size="30"></td>

    </tr>

  <tr>

    <td><div align="right">Fecha:</div></td>

    <td><input type="text" name="ab_fecha" size="30"></td>

    </tr>

  <tr>

    <td><div align="right">Tipo de Documento:</div></td>

    <td><input type="text" name="ab_tipo" size="30"></td>

    </tr>

  <tr>

    <td><div align="right">Otro:

      <select name="other">

            <option></option>

            <option value="numero">N&uacute;mero</option>

            <option value="ponente">Ponente</option>

            <option value="partes">Partes</option>

            <option value="hechos">Hechos/Antecedentes</option>

            <option value="tesis">Tesis Principal y Secundaria</option>

            <option value="decisiones">Decisi&oacute;n</option>

            <option value="fuente">Fuente</option>

          </select>

    </div></td>

    <td><input type="text" name="ab_value" size="30"></td>

    </tr>

  <tr>

    <td colspan="2"><div align="center">

      <input type="submit" name="buscar" value="B&uacute;squeda" />

    </div></td>

    </tr>

</table>

<input type="hidden" name="adv" value="true">

        </form>

        <?php

	  }

    }

	



	public function processOrganismosList(){

		$num_rows =  mysql_num_rows($this->resultSet);

		if ($num_rows > 0){

			print '<ol>';

			for ($i=0; $i<$num_rows; $i++)

			{

	        	$row = mysql_fetch_array($this->resultSet, MYSQL_ASSOC);

				print "<li>".$row['organismo']."</li>";

				print '<ol type="disc">';

				for ($j=(date("Y")-1); $j>=2007; $j--)

					print "<li onclick=menuRequest(".$i.".".$j.")><a href=#>".$j."</a></li>";

				print '</ol>';

			}//End for

			print '</ol>';

		}//End if

	}//End function

	

}//End class







class ValidateUser {

	

	public function getCorreoAdmin(){

	$sql = "select correo from cavelier_usuarios where uid = '1'";

		$db = new DBConnection();

		$db->processAdvancedQuery($sql);

		$result = $db->getResultSet();

		$row = mysql_fetch_array($result, MYSQL_ASSOC);

		return $row['correo'];

	}

	

	

	public function mailToCorreo(){

		return '<a href="mailto:'. $this->getCorreoAdmin() . '">Administrador</a>';

	}

	

	public function changeCorreo($newcorreo){

		$sql = "update cavelier_usuarios set correo = '".$newcorreo."' where uid = '1'";

		$db = new DBConnection();

		$db->processInsert($sql, "La direcci&oacute;n de correo electr&oacute;nico fue actualizada");

	}

	

	  public function validateAdmin($username, $password){

	  	$sql = "select uid from cavelier_usuarios where usuario = '".$username."' and contrasena = md5('".$password."') and activo = '1'";

		$db = new DBConnection();

		$db->processAdvancedQuery($sql);

		$result = $db->getResultSet();

		if (mysql_num_rows($result) > 0){

				$row = mysql_fetch_array($result, MYSQL_ASSOC);

				if ($row['uid'] == 1){

					$_SESSION['valid'] = "my@dmin";	

					return true;	

				}

			}

			return false;		

	  }

	  

	  public function changeAdminPassword($currentpass, $newpass){	  	

		$sql = "select count(*) as c from cavelier_usuarios where usuario = 'admin' and contrasena = md5('".$currentpass."')";

		$db = new DBConnection();

		$db->processAdvancedQuery($sql);

		$result = $db->getResultSet();

		$ok = false;

		if (mysql_num_rows($result) > 0){

				$row = mysql_fetch_array($result, MYSQL_ASSOC);

				if ($row['c'] == 1){

					$sql = "update cavelier_usuarios set contrasena = md5('".$newpass."') where usuario = 'admin'";

					$db->processQuery($sql);

					if (mysql_affected_rows($db->getLink()) == 1){

						echo '<h3>Contrase&ntilde;a de Administrador (admin) cambiada exitosamente</h3>';

						$ok = true;

					}

				}

		}

		if (!$ok)

			die('<font color="#FF0000"><h3>Error al intentar cambiar la contrase&ntilde;a del Administrador (admin)</h3></font>');

	  }



} // End class



class HtmlForms {





	public function changeEmail(){

	$o = new ValidateUser();

	?>

    	<form name="chcorreo" action="index.php" method="post">

     	<h3>Cuenta de correo electr&oacute;nico del Administrador</h3>

        <table border="0">

        <tr class="odd">

        <td>Cuenta de correo electr&oacute;nico:</td>

        <td><input type="text" name="correo" size="40" maxlength="255" value="<?php echo $o->getCorreoAdmin(); ?>" /></td>

        </tr>

        <tr class="even">

        <td colspan="2"><small>Esta direcci&oacute;n se utilizar&aacute; para informar al usuario sobre como contactar al Administrador en caso de error de validaci&oacute;n</small></td>

        </tr>

		<tr>

        <td colspan="2" align="center"><input type="submit" name="changeCorreo" value="Aceptar" />

        </td>

        </tr>        

        </table>

        <input type="hidden" name="correochange" value="1" />

        </form>

	<?php

	}

	public function changePassword(){

	?>

    	<form name="chpass" action="index.php" method="post" onsubmit="return checkPassFields(this)">

        <h3>Cambiar contrase&ntilde;a</h3>

        <table border="0">

        <tr class="odd">

        <td>Ingrese contrase&ntilde;a actual:</td>

        <td><input type="password" name="ccurrent" size="20" maxlength="12" /><small>Max: 12 caracteres</small></td>

        </tr>

        <tr class="even">

        <td>Ingrese nueva contrase&ntilde;a:</td>

        <td><input type="password" name="cnueva" size="20" maxlength="12" /><small>Max: 12 caracteres</small></td>

        </tr>

        <tr class="odd">

        <td>Confirme nueva contrase&ntilde;a:</td>

        <td><input type="password" name="cconf" size="20" maxlength="12" /><small>Max: 12 caracteres</small></td>

        </tr>

        <tr>

        <td colspan="2" align="center"><input type="submit" name="changePassws" value="Cambiar contrase&ntilde;a" />

        </td>

        </tr>        

        </table>

        <small><strong><i>Nota: Todos los campos son obligatorios</i></strong></small>

        <input type="hidden" name="passchange" value="1" />

        </form>

    <?php

	}

	

	public function addFicha($isadmin){

	

	?>

	<form enctype="multipart/form-data" name="ficha" action="index.php" method="post" onsubmit="return validateFicha(this);">

	<h3>Agregar Ficha</h3>

	<table border="0" cellpadding="2" cellspacing="0">

    <tr><td colspan="2">

    <sup>*<font size="2">Requeridos</font></sup>

    </td>

    </tr>

	<tr class="odd">

	<td>Tema:<sup>*</sup></td><td><textarea name="temas" rows="5" cols="40"></textarea></td>

	</tr>

	<tr class="even">

	<td>Organismo/Entidad:<sup>*</sup></td><td><select name="organismo" id="OrgId" style="visibility:visible">

        <option></option>

    <?php

		$tmp = new FichasPorOrganismo();

		$tmp->organismsToSelect();

	?>

    </select><br />

	<?php

	 if($isadmin == true)

	 {

	 	echo '<input type="checkbox" name="addnuevoorg" id="addNuevoOrgId" value="true" onclick="checkNewOrganismo(this)" />Agregar nuevo Organismo/Entidad?&nbsp;';

		echo '<input type="text" name="nuevoorg" id="nuevoOrgId" size="80" style="visibility:hidden" />';

	 }

	 ?>

	</td>

	</tr>

	<tr class="odd">

	<td>Fecha:<sup>*</sup></td><td><input type="text" name="fecha" size="20" maxlength="20" readonly="readonly">

	<script language="JavaScript">

	new tcal ({

		// form name

		'formname': 'ficha',

		// input name

		'controlname': 'fecha'

	});

	</script>

	</td>

	</tr>

    <tr class="even">

	<td>Tipo de documento:</td><td><input type="text" name="tipo" size="80" maxlength="255"></td>

	</tr>

    <tr class="odd">

	<td>N&uacute;mero:</td><td><input type="text" name="numero" size="80" maxlength="255"></td>

	</tr>

    <tr class="even">

	<td>Ponente:</td><td><textarea name="ponente" rows="5" cols="40"></textarea></td>

	</tr>

    <tr class="odd">

	<td>Partes:</td><td><textarea name="partes" rows="5" cols="40"></textarea></td>

	</tr>

    <tr class="even">

	<td>Hechos/Antecedentes:</td><td><textarea name="hechos" rows="5" cols="40"></textarea></td>

	</tr>

    <tr class="odd">

	<td>Tesis Principal y Secundarias:</td><td><textarea name="tesis" rows="5" cols="40"></textarea></td>

	</tr>

    <tr class="even">

	<td>Decisi&oacute;n:</td><td><textarea name="decisiones" rows="5" cols="40"></textarea></td>

	</tr>

    <tr class="odd">

	<td>Fuente:</td><td><input type="text" name="fuente" size="80" maxlength="255"><small>&nbsp;Ejemplo: http://www.un.org/es</small></td>

	</tr>

    <tr class="even">

	<td>Anexo:<sup>*</sup></td><td><input type="file" name="anexo" size="80" maxlength="255"></td>

	</tr>

	<tr>

	<td colspan="2" align="center"><input type="submit" value="Aceptar">&nbsp;<a href="javascript:history.go(-1);" style="text-decoration:none"><input type="button" value="Cancelar" /></a></td>

	</tr>	

	</table>

	<input type="hidden" name="toprocess" value="true">

	</form>

	<?php

	}

	

	public function updateFicha($id){

	$o = new DBConnection();

	$sql = "select * from cavelier_ficha where id = '". $id ."'";

	$result = $o->getResultSetFrom($sql);

	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	?>

	<form enctype="multipart/form-data" name="ficha" action="index.php" method="post" onsubmit="return validateUpdateFicha(this)">

	<h3>Editar Ficha</h3>

	<table border="0" cellpadding="2" cellspacing="0">

    <tr><td colspan="2">

    <sup>*<font size="2">Requeridos</font></sup>

    </td>

    </tr>

	<tr class="odd">

	<td>Tema:<sup>*</sup></td><td><textarea name="temas" rows="5" cols="40"><?php echo $row['temas']; ?></textarea></td>

	</tr>

	<tr class="even">

	<td>Organismo/Entidad:<sup>*</sup></td><td><select name="organismo" id="OrgId" style="visibility:visible">

        <option></option>

    <?php

		$tmp = new FichasPorOrganismo();

		$tmp->organismsSelected($row['organismo']);

	?>

    </select><br />

    <input type="checkbox" name="addnuevoorg" id="addNuevoOrgId" value="true" onclick="checkNewOrganismo(this)" />Agregar nuevo Organismo/Entidad?&nbsp;

	<input type="text" name="nuevoorg" id="nuevoOrgId" size="80" style="visibility:hidden" /></td>

	</tr>

	<tr class="odd">

	<td>Fecha:<sup>*</sup></td><td><input type="text" name="fecha" size="20" maxlength="20" readonly="readonly" value="<?php echo $row['fecha']; ?>">

	<script language="JavaScript">

	new tcal ({

		// form name

		'formname': 'ficha',

		// input name

		'controlname': 'fecha'

	});

	</script>

	</td>

	</tr>

    <tr class="even">

	<td>Tipo de documento:</td><td><input type="text" name="tipo" size="80" maxlength="255" value="<?php echo $row['tipo']; ?>"></td>

	</tr>

    <tr class="odd">

	<td>N&uacute;mero:</td><td><input type="text" name="numero" size="80" maxlength="255" value="<?php echo $row['numero']; ?>"></td>

	</tr>

    <tr class="even">

	<td>Ponente:</td><td><textarea name="ponente" rows="5" cols="40"><?php echo $row['ponente']; ?></textarea></td>

	</tr>

    <tr class="odd">

	<td>Partes:</td><td><textarea name="partes" rows="5" cols="40"><?php echo $row['partes']; ?></textarea></td>

	</tr>

    <tr class="even">

	<td>Hechos/Antecedentes:</td><td><textarea name="hechos" rows="5" cols="40"><?php echo $row['hechos']; ?></textarea></td>

	</tr>

    <tr class="odd">

	<td>Tesis Principal y Secundarias:</td><td><textarea name="tesis" rows="5" cols="40"><?php echo $row['tesis']; ?></textarea></td>

	</tr>

    <tr class="even">

	<td>Decisi&oacute;n:</td><td><textarea name="decisiones" rows="5" cols="40"><?php echo $row['decisiones']; ?></textarea></td>

	</tr>

    <tr class="odd">

	<td>Fuente:</td><td><input type="text" name="fuente" size="80" maxlength="255" value="<?php echo $row['fuente']; ?>"><small>&nbsp;Ejemplo: http://www.un.org/es</small></td>

	</tr>

    <tr class="even">

	<td>

    Anexo:<sup>*</sup></td><td>

    <input type="checkbox" name="currfile" value="true" checked="checked" id="checkAnexo" onclick="checkNuevoAnexo();"/><?php echo $row['anexo']; ?>

    <br />

    <input type="file" name="anexo" size="80" maxlength="255" id="fileAnexo" disabled="disabled"></td>

	</tr>

	<tr>

	<td colspan="2" align="center"><input type="submit" value="Actualizar">&nbsp;<a href="?start=<?php echo $_GET['back']; ?>" style="text-decoration:none"><input type="button" value="Cancelar" /></a></td>

	</tr>	

	</table>

	<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

	<input type="hidden" name="toupdate" value="true">

    <input type="hidden" name="oldFile" value="<?php echo $row['anexo']; ?>">

    <input type="hidden" name="back" value="<?php echo $_GET['back']; ?>">

	</form>

	<?php

	}

	

	

	public function showFichas($limit){

	?>

	<table border="0" id="gradient-style" class="sortable">

	<tr>

	<th>-</th>

	<th>-</th>

	<th width="55%">Temas</th>

    <th width="35%">Organismo/Entidad</th>

	<th width="10%">Fecha</th>

	</tr>

	<?php

	$o = new DBConnection();

	$sql = "select * from cavelier_ficha order by id DESC limit " . ($limit - 1) .", 10";

	$result = $o->getResultSetFrom($sql);

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){

		print '<tr>';

		print '<td><a href="?action=edit&id='.$row['id'].'&back=';

		if($_GET['start'])

			echo $_GET['start'];

		else

			echo 1;

		print '" onClick="">Editar</a></td>';

		?>

		<td><a href="#" onClick="toDelete('cavelier_ficha', <?php echo $row['id']; ?>, '<?php echo $row['anexo']; ?>')">Eliminar</a></td>

		<?php

		print '<td>'.$row['temas'].'</td>';

		print '<td>'.$row['organismo'].'</td>';

		print '<td>'.$row['fecha'].'</td>';

		print '</tr>';

	}

	mysql_free_result($result);

	echo '</table>';

	}



}





class Processes {



	public function uploadAFile(){

		$path = "../pdf/";

		if (file_exists($path . $_FILES['anexo']['name']))

		    die('<font color="#FF0000"><h3>El archivo: ' . $_FILES['anexo']['name'] . ' ya existe, error al intentar subirlo al sistema ' . '<a href="javascript:history.go(-1)">Regresar</a></h3></font>');

		if (move_uploaded_file($_FILES['anexo']['tmp_name'], $path . $_FILES['anexo']['name'])) {

			chmod($path . $_FILES['anexo']['name'], 0755);

			return true;

		}

		return false;

	}

	

	public function uploadAFileAndRemoveOldOne(){

		$path = "../pdf/";

		if (file_exists($path . $_FILES['anexo']['name']))

		    die('<font color="#FF0000"><h3>El archivo: ' . $_FILES['anexo']['name'] . ' ya existe, error al intentar subirlo al sistema ' . '<a href="javascript:history.go(-1)">Regresar</a></h3></font>');

		if (file_exists($path . $_POST['oldFile'])){ 

			unlink($path . $_POST['oldFile']);

		}

		if (move_uploaded_file($_FILES['anexo']['tmp_name'], $path . $_FILES['anexo']['name'])) {

			chmod($path . $_FILES['anexo']['name'], 0755);

			return true;

		}

		return false;	

	}



	public function procesarFicha(){

	if($_POST['addnuevoorg'] == true)

		$sql = "insert into cavelier_ficha values(null, '".$_POST['temas']."', '".$_POST['nuevoorg']."', '".$_POST['fecha']."', '".$_POST['tipo']."', '".$_POST['numero']."', '".$_POST['ponente']."', '".$_POST['partes']."', '".$_POST['hechos']."', '".$_POST['tesis']."', '".$_POST['decisiones']."', '".$_POST['fuente']."', '".$_FILES['anexo']['name']."')";

	else

		$sql = "insert into cavelier_ficha values(null, '".$_POST['temas']."', '".$_POST['organismo']."', '".$_POST['fecha']."', '".$_POST['tipo']."', '".$_POST['numero']."', '".$_POST['ponente']."', '".$_POST['partes']."', '".$_POST['hechos']."', '".$_POST['tesis']."', '".$_POST['decisiones']."', '".$_POST['fuente']."', '".$_FILES['anexo']['name']."')";

		if($this->uploadAFile()){

			$o = new DBConnection();

			$o->processInsert($sql, "La nueva ficha y su anexo: ".$_FILES['anexo']['name'].", fueron agregados con exito");

			unset($_POST['toprocess']);

		}

	}

	

	

	public function actualizarFicha(){

	if($_POST['addnuevoorg'] == true)

		$sql = "update cavelier_ficha set temas = '".$_POST['temas']."', organismo = '".$_POST['nuevoorg']."',  fecha = '".$_POST['fecha']."',  tipo = '".$_POST['tipo']."', numero = '".$_POST['numero']."',  ponente = '".$_POST['ponente']."', partes = '".$_POST['partes']."', hechos = '".$_POST['hechos']."', tesis = '".$_POST['tesis']."', decisiones = '".$_POST['decisiones']."', fuente = '".$_POST['fuente']."', ";

	else

		$sql = "update cavelier_ficha set temas = '".$_POST['temas']."', organismo = '".$_POST['organismo']."',  fecha = '".$_POST['fecha']."',  tipo = '".$_POST['tipo']."', numero = '".$_POST['numero']."',  ponente = '".$_POST['ponente']."', partes = '".$_POST['partes']."', hechos = '".$_POST['hechos']."', tesis = '".$_POST['tesis']."', decisiones = '".$_POST['decisiones']."', fuente = '".$_POST['fuente']."', ";

		

	if ($_POST['currfile'] == true)

		$sql = $sql . " anexo = '".$_POST['oldFile']."'";

	else

		$sql = $sql . " anexo = '".$_FILES['anexo']['name']."'";

	

	$sql = $sql . " where id = '".$_POST['id']."'";

		if ($_POST['currfile'] != true){

			$this->uploadAFileAndRemoveOldOne();

		}

		$o = new DBConnection();

		$o->processInsert($sql, "La ficha fue actualizada");

		if ($_POST['back'] != "")

			header('Location: index.php?start=' . $_POST['back']);

	}

	

	public function borrarFicha(){

	

	    if (file_exists("../pdf/".$_POST['anexo']))

		    if (unlink("../pdf/".$_POST['anexo'])){

				$sql = "delete from ".$_POST['table']." where id = ". $_POST['id'];

				$o = new DBConnection();

				$o->processInsert($sql, "La ficha fue eliminada");

			}else{

				echo '<center><div class="error"><h3>Error al eliminar la ficha</h3></div></center>';

			}

	}

	

	public function showLimits(){

		$sql = "select count(*) as l from cavelier_ficha";

		$o = new DBConnection();

		$result = $o->getResultSetFrom($sql);

		$row = mysql_fetch_array($result, MYSQL_ASSOC);

		$i=1; 

		$start = 1;

		echo "<center>";

		while ($i < $row['l']){

			if (!$_GET['start'] || $_GET['start'] == 1){

				if ($start == 1)

					echo '<a href="?start='.$i.'">'.$start.'</a>&nbsp;'; 

				else

					echo '<a href="?start='.$i.'" style="text-decoration:none">'.$start.'</a>&nbsp;'; 

			}

			if ($_GET['start'] > 1){

				if ($_GET['start'] == $i)

					echo '<a href="?start='.$i.'">'.$start.'</a>&nbsp;'; 

				else

					echo '<a href="?start='.$i.'" style="text-decoration:none">'.$start.'</a>&nbsp;';

			}

			$i += 10;

			$start++;

		}

		echo "</center>";

	}

}





class FichasPorOrganismo {

	

	private $id;

	

	public function __construct($id){

		$this->id = $id;

	}

	

	public function getOrganismo(){

		$conn = new DBConnection();

	    if ($conn->getLink()){

			$sql = "SELECT distinct organismo from cavelier_ficha order by organismo";

			$conn->processAdvancedQuery($sql);

			$result = $conn->getResultSet();

			for ($i = 0; $i <= $this->id; $i++){

				$row = mysql_fetch_array($result, MYSQL_ASSOC);

				if ($i == $this->id)

					return $row['organismo'];

			}

				

  		}//End if

	}//End function

	

	

	public function organismsToSelect(){

		$sql = "select distinct organismo from cavelier_ficha order by organismo asc";

		$o = new DBConnection();

		$result = $o->getResultSetFrom($sql);

		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){

			echo "<option>".$row['organismo']."</option>";

		}

	}



public function organismsSelected($current){

		$sql = "select distinct organismo from cavelier_ficha order by organismo asc";

		$o = new DBConnection();

		$result = $o->getResultSetFrom($sql);

		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){

			$option = $row['organismo'];

			if ($option == $current)

				echo "<option selected>".$option."</option>";

			else

				echo "<option>".$option."</option>";

		}

	}	

	

}





class MostrarFicha {



  private $ficha_id;

  private $resultSet;

  private $row;



  public function __construct($ficha_id){

    $this->ficha_id = $ficha_id;

    $this->openPopUp();

    $this->showPopUp();

  }

  

  public function getFields(){

    $query = "select * from cavelier_ficha where id = " . $this->ficha_id; 

    $this->resultSet = mysql_query($query);

  }

  

  public function openPopUp(){

    $conn = new DBConnection();

    $link = $conn->getLink();

    if ($link){

      $this->getFields();

      $this->row = mysql_fetch_array($this->resultSet, MYSQL_ASSOC);

    }

  }

  

  public function showPopUp(){

    

    print '<table border="1" cellspacing="0" width="750">';

    print '<tr><td valign="top">Tema:</td><td>'.$this->row['temas'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Organismo/Entidad:</td><td>'.$this->row['organismo'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Fecha:</td><td>'.$this->row['fecha'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Tipo de documento:</td><td>'.$this->row['tipo'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">N&uacute;mero:</td><td>'.$this->row['numero'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Ponente:</td><td>'.$this->row['ponente'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Partes:</td><td>'.$this->row['partes'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Hechos/Antecendentes:</td><td>'.$this->row['hechos'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Tesis Principal y Secundarias:</td><td>'.$this->row['tesis'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Decisi&oacute;n:</td><td>'.$this->row['decisiones'].'&nbsp;</td></tr>';

    print '<tr><td valign="top">Fuente:</td><td>'.$this->formatFuente($this->row['fuente']).'&nbsp;</td></tr>';

    print '<tr><td valign="top">Anexos:</td><td>';

	$this->showDownload($this->row['anexo']);

	print '</td></tr>';

    print '</table>';

  }

  

  public function showDownload($anexo){

  if (strlen($anexo) > 0)

		echo '<a href="pdf/'.$anexo.'"><img src="imagenes/PDFDownload.gif" border="0"></a>&nbsp;';

	else

		echo 'No hay anexo disponible';

  }

  

  public function formatFuente($fuente){

    $url = parse_url($fuente);

    return '<a href="http://'.$url[host].'" target="_blank">'.$url[host].'</a>';

  }

}



class NewExtendedSearch {

  private $temas;

  private $organismo;

  private $fecha;

  private $tipo;

  private $variable;

  private $value;



  public function setTemas($temas){

    $this->temas = $temas;

  }

  public function setOrganismo($organismo){

    $this->organismo = $organismo;

  }

  

  public function setFecha($fecha){

    $this->fecha = $fecha;

  }

  

  public function setTipo($tipo){

    $this->tipo = $tipo;

  }



  public function setVariable($variable){

    $this->variable = $variable;

  }

  

  public function setValue($value){

    $this->value = $value;

  }



  public function generateExactSql(){

  	$sql = "SELECT distinct * FROM cavelier_ficha WHERE ";

	if (strlen($this->temas) > 0)

		$sql = $sql . "OR temas LIKE '%" .$this->temas. "%' ";

	if (strlen($this->organismo) > 0)

		$sql = $sql . "OR organismo LIKE '%" .$this->organismo. "%' ";

	if (strlen($this->tipo) > 0)

		$sql = $sql . "OR tipo LIKE '%" .$this->tipo. "%' ";	

	if (strlen($this->fecha) > 0)

		$sql = $sql . "OR fecha LIKE '%" .$this->fecha. "%' ";	

	if (strlen($this->variable) > 0 && strlen($this->value) > 0)

		$sql = $sql . "OR " .$this->variable. " LIKE '%" .$this->value. "%'";	

	$sql = $sql . " order by id";

	$sql = preg_replace("/WHERE OR/", "WHERE", $sql);

	return $sql;

  }



  public function generateLikeSql(){

	return $sql = "SELECT distinct id, temas FROM cavelier_ficha WHERE temas like '%".$this->temas."%' or organismo like '%".$this->organismo."%' or tipo like '%".$this->tipo."%' or fecha like '%".$this->fecha."%' or '".$this->variable."' like '%".$this->value."%' order by id";

  }



  public function generateSql(){

	echo $sql = "SELECT distinct id, temas FROM cavelier_ficha WHERE temas = '".$this->temas."' and organismo = '".$this->organismo."' and tipo = '".$this->tipo."' and fecha like '%".$this->fecha."%' and '".$this->variable."' = '".$this->value."' order by id";

  }

}



class ExtendedSearch {

  private $temas;

  private $organismo;

  private $fecha;

  private $tipo;

  private $numero;

  private $ponente;

  private $partes;

  private $hechos;

  private $tesis;

  private $decisiones;

  private $fuente;

  private $anexo;



  private $g_organismo;

  private $g_fecha;

  private $g_tipo;

  private $g_numero;

  private $g_ponente;

  private $g_partes;

  private $g_hechos;

  private $g_tesis;

  private $g_decisiones;

  private $g_fuente;

  //private $g_anexo;



  public function setTemas($temas){

    $this->temas = $temas;

  }

  

  public function setOrganismo($organismo){

    $this->organismo = $organismo;

  }

  

  public function setFecha($fecha){

    $this->fecha = $fecha;

  }

  

  public function setTipo($tipo){

    $this->tipo = $tipo;

  }

  

  public function setNumero($numero){

    $this->numero = $numero;

  }

  

  public function setPonente($ponente){

    $this->ponente = $ponente;

  }

  

  public function setPartes($partes){

    $this->partes = $partes;

  }

  

  public function setHechos($hechos){

    $this->hechos = $hechos;

  }

  

  public function setTesis($tesis){

      $this->tesis = $tesis;

  }

  

  public function setDecisiones($decisiones){

      $this->decisiones = $decisiones;

  }

  

  public function setFuente($fuente){

      $this->fuente = $fuente;

  }

  

  public function setAnexo($anexo){

    $this->anexo = $anexo;

  }

  

  public function setG_organismo($g_organismo){

    $this->g_organismo = $g_organismo;

  }

  

  public function setG_fecha($g_fecha){

    $this->g_fecha = $g_fecha;

  }

  

  public function setG_tipo($g_tipo){

    $this->g_tipo = $g_tipo;

  }

  

  public function setG_numero($g_numero){

    $this->g_numero = $g_numero;

  }

  

  public function setG_ponente($g_ponente){

    $this->g_ponente = $g_ponente;

  }

  

  public function setG_partes($g_partes){

    $this->g_partes = $g_partes;

  }

  

  public function setG_hechos($g_hechos){

    $this->g_hechos = $g_hechos;

  }

  

  public function setG_tesis($g_tesis){

     $this->g_tesis = $g_tesis;

  }

  

  public function setG_Decisiones($g_decisiones){

     $this->g_decisiones = $g_decisiones;

  }

  

  public function setG_fuente($g_fuente){

     $this->g_fuente = $g_fuente;

  }

  

 /* public function setG_anexo($g_anexo){

     $this->g_anexo = $g_anexo;

  }*/

 

 

  public function generateSql(){

    return $sql = "SELECT distinct id, temas FROM cavelier_ficha WHERE temas like '%".$this->temas."%' " 

    .$this->g_organismo." organismo like '%".$this->organismo."%' ".$this->g_tipo." tipo like '%".$this->tipo."%' "

    .$this->g_numero." numero like '%".$this->numero."%' ".$this->g_ponente."  ponente like '%".$this->ponente."%' "

    .$this->g_partes." partes like '%".$this->partes."%' ".$this->g_hechos." hechos like '%".$this->hechos."%' "

    .$this->g_tesis." tesis like '%".$this->tesis."%' ".$this->g_decisiones." decisiones like '%".$this->decisiones."%' "

    .$this->g_fuente." fuente like '%".$this->fuente."%' ".$this->g_fuente." anexo like '%".$this->anexo."%' order by id";

  }

    

}



?>