<html>
<head>
	<title>Pagination Test</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<style>
	body{
		font: 400 15px/20px 'Roboto','Helvetica Neue',Helvetica,sans-serif !important;
	}
	</style>
</head>
<body>
	<?php
	include_once('conn.php');
	include_once('function.php');
	$query="select CustomerID from customers order by CustomerID desc";
	$res=$db->query($query);
	$count=$res->rowCount($res);
	$pagination=0;
	if($count > 0){
	      $paginationCount=getPagination($count);
	}else{
		echo "no records";
	}
	 
	$content ='<div id="pageData"></div>';
	if($count > 0){
	 
	$content .='<nav><ul class="pagination">
	    <li class="first link" id="first">
	        <a  href="javascript:void(0)" onclick="changePagination(\'0\',\'first\')">F i r s t</a>
	    </li>';
	    for($i=0;$i<$paginationCount;$i++){
	 
	        $content .='<li id="'.$i.'_no" class="link">
	          <a  href="javascript:void(0)" onclick="changePagination(\''.$i.'\',\''.$i.'_no\')">
	              '.($i+1).'
	          </a>
	    </li>';
	    }
	    $content .='<li class="last link" id="last">
	         <a href="javascript:void(0)" onclick="changePagination(\''.($paginationCount-1).'\',\'last\')">L a s t</a>
	    </li>
	    <li class="flash"></li>
	</ul></nav>';
	echo $content;
	}


?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
function changePagination(pageId,liId){
     $(".flash").show();
     $(".flash").fadeIn(400).html
                ('Loading <img src="ajax-loader.gif" />');
     var dataString = 'pageId='+ pageId;
     $.ajax({
           type: "POST",
           url: "loadData.php",
           data: dataString,
           cache: false,
           success: function(result){
                 $(".flash").hide();
                 $(".link a").removeClass("In-active current") ;
                 $("#"+liId+" a").addClass( "In-active current" );
                 $("#pageData").html(result);
           }
      });
}
</script>
</body>

</html>
