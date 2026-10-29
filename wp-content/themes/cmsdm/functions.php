<?php

function my_theme_setup() {
    // Automatically add site title to <head>
    add_theme_support('title-tag');
    // Enable featured images for posts
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_theme_setup');

function my_theme_scripts() {
    // 1. Enqueue main style.css
    wp_enqueue_style('main-style', get_stylesheet_uri());

    // 2. Enqueue main.js in the footer
    wp_enqueue_script(
        'main-script',
        get_template_directory_uri() . '/assets/main.js',
        array(),
        '1.0.0',
        true // true loads the script right before </body> so elements exist
    );
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');

function remove_comment_website_field($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_website_field');

function handle_contact_form_submission() {

    // 3. GET & SANITIZE INPUTS (XSS Protection)
    $name    = isset($_POST['contact_name'])    ? trim(sanitize_text_field($_POST['contact_name'])) : '';
    $email   = isset($_POST['contact_email'])   ? trim(sanitize_email($_POST['contact_email']))     : '';
    $message = isset($_POST['contact_message']) ? trim(sanitize_textarea_field($_POST['contact_message'])) : '';
    $subject = isset($_POST['contact_subject']) ? trim(sanitize_text_field($_POST['contact_subject'])) : '';

    $errors = array();

    // 4. VALIDATION CHECKS
    if ( empty($name) ) {
        $errors[] = 'Full name is required.';
    } elseif ( strlen($name) < 4 ) {
        $errors[] = 'Name must be at least 4 characters long.';
    }

    if ( empty($email) || ! is_email($email) ) {
        $errors[] = 'A valid email address is required.';
    }

    if ( empty($subject) ) {
        $errors[] = 'Subject is required.';
    } elseif ( strlen($subject) < 3 ) {
        $errors[] = 'Subject must be at least 3 characters long.';
    }

    if ( empty($message) ) {
        $errors[] = 'Message is required.';
    } elseif ( strlen($message) < 10 ) {
        $errors[] = 'Message must be at least 10 characters long.';
    }

    // 5. STOP & REDIRECT IF ERRORS EXIST
    if ( ! empty($errors) ) {
        set_transient('contact_form_errors', $errors, 60);

        // Safe redirect back to form anchor
        $redirect_url = wp_get_referer() ? wp_get_referer() : home_url('/contact');
        wp_safe_redirect( $redirect_url . '#contact-form-section');
        exit;
    }

    // 6. SEND EMAIL TO ADMIN (Appears in Mailpit)
    $to      = get_option('admin_email');
    $mail_subj = 'Contact Form: ' . $subject;
    $body    = "You received a new message from the contact form:\n\n";
    $body   .= "Name: " . $name . "\n";
    $body   .= "Email: " . $email . "\n\n";
    $body   .= "Subject: " . $subject . "\n\n";
    $body   .= "Message:\n" . $message . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    wp_mail($to, $mail_subj, $body, $headers);

    // 7. REDIRECT WITH SUCCESS MESSAGE
    set_transient('contact_form_success', 'Thank you! Your message has been sent.', 60);
    
    $redirect_url = wp_get_referer() ? wp_get_referer() : home_url('/contact');
    wp_safe_redirect( $redirect_url . '#contact-form-section');
    exit;
}

// Hook for logged-in and logged-out visitors
add_action('admin_post_handle_contact_form', 'handle_contact_form_submission');
add_action('admin_post_nopriv_handle_contact_form', 'handle_contact_form_submission');


//=================================//
// Test drive page logic
//=================================//
/**
 * Handle Test Ride Booking Submission & Mailpit Routing
 */
function cmsdm_handle_test_ride() {
    // 3. Validate Required Fields
    $required = array( 'motorcycle_model', 'license_type', 'ride_date', 'ride_time', 'rider_name', 'rider_email', 'rider_phone', 'terms_agree' );
    foreach ( $required as $field ) {
        if ( empty( $_POST[$field] ) ) {
            wp_safe_redirect( add_query_arg( 'booking', 'error', wp_get_referer() ) );
            exit;
        }
    }

    // 4. Sanitize Inputs
    $model      = sanitize_text_field( $_POST['motorcycle_model'] );
    $license    = sanitize_text_field( $_POST['license_type'] );
    $experience = sanitize_text_field( $_POST['experience_level'] ?? 'Not specified' );
    $date       = sanitize_text_field( $_POST['ride_date'] );
    $time       = sanitize_text_field( $_POST['ride_time'] );
    $loaner     = isset( $_POST['loaner_gear'] ) ? 'Yes' : 'No';
    $name       = sanitize_text_field( $_POST['rider_name'] );
    $email      = sanitize_email( $_POST['rider_email'] );
    $phone      = sanitize_text_field( $_POST['rider_phone'] );
    $notes      = sanitize_textarea_field( $_POST['rider_notes'] ?? '' );

    // 5. Send Email Notification to Store Admin
    $admin_email   = get_option( 'admin_email' );
    $admin_subject = sprintf( 'New Test Ride Booking: %s - %s', $name, $model );
    $admin_body    = "You received a new test ride booking request:\n\n"
                   . "Rider: {$name}\n"
                   . "Email: {$email}\n"
                   . "Phone: {$phone}\n\n"
                   . "Motorcycle: {$model}\n"
                   . "License: {$license}\n"
                   . "Experience: {$experience}\n"
                   . "Scheduled Slot: {$date} at {$time}\n"
                   . "Loaner Gear Needed: {$loaner}\n\n"
                   . "Special Notes:\n{$notes}\n";

    $admin_headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: {$name} <{$email}>"
    );

    wp_mail( $admin_email, $admin_subject, $admin_body, $admin_headers );

    // 6. Send Customer Confirmation Email
    $customer_subject = "Test Ride Request Received - {$model}";
    $customer_body    = "Hi {$name},\n\n"
                      . "Thanks for scheduling a test ride with us!\n\n"
                      . "Booking Details:\n"
                      . "- Motorcycle: {$model}\n"
                      . "- Date & Time: {$date} at {$time}\n"
                      . "- Loaner Gear: {$loaner}\n\n"
                      . "Please bring your valid driver's license ({$license}) when arriving at the showroom.\n\n"
                      . "Best regards,\nMotoShop Team";

    wp_mail( $email, $customer_subject, $customer_body, array( 'Content-Type: text/plain; charset=UTF-8' ) );

    // 7. Redirect back with success message
    wp_safe_redirect( add_query_arg( 'booking', 'success', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_submit_test_ride', 'cmsdm_handle_test_ride' );
add_action( 'admin_post_submit_test_ride', 'cmsdm_handle_test_ride' );


