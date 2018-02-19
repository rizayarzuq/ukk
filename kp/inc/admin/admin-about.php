<?php
/**
 * About page - admin side
 *
 * @package compact-one
 */

add_action('admin_menu', 'compact_one_admin_about_page');
function compact_one_admin_about_page() {
	$page = add_theme_page(
			'About Compact One',
			'About Compact One',
			'administrator',
			'cc_about',
			'compact_one_admin_about_display'
	);
	add_action( 'admin_print_styles-' . $page, 'compact_one_about_scripts' );

	add_action('compact_one_feature_request', 'compact_one_feature_request_func');
	add_action('compact_one_demo_data', 'compact_one_demo_data_func');
	add_action('compact_one_freepro', 'compact_one_freepro_func');
}

function compact_one_about_scripts()
{
	// Set template directory uri
	$directory_uri = get_template_directory_uri();
	
	wp_enqueue_style( 'about_style', get_template_directory_uri() . '/inc/admin/admin-about.css' );

	wp_enqueue_script( 'compact_one_jquery_validation', get_stylesheet_directory_uri() . '/js/jquery.validate.min.js', array(), true );
	wp_enqueue_script( 'compact_one_jquery_validationform', get_stylesheet_directory_uri() . '/js/validation.js', array(), true );
}

function compact_one_admin_about_display() {

    $theme_data = wp_get_theme('compact-one');

    $tab = null;
    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = null;
    }

    ?>
    <div class="wrap about-wrap compact-one-about-wrapper">
        <h1><?php printf(esc_html__('Welcome to Compact One - Version %1s', 'compact-one'), $theme_data->Version ); ?></h1>
        <div class="about-text">
			<?php esc_html_e( 'Compact One - Single Page Business WordPress Theme. An elegant and responsive one page WordPress theme primarily designed to suffice needs of big and small businesses, corporates and service providers. With impressive sections, all on a single page this theme will help you highlight all the services and products of your company. Image slider, progress bar to showcase skills, work section to display portfolio etc. and many more interesting features together makes this a power-packed theme.', 'compact-one' ); ?>
		</div>
        <a target="_blank" href="<?php echo esc_url('https://www.cyberchimps.com'); ?>" class="cyberchimps-badge wp-badge">
		</a>
        <h2 class="nav-tab-wrapper">
            <a href="?page=cc_about" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>">
				<?php esc_html_e( 'Support', 'compact-one' ) ?>
			</a>
            <a href="?page=cc_about&tab=demodata" class="nav-tab <?php echo $tab == 'demodata' ? ' nav-tab-active' : null; ?>">
				<?php esc_html_e( 'Demo Data', 'compact-one' ); ?>
			</a>
            <a href="?page=cc_about&tab=freepro" class="nav-tab <?php echo $tab == 'freepro' ? ' nav-tab-active' : null; ?>">
				<?php esc_html_e( 'Free v/s Pro', 'compact-one' ); ?>
			</a>
			<a href="?page=cc_about&tab=reqfeature" class="nav-tab <?php echo $tab == 'reqfeature' ? ' nav-tab-active' : null; ?>">
				<?php esc_html_e( 'Request Feature', 'compact-one' ); ?>
			</a>
            <?php do_action( 'compact-one_admin_more_tabs' ); ?>
        </h2>

        <?php if ( is_null( $tab ) ) { ?>
            <div class="tab-support">
				<div class="support-link">
		            <p><?php esc_html_e('For Bugs, Troubleshooting, Queries', 'compact-one'); ?></p>
		            <p>
		                <a href="<?php echo esc_url( 'https://cyberchimps.com/forum/free/compact-one/' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e('Visit Support Forum', 'compact-one'); ?></a>
		            </p>
				</div>
				<div class="tutorial-link">
		            <p><?php esc_html_e('For help with setting up this theme', 'compact-one'); ?></p>
		            <p>
		                <a href="<?php echo esc_url( 'https://cyberchimps.com/compact-one-tutorials/' ); ?>" class="button button-primary" target="_blank"><?php esc_html_e('Watch These Video Tutorials', 'compact-one'); ?></a>
		            </p>
				</div>
            </div>
        <?php } ?>

        <?php if ( $tab == 'demodata' ) { ?>
            <div class="tab-demodatata">
				<?php
				do_action('compact_one_demo_data', 'compact_one_demo_data_func');
				?>        
            </div>
        <?php } ?>

        <?php if ( $tab == 'freepro' ) { ?>
            <div class="tab-freepro">
				<?php
				do_action('compact_one_freepro', 'compact_one_freepro_func');
				?>
               
            </div>
        <?php } ?>

		<?php if ( $tab == 'reqfeature' ) { ?>
            <div class="tab-reqfeature">
               <?php
				do_action('compact_one_feature_request', 'compact_one_feature_request_func');
				?>
            </div>
        <?php } ?>

    </div>
    <?php
}

function compact_one_sender_email($sent_from)
{
	return $_POST['ccemail'];
}
function compact_one_mail_name ($sent_from)
{
	return $_POST['ccemail']; 
}
function compact_one_feature_request_func()
{
	$strResponseMessage ='';
	$to = 'hello@cyberchimps.com';
	if (isset($_POST['ccSubmitBtn']))
	{
		//Send mail
		if(!empty($_POST['ccfeature']) && !empty($_POST['ccemail']))
		{
			$subject = "Compact One - Feature Request";
			$headers = 'From: '.'<'.$_POST['ccemail'].'>'. "\r\n";			
			$feature = wp_kses_stripslashes ($_POST['ccfeature']);
			
			add_filter( 'wp_mail_from', 'compact_one_sender_email' );
			add_filter( 'wp_mail_from_name', 'compact_one_mail_name' );
			
			if(wp_mail($to, $subject, $feature, $headers)) {
				$strResponseMessage = "Thanks, your note is on its way to us now. Be sure to whitelist our mail id hello@cyberchimps.com so that our reply doesn't end up in your spam folder. Have a lovely day ahead !";
			} else {
				$strResponseMessage = "There was some issue sending mail. Please try again";
			}
		}
	}
	
		
		?>					
				<div class="panel-heading"><h3 class="panel-title" style="line-height: 20px;"><?php echo "Feature Request";?></h3></div>				
				<div class="panel panel-primary">
				<?php if ($strResponseMessage != '' ) { ?> 
					<span class="updateres"> <?php echo $strResponseMessage; ?></span>
				<?php } else { ?>	
				
<span class="ccinfo"><?php _e("We believe you , yes you, are our best critic. Without you, we wouldn't exist ! Its our job to make you happy.
So, don't be shy, tell us what feature you would like us to add to this theme and we'll try our very best to do that. All mails are replied to within 24 hours - so you are guaranteed an answer, even if we can't implement what you request.",'compact-one') ?></span>
		
					
				      <div class="panel-body">
						<form action="" id="formfeedback" method="post">
							 <div class="form-group">
								<label for="ccfeature">Feature Request</label>
							    <textarea id="ccfeature" class="form-control" name="ccfeature" placeholder="Enter Feature Request" data-placement="right" title="Please Enter Feature Request" value="<?php ?>"></textarea>
								<label for="ccemail">Email Id</label>
							    <input type="text" id="ccemail" class="form-control" name="ccemail" placeholder="Enter Email Id" data-placement="right" title="Please Enter Email Id" value="<?php ?>"/>
						   </div>
						   <input type="submit" id="ccSubmitBtn" name="ccSubmitBtn" class="button button-primary" value="Send">						   
					   </form>
					</div>
				</div>	
			<?php }?>				 	   
		<?php 	 			
}

function compact_one_demo_data_func()
{
	$strResponseMessage ='';
	$to = 'hello@cyberchimps.com';
	if (isset($_POST['ccSubmitBtn']))
	{
		//Send mail
		if(!empty($_POST['ccemail']))
		{
			$subject = "Compact One - Demo Data Request";
			$headers = 'From: '.'<'.$_POST['ccemail'].'>'. "\r\n";			
			
			add_filter( 'wp_mail_from', 'compact_one_sender_email' );
			add_filter( 'wp_mail_from_name', 'compact_one_mail_name' );
			
			if(wp_mail($to, $subject, $headers)) {
				$strResponseMessage = "Thanks, your note is on its way to us now. Be sure to whitelist our mail id hello@cyberchimps.com so that our reply doesn't end up in your spam folder. Have a lovely day ahead !";
			} else {
				$strResponseMessage = "There was some issue sending mail. Please try again";
			}
		}
	}
	
		
		?>					
				<div class="panel-heading"><h3 class="panel-title" style="line-height: 20px;"><?php echo "Demo Data Request";?></h3></div>				
				<div class="panel panel-primary">
				<?php if ($strResponseMessage != '' ) { ?> 
					<span class="updateres"> <?php echo $strResponseMessage; ?></span>
				<?php } else { ?>	
				
<span class="ccinfo"><?php _e("Please enter your email ID and click on Send to receive the demo data",'compact-one') ?></span>
		
					
				      <div class="panel-body">
						<form action="" id="demodatareq" method="post">
							 <div class="form-group">
								<label for="ccemail">Email Id</label>
							    <input type="text" id="ccemail" class="form-control" name="ccemail" placeholder="Enter Email Id" data-placement="right" title="Please Enter Email Id" value="<?php ?>"/>
						   </div>
						   <input type="submit" id="ccSubmitBtn" name="ccSubmitBtn" class="button button-primary" value="Send">						   
					   </form>
					</div>
				</div>	
			<?php }?>				 	   
		<?php 	 			
}

// Define markup for the upsell page.
function compact_one_freepro_func() {

	// Set template directory uri
	$theme      = wp_get_theme();
	?>
	
		<div class="features">
			<table class="features-table">
			<thead>
			<tr>
				<th class=""></th>
				<th>Compact One</th>
				<th>Compact One Pro Plugin</th>
			</tr>
			<tr>
			<td class="feature">3 ways to display slider caption</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>			
			<tr>
			<td class="feature">Dark overlay on slider images</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			
			<tr>
			<td class="feature">7 sections for home page</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Responsive layout</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Choice of 4 trendy Social Icon Sets</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Change Fonts for Headings & Body</td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Change Features section color</td>
			<td class="featureyes"><span class='dashicons-before dashicons-no-alt'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Change social icon bar color</td>
			<td class="featureyes"><span class='dashicons-before dashicons-no-alt'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">Change menu colors</td>
			<td class="featureyes"><span class='dashicons-before dashicons-no-alt'></span></td>
			<td class="featureyes"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			<tr>
			<td class="feature">High Priority Support via Helpdesk</td>
			<td class="featureyes"><span class="dashicons-before dashicons-no-alt"></span></td>
			<td class="featureno"><span class='dashicons-before dashicons-yes'></span></td>				
			</tr>
			
						
			</thead>
			</table>
		</div>
		<div class="buy">
			<a class="button button-primary buylink" target="_blank" href="https://www.cyberchimps.com/store/compact-one-pro-plugin/?utm_source=about">Buy Compact One Pro Plugin</a>
		</div>
<?php
}
