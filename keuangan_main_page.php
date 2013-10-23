<?php

/**
 * Fungsi ini berguna untuk menampilkan Rekapitulasi Keuangan pada admin WordPress
 */
function keuangan_main_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
		case "tps": keuangan_main_tps();break;
		case "ppm": keuangan_main_ppm();break;
		case "tif": keuangan_main_tif();break;
		default: keuangan_main_panel();break;
	}
}


function keuangan_main_panel(){
	global $wpdb;
		$detail = $wpdb->get_results("
			SELECT SUM(`{$wpdb->prefix}detail_v`.tunggakan) AS tunggakan
			FROM
				`{$wpdb->prefix}detail_v`");
			
	foreach($detail as $mahasiswa){
	?>
	<form id="form1" name="form1" method="post" action="<?php echo admin_url("admin.php");?>?page=<?php echo $_REQUEST['page']; ?>&crud=telah&nim="<?php echo $mahasiswa->nim; ?>">
	<input type=hidden name=nim value="<?php echo $mahasiswa->nim;?>" />
	<table class="form-table" >
	<h2>Rekapitulasi Pembayaran SPP</h2>
	
	<tr><label align=center for="tunggakan">Total Tunggakan SPP</label>
          <input type="text" id="tunggakan" name="tunggakan" value="<?php echo $mahasiswa->tunggakan;?>" class="regular-text">
	</tr>
	</table>
	<?
			$detailtps = $wpdb->get_results("
			SELECT SUM( `{$wpdb->prefix}detail_v`.tunggakan ) AS tps
			FROM `{$wpdb->prefix}detail_v`
			WHERE program_studi = 'Teknik Pengolahan Sawit'");
	foreach($detailtps as $mahasiswa){
	?>
	<table class="form-table" >
	<tr><label align=center for="detailtps"></label>Total Tunggakan SPP <a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=tps">Prodi TPS</a>
		 <input type="text" id="detailtps" name="detailtps" value="<?php echo $mahasiswa->tps;?>" class="regular-text">
	</tr>
	</table>
	<?
			$detailppm = $wpdb->get_results("
			SELECT SUM( `{$wpdb->prefix}detail_v`.tunggakan ) AS ppm
			FROM `{$wpdb->prefix}detail_v`
			WHERE program_studi = 'Perawatan dan Perbaikan M'");
	foreach($detailppm as $mahasiswa){
	?>
	<table class="form-table" >
	<tr><label align=center for="detailppm"></label>Total Tunggakan SPP <a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=ppm">Prodi PPM</a>
		   <input type="text" id="detailppm" name="detailppm" value="<?php echo $mahasiswa->ppm;?>" class="regular-text">
	</tr>
	</table>
	<?
			$detailtif = $wpdb->get_results("
			SELECT SUM( `{$wpdb->prefix}detail_v`.tunggakan ) AS tif
			FROM `{$wpdb->prefix}detail_v`
			WHERE program_studi = 'Teknik Informatika'");
	foreach($detailtif as $mahasiswa){
	?>
	<table class="form-table" >
	<tr><label align=center for="detailtif"></label>Total Tunggakan SPP <a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=tif">Prodi TIF</a>
		   <input type="text" id="detailtif" name="detailtif" value="<?php echo $mahasiswa->tif;?>" class="regular-text">	   
	</tr>
	</table>
	</form>
	<?
				}
			}
		}
	}
}


function keuangan_main_tps(){
	echo "Total SPP Mahasiswa TPS Politeknik Kampar";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$spps = $wpdb->get_results("
		SELECT 
			`{$wpdb->prefix}detail_v`.nim,
			`{$wpdb->prefix}detail_v`.nama, 
			`{$wpdb->prefix}detail_v`.program_studi,
			`{$wpdb->prefix}detail_v`.jenis_kelamin,
			`{$wpdb->prefix}detail_v`.tahun_ajaran, 
			`{$wpdb->prefix}detail_v`.semester, 
			`{$wpdb->prefix}detail_v`.besar, 
			`{$wpdb->prefix}detail_v`.jumlah_bayar, 
			`{$wpdb->prefix}detail_v`.tunggakan
		FROM 
			(
			`{$wpdb->prefix}detail_v`
			)
			WHERE program_studi='Teknik Pengolahan Sawit'
			");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
	<th width=20>NIM</th>
	<th width=20>Nama</th>
	<th width=20>Program Studi</th>
	<th width=20>Jenis Kelamin</th>
    <th width=18>Tahun Ajaran</th>
    <th width=20>Semester</th>
	<th width=20>Besar</th>
	<th width=20>Jumlah Bayar</th>
	<th width=20>Tunggakan</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>". $spp->nim. "</td>
		<td>". $spp->nama. "</td>
		<td>". $spp->program_studi. "</td>
		<td>". $spp->jenis_kelamin. "</td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
		<td>". $spp->jumlah_bayar. "</td>
		<td>". $spp->tunggakan. "</td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></center></h3>
	<?
}

function keuangan_main_ppm(){
	echo "Total SPP Mahasiswa PPM Politeknik Kampar";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$spps = $wpdb->get_results("
		SELECT 
			`{$wpdb->prefix}detail_v`.nim,
			`{$wpdb->prefix}detail_v`.nama, 
			`{$wpdb->prefix}detail_v`.program_studi,
			`{$wpdb->prefix}detail_v`.jenis_kelamin,
			`{$wpdb->prefix}detail_v`.tahun_ajaran, 
			`{$wpdb->prefix}detail_v`.semester, 
			`{$wpdb->prefix}detail_v`.besar, 
			`{$wpdb->prefix}detail_v`.jumlah_bayar, 
			`{$wpdb->prefix}detail_v`.tunggakan
		FROM 
			(
			`{$wpdb->prefix}detail_v`
			)
			WHERE program_studi='Perawatan dan Perbaikan M'");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
	<th width=20>NIM</th>
	<th width=20>Nama</th>
	<th width=20>Program Studi</th>
	<th width=20>Jenis Kelamin</th>
    <th width=18>Tahun Ajaran</th>
    <th width=20>Semester</th>
	<th width=20>Besar</th>
	<th width=20>Jumlah Bayar</th>
	<th width=20>Tunggakan</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>". $spp->nim. "</td>
		<td>". $spp->nama. "</td>
		<td>". $spp->program_studi. "</td>
		<td>". $spp->jenis_kelamin. "</td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
		<td>". $spp->jumlah_bayar. "</td>
		<td>". $spp->tunggakan. "</td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></center></h3>
	<?
}

function keuangan_main_tif(){
	echo "Total SPP Mahasiswa TIF Politeknik Kampar";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$spps = $wpdb->get_results("
		SELECT 
			`{$wpdb->prefix}detail_v`.nim,
			`{$wpdb->prefix}detail_v`.nama, 
			`{$wpdb->prefix}detail_v`.program_studi,
			`{$wpdb->prefix}detail_v`.jenis_kelamin,
			`{$wpdb->prefix}detail_v`.tahun_ajaran, 
			`{$wpdb->prefix}detail_v`.semester, 
			`{$wpdb->prefix}detail_v`.besar, 
			`{$wpdb->prefix}detail_v`.jumlah_bayar, 
			`{$wpdb->prefix}detail_v`.tunggakan
		FROM 
			(
			`{$wpdb->prefix}detail_v`
			)
			WHERE program_studi='Teknik Informatika'");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
	<th width=20>NIM</th>
	<th width=20>Nama</th>
	<th width=20>Program Studi</th>
	<th width=20>Jenis Kelamin</th>
    <th width=18>Tahun Ajaran</th>
    <th width=20>Semester</th>
	<th width=20>Besar</th>
	<th width=20>Jumlah Bayar</th>
	<th width=20>Tunggakan</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>". $spp->nim. "</td>
		<td>". $spp->nama. "</td>
		<td>". $spp->program_studi. "</td>
		<td>". $spp->jenis_kelamin. "</td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
		<td>". $spp->jumlah_bayar. "</td>
		<td>". $spp->tunggakan. "</td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><center><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></center></h3>
	<?
}