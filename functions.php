<?php 
    function my_theme_enqueue_styles() {
 
        $parent_style = 'septera-style';
     
        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

	function wpb_hook_javascript() {
		if (is_page ('280','10812')) { 
		  ?>  
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<!--<script src="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.js"></script>-->
			  <script type="text/javascript">
				
				jQuery(document).ready(function() {
					var table = jQuery('#myTable').DataTable(
						{
							// searchPane:{
							// 	columns:  [':contains("Gender")',':contains("Birth Province")',':contains("story")',]
							// 	 , threshold: 0
							 // }
						}
						
					
					);
	
	
					jQuery.fn.dataTable.ext.search.push(
								function( settings, data, dataIndex ) {
									var min = parseInt( jQuery('#min').val(), 10 );
									var max = parseInt( jQuery('#max').val(), 10 );
									var age = parseInt( data[6] ) || 0; // use data for the age column
								   
									if ( ( isNaN( min ) && isNaN( max ) ) ||
										( isNaN( min ) && age <= max ) ||
										( min <= age   && isNaN( max ) ) ||
										( min <= age   && age <= max ) )
									{
										return true;
										
									}
									return false;
									
								}
							);
					jQuery.fn.dataTable.ext.search.push(
						function( settings, searchData, index, rowData, counter ) {
						var gender = jQuery('input:checkbox[name="gender"]:checked').map(function() {
							 return this.value;					 
						}).get();
	
						if (gender.length === 0) {
								return true;
							}
							
						if (gender.indexOf(searchData[8]) !== -1) {
							return true;
						}
						
						
						return false;
	
						}
					);
	
					jQuery.fn.dataTable.ext.search.push(
						function( settings, searchData, index, rowData, counter ) {
						var birth = jQuery('input:checkbox[name="Birth"]:checked').map(function() {
							 return this.value;					 
						}).get();
	
						if ( birth.length === 0) {
								return true;
							}
							
						if ( birth.indexOf(searchData[9]) !== -1) {
							return true;
						}
						
						return false;
	
						}
					);
	
	
					jQuery.fn.dataTable.ext.search.push(
						function( settings, searchData, index, rowData, counter ) {
						var storys = jQuery('input:checkbox[name="story"]:checked').map(function() {
							 return this.value;					 
						}).get();
						var stories = searchData[7].split(',');
						var text = "";
						for (x in stories) {
							text += stories[x] + " ";
						}
	
					   if (storys.length === 0) {
							return true;
						}
	
						for(var i=0;i<storys.length;i++){
							if(text.includes(storys[i])==true){
								return true;
							}
						}
						
						// else if (storys.length != 0){
						// 	for(var i=0;i<stories.length;i++){
						// 		var k=stories[i];
						// 		console.log(k);
						// 		for(var g=0;g<storys.length;g++){
						// 			console.log(m);
						// 			console.log("------------------");
						// 			var m=storys[g];
						// 				if(m==k)
						// 					{
						// 						return true;
						// 					}
	
						// 		}
								
						// 	}
						// }
						
						
						return false;
						
						
						//  if (storys.indexOf(searchData[7]) !== -1) {
							 
						// 	console.log("go");
						//  }
	
						// if ( stories.some(r=> storys.includes(r))==true){
						// 	return true;
						// }
						
						// console.log(storys);
						// console.log("-");
						// console.log(stories);
						// console.log("-");
					
						// console.log(check);
						// console.log("-----------------------------------");
					  //  return storys.some(item=>stories.includes(item));
	
						
						//return false;
						}
					);
	
					
					// Event listener to the two range filtering inputs to redraw on input
					jQuery('#min, #max').keyup( function() {
						
						table.draw();
	
						
					} );
	
					jQuery('input:checkbox').on('change', function () {					
						table.draw();					
					});
	
	
				} );
	
	
				function myFunction(){
				var inputMin,inputMax,table,tr,td,i,filter,filter2,age,checkage;
				inputMin = document.getElementById("input");
				inputMax = document.getElementById("input2");
				filter= parseInt(inputMin.value);
				filter2= parseInt(inputMax.value);
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");
	
				for(i=0;i<tr.length;i++){
				age=parseInt(document.getElementById("myTable").rows[i].cells[6].innerHTML);
				if(filter<=age && age<= filter2){
	
				tr[i].style.display="";
				}
				else{
				tr[i].style.display="none";
				//document.getElementById("myTable").deleteRow(i);
				
				}
				}
				}
	
				// function Story(){
				// var y,table,tr,td; var x= document.getElementsByName("story");
				// table = document.getElementById("myTable");
				// tr = table.getElementsByTagName("tr");
				// for(i = 0; i < x.length; i++) { 
				// 				if(x[i].checked) 
				// 				y=x[i].value; 
				// 			}
				// for(i=1;i<tr.length;i++){
				// var story = document.getElementById("myTable").rows[i].cells[7].innerHTML;
				// var n=story.includes(y);
				// if(y=="All Stories" || y==null){
				// tr[i].style.display="";
				// }
				// else if(n==true || n==null){
	
				// tr[i].style.display="";
				// }
				// else{ 
				// tr[i].style.display="none";
				// //document.getElementById("myTable").deleteRow(i);
				// }
				// }
				// }
	
				function Filter() {
				var x = document.getElementById("show");
	
					if (x.style.display === "none"  ) {
						x.style.display = "block";
						document.getElementById("btn").innerHTML ="Hide All Filters";
						
					} else {
						x.style.display = "none";
						document.getElementById("btn").innerHTML ="Show All Filters";
					
					}
				
			
				}
	
			  </script>
		  <?php
		}
	  }
	  add_action('wp_head', 'wpb_hook_javascript');
	
	  /* radio button and default to unknown */
	  if ( !class_exists( 'WDS_Taxonomy_Radio' ) ) {
		/**
		 * Removes and replaces the built-in taxonomy metabox with our radio-select metabox.
		 * @link  http://codex.wordpress.org/Function_Reference/add_meta_box#Parameters
		 */
		class WDS_Taxonomy_Radio {
	  
		   // Post types where metabox should be replaced (defaults to all post_types associated with taxonomy)
		   public $post_types = array();
		   // Taxonomy slug
		   public $slug = '';
		   // Taxonomy object
		   public $taxonomy = false;
		   // New metabox title. Defaults to Taxonomy name
		   public $metabox_title = '';
		   // Metabox priority. (vertical placement)
		   // 'high', 'core', 'default' or 'low'
		   public $priority = 'high';
		   // Metabox position. (column placement)
		   // 'normal', 'advanced', or 'side'
		   public $context = 'side';
		   // Set to true to hide "None" option & force a term selection
		   public $force_selection = true;
	  
	  
		   /**
			* Initiates our metabox action
			* @param string $tax_slug      Taxonomy slug
			* @param array  $post_types    post-types to display custom metabox
			*/
		   public function __construct( $tax_slug, $post_types = array() ) {
	  
			  $this->slug = $tax_slug;
			  $this->post_types = is_array( $post_types ) ? $post_types : array( $post_types );
	  
			  add_action( 'add_meta_boxes', array( $this, 'add_radio_box' ) );
	
		   }
	  
		   /**
			* Removes and replaces the built-in taxonomy metabox with our own.
			*/
		   public function add_radio_box() {
			  foreach ( $this->post_types() as $key => $cpt ) {
				 // remove default category type metabox
				 remove_meta_box( $this->slug .'div', $cpt, 'side' );
				 // remove default tag type metabox
				 remove_meta_box( 'tagsdiv-'.$this->slug, $cpt, 'side' );
				 // add our custom radio box
				 add_meta_box( $this->slug .'_radio', $this->metabox_title(), array( $this, 'radio_box' ), $cpt, $this->context, $this->priority );
			  }
		   }
	  
		   /**
			* Displays our taxonomy radio box metabox
			*/
		   public function radio_box() {
	  
			  // uses same noncename as default box so no save_post hook needed
			  wp_nonce_field( 'taxonomy_'. $this->slug, 'taxonomy_noncename' );
	  
			  // get terms associated with this post
			  $names = wp_get_object_terms( get_the_ID(), $this->slug );
			  // get all terms in this taxonomy
			  $terms = (array) get_terms( $this->slug, 'hide_empty=0' );
			  // filter the ids out of the termsd
			  $existing = ( !is_wp_error( $names ) && !empty( $names ) )
				 ? (array) wp_list_pluck( $names, 'term_id' )
				 : array();
			  // Check if taxonomy is hierarchical
			  // Terms are saved differently between types
			  $h = $this->taxonomy()->hierarchical;
	  
			  // default value
			  $default_val = $h ? 0 : '';
			  // input name
			  $name = $h ? 'tax_input['. $this->slug .'][]' : 'tax_input['. $this->slug .']';
			  echo '<div style="margin-bottom: 5px;">
			  <ul id="'. $this->slug .'_taxradiolist" data-wp-lists="list:'. $this->slug .'_tax" class="categorychecklist form-no-clear">';
	  
				 // If 'category,' force a selection, or force_selection is true
				 if ( $this->slug != 'category' && !$this->force_selection ) {
					// our radio for selecting none
					echo '<li id="'. $this->slug .'_tax-0"><label><input value="'. $default_val .'" type="radio" name="'. $name .'" id="in-'. $this->slug .'_tax-0" ';
					checked( empty( $existing ) );
					echo '> '. sprintf( __( 'No %s', 'wds' ), $this->taxonomy()->labels->singular_name ) .'</label></li>';
				 }
			  // loop our terms and check if they're associated with this post
			  foreach ( $terms as $term ) {
	  
				 $val = $h ? $term->term_id : $term->slug;
				 echo '<li id="'. $this->slug .'_tax-'. $term->term_id .'"><label><input value="'. $val .'" type="radio" name="'. $name .'" id="in-'. $this->slug .'_tax-'. $term->term_id .'" ';
				 // if so, they get "checked"
				 
				 checked( !empty( $existing ) && in_array( $term->term_id, $existing ) );
				 
				 echo '> '. $term->name .'</label></li>';
			  }
			  echo '</ul></div>';
	  
		   }
	  
		   /**
			* Gets the taxonomy object from the slug
			* @return object Taxonomy object
			*/
		   public function taxonomy() {
			  $this->taxonomy = $this->taxonomy ? $this->taxonomy : get_taxonomy( $this->slug );
			  return $this->taxonomy;
		   }
	  
		   /**
			* Gets the taxonomy's associated post_types
			* @return array Taxonomy's associated post_types
			*/
		   public function post_types() {
			  $this->post_types = !empty( $this->post_types ) ? $this->post_types : $this->taxonomy()->object_type;
			  return $this->post_types;
		   }
	  
		   /**
			* Gets the metabox title from the taxonomy object's labels (or uses the passed in title)
			* @return string Metabox title
			*/
		   public function metabox_title() {
			  $this->metabox_title = !empty( $this->metabox_title ) ? $this->metabox_title : $this->taxonomy()->labels->name;
			  return $this->metabox_title;
		   }
	  
	  
		}
	  
		$custom_tax_mb = new WDS_Taxonomy_Radio( 'gender' );
	  
	 }
	
	 function mfields_set_default_object_terms( $post_id, $post ) {
		if ( 'publish' === $post->post_status  ) {
			$defaults = array(
				'gender' => array( 'Unknown'),
				);
			$taxonomies = get_object_taxonomies( $post->post_type );
			foreach ( (array) $taxonomies as $taxonomy ) {
				$terms = wp_get_post_terms( $post_id, $taxonomy );
				if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
					wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
				}
			}
		}
	}
	add_action( 'save_post', 'mfields_set_default_object_terms', 100, 2 );