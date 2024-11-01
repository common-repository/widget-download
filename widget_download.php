<?php
/*
Plugin Name: widget download
Plugin URI: http://jessai.fr.nf/archives/10
Description: widget download.
Version: 1.1.1
Author: jessai
Author URI: http://jessai.fr.nf
*/
function widget_downloads() {
	
	function widget_download( $arg ) {
		$user = wp_get_current_user();
		if ( $user->ID )
		{
		    extract($arg);    
			$options_download = get_option('widget_download_options');
			echo $before_widget;
		    echo $before_title . $options_download['download_title'] . $after_title;
			$user_identity = $user->display_name;
			//echo '<div>'.$user_identity.' je te connais toi, tu peux </div><br />';
			$lien = $options_download['download_chemin'].'/'.$options_download['download_fichier'];		
		
			echo '<br />';
			?>
		        <ul>
		        	<li>
		        		<a href=" <?php echo $lien; ?> "><?php echo $options_download['download_texte']; ?></a>
		        	</li>
		        </ul>
		    <?php         
			echo $after_widget;	
		}

	}
	
	
	function widget_download_control() {
	        $newoptions_download = $options_download = get_option('widget_download_options');
	        if ( $_POST['submit_download'] ) {
		       $newoptions_download['download_title'] = $_POST['download_title'];
		       $newoptions_download['download_chemin'] = $_POST['download_chemin'];
		       $newoptions_download['download_fichier'] = $_POST['download_fichier'];
		       $newoptions_download['download_texte'] = $_POST['download_texte'];
		       
	        }
	        if ( $options_download != $newoptions_download ) {
	            $options_download = $newoptions_download;
	            update_option('widget_download_options', $options_download);
	        }
	?>
	    <div><label for="download_title">Titre     : 
	          <div><input name="download_title" id="download_title" value="<?php echo $options_download['download_title']; ?>" /></div>
	    </label></div>
	    <div><label for="download_chemin">Chemin : 
	           <div><input name="download_chemin" id="download_chemin" value="<?php echo $options_download['download_chemin']; ?>" /></div>
	    </label></div>
	    <div><label for="download_fichier">Fichier : 
	           <div><input name="download_fichier" id="download_fichier" value="<?php echo $options_download['download_fichier']; ?>" /></div>
	    </label></div>
	    <div><label for="download_texte">Texte : 
	           <div><input name="download_texte" id="download_texte" value="<?php echo $options_download['download_texte']; ?>" /></div>
	    </label></div>
	    <input id="submit_download" name="submit_download" type="hidden" value="1" />
	<?php
	}
  
  register_sidebar_widget( 'Download', 'widget_download');
  register_widget_control('Download', 'widget_download_control', 200, 500);
}


	add_action('widgets_init', 'widget_downloads');
?>