<style>
.site-footer{
    --footer-bg:#0e1226;
    --footer-bg-2:#0b0f20;
    --footer-line:rgba(255,255,255,.08);
    --footer-text:rgba(255,255,255,.66);
    --footer-text-strong:#ffffff;
    --footer-accent:#E3A028;
    --footer-teal:#1C7C72;
    background:linear-gradient(180deg, var(--footer-bg), var(--footer-bg-2));
    color:var(--footer-text);
    position:relative;
    padding-top:4rem;
    font-family:'Inter','Segoe UI',sans-serif;
}

.site-footer::before{
    content:"";
    position:absolute;
    top:0; left:0; right:0;
    height:1px;
    background:linear-gradient(90deg, transparent, rgba(227,160,40,.4), transparent);
}

.site-footer a{
    color:var(--footer-text);
    text-decoration:none;
    transition:color .18s ease, padding-left .18s ease;
}

.site-footer a:hover{
    color:var(--footer-accent);
}

.site-footer h4, .site-footer h6{
    font-family:'Sora','Segoe UI',sans-serif;
    color:var(--footer-text-strong);
}

/* ---------- Top grid ---------- */
.footer-grid{
    padding-bottom:2.75rem;
    border-bottom:1px solid var(--footer-line);
}

.footer-brand{
    display:inline-flex;
    align-items:center;
    gap:.6rem;
    font-family:'Sora','Segoe UI',sans-serif;
    font-weight:800;
    font-size:1.15rem;
    color:#fff;
    margin-bottom:1rem;
}

.footer-brand .brand-mark{
    width:36px;
    height:36px;
    border-radius:10px;
    background:linear-gradient(135deg, var(--footer-teal), #135b54);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:.95rem;
    font-weight:800;
    color:#fff;
    flex-shrink:0;
    box-shadow:0 6px 14px rgba(28,124,114,.4);
}

.footer-about p{
    font-size:.88rem;
    line-height:1.75;
    max-width:320px;
    margin-bottom:1.5rem;
}

.footer-socials{
    display:flex;
    gap:.6rem;
}

.footer-socials a{
    width:36px;
    height:36px;
    border-radius:50%;
    background:rgba(255,255,255,.06);
    border:1px solid var(--footer-line);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:.85rem;
    color:var(--footer-text-strong);
    transition:background .2s ease, border-color .2s ease, transform .2s ease, color .2s ease;
}

.footer-socials a:hover{
    background:var(--footer-accent);
    border-color:var(--footer-accent);
    color:#1a1200;
    transform:translateY(-3px);
}

.footer-heading{
    font-size:.82rem;
    font-weight:800;
    letter-spacing:.1em;
    text-transform:uppercase;
    color:var(--footer-text-strong);
    margin-bottom:1.25rem;
    position:relative;
    display:inline-block;
}

.footer-heading::after{
    content:"";
    position:absolute;
    left:0;
    bottom:-8px;
    width:26px;
    height:2px;
    background:var(--footer-accent);
    border-radius:2px;
}

.footer-links{
    list-style:none;
    padding:0;
    margin:0;
}

.footer-links li{
    margin-bottom:.7rem;
}

.footer-links a{
    font-size:.88rem;
    display:inline-block;
}

.footer-links a:hover{
    padding-left:4px;
}

.footer-contact li{
    display:flex;
    align-items:flex-start;
    gap:.65rem;
    margin-bottom:.9rem;
    font-size:.86rem;
    line-height:1.55;
}

.footer-contact .contact-icon{
    width:32px;
    height:32px;
    border-radius:9px;
    background:rgba(227,160,40,.12);
    color:var(--footer-accent);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:.8rem;
    flex-shrink:0;
}

.footer-newsletter{
    background:rgba(255,255,255,.04);
    border:1px solid var(--footer-line);
    border-radius:14px;
    padding:1.1rem;
}

.footer-newsletter p{
    font-size:.82rem;
    margin-bottom:.85rem;
    color:var(--footer-text);
}

.footer-newsletter .form-control{
    background:rgba(255,255,255,.06);
    border:1px solid var(--footer-line);
    color:#fff;
    font-size:.85rem;
    border-radius:8px 0 0 8px;
    height:42px;
}

.footer-newsletter .form-control::placeholder{
    color:rgba(255,255,255,.4);
}

.footer-newsletter .form-control:focus{
    background:rgba(255,255,255,.09);
    border-color:var(--footer-accent);
    box-shadow:none;
    color:#fff;
}

.footer-newsletter .btn-subscribe{
    background:var(--footer-accent);
    border:1px solid var(--footer-accent);
    color:#1a1200;
    font-weight:700;
    font-size:.85rem;
    border-radius:0 8px 8px 0;
    padding:0 1.1rem;
    transition:background .18s ease;
}

.footer-newsletter .btn-subscribe:hover{
    background:#c98c1e;
    border-color:#c98c1e;
}

/* ---------- Bottom bar ---------- */
.footer-bottom{
    padding:1.4rem 0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:1rem;
    flex-wrap:wrap;
    font-size:.82rem;
    color:rgba(255,255,255,.5);
}

.footer-bottom .legal-links{
    display:flex;
    gap:1.5rem;
    flex-wrap:wrap;
}

.footer-bottom .legal-links a{
    font-size:.82rem;
    color:rgba(255,255,255,.5);
}

.footer-bottom .legal-links a:hover{
    color:var(--footer-accent);
}

@media (max-width:767.98px){
    .footer-grid > [class^="col-"]{
        margin-bottom:2.25rem;
    }
    .footer-grid > [class^="col-"]:last-child{
        margin-bottom:0;
    }
    .footer-about p{
        max-width:none;
    }
    .footer-bottom{
        justify-content:center;
        text-align:center;
    }
}
</style>

<footer class="site-footer">
    <div class="container">

        <div class="row footer-grid gy-4">

            <!-- Brand / About -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-about">
                    <a href="{{ route('home') }}" class="footer-brand">
                        <span class="brand-mark">N</span>
                        Nexus Association
                    </a>
                    <p>
                        One verified platform connecting students, employees, employers, freelancers,
                        investors and mentors — every profile and listing checked before it goes live.
                    </p>
                    <div class="footer-socials">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Membership -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Membership</h6>
                <ul class="footer-links">
                    <li><a href="#roles">Students</a></li>
                    <li><a href="#roles">Employees</a></li>
                    <li><a href="#roles">Employers</a></li>
                    <li><a href="#roles">Freelancers</a></li>
                    <li><a href="#roles">Investors &amp; Mentors</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Get In Touch</h6>
                <ul class="footer-contact" style="list-style:none;padding:0;margin:0 0 1.25rem;">
                    <li>
                        <span class="contact-icon"><i class="fa-solid fa-location-dot"></i></span>
                        <span>123 Business Street<br>Kochi, Kerala 682001</span>
                    </li>
                    <li>
                        <span class="contact-icon"><i class="fa-solid fa-envelope"></i></span>
                        <span><a href="mailto:info@nexus.com">info@nexus.com</a></span>
                    </li>
                    <li>
                        <span class="contact-icon"><i class="fa-solid fa-phone"></i></span>
                        <span><a href="tel:+919876543210">+91 98765 43210</a></span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="footer-bottom">
            <p class="mb-0">© {{ date('Y') }} Nexus Association. All Rights Reserved.</p>
            <div class="legal-links">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('cookie-policy') }}">Cookie Policy</a>
            </div>
        </div>

    </div>
</footer>