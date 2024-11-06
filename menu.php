
      <li <?php if($page == "Dashboard") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <li <?php if($page == "Buat") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>        
      <a class="nav-link collapsed" href="create-kegiatan.php">
          <i class="far fa-fw fa-plus-square"></i>
          <span>Buat Laporan kegiatan</span>
        </a>
      </li>

      <li <?php if($page == "List") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="daftar-kegiatan.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Daftar kegiatan</span>
        </a>
      </li>
      
      <li <?php if($page == "Ubah") echo "class='nav-item active'";
      else 
      echo "class='nav-item'";
      ?>>     
              <a class="nav-link collapsed" href="ubah-akun.php">
          <i class="far fa-fw fa-user"></i>
          <span>Ubah Akun</span>
        </a>
      </li>