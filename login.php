<?php 
session_start(); 

if (isset($_SESSION['level'])){
	if ($_SESSION['level'] == 3){
		// if siswa redirect to their dashboard
		header('location:dashboard-siswa.php');
	} else {
		header('location:dashboard.php');
	}
}

if(isset($_POST['btn-login'])){

	include('inc/class.db.php');

	$db = new Database();
	$db->connect();

	$user = $db->escapeString($_POST['username']);
	$pass = $db->escapeString(md5($_POST['password']));

	$db->select('users', '*', '', 'username="'.$user.'" AND password="'.$pass.'"');
	$numRows = $db->numRows();
	$res = $db->getResult();

	// $sql = $db->getSql();


	// echo "<pre>";
	// print_r($sql);
	// echo "</pre>";
	// exit();

	if($numRows == 1){

		$_SESSION['id_user'] = $res[0]['id'];
		$_SESSION['username'] = $res[0]['username'];
		$_SESSION['nama'] = $res[0]['nama'];
		$_SESSION['level'] = $res[0]['level'];

		if ($res[0]['level'] == 3){
			// if siswa redirect to their dashboard and add session kelas
			$_SESSION['kelas'] = $res[0]['kelas_id'];
			header('location:dashboard-siswa.php');
		} else {
			header('location:dashboard.php');
		}

		// echo '<script language="javascript">alert("Anda berhasil Login '.$_SESSION['nama'].'!); document.location="dashboard.php";</script>';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Login - Aplikasi Bank Soal</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="" method="post">
		        <h2 class="form-login-heading">LOGIN</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="ID Pengguna / NIK" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Lupa Password?</a>
		
		                </span>
		            </label>
		            <button type="submit" class="btn btn-theme btn-block" name="btn-login"><i class="fa fa-lock"></i> LOGIN</button>
		            <hr>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Lupa Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Masukkan email anda.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
		                          <button class="btn btn-theme" type="button">Kirim</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/sinau.jpg", {speed: 500});
    </script>


  </body>
</html>
