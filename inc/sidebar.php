<?php 
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = '';
	}

?>

<div class="sidebar" id="sidebarToggler">
    <div class="text-center mb-4 border-bottom">
        <h4 class="text-white"><?= ucfirst($role) ?></h4>
    </div>
    <ul class="nav flex-column">
        <?php if ($role == 'admin') { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'dashboard' || $page == '') ? 'active' : '' ?>" href="?page=dashboard"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= ($page == 'courses') ? 'active' : '' ?>" href="?page=courses"><i class="fas fa-file-alt"></i> Courses</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link <?= ($page == 'subjects') ? 'active' : '' ?>" href="?page=subjects"><i class="fas fa-file-alt"></i> Subjects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'staff') ? 'active' : '' ?>" href="?page=staff"><i class="fas fa-chalkboard-teacher"></i> Staff</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($page == 'students') ? 'active' : '' ?>" href="?page=students"><i class="fas fa-user-graduate"></i> Students</a>
            </li>
        <?php } ?>
        
        <?php if ($role == 'teacher') { ?>
            <li class="nav-item ">
                <a class="nav-link <?= ($page == 'lessons') ? 'active' : '' ?>" href="?page=lessons"><i class="fas fa-file-alt"></i> Lessons</a>
            </li>
        <?php } ?>
            
        <li class="nav-item">
            <a class="nav-link <?= ($page == 'profile') ? 'active' : '' ?>" href="?page=profile"><i class="fas fa-chalkboard-teacher"></i> Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-power-off"></i> Logout</a>
        </li>
    </ul>
</div>

<script>

</script>




