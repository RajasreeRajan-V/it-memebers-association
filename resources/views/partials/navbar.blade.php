<style>
:root{
    --nav-bg:#0e1226;
    --nav-bg-scroll:rgba(13,17,34,.94);
    --nav-border:rgba(255,255,255,.08);
    --nav-text:rgba(255,255,255,.72);
    --nav-text-hover:#ffffff;
    --nav-accent:#E3A028;
    --nav-brand-chip:#1C7C72;
}

.site-navbar{
    background:linear-gradient(180deg, var(--nav-bg), #0b0f20);
    border-bottom:1px solid var(--nav-border);
    padding:.8rem 0;
    position:sticky;
    top:0;
    z-index:1000;
    transition:background .25s ease, padding .25s ease, box-shadow .25s ease;
}

.site-navbar.is-scrolled{
    background:var(--nav-bg-scroll);
    backdrop-filter:blur(12px);
    padding:.55rem 0;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}

.site-navbar .container{
    display:flex;
    align-items:center;
    justify-content:space-between;
}

/* ---------- Brand ---------- */
.site-navbar .navbar-brand{
    display:inline-flex;
    align-items:center;
    gap:.6rem;
    font-weight:800;
    font-size:1.08rem;
    letter-spacing:-.01em;
    color:#fff !important;
    transition:opacity .18s ease;
}

.site-navbar .navbar-brand:hover{
    opacity:.9;
}

.site-navbar .navbar-brand .brand-mark{
    width:34px;
    height:34px;
    border-radius:10px;
    background:linear-gradient(135deg, var(--nav-brand-chip), #135b54);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:.88rem;
    font-weight:800;
    color:#fff;
    flex-shrink:0;
    box-shadow:0 6px 14px rgba(28,124,114,.4);
}

/* ---------- Nav links ---------- */
.site-navbar .navbar-nav{
    gap:.1rem;
    align-items:center;
}

.site-navbar .nav-item{
    position:relative;
}

.site-navbar .nav-link{
    color:var(--nav-text) !important;
    font-weight:600;
    font-size:.9rem;
    padding:.5rem .9rem !important;
    border-radius:8px;
    transition:color .18s ease, background .18s ease;
}

.site-navbar .nav-link:hover,
.site-navbar .nav-link:focus{
    color:var(--nav-text-hover) !important;
    background:rgba(255,255,255,.06);
}

.site-navbar .nav-link.active{
    color:#fff !important;
}

.site-navbar .nav-link.active::after{
    content:"";
    position:absolute;
    left:.9rem;
    right:.9rem;
    bottom:.05rem;
    height:2px;
    background:var(--nav-accent);
    border-radius:2px;
}

/* ---------- Divider before the membership button ---------- */
.site-navbar .nav-divider{
    width:1px;
    height:22px;
    background:rgba(255,255,255,.14);
    margin:0 .65rem;
    flex-shrink:0;
}

/* ---------- Toggler ---------- */
.site-navbar .navbar-toggler{
    border:1px solid rgba(255,255,255,.25) !important;
    border-radius:8px;
    padding:.4rem .55rem;
    background:transparent !important;
}

.site-navbar .navbar-toggler:focus{
    box-shadow:0 0 0 3px rgba(227,160,40,.25);
}

.site-navbar .navbar-toggler-icon{
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.9)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* ---------- Membership button — short, high-contrast pill ---------- */
.site-navbar .navbar-login,
.site-navbar .navbar-login:link,
.site-navbar .navbar-login:visited{
    display:inline-flex;
    align-items:center;
    gap:.3rem;
    color:#1a1200 !important;
    font-weight:700 !important;
    font-size:.85rem;
    letter-spacing:.01em;
    padding:.42rem .95rem !important;
    border-radius:999px;
    border:none;
    background:linear-gradient(135deg, #f2bb52, var(--nav-accent) 65%, #c98c1e);
    box-shadow:0 5px 14px rgba(227,160,40,.35);
    text-decoration:none !important;
    transition:transform .18s ease, box-shadow .18s ease, filter .18s ease;
}

.site-navbar .navbar-login:hover,
.site-navbar .navbar-login:focus{
    color:#1a1200 !important;
    text-decoration:none !important;
    transform:translateY(-2px);
    box-shadow:0 9px 20px rgba(227,160,40,.48);
    filter:brightness(1.04);
}

.site-navbar .navbar-login .login-badge{
    font-size:.85rem;
    line-height:1;
}

@media (max-width:991.98px){
    .site-navbar .navbar-collapse{
        margin-top:.85rem;
        padding-top:.85rem;
        border-top:1px solid var(--nav-border);
    }
    .site-navbar .navbar-nav{
        align-items:flex-start;
    }
    .site-navbar .nav-link.active::after{ display:none; }
    .site-navbar .nav-link.active{
        background:rgba(227,160,40,.12);
        color:var(--nav-accent) !important;
    }
    .site-navbar .nav-divider{
        display:none;
    }
    .site-navbar .navbar-login{
        display:inline-flex;
        margin:.6rem 0 0 .9rem;
    }
}
</style>

<nav class="navbar navbar-expand-lg site-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand-mark">N</span>
            Nexus Association
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li class="nav-item"><a href="{{ route('events') }}" class="nav-link {{ request()->routeIs('events') ? 'active' : '' }}">Events</a></li>
                <li class="nav-item"><a href="{{ route('faq') }}" class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                <span class="nav-divider d-none d-lg-block"></span>
                <li class="nav-item">
                    <a href="#" class="navbar-login">
                        <span class="login-badge">👤</span>
                        <span>Membership</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
(function(){
    var nav = document.querySelector('.site-navbar');
    if(!nav) return;
    function onScroll(){
        if(window.scrollY > 12){ nav.classList.add('is-scrolled'); }
        else{ nav.classList.remove('is-scrolled'); }
    }
    window.addEventListener('scroll', onScroll, { passive:true });
    onScroll();
})();
</script>