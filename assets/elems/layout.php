<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="Electronics store, Hardware store, Buy Laptops, Buy Monitors, Buy Smarthones, Buy TVSs">
		<title><?=$title ?></title>
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<div class="container">
		<div class="row">
		
			<header> 
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div class="navbar-collapse">
						<ul class="nav nav-tabs">
							<?php $nav = new Menu('category');
								echo $nav->showMenu();
							?>
						</ul>
					</div>
				</nav>
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="navbar-collapse">
						<ul class="navbar-nav">
							<a class="navbar-brand" href="index.php">НА ГЛАВНУЮ</a>				
							<?php if (isset($_SESSION['auth'])){
									include('priveHeader.php');
									}
									else{
										include('publicHeader.php');
									}
									?>
						</ul>
					</div>
				</nav>		
						
			</header>
			<main>
				<h1 class="h1"><?=$title ?></h1>
				<div class="note">
					
					
				<?php include "info.php";?>
				<?=$content ?>
			
				
				<nav>
					<ul class="nav nav-tabs">
						<?=$paging ?>
						
					</ul>
				</nav>
				</div>
				<footer>
					<?php include "footer.php";?>
				</footer>
			</main>
		
		</div>
		</div>
	</body>
</html>