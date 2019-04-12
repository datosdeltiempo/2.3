<?php
header("Refresh: 900; URL='datos.php'");
$url_version="http://www.riotercero.tk/meteo2_4.php";
$meteovactual =@file_get_contents($url_version);
if($meteovactual!= true){
	echo "<script language='javascript'>window.location='http://www.riotercero.tk/actualizar.php'</script>";}
if (!file_exists("Currenweather")) {mkdir("Currenweather",0777,true);}
$lines = @file("datos.txt");
$api=$lines["0"];
$ciudad=str_replace(' ','+',$lines["1"]);
$diferencia=$lines["2"] + 32;
if(empty($api)) { $api="3bb256600e062c8651d59f2d28e56a28"; }
if(empty($ciudad)) { $ciudad="Cordoba,ar";}
$json_file = 'http://api.openweathermap.org/data/2.5/weather?q='.$ciudad.'&appid='.$api.'&lang=es&mode=html';
echo '<iframe src="'.$json_file.'" style="width:100%;height:150px;" scrolling="no" frameborder="no"></iframe>';
$patron= str_replace('
','','http://api.openweathermap.org/data/2.5/weather?q='.$ciudad.'&appid='.$api.'&lang=es');  //patron,reemplazo,item
$json_file = @file_get_contents($patron);
$vars = json_decode($json_file);
$cond = $vars->main;
$hum= $cond->humidity;
$temp_c = $cond->temp - 273.15;
$temp_f = 1.8 * ($cond->temp - 273.15) + $diferencia;
$nuevoarchivo = fopen('Currenweather/currenweather.html', "w+");
fwrite($nuevoarchivo,"<HTML>
Location: Sevilla, Spain (Sevilla Airport)<BR />
Condition: Mostly Sunny<BR />
Temperature:".intval($temp_f)."&deg;F/".intval($temp_c)."&deg;C<BR />
Feels Like: 72&deg;F/3&deg;C<BR />
Dew Point: 41&deg;F/5&deg;C<BR />
Humidity: ".$hum."%<BR />
Wind: 8,05 km/h<BR />Barometer: 762 mm and rising<BR />
Sunrise: 08:37:13<BR />
Sunset: 19:39:27<BR />
<BR />
<TABLE CELLPADDING='0' CELLSPACING='0'><TR><TD ALIGN='right'>Observed:&nbsp;<BR />Downloaded:&nbsp;</TD><TD>21/10/2010 @ 19:30:00<BR />21/10/2010 @ 19:53:30</TD></TR></TABLE>
</HTML>");
$nuevoarchivo = fopen('Currenweather/currenweather.txt', "w+");
fwrite($nuevoarchivo, intval($temp_c)." ".$hum);fclose($nuevoarchivo);
if($_POST['api'] && $_POST['ciudad']) {$nuevoarchivo9 = fopen('datos.txt', "w+");
fwrite($nuevoarchivo9, "".$_POST['api']."
".$_POST['ciudad']."
".$_POST['diferencia']."");fclose($nuevoarchivo9);echo "<script language='javascript'>window.location='datos.php'</script>";}
?>

<html>
<head>
<title>METEO V.2.3. 2016</title>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252" />
<link rel="shortcut icon" href="/mini_logo.ico" type="image/ico">
<link rel="icon" href="/mini_logo.ico" type="image/ico">
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.js"></script>
<script> 
function seleccionarCode(o){
	var obj=o.parentNode.parentNode.getElementsByTagName('code')[0];
    if(obj.nodeName.toLowerCase()=='textarea' || (obj.nodeName.toLowerCase()=='input' && obj.type=='text')){
        obj.select();
        return;
    }
    if (window.getSelection) { 
        var sel = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(obj);
        sel.removeAllRanges();
        sel.addRange(range);
    } 
    else if (document.selection) { 
        document.selection.empty();
        var range = document.body.createTextRange();
        range.moveToElementText(obj);
        range.select();
    }
} 
</script>
<style>
body {font: 14px/21px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;
padding: 4em 8em 8em 8em;margin:0;}
.h1 {text-decoration: underline overline blink;}
input {padding:5px 8px;}
form input:required {border:2px solid yellow;}
form input:valid{border:2px solid green;}
form input:focus:invalid{border:2px solid red;}
button.submit {
    background-color: #68b12f;
    background: -webkit-gradient(linear, left top, left bottom, from(#68b12f), to(#50911e));
    background: -webkit-linear-gradient(top, #68b12f, #50911e);
    background: -moz-linear-gradient(top, #68b12f, #50911e);
    background: -ms-linear-gradient(top, #68b12f, #50911e);
    background: -o-linear-gradient(top, #68b12f, #50911e);
    background: linear-gradient(top, #68b12f, #50911e);
    border: 1px solid #509111;
    border-bottom: 1px solid #5b992b;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    box-shadow: inset 0 1px 0 0 #9fd574;
    -webkit-box-shadow: 0 1px 0 0 #9fd574 inset ;
    -moz-box-shadow: 0 1px 0 0 #9fd574 inset;
    -ms-box-shadow: 0 1px 0 0 #9fd574 inset;
    -o-box-shadow: 0 1px 0 0 #9fd574 inset;
    color: white;
    font-weight: bold;
    padding: 6px 20px;
    text-align: center;
    text-shadow: 0 -1px 0 #396715;
}
button.submit:hover {
    opacity:.85;
    cursor: pointer; 
}
button.submit:active {
    border: 1px solid #20911e;
    box-shadow: 0 0 10px 5px #356b0b inset; 
    -webkit-box-shadow:0 0 10px 5px #356b0b inset ;
    -moz-box-shadow: 0 0 10px 5px #356b0b inset;
    -ms-box-shadow: 0 0 10px 5px #356b0b inset;
    -o-box-shadow: 0 0 10px 5px #356b0b inset;    
}
#form-div {
background-color:rgba(72,72,72,0.4);width: 450px;height:150px;margin-top:30px;margin-bottom:30px;padding-left:35px;padding-right:35px;padding-top:35px;padding-bottom:50px;-moz-border-radius: 7px;-webkit-border-radius: 7px;
}
.btn {
 /*font-family: Courier New;*/color: #ffffff;font-size: 18px;background: #45990e;padding: 10px 20px 10px 20px;text-decoration: none;}
.btn:hover {background: #fc3c3c;text-decoration: none;}
#pie {position: absolute;margin:0;left: 0px;bottom: 0px;width: 100%;height: 18%;font-family: Verdana, Arial, Helvetica, sans-serif;font-size:14px;background-color:#CC0000;color:#FFFFFF;padding: 3px;text-align: center;overflow: hidden;}
</style>
</head>
<body>
<hr>
<script type="text/javascript">
//<![CDATA[
function makeArray() {
for (i = 0; i<makeArray.arguments.length; i++)
this[i + 1] = makeArray.arguments[i];}
var months = new makeArray('Enero','Febrero','Marzo','Abril','Mayo',
'Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
var date = new Date();
var day = date.getDate();
var hora = date.getHours();
var minutos = date.getMinutes();
var segundos = date.getSeconds();
var month = date.getMonth() + 1;
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;
document.write("Los datos del tiempo: " + day + " de " + months[month] + " del " + year + " a las: " + hora + ":" + minutos + ":" + segundos);
//]]>
</script>
<hr>
<h1 class="h1"><strong>METEO V.2.3. 2016</strong></h1>
<h2><img src="http://www.riotercero.tk/mini_logo.jpg" width="16" height="15">MAXIMA FM Rio Tercero 97.1 MHz. </h2>
<hr>
<h2>[MANTENGA DE FORMA PERMANENTE ESTA PAGINA]</h2>
Para que los datos esten actualizados (se recarga cada15 minutos de forma automatica. Si cierra esta pagina los datos seran los mismos. <br>

<hr>
<p>Aclaramos que no solamente lo utilizan los usuarios de Radit sino tambi&eacute;n los de ZaraRadio.
<em>Millones de emisoras comunitarias lo tienen instalados.</em></p>
<hr>
<p>Cordoba de Colombia=Cordoba,co<br>Cordoba de Espa&ntilde;a=Cordoba,es<br>Cordoba de Argentina=Cordoba,ar<br><br>ciudad,pais<br>
Aqui esta el listado completo: <a href="http://openweathermap.org/help/city_list.txt" title="http://openweathermap.org/help/city_list.txt" target="_blank">http://openweathermap.org/help/city_list.txt</a></p>
<a name="test"></a>
<hr>

<?php
$uploadedfileload="true";
$uploadedfile_size=$_FILES['uploadedfile'][size];
echo $_FILES[uploadedfile][name];
if ($_FILES[uploadedfile][size]>20000){ $msg=$msg."El archivo no es el de la configuracion!<BR>";$uploadedfileload="false";}
if ($_FILES[uploadedfile][name] !="datos.txt") { $msg=$msg." Otros archivos no son permitidos<BR>";$uploadedfileload="false";}
$file_name=$_FILES[uploadedfile][name];$add=$file_name;
if($uploadedfileload=="true"){ 
if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
echo "<script language='javascript'>window.location='datos.php'</script>";}
else{ echo "Error al subir el archivo";}
} else{ echo $msg; }
?>
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="20000" />
<input name="uploadedfile" type="file" />
<input type="submit" value="Subir datos.txt" />
</form> 
<br>
<div id="form-div"><font color="#FFFFFF" size="+3"><strong>Configurar</strong></font><br><br>
  <form id="form" name="conf" method="post" action="">
  <table width="451">
  <tr>
    <th width="141" align="left">API:</th>
    <td width="10">&nbsp;</td>
    <td width="284"><input name="api" type="text" onFocus="this.value='<?php echo $api;?>'" onBlur="if(this.value=='')this.value='<?php echo $api;?>'" value="<?php echo $api;?>" required /></td>
  </tr>
  <tr>
    <th align="left">CIUDAD:</th>
    <td>&nbsp;</td>
    <?php if(empty($lines["1"])){ $ciu=$ciudad; } else { $ciu=$lines["1"];} ?>
    <td><input name="ciudad" type="text" onFocus="this.value='<?php echo $ciu;?>'" onBlur="if(this.value=='')this.value='<?php echo $ciu;?>'" value="<?php echo $ciu;?>" required /></td>
  </tr>
  <tr>
    <th align="left">Diferencia + o -</th>
    <td>&nbsp;</td>
    <td><input name="diferencia" type="number" value="<?php echo $lines["2"];?>"> 
      Default: 9</td>
  </tr>
  <tr>
    <th align="left"><button class="submit" type="submit">Obtener datos</button></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
</form> 
</div>
<h1><strong>ES NECESARIO obtener el API!</strong></h1>
<h2><a href="https://home.openweathermap.org/users/sign_up" target="_blank" class="btn">Registrarse para obtener api</a></h2>
<br>Se recomienda una cuenta gratuita.<br>
<hr>
<p>Hemos creado un instalador muy facil de instalar bajo windows.<hr>
<strong>Para los usuarios de RADIT</strong> deben de copiar todo el programa, incluyendo carpetas y archivos.
<br>
Sin dejar ningun elemento sin copiar, para luego pegarlo en la siguiente direcci&oacute;n:<br>
<font color='#33CC00'><?php 
$raditdir=str_replace("/","\\",$_SERVER['DOCUMENT_ROOT']."/");
echo $raditdir;?></font><br>
Repuesta: <?php
$raditdira=str_replace("/","\\",$_SERVER['DOCUMENT_ROOT']."/radit.exe");
if (file_exists($raditdira)) {
    echo "<font color='#33CC00'>Radit ya está en este directorio, es posible que funcione!</font>";
} else {
    echo "<font color='#FF0000'>Radit no esta en este directorio. Verifique la ubicacion de los archivos.</font>";
}
?>
<hr>
<p><strong>Y para los de ZaraRadio</strong><br>
  En: Herramientas -&gt; Opciones -&gt; HTH -&gt; Importar desde Archivo -&gt;<br>
  <strong>Copiar y Pegar</strong> esta direccion: <code><font color="#FF3300" size="+1"><?php $zararadio=str_replace("/","\\",$_SERVER['DOCUMENT_ROOT']."/Currenweather/currenweather.html");echo $zararadio;?></font></code> <a href="javascript:void(1);" onClick="seleccionarCode(this,1);">Seleccionar</a><br>Luego-&gt; Aceptar.</p>
<p><a href="http://www.riotercero.tk/radit.php" target="_blank">Visite nuestra pagina web</a> Esperamos que esta sea la version final (2.3). </p>
<hr>
<iframe src="http://tunein.com/embed/player/s242678/" style="width:100%;height:100px;" scrolling="no" frameborder="no"></iframe><br>MAXIMA FM 97.1 Rio Tercero, Cordoba, Argentina
</body>
</html>
