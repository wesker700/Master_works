<?php
// Masterwork Joinery Solutions - Standalone PHP Website
// Compatible with VentraIP cPanel Hosting

// Contact Form Processing
$message = '';
$messageType = '';

if ($_POST && isset($_POST['submit_contact'])) {
    // Sanitize input data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $user_message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
    
    // Validation
    $errors = array();
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($user_message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, send email
    if (empty($errors)) {
        $to = "info@masterworkjoinery.com"; // Change this to your email
        $email_subject = "New Contact Form Submission: " . $subject;
        
        $email_body = "New contact form submission from your website:\n\n";
        $email_body .= "Name: " . $name . "\n";
        $email_body .= "Email: " . $email . "\n";
        $email_body .= "Subject: " . $subject . "\n";
        $email_body .= "Message:\n" . $user_message . "\n\n";
        $email_body .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n";
        $email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
        $email_body .= "Time: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        if (mail($to, $email_subject, $email_body, $headers)) {
            $message = "Thank you for your message! We'll get back to you soon.";
            $messageType = "success";
        } else {
            $message = "Sorry, there was an error sending your message. Please try again.";
            $messageType = "error";
        }
    } else {
        $message = implode("<br>", $errors);
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masterwork Joinery Solutions - Premium Custom Joinery</title>
    <meta name="description" content="Masterwork Joinery Solutions delivers exceptional custom cabinetry, bespoke furniture, and architectural joinery. 18+ years experience, 750+ projects completed.">
    <meta name="keywords" content="custom joinery, cabinetry, bespoke furniture, kitchen design, wardrobes, commercial fit-outs">
    <style>
        :root {
            --primary: #F47B20; /* Orange from logo */
            --secondary: #333333;
            --light-gray: #AAAAAA;
            --mid-gray: #777777;
            --dark-gray: #222222;
            --background: #1A1A1A;
            --text: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        
        body {
            background-color: var(--background);
            color: var(--text);
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: var(--text);
        }
        
        /* Header & Navigation */
        header {
            background-color: rgba(26, 26, 26, 0.95);
            position: fixed;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: all 0.3s ease;
        }
        
        header.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            height: 60px;
            transition: all 0.3s ease;
        }
        
        header.scrolled .logo {
            height: 40px;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            font-size: 16px;
            font-weight: 500;
            position: relative;
            padding-bottom: 5px;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .hamburger {
            display: none;
            cursor: pointer;
        }
        
        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: var(--text);
            margin: 5px;
            transition: all 0.3s ease;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIwMCIgaGVpZ2h0PSI4MDAiIHZpZXdCb3g9IjAgMCAxMjAwIDgwMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjEyMDAiIGhlaWdodD0iODAwIiBmaWxsPSIjMzMzMzMzIi8+CjxyZWN0IHg9IjEwMCIgeT0iMTAwIiB3aWR0aD0iMjAwIiBoZWlnaHQ9IjE1MCIgZmlsbD0iI0Q2OTM1NSIvPgo8cmVjdCB4PSI0MDAiIHk9IjIwMCIgd2lkdGg9IjMwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNGNUY1RjUiLz4KPHJlY3QgeD0iODAwIiB5PSIxNTAiIHdpZHRoPSIyNTAiIGhlaWdodD0iMTgwIiBmaWxsPSIjRDY5MzU1Ii8+CjxyZWN0IHg9IjIwMCIgeT0iNTAwIiB3aWR0aD0iNDAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0iI0Y1RjVGNSIvPgo8cmVjdCB4PSI3MDAiIHk9IjQ1MCIgd2lkdGg9IjMwMCIgaGVpZ2h0PSIxNTAiIGZpbGw9IiNENjkzNTUiLz4KPC9zdmc+') center/cover no-repeat;
            display: flex;
            align-items: center;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .hero h1 span {
            color: var(--primary);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--light-gray);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--primary);
            color: white;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 10px;
        }
        
        .btn:hover {
            background-color: #D96A18;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(244, 123, 32, 0.3);
        }
        
        .btn.secondary {
            background-color: transparent;
            border: 2px solid var(--primary);
        }
        
        .btn.secondary:hover {
            background-color: var(--primary);
        }
        
        /* About Section */
        section {
            padding: 100px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary);
        }
        
        .section-title p {
            color: var(--light-gray);
            max-width: 700px;
            margin: 0 auto;
        }
        
        .about-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        
        .about-text {
            flex-basis: 50%;
            padding-right: 40px;
        }
        
        .about-image {
            flex-basis: 45%;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .about-image:hover img {
            transform: scale(1.05);
        }
        
        .about-text h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        .about-text p {
            margin-bottom: 20px;
        }
        
        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .stat-item {
            text-align: center;
            flex-basis: 30%;
        }
        
        .stat-item h4 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .stat-item p {
            color: var(--light-gray);
            font-size: 0.9rem;
        }
        
        /* Services Section */
        .services {
            background-color: var(--dark-gray);
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .service-card {
            background-color: var(--secondary);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .service-img {
            height: 200px;
            overflow: hidden;
            background: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-gray);
        }
        
        .service-content {
            padding: 25px;
        }
        
        .service-content h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary);
        }
        
        .service-content p {
            color: var(--light-gray);
            margin-bottom: 20px;
        }
        
        .service-link {
            color: var(--primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .service-link span {
            margin-left: 5px;
            transition: all 0.3s ease;
        }
        
        .service-link:hover span {
            margin-left: 10px;
        }
        
        /* Portfolio Section */
        .portfolio-filter {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 8px 20px;
            margin: 5px;
            background-color: var(--secondary);
            border: none;
            border-radius: 4px;
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-btn.active, .filter-btn:hover {
            background-color: var(--primary);
        }
        
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            height: 250px;
            background: #555;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }
        
        .portfolio-overlay h3 {
            color: var(--text);
            font-size: 1.5rem;
            margin-bottom: 10px;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        
        .portfolio-overlay p {
            color: var(--primary);
            transform: translateY(20px);
            transition: all 0.3s ease 0.1s;
        }
        
        .portfolio-item:hover .portfolio-overlay h3,
        .portfolio-item:hover .portfolio-overlay p {
            transform: translateY(0);
        }
        
        /* Testimonials Section */
        .testimonials {
            background-color: var(--dark-gray);
        }
        
        .testimonial-slider {
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
        }
        
        .testimonial-slide {
            text-align: center;
            padding: 30px;
        }
        
        .client-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto 20px;
            overflow: hidden;
            border: 3px solid var(--primary);
            background: #555;
        }
        
        .testimonial-text {
            font-size: 1.1rem;
            font-style: italic;
            margin-bottom: 20px;
            position: relative;
            padding: 0 30px;
        }
        
        .testimonial-text::before,
        .testimonial-text::after {
            content: '"';
            font-size: 3rem;
            color: var(--primary);
            position: absolute;
            opacity: 0.3;
        }
        
        .testimonial-text::before {
            top: -20px;
            left: 0;
        }
        
        .testimonial-text::after {
            bottom: -40px;
            right: 0;
        }
        
        .client-info h4 {
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .client-info p {
            color: var(--light-gray);
            font-size: 0.9rem;
        }
        
        /* Contact Section */
        .contact-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .contact-info {
            flex-basis: 45%;
        }
        
        .contact-form {
            flex-basis: 50%;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .contact-icon i {
            font-size: 1.5rem;
            color: var(--text);
        }
        
        .contact-text h4 {
            margin-bottom: 5px;
            color: var(--primary);
        }
        
        .contact-text p, .contact-text a {
            color: var(--light-gray);
        }
        
        .contact-text a:hover {
            color: var(--primary);
        }
        
        .contact-social {
            display: flex;
            margin-top: 30px;
        }
        
        .social-link {
            width: 40px;
            height: 40px;
            background-color: var(--secondary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background-color: var(--primary);
            transform: translateY(-5px);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px;
            background-color: var(--secondary);
            border: none;
            border-radius: 5px;
            color: var(--text);
        }
        
        .form-control::placeholder {
            color: var(--light-gray);
        }
        
        textarea.form-control {
            height: 150px;
            resize: none;
        }
        
        .form-control:focus {
            outline: 2px solid var(--primary);
        }
        
        .form-btn {
            background-color: var(--primary);
            color: var(--text);
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .form-btn:hover {
            background-color: #D96A18;
            transform: translateY(-3px);
        }
        
        /* Form Messages */
        .form-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .form-message.success {
            background-color: rgba(76, 175, 80, 0.1);
            border: 1px solid #4CAF50;
            color: #4CAF50;
        }
        
        .form-message.error {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid #F44336;
            color: #F44336;
        }
        
        /* Footer */
        footer {
            background-color: var(--secondary);
            padding-top: 70px;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .footer-about {
            flex-basis: 30%;
        }
        
        .footer-logo {
            height: 70px;
            margin-bottom: 20px;
        }
        
        .footer-about p {
            color: var(--light-gray);
            margin-bottom: 20px;
        }
        
        .footer-links, .footer-services {
            flex-basis: 20%;
        }
        
        .footer-title {
            color: var(--text);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--primary);
        }
        
        .footer-links ul, .footer-services ul {
            list-style: none;
        }
        
        .footer-links li, .footer-services li {
            margin-bottom: 10px;
        }
        
        .footer-links a, .footer-services a {
            color: var(--light-gray);
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover, .footer-services a:hover {
            color: var(--primary);
            padding-left: 5px;
        }
        
        .footer-newsletter {
            flex-basis: 30%;
        }
        
        .newsletter-form {
            display: flex;
            margin-top: 20px;
        }
        
        .newsletter-input {
            flex-grow: 1;
            padding: 12px;
            background-color: var(--dark-gray);
            border: none;
            border-radius: 5px 0 0 5px;
            color: var(--text);
        }
        
        .newsletter-btn {
            background-color: var(--primary);
            color: var(--text);
            border: none;
            padding: 0 15px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
        
        .footer-bottom {
            background-color: #1a1a1a;
            padding: 20px 0;
            margin-top: 50px;
            text-align: center;
        }
        
        .footer-bottom p {
            color: var(--light-gray);
            font-size: 0.9rem;
        }
        
        .footer-bottom a {
            color: var(--primary);
        }
        
        /* Responsive Design */
        @media screen and (max-width: 990px) {
            .about-text, .about-image, .contact-info, .contact-form {
                flex-basis: 100%;
                padding-right: 0;
            }
            
            .about-image, .contact-form {
                margin-top: 40px;
            }
            
            .footer-about, .footer-links, .footer-services, .footer-newsletter {
                flex-basis: 45%;
                margin-bottom: 40px;
            }
        }
        
        @media screen and (max-width: 768px) {
            .nav-links {
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                height: 0;
                background-color: var(--secondary);
                flex-direction: column;
                align-items: center;
                overflow: hidden;
                transition: height 0.3s ease;
            }
            
            .nav-links.active {
                height: 300px;
            }
            
            .nav-links li {
                margin: 15px 0;
                opacity: 0;
                transform: translateY(15px);
                transition: all 0.3s ease;
            }
            
            .nav-links.active li {
                opacity: 1;
                transform: translateY(0);
            }
            
            .hamburger {
                display: block;
            }
            
            .hamburger.active div:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }
            
            .hamburger.active div:nth-child(2) {
                opacity: 0;
            }
            
            .hamburger.active div:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .btn {
                display: block;
                margin: 10px auto;
                width: 80%;
            }
            
            .stats {
                flex-direction: column;
            }
            
            .stat-item {
                margin-bottom: 20px;
            }
            
            .footer-about, .footer-links, .footer-services, .footer-newsletter {
                flex-basis: 100%;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <div class="container nav-container">
            <svg width="240" height="60" viewBox="0 0 240 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo">
                <!-- Geometric M Symbol -->
                <g transform="translate(0, 5)">
                    <!-- Left triangle -->
                    <polygon points="5,45 15,5 25,35 15,45" fill="#666666" opacity="0.9"/>
                    <!-- Center diamonds -->
                    <polygon points="20,25 30,5 40,25 30,45" fill="#888888" opacity="0.8"/>
                    <polygon points="30,25 40,5 50,25 40,45" fill="#AAAAAA" opacity="0.7"/>
                    <!-- Right triangle -->
                    <polygon points="45,45 55,5 65,45 55,35" fill="#666666" opacity="0.9"/>
                </g>
                <!-- Text -->
                <text x="80" y="20" font-family="Arial, sans-serif" font-size="16" font-weight="700" fill="#F47B20">MASTER</text>
                <text x="80" y="38" font-family="Arial, sans-serif" font-size="16" font-weight="700" fill="#AAAAAA">WORK</text>
                <text x="80" y="52" font-family="Arial, sans-serif" font-size="10" fill="#777777">JOINERY SOLUTIONS</text>
            </svg>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <div class="hamburger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Excellence in <span>Joinery Craftsmanship</span></h1>
                <p>We create bespoke joinery solutions with precision, care, and artistry. From custom cabinetry to architectural woodwork, our master craftsmen bring your vision to life.</p>
                <div class="hero-buttons">
                    <a href="#portfolio" class="btn">View Our Work</a>
                    <a href="#contact" class="btn secondary">Get In Touch</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="section-title">
                <h2>About Us</h2>
                <p>With decades of experience and a passion for excellence, we deliver premium joinery solutions that stand the test of time.</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3>Craftsmanship That Speaks For Itself</h3>
                    <p>Masterwork Joinery Solutions was established in 2005 with a simple mission: to create exceptional woodwork that exceeds expectations. Our team of skilled craftsmen combines traditional techniques with modern technology to deliver joinery of the highest quality.</p>
                    <p>We pride ourselves on attention to detail, innovative design solutions, and using only the finest materials. Whether it's a bespoke kitchen, custom furniture, or commercial fit-out, we bring the same level of dedication and expertise to every project.</p>
                    <div class="stats">
                        <div class="stat-item">
                            <h4>18+</h4>
                            <p>Years Experience</p>
                        </div>
                        <div class="stat-item">
                            <h4>750+</h4>
                            <p>Projects Completed</p>
                        </div>
                        <div class="stat-item">
                            <h4>98%</h4>
                            <p>Client Satisfaction</p>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <div style="width:100%;height:400px;background:#555;display:flex;align-items:center;justify-content:center;color:#aaa;">Workshop Image</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Services</h2>
                <p>We offer a comprehensive range of joinery solutions to meet all your woodworking needs.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-img">Custom Cabinetry</div>
                    <div class="service-content">
                        <h3>Custom Cabinetry</h3>
                        <p>Bespoke cabinets and storage solutions designed to maximize space and complement your interior style.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">Architectural Joinery</div>
                    <div class="service-content">
                        <h3>Architectural Joinery</h3>
                        <p>From staircases to paneling, our architectural joinery enhances the character and value of any property.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">Bespoke Furniture</div>
                    <div class="service-content">
                        <h3>Bespoke Furniture</h3>
                        <p>Custom-made furniture pieces crafted to your specifications using traditional and modern techniques.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">Commercial Fit-outs</div>
                    <div class="service-content">
                        <h3>Commercial Fit-outs</h3>
                        <p>High-quality joinery solutions for retail, hospitality, and office spaces that make a lasting impression.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">Kitchen & Bathroom</div>
                    <div class="service-content">
                        <h3>Kitchen & Bathroom</h3>
                        <p>Expertly crafted kitchens and bathroom cabinetry that combine functionality with stunning aesthetics.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-img">Restoration & Repair</div>
                    <div class="service-content">
                        <h3>Restoration & Repair</h3>
                        <p>Skilled restoration of period features and antique furniture to preserve their heritage and beauty.</p>
                        <a href="#" class="service-link">Learn More <span>→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio" id="portfolio">
        <div class="container">
            <div class="section-title">
                <h2>Our Portfolio</h2>
                <p>Browse through our showcase of completed projects that demonstrate our craftsmanship and versatility.</p>
            </div>
            <div class="portfolio-filter">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="cabinetry">Cabinetry</button>
                <button class="filter-btn" data-filter="furniture">Furniture</button>
                <button class="filter-btn" data-filter="commercial">Commercial</button>
                <button class="filter-btn" data-filter="kitchens">Kitchens</button>
            </div>
            <div class="portfolio-grid">
                <div class="portfolio-item" data-category="kitchens">
                    <div class="portfolio-overlay">
                        <h3>Contemporary Kitchen</h3>
                        <p>Modern Design</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinetry">
                    <div class="portfolio-overlay">
                        <h3>Built-in Storage</h3>
                        <p>Custom Cabinetry</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinetry">
                    <div class="portfolio-overlay">
                        <h3>Built-in Wardrobe</h3>
                        <p>Custom Storage</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="commercial">
                    <div class="portfolio-overlay">
                        <h3>Entertainment Unit</h3>
                        <p>Media Storage</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="kitchens">
                    <div class="portfolio-overlay">
                        <h3>Island Kitchen</h3>
                        <p>Modern Kitchen</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinetry">
                    <div class="portfolio-overlay">
                        <h3>Garage Storage</h3>
                        <p>Organization System</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="cabinetry">
                    <div class="portfolio-overlay">
                        <h3>Walk-in Wardrobe</h3>
                        <p>Premium Storage</p>
                    </div>
                </div>
                <div class="portfolio-item" data-category="furniture">
                    <div class="portfolio-overlay">
                        <h3>Custom Credenza</h3>
                        <p>Bespoke Furniture</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Client Testimonials</h2>
                <p>Don't just take our word for it - here's what our clients have to say about our work.</p>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial-slide">
                    <div class="client-img"></div>
                    <div class="testimonial-text">
                        <p>Masterwork transformed our kitchen with stunning cabinetry that exceeded our expectations. Their attention to detail and craftsmanship is exceptional. The team was professional and accommodating throughout the entire process.</p>
                    </div>
                    <div class="client-info">
                        <h4>Sarah Thompson</h4>
                        <p>Residential Client</p>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="client-img"></div>
                    <div class="testimonial-text">
                        <p>As an interior designer, I rely on quality craftsmanship to bring my visions to life. Masterwork Joinery has been my go-to for over 5 years. Their work is consistently flawless, and they meet deadlines without fail.</p>
                    </div>
                    <div class="client-info">
                        <h4>Michael Reynolds</h4>
                        <p>Interior Designer</p>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="client-img"></div>
                    <div class="testimonial-text">
                        <p>We hired Masterwork for our restaurant renovation, and the results were outstanding. The custom bar and seating have become a talking point among our customers. We highly recommend their commercial joinery services.</p>
                    </div>
                    <div class="client-info">
                        <h4>Emma Davis</h4>
                        <p>Business Owner</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Contact Us</h2>
                <p>Get in touch to discuss your project requirements or to schedule a consultation.</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i>📍</i>
                        </div>
                        <div class="contact-text">
                            <h4>Our Location</h4>
                            <p>123 Workshop Lane, Craftsville, CV1 2AB</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i>📞</i>
                        </div>
                        <div class="contact-text">
                            <h4>Phone Number</h4>
                            <a href="tel:+4401234567890">+44 (0) 1234 567890</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i>✉️</i>
                        </div>
                        <div class="contact-text">
                            <h4>Email Address</h4>
                            <a href="mailto:info@masterworkjoinery.com">info@masterworkjoinery.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i>⏰</i>
                        </div>
                        <div class="contact-text">
                            <h4>Working Hours</h4>
                            <p>Monday - Friday: 8:00 AM - 5:00 PM</p>
                            <p>Saturday: By appointment only</p>
                        </div>
                    </div>
                    <div class="contact-social">
                        <a href="#" class="social-link"><i>📘</i></a>
                        <a href="#" class="social-link"><i>📷</i></a>
                        <a href="#" class="social-link"><i>🐦</i></a>
                        <a href="#" class="social-link"><i>💼</i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <?php if ($message): ?>
                        <div class="form-message <?php echo $messageType; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <textarea name="message" class="form-control" placeholder="Your Message" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        </div>
                        <button type="submit" name="submit_contact" class="form-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <svg width="200" height="60" viewBox="0 0 200 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="footer-logo">
                        <!-- Geometric M Symbol -->
                        <g transform="translate(0, 5)">
                            <!-- Left triangle -->
                            <polygon points="5,45 15,5 25,35 15,45" fill="#666666" opacity="0.9"/>
                            <!-- Center diamonds -->
                            <polygon points="20,25 30,5 40,25 30,45" fill="#888888" opacity="0.8"/>
                            <polygon points="30,25 40,5 50,25 40,45" fill="#AAAAAA" opacity="0.7"/>
                            <!-- Right triangle -->
                            <polygon points="45,45 55,5 65,45 55,35" fill="#666666" opacity="0.9"/>
                        </g>
                        <!-- Text -->
                        <text x="75" y="20" font-family="Arial, sans-serif" font-size="14" font-weight="700" fill="#F47B20">MASTER</text>
                        <text x="75" y="35" font-family="Arial, sans-serif" font-size="14" font-weight="700" fill="#AAAAAA">WORK</text>
                        <text x="75" y="48" font-family="Arial, sans-serif" font-size="9" fill="#777777">JOINERY SOLUTIONS</text>
                    </svg>
                    <p>With a commitment to quality craftsmanship and customer satisfaction, Masterwork Joinery Solutions delivers exceptional woodworking services for both residential and commercial clients.</p>
                </div>
                <div class="footer-links">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#portfolio">Portfolio</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-services">
                    <h3 class="footer-title">Our Services</h3>
                    <ul>
                        <li><a href="#">Custom Cabinetry</a></li>
                        <li><a href="#">Architectural Joinery</a></li>
                        <li><a href="#">Bespoke Furniture</a></li>
                        <li><a href="#">Commercial Fit-outs</a></li>
                        <li><a href="#">Kitchen & Bathroom</a></li>
                        <li><a href="#">Restoration & Repair</a></li>
                    </ul>
                </div>
                <div class="footer-newsletter">
                    <h3 class="footer-title">Newsletter</h3>
                    <p>Subscribe to our newsletter to receive updates on our latest projects and special offers.</p>
                    <form class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Your Email Address" required>
                        <button type="submit" class="newsletter-btn">→</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> Masterwork Joinery Solutions. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navigation toggle
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        const navLinksItems = document.querySelectorAll('.nav-links li');
        
        if (hamburger && navLinks) {
            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                hamburger.classList.toggle('active');
                
                navLinksItems.forEach((link, index) => {
                    if (link.style.animation) {
                        link.style.animation = '';
                    } else {
                        link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`;
                    }
                });
            });
        }
        
        // Shrink header on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (header) {
                header.classList.toggle('scrolled', window.scrollY > 0);
            }
        });
        
        // Portfolio filter
        const filterBtns = document.querySelectorAll('.filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(btn => btn.classList.remove('active'));
                btn.classList.add('active');
                
                const filter = btn.getAttribute('data-filter');
                
                portfolioItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    
                    if (filter === 'all' || filter === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        
        // Testimonial slider
        const testimonialSlides = document.querySelectorAll('.testimonial-slide');
        let currentSlide = 0;
        
        function showSlide(n) {
            testimonialSlides.forEach(slide => slide.style.display = 'none');
            if (testimonialSlides[n]) {
                testimonialSlides[n].style.display = 'block';
            }
        }
        
        function nextSlide() {
            currentSlide++;
            if (currentSlide >= testimonialSlides.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        }
        
        if (testimonialSlides.length > 0) {
            showSlide(currentSlide);
            setInterval(nextSlide, 5000);
        }
        
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
                
                if (navLinks && navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    hamburger.classList.remove('active');
                    
                    navLinksItems.forEach(link => {
                        link.style.animation = '';
                    });
                }
            });
        });
    </script>
</body>
</html>
