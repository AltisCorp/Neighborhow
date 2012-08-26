<?php
$style_url = get_bloginfo('stylesheet_directory');
$app_url = get_bloginfo('url');
?>
<div id="page-register">
	<h3 class="page-title">Sign Up for Neighborhow</h3>
	
	<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">

<?php $template->the_action_template_message(''); ?>
<?php $template->the_errors(); ?>
	
	<form class="nh-register" name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">
		<p>
			<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ) ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" tabindex="10" />
		</p>
		<p>
			<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'Email Address', 'theme-my-login' ) ?></label>
			<input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" tabindex="20" />
		</p>
<?php
do_action( 'register_form' ); // Wordpress hook
do_action_ref_array( 'tml_register_form', array( &$template ) ); //TML hook
?>
		<p id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'A password will be e-mailed to you.', 'theme-my-login' ) ); ?>
		</p>
		<p class="submit reg-with-pwd">
			<input class="nh-btn-orange" type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( 'Sign Up', 'theme-my-login' ); ?>" tabindex="100" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
		</p>
	</form>
	</div>
</div><!--/ page-register-->
<?php get_sidebar('login-signup'); ?>