<?php
include_once("conn.php");
include_once('function.php');

if(isset($_POST['pageId']) && !empty($_POST['pageId'])){
   $id=$_POST['pageId'];
}else{
   $id='0';
}
$pageLimit=PAGE_PER_NO*$id;
$query="select CustomerID,ContactName,City from customers order by CustomerID desc
limit $pageLimit,".PAGE_PER_NO;

$stmt=$db->prepare($query);
$res=$stmt->execute();
$count=$stmt->rowCount();
$HTML='';
if($count > 0){
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
   $post=$row['ContactName'];
   $link=$row['City'];
   $HTML.='<div>';
   $HTML.='<a href="'.$link.'" target="blank">'.$post.'</a>';
   $HTML.='</div><br/>';
}
}else{
    $HTML='No Data Found';
}
echo $HTML;
?>