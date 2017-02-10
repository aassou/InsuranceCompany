<div class="navbar-inner">
	<div class="container-fluid">
	    <a class="brand"><img src="../assets/img/logo-index.png" alt="logo" /></a>
		<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <img src="../assets/img/menu-toggler.png" alt="" />
		</a>    	
		<ul class="nav pull-right">
		    <li class="dropdown" id="header_inbox_bar">
                <a href="collaboration.php" class="dropdown-toggle">
                <i class="icon-edit"></i>
                <span class="badge"></span>
                </a>
            </li>
		    <li class="dropdown" id="header_inbox_bar">
                <a href="todo.php" class="dropdown-toggle">
                <i class="icon-check"></i>  
                <span class="badge"><?= 2 ?></span>
                </a>
            </li>
		    <li class="dropdown" id="header_inbox_bar">
                <a href="alert.php" class="dropdown-toggle">
                <i class="icon-bullhorn"></i>  
                <span class="badge"><?= 5 ?></span>
                </a>
            </li>
			<li class="dropdown" id="header_inbox_bar">
				<a href="tasks.php" class="dropdown-toggle">
				<i class="icon-tasks"></i>
				<span class="badge"><?= 7 ?></span>
				</a>
			</li>
			<li class="dropdown" id="header_inbox_bar">
                <a href="bugs.php" class="dropdown-toggle">
                <i class="icon-warning-sign"></i> 
                <span class="badge"><?= 1 ?></span>
                </a>
            </li>
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-user"></i>
				</a>
				<ul class="dropdown-menu">
					<li><a href="user-profil.php"><i class="icon-user"></i>&nbsp;<?= ucfirst($_SESSION['userAxaAmazigh']->login()); ?></a></li>
					<li class="divider"></li>
					<li><a href="logout.php"><i class="icon-key"></i>&nbsp;Déconnexion</a></li>
				</ul>
			</li>
		</ul>	
	</div>
</div>