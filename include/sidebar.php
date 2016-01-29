<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>Beranda
                </a></li>
            <li><a href="about.php"><i class="menu-icon fa fa-institution"></i> About </a>
            </li>
            <li><a href="kegiatan.php"><i class="menu-icon fa fa-soccer-ball-o"></i> Kegiatan </a>
            </li>
            <li><a href="karyawan.php"><i class="menu-icon fa fa-graduation-cap"></i>Karyawan </a>
            </li>
            <li><a href="peserta_didik.php"><i class="menu-icon fa fa-odnoklassniki"></i> Peserta Didik </a></li>
        </ul>

        <ul class="widget widget-menu unstyled">            
            <?php if($_SESSION['level'] == 1){ ?>
                <li>
                <a class="collapsed" data-toggle="collapse" href="#settings"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>Pengaturan </a>
                <ul id="settings" class="unstyled collapse" style="height: 0px;">
                    <li><a href="user.php"><i class="icon-group"></i> User </a></li>
                    <li><a href="lokasi.php"><i class="fa fa-location-arrow"></i> Lokasi </a></li>
                    <li><a href="agama.php"><i class="fa fa-ticket"></i> Agama </a></li>
                    <li><a href="pekerjaan.php"><i class="fa fa-black-tie"></i> Pekerjaan </a></li>
                    <li><a href="jenis_kelamin.php"><i class="fa fa-venus-mars"></i> Jenis Kelamin </a></li>
                </ul>
            </li>
            <?php }else{
                echo "";
            } ?>
            <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Keluar </a></li>
        </ul>
        <!--/.widget-nav-->
    </div>
    <!--/.sidebar-->
</div>