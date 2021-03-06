<?php get_header( 'buddypress' ) ?>
	<div id="content" class="bp_content">
		<div class="padder">
		<?php do_action( 'bp_before_register_page' ) ?>
		<div class="page" id="register-page">
			<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">
			<?php if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>
				<?php do_action( 'template_notices' ) ?>
				<?php do_action( 'bp_before_registration_disabled' ) ?>
					<p><?php _e( 'User registration is currently not allowed.', 'buddypress' ); ?></p>
				<?php do_action( 'bp_after_registration_disabled' ); ?>
			<?php endif; // registration-disabled signup setp ?>
			<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>
				
				<div class="registration_left">
					<h2><?php _e( 'Get your own account in seconds', 'buddypress' ) ?></h2>
					<?php do_action( 'template_notices' ) ?>
					<p><?php _e( 'Fill out this one-step form and you\'ll be blogging seconds later.', 'buddypress' ) ?></p>
					<?php do_action( 'bp_before_account_details_fields' ) ?>
				</div>
				<div class="registration_right">
					<div class="register-section" id="basic-details-section">

					<?php /***** Basic Account Details ******/ ?>
					<h4 style="display:none"><?php _e( 'Account Details', 'buddypress' ) ?></h4>
                    <br />

                    <style>
						
                    </style>
					<table id="register-form-table" style="width:350px;">
                    <tr>
                    	<td class="first" style="width:450px;">
                        	<label for="signup_username">
								<?php _e( 'Username', 'buddypress' ) ?> 
                            </label><br />
							<?php do_action( 'bp_signup_username_errors' ) ?>
							<input class="input_fields" type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value() ?>" />
                        </td>
                        <!--<td class="second" style="width:250px;">
                        	<p>Your username should be of minimum of four characters and can only include lower case letters and numbers.</p>-->
                        </td>
                    </tr>
                    <tr>
                    	<td class="first" style="width:450px;">
                        	<label for="signup_password">
								<?php _e( 'Password', 'buddypress' ) ?>
                            </label><br />
							<?php do_action( 'bp_signup_password_errors' ) ?>
							<input class="input_fields" type="password" name="signup_password" id="signup_password" value="" /><br />

							<label for="signup_password_confirm">
								<?php _e( 'Confirm', 'buddypress' ) ?> </label><br />

					<?php do_action( 'bp_signup_password_confirm_errors' ) ?>
					<input class="input_fields" type="password" name="signup_password_confirm" id="signup_password_confirm" value="" />
                        </td>
                        <!--<td class="second" style="width:250px;">
                        <p>Great passwords use upper case and lower case characters, symbols and numbers.</p>
                        </td>-->
                    </tr>
                    <tr>
                    	<td class="first" style="width:450px;">
                        	<label for="signup_email">
								<?php _e( 'Email Address', 'buddypress' ) ?>
                            </label><br />
							<?php do_action( 'bp_signup_email_errors' ) ?>
							<input class="input_fields"  type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value() ?>" />
                        </td>
                        <!--<td class="second" style="width:250px;">
                        <p>We will send you an email to activate your blog, so pleas triple-check that you have entered it correctly.</p>
                        </td>-->
                    </tr>
                    
                    <!-- #basic-details-section -->
				<?php do_action( 'bp_after_account_details_fields' ) ?>
				<?php /***** Extra Profile Details ******/ ?>
				<?php if ( bp_is_active( 'xprofile' ) ) : ?>
					<?php do_action( 'bp_before_signup_profile_fields' ) ?>
						<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
						<?php if ( bp_is_active( 'xprofile' ) ) : if ( bp_has_profile( 'profile_group_id=1' ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
                        <?php //if(bp_get_the_profile_field_input_name() == 'field_1') continue;?>
							<tr>
                                <td class="first" style="width:450px;">
						<?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>
                            
                                    <label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '', 'buddypress' ) ?><?php endif; ?></label><br />
                                    <?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
                                    <input class="input_fields"  type="text" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" value="<?php bp_the_profile_field_edit_value() ?>" />
                                
						<?php endif; ?>

								<?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_edit_value() ?></textarea>

								<?php endif; ?>

								<?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>
							
                                    <label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '', 'buddypress' ) ?><?php endif; ?></label><br />
                                    <?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<select class="input_fields" style="width:200px;" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>">
										<?php bp_the_profile_field_options() ?>
									</select>
                                
								<?php endif; ?>

								<?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<select name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" multiple="multiple">
										<?php bp_the_profile_field_options() ?>
									</select>

								<?php endif; ?>

								<?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>

									<div class="radio">
										<span class="label"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></span>

										<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
										<?php bp_the_profile_field_options() ?>

										<?php if ( !bp_get_the_profile_field_is_required() ) : ?>
											<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name() ?>' );"><?php _e( 'Clear', 'buddypress' ) ?></a>
										<?php endif; ?>
									</div>

								<?php endif; ?>

								<?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>
							
                                    <?php bp_the_profile_field_options() ?>
                                
									

								<?php endif; ?>

								<?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>

									<div class="datebox">
										<label for="<?php bp_the_profile_field_input_name() ?>_day"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
										<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>

										<select name="<?php bp_the_profile_field_input_name() ?>_day" id="<?php bp_the_profile_field_input_name() ?>_day">
											<?php bp_the_profile_field_options( 'type=day' ) ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name() ?>_month" id="<?php bp_the_profile_field_input_name() ?>_month">
											<?php bp_the_profile_field_options( 'type=month' ) ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name() ?>_year" id="<?php bp_the_profile_field_input_name() ?>_year">
											<?php bp_the_profile_field_options( 'type=year' ) ?>
										</select>
									</div>

								<?php endif; ?>
								</td>
                              <!--  <td class="second" style="width:250px;">
                                <p>
                                <?php if(bp_get_the_profile_field_input_name() == 'field_2') { ?>
                                Your selection here will detemine which language to show menus and settings in.
                                <?php } else if(bp_get_the_profile_field_input_name() == 'field_7') {?>
                                
                                <?php } ?>
                                </p>
                                </td>-->
                            </tr>							
								<?php do_action( 'bp_custom_profile_edit_fields' ) ?>

								<p class="description"><?php bp_the_profile_field_description() ?></p>
						<?php endwhile; ?>    
				</table>
				</div>
						<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_group_field_ids() ?>" />

						<?php endwhile; endif; endif; ?>

					<?php do_action( 'bp_after_signup_profile_fields' ) ?>

				<?php endif; ?>

				<?php if ( bp_get_blog_signup_allowed() ) : ?>

					<?php do_action( 'bp_before_blog_details_fields' ) ?>

					<?php /***** Blog Creation Details ******/ ?>
					<div class="register-section" id="blog-details-section">

						<h4 style="color: black;"><?php _e( 'Blog Details', 'buddypress' ) ?></h4>

						<p><label><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes, I\'d like to create a new site', 'buddypress' ) ?></label></p>

						<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>

							<label for="signup_blog_url"><?php _e( 'Blog URL', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
							<?php do_action( 'bp_signup_blog_url_errors' ) ?>

							<?php if ( is_subdomain_install() ) : ?>
								http:// <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value() ?>" /> .<?php bp_blogs_subdomain_base() ?>
							<?php else : ?>
								<?php echo site_url() ?>/ <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value() ?>" />
							<?php endif; ?>

							<label for="signup_blog_title"><?php _e( 'Site Title', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
							<?php do_action( 'bp_signup_blog_title_errors' ) ?>
							<input type="text" name="signup_blog_title" id="signup_blog_title" value="<?php bp_signup_blog_title_value() ?>" />

							<span class="label"><?php _e( 'I would like my site to appear in search engines, and in public listings around this network.', 'buddypress' ) ?>:</span>
							<?php do_action( 'bp_signup_blog_privacy_errors' ) ?>

							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public" value="public"<?php if ( 'public' == bp_get_signup_blog_privacy_value() || !bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes', 'buddypress' ) ?></label>
							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private" value="private"<?php if ( 'private' == bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'No', 'buddypress' ) ?></label>

					<!-- #blog-details-section -->
					<div style="clear:both;margin-top: 25px;"></div>
					<?php do_action( 'bp_after_blog_details_fields' ) ?>
				</div></div>
				<?php endif; ?>
					
				<?php do_action( 'bp_before_registration_submit_buttons' ) ?>

				
					<input class="formBtn register_submit" type="submit" name="signup_submit" id="signup_submit" value="<?php _e( 'Complete Sign Up', 'buddypress' ) ?>" />
				

				<?php do_action( 'bp_after_registration_submit_buttons' ) ?>

				<?php wp_nonce_field( 'bp_new_signup' ) ?>

			<?php endif; // request-details signup step ?>

			<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

				<h2><?php _e( 'Sign Up Complete!', 'buddypress' ) ?></h2>

				<?php do_action( 'template_notices' ) ?>
				<?php do_action( 'bp_before_registration_confirmed' ) ?>

				<?php if ( bp_registration_needs_activation() ) : ?>
					<p><?php _e( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address.', 'buddypress' ) ?></p>
				<?php else : ?>
					<p><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress' ) ?></p>
				<?php endif; ?>
				<?php do_action( 'bp_after_registration_confirmed' ) ?>
			<?php endif; // completed-confirmation signup step ?>
			<?php do_action( 'bp_custom_signup_steps' ) ?>
				</div>
				<div style="clear:both;"></div>
			</form>
		</div>
		<?php do_action( 'bp_after_register_page' ) ?>
		</div><!-- .padder -->
	</div><!-- #content -->
	<?php //get_sidebar( 'buddypress' ) ?>
	<script type="text/javascript">
		jQuery(document).ready( function() {
			if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
				jQuery('div#blog-details').toggle();

			jQuery( 'input#signup_with_blog' ).click( function() {
				jQuery('div#blog-details').fadeOut().toggle();
			});
		});
	</script>
<?php get_footer( 'buddypress' ) ?>
