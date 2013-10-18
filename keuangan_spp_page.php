<?php 

/**
 * Fungsi ini berguna untuk menampilkan form mahasiswa pada admin WordPress
 */
function keuangan_spp_page(){
	$crud = $_REQUEST['crud'];
	switch ($crud){
		case "read": keuangan_spp_read();break;
		case "create": keuangan_spp_create();break;
		case "update": keuangan_spp_update();break;
		case "delete": keuangan_spp_delete();break;
		case "form": keuangan_spp_form();break;
		case "telah": keuangan_spp_telah();break;
		default: keuangan_spp_panel();break;
	}
}


/**
 * default crud adalah panel ini
 */
function keuangan_spp_panel(){
	?>
	<table align="center" width="250" border="1">
	<h2><center>Modul Data SPP Mahasiswa</center></h2>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=read">LIHAT Data SPP</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=create">TAMBAH Data SPP</a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=update">CARI Data SPP </a></h3></td></tr>
	<tr><td align=center><h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=delete">HAPUS Data SPP </a></h3></td>
	</tr>
	</table>
	<?
}

/**
 * crud delete
 */
function keuangan_spp_delete(){
	global $wpdb;
	if(trim($_REQUEST['id']!='')){
		//hapus dari database
		$id = mysql_real_escape_string($_REQUEST['id']);
		$wpdb->query("DELETE from {$wpdb->prefix}spp where id='$id';");
	}
	//tampilkan Data spp:
	$spps = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}spp ORDER BY tahun_ajaran;");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=4><center>No</th></center>
	<th width='4'>id</th>
    <th width='18'>Tahun Ajaran</th>
    <th width='50'>Semester</th>
	<th width='50'>Besar</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
		<td>" .$spp->id.  " </td>
		<td>" .$spp->tahun_ajaran.  " </td>
		<td>". $spp->semester. "</td>
		<td>". $spp->besar. "</td>
        <td>"
          ."<a href=\"".admin_url('admin.php')."?page=".$_REQUEST['page']."&crud=delete&id=". $spp->id ."\"><b>HAPUS</b></a></td>
		</tr>";
	}
	echo "</table>";
	?>
	<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></h3>
	<?
}


/**
 * crud == create
 */
function keuangan_spp_create(){
	global $wpdb;
	?><div class="wrap">
    <div id="icon-users" class="icon32"></div>
    <h2>Data SPP Mahasiswa</h2>
    Lengkapi data SPP di bawah ini :
	<?
	//check if option is set before saving
  if ( isset( $_POST['tahun_ajaran'] ) ) {
    //retrieve the option value from the form
    $tahun_ajaran =  mysql_real_escape_string($_POST['tahun_ajaran']) ;
    $semester =  mysql_real_escape_string($_POST['semester']) ;
	$besar =  mysql_real_escape_string($_POST['besar']) ;
		$wpdb->query(
      "INSERT INTO `{$wpdb->prefix}spp` (`tahun_ajaran` ,`semester`,`besar` )
      VALUES ('$tahun_ajaran', '$semester', '$besar');");
	  echo "<h2>Sukses menyimpan data SPP ke database</h2>";
	}
	?>
	<form id="form1" name="form1" method="post" action="">
	<table class="form-table" >
    <tr>
		<th><label for="tahun_ajaran">Tahun Ajaran</label></th>
		   <td>
			 <!-- <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $tahun_ajaran;?>" class="regular-text"> -->
			 <SELECT NAME="tahun_ajaran" ID="tahun_ajaran">
			      <OPTION VALUE=""></OPTION>
				  <OPTION VALUE="2006" <?php selected( $tahun_ajaran, '2006' ); ?>>2006</OPTION>
				  <OPTION VALUE="2007" <?php selected( $tahun_ajaran, '2007' ); ?>>2007</OPTION>
				  <OPTION VALUE="2008" <?php selected( $tahun_ajaran, '2008' ); ?>>2008</OPTION>
				  <OPTION VALUE="2009" <?php selected( $tahun_ajaran, '2009' ); ?>>2009</OPTION>
				  <OPTION VALUE="2010" <?php selected( $tahun_ajaran, '2010' ); ?>>2010</OPTION>
				  <OPTION VALUE="2011" <?php selected( $tahun_ajaran, '2011' ); ?>>2011</OPTION>
				  <OPTION VALUE="2012" <?php selected( $tahun_ajaran, '2012' ); ?>>2012</OPTION>
				  <OPTION VALUE="2013" <?php selected( $tahun_ajaran, '2013' ); ?>>2013</OPTION>
			 </SELECT>
			 <br />
		   </td>
	</tr>
	
	<tr>
		<th><label for="semester">Semester</label></th>
		   <td>
			 <!-- <input type="text" id="semester" name="semester" value="<?php echo $semester;?>" class="regular-text"> -->
			 <SELECT NAME="semester" ID="semester">
			      <OPTION VALUE=""></OPTION>
				  <OPTION VALUE="Gasal" <?php selected( $semester, 'Gasal' ); ?>>Gasal</OPTION>
				  <OPTION VALUE="Genap" <?php selected( $semester, 'Genap' ); ?>>Genap</OPTION>
			 </SELECT>
			 <br />
		   </td>
	</tr>
	
    <tr>
      <th><label for="besar">Besar SPP</label></th>
      <td>
        <input type="text" id="besar" name="besar" value="<?php echo $besar;?>" class="regular-text">
        <br />
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

function keuangan_spp_read(){
	echo "Daftar SPP Politeknik Kampar adalah sebagai berikut :";
	echo ("<br>");
	echo ("<br>");
	global $wpdb;
	$spps = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}spp ORDER BY tahun_ajaran;");
	echo "<table class=\"wp-list-table widefat fixed pages\">
    <tr><th width=2><center>No</th></center>
    <th width=18>Tahun Ajaran</th>
    <th width=20>Semester</th>
	<th width=20>Besar</th>
    </tr>";
	$L=1;
	foreach ( $spps as $spp ){
		echo "<tr class='hentry alternate'><td align=center>".$L++ . " </td>
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

function keuangan_spp_update(){
	echo ("<br>");
	global $wpdb;
	$hasilcari = Array();
	$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}spp;");
	foreach($hasilcari as $spp){
		echo "<a href=\"". admin_url("admin.php"). "?page=".$_REQUEST['page']."&crud=form&tahun_ajaran=".$spp->tahun_ajaran."\">". $spp->nama. "</a><br/>";
	}
	echo ("<br>");
	echo ("<br>");
	
	?>
	<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></h3>
	<?
}


function keuangan_spp_telah(){
	//echo "Update data mahasiswa";
	if($_POST['submit']=="Update"){
		echo "Anda telah <b>BERHASIL</b> update data spp";
		echo ("<br>");
		echo ("<br>");
		global $wpdb;
		$tahun_ajaran   =  mysql_real_escape_string($_POST['tahun_ajaran']) ;
		$semester       =  mysql_real_escape_string($_POST['semester']) ;
		$besar          =  mysql_real_escape_string($_POST['besar']) ;
		$SQL = 
      "UPDATE `wp_mahasiswa` set
      `tahun_ajaran`= '$tahun_ajaran',
      `semester`= '$semester',
	  `besar`= '$besar'
      WHERE 
      `tahun_ajaran` = '$tahun_ajaran' ;";
		$wpdb->query($SQL);
      echo $SQL;
		?>
		<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=panel">Kembali</a></h3>
		<?
	}
}

function keuangan_spp_form(){
	if(isset($_GET['tahun_ajaran']) || isset($_POST['tahun_ajaran'])){
		$tahun_ajaran = mysql_real_escape_string($_GET['tahun_ajaran']);
		global $wpdb;
		$hasilcari = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}spp;");
		foreach($hasilcari as $spp){
			?>
			<form id="form1" name="form1" method="post" action="<?php echo admin_url("admin.php");?>?page=<?php echo $_REQUEST['page']; ?>&crud=telah&tahun_ajaran="<?php echo $spp->tahun_ajaran; ?>">
				<input type=hidden name=tahun_ajaran value="<?php echo $spp->tahun_ajaran;?>" />
				<table class="form-table" >
          <tr>
            <th><label for="tahun_ajaran">Tahun Ajaran</label></th>
            <td>
              <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $spp->tahun_ajaran;?>" class="regular-text">
              <br />
              </td>
            </tr>
            <tr>
              <th><label for="semester">Semester</label></th>
              <td>
              <input type="text" id="semester" name="semester" value="<?php echo $spp->semester;?>" class="regular-text">
              <br />
              </td>
            </tr>
            <tr>
              <th><label for="besar">Besar</label></th>
              <td>
              <input type="text" id="besar" name="besar" value="<?php echo $spp->besar;?>" class="regular-text">
              <br />
              </td>
            </tr>
    
			  </table><br />
			<b><h3><input type=submit name=submit value="Update">&nbsp;&nbsp;&nbsp;</b></h3>
				<b><h3><input type=reset name=reset value="Reset"></b></h3>
				<h3><a href="<?php echo admin_url("admin.php")?>?page=<?php echo $_REQUEST['page'];?>&crud=update">Kembali</a></h3>
			</form>
		<?
		}
	}
}