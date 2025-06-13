<?php get_header(); ?>

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
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-workshop.jpg" alt="Masterwork Joinery Workshop">
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
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-cabinetry.jpg" alt="Custom Cabinetry">
                </div>
                <div class="service-content">
                    <h3>Custom Cabinetry</h3>
                    <p>Bespoke cabinets and storage solutions designed to maximize space and complement your interior style.</p>
                    <a href="#" class="service-link">Learn More <span>→</span></a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-architectural.jpg" alt="Architectural Joinery">
                </div>
                <div class="service-content">
                    <h3>Architectural Joinery</h3>
                    <p>From staircases to paneling, our architectural joinery enhances the character and value of any property.</p>
                    <a href="#" class="service-link">Learn More <span>→</span></a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-furniture.jpg" alt="Bespoke Furniture">
                </div>
                <div class="service-content">
                    <h3>Bespoke Furniture</h3>
                    <p>Custom-made furniture pieces crafted to your specifications using traditional and modern techniques.</p>
                    <a href="#" class="service-link">Learn More <span>→</span></a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-commercial.jpg" alt="Commercial Fit-outs">
                </div>
                <div class="service-content">
                    <h3>Commercial Fit-outs</h3>
                    <p>High-quality joinery solutions for retail, hospitality, and office spaces that make a lasting impression.</p>
                    <a href="#" class="service-link">Learn More <span>→</span></a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-kitchen.jpg" alt="Kitchen & Bathroom">
                </div>
                <div class="service-content">
                    <h3>Kitchen & Bathroom</h3>
                    <p>Expertly crafted kitchens and bathroom cabinetry that combine functionality with stunning aesthetics.</p>
                    <a href="#" class="service-link">Learn More <span>→</span></a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service-restoration.jpg" alt="Restoration & Repair">
                </div>
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
            <?php
            $portfolio_posts = new WP_Query(array(
                'post_type' => 'portfolio',
                'posts_per_page' => 8
            ));
            
            if ($portfolio_posts->have_posts()) :
                while ($portfolio_posts->have_posts()) : $portfolio_posts->the_post();
                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    $category_slug = $categories ? $categories[0]->slug : 'general';
            ?>
                <div class="portfolio-item" data-category="<?php echo $category_slug; ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium', array('class' => 'portfolio-img')); ?>
                    <?php endif; ?>
                    <div class="portfolio-overlay">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo $categories ? $categories[0]->name : 'Portfolio'; ?></p>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
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
                <div class="client-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client1.jpg" alt="Client">
                </div>
                <div class="testimonial-text">
                    <p>Masterwork transformed our kitchen with stunning cabinetry that exceeded our expectations. Their attention to detail and craftsmanship is exceptional. The team was professional and accommodating throughout the entire process.</p>
                </div>
                <div class="client-info">
                    <h4>Sarah Thompson</h4>
                    <p>Residential Client</p>
                </div>
            </div>
            <div class="testimonial-slide">
                <div class="client-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client2.jpg" alt="Client">
                </div>
                <div class="testimonial-text">
                    <p>As an interior designer, I rely on quality craftsmanship to bring my visions to life. Masterwork Joinery has been my go-to for over 5 years. Their work is consistently flawless, and they meet deadlines without fail.</p>
                </div>
                <div class="client-info">
                    <h4>Michael Reynolds</h4>
                    <p>Interior Designer</p>
                </div>
            </div>
            <div class="testimonial-slide">
                <div class="client-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client3.jpg" alt="Client">
                </div>
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
                    <a href="#" class="social-link"><i>📱</i></a>
                    <a href="#" class="social-link"><i>📱</i></a>
                    <a href="#" class="social-link"><i>📱</i></a>
                    <a href="#" class="social-link"><i>📱</i></a>
                </div>
            </div>
            <div class="contact-form">
                <?php echo do_shortcode('[contact_form]'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>