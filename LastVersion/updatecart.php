<?php
session_start();

$pid=$_POST['pid'];
$qty=$_POST['qty'];
$user = $_SESSION['username'];

if(isset($_POST['up'])){
for($i=0;$i<count($pid);++$i)
  $_SESSION['mycart'][$pid[$i]]=$qty[$i];
header('location:cart.php');
}


else if(isset($_POST['po'])){
  try{
      require('connection.php');
      $db->beginTransaction();
      $sql = "insert into orders values(null,?,NOW(),'Order Placed')";
      $stmt1=$db->prepare($sql);
      $stmt1->execute(array($user));
      $newid=$db->lastinsertid();
      $sql2="insert into order_items values(null,$newid,?,?)";
      $stmt2=$db->prepare($sql2);
      for($i=0;$i<count($pid);++$i){
        $stmt2->execute(array($pid[$i],$qty[$i]));

        $updateSql = "UPDATE products SET Quantity = Quantity - ? WHERE Pid = ?";
        $updateStmt = $db->prepare($updateSql);
        $updateStmt->execute(array($qty[$i], $pid[$i]));
      }

      $db->commit();
      $db=null;
      unset($_SESSION['mycart']);
      header('location:sucess.php');
      

  }
  catch(PDOException $e){
      $db->rollBack();
      die($e->getMessage());
  }
}
?>

