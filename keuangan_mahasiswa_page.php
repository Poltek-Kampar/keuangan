<?php 

/**
 * Fungsi ini berguna untuk menampilkan form mahasiswa pada admin WordPress
 */
function keuangan_mahasiswa_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
		case "read": keuangan_mahasiswa_read();break;
		case "create": keuangan_mahasiswa_create();break;
		case "update": keuangan_mahasiswa_update();break;
		case "delete": keuangan_mahasiswa_delete();break;
		case "form": keuangan_mahasiswa_form();break;
		case "telah": keuangan_mahasiswa_telah();break;
		default: keuangan_mahasiswa_panel();break;
	}
}


/**
 * default crud adalah panel ini
 */
function keuangan_mahasiswa_panel(){
	?>
	<table align="center" width="250" border="1">
	<h2><center>Modul Data Mahasiswa</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=read">LIHAT Data Mahasiswa</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=create">TAMBAH Data Mahasiswa Baru</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">CARI Data Mahasiswa</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=delete">HAPUS Data Mahasiswa</a></h3></td>
	</tr>
	</table>
	<?
}

/**
 * crud delete
 */
function keuangan_mahasiswa_delete(){
	global $wpdb;
	if(trim($_REQUEST['nim']!='')){
		//hapus dari database
		$nim = mysql_real_escape_string($_REQUEST['nim']);
		$wpdb->query("DELETE from {$wpdb->prefix}mahasiswa where nim='$nim';");
	}
	//tampilkan semua mahasiswa:
	$mahasiswas = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa;");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
    <th width=18>NIM</th>
    <th width=50>Nama Mahasiswa</th>
	<th width=50>Program Studi</th>
    <th class='manage-column column-cb check-column'><center>Jenis Kelamin</center></th>
    <th width=25>Hp</th>
    <th width=25>Email</th>
    </tr>";
	$L=1;
	foreach ( $mahasiswas as $mahasiswa ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>" .$mahasiswa->nim.  " </td>
		<td>". $mahasiswa->nama. "</td>
		<td>". $mahasiswa->program_studi. "</td>
		<td align=center>" .$mahasiswa->jenis_kelamin.  " </td>
		<td>" .$mahasiswa->hp.  " </td>
		<td>" .$mahasiswa->email.  " </td>
        <td>"
          ."<a href=\"".admin_url('admin.php')."?page=".$_REQUEST['page']."&crud=delete&nim=". $mahasiswa->nim ."\"><b>HAPUS</b></a></td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}


/**
 * crud == create
 */
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
    $nim =  mysql_real_escape_string($_POST['nim']) ;
    $nama =  mysql_real_escape_string($_POST['nama']) ;
	$program_studi =  mysql_real_escape_string($_POST['program_studi']) ;
	$jenis_kelamin =  mysql_real_escape_string($_POST['jenis_kelamin']) ;
    $hp =  mysql_real_escape_string($_POST['hp']);
	$email =  mysql_real_escape_string($_POST['email']) ;
		$wpdb->query(
      "INSERT INTO `{$wpdb->prefix}mahasiswa` (`nim` ,`nama`,`program_studi` ,`jenis_kelamin` ,`hp` ,`email` )
      VALUES ('$nim', '$nama', '$program_studi', '$jenis_kelamin', '$hp', '$email');");
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
		 <th><label for="program_studi">Program Studi</label></th>
		 <td>
			<SELECT NAME="program_studi" ID="program_studi">
			  <OPTION VALUE=""></OPTION>
			  <OPTION VALUE="Teknik Pengolahan Sawit" <?php selected( $program_studi, 'Teknik Pengolahan Sawit' ); ?>>Teknik Pengolahan Sawit</OPTION>
			  <OPTION VALUE="Perawatan dan Perbaikan Mesin" <?php selected( $program_studi, 'Perawatan dan Perbaikan Mesin' ); ?>>Perawatan dan Perbaikan Mesin</OPTION>
			  <OPTION VALUE="Teknik Informatika" <?php selected( $program_studi, 'Teknik Informatika' ); ?>>Teknik Informatika</OPTION>
			</SELECT>
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

  </table>
  
  <br>
		<b><h3><input type=submit name=submit value=Daftar></h3></b>
		<b><h3><input type=reset name=reset value=Batal></h3></b>
	</form>
		<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?php
}


function keuangan_mahasiswa_read(){
	echo "Daftar mahasiswa yang ada di Politeknik Kampar adalah sebagai berikut :";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$dataPerPage = 10;
	if(isset($_GET['paging']))
	{
		$noPage = $_GET['paging'];
	}
	else $noPage = 1;
	$offset = ($noPage - 1) * $dataPerPage;

	$jumData = $wpdb->get_var(
		"SELECT COUNT(*) FROM {$wpdb->prefix}mahasiswa" );
		
	//ceil untuk menentukan jumlah halaman yang akan ditampilkan
	$jumPage = ceil($jumData/$dataPerPage);
	if ($noPage > 1) 
		echo  "<a  href=\"".admin_url("admin.php")."?page=".$_REQUEST['page']."&crud=read&paging=".($noPage-1)."\">&lt;&lt; Prev</a>";
	
	
	for($page = 1; $page <= $jumPage; $page++)
	{
         if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
         {
            if (($showPage == 1) && ($page != 2))  echo "...";
            if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
            if ($page == $noPage) echo " <b>".$page."</b> ";
            else 
				echo " <a href='".
					admin_url("admin.php")."?page=".$_REQUEST['page']."&crud=read&paging=".$page."'>".$page."</a> ";
            $showPage = $page;
         }
	}
	if ($noPage < $jumPage) echo "<a href='".admin_url("admin.php")."?page=".$_REQUEST['page']."&crud=read&paging=".($noPage+1)."'>Next &gt;&gt;</a>";

	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
    <th width=18>NIM</th>
    <th width=50>Nama Mahasiswa</th>
	<th width=50>Program Studi</th>
    <th class='manage-column column-cb check-column'><center>Jenis Kelamin</center></th>
    <th width=25>Hp</th>
    <th width=25>Email</th>
    </tr>";
	$L=1;
	
	$mahasiswas=$wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa LIMIT $offset, $dataPerPage");
	foreach ( $mahasiswas as $mahasiswa ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>" .$mahasiswa->nim.  " </td>
		<td>" ."<a href=\"admin.php?page=".$_REQUEST['page']."&crud=form&nim=".$mahasiswa->nim."\">". $mahasiswa->nama. "</a><br/>" .  " </td>
		<td>". $mahasiswa->program_studi. "</td>
		<td align=center>" .$mahasiswa->jenis_kelamin.  " </td>
		<td>" .$mahasiswa->hp.  " </td>
		<td>" .$mahasiswa->email.  " </td>
		</tr>";
	}
	echo "</table>";
	echo "<p><b>Total Mahasiswa</b> sebanyak <b>$jumData</b> Orang </p>";
	?>

	<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>

	<?
}


function keuangan_mahasiswa_update(){
	$nama = mysql_real_escape_string($_POST['nama']);
	?>
	<form id="form1" name="form1" method="post" action="">
		<table class="form-table" >
      <tr>
        <th><label for="nama">Masukkan Nama mahasiswa yang ingin di UPDATE !</label></th>
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
	global $wpdb;
	$hasilcari = Array();
	$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa WHERE nama LIKE '%$nama%'");
	foreach($hasilcari as $mahasiswa){
		echo "<a href=\"". admin_url("admin.php"). "?page=".$_REQUEST['page']."&crud=form&nim=".$mahasiswa->nim."\">". $mahasiswa->nama. "</a><br/>";
	}
	echo ("<br>");
	echo ("<br>");
	?>
	<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>
	<?
}


function keuangan_mahasiswa_telah(){
	//echo "Update data mahasiswa";
	if($_POST['submit']=="Update"){
		echo "Anda telah <b>BERHASIL</b> update data mahasiswa";
		echo ("<br>");
		echo ("<br>");
		global $wpdb;
		$nim            =  mysql_real_escape_string($_POST['nim']) ;
		$nama           =  mysql_real_escape_string($_POST['nama']) ;
		$program_studi  =  mysql_real_escape_string($_POST['program_studi']) ;
		$jenis_kelamin  =  mysql_real_escape_string($_POST['jenis_kelamin']) ;
		$hp             =  mysql_real_escape_string($_POST['hp']) ;
		$email          =  mysql_real_escape_string($_POST['email']) ;
		$SQL = 
      "UPDATE `wp_mahasiswa` set
      `nim`= '$nim',
      `nama`= '$nama',
	  `program_studi`= '$program_studi',
      `jenis_kelamin`= '$jenis_kelamin',
      `hp` = '$hp',
      `email` = '$email'
      WHERE 
      `nim` = '$nim' ;";
		$wpdb->query($SQL);
      echo $SQL;
		?>
		<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=panel">Kembali</a></h3>

		<?
	}
}



function keuangan_mahasiswa_form(){
	if(isset($_GET['nim']) || isset($_POST['nim'])){
		$nim = mysql_real_escape_string($_GET['nim']);
		global $wpdb;
		$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mahasiswa WHERE nim = '$nim'");
		foreach($hasilcari as $mahasiswa){
			?>
			<form id="form1" name="form1" method="post" action="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=telah&nim="<? echo $mahasiswa->nim; ?>">
				<input type=hidden name=nim value="<?=$mahasiswa->nim?>" />
				<table class="form-table" >
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
			  <th><label for="program_studi">Program Studi</label></th>
			  <td>
			  <SELECT NAME="program_studi" ID="program_studi">
			  <OPTION VALUE=""></OPTION>
			  <OPTION VALUE="Teknik Pengolahan Sawit" <?php selected( $program_studi, 'Teknik Pengolahan Sawit' ); ?>>Teknik Pengolahan Sawit</OPTION>
			  <OPTION VALUE="Perawatan dan Perbaikan Mesin" <?php selected( $program_studi, 'Perawatan dan Perbaikan Mesin' ); ?>>Perawatan dan Perbaikan Mesin</OPTION>
			  <OPTION VALUE="Teknik Informatika" <?php selected( $program_studi, 'Teknik Informatika' ); ?>>Teknik Informatika</OPTION>
			  </SELECT>
			  <br />
		      </td>
	        </tr>
            <tr>
              <th><label for="jenis_kelamin">Jenis Kelamin</label></th>
              <td>
                <input type="radio" name="jenis_kelamin" value="L" checked> Laki-Laki <br>
                <input type="radio" name="jenis_kelamin" value="P" checked>Perempuan
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
			  </table><br />
			<b><h3><input type=submit name=submit value="Update">&nbsp;&nbsp;&nbsp;</b></h3>
				<b><h3><input type=reset name=reset value="Reset"></b></h3>
				<h3><a href="<?php echo admin_url("admin.php")?>?page=<?=$_REQUEST['page']?>&crud=update">Kembali</a></h3>
			</form>
		<?
		}
	}
}