<?php
//data_mhs_page.php

/**
 * Fungsi ini berguna untuk menampilkan form Mahasiswa pada admin WordPress
 */

function keuangan_main_page(){
	$crud = $_REQUEST['crud'];

	switch ($crud){
		case "read": read_data_mhs();break;
		case "create": create_data_mhs();break;
		case "update": update_data_mhs();break;
		case "delete": delete_data_mhs();break;
		case "form": form_update_data_mhs();break;
		case "telah": telah_update_data_mhs();break;
		default: panel_data_mhs();break;
	}
	//echo "<pre>"; print_r($GLOBALS); echo "</pre>";

}


function panel_data_mhs(){
	?><h2>Menu :</h2>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=read">Lihat</a> Data Mahasiswa</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=create">Tambah</a> Data Mahasiswa Baru</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=update">Ubah</a> Data Mahasiswa</h3>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=delete">Hapus</a> Data Mahasiswa</h3>
	
	<?
}


function read_data_mhs(){
	echo "Daftar mhs yang ada di Politeknik Kampar adalah sebagai berikut :";
	echo "<br>";
	echo "<br>";
	//print_r($_POST);
	global $wpdb;
	$mahasiswas = $wpdb->get_results(" SELECT * FROM {$wpdb->prefix}mahasiswa;");
	$L=1;
	foreach ( $mahasiswas as $mhs ) 
	{
        echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
			<td align=center >" .$mhs->nis .  " </td>
			<td align=center >". $mhs->nama_mhs. "</td>
			<td align=center>" .$mhs->jenis_kelamin .  " </td>
			<td align=center>" .$mhs->alamat .  " </td>
			<td align=center>" .$mhs->tmpt_lahir .  " </td>
			<td align=center>" .$mhs->tgl_lahir .  " </td>
			<td align=center>" .$mhs->agama .  " </td>
			<td align=center>" .$mhs->kelas ."</td>
			<td align=center>" .$mhs->semester ."</td>
			<td align=center>" .$mhs->angkatan ."</td>
			<td align=center>" .$mhs->nama_sekolah . "</td>
			</tr>";
        
	}
	echo "</table>";
	?>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}

function delete_data_mhs(){
	global $wpdb;
	//kalau sudah ada $nis yang ingin di delete, maka hapus
	if(trim($_REQUEST['nis']!='')){
		//hapus dari database
		$nis = $_REQUEST['nis'];
		$wpdb->query("DELETE from mhs where nis='$nis';");
	}
	//tampilkan semua mhs:
		$mahasiswas = $wpdb->get_results( "SELECT * FROM mhs ORDER BY nama_mhs;");
	echo "<table class=\"wp-list-table widefat fixed pages\">
	<tr><th class='manage-column column-cb check-column'>No</th>
	<th class='manage-column column-cb check-column'>NIS</th>
	<th class='manage-column column-cb check-column'>Nama mhs</th>
	<th class='manage-column column-cb check-column'>Jenis Kelamin</th>
	<th class='manage-column column-cb check-column'>Alamat</th>
	<th class='manage-column column-cb check-column'>Tempat Lahir</th>
	<th class='manage-column column-cb check-column'>Tanggal Lahir</th>
	<th class='manage-column column-cb check-column'>agama</th>
	<th class='manage-column column-cb check-column'>Kelas</th>
	<th class='manage-column column-cb check-column'>semester</th>
	<th class='manage-column column-cb check-column'>Tahun Ajaran</th>
	<th class='manage-column column-cb check-column'>Hapus</th>
	</tr>";
	
	$L=1;
	foreach ( $mahasiswas as $mhs ) 
	{
        echo "<tr class='hentry alternate'><td>".$L++ . " </td>
		<td>" .$mhs->nis .  " </td>
		<td>" .$mhs->nama_mhs. "</td>
		<td>" .$mhs->jenis_kelamin .  " </td>
		<td>" .$mhs->alamat .  " </td>
		<td>" .$mhs->tmpt_lahir .  " </td>
		<td>" .$mhs->tgl_lahir .  " </td>
		<td>" .$mhs->agama .  " </td>
		<td>" .$mhs->kelas ."</td>
		<td>" .$mhs->semester ."</td>
		<td>" .$mhs->angkatan ."</td>
		<td>"."<a href=\"".admin_url('admin.php')."?page=".$_REQUEST['page']."&crud=delete&nis=". $mhs->nis ."\">Hapus</a></td></tr>";
        
	}
	echo "</table>";
	?>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=lihatla">Kembali</a></h3>
	<?

}

function create_data_mhs(){
	global $wpdb;
	?><div class="wrap">
		<div id="icon-users" class="icon32"></div>
		<h2>Data Mahasiswa</h2>
		Lengkapi data Mahasiswa di bawah ini :
		
	<?
  
	//check if option is set before saving
    if ( isset( $_POST['nama_mhs'] ) ) {
        //retrieve the option value from the form
		$nis =  $_POST['nis'] ;
		$nama_mhs =  $_POST['nama_mhs'] ;
		$jenis_kelamin =  $_POST['jenis_kelamin'] ;
        $alamat =  $_POST['alamat'] ;
		$tmpt_lahir =  $_POST['tmpt_lahir'] ;
		$tgl_lahir =  $_POST['tgl_lahir'] ;
		$agama =  $_POST['agama'] ;
		$kelas =  $_POST['kelas'] ;
		$semester =  $_POST['semester'] ;
		$angkatan =  $_POST['angkatan'] ;
		$nss =  $_POST['nss'] ;
		$wpdb->query("INSERT INTO `mhs` (
		`nis` ,
		`nama_mhs` ,
		`jenis_kelamin` ,
		`alamat` ,
		`tmpt_lahir` ,
		`tgl_lahir` ,
		`agama` ,
		`kelas` ,
		`semester`,
		`angkatan`,
		`nss`
		)
		VALUES ('$nis', '$nama_mhs', '$jenis_kelamin', '$alamat', '$tmpt_lahir', '$tgl_lahir', '$agama', '$kelas', '$semester', '$angkatan', '$nss');");

		echo "<h2>Sukses menyimpan data mhs yang bernama $nama_mhs ke database</h2>";
		
	}

	?>
	<form id="form1" name="form1" method="post" action="">
		<table class="form-table" >
			<!--tr>
			  <th><label for="nis">NIS</label></th>
			  <td>
				<input type="text" id="nis" name="nis" value="<?php echo $nis;?>" class="regular-text">
			  </td>
			</tr-->
    
    <tr>
      <th><label for="nis">Nomor Induk Mahasiswa</label></th>
      <td>
        <input type="text" id="nis" name="nis" value="<?php echo $nis;?>" class="regular-text">
        <br />
      </td>
    </tr>
    
    <tr>
      <th><label for="nama_mhs">Nama Mahasiswa</label></th>
      <td>
        <input type="text" id="nama_mhs" name="nama_mhs" value="<?php echo $nama_mhs;?>" class="regular-text">
        <br />
      </td>
    </tr>

    <tr>
	<th><label for="jenis_kelamin">Jenis Kelamin</label></th>
	<td>
    <input name="jenis_kelamin" type="radio" value="PRIA" />PRIA
    <input name="jenis_kelamin" type="radio" value="WANITA" />WANITA
      </td>
    </tr>
    
    <tr>
      <th><label for="alamat">Alamat</label></th>
      <td>
        <textarea name="alamat" id="alamat" rows="5" cols="30"><?php echo $alamat;?></textarea>
        <br />
      </td>
    </tr>

	<tr>
      <th><label for="tmpt_lahir">Tempat Lahir</label></th>
	  <td>
        <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $tmpt_lahir;?>" class="regular-text">
        <br />
      </td>
	  </tr>
    <tr>
      <th><label for="tgl_lahir">Tanggal Lahir</label></th>
      <td>
	    <input type="text" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir;?>" class="regular-text">
        <br />
      </td>
    </tr>
    <tr>
      <th><label for="agama">Agama</label></th>
      <td>
        <!-- <input type="text" id="agama" name="agama" value="<?php echo $agama;?>" class="regular-text"> -->
        <SELECT NAME="agama" ID="agama">
          <OPTION VALUE=""></OPTION>
          <OPTION VALUE="Islam" <?php selected( $agama, 'Islam' ); ?>>Islam</OPTION>
          <OPTION VALUE="Kristen Katolik" <?php selected( $agama, 'Kristen Katolik' ); ?>>Kristen Katolik</OPTION>
          <OPTION VALUE="Kristen Protestan" <?php selected( $agama, 'Kristen Protestan' ); ?>>Kristen Protestan</OPTION>
          <OPTION VALUE="Hindu" <?php selected( $agama, 'Hindu' ); ?>>Hindu</OPTION>
          <OPTION VALUE="Budha" <?php selected( $agama, 'Budha' ); ?>>Budha</OPTION>
          <OPTION VALUE="Lainnya" <?php selected( $agama, 'Lainnya' ); ?>>Lainnya</OPTION>
        </SELECT>
        <br />
      </td>
    </tr>

	<tr>
      <th><label for="kelas">Kelas</label></th>
      <td>
        <!-- <input type="text" id="kelas" name="kelas" value="<?php echo $kelas;?>" class="regular-text"> -->
        <SELECT NAME="kelas" ID="kelas">
		  <OPTION VALUE=""></OPTION>
          <OPTION VALUE="I" <?php selected( $kelas, 'I' ); ?>>I</OPTION>
          <OPTION VALUE="II" <?php selected( $kelas, '2' ); ?>>II</OPTION>
          <OPTION VALUE="III" <?php selected( $kelas, 'III' ); ?>>III</OPTION>
        </SELECT>
        <br />
      </td>
    </tr>
	<tr>
	<tr>
      <th><label for="semester">Semester</label></th>
      <td>
        <!-- <input type="text" id="semester" name="semester" value="<?php echo $semester;?>" class="regular-text"> -->
        <SELECT NAME="semester" ID="semester">
		  <OPTION VALUE=""></OPTION>
          <OPTION VALUE="I" <?php selected( $semester, 'I' ); ?>>I</OPTION>
          <OPTION VALUE="II" <?php selected( $semester, '2' ); ?>>II</OPTION>
          <OPTION VALUE="III" <?php selected( $semester, 'III' ); ?>>III</OPTION>
		  <OPTION VALUE="IV" <?php selected( $semester, 'IV' ); ?>>IV</OPTION>
          <OPTION VALUE="V" <?php selected( $semester, 'V' ); ?>>V</OPTION>
          <OPTION VALUE="VI" <?php selected( $semester, 'VI' ); ?>>VI</OPTION>
        </SELECT>
        <br />
      </td>
    </tr>
	<tr>
      <th><label for="angkatan">Tahun Ajaran</label></th>
      <td>
        <!-- <input type="text" id="angkatan" name="angkatan" value="<?php echo $angkatan;?>" class="regular-text"> -->
        <SELECT NAME="angkatan" ID="angkatan">
          <OPTION VALUE=""></OPTION>
          <OPTION VALUE="2005" <?php selected( $angkatan, '2005' ); ?>>2005</OPTION>
          <OPTION VALUE="2006" <?php selected( $angkatan, '2006' ); ?>>2006</OPTION>
          <OPTION VALUE="2007" <?php selected( $angkatan, '2007' ); ?>>2007</OPTION>
		  <OPTION VALUE="2008" <?php selected( $angkatan, '2008' ); ?>>2008</OPTION>
          <OPTION VALUE="2009" <?php selected( $angkatan, '2009' ); ?>>2009</OPTION>
          <OPTION VALUE="2010" <?php selected( $angkatan, '2010' ); ?>>2010</OPTION>
        </SELECT>
        <br />
      </td>
    </tr>
		  <th><label for="nss">Nama Sekolah</label></th>
		  <td>
			<!-- 
			SELECT nss, nama_sekolah FROM `sekolah`

			-->
			<?php 
			global $wpdb;
			$sekolah = $wpdb->get_results("SELECT nss, nama_sekolah FROM `sekolah`");
			//print_r($sekolah);
			?>
			<SELECT NAME="nss" ID="nss">
			  <OPTION VALUE=""></OPTION>
			<?php
			foreach ( $sekolah as $sekolah_detail ) 
			{
				echo "<OPTION VALUE=\"$sekolah_detail->nss;\" ". selected($nss,$sekolah_detail->nss).">$sekolah_detail->nama_sekolah;</OPTION>";
			}
			?>
			</SELECT>	  
		  
			<br />
			<span class="description">Pilih Nama Sekolah ! </span>
			</select>
		  </td>
		  </tr>
	  </table><br>
	<b><h3><input type=submit name=submit value=Daftar></h3></b>
	<b><h3><input type=reset name=reset value=Batal></h3></b>
	</form>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?php
}
	
function update_data_mhs(){
	$nama_mhs = $_POST['nama_mhs'];
	?>
	<form id="form1" name="form1" method="post" action="">
		<table class="form-table" >
		<tr>
		  <th><label for="nama_mhs">Masukkan nama Mahasiswa yang akan di UPDATE !</label></th>
		  <td>
			<input type="text" id="nama_mhs" name="nama_mhs" value="<?php echo $nama_mhs;?>" class="regular-text">
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
    // if ( isset( $_POST['nama_mhs'] ) ) {
		// echo "Anda mencari mhs ini: " . $nama_mhs."<br/>";
	// }
	
	//print_r($_POST);
	global $wpdb;
	$hasilcari = Array();
	$hasilcari = $wpdb->get_results("SELECT * FROM mhs WHERE nama_mhs LIKE '%$nama_mhs%'");
	foreach($hasilcari as $mhs){
		echo "<a href=\"admin.php?page=".$_REQUEST['page']."&crud=form&nis=".$mhs->nis."\">". $mhs->nama_mhs. "</a><br/>";
	}
	echo ("<br>");
	echo ("<br>");
	?>
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}
	
function telah_update_data_mhs(){
	//echo "Update data mhs";
	if($_POST['submit']=="Update"){
		echo "Anda telah <b>BERHASIL</b> update data Mahasiswa";
		echo ("<br>");
		echo ("<br>");
		global $wpdb;
		$nama_mhs =  $_POST['nama_mhs'] ;
		$jenis_kelamin =  $_POST['jenis_kelamin'] ;
		$alamat =  $_POST['alamat'] ;
		$tmpt_lahir =  $_POST['tmpt_lahir'] ;
		$tgl_lahir =  $_POST['tgl_lahir'] ;
		$agama =  $_POST['agama'] ;
		$kelas =  $_POST['kelas'] ;
		$semester =  $_POST['semester'] ;
		$angkatan =  $_POST['angkatan'] ;
		$nss =  $_POST['nss'] ;
		$nis =  $_POST['nis'] ;
		$SQL = "UPDATE `mhs` set
		`nis` ='$nis',
		`nama_mhs`= '$nama_mhs',
		`jenis_kelamin` = '$jenis_kelamin',
		`alamat` = '$alamat',
		`tmpt_lahir` = '$tmpt_lahir',
		`tgl_lahir` = '$tgl_lahir',
		`agama` = '$agama',
		`kelas` ='$kelas',
		`semester` ='$semester',
		`angkatan` ='$angkatan',
		`nss` ='$nss'
		WHERE 
		`nis` = '$nis' ;";
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

function form_update_data_mhs(){
	if(isset($_GET['nis']) || isset($_POST['nis'])){
		//echo "NISnya adalah: " .$_GET['nis'];
		$nis = $_GET['nis'];
		global $wpdb;
		$hasilcari = $wpdb->get_results("SELECT * FROM mhs WHERE nis = '$nis'");
		foreach($hasilcari as $mhs){
			?>
			<form id="form1" name="form1" method="post" action="admin.php?page=<?=$_REQUEST['page']?>&crud=telah&nis="<? echo $mhs->nis; ?>">
				<table class="form-table" >
				<input type=hidden name=nis value="<?=$mhs->nis?>" />
			<tr>
			  <th><label for="nis">Nomor Induk Mahasiswa</label></th>
			  <td>
				<input type="text" id="nis" name="nis" value="<?php echo $mhs->nis;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			
			<tr>
			  <th><label for="nama_mhs">Nama Mahasiswa</label></th>
			  <td>
				<input type="text" id="nama_mhs" name="nama_mhs" value="<?php echo $mhs->nama_mhs;?>" class="regular-text">
				<br />
			  </td>
			</tr>

			<tr>
			<th><label for="jenis_kelamin">Jenis Kelamin</label></th>
			<td>
			<input name="jenis_kelamin" type="radio" value="<?php echo $mhs->jenis_kelamin;?>""PRIA" />PRIA
			<input name="jenis_kelamin" type="radio" value="<?php echo $mhs->jenis_kelamin;?>""WANITA" />WANITA
			  </td>
			</tr>
			
			<tr>
			  <th><label for="alamat">Alamat</label></th>
			  <td>
				<textarea name="alamat" id="alamat" rows="5" cols="30"><?php echo $mhs->alamat;?></textarea>
				<br />
			  </td>
			</tr>

			<tr>
			  <th><label for="tmpt_lahir">Tempat Lahir</label></th>
			  <td>
				<input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $mhs->tmpt_lahir;?>" class="regular-text">
				<br />
			  </td>
			  </tr>
			<tr>
			  <th><label for="tgl_lahir">Tanggal Lahir</label></th>
			  <td>
				<input type="text" id="tgl_lahir" name="tgl_lahir" value="<?php echo $mhs->tgl_lahir;?>" class="regular-text">
				<br />
			  </td>
			</tr>
			<tr>
			  <th><label for="agama">Agama</label></th>
			  <td>
				<!-- <input type="text" id="agama" name="agama" value="<?php echo $mhs->agama;?>" class="regular-text"> -->
				<SELECT NAME="agama" ID="agama">
				  <OPTION VALUE=""></OPTION>
				  <OPTION VALUE="Islam" <?php selected( $mhs->agama, 'Islam' ); ?>>Islam</OPTION>
				  <OPTION VALUE="Kristen Katolik" <?php selected( $mhs->agama, 'Kristen Katolik' ); ?>>Kristen Katolik</OPTION>
				  <OPTION VALUE="Kristen Protestan" <?php selected( $mhs->agama, 'Kristen Protestan' ); ?>>Kristen Protestan</OPTION>
				  <OPTION VALUE="Hindu" <?php selected( $mhs->agama, 'Hindu' ); ?>>Hindu</OPTION>
				  <OPTION VALUE="Budha" <?php selected( $mhs->agama, 'Budha' ); ?>>Budha</OPTION>
				  <OPTION VALUE="Lainnya" <?php selected( $mhs->agama, 'Lainnya' ); ?>>Lainnya</OPTION>
				</SELECT>
				<br />
			  </td>
			</tr>
			
			<tr>
			  <th><label for="kelas">Kelas</label></th>
			  <td>
				<!-- <input type="text" id="kelas" name="kelas" value="<?php echo $mhs->kelas;?>" class="regular-text"> -->
				<SELECT NAME="kelas" ID="kelas">
				  <OPTION VALUE=""></OPTION>
				  <OPTION VALUE="I" <?php selected( $mhs->kelas, 'I' ); ?>>I</OPTION>
				  <OPTION VALUE="II" <?php selected( $mhs->kelas, 'II' ); ?>>II</OPTION>
				  <OPTION VALUE="III" <?php selected( $mhs->kelas, 'III' ); ?>>III</OPTION>
				</SELECT>
				<br />
			  </td>
			</tr>
	
			  <tr>
		  <th><label for="semester">Semester</label></th>
		  <td>
			<!-- <input type="text" id="semester" name="semester" value="<?php echo $mhs->semester;?>" class="regular-text"> -->
			<SELECT NAME="semester" ID="semester">
			  <OPTION VALUE=""></OPTION>
			  <OPTION VALUE="I" <?php selected( $mhs->semester, 'I' ); ?>>I</OPTION>
			  <OPTION VALUE="II" <?php selected( $mhs->semester, '2' ); ?>>II</OPTION>
			  <OPTION VALUE="III" <?php selected( $mhs->semester, 'III' ); ?>>III</OPTION>
			  <OPTION VALUE="IV" <?php selected( $mhs->semester, 'IV' ); ?>>IV</OPTION>
			  <OPTION VALUE="V" <?php selected( $mhs->semester, 'V' ); ?>>V</OPTION>
			  <OPTION VALUE="VI" <?php selected( $mhs->semester, 'VI' ); ?>>VI</OPTION>
			</SELECT>
			<br />
		  </td>
		</tr>
		<tr>
		  <th><label for="angkatan">Tahun Ajaran</label></th>
		  <td>
			<!-- <input type="text" id="angkatan" name="angkatan" value="<?php echo $mhs->angkatan;?>" class="regular-text"> -->
			<SELECT NAME="angkatan" ID="angkatan">
			  <OPTION VALUE=""></OPTION>
			  <OPTION VALUE="2005" <?php selected( $mhs->angkatan, '2005' ); ?>>2005</OPTION>
			  <OPTION VALUE="2006" <?php selected( $mhs->angkatan, '2006' ); ?>>2006</OPTION>
			  <OPTION VALUE="2007" <?php selected( $mhs->angkatan, '2007' ); ?>>2007</OPTION>
			  <OPTION VALUE="2008" <?php selected( $mhs->angkatan, '2008' ); ?>>2008</OPTION>
			  <OPTION VALUE="2009" <?php selected( $mhs->angkatan, '2009' ); ?>>2009</OPTION>
			  <OPTION VALUE="2010" <?php selected( $mhs->angkatan, '2010' ); ?>>2010</OPTION>
			</SELECT>
			<br />
		  </td>
		</tr>
			  <th><label for="nss">Nama Sekolah</label></th>
			  <td>
				<!-- 
				SELECT nss, nama_sekolah FROM `sekolah`

				-->
				<?php 
				global $wpdb;
				$sekolah = $wpdb->get_results("SELECT nss, nama_sekolah FROM `sekolah`");
				//print_r($sekolah->sekolah);
				?>
				<SELECT NAME="nss" ID="nss">
				  <OPTION VALUE=""></OPTION>
				<?php
				foreach ( $sekolah as $sekolah_detail ) 
				{
					echo "<OPTION VALUE=\"$sekolah_detail->nss;\" ". selected($sekolah->nss,$sekolah_detail->nss).">$sekolah_detail->nama_sekolah;</OPTION>";
				}
				?>
				</SELECT>	  
			  
				<br />
				<span class="description">Pilih Nama Sekolah ! </span>
				</select>
			  </td>
			  </tr>
			  </table><br>
				<b><h3><input type=submit name=submit value="Update">&nbsp;&nbsp;&nbsp;</b></h3>
				<b><h3><input type=reset name=reset value="Reset"></b></h3>
				<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=update">Kembali</a></h3>
		</form>
		<?php
		}
	}
}

function lihat_data_mhs(){
	global $wpdb;
	$nama_sekolah = $wpdb->get_results("SELECT nama_sekolah FROM sekolah WHERE nss='".$_REQUEST['nss']."';");
		
	?><h2>mhs pada sekolah <?=$nama_sekolah[0]->nama_sekolah;?> :</h2><?php
	
		$mahasiswas = $wpdb->get_results( 
		"	SELECT * FROM mhs WHERE mhs.nss='".$_REQUEST['nss']."';");
		echo "<table class=\"wp-list-table widefat fixed pages\">
		<tr><th width=2><center>No</th></center>
		<th class='manage-column column-cb check-column'><center>NIS</th></center>
		<th class='manage-column column-cb check-column'><center>Nama Mahasiswa</th></center>
		<th class='manage-column column-cb check-column'><center>Jenis Kelamin</th></center>
		<th class='manage-column column-cb check-column'><center>Alamat</th></center>
		<th class='manage-column column-cb check-column'><center>Tempat Lahir</th></center>
		<th width=25><center>Tanggal Lahir</th></center>
		<th class='manage-column column-cb check-column'><center>Agama</th></center>
		<th class='manage-column column-cb check-column'><center>Kelas</th></center>
		<th class='manage-column column-cb check-column'><center>semester</th></center>
		<th class='manage-column column-cb check-column'><center>Tahun Ajaran</th></center>
		</tr>";

	
	$L=1;
	foreach ( $mahasiswas as $mhs ) 
	{
        echo "<tr class='hentry alternate'><td>".$L++ . " </td>
		<td align=center>" .$mhs->nis .  " </td>
		<td align=center>" .$mhs->nama_mhs .  " </td>
		<td align=center>" .$mhs->jenis_kelamin .  " </td>
		<td align=center>" .$mhs->alamat .  " </td>
		<td align=center>" .$mhs->tmpt_lahir .  " </td>
		<td align=center>" .$mhs->tgl_lahir .  " </td>
		<td align=center>" .$mhs->agama .  " </td>
		<td align=center>" .$mhs->kelas . "</td>
		<td align=center>" .$mhs->semester . "</td>
		<td align=center>" .$mhs->angkatan . "</td>
		</tr>";
        
	}
	echo "</table>";
	?>
		<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=lihat&nss=<?=$_REQUEST['nss']?>">Kembali</a></h3>
	<?
}

function mhs_ajax_search_response(){

	global $wpdb;
	echo '<font size="4">'; 
	$findme = $_POST['findme'];
	$sql = "SELECT *, sekolah.nama_sekolah from mhs INNER JOIN sekolah ON mhs.nss=sekolah.nss where nama_mhs like '%$findme%';";

	$posts = $wpdb->get_results($sql);
	echo '<table class="wp-list-table widefat fixed" >
		<thead><tr><th style="width: 15px">No</th>
		<th style="width: 20px">NIS</th>
		<th style="width: 20px">Nama Mahasiswa</th>
		<th style="width: 20px">Jenis Kelamin</th>
		<th style="width: 20px">Tempat Lahir</th>
		<th style="width: 20px">Tanggal Lahir</th>
		<th style="width: 20px">Agama</th>
		<th style="width: 20px">Kelas</th>
		<th style="width: 20px">Semester</th>
		<th style="width: 20px">Angkatan</th>
		<th style="width: 80px">Nama Sekolah</th>
		</tr></thead>';

	echo '</font>'; 
	$L=1;
	foreach($posts as $post){
		echo "<tr>
			<td>".$L++ . " </td>
			<td>$post->nis</td>
			<td>$post->nama_mhs</td>
			<td>$post->jenis_kelamin</td>
			<td>$post->tmpt_lahir</td>
			<td>$post->tgl_lahir</td>
			<td>$post->agama</td>
			<td>$post->kelas</td>
			<td>$post->semester</td>
			<td>$post->Angkatan</td>
			<td>$post->nama_sekolah</td>
			</tr>\n";
	}
	echo " </table>";

	//AJAX harus selalu die 
	die();
}






function lihat_data_sekolah(){

	//query ke database nama sekolahnya
	global $wpdb;
	$nss=mysql_real_escape_string($_REQUEST['nss']);
	$nama_sekolah = $wpdb->get_results(
		"SELECT nama_sekolah 
		FROM sekolah 
		WHERE nss='".$nss."';");
		
	?><h2>Menu untuk sekolah <? echo $nama_sekolah[0]->nama_sekolah; ?> :</h2>
	<h3><a href="admin.php?page=<? echo $_REQUEST['page']; ?>&crud=guru&nss=<?=$nss;?>">Lihat Guru</a></h3>
	
	<h3><a href="admin.php?page=<?=$_REQUEST['page']?>&crud=read&nss=<?=$_REQUEST['nss']?>">Kembali</a></h3>
	<?
}
