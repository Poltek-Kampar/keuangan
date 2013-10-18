<?php

/**
 * Fungsi ini berguna untuk menampilkan Rekapitulasi Keuangan pada admin WordPress
 */
function keuangan_pembayaran_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
	    case "create": keuangan_pembayaran_create();break;
		default: keuangan_pembayaran_panel();break;
	}
}

function keuangan_pembayaran_panel(){
?>
	<table align="center" width="500" border="1">
	<h2><center>Pembayaran</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=create">Menambahkan Pembayaran SPP</a></h3></td>
	</tr>
	</table>
	<?
}

function keuangan_pembayaran_create(){
	global $wpdb;
	?><div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Data Pembayaran SPP</h2>
    Lengkapi data Pembayaran di bawah ini :
	<?
	//check if option is set before saving
    if ( isset( $_POST['id_spp'] ) ) {
    //retrieve the option value from the form
		//$timestamp =  mysql_real_escape_string($_POST['timestamp']) ;
		$id_mahasiswa =  mysql_real_escape_string($_POST['id_mahasiswa']) ;
		$id_spp =  mysql_real_escape_string($_POST['id_spp']) ;
		$jumlah_bayar =  mysql_real_escape_string($_POST['jumlah_bayar']) ;
		$wpdb->query(
		"INSERT INTO `{$wpdb->prefix}pembayaran` (`id_mahasiswa` ,`id_spp` ,`jumlah_bayar`)
		VALUES ( '$id_mahasiswa', '$id_spp', '$jumlah_bayar');");
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
  <tr>
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
			echo "<OPTION VALUE=\"$spp->id;\" ". selected($spps->id,$spp->id).">$spp->tahun_ajaran $spp->semester $spp->besar</OPTION>";
		}
		?>
		</SELECT>	  
		<br />
			<span class="description">Pilih SPP ! </span>
		</select>
		 </td>
	</table>
	
	<table class="form-table" >
    <tr>
	<th><label for="jumlah_bayar">Jumlah Bayar</label></th>
	  <td>
        <input type="text" id="jumlah_bayar" name="jumlah_bayar" value="<?php echo $jumlah_bayar;?>" class="regular-text">
        <br />
      </td>
	</tr>
    </table>
	
  </tr>
  <br>
		<b><h3><input type=submit name=submit value=Bayar></h3></b>
		<b><h3><input type=reset name=reset value=Batal></h3></b>
	</form>
		<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></h3>
	<?php
}
