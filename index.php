<?php

/*
Plugin Name: Sistem Informasi Keuangan
Plugin URI: https://code.google.com/p/sistem-informasi-keuangan/
Description: Sistem Informasi Keuangan <a href="http://poltek-kampar.ac.id">Politeknik Kampar</a> dibuat oleh Leni Rapika Oktapiani untuk UPT ICT Centre.
Author: Leni Rapika Oktapiani
Version: 1.0.0
Author URI: https://code.google.com/u/114844818880194934018/

*/

/** 
 * Jika dipanggil langsung dari http, bukan sebagai plugin, 
 * maka langsung tewas.
 * (Perlindungan dari hacker yang mengakses langsung ke file
 * ini, misal: ke /wp-content/plugins/keuangan/
*/
if(!function_exists('add_action'))die('Maaf, jangan dijalankan langsung ya ...!');



/*
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
 INSTALLATION 
 Fungsi ini dipanggil saat plugin di activate
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
*/
register_activation_hook( __FILE__, 'keuangan_install' ); //see p.19
/**
 * Creating database tables if not exists yet.
 * This functions is called during (every) plugin activation
 *
 */
function keuangan_install() {
  global $wpdb;
  $sql ="
    CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}mahasiswa` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `nim` int(9) NOT NULL,
      `nama` varchar(30) NOT NULL,
      `jenis_kelamin` enum('L','P') NOT NULL,
      `hp` int(12) NOT NULL,
      `email` varchar(50) NOT NULL,
      PRIMARY KEY (`id`)
    );";
  $wpdb->query($sql);

  $sql ="
    CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}pembayaran` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `mahasiswa_id` int(11) NOT NULL,
      `spp_id` int(11) NOT NULL,
      `jumlah_bayar` decimal(9,2) NOT NULL,
      PRIMARY KEY (`id`),
      KEY `spp_id` (`spp_id`)
    );";
  $wpdb->query($sql);

  $sql ="
    CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}spp` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `tahun_ajaran` varchar(9) NOT NULL,
      `semester` enum('gasal','genap') NOT NULL,
      PRIMARY KEY (`id`),
      KEY `id` (`id`)
    );";
  $wpdb->query($sql);

}



/*
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
 ADMIN MENU
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
since 2012-06-06
*/
//saat wordpress memanggil fungsi admin_menu, panggil juga fungsi kita pendataan_create_menu
add_action( 'admin_menu', 'pendataan_create_menu' );

function pendataan_create_menu() {

  //create custom top-level menu
  //add_menu_page( page_title, menu_title, capability, menu_slug, function, icon_url, position );
  //  page_title  —   The title of the page as shown in the    <title>   tags
  //  menu_title  —   The name of your menu displayed on the dashboard
  //  capability  —   Minimum capability required to view the menu
  //  menu_slug   —   Slug name to refer to the menu; should be a unique name
  //  function    —   Function to be called to display the page content for the item
  //  icon_url    —   URL to a custom image to use as the Menu icon
  //  position    —   Location in the menu order where it should appear

   
  add_menu_page( 
  	'Sistem Informasi Keuangan', 	// page_title = judulnya 
  	'Keuangan', 					//menu_title
	//capability
	//agar operator bisa melihat menu ini, jadikan capability nya menjadi read
	'read',  						
	//kalau hanya admin yang boleh lihat menu ini, jadikan manage_options
	//'manage_options',
	
	//menu_slug, begini lebih baik, 
	//yang penting tidak boleh ada yang sama
	__FILE__, 						

	// fungsi yang dipanggil saat menu ini diklik
	'keuangan_main_page',		
	
	//icon URL
	plugins_url( 'keuangan16.x16.jpg', __FILE__ ), 

	// position. 0 --> paling atas
	0 				
  );

	require_once('keuangan_main_page.php');
	
  //create submenu items
  //add_submenu_page( parent_slug, page_title, menu_title, capability, menu_slug, function );
  add_submenu_page( 
	//parent_slug
	__FILE__, 
	
	//page_title
	'Keuangan > Data Mahasiswa', 
	
	//menu_title
	'Mahasiswa', 
	
	//capability
	'read', 
	
	//menu_slug
	__FILE__.'keuangan_mahasiswa_page', 
	
	//function
	'keuangan_mahasiswa_page' 
  );
	



  //Following is a list of all available submenu functions in WordPress.
  //add_dashboard_page  —   Adds a submenu to the Dashboard menu
  //add_posts_page      —   Adds a submenu to the Posts menu
  //add_media_page      —   Adds a submenu to the Media menu
  //add_links_page      —   Adds a submenu to the Links menu
  //add_pages_page      —   Adds a submenu to the Pages menu
  //add_comments_page   —   Adds a submenu to the Comments page
  //add_theme_page      —   Adds a submenu to the Appearance menu
  //add_plugins_page    —   Adds a submenu to the Plugins menu
  //add_users_page      —   Adds a submenu to the Users menu
  //add_management_page —   Adds a submenu to the Tools menu
  //add_options_page    —   Adds a submenu to the Settings menu

  //contoh untuk menambahkan submentu di dalam menu setting
  //gunakan fungsi add_options_page
  //add_options_page( 'PMB Settings Page', 'PMB', 'manage_options', __FILE__, 'data_sekolah_page' );
}

require_once('keuangan_mahasiswa_page.php');

//untuk dashboard widgets yang tampil di halaman utama admin di WordPress
require_once('keuangan_dashboard_widgets.php');






/*
#####=====#####=====#####=====#####=====#####=====#####=====
 WIDGETS
 /wp-admin/widgets.php
#####=====#####=====#####=====#####=====#####=====#####=====
*/

// use widgets_init action hook to execute custom function
add_action( 'widgets_init', 'keuangan_register_widgets' );
             
 //register our widget
function keuangan_register_widgets() {
  register_widget( 'keuangan_widgetexample_widget_my_info' );
}


class keuangan_widgetexample_widget_my_info extends WP_Widget {
  //process the new widget
  function keuangan_widgetexample_widget_my_info() {
      $widget_ops = array(
          'classname' =>  'keuangan_widgetexample_widget_class',
          'description' =>  'Display a user\'s favorite movie and song.'
      );
      $this->WP_Widget( 'keuangan_widgetexample_widget_my_info', 'Keuangan',
          $widget_ops );
  }

    //build the widget settings form
    function form($instance) {
        $defaults = array( 'title' =>  'My Info', 'movie' =>  '', 'song' =>  '' );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = $instance['title'];
        $movie = $instance['movie'];
        $song = $instance['song'];
        ?> 
         <p>Title: <input class="widefat" name="<?php echo $this->get_field_name('title');?>" type="text"
            value="<?php echo esc_attr($title); ?>" /></p> 
         <p>Favorite Movie:  <input class="widefat" name="<?php echo $this->get_field_name( 'movie' ); ?>"  type="text" value=" <?php echo esc_attr( $movie ); ?>" /></p> 
         <p>Favorite Song:   <textarea class="widefat" name="<?php echo $this->get_field_name( 'song' ); ?>" /><?php echo esc_attr( $song ); ?></textarea></p> 
         <?php
    }


  //save the widget settings
  function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['movie'] = strip_tags( $new_instance['movie'] );
      $instance['song'] = strip_tags( $new_instance['song'] );
           
      return $instance;
  }
  //display the widget
  function widget($args, $instance) {
    extract($args);
    echo $before_widget;
    $title = apply_filters( 'widget_title', $instance['title'] );
    $movie = empty( $instance['movie'] ) ? ' &nbsp;' : $instance['movie'];
    $song = empty( $instance['song'] ) ? ' &nbsp;' : $instance['song'];

    if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
    echo ' <p> Fav Movie: ' . $movie . ' </p> ';
    echo ' <p> Fav Song: ' . $song . ' </p> ';
    echo $after_widget;
  }
}



/*
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
AJAX
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
*/

//hook untuk ajax response dari server
//our AJAX server based response
add_action('wp_ajax_keuangan_ajax_search','keuangan_ajax_search_response');

//fungsi yang dijalankan saat Guest (atau user yang belum login)
//mengirimkan ajax keuangan_ajax_search
add_action('wp_ajax_nopriv_keuangan_ajax_search','keuangan_ajax_search_response');


function keuangan_ajax_search_response(){

	global $wpdb;
	echo '<font size="1">';
	$posts = Array();
	$findme = mysql_real_escape_string($_POST['findme']);
	
	$sql = "
		SELECT *, sekolah.nama_sekolah 
		FROM mhs INNER JOIN sekolah ON mhs.nss=sekolah.nss 
		WHERE nama_guru like '%$findme%';";

	$posts = $wpdb->get_results($sql);
	echo '<table class="wp-list-table widefat fixed" >
		<thead><tr>
		<th style="width: 15px">No</th>
		<th style="width: 80px">NUPTK</th>
		<th style="width: 80px">NIP</th>
		<th style="width: 80px">Nama Guru</th>
		<th style="width: 80px">Tempat Lahir</th>
		<th style="width: 80px">Tanggal Lahir</th>
		<th style="width: 80px">Jabatan</th>
		<th style="width: 80px">Pangkat</th>
		<th style="width: 80px">Golongan</th>
		<th style="width: 80px">Status</th>
		<th style="width: 80px">Pendidikan Terakhir</th>
		<th style="width: 80px">Jurusan</th>
		<th style="width: 80px">Mata Pelajaran</th>
		<th style="width: 80px">Jumlah Jam Mata Pelajaran</th>
		<th style="width: 80px">Sertifikat</th>
		<th style="width: 80px">Sertifikat Tahun</th>
		<th style="width: 80px">Ket</th>
		<th style="width: 80px">Nama Sekolah</th>
		</tr></thead>';
	echo '</font>'; 
	$L=1;
	foreach($posts as $guru)
	{
		echo "<tr>
			<td>".$L++ . " </td>
			<td>$guru->nuptk</td>
			<td>$guru->nip</td>
			<td>$guru->nama_guru</td>
			<td>$guru->tempat_lahir</td>
			<td>$guru->tanggal_lahir</td>
			<td>$guru->jabatan</td>
			<td>$guru->pangkat</td>
			<td>$guru->golongan</td>
			<td>$guru->status</td>
			<td>$guru->pendidikan_terakhir</td>
			<td>$guru->jurusan</td>
			<td>$guru->mapel</td>
			<td>$guru->jumlah_jam_mapel</td>
			<td>$guru->sertifikat</td>
			<td>$guru->sertifikat_tahun</td>
			<td>$guru->ket</td>
			<td>$guru->nama_sekolah</td>
			</tr>\n";
	}
	echo " </table>";

	die();
}
?>