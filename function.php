<?php
function masterwork_theme_setup() {
    // Add theme support for menus
    add_theme_support('menus');
    
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for custom logo
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'masterwork_theme_setup');

function masterwork_scripts() {
    // Enqueue styles
    wp_enqueue_style('masterwork-style', get_stylesheet_uri());
    
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');
    
    // Enqueue scripts
    wp_enqueue_script('masterwork-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'masterwork_scripts');

// Add custom post type for Portfolio
function create_portfolio_post_type() {
    register_post_type('portfolio',
        array(
            'labels' => array(
                'name' => 'Portfolio',
                'singular_name' => 'Portfolio Item'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
        )
    );
    
    // Register taxonomy for portfolio categories
    register_taxonomy('portfolio_category', 'portfolio', array(
        'labels' => array(
            'name' => 'Portfolio Categories',
            'singular_name' => 'Portfolio Category'
        ),
        'public' => true,
        'hierarchical' => true,
    ));
}
add_action('init', 'create_portfolio_post_type');

// Add contact form shortcode
function masterwork_contact_form() {
    ob_start();
    ?>
    <form class="contact-form-custom" method="post" action="">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
        </div>
        <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Subject">
        </div>
        <div class="form-group">
            <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
        </div>
        <button type="submit" name="submit_contact" class="form-btn">Send Message</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'masterwork_contact_form');

// Handle contact form submission
function handle_contact_form() {
    if (isset($_POST['submit_contact'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        
        $to = get_option('admin_email');
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');
        
        $email_subject = 'New Contact Form Submission: ' . $subject;
        $email_body = '<h3>New Contact Form Submission</h3>';
        $email_body .= '<p><strong>Name:</strong> ' . $name . '</p>';
        $email_body .= '<p><strong>Email:</strong> ' . $email . '</p>';
        $email_body .= '<p><strong>Subject:</strong> ' . $subject . '</p>';
        $email_body .= '<p><strong>Message:</strong></p>';
        $email_body .= '<p>' . nl2br($message) . '</p>';
        
        wp_mail($to, $email_subject, $email_body, $headers);
        
        echo '<script>alert("Thank you for your message. We will get back to you soon!");</script>';
    }
}
add_action('wp_head', 'handle_contact_form');
?>