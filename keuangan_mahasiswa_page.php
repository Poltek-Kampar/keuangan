<?php 
//keuangan_mahasiswa_page.php
/**
 * Fungsi ini berguna untuk menampilkan form mahasiswa    pada admin WordPress
 */
 
function keuangan_mahasiswa_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){		case "read": keuangan_mahasiswa_read();break;		case "create": keuangan_mahasiswa_create();break;		case "update": keuangan_mahasiswa_update();break;		case "delete": keuangan_mahasiswa_delete();break;		case "form": keuangan_mahasiswa_form();break;		case "telah": keuangan_mahasiswa_telah();break;		default: keuangan_mahasiswa_panel();break;
	}
	//echo "<pre>"; print_r($GLOBALS); echo "</pre>";
}

function keuangan_mahasiswa_panel(){
	?><h2>Menu Untuk Data Mahasiswa:</h2>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=read">VIEW</a> Data Mahasiswa</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=create">CREATE</a> Data Mahasiswa Baru</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=update">UPDATE</a> Data Mahasiswa</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=delete">DELETE</a> Data Mahasiswa</h3>
	<? 
}

function keuangan_mahasiswa_delete(){
	global $wpdb;
	if(trim($_REQUEST['nim']!='')){
		//hapus dari database
		$nim = $_REQUEST['nim'];
		$wpdb->query("DELETE from {$wpdb->prefix}mahasiswa where nim='$nim';");
	}
	//tampilkan semua mahasiswa:
	$fivesdrafts = $wpdb->get_results("	SELECT * FROM {$wpdb->prefix}mahasiswa;");
	echo "<table class=\"wp-list-table widefat fixed pages\"><tr>
	<th class='manage-column column-cb check-column'>NIM</th>
	<th class='manage-column column-cb check-column'>Nama Mahasiswa</th>
	<th class='manage-column column-cb check-column'>Jenis Kelamin</th>
	<th class='manage-column column-cb check-column'>Hp</th>
	<th class='manage-column column-cb check-column'>E-Mail</th>
	<th class='manage-column column-cb check-column'>Hapus</th>
	</tr>";
	$L=1;
	foreach ( $fivesdrafts as $wp_mahasiswa ) 
	{
		echo "<tr class='hentry alternate'><td>".$L++ . " </td>
		<td>" .$wp_mahasiswa->nim .  " </td>
		<td>". $wp_mahasiswa->nama. "</td>
		<td>" .$wp_mahasiswa->jenis_kelamin .  " </td>
		<td>" .$wp_mahasiswa->hp .  " </td>
		<td>" .$wp_mahasiswa->email .  " </td>
		<td>" .$wp_mahasiswa->sertifikat . "</td>
		<td>"."<a href=\"".admin_url('admin.php')."?page=".$_REQUEST['page']."&crud=delete&nim=". $wp_mahasiswa->nim ."\">Hapus</a></td></tr>";
	}
	echo "</table>";
	?>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}

function keuangan_mahasiswa_create(){
	global $wpdb;
	?><div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Data Mahasiswa</h2>
    Lengkapi data Mahasiswa di bawah ini :
	<?
	//check if option is set before saving
    if ( isset( $_POST['nama'] ) ) {
        //retrieve the option value from the form
		$nim =  $_POST['nim'] ;
		$nama =  $_POST['nama'] ;
		$jenis_kelamin =  $_POST['jenis_kelamin'] ;
        $hp =  $_POST['hp'] ;
		$email =  $_POST['email'] ;
		$wpdb->query("INSERT INTO `{$wpdb->prefix}mahasiswa` (
		`nim` ,
		`nama` ,
		`jenis_kelamin` ,
		`hp` ,
		`email` 
		)
		VALUES ('$nim', '$nama', '$jenis_kelamin', '$hp', '$email');");

		echo "<h2>Sukses menyimpan data mahasiswa $nama ke database</h2>";
	}
	?> 
	<form id="form1" name="form1" method="post" action="">
	<table class="form-table" >

	<tr>
      <th><label for="nim">NIM</label></th>
      <td>
        <input type="text" id="nim" name="nim" value="<?php echo $nim;?>" class="regular-text">
        <br />
      </td>
    </tr>	
    <tr>
      <th><label for="nama">Nama Mahasiswa</label></th>
      <td>
        <input type="text" id="nama" name="nama" value="<?php echo $nama;?>" class="regular-text">
        <br />
      </td>
    </tr>	
	<tr>
	  <th><label for="jenis_kelamin">Jenis Kelamin</label></th>
	  <td>
		<input name="jenis_kelamin" type="radio" value="L" />Laki-Laki
		<input name="jenis_kelamin" type="radio" value="P" />Perempuan
      </td>
    </tr>
	<tr>
      <th><label for="hp">HP</label></th>
      <td>
        <input type="text" id="hp" name="hp" value="<?php echo $hp;?>" class="regular-text">
        <br />
      </td>
    </tr>
	<tr>
      <th><label for="email">Email</label></th>
      <td>
        <input type="text" id="email" name="email" value="<?php echo $email;?>" class="regular-text">
        <br />
      </td>
    </tr>
	  </table><br>
		<b><h3><input type=submit name=submit value=Daftar></h3></b>
		<b><h3><input type=reset name=reset value=Batal></h3></b>
	</form>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?php
}

function keuangan_mahasiswa_read(){
	echo "Daftar mahasiswa yang ada di Kabupaten Kampar adalah sebagai berikut :";
	echo ("<br>");
	echo ("<br>");
	//print_r($_POST);
	global $wpdb;
	$fivesdrafts = $wpdb->get_results("	
		SELECT *  
		FROM {$wpdb->prefix}mahasiswa 
		;");
	echo "<table class=\"wp-list-table widefat fixed pages\">
	<tr><th width=2><center>No</th></center>
	<th width=18><center>NIM</th></center>
	<th width=40><center>Nama Mahasiswa</th></center>
	<th class='manage-column column-cb check-column'><center>Jenis Kelamin</th></center>
	<th width=14><center>hp</th></center>
	<th width=13><center>Email</th></center>
	</tr>";
	$L=1;
	foreach ( $fivesdrafts as $mahasiswa ) 
	{
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td align=center>" .$mahasiswa->nim .  " </td>
		<td>". $mahasiswa->nama. "</td>
		<td align=center>" .$mahasiswa->jenis_kelamin .  " </td>
		<td align=center>" .$mahasiswa->hp .  " </td>
		<td align=center>" .$mahasiswa->email .  " </td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}
function keuangan_mahasiswa_update(){
	$nama = $_POST['nama'];
	?>
	<form id="form1" name="form1" method="post" action="">
		<table class="form-table" >
		<tr>
		  <th><label for="nama">Masukkan Nama mahasiswa yang akan di UPDATE !</label></th>
		  <td>
			<input type="text" id="nama" name="nama" value="<?php echo $nama;?>" class="regular-text">
			<br />
		  </td>
		</tr>		
		</table>
		<br>
		<b><h3><input type="Submit" value="Cari!" /></h3></b>
	</form>
	<?
	echo ("<br>");
	//kalau user mengklik tombol Cari, maka cari di database
    // if ( isset( $_POST['nama'] ) ) {
		// echo "Anda mencari guru ini: " . $nama."<br/>";
	// }
	
	global $wpdb;
	$hasilcari = Array();
	$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa WHERE nama LIKE '%$nama%'");
	foreach($hasilcari as $mahasiswa){
		echo "<a href=\"admin.php?page=".$_REQUEST['page']."&crud=form&nim=".$mahasiswa->nim."\">". $mahasiswa->nama. "</a><br/>";
	}
	echo ("<br>");
	echo ("<br>");
	?>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?

}
function keuangan_mahasiswa_telah(){
	//echo "Update data mahasiswa";
	if($_POST['submit']=="Update"){
		echo "Anda telah <b>BERHASIL</b> update data mahasiswa";
		echo ("<br>");
		echo ("<br>");
		global $wpdb;
		$nim =  $_POST['nim'] ;
		$nama =  $_POST['nama'] ;
		$jenis_kelamin =  $_POST['jenis_kelamin'] ;
		$hp =  $_POST['hp'] ;
		$email =  $_POST['email'] ;
		$SQL = "UPDATE `wp_mahasiswa` set
		`nim`= '$nim',
		`nama`= '$nama',
		`jenis_kelamin`= '$jenis_kelamin',
		`hp` = '$hp',
		`email` = '$email'
		WHERE 
		`nim` = '$nim' ;";
		$wpdb->query($SQL);
		echo $SQL;
		?>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
		<?
	}
	
	echo "<!--pre>";
	print_r($_GET);
	print_r($_POST);
	print_r($_REQUEST);
	echo "</pre-->";
}
function keuangan_mahasiswa_form(){
	if(isset($_GET['nim']) || isset($_POST['nim'])){
		//echo "ID gurunya adalah: " .$_GET['nim'];
		$nim = $_GET['nim'];
		global $wpdb;
		$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa WHERE nim = '$nim'");
		foreach($hasilcari as $mahasiswa){
			?>
			<form id="form1" name="form1" method="post" action="admin.php?page=<?=$_REQUEST['page']?>&crud=telah&nim="<? echo $mahasiswa->nim; ?>">
				<table class="form-table" >
				<input type=hidden name=nim value="<?=$mahasiswa->nim?>" />
									<tr>
			  <th><label for="nim">NIM</label></th>
			  <td>
				<input type="text" id="nim" name="nim" value="<?php echo $mahasiswa->nim;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			<tr>
			  <th><label for="nama">Nama Mahasiswa</label></th>
			  <td>
				<input type="text" id="nama" name="nama" value="<?php echo $mahasiswa->nama;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			
			<tr>
				<th><label for="jenis_kelamin">Jenis Kelamin</label></th>
				<td>
					<input type="radio" name="jenis_kelamin" value="L" checked> Laki-Laki <br>					<input type="radio" name="jenis_kelamin" value="P" checked>Perempuan
				</td>
			</tr>

			<tr>
			  <th><label for="hp">HP</label></th>
			  <td>
				<input type="text" id="hp" name="hp" value="<?php echo $mahasiswa->hp;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			
			<tr>
			  <th><label for="email">Email</label></th>
			  <td>
				<input type="text" id="email" name="email" value="<?php echo $mahasiswa->email;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			  </table><br>			  
			<b><h3><input type=submit name=submit value="Update">&nbsp;&nbsp;&nbsp;</b></h3>
				<b><h3><input type=reset name=reset value="Reset"></b></h3>
				<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=update">Kembali</a></h3>
			</form>
		<?
		}
	}
}