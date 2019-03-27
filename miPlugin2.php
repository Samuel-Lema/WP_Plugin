<?php
/*
Plugin Name: Plugin Personalizado
Plugin URI:  
Description: Guarda en la BBDD los mensajes por correo al publicar un Post
Version:     1.0
Author:      Samuel Lema
Author URI:  */

// Enviar correo cuando publico post

function enviar_publicacion($post_ID) {
    
    $correo = 'slemagonzalez@danielcastelao.org';
    mail($correo,"Samuel Lema ha publicado un post en su página.", "Nuevo post en http://".$_SERVER['SERVER_NAME']."/WordPress/ (Samuel Lema)");
        
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'historico';

    /*$sql = "CREATE OR ALTER TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        correo text NOT NULL,
        post text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";*/
    
    // Inserto una nueva fila
    
    $sql = "INSERT INTO $table_name (correo, post) VALUES ('$correo', '$post_ID');";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
    return $post_ID;
}

add_action('publish_post', 'enviar_publicacion');