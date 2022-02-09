# Display

```
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/preview/searchPane/dataTables.searchPane.min.css">
<link rel="stylesheet"  href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kryogenix.org/code/browser/sorttable/sorttable.js"></script>


<style>
table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after { 
    content: " \25B4\25BE" 
}
</style>

<div class="pane">          

<div class="table-responsive-sm">
<table class="display" style="width:100%" id="myTable">


    <thead>
	<tr>
  	    <th class="text-center sorttable_nosort"><h5></h5></th>
	    <th class="text-center"><h5>ឈ្មោះ<br/>Name</h5></th>
            <th class="text-center" id="content-desktop"><h5>អាយុពេលដែលសម្ភាស<br/>Age at Interview</h5></th>
	    <th class="text-center sorttable_nosort" id="content-desktop"><h5>អត្ថបទនៃការសម្ភាស<br/>Transcript</h5></th>
        </tr>
    </thead>
    <tbody>
     
       
<?php while ( have_posts() ): the_post(); ?>
  <?php echo pods( 'interviewee', get_the_id() )->template( 'Interviewee Directory' ); ?>
<?php endwhile; ?>



    </tbody>
</table>
</div>
```
  
# Query
```
<?php
return [
  "post_type" => "interviewee",
  "post_status" => [
    "publish"
  ],
  "facetwp" => true,
"posts_per_page" => "20",
];
```
