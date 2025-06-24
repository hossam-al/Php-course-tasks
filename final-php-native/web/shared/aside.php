<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link" href="<?= url('index.php') ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
    <hr>
    <a class="nav-link collapsed" href="<?= url('app/admins') ?>">
    <i class="bi bi-people"></i>
          <span>Admins</span>
    </a>

    <a class="nav-link collapsed" href="<?= url('app/instructors') ?>">
    <i class="bi bi-people"></i>
          <span>instrctors</span>
    </a>
    <a class="nav-link collapsed" href="<?= url('app/students') ?>">
    <i class="bi bi-people"></i>  
        <span>students</span>
    </a>
  </li><!-- End Dashboard Nav -->

 
  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= url('profile.php') ?>">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

 
 
 
 
</ul>

</aside><!-- End Sidebar-->
