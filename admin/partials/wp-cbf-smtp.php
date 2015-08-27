<?php

/**
 * Partial of the smtp settings
 *
 *
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/admin/partials
 */
?>


<div id="smtp" class="wrap metabox-holder columns-2 wp_cbf-metaboxes hidden">

	<h2><?php esc_attr_e( 'Set up SMTP email', $this->plugin_name ); ?></h2>
        <p><?php _e('Update wp_mail() function to send emails with SMTP protocol', $this->plugin_name);?></p>

	<!-- Use SMTP? -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Allow SMTP support', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-smtp-support">
			<input type="checkbox" class="show-child-if-checked" id="<?php echo $this->plugin_name;?>-smtp-support" name="<?php echo $this->plugin_name;?>[smtp_support]" value="1" <?php checked($smtp_support, 1);?>/>
			<span><?php esc_attr_e('Allow SMTP Support', $this->plugin_name);?></span>
		</label>
                <!-- Smtp fields -->
                <fieldset class="<?php if( '1' != $smtp_support ) echo 'hidden';?>" >
                    <div class="field-container">                        <p><?php _e('Using SMTP you will be able to send all WordPress emails with your own email address, you can set this up with your google smtp credentials or create a free account with <a href="https://www.mandrill.com/" rel="nofollow">Mandrill</a> or <a href="https://sendgrid.com/" rel="nofollow">SendGrid</a>', $this->plugin_name);?></p>
                        <label for="<?php echo $this->plugin_name;?>-smtp-from-name"><?php _e('From Name', $this->plugin_name);?></label>
                        <input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-from-name" name="<?php echo $this->plugin_name;?>[smtp_from_name]" value="<?php if(!empty($smtp_from_name)) echo $smtp_from_name;?>" placeholder="<?php _e('John Doe', $this->plugin_name);?>"/>
                    </div>

                    <div class="field-container">                        
                        <label for="<?php echo $this->plugin_name;?>-smtp-from-email"><?php _e('From Email', $this->plugin_name);?></label>
                        <input type="email" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-from-email" name="<?php echo $this->plugin_name;?>[smtp_from_email]" value="<?php if(!empty($smtp_from_email)) echo $smtp_from_email;?>" placeholder="j.doe@gmail.com"/>
                    </div> 
                    <!-- Smtp server options -->
                    <div class="field-container">                        
                        <h3><?php _e('SMTP Options - you will be able to send a test email once all those options will be set and saved', $this->plugin_name);?></h3>
                        <label for="<?php echo $this->plugin_name;?>-smtp-host"><?php _e('SMTP Host', $this->plugin_name);?></label>
                        <legend class="screen-reader-text"><span><?php _e('SMTP Host', $this->plugin_name);?></span></legend>
                        <input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-host" name="<?php echo $this->plugin_name;?>[smtp_host]" value="<?php if(!empty($smtp_host)) echo $smtp_host;?>" placeholder="<?php _e('ex:smtp.gmail.com', $this->plugin_name);?>"/>
                    </div>

                    <div class="field-container">                        
                        <label for="<?php echo $this->plugin_name;?>-smtp-port"><?php _e('SMTP port', $this->plugin_name);?></label>
                        <legend class="screen-reader-text"><span><?php _e('SMTP Port', $this->plugin_name);?></span></legend>
                        <input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-port" name="<?php echo $this->plugin_name;?>[smtp_port]" value="<?php if(!empty($smtp_port)) echo $smtp_port;?>" placeholder="25(no encryption), 465(SSL) or 587(TLS)"/>
                    </div>

                    <div class="field-container">                        
                        <legend class="screen-reader-text"><span><?php _e('Encryption', $this->plugin_name);?></span></legend>
                        <h4><?php esc_attr_e('Use Encryption', $this->plugin_name);?></h4>
                        <select name="<?php echo $this->plugin_name;?>[smtp_encryption]">
                            <option value="none" <?php selected($smtp_encryption, 'none');?>>None</option>
                            <option value="ssl" <?php selected($smtp_encryption, 'ssl');?>>SSL (recommended on most servers)</option>
                            <option value="tls" <?php selected($smtp_encryption, 'tls');?>>TLS - No same as STARTTLS</option>
                        </select>
                    </div>
                    
                    <div class="field-container">                        
                        <legend class="screen-reader-text"><span><?php _e('Use authentication - Recommended', $this->plugin_name);?></span></legend>
                        <label for="<?php echo $this->plugin_name;?>-smtp-authentication">
                            <input type="checkbox" class="show-child-if-checked" id="<?php echo $this->plugin_name;?>-smtp-authentication" name="<?php echo $this->plugin_name;?>[smtp_authentication]" value="1" <?php checked($smtp_authentication, 1);?>/>
                            <span><?php esc_attr_e('Use authentication - Recommended', $this->plugin_name);?></span>
                        </label>
                    
                        <fieldset class="<?php if('1' != $smtp_authentication) echo 'hidden';?>">
                            <div class="field-container">                                
                                <label for="<?php echo $this->plugin_name;?>-smtp-username"><?php _e('SMTP Username', $this->plugin_name);?></label>
                                <input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-username" name="<?php echo $this->plugin_name;?>[smtp_username]" value="<?php if(!empty($smtp_username)) echo $smtp_username;?>" placeholder="<?php _e('j.doe@gmail.com', $this->plugin_name);?>"/>
                            </div>

                            <div class="field-container">                                
                                <label for="<?php echo $this->plugin_name;?>-smtp-password"><?php _e('SMTP Password', $this->plugin_name);?></label>
                                <input type="<?php if(!empty($smtp_password)){ echo "password";}else{echo "text";}?>" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-password" name="<?php echo $this->plugin_name;?>[smtp_password]" value="<?php if(!empty($smtp_password)) echo $smtp_password;?>" placeholder="yoursuperpassword"/>
                                <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js <?php if(empty($smtp_password)) echo 'hidden';?>" data-toggle="0" aria-label="Show password">
                                    <span class="dashicons dashicons-visibility"></span>
                                    <span class="text"><?php _e('Show', $this->plugin_name);?></span>
                                </button>
                            </div>
                    </fieldset>
                    
                    <!-- Test Email -->
                    <?php if(!empty($smtp_port) && !empty($smtp_host)):
                        if(('1' == $smtp_authentication && !empty($smtp_username) && !empty($smtp_password)) || ('0' == $smtp_authentication)):
                    ?>
                       <fieldset>
                            <label for="<?php echo $this->plugin_name;?>-smtp-test-email"><?php _e('Email to send test to', $this->plugin_name);?></label>
                            <input type="email" class="regular-text" id="<?php echo $this->plugin_name;?>-smtp-test-email" name="<?php echo $this->plugin_name;?>[smtp_test_email]" value="" placeholder=""/>
                            <button type="button" class="button" id="<?php echo $this->plugin_name;?>-send-smtp-test">
                                <span class="text"><?php _e('Send test email', $this->plugin_name);?></span>
                            </button>
                            <div class="smtp-ajax-results hidden">
                                <p class="smtp-results-content updated"></p>
                                <!--button class="button"><?php _e('View SMTP debug log', $this->plugin_name);?></button>    
                                <div class="smtp-results-debug hidden"></div-->
                            </div>
                       </fieldset> 
                        
                    <?php 
                        endif;
                    endif;
                    ?>

                </fieldset>
	</fieldset>
</div>
