<?php

if ( class_exists( 'Share_Twitter' ) && ! class_exists( 'Share_Retweet' ) ) :

class Share_Retweet extends Share_Twitter {
	private $smart = true;
	private $related = '';

	public function get_name() {
		return 'Retweet';
	}
	
	public function display_preview() {
	?>
		<div class="option option-smart-on"></div>
	<?php
	}
	
	public function __construct( $id, array $settings ) {
		parent::__construct( $id, $settings );

		if ( isset( $settings['sharedaddy-retweet-related'] ) )
			$this->related = $settings['sharedaddy-retweet-related'];
	}

	
	public function get_display( $post ) {
		$retweet_id = get_post_meta( $post->ID, 'retweet-id', true );
		if ( ! $retweet_id ) return parent::get_display( $post );
		if ( $this->related ) $related = '&amp;related=' . urlencode( $this->related );
		
		$return = '';
		$return .= <<<HTML
		<div class="sharedaddy-retweet-container">
		<div class="sharedaddy-retweet">
			<a class="sharedaddy-retweet-button" href="https://twitter.com/intent/retweet?tweet_id=$retweet_id$related">
				<span class="sharedaddy-retweet-icon"></span>
				<span class="sharedaddy-retweet-label">Retweet</span>
			</a>
		</div>
		</div>
HTML;

		$return .= '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		
		return $return;
	}
	
	public function has_advanced_options() { return false; }
	public function has_custom_button_style() { return false; }
	public function get_options() { return false; }
	public function update_options( array $data ) { return false; }
	public function display_options() { return false; }

}

endif; // class_exists
