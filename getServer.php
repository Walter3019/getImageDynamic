<?php
 	$result="";

    function opendb(){
        $conn=@mysql_connect("localhost","root","root")  or die(mysql_error());
        @mysql_select_db('test',$conn) or die(mysql_error());   
    }
 
    function closedb(){
        @mysql_close() or die("wrong");
    }
 
    opendb();
 
    if(isset($_POST['send'])=='true'){
        $username = isset($_POST['username'])? $_POST['username'] : '';  
        $filename = time().substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'],'.'));  
 
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $filename)){  
            $sqlstr = "insert into member(`username`,`photo`) values('".addslashes($username)."','".addslashes($filename)."')";
            @mysql_query($sqlstr) or die(mysql_error());
        }  
    }
 
    echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
 
    $sqlstr = "select * from member";
    $query = mysql_query($sqlstr) or die(mysql_error());
 
    while($thread=mysql_fetch_assoc($query)){
        $result[] = $thread;
    }
?>