<?php
/**
 * Torpedo Therapeutics Theme Login/Signup Form
 *
 * @package Torpedo_Therapeutics
 */

function get_woo_login_form(){
	$h = '<form id="form_login" action="#" method="post">';
	$h .= '<div class="form-title">Login</div>';
	$h .= '<div class="message_box"></div>';
	$h .= '<div class="help-link">Don\'t you have account? <a class="link-signup" href="'.get_permalink(get_option('woocommerce_myaccount_page_id')).'">Signup Here</a></div>';
	$h .= '<div class="form-group"><input type="text" name="login_email" id="login_email" class="form-control" placeholder="Email Address"></div>';
	$h .= '<div class="form-group"><input type="password" name="login_password" id="login_password" class="form-control" placeholder="Password"></div>';
	$h .= '<div class="help-link">Forgot Password? <a href="'.wp_lostpassword_url().'">Reset Here</a></div>';
	$h .= '<div class="form-action"><button type="submit" class="btn btn-primary">Login</button></div>';
	$h .= '</form>';
	return $h;
}
function the_woo_login_form(){
	echo get_woo_login_form();
}
function get_woo_signup_form(){
	$h = '<form id="form_signup" action="#" method="post">';
	$h .= '<div class="form-title">Sign Up</div>';
	$h .= '<div class="message_box"></div>';
	$h .= '<div class="help-link">Already a member? <a class="link-login" href="'.get_permalink(get_option('woocommerce_myaccount_page_id')).'">Log In</a></div>';
	$h .= '<div class="form-group"><input name="user_name" id="user_name" class="form-control" placeholder="User Name"></div>';
	//$h .= '<div class="form-group"><input name="first_name" id="first_name" class="form-control" placeholder="First Name"></div>';
	//$h .= '<div class="form-group"><input name="last_name" id="last_name" class="form-control" placeholder="Last Name"></div>';
	$h .= '<div class="form-group"><input name="register_email" id="register_email" class="form-control" placeholder="Email"></div>';
	$h .= '<div class="form-group"><input name="user_password" id="user_password" class="form-control" placeholder="Password"></div>';
	$h .= '<div class="form-group"><input name="password_confirm" id="password_confirm" class="form-control" placeholder="Re-Type Password"></div>';
	$h .= '<div class="form-action"><button type="submit" class="btn btn-primary">Sign Up</button></div>';
	$h .= '</form>';								
	return $h;
}
function the_woo_signup_form(){
	echo get_woo_signup_form();
}
// Login/Signup Check
add_action('wp_ajax_ss_user_login','ss_user_login');
add_action('wp_ajax_nopriv_ss_user_login','ss_user_login');
function ss_user_login(){
	global $wpdb;	
	global $error;
	$email = $_POST['login_email'];
	$login_password = $_POST['login_password'];
	$remember_me = 1;

	$login = wp_signon( array( 'user_login' => $email, 'user_password' => trim($login_password), 'remember' => $remember_me ), false ); 

	$msg_arr = [];
	if($login->ID){
		$msg_arr['response'] = "success"; 
		$msg_arr['msg'] = "<strong>Login success!</strong> Please wait while page is being redirected...";
	}else{
		$msg_arr['response'] = "error"; 
		$msg_arr['msg'] = "<strong>Sorry,</strong> The email or password you entered is incorrect.";
	}
	echo json_encode($msg_arr);
	exit;
}
add_action('wp_ajax_ss_user_register','ss_user_register');
add_action('wp_ajax_nopriv_ss_user_register','ss_user_register');
function ss_user_register(){
	global $wpdb;
	$msg_arr = [];

	$user_email = $_POST['register_email'];
	$user_login = $_POST['user_name'];
	$userdata = array('user_email' => $user_email, 'user_login' => $user_login, 'role' => get_option('default_role'));

	if((email_exists($userdata['user_email']))){
		$msg_arr['response'] = "error";
		$msg_arr['msg'] = "Sorry, that email address is already used!";
	}else if((username_exists($userdata['user_login']))){
		$msg_arr['response'] = "error";
		$msg_arr['msg'] = "Sorry, that Username is already used!";
	}else{
		$uname = $_POST['user_name'];
		$user_email = $_POST['register_email'];
		$user_password = $_POST['user_password'];
		$user_role = 'subscriber';
		$userdata = array('user_login' => $uname, 'user_pass' => $user_password, 'user_email' => $user_email, 'role' => $user_role);
		$new_user = wp_insert_user( $userdata );
		

		$msg_arr = [];
		if($new_user){
			$msg_arr['response'] = "success"; 
			$msg_arr['msg'] = "<strong>Thanks for registering. We will get back to you soon.</strong>";
		}else{
			$msg_arr['response'] = "error"; 
			$msg_arr['msg'] = "<strong>Sorry,</strong> Please fill the form correctly";
		}
		echo json_encode($msg_arr);
		exit;
	}
	echo json_encode($msg_arr);
	exit;
}
function torpedo_therapeutics_enqueue_login_register(){
	$h = '(function($){';
	$h .= "try{";
	$h .= "var form_login = $('#form_login'), form_signup = $('#form_signup');";
	$h .= "form_login.validate({
	rules: {
		login_email:{
			required: true,
			email: true
		},  
		login_password:{
			required: true
		}
	},
	messages: {
		login_email: {
			required: 'Email must be filled out.',
			email: 'Valid email must be filled out.'
		},
		login_password: {
			required: 'Password must be filled out.'
		}
	},
    submitHandler: function() {
		var login_email = form_login.find('#login_email').val(), login_password = form_login.find('#login_password').val(), msg_box = form_login.find('.message_box');

		msg_box.removeAttr('class').attr('class', ''); 
		msg_box.addClass('waiting_msg');
		msg_box.html('SignIn on process...');      

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '".admin_url('admin-ajax.php')."',
			data: { 'action': 'ss_user_login', 'login_email' :login_email, 'login_password' : login_password },
			success:function(data){
				if(data.response == 'success'){
					msg_box.html(data.msg); 
					msg_box.addClass('success_msg');
					window.location.href = '".get_permalink(get_option('woocommerce_myaccount_page_id'))."';
				}else{
					msg_box.html(data.msg); 
					msg_box.addClass('error_msg'); 
					return false;   
				}
				return false;
			}
		}); 
		return false;
	}
});";
	$h .= "form_signup.validate({
	rules: {
		user_name:{
			required: true
		},
		first_name:{
			required: true
		},
		last_name:{
			required: true
		},
		register_email:{
			required: true,
			email: true
		},
		user_password:{
			required: true
		},
		password_confirm: {
			equalTo: '#user_password'
		}
	}, 
	messages: {
		user_name: {
			required: 'User name must be filled out.'
		},
		first_name: {
			required: 'First name must be filled out.'
		},
		last_name: {
			required: 'Last name must be filled out.'
		},
		register_email: {
			required: 'Email must be filled out.',
			email: 'Valid email must be filled out.'
		},
		user_password: {
			required: 'Password must be filled out.'
		},
	},
	submitHandler: function() {
		var user_name = $('#user_name').val(),
		first_name = $('#first_name').val(),
		last_name = $('#last_name').val(),
		register_email = $('#register_email').val(),
		user_password = $('#user_password').val(),
		msg_box = form_signup.find('.message_box');

		msg_box.removeAttr('class').attr('class', '');  
		msg_box.addClass('waiting_msg');
		msg_box.html('Signing Up on process...');       

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '".admin_url('admin-ajax.php')."',
			data: {
				'action': 'ss_user_register',
				'user_name' : user_name,
				'first_name' : first_name,
				'last_name' : last_name,
				'register_email' : register_email,
				'user_password' : user_password,                                                
			},
			success:function(data){
				msg_box.removeAttr('class').attr('class', '');  
				if(data.response == 'success')
				{
					msg_box.html(data.msg);  
					msg_box.addClass('success_msg');   
					form_signup[0].reset();                             
				}else
				{
					msg_box.html(data.msg);  
					msg_box.addClass('error_msg');  
					return false;   
				}
				return false;
			} 
		}); 
		return false;
	}
});";

	$h .= '}catch(err){console.log(err)}';

	$h .= '})(jQuery);';
	wp_enqueue_script( 'torpedo-therapeutics-validation', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery'), '', true );
	wp_add_inline_script('torpedo-therapeutics-validation',$h);
}
add_action('wp_enqueue_scripts','torpedo_therapeutics_enqueue_login_register');