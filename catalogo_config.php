//Registrar la hoja de estilos y la libreria js(wp_register_style)
//Encolarlas para que se hagan efectivo su uso (wp_enqueue_style)
<h1>Administraci&oacute;n cataloGO</h1>
<?php
wp_register_script( 'catalogo.js', CATALOGO_PLUGIN_URL.'js/catalogo.js',  array('jquery'),time(),true);
wp_enqueue_script( 'catalogo.js' );

wp_register_style( 'catalogo.css', CATALOGO_PLUGIN_URL.'/css/catalogo.css', array(),'1.0','all' );
wp_enqueue_style( 'catalogo.css' );

// JQGRID ////////////////////////////////////////////
wp_register_script( 'jquery.jqGrid.min.js', CATALOGO_PLUGIN_URL.'js/jquery.jqGrid.min.js',  array('jquery'),time(),true);
wp_enqueue_script( 'jquery.jqGrid.min.js' );
 
wp_register_script( 'grid.celledit.js', CATALOGO_PLUGIN_URL.'js/grid.celledit.js',  array('jquery'),time(),true);
wp_enqueue_script( 'grid.celledit.js' );

wp_register_script( 'grid.locale-es.js', CATALOGO_PLUGIN_URL.'js/grid.locale-es.js',  array('jquery'),time(),true);
wp_enqueue_script( 'grid.locale-es.js' );

wp_register_style( 'jquery-ui.css', CATALOGO_PLUGIN_URL.'/css/jquery-ui.css', array(),'1.0','all' );
wp_enqueue_style( 'jquery-ui.css' );

wp_register_style( 'ui.jqgrid.css', CATALOGO_PLUGIN_URL.'/css/ui.jqgrid.css', array(),'1.0','all' );
wp_enqueue_style( 'ui.jqgrid.css' );
//////////////////////////////////////////////////////
require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');

if (defined('USE_SYMLINKS') and USE_SYMLINKS){
	echo "llega";
}

/*echo "<br/>".ABSPATH."<br/>";
echo CATALOGO_PLUGIN_URL."<br/>";
echo CATALOGO_PLUGIN_PATH."<br/>";

echo MEMBERSIGNUP_PLUGIN_FILE_URL."<br/>";
echo MEMBERSIGNUP_PLUGIN_URL."<br/>";
echo MEMBERSIGNUP_PLUGIN_DIRPATH."<br/>";
echo MEMBERSIGNUP_PLUGIN_DIRNAME."<br/>";*/
?>
<!--
<input id="boton" name="boton" type="button">
<input id="loadCatalogs" name="loadCatalogs" type="button" value="Cargar catalogos">
<form name="formulario">
	Username: <input type="text" name="user">
	<input type="submit" value="Submit">
</form>
-->


<div id="catalogErrors">
	error1
</div>
<div class="message_block_error" style="display: block;"><div class="message_block_error_right"><p>El cliente "X00000111" no existe</p></div></div>
<div class="clear"></div>
<div class="message_block_ok_action" style="display: block;">	
			<div class="message_block_ok_action_right">	
				 <p>La accion de "<b>Actualizar</b>" para el mantenimiento de "<b>Movimientos</b>" se ha realizado correctamente.</p>
			</div>
</div>
<div class="clear"></div>
<div id="addCatalogDialog" onClick="addCatalogShow()"><a href="#">+ Añadir Catalogo</a></div>

<h2>Listado de Cat&aacute;logos</h2>


<div id="addCatalog">

</div>

Zona de acciones sobre los catalogos
boton añadir catalogo, eliminar catalogo, visualizar datos del catalogo 


Tabla de catalogos disponibles
<table id="catalogs"></table>

Tabla de contenido de un catalogo
<table id="catalogContent"></table>
<div id="catalogContentPager"></div>

Si se pulsa visualizar un catalogo se mostrara esta zona
Zona para añadir, modificar o eliminar

Listado de registros

