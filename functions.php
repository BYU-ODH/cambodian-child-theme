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
		if (is_page ('280')) { 
		  ?>  
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.js"></script>
			  <script type="text/javascript">
				
				jQuery(document).ready(function() {
					var table = jQuery('#myTable').DataTable(
						{
							searchPane:{
								columns:[':contains("Gender")',':contains("Birth Province")',':contains("story")',]
								, threshold: 0
							 }
						}
						
					
					);
	
	
					jQuery.fn.dataTable.ext.search.push(
								function( settings, data, dataIndex ) {
									var min = parseInt( $('#min').val(), 10 );
									var max = parseInt( $('#max').val(), 10 );
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
	  