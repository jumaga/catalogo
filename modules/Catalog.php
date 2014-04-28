<?php
// Clase para devolver resultados por ajax
// result será un entero que indicará cómo ha ido el resultado de la operación
// text permite devolver, si fuera necesario, código html
// object permite devolver estructuras (array de objetos, arrays, objetos...) dependiendo de la operación
Class AjaxResult{
    private $result;
    private $text;
    private $object;
    public function setResult($result){
        $this->result=$result;
    }
    public function getResult(){
        return $this->result;
    }
    public function setText($text){
        $this->text=$text;
    }
    public function getText(){
        return $this->text;
    }
    public function setObject($object){
        $this->object=$object;
    }
    public function getObject(){
        return $this->object;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

// Clase para almacenar el resultado de un catalogo
// data será un array con los registros
// head será un array con los nombres de las columnas
// headtype será un array con los tipos de datos de las columnas
Class CatalogResult{
    private $data;
    private $head;
    private $headType;

    public function setData($data){
        $this->data=$data;
    }
    public function getData(){
        return $this->data;
    }
    public function setHead($head){
        $this->head=$head;
    }
    public function getHead(){
        return $this->head;
    }
    public function setHeadType($headType){
        $this->headType=$headType;
    }
    public function getHeadType(){
        return $this->headType;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogPluginCatalogConstants{
    public static $catalogdbPrefix = "catalogoplugin_";
}


Class CatalogPluginColumnDefinition{
    private $id;
    private $name;
    private $description;
    private $definition;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }

    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDefinition($definition){
        $this->definition=$definition;
    }
    public function getDefinition(){
        return $this->definition;
    }
     function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogPluginColumn{
    private $id;
    private $name;
    private $description;
    private $idColumnDefinition;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setIdColumnDefinition($idColumnDefinition){
        $this->idColumnDefinition=$idColumnDefinition;
    }
    public function getIdColumnDefinition(){
        return $this->idColumnDefinition;
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogPluginType{
    private $id;
    private $name;
    private $description;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogPluginTypeColumns{
    private $idType;
    private $idColumn;

    public function setIdType($idType){
        $this->idType=$idType;
    }
    public function getIdType(){
        return $this->idType;
    }
    public function setIdColumn($idColumn){
        $this->idColumn=$idColumn;
    }
    public function getIdColumn(){
        return $this->idColumn;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}

Class CatalogPluginCatalog{
    private $id;
    private $name;
    private $description;
    private $tableName;
    private $idType;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }
    public function setdescription($description){
        $this->description=$description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setTableName($tableName){
        $this->tableName=$tableName;
    }
    public function getTableName(){
        return $this->tableName;
    }
    public function setIdType($idType){
        $this->idType=$idType;
    }
    public function getIdType(){
        return $this->idType;
    }
    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
           if(is_object($value) && method_exists($value,'getJsonData')){
              $value = $value->getJsonData();
           }
        }
        return $var;
     }
}



Class CatalogPluginOperations{


}


Class CatalogPluginColumnDefinitionOperations extends CatalogPluginOperations{
    
    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "column_definition"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto


    public function insert($columnDefinition){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, definition) values('".$columnDefinition->getName()."', '".$columnDefinition->getDescription()."','".$columnDefinition->getDefinition()."')";
        $wpdb->query($sql);
    }

    public function insertGet($columnDefinition){
        $this->insert($columnDefinition);
        return $this->getByName($columnDefinition->getName());
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $columnDefinition = new CatalogPluginColumnDefinition();
            $columnDefinition->setId($result[0]->id);
            $columnDefinition->setName($result[0]->name);
            $columnDefinition->setDescription($result[0]->description);
            $columnDefinition->setDefinition($result[0]->definition);
            return $columnDefinition;
        }else{
            return null;
        }
    }

    // Devuelve el primer elemento que encuentre en base de datos con el name especificado (name es key, por tanto solo habrá como mucho un elemento)
    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $columnDefinition = new CatalogPluginColumnDefinition();
            $columnDefinition->setId($result[0]->id);
            $columnDefinition->setName($result[0]->name);
            $columnDefinition->setDescription($result[0]->description);
            $columnDefinition->setDefinition($result[0]->definition);
            return $columnDefinition;
        }else{
            return null;
        }
    }

    public function createTable(){
        global $wpdb;
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140),
                definition char(255) NOT NULL,
                PRIMARY KEY ( `id` ), 
                KEY (`name`)            
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }

    // Busca en el array de elementos de tipo ColumnDefinition un elemento que tenga el nombre que le pasamos y devuelve su id
    public function getIdFromName($columnsDefinitions,$name){
        foreach($columnsDefinitions as $columnsDefinition){
            if($columnsDefinition->getName()==$name){
                return $columnsDefinition->getId();
            }
        }
        return -1;
    }
}



Class CatalogPluginColumnOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "column"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto

    public function insert($column){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, id_column_definition) values('".$column->getName()."', '".$column->getDescription()."',".$column->getIdColumnDefinition().")";
        $wpdb->query($sql);
    }

    public function insertGet($column){
        $this->insert($column);
        return $this->getByName($column->getName());
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $column = new CatalogPluginColumn();
            $column->setId($result[0]->id);
            $column->setName($result[0]->name);
            $column->setDescription($result[0]->description);
            $column->setIdColumnDefinition($result[0]->id_column_definition);
            return $column;
        }else{
            return null;
        }
    }

    // Devuelve el primer elemento que encuentre en base de datos con el name especificado (name NO es key, por tanto pueden existir varios pero solo se devuelve el primero)
    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $column = new CatalogPluginColumn();
            $column->setId($result[0]->id);
            $column->setName($result[0]->name);
            $column->setDescription($result[0]->description);
            $column->setIdColumnDefinition($result[0]->id_column_definition);
            return $column;
        }else{
            return null;
        }
    }


    public function createTable(){
        global $wpdb;
        $columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();
        $tableColumnDefinition=$columnDefinitionOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(32) NOT NULL ,
                description char(128) ,
                id_column_definition int NOT NULL, 
                PRIMARY KEY ( `id`  ),
                FOREIGN KEY (`id_column_definition`) REFERENCES ".$tableColumnDefinition."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    // Busca en el array de elementos de tipo ColumnDefinition un elemento que tenga el nombre que le pasamos y devuelve su id
    public function getIdFromName($columns,$name){
        foreach($columns as $column){
            if($column->getName()==$name){
                return $column->getId();
            }
        }
        return -1;
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}



Class CatalogPluginTypeOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "type"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto

    public function insert($type){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description) values('".$type->getName()."', '".$type->getDescription()."')";
        $wpdb->query($sql);
    }

    public function insertGet($type){
        $this->insert($type);
        return $this->getByName($type->getName());
    }

    public function getById($id){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id='".$id."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $type = new CatalogPluginType();
            $type->setId($result[0]->id);
            $type->setName($result[0]->name);
            $type->setDescription($result[0]->description);
            return $type;
        }else{
            return null;
        }
    }

    // Devuelve el primer elemento que encuentre en base de datos con el name especificado (name es key, por tanto solo habrá como mucho un elemento)
    public function getByName($name){
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where name='".$name."'";
        $result = $wpdb->get_results( $sql );
        if($result){
            $type = new CatalogPluginType();
            $type->setId($result[0]->id);
            $type->setName($result[0]->name);
            $type->setDescription($result[0]->description);
            return $type;
        }else{
            return null;
        }
    }

    public function createTable(){
        global $wpdb;
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140), 
                PRIMARY KEY ( `id` ),
                KEY (`name`) 
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    // Busca en el array de elementos de tipo ColumnDefinition un elemento que tenga el nombre que le pasamos y devuelve su id
    public function getIdFromName($types,$name){
        foreach($types as $type){
            if($type->getName()==$name){
                return $type->getId();
            }
        }
        return -1;
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}


Class CatalogPluginTypeColumnsOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "type_columns"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto

    public function insert($columnType){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(id_type, id_column) values(".$columnType->getIdType().", ".$columnType->getIdColumn().")";
        $wpdb->query($sql);
    }

   

    public function createTable(){
        global $wpdb;
        $columnOperations = new CatalogPluginColumnOperations();
        $tableColumn=$columnOperations->getTableName();
        $typeOperations = new CatalogPluginTypeOperations();
        $tableType=$typeOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id_type int(11) NOT NULL,
                id_column int(11) NOT NULL,
                PRIMARY KEY ( `id_type`, `id_column` ),
                FOREIGN KEY (`id_type`) REFERENCES ".$tableType."(`id`),
                FOREIGN KEY (`id_column`) REFERENCES ".$tableColumn."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }

    // Busca en el array de elementos de tipo ColumnDefinition un elemento que tenga el nombre que le pasamos y devuelve su id
    public function getIdFromName($types,$name){
        foreach($types as $type){
            if($type->getName()==$name){
                return $type->getId();
            }
        }
        return -1;
    }


    public function getByIdType($idType){
        $columnsType = array();
        global $wpdb;
        $sql="select * from ".$this->getTableName()." where id_type='".$idType."'";
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $columnType = new CatalogPluginTypeColumns();
            $columnType->setIdType($row->id_type);
            $columnType->setIdColumn($row->id_column);
            array_push($columnsType, $columnType);
        }
        return $columnsType;
    }


    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}

Class CatalogPluginCatalogOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "catalog"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto

    public function insert($catalog){
        global $wpdb;
        $sql="insert into ".$this->getTableName()."(name, description, table_name, id_type) values('".$catalog->getName()."', '".$catalog->getDescription()."','".$catalog->getTableName()."',".$catalog->getIdType().")";
        $wpdb->query($sql);
    }
   

    public function dropTable(){
        global $wpdb;
        // Para desactivar la comprobacion de relaciones entre tablas y poder eliminar
        $wpdb->query("SET FOREIGN_KEY_CHECKS=0");
        $sql = "DROP TABLE IF EXISTS " . $this->getTableName() . ";";
        $wpdb->query($sql);
        // Para reactivar la comprobación de relaciones
        $wpdb->query("SET FOREIGN_KEY_CHECKS=1");
    }
    
    public function getAllCatalogs(){
        global $wpdb;
        $catalogs = array();
        $sql="select * from ".$this->getTableName();
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $catalog = new CatalogPluginCatalog();
            $catalog->setId($row->id);
            $catalog->setName($row->name);
            $catalog->setDescription($row->description);
            $catalog->setTableName($row->table_name);
            $catalog->setIdType($row->id_type);
            array_push($catalogs, $catalog);
        }
        return $catalogs;
    }

    public function getCatalog($id){
        global $wpdb;
        $catalogs = array();
        $sql="select * from ".$this->getTableName()." where id=".$id;
        $result = $wpdb->get_results( $sql );
        if($result){
            $catalog = new CatalogPluginCatalog();
            $catalog->setId($result[0]->id);
            $catalog->setName($result[0]->name);
            $catalog->setDescription($result[0]->description);
            $catalog->setTableName($result[0]->table_name);
            error_log("tname[".$result[0]->table_name."]");
            $catalog->setIdType($result[0]->id_type);
            return $catalog;
        }else{
            return null;
        }

    }

    public function createTable(){
        global $wpdb;
        $typeOperations = new CatalogPluginTypeOperations();
        $tableType=$typeOperations->getTableName();
        if($wpdb->get_var("SHOW TABLES LIKE '".$this->getTableName()."'") != $this->getTableName()) {
            $sql = "CREATE TABLE ".$this->getTableName()."(
                id int(11) NOT NULL AUTO_INCREMENT ,
                name char(50) NOT NULL ,
                description char(140),
                table_name char(64) NOT NULL,
                id_type int NOT NULL, 
                PRIMARY KEY ( `id` ),
                KEY ( `name` ),
                KEY ( `table_name` ),
                FOREIGN KEY (`id_type`) REFERENCES ".$tableType."(`id`)
                ) ;";
            dbDelta($sql);
        }
    }

    public function getTableName(){
        if (self::$tableName == null) {
            global $wpdb;
            self::$tableName = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix . $this->subixTableName;
        }
        return self::$tableName;
    }
}



// Clase para la gestion de los catalogos en sí
Class CatalogPluginRealCatalogOperations{
    public function createCatalog($catalog){
        $tableName = $catalog->getTableName();
        $idType=$catalog->getIdType();
        $query = "CREATE TABLE ".$tableName."(
            id int(11) NOT NULL AUTO_INCREMENT";
        //$typeOperations = new CatalogPluginTypeOperations();

        //$type = $typeOperations->getById($idType);
        
        $columnTypeOperations = new CatalogPluginTypeColumnsOperations();

        $columnsType = $columnTypeOperations->getByIdType($idType);

        $columnOperations = new CatalogPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }

        $columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();
        foreach($columns as $column){
            $columnDefinition=$columnDefinitionOperations->getById($column->getIdColumnDefinition());
            $query = $query .", ".$column->getName()." ".$columnDefinition->getDefinition();
        }
        $query = $query.",PRIMARY KEY ( `id` ));";
        global $wpdb;
        dbDelta($query);
    }


    //
    public function getColumns($catalog){
        $tableName = $catalog->getTableName();
        $idType=$catalog->getIdType();
       
        
        $columnTypeOperations = new CatalogPluginTypeColumnsOperations();

        $columnsType = $columnTypeOperations->getByIdType($idType);

        $columnOperations = new CatalogPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }

        return $columns;
    }


    // Devuelve un array de rows
    public function getData($catalog){
        // Se obtienen los nombres de las columnas del catálogo
        //  aparte de los nombres definidos, el catalogo siempre tiene un campo id
        $columns=array();
        
        $columns = $this->getColumns($catalog);
        // Se añade el id al principio del array que contiene los nombres de las columnas
        $data = array();
        global $wpdb;
        $sql="select * from ".$catalog->getTableName();
        error_log($sql);
        $result = $wpdb->get_results( $sql );
        foreach ($result as $row ){
            $rowArray = array();
            // Aparte de las columnas devueltas, en los catalogos hay una columna llamada id
            //  tomamos también ese valor
            array_push($rowArray, $row->id);
            foreach($columns as $column){
                error_log($column->getName());
                error_log($row->{$column->getName()});
                array_push($rowArray, $row->{$column->getName()});
            }
           array_push($data, $rowArray);
        }
        return $data;
    }

    
    public function getCatalogForm($catalog){
    	$idType=$catalog->getIdType();
    	$columnTypeOperations = new CatalogPluginTypeColumnsOperations();
        $columnsType = $columnTypeOperations->getByIdType($idType);
        $columnOperations = new CatalogPluginColumnOperations();
        $columns = array();
        foreach($columnsType as $columnsType){
            $column=$columnOperations->getById($columnsType->getIdColumn());
            array_push($columns, $column);
        }
        $columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();
        $columnDefinitions= array();
        foreach($columns as $column){
            $columnDefinition=$columnDefinitionOperations->getById($column->getIdColumnDefinition());
            array_push($columnDefinitions, $columnDefinition);
        }
		// Pintar el forulario a partir de las columnas y las definiciones de las columnas        
        $form="";
        $form+="<form name='' action=''>";
        $form+="</form>";
        return $form;
    }
}



Class CatalogPluginCatalogData{
    // Devuelve los columns definitions
    public function getColumnDefinitions(){
        $columnDefinitions = array();
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("ref");
        $columnDefinition->setDescription("Referencia de 4");
        $columnDefinition->setDefinition("varchar(4) NOT NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("label");
        $columnDefinition->setDescription("etiqueta 50");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("autor");
        $columnDefinition->setDescription("autor");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("title");
        $columnDefinition->setDescription("titulo");
        $columnDefinition->setDefinition("varchar(50) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("comment");
        $columnDefinition->setDescription("comentario");
        $columnDefinition->setDefinition("varchar(255) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        $columnDefinition = new CatalogPluginColumnDefinition();
        $columnDefinition->setName("storage");
        $columnDefinition->setDescription("estuche");
        $columnDefinition->setDefinition("varchar(2) default NULL");
        array_push($columnDefinitions, $columnDefinition);
        return $columnDefinitions;
    }


    public function getColumns($columnDefinitions){
        $columnDefinitionOperations = new CatalogPluginColumnDefinitionOperations();
        $columns = array();
        $column = new CatalogPluginColumn();
        $column->setName("referencia");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"ref"));
        array_push($columns, $column);
        $column = new CatalogPluginColumn();
        $column->setName("etiqueta");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"label"));
        array_push($columns, $column);
        $column = new CatalogPluginColumn();
        $column->setName("autor");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"autor"));
        array_push($columns, $column);
        $column = new CatalogPluginColumn();
        $column->setName("titulo");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"title"));
        array_push($columns, $column);
        $column = new CatalogPluginColumn();
        $column->setName("comentario");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"comment"));
        array_push($columns, $column);  
        $column = new CatalogPluginColumn();
        $column->setName("estuche");
        $column->setDescription("descripcion del campo");
        $column->setIdColumnDefinition($columnDefinitionOperations->getIdFromName($columnDefinitions,"storage"));
        array_push($columns, $column); 
        return $columns;
    }

    public function getTypes(){
        $types = array();
        $type = new CatalogPluginType();
        $type->setName("catalogo general");
        $type->setDescription("catalogo de prueba");
        array_push($types, $type); 
        return $types;
    }

    public function getTypeColumns($types,$columns){
        $columnOperations = new CatalogPluginColumnOperations();
        $typeOperations = new CatalogPluginTypeOperations();
        $typeColumns = array();
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"referencia"));
        array_push($typeColumns, $typeColumn);     
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"etiqueta"));
        array_push($typeColumns, $typeColumn);   
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"autor"));
        array_push($typeColumns, $typeColumn); 
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"titulo"));
        array_push($typeColumns, $typeColumn); 
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"comentario"));
        array_push($typeColumns, $typeColumn); 
        $typeColumn = new CatalogPluginTypeColumns();
        $typeColumn->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        $typeColumn->setIdColumn($columnOperations->getIdFromName($columns,"estuche"));
        array_push($typeColumns, $typeColumn); 
        return $typeColumns;
    }


    public function getCatalogs($types){
        $typeOperations = new CatalogPluginTypeOperations();
        global $wpdb;
        $tablePrefix = $wpdb->prefix . CatalogPluginCatalogConstants::$catalogdbPrefix;
        $catalogs = array();
        $catalog = new CatalogPluginCatalog();
        $catalog->setName("referencia");
        $catalog->setDescription("descripcion del campo");
        $catalog->setTableName($tablePrefix."prueba_tabla");
        $catalog->setIdType($typeOperations->getIdFromName($types,"catalogo general"));
        array_push($catalogs, $catalog);
        return $catalogs;
    }
    

    //$cart = array();
    //$cart[] = 13;
    //$cart[] = 14;
    // etc

//Is the same as:


//$cart = array();
//array_push($cart, 13);
//array_push($cart, 14);

// Or 
//$cart = array();
//array_push($cart, 13, 14);

}


















Class CatalogOperations{

    private static $tableName = null; // Nombre completo de la tabla, con los prefijos que se añaden para que sea un nombre de tabla unico
    private $subixTableName = "column_definition"; // Nombre con el que termina el nombre de la tabla, y que la identifica del resto
    
    function ChannelOperations($dbConnection){
        $this->dbConnection=$dbConnection;
    }

    public function getChannelVisibility($idUser){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from channels where id_user=$idUser";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $channel=new Channel();
            $channel->setIdUser($row['id_user']);
            $channel->setVisibility($row['visibility']);
            return $channel;
        }else{
            return null;
        }
    }

    public function updateOrInsert($idUser,$visibility){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from channels where id_user=$idUser";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            // Update
            $query="update channels set visibility='$visibility' where id_user=$idUser";
            $consulta=mysql_query($query,$conexion);
            if($consulta){
                return true;
            }else{
                return false;
            }  
        }else{
            // Insert
            $query="insert into channels(id_user,visibility) values('".$idUser."','".$visibility."')";
            //$query="insert into users(user,password,email) values('".$user->gerUser()."','".$user->getPassword()."','".$user->getEmail()."')";
            //echo "quer:".$query."<br/>";
            $consulta=mysql_query($query,$conexion);
            if($consulta){
                return true;
            }else{
                return false;
            }  
        }
    }
}

























Class UserOperations{
    private $dbConnection;
    
    function UserOperations($dbConnection){
        $this->dbConnection=$dbConnection;
    }

    public function getActiveUserFromUserName($userName){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from users where user='$userName' and active=1";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $user=new User();
            $user->setId($row['id']);
            $user->setUser($row['user']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            return $user;
        }else{
            return null;
        }
    }

    public function getUserFromUserName($userName){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from users where user='$userName'";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $user=new User();
            $user->setId($row['id']);
            $user->setUser($row['user']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            return $user;
        }else{
            return null;
        }
    }

    
    public function deleteUser($idUser){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="update users set active='0' where id=$idUser";
        echo "quer:".$query."<br/>";
        $consulta=mysql_query($query,$conexion);
        if($consulta){
            return true;
        }else{
            return false;
        }   
    }

    public function getUserFromEmail($email){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from users where email='$email'";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $user=new User();
            $user->setId($row['id']);
            $user->setUser($row['user']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            return $user;
        }else{
            return null;
        }
    }

    public function getActiveUser($userName,$userPassword){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select * from users where user='$userName' and password='".md5($userPassword)."' and active=1";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $user=new User();
            $user->setId($row['id']);
            $user->setUser($row['user']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            return $user;
        }else{
            return null;
        }
    }   
                    
    public function getActiveUserFromIdVideo($idVideo){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="select u.id id,u.user user,u.password password from users u,videos v where u.id=v.id_user and v.id=$idVideo and u.active=1";
        $consulta=mysql_query($query,$conexion);
        if($row=mysql_fetch_array($consulta)){
            $user=new User();
            $user->setId($row['id']);
            $user->setUser($row['user']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            return $user;
        }else{
            return null;
        }
    }

    public function insertUser($user){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="insert into users(user,password,email) values('".$user->getUser()."','".md5($user->getPassword())."','".$user->getEmail()."')";
        $consulta=mysql_query($query,$conexion);
        if($consulta){
            return true;
        }else{
            return false;
        }     
    }

    public function addUser($user){
        $this->insertUser($user);
        
        $newUser=$this->getUserFromUserName($user->getUser());
        $idUser=$newUser->getId();
        
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        $query="insert into channels(id_user,visibility) values(".$idUser.",1)";
        $consulta=mysql_query($query,$conexion);
        if($consulta){
            return true;
        }else{
            return false;
        }
    }


    public function updateUser($idUser,$email,$password){
        $tmp=$this->dbConnection;
        $conexion=$tmp->getConnection();
        if($password!=""){
            $query="update users set password='".md5($password)."',email='$email' where id=$idUser";
        }else{
            $query="update users set email='$email' where id=$idUser";
        }
        $consulta=mysql_query($query,$conexion);
        if($consulta){
            return true;
        }else{
            return false;
        }     
    }
    
}


?>