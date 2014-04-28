<?php
/*
Plugin Name: cataloGO
Description: Plugin para la gestión de catalogos
Author: Julio Mateos
Version: 0.1
Author URI: http://www.hechizo.info
*/














/**
 * To deal with symbolic linking in local development
 * @var string
 */
$thisFile = __FILE__;
if (defined('USE_SYMLINKS') and USE_SYMLINKS) {
    $thisFile = basename(dirname(__FILE__) . '\\' . basename(__FILE__));
    /**
 	* Useful constants
 	*/
	//define('MEMBERSIGNUP_PLUGIN_FILE_URL' , $thisFile);
	//define('MEMBERSIGNUP_PLUGIN_URL', plugin_dir_url($thisFile));
	//define('MEMBERSIGNUP_PLUGIN_DIRPATH', plugin_dir_path(__FILE__));
	//define('MEMBERSIGNUP_PLUGIN_DIRNAME', dirname(__FILE__));

}

define("CATALOGO_PLUGIN_FILE_URL" , $thisFile);
define("CATALOGO_PLUGIN_URL", plugin_dir_url($thisFile));
define("CATALOGO_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("CATALOGO_PLUGIN_DIRNAME", dirname(__FILE__));

	


define("CATALOGO_VERSION", "0.1");


// CREAR UNA TABLA AL ACTIVAR EL HOOK
//action hook for plugin activation
register_activation_hook( $thisFile, 'catalogoPlugin_activationHook' );
register_deactivation_hook( $thisFile, 'catalogoPlugin_deactivationHook' );  


//add_action('wp_print_scripts','enqueue_my_scripts');
//add_action( wp_print_styles','enqueue_my_styles');


function mi_funcion_ajax(){  
	//echo $_POST['myname'];
    //die("asdfasdf");
    $objeto=$_POST['parameters'];
    $result['type'] = "error";
    $result['vote_count'] = 2;
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      /*$result = json_encode($result);
      echo $result;*/
	   require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	   $columnDefinitions = array();
       $columnDefinition = new CatalogPluginColumnDefinition();
       $columnDefinition->setName($objeto["uno"]);
       $columnDefinition->setDescription("Referencia de 4");
       $columnDefinition->setDefinition("varchar(4) NOT NULL");
       array_push($columnDefinitions, $columnDefinition->getJsonData());
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("label");
        $columnDefinition->setDescription("etiqueta 50");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition->getJsonData());
        $result=json_encode($columnDefinitions);
		//$result = json_encode($result);
       echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();
}  


// Función que devuelve una tabla con todos los catalogos
function catalogoPlugin_getCatalog(){  
    $result['result'] = 2;
	$table="<table border='1'>
		<thead>
			<tr>
				<td>
					Nombre
				</td>
				<td>
					Descripcion
				</td>
			<tr>
		</thead>
		<tbody>";
		require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
		$catalogOperations = new CatalogPluginCatalogOperations();
		$catalogsJson = array();
		$catalogs = $catalogOperations->getAllCatalogs();
		foreach($catalogs as $catalog){
			array_push($catalogsJson, $catalog->getJsonData());
			$idCatalog=$catalog->getId();
			$table.="<tr onClick=showRealCatalog(".$idCatalog.")>
				<td>".$catalog->getName()."</td>
				<td>".$catalog->getDescription()."</td>
			</tr>
			<tr>
				<td colspan='2'>
					<div id='catalog".$idCatalog."' style='display:none'>

					</div>
				</td>
			<tr>";
		}
		$table.="</tbody></table>";
		$ajaxResult = new AjaxResult();

		// Pasando un integer
		$ajaxResult->setResult(5);

		// Pasando un texto
		$ajaxResult->setText($table);


		// Pasando un array de objetos
		$columnDefinitions = array();
       	$columnDefinition = new CatalogPluginColumnDefinition();
       	$columnDefinition->setName($objeto["uno"]);
       	$columnDefinition->setDescription("Referencia de 4");
       	$columnDefinition->setDefinition("varchar(4) NOT NULL");
      	array_push($columnDefinitions, $columnDefinition->getJsonData());
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("label");
        $columnDefinition->setDescription("etiqueta 50");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition->getJsonData());

		//$ajaxResult->setObject($columnDefinitions);
		$ajaxResult->setObject($catalogsJson);
		$result=json_encode($ajaxResult->getJsonData());
	echo $result;
   die();
} 



// Función que devuelve los datos de un catalogo indicado
function catalogoPlugin_getRealCatalogData(){  
	$id=$_POST['id'];
error_log( "la tabla es [");
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');

	$ajaxResult = new AjaxResult();
	$catalogOperations = new CatalogPluginCatalogOperations();
	$catalog=$catalogOperations->getCatalog($id);
	if($catalog ==null){
		// Pasando un integer
		$ajaxResult->setResult(-1);
	}else{
		$realCatalogOperations = new CatalogPluginRealCatalogOperations();
		// Pasando un texto
		$ajaxResult->setResult(1);
		error_log( "la tabla es [".$catalog->getTableName()."]");
		$columns = $realCatalogOperations->getColumns($catalog);
		$columnNames=array();
		// Se añade el id, ya que esta columna estará presente en todos los catálogos
		array_push($columnNames, "id");
		foreach($columns as $column){
			error_log("columna[".$column->getName()."]");
			array_push($columnNames, $column->getName());
        }

		$catalogResult = new CatalogResult();
		$catalogResult->setHead($columnNames);
		$catalogResult->setData($realCatalogOperations->getData($catalog));
		$ajaxResult->setObject($catalogResult->getJsonData());	
	}
	$result=json_encode($ajaxResult->getJsonData());
	echo $result;
   die();
} 

// Creando las llamadas Ajax para el plugin de WordPress  
add_action( 'wp_ajax_nopriv_mi_funcion_accion', 'mi_funcion_ajax' );  
add_action( 'wp_ajax_mi_funcion_accion', 'mi_funcion_ajax' );  

// Registro de funcion ajax que devolvera una tabla con todos los 
add_action( 'wp_ajax_catalogoPlugin_getCatalog', 'catalogoPlugin_getCatalog' );
add_action( 'wp_ajax_catalogoPlugin_getRealCatalogData', 'catalogoPlugin_getRealCatalogData' );
//function enqueue_my_scripts(){
	//wp_enqueue_script( 'my_awesome_script', '/script.js', array( 'jquery' ));
//}

//callback function
function catalogoPlugin_activationHook(){

	global $wpdb;
	$catalogdbPrefix = "catalogoplugin_";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	
	$catalogData = new CatalogPluginCatalogData();

	$columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();

	$columnDefinitionOperations->createTable();

	$columnsDefinitions = $catalogData->getColumnDefinitions();

	//foreach($columnsDefinitions as $columnsDefinitions){
	for ($i=0;$i<count($columnsDefinitions); $i++){
		// Se obtiene el objeto pero con el id
		$columnsDefinitions[$i]=$columnDefinitionOperations->insertGet($columnsDefinitions[$i]);
		//$columnDefinitionOperations->insert($columnsDefinitions[$i]);

	}

	$columnOperations = new CatalogPluginColumnOperations();

	$columnOperations->createTable();

	$columns = $catalogData->getColumns($columnsDefinitions);

	for ($i=0;$i<count($columns); $i++){

		//$columnsDefinitions[$i]=$columnDefinitionOperations->insertGetId($columnsDefinitions[$i]);
		$columns[$i]=$columnOperations->insertGet($columns[$i]);

	}


	$typeOperations = new CatalogPluginTypeOperations();

	$typeOperations->createTable();

	$types = $catalogData->getTypes();

	for ($i=0;$i<count($types); $i++){

		//$columnsDefinitions[$i]=$columnDefinitionOperations->insertGetId($columnsDefinitions[$i]);
		$types[$i]=$typeOperations->insertGet($types[$i]);

	}


	$typeColumnsOperations = new CatalogPluginTypeColumnsOperations();

	$typeColumnsOperations->createTable();

	$typeColumns = $catalogData->getTypeColumns($types,$columns);

	for ($i=0;$i<count($typeColumns); $i++){
		//$columnsDefinitions[$i]=$columnDefinitionOperations->insertGetId($columnsDefinitions[$i]);
		$typeColumnsOperations->insert($typeColumns[$i]);
	}


	$catalogOperations = new CatalogPluginCatalogOperations();
	$realcatalogOperations = new CatalogPluginRealCatalogOperations();
	$catalogOperations->createTable();

	$catalogs = $catalogData->getCatalogs($types);

	for ($i=0;$i<count($catalogs); $i++){

		//$columnsDefinitions[$i]=$columnDefinitionOperations->insertGetId($columnsDefinitions[$i]);
		$catalogOperations->insert($catalogs[$i]);

		$realcatalogOperations->createCatalog($catalogs[$i]);

	}





}

function catalogoPlugin_deactivationHook() {  
	require_once(CATALOGO_PLUGIN_PATH.'modules/Catalog.php');
	
	$catalogOperations = new CatalogPluginCatalogOperations();
	
	$catalogOperations->dropTable(); 

	$typeColumnsOperations = new CatalogPluginTypeColumnsOperations	();

	$typeColumnsOperations->dropTable();

	$columnOperations = new CatalogPluginColumnOperations();

	$columnOperations->dropTable();

	$typeOperations = new CatalogPluginTypeOperations();

	$typeOperations->dropTable();

	$columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();

	$columnDefinitionOperations->dropTable();
}



// // http://ldablog.com.ar/2008/09/agregar-campos-personalizados-a-la-administracion-de-wordpress/
// add_action('admin_menu', 'agregar_campos');
// function agregar_campos() {
// 		//('id', 'titulo', 'funcion', 'pagina', 'contexto', 'prioridad')
// 	/*
// 	Entonces, agregamos una sección con el id “subtitulo”, el título de la caja será “Subtítulo”, 
// 	la función que se ejecutará en esa caja será “fn_subtitulo”, 
// 	la página en la que aparece será la de administrar posts, 
// 	el contexto será la parte de edición básica y la prioridad es “alta”, 
// 	para que aparezca arriba de los otros campos (aunque el título y el texto de la entrada siempre aparecerán primero).
// 	*/
//     add_meta_box('subtitulo','Subtítulo','fn_subtitulo','post','normal','high');
// }

// function fn_subtitulo() {
//         global $wpdb, $post;
//         $value  = (get_post_meta($post->ID, subtitulo, true));
//         echo '<label class="hidden" for="subtitulo">Subtítulo</label>
//         <input type="text" name="subtitulo" id="subtitulo" value="'.htmlspecialchars($value).'" style="width: 600px;" />';
// }

// add_action('save_post', 'guardar_campos');
// add_action('publish_post', 'guardar_campos');
// function guardar_campos() {
//    global $wpdb, $post;
//         if (!$post_id) $post_id = $_POST['post_ID'];
//         if (!$post_id) return $post;
//         $subtitulo= $_POST['subtitulo'];
//         update_post_meta($post_id, 'subtitulo', $subtitulo);
// }

// add_action('delete_post', 'borrar_campos');
// function borrar_campos() {
//    global $wpdb, $post;
//         if (!$post_id) $post_id = $_POST['post_ID'];
//         if (!$post_id) return $post;
//         delete_post_meta($post_id, 'subtitulo');
//}



add_action( 'admin_menu', 'catalogoPlugin_registerMyCustomMenuPage' );
//add_action( 'admin_menu', 'catalogoPlugin_registerMyCustomSubmenuPage' );

function catalogoPlugin_registerMyCustomMenuPage(){
    add_menu_page( 'cataloGO', 'cataloGO', 'manage_options', 'customteam', 'catalogoPlugin_myCustomMenuPage'); 
}



function catalogoPlugin_myCustomMenuPage() {
    require("catalogo_config.php");
}


// SUBMENUS 
/*function catalogoPlugin_registerMyCustomSubmenuPage() {
    add_submenu_page( 'customteam', 'Team info', 'Team info', 'manage_options', 'my-custom-submenu-page', 'my_custom_submenu_page' ); 
    add_submenu_page( 'customteam', 'Crew Stats', 'Crew Stats', 'manage_options', 'my-custom-submenu-page_2', 'my_custom_submenu_page_2' );
    //add_submenu_page_3 ... and so on
}

function my_custom_submenu_page() {
    echo '<p>Hello, I am Team Info</p>';
}

function my_custom_submenu_page_2() {
    echo '<p>Hello, I am Crew Stats</p>';
}
*/



// /*
// Para empezar si lo que deseamos es incluir una nueva opción de menú en nuestro wordpress con diferentes submenus lo que deberemos hacer es
// */

// // Creamos la acción de la creación del menú
// add_action('admin_menu', 'catapplogo_menu');
// // Creamos el menú con un submenú con add_menu_page y add_submenu_page
// function catalogo_menu()
// {
// 	$blogs_menu_main = add_menu_page('Config', 'Menu', 'administrator', 'slug_menu', 'funcion_primera_opcion_de_menu');
// 	$blogs_external_menu = add_submenu_page('slug_menu', 'Submenu', 'Submenu', 'administrator', 'slug_segunda_opcion_de_menu', 'funcion_segunda_opcion_de_menu');
// }
// // Definimos los archivos php que se mostrarán al presionar las opciones del menú
// function funcion_primera_opcion_de_menu(){
// 	require ('primera_opcion_de_menu.php');
// }
// function funcion_segunda_opcion_de_menu(){
// 	require ('segunda_opcion_de_menu.php');
// }

// /*
// Ahora ya tenemos la opción de desarrollar código dentro de estas opciones de menú para gestionar por ejemplo la base de datos.
// Otra opción que es de gran utilidad es la gestión de la zona de contenido donde por ejemplo podemos crear una nueva caja en las páginas o los post que nos soliciten o nos muestren información adicional.
// */
// // Creamos la acción de crear la caja
// add_action('add_meta_boxes', 'caja_1');
// // Con add_meta_box creamos la caja en el lugar donde desaemos
// function caja_1($postType)
// {
//     add_meta_box('caja_1_id', 'Nombre Caja', 'funcion_caja_1', 'post', 'side', 'high');
// }
// // Definimos los archivos php que se mostrarán dentro del meta box que hemos definido.
// function funcion_caja_1()
// {
//      echo "Contenido de mi caja";
// }


// /*
// Si para nuestras funcionalidades necesitamos incluir un js deberemos añadir
// */
// function nuestros_scripts()
// {
//     $wp_wall_plugin_url = trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/nombre-de-nuestro-pluguin/nuestro-pluguin.js';
//     wp_enqueue_script('my_awesome_script', $wp_wall_plugin_url, array('jquery'));
// }
// add_action('wp_print_scripts', 'nuestros_scripts');

// /*
// En nuestro plugin quizás tenemos la necesidad de interceptar eventos como la pubicación de un post
// */
// add_action('publish_post', 'evento_de_publicacion');
// function evento_de_publicacion($post_id)
// {
//   // Lo que haria nuestro WordPress en el momento de guardar un post
// }
// /*
// En el desarrollo de nuestros plugins algo muy útil que nos encontraremos es que determinadas acciones únicamente las puedan realizar usuarios con determinados permisos, tema que resolveremos con current_user_can
// */
// if (current_user_can('administrator')){
//    // Únicamente afectará a usuarios con permisos de administrador
// }
// /*
// Espero que esta simple guia sea útil y ahorre tiempo a los que quereis empezar a hacer las primeras pruebas y crear un plugin WordPress. Si necesitas soporte para desarrollar plugins o necesitas algún servicio de desarrollo de aplicaciones Ipad o linkbuilding, no dudes en contactar con nosotros.
// */
?>
