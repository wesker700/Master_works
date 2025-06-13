<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-about">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/assets/images/logo.png" alt="' . get_bloginfo('name') . '" class="footer-logo">';
                }
                ?>
                <p>With a commitment to quality craftsmanship and customer satisfaction, Masterwork Joinery Solutions delivers exceptional woodworking services for both residential and commercial clients.</p>
            </div>
            <div class="footer-links">
                <h3 class="footer-title">Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu',
                    'container' => 'ul',
                ));
                ?>
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
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

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