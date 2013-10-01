<?php
//keuangan_dashboard_widgets.php

/*
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
 DASHBOARD WIDGETS
#####=====#####=====#####=====#####=====#####=====#####=====
#####=====#####=====#####=====#####=====#####=====#####=====
*/
add_action( 'wp_dashboard_setup', 'keuangan_dashboard_widgets' );
function keuangan_dashboard_widgets() {
  //create a custom dashboard widget
  //wp_add_dashboard_widget( widget_id, widget_name, callback,control_callback );
    wp_add_dashboard_widget( 'keuangan_dashboard','Sistem Informasi Keuangan', 'keuangan_dashboard_widget_display' );
}
function keuangan_dashboard_widget_display()
{
  global $wpdb;
	$status = 'TERKOMPUTERISASI';
  echo 'Sistem Informasi Keuangan saat ini sedang berjalan dengan  ' . $status . '<br />';
  //TODO: QUERY YANG DAFTAR DI SINI
  echo ' <h3>Statistik Sistem Informasi Keuangan</h3>';
  
  //$jumlah_mhs = $wpdb->get_results( "SELECT COUNT(*) as jumlah FROM mahasiswa;" ) ;
  //echo 'Jumlah Mahasiswa: ' . $jumlah_mhs['jumlah'] . '<br/>';
	$user_count = $wpdb->get_var(
		"SELECT COUNT(*) FROM {$wpdb->prefix}mahasiswa" );
	echo "<p>Jumlah Mahasiswa yang nunggak: {$user_count}</p>";

  
}
