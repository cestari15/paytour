<!-- resources/views/components/footer.blade.php -->

<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

<footer class="top">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <div class="links">
        <div class="links-column">
            <h2>Get Started</h2>
            <a href="#">Introduction</a>
            <a href="#">Documentation</a>
            <a href="#">Usage</a>
            <a href="#">Globals</a>
            <a href="#">Elements</a>
        </div>
        <div class="links-column">
            <h2>Resources</h2>
            <a href="#">API</a>
            <a href="#">Visibility</a>
            <a href="#">Accessibility</a>
            <a href="#">Community</a>
            <a href="#">Marketplace</a>
        </div>
        <div class="links-column socials-column">
            <h2>Social Media</h2>
            <p>Follow us on social media to find out the latest updates on our progress.</p>
            <div class="socials">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

<footer class="bottom">
    <p class="copyright">© 2023 All rights reserved</p>
    <div class="legal">
        <a href="#">License</a>
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
    </div>
</footer>
