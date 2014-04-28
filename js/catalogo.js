	jQuery(window).load(function() {
 

//alert('loadCatalogs');
	    	//alert(ajaxurl);
    	 	jQuery.post(
        		ajaxurl,
         		{
             		action: 'catalogoPlugin_getCatalog'
          		},
          		function( response ) {
              		//alert(response);
              		var obj = jQuery.parseJSON(response);
              		//alert(obj.text);
              		//alert(obj.result);
              		//alert(obj.object);
              		var lang = '';
              		// Se descargan los datos anteriores, por si hubiera ya datos cargados
              	    jQuery('#catalogs').jqGrid('GridUnload');
              	    // Se crea un grid para los catalogs
					jQuery("#catalogs").jqGrid({
					      datatype: "local",
					      height: 250,
					      width: 800,
					      colNames: ['Nombre', 'Descripcion'],
					      cellEdit: true,
					      colModel: [{
					          name: 'name',
					          index: 'name',
					          width: 60,
					          sorttype: "string"},
					      {
					          name: 'description',
					          index: 'description',
					          width: 90,
					          sorttype: "string",
					      	  editable: true}
					      ],
					      caption: "Catalogos",
 						  ondblClickRow: function(rowid,iRow,iCol,e){
 						  	//alert('ondblClickRow'+rowid);
 						  	showRealCatalog(rowid)
 						  }
					      /*,
					      // Eventos
					      afterInsertRow: function(rowid, rowdata, rowelem){alert('afterInsertRow')},
					      gridComplete: function(){alert('gridComplete')},
					      loadBeforeSend: function(xhr){alert('loadBeforeSend')},
					      loadComplete: function(){alert('loadComplete')},
					      loadError: function(xhr, st, err){alert('loadError')},
					      onCellSelect: function(rowid, iCol, cellcontent){alert('onCellSelect')},
					      ondblClickRow: function(rowid,iRow,iCol,e){alert('ondblClickRow'+rowid)},
					      onHeaderClick: function(gridstate){alert('onHeaderClick')},
					      onRightClickRow: function(rowid){alert('onRightClickRow')},
					      onSelectAll: function(array){alert('onSelectAll')},
					      onSelectRow: function(rowid){alert('onSelectRow')},
					      onSortCol: function(index, colindex, sortorder){alert('onSortCol')}*/
					   
					  });
					var names = ["name", "description"];
              		jQuery.each(obj.object, function() {
              			//alert("hola"+this['name']);
              			//this['id'];
              			//this['name'];
              			//this['description'];
              			mydata = {};
              			mydata[names[0]] = this['name'];
              			mydata[names[1]] = this['description'];
              			jQuery("#catalogs").addRowData(this['id'], mydata);
              			//alert(mydata);
				    	//alert(lang);
					});
              		//jQuery("#catalogs").html(obj.text);
         		}
    		);















	    jQuery("#formulario").submit(function(event) {
	    	alert('envio');
	        event.preventDefault();
	        jQuery.ajax({
	            type: 'POST',
	            dataType : "json",
         		url : ajaxurl,
	   
	            data:$("#formulario").serialize(),
	            success: function(response) {
		                if(response.type == "success") {
	               			alert("success");
			            }
			            else {
			               alert("Your vote could not be added")
			            }
			        }
	        });
	 
	    });

	    jQuery("#boton").click( function() {
	    	alert('hola');
	    	var parameters = {
			  	"uno":'parametro 1',
			  	"dos": 2
			  }

    	 	jQuery.post(
        		ajaxurl,
         		{
             		action: 'mi_funcion_accion',
             		myname: 'Babar',
             		parameters: parameters
          		},
          		function( response ) {
              		alert(response);
              		var lang = '';
					var obj = jQuery.parseJSON(response);
					alert(obj);
					jQuery.each(obj, function() {
				    	lang += this['name'] + "<br/>";
				    	alert(lang);
					});
					alert(lang);
         		}
    		);
      	}); 

      	jQuery("#loadCatalogs").click( function() {
	    	//alert('loadCatalogs');
	    	//alert(ajaxurl);
    	 	jQuery.post(
        		ajaxurl,
         		{
             		action: 'catalogoPlugin_getCatalog'
          		},
          		function( response ) {
              		//alert(response);
              		var obj = jQuery.parseJSON(response);
              		//alert(obj.text);
              		//alert(obj.result);
              		//alert(obj.object);
              		var lang = '';
              		// Se descargan los datos anteriores, por si hubiera ya datos cargados
              	    jQuery('#catalogs').jqGrid('GridUnload');
              	    // Se crea un grid para los catalogs
					jQuery("#catalogs").jqGrid({
					      datatype: "local",
					      width: 800,
					      colNames: ['Nombre', 'Descripcion'],
					      cellEdit: true,
					      colModel: [{
					          name: 'name',
					          index: 'name',
					          width: 60,
					          sorttype: "string"},
					      {
					          name: 'description',
					          index: 'description',
					          width: 90,
					          sorttype: "string",
					      	  editable: true,
					      	  editrules:{required:true}}
					      ],
					      caption: "Catalogos",
 						  ondblClickRow: function(rowid,iRow,iCol,e){
 						  	//alert('ondblClickRow'+rowid);
 						  	showRealCatalog(rowid)
 						  }
					      /*,
					      // Eventos
					      afterInsertRow: function(rowid, rowdata, rowelem){alert('afterInsertRow')},
					      gridComplete: function(){alert('gridComplete')},
					      loadBeforeSend: function(xhr){alert('loadBeforeSend')},
					      loadComplete: function(){alert('loadComplete')},
					      loadError: function(xhr, st, err){alert('loadError')},
					      onCellSelect: function(rowid, iCol, cellcontent){alert('onCellSelect')},
					      ondblClickRow: function(rowid,iRow,iCol,e){alert('ondblClickRow'+rowid)},
					      onHeaderClick: function(gridstate){alert('onHeaderClick')},
					      onRightClickRow: function(rowid){alert('onRightClickRow')},
					      onSelectAll: function(array){alert('onSelectAll')},
					      onSelectRow: function(rowid){alert('onSelectRow')},
					      onSortCol: function(index, colindex, sortorder){alert('onSortCol')}*/
					   
					  });
					var names = ["name", "description"];
              		jQuery.each(obj.object, function() {
              			//alert("hola"+this['name']);
              			//this['id'];
              			//this['name'];
              			//this['description'];
              			mydata = {};
              			mydata[names[0]] = this['name'];
              			mydata[names[1]] = this['description'];
              			// 
              			jQuery("#catalogs").addRowData(this['id'], mydata);
              			//alert(mydata);
				    	//alert(lang);
					});
              		//jQuery("#catalogs").html(obj.text);
         		}
    		);
      	}); 
    });  




	function addCatalogShow(){
		//alert("hola");
		jQuery("#catalogErrors").html("Hello World");
	}

	function showRealCatalog(id){
		// Si esta desplegada la capa, que se oculte
		//alert(ajaxurl);
		// Si no, que se muestre
		//alert(id);
		jQuery.post(
    		ajaxurl,
     		{
         		action: 'catalogoPlugin_getRealCatalogData',
         		id: id
      		},
      		function( response ) {
      			//alert("showRealCatalog");
          		//alert(response);
          		var obj = jQuery.parseJSON(response);
          		//alert(obj.result);
			//alert(obj.result);
     		//alert(obj.object.head);
     			

 			colModel = new Array();
 			colName = new Array();
 			/*
 			colMocel = [
			{propiedad1:value1, propiedad2:value2...}, ..., {propiedad1:value1, propiedad2:value2...}
 			]
 			*/
 			jQuery.each(obj.object.head, function() {
      			var obj = {};
      			obj['name']=this;
      			obj['editable']=true;
      			// id no será editable
      			if(this=='id'){
      				obj['editable']=false;
      			}
      			colName.push(this);
      			colModel.push(obj);
			});

 			// Se descargan los datos anteriores, por si hubiera ya datos cargados
            jQuery('#catalogContent').jqGrid('GridUnload');

      		jQuery("#catalogContent").jqGrid({
			      datatype: "local",
			      width: 800,
			      colNames: colName,
			      colModel: colModel,
			      //cellEdit: true,
			      rowNum:10,
   				  rowList:[10,20,30],
   				  pager: '#catalogContentPager',
   				  sortname: 'id',
   				  sortname: 'id',
    			  viewrecords: true,
    			  sortorder: "desc",
			      caption: "Contenido Catalogo"
			      /*,
			      // Eventos
			      afterInsertRow: function(rowid, rowdata, rowelem){alert('afterInsertRow')},
			      gridComplete: function(){alert('gridComplete')},
			      loadBeforeSend: function(xhr){alert('loadBeforeSend')},
			      loadComplete: function(){alert('loadComplete')},
			      loadError: function(xhr, st, err){alert('loadError')},
			      onCellSelect: function(rowid, iCol, cellcontent){alert('onCellSelect')},
			      ondblClickRow: function(rowid,iRow,iCol,e){alert('ondblClickRow'+rowid)},
			      onHeaderClick: function(gridstate){alert('onHeaderClick')},
			      onRightClickRow: function(rowid){alert('onRightClickRow')},
			      onSelectAll: function(array){alert('onSelectAll')},
			      onSelectRow: function(rowid){alert('onSelectRow')},
			      onSortCol: function(index, colindex, sortorder){alert('onSortCol')}*/
			});

     		jQuery("#catalogContent").jqGrid('navGrid',"#catalogContentPager",{edit:false,add:false,del:false});
			jQuery("#catalogContent").jqGrid('inlineNav',"#catalogContentPager");

     		jQuery.each(obj.object.data, function() {
     			//alert(this);
      			mydata = {};
      			//alert(this['id']);
      			//alert(this['referencia']);
      			/*jQuery.each(obj.object.head, function() {
      				mydata[obj.object.head[i]] = this[i];
	      			//alert(this);
				});*/
      			for(var i=0;i<colName.length;i++){
      				//alert(obj.object.head[i]);
      				//alert(this[i]);
       				mydata[colName[i]] = this[i];
      			}
      			jQuery("#catalogContent").addRowData(this['id'], mydata);
      			//alert(mydata);
		    	//alert(lang);
			});
          		//alert(obj.result);
          		//alert(obj.object);
     		}
     		
     		
		);
	}