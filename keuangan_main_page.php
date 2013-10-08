<?php

/**
 * Fungsi ini berguna untuk menampilkan Rekapitulasi Keuangan pada admin WordPress
 */
function keuangan_main_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
		case "read": keuangan_spp_tps();break;
		case "create": keuangan_spp_ppm();break;
		case "delete": keuangan_spp_tif();break;
		default: keuangan_spp_panel();break;
	}
}


function keuangan_spp_panel(){
	?>
	<table align="center" width="250" border="1">
	<h2><center>Rekapitulasi Pembayaran SPP</center></h2>
	<tr><td align=center><h3>Total Pembayaran SPP adalah Rp</h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=read">Prodi TPS</a>adalah Rp </h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Prodi PPM</a>adalah Rp </h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Prodi TIF</a>adalah Rp </h3></td>
	</tr>
	</table>
	<?
}


function keuangan_spp_tps(){
	?>
	<table align="center" width="250" border="1">
	<h2><center>PROGRAM STUDI TPS</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2008</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2009</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2010</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2011</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2012</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2013</a></h3></td>
	</tr>
	</table>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></center></h3>
	<?
}


function keuangan_spp_tif(){
	?>
	<table align="center" width="250" border="1">
	<h2><center>PROGRAM STUDI PPM</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2008</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2009</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2010</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2011</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2012</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2013</a></h3></td>
	</tr>
	</table>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a><center></h3>
	<?
}

function keuangan_spp_ppm(){

	?>
	<table align="center" width="250" border="1">
	<h2><center>PROGRAM STUDI TIF</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2008</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2009</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2010</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">Angkatan 2011</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Angkatan 2012</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">Angkatan 2013</a></h3></td>
	</tr>
	</table>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a><center></h3>
	<?
}