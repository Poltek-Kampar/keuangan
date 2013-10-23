<?php

/**
 * Fungsi ini berguna untuk menampilkan Rekapitulasi Keuangan pada admin WordPress
 */
function keuangan_mahasiswaspp_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
	    case "create": keuangan_mahasiswaspp_create();break;
		case "read": keuangan_mahasiswaspp_read();break;
		case "yes": keuangan_mahasiswaspp_yes();break;
		case "no": keuangan_mahasiswaspp_no();break;
		default: keuangan_mahasiswaspp_panel();break;
	}
}

function keuangan_mahasiswaspp_panel(){
?>
	<table align="center" width="500" border="1">
	<h2><center>Mahasiswa SPP</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=create">Menambahkan Mahasiswa SPP</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=read">Lihat SPP Mahasiswa</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=yes">Lihat Mahasiswa harus Bayar SPP</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=no">Lihat Mahasiswa Yang Tidak Bayar SPP</a></h3></td></tr>
	</table>
	<?
}

function keuangan_mahasiswaspp_create(){
	global $wpdb;
	?><div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Data Mahasiswa SPP</h2>
    Lengkapi data Mahasiswa SPP di bawah ini :
	<?
	//check if option is set before saving
    if ( isset( $_POST['id_spp'] ) ) {
    //retrieve the option value from the form
		$id_mahasiswa =  mysql_real_escape_string($_POST['id_mahasiswa']) ;
		$id_spp =  mysql_real_escape_string($_POST['id_spp']) ;
		$wpdb->query(
		"INSERT INTO `{$wpdb->prefix}mahasiswaspp` (`id_mahasiswa` ,`id_spp`)
		VALUES ('$id_mahasiswa', '$id_spp');");
		echo "<h2>Sukses menyimpan data mahasiswa SPP $id_mahasiswa ke database</h2>";
	}
	?> 
	<form id="form1" name="form1" method="post" action="">
	<table class="form-table" >
    <tr>
	<th><label for="id_mahasiswa">Mahasiswa</label></th>
		<td>
		<!-- 
		SELECT id, nama FROM `{$wpdb->prefix}mahasiswa`
		-->
		<?php 
		global $wpdb;
		$mahasiswa = $wpdb->get_results("SELECT id, nama FROM `{$wpdb->prefix}mahasiswa`");
		?>
		<SELECT NAME="id_mahasiswa" ID="id_mahasiswa">
		  <OPTION VALUE=""></OPTION>
		<?php
		foreach ( $mahasiswa as $nahasiswaspp ) 
		{
			echo "<OPTION VALUE=\"$nahasiswaspp->id;\" ". selected($mahasiswa->id,$nahasiswaspp->id).">$nahasiswaspp->nama</OPTION>";
		}
		?>
		</SELECT>	  
		<br />
			<span class="description">Pilih Nama Mahasiswa ! </span>
		</select>
		 </td>
  </table>
  
  <table class="form-table" >
  <th><label for="id_spp">SPP</label></th>
		<td>

		<?php 
		global $wpdb;
		$spps = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}spp`");
		?>
		<SELECT NAME="id_spp" ID="id_spp">
		  <OPTION VALUE=""></OPTION>
		<?php
		foreach ( $spps as $spp ) 
		{
			echo "<OPTION VALUE=\"$spp->id;\" ". selected($spps->id,$spp->id).">$spp->tahun_ajaran $spp->semester</OPTION>";
		}
		?>
		</SELECT>	  
		<br />
			<span class="description">Pilih SPP ! </span>
		</select>
		 </td>
  </tr>
  </table>
  <br>
		<b><h3><input type=submit name=submit value=Daftar></h3></b>
		<b><h3><input type=reset name=reset value=Batal></h3></b>
	</form>
		<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></h3>
	<?php
}

function keuangan_mahasiswaspp_read(){
	echo "Daftar SPP Mahasiswa Politeknik Kampar";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$spps = $wpdb->get_results("
		SELECT 
			`{$wpdb->prefix}mahasiswaspp_v`.nama, 
			`{$wpdb->prefix}mahasiswaspp_v`.tahun_ajaran, 
			`{$wpdb->prefix}mahasiswaspp_v`.semester, 
			`{$wpdb->prefix}mahasiswaspp_v`.besar
		FROM 
			(
			`{$wpdb->prefix}mahasiswaspp_v`)");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
	<th width=20>Nama</th>
    <th width=18>Tahun Ajaran</th>
    <th width=20>Semester</th>
	<th width=20>Besar</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>". $spp->nama. "</td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></center></h3>
	<?
}

function keuangan_mahasiswaspp_yes(){
global $wpdb;
?>
	<table align="center" width="500" border="1">
	<h2><center>Mahasiswa SPP</center></h2>
	<tr><td align='center'>No</td>
	    <td align='center'>Tahun Ajaran</td>
	    <td align='center'>Semester</td>
	    <td align='center'>Besar</td>
		<td align='center'>Jumlah Mahasiswa Total</td>
		<td align='center'>Jumlah Mahasiswa Lunas</td>
		<td align='center'>Jumlah Mahasiswa Menunggak</td>
		<td align='center'>Operasi</td>
	</tr>
	<?
	$L=1;
	
	$spps=$wpdb->get_results("SELECT * FROM {$wpdb->prefix}spp ORDER BY tahun_ajaran ");
	foreach ( $spps as $spp )	
	{
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
		</tr>";
	}
	echo "</table>";
}
