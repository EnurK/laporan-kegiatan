
      <!--menu -->
      
      <?php if($_SESSION=="Admin"){?>
      <li <?php if($page == "Dashboard") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>
        <a class="nav-link" href="index-admin.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <?php }
      else{?>
            <li <?php if($page == "Dashboard") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>
        <a class="nav-link" href="index-admin.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <?php }?>
      

      <li <?php if($page == "pesan") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>        
      <a class="nav-link collapsed" href="laporan-kegiatan.php">
          <i class="far fa-fw fa-comment"></i>
          <span>Laporan kegiatan Baru</span>
        </a>
      </li>

      <li <?php if($page == "kegiatan") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-kegiatan.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Semua kegiatan</span>
        </a>
      </li>
      
      <li <?php if($page == "user") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-user.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Panwascam</span>
        </a>
      </li>  


      <?php if($_SESSION=="Admin"){?>
      <li <?php if($page == "admin") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-admin.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar Admin</span>
        </a>
      </li>
      <?php } ?>
      
      
