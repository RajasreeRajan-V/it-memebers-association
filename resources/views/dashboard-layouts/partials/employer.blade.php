@extends('layouts.app')

@section('title', 'Employer Dashboard')

@section('content')

<style>

/* =========================================================
   EMPLOYER DASHBOARD — PREMIUM THEME
========================================================= */

.employer-dashboard{
    --ed-primary:#3363D6;
    --ed-primary-2:#5b82e8;
    --ed-primary-dark:#284ea8;
    --ed-primary-soft:#eaf0ff;
    --ed-ink:#151a2e;
    --ed-ink-soft:#5b6478;
    --ed-ink-faint:#98a2b8;
    --ed-line:#e7e9f4;
    --ed-line-soft:#f0f1f9;
    --ed-bg:#f6f7fc;
    --ed-surface:#ffffff;
    --ed-teal:#0d9488;
    --ed-teal-soft:#e5f7f4;
    --ed-violet:#7c3aed;
    --ed-violet-soft:#f3edff;
    --ed-amber:#d97706;
    --ed-amber-soft:#fef3e2;
    --ed-rose:#e11d5e;
    --ed-rose-soft:#feecf2;
    --ed-emerald:#059669;
    --ed-emerald-soft:#e7f8f1;
    --ed-r-sm:10px;
    --ed-r-md:14px;
    --ed-r-lg:20px;
    --ed-r-xl:26px;
    --ed-shadow-xs:0 1px 2px rgba(21,26,46,.05);
    --ed-shadow-sm:0 2px 8px rgba(21,26,46,.05),0 1px 2px rgba(21,26,46,.04);
    --ed-shadow-md:0 8px 24px rgba(30,32,80,.07),0 2px 6px rgba(30,32,80,.04);
    --ed-shadow-lg:0 20px 48px rgba(30,32,80,.14),0 6px 16px rgba(30,32,80,.06);
    --ed-shadow-glow:0 14px 30px rgba(67,56,202,.22);

    width:100%;
    font-family:Inter,Poppins,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
    color:var(--ed-ink);
    background:var(--ed-bg);
    padding:0 0 45px;
}

.employer-dashboard *,
.employer-dashboard *::before,
.employer-dashboard *::after{
    box-sizing:border-box;
}

.ed-container{
    width:min(1180px,calc(100% - 40px));
    margin:0 auto;
}

.ed-link{
    text-decoration:none;
    color:var(--ed-primary);
    font-weight:600;
}

.ed-link:hover{
    color:var(--ed-primary-dark);
}


/* =========================================================
   HERO
========================================================= */

.ed-hero{
    position:relative;
    overflow:hidden;
    background:
        radial-gradient(760px 420px at 14% -10%,rgba(109,91,245,.16),transparent 60%),
        radial-gradient(620px 380px at 92% 10%,rgba(13,148,136,.13),transparent 55%),
        linear-gradient(180deg,#f3f2ff 0%,#f6f7fc 62%,#ffffff 100%);
    border-bottom:1px solid var(--ed-line-soft);
}

.ed-hero::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:
        linear-gradient(rgba(21,26,46,.028) 1px,transparent 1px),
        linear-gradient(90deg,rgba(21,26,46,.028) 1px,transparent 1px);
    background-size:34px 34px;
    -webkit-mask-image:linear-gradient(180deg,rgba(0,0,0,.6),transparent 75%);
    mask-image:linear-gradient(180deg,rgba(0,0,0,.6),transparent 75%);
    pointer-events:none;
}

.ed-hero-inner{
    position:relative;
    width:min(1152px,calc(100% - 40px));
    min-height:390px;
    margin:0 auto;
    padding:48px 0 46px;
    display:grid;
    grid-template-columns:minmax(0,1fr) minmax(0,1fr);
    align-items:center;
    gap:35px;
}

.ed-hero-content{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
    text-align:left;
    width:100%;
}

.ed-eyebrow{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:7px 14px 7px 12px;
    margin-bottom:19px;
    border-radius:999px;
    background:#fff;
    border:1px solid #e2e0ff;
    color:var(--ed-primary);
    font-size:11.5px;
    font-weight:800;
    letter-spacing:.06em;
    box-shadow:var(--ed-shadow-xs);
}

.ed-eyebrow::before{
    content:"";
    width:7px;
    height:7px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--ed-primary-2),var(--ed-teal));
}

.ed-hero h1{
    margin:0;
    max-width:570px;
    font-family:inherit;
    font-size:47px;
    line-height:1.1;
    letter-spacing:-.035em;
    font-weight:800;
    color:var(--ed-ink);
}

.ed-hero h1 span{
    display:block;
    background:linear-gradient(100deg,var(--ed-primary) 10%,var(--ed-primary-2) 55%,var(--ed-teal) 100%);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
}

.ed-hero-description{
    max-width:500px;
    margin:18px 0 27px;
    color:var(--ed-ink-soft);
    font-size:15.5px;
    line-height:1.75;
    font-weight:400;
}

.ed-hero-buttons{
    display:flex;
    align-items:center;
    flex-wrap:wrap;
    gap:12px;
}

.ed-btn{
    min-height:49px;
    padding:0 26px;
    border-radius:11px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
    transition:transform .18s ease,background .18s ease,border-color .18s ease,box-shadow .18s ease;
}

.ed-btn-primary{
    color:#fff;
    background:linear-gradient(135deg,var(--ed-primary) 0%,var(--ed-primary-2) 100%);
    box-shadow:var(--ed-shadow-glow);
    border:1px solid transparent;
}

.ed-btn-primary:hover{
    color:#fff;
    background:linear-gradient(135deg,var(--ed-primary-dark) 0%,var(--ed-primary) 100%);
    transform:translateY(-2px);
    box-shadow:0 18px 36px rgba(67,56,202,.28);
}

.ed-btn-light{
    color:var(--ed-ink);
    background:#fff;
    border:1px solid var(--ed-line);
    box-shadow:var(--ed-shadow-xs);
}

.ed-btn-light:hover{
    color:var(--ed-primary);
    background:#fff;
    border-color:#c9c4ff;
    transform:translateY(-2px);
    box-shadow:var(--ed-shadow-sm);
}

.ed-hero-visual{
    position:relative;
    width:100%;
    min-height:335px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.ed-hero-image{
    width:100%;
    max-width:440px;
    height:auto;
    display:block;
    object-fit:contain;
    border:0!important;
    margin:0!important;
    box-shadow:none!important;
    filter:none!important;
}

.ed-hero-feature{
    position:absolute;
    display:flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,.9);
    backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,.7);
    border-radius:14px;
    padding:10px 14px;
    box-shadow:var(--ed-shadow-lg);
    white-space:nowrap;
    z-index:3;
}

.ed-hero-feature-icon{
    width:32px;
    height:32px;
    min-width:32px;
    border-radius:9px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:13px;
    font-weight:700;
}

.ed-hero-feature-text{
    display:flex;
    flex-direction:column;
    gap:2px;
}

.ed-hero-feature-title{
    color:var(--ed-ink);
    font-size:11px;
    line-height:1.2;
    font-weight:800;
}

.ed-hero-feature-subtitle{
    color:var(--ed-ink-faint);
    font-size:9px;
    line-height:1.2;
    font-weight:600;
}

.ed-feature-verified{
    top:28px;
    left:-2px;
}

.ed-feature-verified .ed-hero-feature-icon{
    background:linear-gradient(135deg,#dfe6ff,#eef0ff);
    color:var(--ed-primary);
}

.ed-feature-matching{
    top:105px;
    right:-2px;
}

.ed-feature-matching .ed-hero-feature-icon{
    background:linear-gradient(135deg,#ece2ff,var(--ed-violet-soft));
    color:var(--ed-violet);
}

.ed-feature-hiring{
    bottom:28px;
    left:-18px;
}

.ed-feature-hiring .ed-hero-feature-icon{
    background:linear-gradient(135deg,#d7f5ea,var(--ed-emerald-soft));
    color:var(--ed-emerald);
}

/* =========================================================
   RECOMMENDED CANDIDATES
========================================================= */

.ed-recommended-section{
    width:100%;
    margin-top:32px;
}


.ed-section-head{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:20px;
    margin-bottom:20px;
}


.ed-section-kicker{
    display:inline-block;
    margin-bottom:7px;
    font-size:11px;
    font-weight:800;
    letter-spacing:1.4px;
    color:var(--ed-primary);
    text-transform:uppercase;
}


.ed-section-head h2{
    margin:0;
    color:var(--ed-ink);
    font-size:24px;
    line-height:1.25;
    font-weight:800;
    letter-spacing:-.01em;
}


.ed-section-head p{
    margin:6px 0 0;
    color:var(--ed-ink-soft);
    font-size:13px;
}


.ed-view-all{
    display:inline-flex;
    align-items:center;
    gap:7px;
    text-decoration:none;
    color:var(--ed-primary);
    font-size:13px;
    font-weight:700;
    white-space:nowrap;
    padding:9px 15px;
    border-radius:999px;
    background:var(--ed-primary-soft);
    transition:.2s ease;
}


.ed-view-all:hover{
    color:#fff;
    background:var(--ed-primary);
    transform:translateX(2px);
}


.ed-recommended-grid{
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    gap:18px;
}


.ed-recommended-card{
    position:relative;
    background:var(--ed-surface);
    border:1px solid var(--ed-line);
    border-radius:var(--ed-r-lg);
    padding:20px;
    box-shadow:var(--ed-shadow-sm);
    transition:
        transform .25s cubic-bezier(.22,1,.36,1),
        box-shadow .25s ease,
        border-color .25s ease;
    overflow:hidden;
}

.ed-recommended-card::before{
    content:"";
    position:absolute;
    top:0;left:0;right:0;
    height:3px;
    background:linear-gradient(90deg,var(--ed-primary),var(--ed-primary-2),var(--ed-teal));
    opacity:0;
    transition:opacity .25s ease;
}


.ed-recommended-card:hover{
    transform:translateY(-5px);
    border-color:#dcdcff;
    box-shadow:var(--ed-shadow-lg);
}

.ed-recommended-card:hover::before{
    opacity:1;
}


.ed-recommended-top{
    display:flex;
    align-items:center;
    gap:12px;
}


.ed-candidate-avatar{
    width:50px;
    height:50px;
    min-width:50px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e3e6ff);
    color:var(--ed-primary);
    font-size:15px;
    font-weight:800;
    overflow:hidden;
    box-shadow:inset 0 0 0 1px rgba(67,56,202,.08);
}


.ed-candidate-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}


.ed-candidate-info{
    min-width:0;
    flex:1;
}


.ed-candidate-info h3{
    margin:0;
    color:var(--ed-ink);
    font-size:15px;
    font-weight:800;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}


.ed-candidate-info p{
    margin:4px 0 0;
    color:var(--ed-ink-soft);
    font-size:12px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}


.ed-match-score{
    min-width:58px;
    text-align:right;
}


.ed-match-score strong{
    display:block;
    background:linear-gradient(135deg,var(--ed-primary),var(--ed-teal));
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
    font-size:19px;
    line-height:1;
    font-weight:800;
}


.ed-match-score span{
    display:block;
    margin-top:4px;
    color:var(--ed-ink-faint);
    font-size:10px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.04em;
}


.ed-match-reasons{
    display:flex;
    flex-wrap:wrap;
    gap:6px;
    margin-top:16px;
}


.ed-match-reasons span{
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:5px 9px;
    border-radius:20px;
    background:var(--ed-teal-soft);
    color:var(--ed-teal);
    font-size:10px;
    font-weight:700;
}


.ed-match-reasons i{
    font-size:8px;
}


.ed-candidate-skills{
    display:flex;
    flex-wrap:wrap;
    gap:6px;
    margin-top:14px;
    min-height:27px;
}


.ed-candidate-skills span{
    padding:5px 10px;
    border-radius:7px;
    background:var(--ed-line-soft);
    color:#4a5468;
    border:1px solid var(--ed-line);
    font-size:10px;
    font-weight:700;
}


.ed-recommended-actions{
    display:flex;
    align-items:center;
    gap:9px;
    margin-top:18px;
}


.ed-profile-btn,
.ed-invite-btn{
    flex:1;
    min-height:39px;
    border-radius:9px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    font-family:inherit;
    font-size:11px;
    font-weight:800;
    cursor:pointer;
    transition:.22s ease;
}


.ed-profile-btn{
    text-decoration:none;
    background:var(--ed-line-soft);
    color:#3a4256;
    border:1px solid var(--ed-line);
}


.ed-profile-btn:hover{
    background:#eceffb;
    border-color:#d6dcf2;
}


.ed-invite-btn{
    background:linear-gradient(135deg,var(--ed-primary),var(--ed-primary-2));
    color:#fff;
    border:1px solid transparent;
    box-shadow:0 6px 16px rgba(67,56,202,.20);
}


.ed-invite-btn:hover{
    background:linear-gradient(135deg,var(--ed-primary-dark),var(--ed-primary));
    transform:translateY(-1px);
    box-shadow:0 10px 20px rgba(67,56,202,.26);
}


.ed-empty-recommendations{
    background:var(--ed-surface);
    border:1.5px dashed #d9dcf0;
    border-radius:var(--ed-r-lg);
    padding:44px 20px;
    text-align:center;
}


.ed-empty-icon{
    width:54px;
    height:54px;
    margin:0 auto 14px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
    font-size:19px;
}


.ed-empty-recommendations h3{
    margin:0;
    font-size:16px;
    color:var(--ed-ink);
    font-weight:800;
}


.ed-empty-recommendations p{
    max-width:440px;
    margin:8px auto 18px;
    color:var(--ed-ink-soft);
    font-size:13px;
    line-height:1.6;
}


.ed-primary-btn{
    display:inline-flex;
    align-items:center;
    gap:7px;
    padding:11px 18px;
    border-radius:9px;
    background:linear-gradient(135deg,var(--ed-primary),var(--ed-primary-2));
    color:#fff;
    text-decoration:none;
    font-size:12px;
    font-weight:800;
    box-shadow:0 8px 18px rgba(67,56,202,.22);
    transition:.2s ease;
}


.ed-primary-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 12px 22px rgba(67,56,202,.28);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .ed-recommended-grid{
        grid-template-columns:repeat(2, minmax(0, 1fr));
    }

}


@media(max-width:700px){

    .ed-section-head{
        align-items:flex-start;
        flex-direction:column;
    }

    .ed-recommended-grid{
        grid-template-columns:1fr;
    }

}


@media(max-width:480px){

    .ed-recommended-card{
        padding:16px;
    }

    .ed-candidate-avatar{
        width:44px;
        height:44px;
        min-width:44px;
    }

    .ed-candidate-info h3{
        font-size:14px;
    }

    .ed-recommended-actions{
        flex-direction:column;
    }

    .ed-profile-btn,
    .ed-invite-btn{
        width:100%;
    }

}
/* =========================================================
   JOB INVITATION MODAL
========================================================= */

.ed-invite-modal-overlay{
    position:fixed;
    inset:0;
    z-index:9999;
    background:rgba(15,17,35,.6);
    backdrop-filter:blur(6px);
    display:none;
    align-items:center;
    justify-content:center;
    padding:20px;
}

.ed-invite-modal-overlay.is-open{
    display:flex;
}

.ed-invite-modal{
    width:min(520px,100%);
    max-height:90vh;
    overflow-y:auto;
    background:#fff;
    border-radius:20px;
    box-shadow:0 30px 80px rgba(15,17,35,.28);
    animation:edInviteModalIn .22s ease;
}

@keyframes edInviteModalIn{
    from{
        opacity:0;
        transform:translateY(10px) scale(.98);
    }

    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

.ed-invite-modal-header{
    padding:22px 24px;
    border-bottom:1px solid var(--ed-line-soft);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
    background:linear-gradient(180deg,#faf9ff,#fff);
}

.ed-invite-modal-heading{
    min-width:0;
}

.ed-invite-modal-title{
    color:var(--ed-ink);
    font-size:17px;
    font-weight:800;
}

.ed-invite-modal-subtitle{
    margin-top:5px;
    color:var(--ed-ink-faint);
    font-size:11.5px;
    line-height:1.5;
}

.ed-invite-modal-subtitle strong{
    color:var(--ed-primary);
}

.ed-invite-modal-close{
    width:32px;
    height:32px;
    min-width:32px;
    border:0;
    border-radius:9px;
    background:var(--ed-line-soft);
    color:#6b7488;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.2s ease;
}

.ed-invite-modal-close:hover{
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
}

.ed-invite-modal-body{
    padding:20px 24px 24px;
}

.ed-job-select-heading{
    color:#59627a;
    font-size:11px;
    font-weight:800;
    letter-spacing:.06em;
    margin-bottom:10px;
}

.ed-job-select-list{
    display:flex;
    flex-direction:column;
    gap:10px;
}

.ed-job-select-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
    padding:14px 15px;
    border:1px solid var(--ed-line);
    border-radius:13px;
    background:#fff;
    transition:.2s ease;
}

.ed-job-select-item:hover{
    border-color:#cfd1f7;
    background:#faf9ff;
}

.ed-job-select-info{
    min-width:0;
    flex:1;
}

.ed-job-select-title{
    color:var(--ed-ink);
    font-size:13.5px;
    font-weight:800;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-job-select-meta{
    margin-top:4px;
    color:var(--ed-ink-faint);
    font-size:10.5px;
    line-height:1.5;
}

.ed-job-select-button{
    flex-shrink:0;
    border:0;
    border-radius:9px;
    padding:9px 14px;
    background:linear-gradient(135deg,var(--ed-primary),var(--ed-primary-2));
    color:#fff;
    font-size:10.5px;
    font-weight:800;
    cursor:pointer;
    transition:.2s ease;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    white-space:nowrap;
    box-shadow:0 6px 14px rgba(67,56,202,.2);
}

.ed-job-select-button:hover{
    transform:translateY(-1px);
    box-shadow:0 10px 18px rgba(67,56,202,.26);
}

.ed-job-select-button.is-invited{
    background:var(--ed-emerald-soft);
    color:#0e9464;
    cursor:not-allowed;
    border:1px solid #c9eadb;
    box-shadow:none;
}

.ed-job-select-button.is-invited:hover{
    background:var(--ed-emerald-soft);
    color:#0e9464;
    transform:none;
}

.ed-job-select-button.is-loading{
    background:#dbe0fb;
    color:#5d6c90;
    box-shadow:none;
    cursor:wait;
}

.ed-job-select-form{
    margin:0;
}

.ed-no-jobs{
    padding:25px 15px;
    text-align:center;
    color:var(--ed-ink-faint);
    font-size:12px;
}

.ed-no-jobs i{
    display:block;
    font-size:25px;
    margin-bottom:9px;
    color:#c1c6dc;
}

.ed-invite-note{
    margin-top:15px;
    padding:12px 13px;
    border-radius:10px;
    background:var(--ed-primary-soft);
    border:1px solid #e2e0ff;
    color:#5f6786;
    font-size:10.5px;
    line-height:1.55;
}

.ed-invite-note i{
    color:var(--ed-primary);
    margin-right:5px;
}


/* =========================================================
   STATS
========================================================= */

.ed-stats{
    margin-top:18px;
    margin-bottom:20px;
}

.ed-stat-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
}

.ed-stat-card{
    position:relative;
    min-height:82px;
    background:var(--ed-surface);
    border:1px solid var(--ed-line);
    border-radius:var(--ed-r-md);
    padding:16px 18px;
    display:flex;
    align-items:center;
    gap:13px;
    box-shadow:var(--ed-shadow-xs);
    transition:.22s ease;
    overflow:hidden;
}

.ed-stat-card::after{
    content:"";
    position:absolute;
    right:-24px;
    bottom:-24px;
    width:80px;
    height:80px;
    border-radius:50%;
    background:radial-gradient(circle,rgba(67,56,202,.06),transparent 70%);
}

.ed-stat-card:hover{
    transform:translateY(-3px);
    box-shadow:var(--ed-shadow-md);
    border-color:#e1e2f6;
}

.ed-stat-icon{
    width:42px;
    height:42px;
    min-width:42px;
    border-radius:11px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:17px;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e2e5ff);
    color:var(--ed-primary);
    z-index:1;
}

.ed-stat-card:nth-child(2) .ed-stat-icon{
    color:var(--ed-emerald);
    background:linear-gradient(135deg,var(--ed-emerald-soft),#d6f3e6);
}

.ed-stat-card:nth-child(3) .ed-stat-icon{
    color:var(--ed-violet);
    background:linear-gradient(135deg,var(--ed-violet-soft),#eae0ff);
}

.ed-stat-card:nth-child(4) .ed-stat-icon{
    color:var(--ed-amber);
    background:linear-gradient(135deg,var(--ed-amber-soft),#fde8c8);
}

.ed-stat-info{
    flex:1;
    min-width:0;
    z-index:1;
}

.ed-stat-number{
    display:block;
    color:var(--ed-ink);
    font-size:22px;
    line-height:1;
    font-weight:800;
    margin-bottom:5px;
    letter-spacing:-.02em;
}

.ed-stat-label{
    display:block;
    color:var(--ed-ink-soft);
    font-size:13px;
    font-weight:600;
}

.ed-stat-link{
    font-size:11px;
    white-space:nowrap;
    color:var(--ed-primary);
    text-decoration:none;
    font-weight:700;
    z-index:1;
}


/* =========================================================
   MAIN GRID
========================================================= */

.ed-main-grid{
    display:grid;
    grid-template-columns:1fr 1fr 1fr;
    gap:14px;
    align-items:start;
    margin-top:14px;
}

.ed-panel{
    background:var(--ed-surface);
    border:1px solid var(--ed-line);
    border-radius:var(--ed-r-md);
    overflow:hidden;
    box-shadow:var(--ed-shadow-xs);
}

.ed-panel-header{
    min-height:52px;
    padding:0 16px;
    border-bottom:1px solid var(--ed-line-soft);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    background:linear-gradient(180deg,#fbfbff,#fff);
}

.ed-panel-title{
    display:flex;
    align-items:center;
    gap:9px;
    color:var(--ed-ink);
    font-size:15px;
    font-weight:800;
}

.ed-panel-title i{
    color:var(--ed-primary);
    font-size:13px;
    width:26px;
    height:26px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border-radius:8px;
    background:var(--ed-primary-soft);
}

.ed-panel-action{
    font-size:11px;
    color:var(--ed-primary);
    text-decoration:none;
    font-weight:700;
}

.ed-panel-action:hover{
    color:var(--ed-primary-dark);
}

.ed-panel-body{
    padding:0;
}

.ed-main-grid>.ed-panel{
    height:324px;
}

.ed-main-grid>.ed-panel .ed-panel-body{
    height:calc(324px - 52px);
    overflow:hidden;
}


/* =========================================================
   PIPELINE
========================================================= */

.ed-pipeline-list{
    height:100%;
    padding:15px 17px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    gap:10px;
}

/* .ed-pipeline-item is an <a> — keep the flex row layout
   and add link / hover affordances. */
.ed-pipeline-item{
    display:flex;
    align-items:center;
    gap:12px;
    text-decoration:none;
    color:inherit;
    cursor:pointer;
    border-radius:10px;
    padding:6px 8px;
    margin:-6px -8px;
    transition:background .18s ease,transform .18s ease;
}

.ed-pipeline-item:hover{
    background:var(--ed-primary-soft);
    transform:translateX(2px);
    text-decoration:none;
    color:inherit;
}

.ed-pipeline-item:hover .ed-pipeline-item-label{
    color:var(--ed-primary);
}

.ed-pipeline-item:hover .ed-pipeline-item-number{
    color:var(--ed-primary);
}

.ed-pipeline-item:focus-visible{
    outline:2px solid #c7c9fb;
    outline-offset:1px;
}

.ed-pipeline-icon{
    width:39px;
    height:39px;
    min-width:39px;
    border-radius:11px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e2e5ff);
    color:var(--ed-primary);
}

.ed-pipeline-item:nth-child(2) .ed-pipeline-icon{
    background:linear-gradient(135deg,var(--ed-emerald-soft),#d6f3e6);
    color:var(--ed-emerald);
}

.ed-pipeline-item:nth-child(3) .ed-pipeline-icon{
    background:linear-gradient(135deg,var(--ed-violet-soft),#eae0ff);
    color:var(--ed-violet);
}

.ed-pipeline-item:nth-child(4) .ed-pipeline-icon{
    background:linear-gradient(135deg,#d7f5ea,var(--ed-emerald-soft));
    color:#059669;
}

.ed-pipeline-body{
    flex:1;
    min-width:0;
}

.ed-pipeline-top{
    display:flex;
    align-items:baseline;
    justify-content:space-between;
    margin-bottom:6px;
}

.ed-pipeline-item-label{
    color:var(--ed-ink-soft);
    font-size:11.5px;
    font-weight:700;
    transition:color .18s ease;
}

.ed-pipeline-item-number{
    color:var(--ed-ink);
    font-size:16px;
    font-weight:800;
    transition:color .18s ease;
}

.ed-pipeline-track{
    height:7px;
    border-radius:999px;
    background:var(--ed-line-soft);
    overflow:hidden;
}

.ed-pipeline-fill{
    height:100%;
    border-radius:999px;
    background:linear-gradient(90deg,var(--ed-primary),var(--ed-primary-2));
    transition:width 1s cubic-bezier(.22,1,.36,1);
}

.ed-pipeline-item:nth-child(2) .ed-pipeline-fill{
    background:linear-gradient(90deg,var(--ed-emerald),#34d399);
}

.ed-pipeline-item:nth-child(3) .ed-pipeline-fill{
    background:linear-gradient(90deg,var(--ed-violet),#a683f7);
}

.ed-pipeline-item:nth-child(4) .ed-pipeline-fill{
    background:linear-gradient(90deg,#059669,#2fc79a);
}


/* =========================================================
   JOB / APPLICANT ROWS
========================================================= */

.ed-job-row{
    min-height:68px;
    padding:11px 14px;
    display:flex;
    align-items:center;
    gap:11px;
    border-bottom:1px solid var(--ed-line-soft);
    transition:background .18s ease;
}

.ed-job-row:hover{
    background:#fbfbff;
}

.ed-job-row:last-child{
    border-bottom:0;
}

.ed-job-icon{
    width:30px;
    height:30px;
    min-width:30px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e2e5ff);
    color:var(--ed-primary);
    font-size:12px;
}

.ed-job-info{
    flex:1;
    min-width:0;
}

.ed-job-title{
    color:#2c3450;
    font-size:13px;
    font-weight:700;
    margin-bottom:4px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-job-meta{
    color:var(--ed-ink-faint);
    font-size:11px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-job-side{
    text-align:right;
}

.ed-status{
    display:inline-flex;
    align-items:center;
    gap:4px;
    font-size:11px;
    font-weight:700;
    color:var(--ed-emerald);
    margin-bottom:4px;
}

.ed-status::before{
    content:"";
    width:5px;
    height:5px;
    border-radius:50%;
    background:currentColor;
}

.ed-small-link{
    display:block;
    font-size:10px;
    color:var(--ed-primary);
    text-decoration:none;
    font-weight:700;
}

.ed-avatar{
    width:37px;
    height:37px;
    min-width:37px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e2e5ff);
    color:var(--ed-primary);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
    font-weight:800;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.ed-empty{
    min-height:200px;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:25px;
}

.ed-empty-icon{
    width:46px;
    height:46px;
    border-radius:12px;
    background:var(--ed-line-soft);
    color:#a6adc4;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 10px;
    font-size:17px;
}

.ed-empty strong{
    display:block;
    color:#4a5268;
    font-size:12px;
    margin-bottom:5px;
}

.ed-empty span{
    color:var(--ed-ink-faint);
    font-size:11px;
}


/* =========================================================
   HIRING ACTIVITY
========================================================= */

.ed-activity{
    margin-top:14px;
}

.ed-activity-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:14px;
}

.ed-activity-grid .ed-panel{
    overflow:visible;
}

@keyframes edPulseDot{
    0%{
        box-shadow:0 0 0 0 rgba(225,29,94,.45);
    }

    70%{
        box-shadow:0 0 0 7px rgba(225,29,94,0);
    }

    100%{
        box-shadow:0 0 0 0 rgba(225,29,94,0);
    }
}

@keyframes edFadeUp{
    from{
        opacity:0;
        transform:translateY(6px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes edFloatBtn{
    0%,100%{
        transform:translateX(0);
    }

    50%{
        transform:translateX(3px);
    }
}


/* =========================================================
   UPCOMING INTERVIEWS
========================================================= */

.ed-interview-list{
    padding:6px 0;
    max-height:420px;
    overflow-y:auto;
}

.ed-interview-row{
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 17px;
    border-bottom:1px solid var(--ed-line-soft);
    transition:background .2s ease,transform .2s ease;
    animation:edFadeUp .35s ease both;
}

.ed-interview-row:last-child{
    border-bottom:0;
}

.ed-interview-row:hover{
    background:#fbfbff;
    transform:translateX(2px);
}

.ed-interview-avatar{
    width:41px;
    height:41px;
    min-width:41px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--ed-primary-soft),#dbdeff);
    color:var(--ed-primary-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
    font-weight:800;
}

.ed-interview-info{
    flex:1;
    min-width:0;
}

.ed-interview-name{
    color:var(--ed-ink);
    font-size:13px;
    font-weight:800;
    margin-bottom:2px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-interview-role{
    color:var(--ed-ink-faint);
    font-size:11px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-interview-when{
    text-align:right;
    display:flex;
    flex-direction:column;
    align-items:flex-end;
    gap:5px;
}

.ed-interview-badge{
    display:inline-flex;
    align-items:center;
    gap:5px;
    padding:5px 11px;
    border-radius:999px;
    font-size:10px;
    font-weight:800;
    letter-spacing:.02em;
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
    white-space:nowrap;
}

.ed-interview-badge.is-today{
    background:var(--ed-rose-soft);
    color:var(--ed-rose);
}

.ed-interview-badge.is-today::before{
    content:"";
    width:6px;
    height:6px;
    border-radius:50%;
    background:var(--ed-rose);
    animation:edPulseDot 1.6s infinite;
}

.ed-interview-actions{
    display:flex;
    gap:9px;
}

.ed-interview-actions a,
.ed-interview-actions button{
    font-size:10px;
    font-weight:700;
    text-decoration:none;
    border:0;
    background:none;
    cursor:pointer;
    padding:0;
}

.ed-interview-view{
    color:var(--ed-primary);
}

.ed-interview-cancel{
    color:var(--ed-rose);
}


/* =========================================================
   INVITE CANDIDATES
========================================================= */

.ed-invite-list{
    padding:13px 17px;
    display:flex;
    flex-direction:column;
    gap:10px;
    max-height:420px;
    overflow-y:auto;
}

.ed-invite-card{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 14px;
    border:1px solid var(--ed-line);
    border-radius:13px;
    background:#fff;
    transition:border-color .25s ease,box-shadow .25s ease,transform .25s ease;
    animation:edFadeUp .35s ease both;
}

.ed-invite-card:hover{
    border-color:#cfd1f7;
    box-shadow:0 12px 26px rgba(67,56,202,.10);
    transform:translateY(-2px);
}

.ed-invite-avatar{
    width:39px;
    height:39px;
    min-width:39px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--ed-primary-soft),#dbdeff);
    color:var(--ed-primary-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:14px;
    font-weight:800;
}

.ed-invite-info{
    flex:1;
    min-width:0;
}

.ed-invite-name{
    color:#232c47;
    font-size:12.5px;
    font-weight:800;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-invite-role{
    color:var(--ed-ink-faint);
    font-size:10.5px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-invite-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:6px;
    padding:8px 14px;
    border-radius:9px;
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
    font-size:10.5px;
    font-weight:800;
    text-decoration:none;
    border:1px solid transparent;
    cursor:pointer;
    transition:.22s ease;
    white-space:nowrap;
}

.ed-invite-btn i{
    transition:transform .25s ease;
}

.ed-invite-btn:hover{
    background:linear-gradient(135deg,var(--ed-primary),var(--ed-primary-2));
    color:#fff;
    box-shadow:0 10px 20px rgba(67,56,202,.28);
}

.ed-invite-btn:hover i{
    animation:edFloatBtn .6s ease infinite;
}

.ed-invite-form{
    margin:0;
}


/* =========================================================
   ARTICLES
========================================================= */

.ed-articles{
    margin-top:18px;
    margin-bottom:4px;
}

.ed-article-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:16px;
    padding:16px;
}

.ed-article-card{
    position:relative;
    min-height:340px;
    border:1px solid var(--ed-line);
    border-radius:16px;
    overflow:hidden;
    background:#fff;
    box-shadow:var(--ed-shadow-xs);
    transition:transform .25s ease,box-shadow .25s ease;
    display:flex;
    flex-direction:column;
}

.ed-article-card:hover{
    transform:translateY(-4px);
    box-shadow:var(--ed-shadow-lg);
    border-color:#dcdcff;
}

.ed-article-image{
    position:relative;
    height:170px;
    overflow:hidden;
    background:linear-gradient(135deg,var(--ed-primary-soft),#e2e5ff);
}

.ed-article-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    transition:transform .45s ease;
}

.ed-article-card:hover .ed-article-image img{
    transform:scale(1.08);
}

.ed-article-image-fallback{
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--ed-primary);
    opacity:.55;
    font-size:30px;
}

.ed-article-badge{
    position:absolute;
    top:12px;
    left:12px;
    padding:5px 12px;
    border-radius:999px;
    background:rgba(21,17,50,.55);
    backdrop-filter:blur(6px);
    color:#fff;
    font-size:9.5px;
    font-weight:800;
    letter-spacing:.06em;
    text-transform:uppercase;
}

.ed-article-content{
    padding:17px 17px 15px;
    display:flex;
    flex-direction:column;
    flex:1;
}

.ed-article-content h3{
    margin:0 0 8px;
    color:var(--ed-ink);
    font-size:14.5px;
    font-weight:800;
    line-height:1.35;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.ed-article-content p{
    margin:0;
    color:var(--ed-ink-soft);
    font-size:11.5px;
    line-height:1.6;
    flex:1;
}

.ed-article-footer{
    margin-top:13px;
    padding-top:12px;
    border-top:1px solid var(--ed-line-soft);
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:8px;
}

.ed-article-author{
    display:flex;
    align-items:center;
    gap:7px;
    min-width:0;
}

.ed-article-author-avatar{
    width:23px;
    height:23px;
    min-width:23px;
    border-radius:50%;
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:10px;
    font-weight:800;
}

.ed-article-meta{
    color:var(--ed-ink-faint);
    font-size:10px;
    font-weight:600;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.ed-article-actions{
    display:flex;
    gap:6px;
    align-items:center;
}

.ed-like-form{
    margin:0;
}

.ed-like-button,
.ed-comment-button{
    border:0;
    background:var(--ed-line-soft);
    padding:6px 10px;
    border-radius:20px;
    cursor:pointer;
    color:#79839a;
    font-size:11px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:4px;
    transition:.2s ease;
    text-decoration:none;
}

.ed-like-button:hover,
.ed-comment-button:hover{
    background:var(--ed-primary-soft);
    color:var(--ed-primary);
}

.ed-like-button.liked{
    color:var(--ed-rose);
    background:var(--ed-rose-soft);
}

.ed-read-more{
    color:var(--ed-primary);
    text-decoration:none;
    font-size:11px;
    font-weight:800;
    white-space:nowrap;
    cursor:pointer;
}

.ed-read-more:hover{
    color:var(--ed-primary-dark);
}


/* =========================================================
   LIKE LOADING
========================================================= */

.ed-like-button.is-loading{
    opacity:.55;
    pointer-events:none;
}

.ed-like-button .like-spinner{
    display:none;
}

.ed-like-button.is-loading .like-heart{
    display:none;
}

.ed-like-button.is-loading .like-spinner{
    display:inline-block;
}


/* =========================================================
   FINAL CTA
========================================================= */

.ed-final-cta{
    position:relative;
    margin-top:16px;
    background:linear-gradient(120deg,var(--ed-primary-dark) 0%,var(--ed-primary) 45%,var(--ed-primary-2) 100%);
    border-radius:var(--ed-r-lg);
    padding:28px 30px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    color:#fff;
    box-shadow:0 18px 40px rgba(67,56,202,.28);
    overflow:hidden;
}

.ed-final-cta::before{
    content:"";
    position:absolute;
    inset:0;
    background-image:radial-gradient(320px 200px at 90% 0%,rgba(255,255,255,.16),transparent 60%);
    pointer-events:none;
}

.ed-final-cta h2{
    margin:0 0 6px;
    font-family:inherit;
    font-size:23px;
    font-weight:800;
    letter-spacing:-.01em;
}

.ed-final-cta p{
    margin:0;
    font-size:12px;
    color:rgba(255,255,255,.85);
}

.ed-final-cta .ed-btn{
    background:#fff;
    color:var(--ed-primary);
    white-space:nowrap;
    box-shadow:0 10px 22px rgba(15,17,35,.18);
}

.ed-final-cta .ed-btn:hover{
    background:#fff;
    color:var(--ed-primary-dark);
    transform:translateY(-2px);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width:1050px){

    .ed-main-grid{
        grid-template-columns:1fr 1fr;
    }

    .ed-main-grid>.ed-panel:nth-child(3){
        grid-column:span 2;
        height:260px;
    }

    .ed-main-grid>.ed-panel:nth-child(3) .ed-panel-body{
        height:calc(260px - 52px);
    }

    .ed-activity-grid{
        grid-template-columns:1fr;
    }

    .ed-hero-inner{
        width:min(100% - 40px,1000px);
        gap:25px;
    }

    .ed-hero h1{
        font-size:42px;
    }

    .ed-hero-image{
        max-width:400px;
    }

    .ed-feature-verified{
        left:0;
    }

    .ed-feature-hiring{
        left:-5px;
    }

    .ed-feature-matching{
        right:0;
    }
}

@media (max-width:800px){

    .ed-container{
        width:min(100% - 24px,700px);
    }

    .ed-hero-inner{
        width:min(100% - 30px,700px);
        grid-template-columns:1fr;
        padding:38px 0 35px;
        gap:20px;
    }

    .ed-hero-content{
        align-items:flex-start;
    }

    .ed-hero h1{
        font-size:38px;
    }

    .ed-hero-description{
        font-size:14px;
        max-width:600px;
    }

    .ed-hero-visual{
        min-height:300px;
    }

    .ed-hero-image{
        max-width:410px;
    }

    .ed-feature-verified{
        top:15px;
        left:2%;
    }

    .ed-feature-matching{
        top:85px;
        right:2%;
    }

    .ed-feature-hiring{
        bottom:12px;
        left:4%;
    }

    .ed-stat-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .ed-main-grid{
        grid-template-columns:1fr;
    }

    .ed-main-grid>.ed-panel:nth-child(3){
        grid-column:auto;
    }

    .ed-main-grid>.ed-panel{
        height:auto;
    }

    .ed-main-grid>.ed-panel .ed-panel-body{
        height:auto;
        overflow:visible;
    }

    .ed-pipeline-list{
        gap:16px;
    }

    .ed-article-grid{
        grid-template-columns:1fr;
    }
}

@media (max-width:575px){

    .ed-hero-inner{
        width:calc(100% - 24px);
        padding:32px 0 28px;
    }

    .ed-hero h1{
        font-size:33px;
        letter-spacing:-.025em;
    }

    .ed-hero-description{
        font-size:13px;
        line-height:1.65;
        margin:14px 0 21px;
    }

    .ed-hero-buttons{
        width:100%;
    }

    .ed-hero-buttons .ed-btn{
        flex:1;
        min-width:0;
        padding:0 15px;
    }

    .ed-hero-visual{
        min-height:245px;
    }

    .ed-hero-image{
        max-width:340px;
    }

    .ed-hero-feature{
        padding:7px 9px;
        gap:7px;
        border-radius:10px;
    }

    .ed-hero-feature-icon{
        width:27px;
        height:27px;
        min-width:27px;
    }

    .ed-hero-feature-title{
        font-size:9px;
    }

    .ed-hero-feature-subtitle{
        font-size:7.5px;
    }

    .ed-feature-verified{
        top:7px;
        left:0;
    }

    .ed-feature-matching{
        top:66px;
        right:0;
    }

    .ed-feature-hiring{
        bottom:4px;
        left:0;
    }

    .ed-stat-grid{
        grid-template-columns:1fr;
    }

    .ed-final-cta{
        flex-direction:column;
        align-items:flex-start;
    }

    .ed-article-footer{
        align-items:flex-start;
        flex-direction:column;
    }

    .ed-article-actions{
        width:100%;
        justify-content:flex-end;
    }

    .ed-invite-modal{
        border-radius:13px;
    }

    .ed-invite-modal-header{
        padding:17px;
    }

    .ed-invite-modal-body{
        padding:17px;
    }

    .ed-job-select-item{
        align-items:flex-start;
        flex-direction:column;
    }

    .ed-job-select-button,
    .ed-job-select-form{
        width:100%;
    }

    .ed-job-select-button{
        justify-content:center;
    }
}

</style>


<div class="employer-dashboard">


{{-- =========================================================
     HERO
========================================================= --}}

<section class="ed-hero">

    <div class="ed-hero-inner">

        <div class="ed-hero-content">

            <div class="ed-eyebrow">
                GROW YOUR TEAM
            </div>

            <h1>
                Find the Right Talent,
                <span>Build Your Team</span>
            </h1>

            <p class="ed-hero-description">
                Post jobs, review applications, and hire skilled professionals
                who are ready to grow with your company.
            </p>

            <div class="ed-hero-buttons">

                <a href="{{ route('employer.jobs.create') }}" class="ed-btn ed-btn-primary">
                    <span style="font-size:18px;line-height:1;">＋</span>
                    Create Job
                </a>

                <a href="{{ route('employer.applicants.index') }}" class="ed-btn ed-btn-light">
                    Browse Talent
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>


        <div class="ed-hero-visual">

            <img
                src="{{ asset('assets/img/ccc.png') }}"
                alt="Employer hiring and recruitment"
                class="ed-hero-image"
                onerror="this.style.display='none'"
            >

            <div class="ed-hero-feature ed-feature-verified">

                <div class="ed-hero-feature-icon">
                    ✓
                </div>

                <div class="ed-hero-feature-text">

                    <div class="ed-hero-feature-title">
                        Verified Candidates
                    </div>

                    <div class="ed-hero-feature-subtitle">
                        Genuine professional profiles
                    </div>

                </div>

            </div>


            <div class="ed-hero-feature ed-feature-matching">

                <div class="ed-hero-feature-icon">
                    ◈
                </div>

                <div class="ed-hero-feature-text">

                    <div class="ed-hero-feature-title">
                        Smart Matching
                    </div>

                    <div class="ed-hero-feature-subtitle">
                        Find relevant talent faster
                    </div>

                </div>

            </div>


            <div class="ed-hero-feature ed-feature-hiring">

                <div class="ed-hero-feature-icon">
                    ⚡
                </div>

                <div class="ed-hero-feature-text">

                    <div class="ed-hero-feature-title">
                        Faster Hiring
                    </div>

                    <div class="ed-hero-feature-subtitle">
                        Connect with talent quickly
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     STATISTICS
========================================================= --}}

<section class="ed-stats">

    <div class="ed-container">

        <div class="ed-stat-grid">

            {{-- ACTIVE JOBS --}}
            <div class="ed-stat-card">

                <div class="ed-stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>

                <div class="ed-stat-info">

                    <span class="ed-stat-number">
                        {{ $jobsCount ?? 0 }}
                    </span>

                    <span class="ed-stat-label">
                        Active Jobs
                    </span>

                </div>

                <a href="{{ route('employer.jobs.index') }}" class="ed-stat-link">
                    View Jobs →
                </a>

            </div>


            {{-- APPLICANTS --}}
            <div class="ed-stat-card">

                <div class="ed-stat-icon">
                    <i class="fas fa-user-friends"></i>
                </div>

                <div class="ed-stat-info">

                    <span class="ed-stat-number">
                        {{ $applicationsCount ?? 0 }}
                    </span>

                    <span class="ed-stat-label">
                        Total Applicants
                    </span>

                </div>

                <a href="{{ route('employer.applicants.index') }}" class="ed-stat-link">
                    View Applicants →
                </a>

            </div>


            {{-- INTERNSHIPS --}}
            <div class="ed-stat-card">

                <div class="ed-stat-icon">
                    <i class="fas fa-building"></i>
                </div>

                <div class="ed-stat-info">

                    <span class="ed-stat-number">
                        {{ $internshipsCount ?? 0 }}
                    </span>

                    <span class="ed-stat-label">
                        Internships
                    </span>

                </div>

                <a href="{{ route('employer.internships.index') }}" class="ed-stat-link">
                    View Internships →
                </a>

            </div>


            {{-- PROJECTS --}}
            <div class="ed-stat-card">

                <div class="ed-stat-icon">
                    <i class="fas fa-code"></i>
                </div>

                <div class="ed-stat-info">

                    <span class="ed-stat-number">
                        {{ $projectsCount ?? 0 }}
                    </span>

                    <span class="ed-stat-label">
                        Projects
                    </span>

                </div>

                <a href="{{ route('employer.projects.index') }}" class="ed-stat-link">
                    View Projects →
                </a>

            </div>

        </div>

    </div>

</section>


<div class="ed-container">


{{-- =========================================================
     LATEST ARTICLES
========================================================= --}}

<section class="ed-panel ed-articles">

    <div class="ed-panel-header">

        <div class="ed-panel-title">
            <i class="fas fa-newspaper"></i>
            Latest Articles
        </div>

        <a href="{{ route('employer.articles.index') }}" class="ed-panel-action">
            View All →
        </a>

    </div>


    @if(($latestArticles ?? collect())->count())

        <div class="ed-article-grid">

            @foreach($latestArticles->take(3) as $article)

                @php

                    $articleImage = $article->image ?? '';

                    $authorName =
                        optional($article->author ?? null)->name
                        ?? 'Admin';

                    $articleDescription =
                        $article->body
                        ?? $article->content
                        ?? $article->description
                        ?? '';

                    $articleLikeCount =
                        $articleLikeCounts[$article->id]
                        ?? $article->likes_count
                        ?? 0;

                    $articleCommentCount =
                        $article->comments_count
                        ?? 0;

                    $isArticleLiked =
                        in_array(
                            $article->id,
                            $likedArticleIds ?? []
                        );

                @endphp


                <article
                    class="ed-article-card"
                    data-article-id="{{ $article->id }}"
                >

                    <div class="ed-article-image">

                        @if(!empty($articleImage))

                            <img
                                src="{{ $articleImage }}"
                                alt="{{ $article->title }}"
                                loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >

                            <div
                                class="ed-article-image-fallback"
                                style="display:none;"
                            >
                                <i class="fas fa-newspaper"></i>
                            </div>

                        @else

                            <div class="ed-article-image-fallback">
                                <i class="fas fa-newspaper"></i>
                            </div>

                        @endif

                        <span class="ed-article-badge">
                            Article
                        </span>

                    </div>


                    <div class="ed-article-content">

                        <h3>
                            {{ $article->title }}
                        </h3>

                        <p>
                            {{
                                \Illuminate\Support\Str::limit(
                                    strip_tags($articleDescription),
                                    90
                                )
                            }}
                        </p>


                        <div class="ed-article-footer">

                            <div class="ed-article-author">

                                <div class="ed-article-author-avatar">
                                    {{ strtoupper(substr($authorName, 0, 1)) }}
                                </div>

                                <span class="ed-article-meta">

                                    {{
                                        optional($article->published_at)
                                            ->format('d M Y')
                                    }}

                                </span>

                            </div>


                            <div class="ed-article-actions">

                                <form
                                    method="POST"
                                    action="{{ route('employer.articles.like', $article) }}"
                                    class="ed-like-form"
                                    data-like-url="{{ route('employer.articles.like', $article) }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="ed-like-button {{ $isArticleLiked ? 'liked' : '' }}"
                                        data-article-id="{{ $article->id }}"
                                        data-liked="{{ $isArticleLiked ? '1' : '0' }}"
                                        aria-label="Like article"
                                    >

                                        <i class="fas fa-spinner fa-spin like-spinner"></i>

                                        <i class="fas fa-heart like-heart"></i>

                                        <span class="like-count">
                                            {{ $articleLikeCount }}
                                        </span>

                                    </button>

                                </form>


                                <a href="{{ route('employer.articles.index', ['article' => $article->id]) }}" class="ed-comment-button" title="View comments">

                                    <i class="far fa-comment"></i>

                                    <span class="comment-count">
                                        {{ $articleCommentCount }}
                                    </span>

                                </a>


                                <a href="{{ route('employer.articles.index', ['article' => $article->id]) }}" class="ed-read-more">
                                    Read More
                                </a>

                            </div>

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    @else

        <div class="ed-empty" style="min-height:150px;">

            <div>

                <div class="ed-empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>

                <strong>
                    No articles available
                </strong>

                <span>
                    Latest articles will appear here.
                </span>

            </div>

        </div>

    @endif

</section>


{{-- =========================================================
     MAIN GRID
========================================================= --}}

<div class="ed-main-grid">


{{-- =====================================================
     RECENT JOBS
===================================================== --}}

<div class="ed-panel">

    <div class="ed-panel-header">

        <div class="ed-panel-title">
            <i class="fas fa-briefcase"></i>
            Recent Jobs
        </div>

        <a href="{{ route('employer.jobs.index') }}" class="ed-panel-action">
            View All →
        </a>

    </div>


    <div class="ed-panel-body">

        @forelse($latestJobs ?? collect() as $job)

            <div class="ed-job-row">

                <div class="ed-job-icon">
                    <i class="fas fa-briefcase"></i>
                </div>


                <div class="ed-job-info">

                    <div class="ed-job-title">
                        {{ $job->title ?? 'Job Post' }}
                    </div>

                    <div class="ed-job-meta">

                        {{ $job->employment_type ?? 'Full-time' }}

                        @if(!empty($job->location))
                            · {{ $job->location }}
                        @endif

                        @if(!empty($job->created_at))
                            · {{ $job->created_at->diffForHumans() }}
                        @endif

                    </div>

                </div>


                <div class="ed-job-side">

                    @if((int) ($job->is_active ?? 0) === 1)

                        <div class="ed-status">
                            Active
                        </div>

                    @else

                        <div
                            class="ed-status"
                            style="color:#f59e0b;"
                        >
                            Pending
                        </div>

                    @endif


                    <a href="{{ route('employer.jobs.show', $job) }}" class="ed-small-link">
                        View Job →
                    </a>

                </div>

            </div>

        @empty

            <div
                class="ed-empty"
                style="min-height:267px;"
            >

                <div>

                    <div class="ed-empty-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>

                    <strong>
                        No jobs posted yet
                    </strong>

                    <span>
                        Create your first job to attract talent.
                    </span>

                </div>

            </div>

        @endforelse

    </div>

</div>


{{-- =====================================================
     RECENT APPLICANTS
===================================================== --}}

<div class="ed-panel">

    <div class="ed-panel-header">

        <div class="ed-panel-title">
            <i class="fas fa-users"></i>
            Recent Applicants
        </div>

        <a href="{{ route('employer.applicants.index') }}" class="ed-panel-action">
            View All →
        </a>

    </div>


    @if(($recentApplicants ?? collect())->count() > 0)

        <div class="ed-panel-body">

            @foreach($recentApplicants->take(4) as $applicant)

                @php

                    $applicantName =
                        optional($applicant->user)->name
                        ?? 'Applicant';

                @endphp


                <div class="ed-job-row">

                    <div class="ed-avatar">
                        {{ strtoupper(substr($applicantName, 0, 1)) }}
                    </div>


                    <div class="ed-job-info">

                        <div class="ed-job-title">
                            {{ $applicantName }}
                        </div>

                        <div class="ed-job-meta">

                            {{
                                \Illuminate\Support\Str::title(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $applicant->status ?? 'applied'
                                    )
                                )
                            }}

                        </div>

                    </div>


                    <div class="ed-job-side">

                        <a href="{{ route('employer.applicants.index') }}" class="ed-small-link">
                            View
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div
            class="ed-empty"
            style="min-height:267px;"
        >

            <div>

                <div class="ed-empty-icon">
                    <i class="fas fa-user-friends"></i>
                </div>

                <strong>
                    No recent applicants
                </strong>

                <span>
                    New job applications will appear here.
                </span>

            </div>

        </div>

    @endif

</div>


{{-- =====================================================
     HIRING PIPELINE  (each row links to filtered applicants)
===================================================== --}}

<div class="ed-panel">

    <div class="ed-panel-header">

        <div class="ed-panel-title">
            <i class="fas fa-arrow-right"></i>
            Hiring Pipeline
        </div>

        <a href="{{ route('employer.applicants.index') }}" class="ed-panel-action">
            View Details →
        </a>

    </div>


    <div class="ed-panel-body">

        @php

            $edPipelineTotal = max(
                (
                    ($newApplicantsCount ?? 0)
                    + ($shortlistedCount ?? 0)
                    + ($interviewsCount ?? 0)
                    + ($hiredCount ?? 0)
                ),
                1
            );

        @endphp


        <div class="ed-pipeline-list">

            {{-- NEW APPLICATIONS --}}

            <a href="{{ route('employer.applicants.index', ['status' => 'applied']) }}" class="ed-pipeline-item" title="View new applications">

                <div class="ed-pipeline-icon">
                    <i class="fas fa-inbox"></i>
                </div>

                <div class="ed-pipeline-body">

                    <div class="ed-pipeline-top">

                        <span class="ed-pipeline-item-label">
                            New Applications
                        </span>

                        <span class="ed-pipeline-item-number">
                            {{ $newApplicantsCount ?? 0 }}
                        </span>

                    </div>

                    <div class="ed-pipeline-track">

                        <div
                            class="ed-pipeline-fill"
                            style="width:{{ round((($newApplicantsCount ?? 0) / $edPipelineTotal) * 100) }}%"
                        ></div>

                    </div>

                </div>

            </a>


            {{-- SHORTLISTED --}}

            <a href="{{ route('employer.applicants.index', ['status' => 'shortlisted']) }}" class="ed-pipeline-item" title="View shortlisted applicants">

                <div class="ed-pipeline-icon">
                    <i class="fas fa-star"></i>
                </div>

                <div class="ed-pipeline-body">

                    <div class="ed-pipeline-top">

                        <span class="ed-pipeline-item-label">
                            Shortlisted
                        </span>

                        <span class="ed-pipeline-item-number">
                            {{ $shortlistedCount ?? 0 }}
                        </span>

                    </div>

                    <div class="ed-pipeline-track">

                        <div
                            class="ed-pipeline-fill"
                            style="width:{{ round((($shortlistedCount ?? 0) / $edPipelineTotal) * 100) }}%"
                        ></div>

                    </div>

                </div>

            </a>


            {{-- INTERVIEWS --}}

            <a href="{{ route('employer.applicants.index', ['status' => 'interview']) }}" class="ed-pipeline-item" title="View applicants in interview stage">

                <div class="ed-pipeline-icon">
                    <i class="fas fa-comments"></i>
                </div>

                <div class="ed-pipeline-body">

                    <div class="ed-pipeline-top">

                        <span class="ed-pipeline-item-label">
                            Interviews
                        </span>

                        <span class="ed-pipeline-item-number">
                            {{ $interviewsCount ?? 0 }}
                        </span>

                    </div>

                    <div class="ed-pipeline-track">

                        <div
                            class="ed-pipeline-fill"
                            style="width:{{ round((($interviewsCount ?? 0) / $edPipelineTotal) * 100) }}%"
                        ></div>

                    </div>

                </div>

            </a>


            {{-- SELECTED --}}

            <a href="{{ route('employer.applicants.index', ['status' => 'hired']) }}" class="ed-pipeline-item" title="View selected candidates">

                <div class="ed-pipeline-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

                <div class="ed-pipeline-body">

                    <div class="ed-pipeline-top">

                        <span class="ed-pipeline-item-label">
                            Selected
                        </span>

                        <span class="ed-pipeline-item-number">
                            {{ $hiredCount ?? 0 }}
                        </span>

                    </div>

                    <div class="ed-pipeline-track">

                        <div
                            class="ed-pipeline-fill"
                            style="width:{{ round((($hiredCount ?? 0) / $edPipelineTotal) * 100) }}%"
                        ></div>

                    </div>

                </div>

            </a>

        </div>

    </div>

</div>

</div>
{{-- END MAIN GRID --}}


{{-- =========================================================
     RECOMMENDED CANDIDATES
========================================================= --}}

<section class="ed-section ed-recommended-section">

    <div class="ed-section-head">

        <div>
            <span class="ed-section-kicker">
                TALENT MATCH
            </span>

            <h2>
                Recommended Candidates
            </h2>

            <p>
                Candidates matching your recent job postings
            </p>
        </div>

        <a href="{{ route('employer.applicants.index') }}" class="ed-view-all">
            View Candidates
            <i class="fa-solid fa-arrow-right"></i>
        </a>

    </div>


    @if(($recommendedCandidates ?? collect())->count())

        <div class="ed-recommended-grid">

            @foreach($recommendedCandidates as $candidate)

                @php

                    $name = $candidate->name
                        ?? 'Candidate';

                    $initials = collect(
                        preg_split(
                            '/\s+/',
                            trim($name)
                        )
                    )
                    ->filter()
                    ->take(2)
                    ->map(
                        fn($word) => strtoupper(
                            substr($word, 0, 1)
                        )
                    )
                    ->implode('');

                    $score = $candidate->recommendation_score ?? 0;

                    $registration =
                        $candidate->employeeRegistration;

                    $designation =
                        $registration->designation
                        ?? $registration->job_title
                        ?? $registration->current_position
                        ?? 'Job Seeker';

                    $skills =
                        $registration->skills
                        ?? $registration->skill
                        ?? '';

                    if (is_string($skills)) {
                        $skillsArray = preg_split(
                            '/[,|;\n]+/',
                            $skills
                        );
                    } else {
                        $skillsArray = is_array($skills)
                            ? $skills
                            : [];
                    }

                    $skillsArray = collect($skillsArray)
                        ->filter()
                        ->map(
                            fn($skill) => trim($skill)
                        )
                        ->take(3)
                        ->values();

                @endphp


                <div class="ed-recommended-card">

                    <div class="ed-recommended-top">

                        <div class="ed-candidate-avatar">

                            @if(!empty($candidate->profile_image))

                                <img
                                    src="{{ asset('storage/' . $candidate->profile_image) }}"
                                    alt="{{ $name }}"
                                >

                            @else

                                {{ $initials ?: 'C' }}

                            @endif

                        </div>


                        <div class="ed-candidate-info">

                            <h3>
                                {{ $name }}
                            </h3>

                            <p>
                                {{ $designation }}
                            </p>

                        </div>


                        <div class="ed-match-score">

                            <strong>
                                {{ $score }}%
                            </strong>

                            <span>
                                Match
                            </span>

                        </div>

                    </div>


                    {{-- MATCH REASONS --}}

                    @if(!empty($candidate->recommendation_reasons))

                        <div class="ed-match-reasons">

                            @foreach(
                                array_slice(
                                    $candidate->recommendation_reasons,
                                    0,
                                    3
                                )
                                as $reason
                            )

                                <span>
                                    <i class="fa-solid fa-check"></i>
                                    {{ $reason }}
                                </span>

                            @endforeach

                        </div>

                    @endif


                    {{-- SKILLS --}}

                    @if($skillsArray->count())

                        <div class="ed-candidate-skills">

                            @foreach($skillsArray as $skill)

                                <span>
                                    {{ $skill }}
                                </span>

                            @endforeach

                        </div>

                    @endif


                    <div class="ed-recommended-actions">

                        <a href="{{ route('employer.applicants.show', $candidate->id) }}" class="ed-profile-btn">
                            View Profile
                        </a>


                        @php
                            $candidateId = $candidate->id;

                            $isInvited = isset(
                                $invitedCandidateJobIds[$candidateId]
                            );
                        @endphp


                        <button
                            type="button"
                            class="ed-invite-btn js-open-invite-modal"
                            data-candidate-id="{{ $candidate->id }}"
                            data-candidate-name="{{ $name }}"
                        >
                            <i class="fa-regular fa-paper-plane"></i>
                            Invite
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="ed-empty-recommendations">

            <div class="ed-empty-icon">
                <i class="fa-solid fa-user-group"></i>
            </div>

            <h3>
                No recommendations yet
            </h3>

            <p>
                Post an active job to start finding candidates
                who match your requirements.
            </p>

            <a href="{{ route('employer.jobs.create') }}" class="ed-primary-btn">
                <i class="fa-solid fa-plus"></i>
                Create Job
            </a>

        </div>

    @endif

</section>


{{-- =========================================================
     UPCOMING INTERVIEWS + INVITE CANDIDATES
========================================================= --}}

<section class="ed-activity">

    <div class="ed-activity-grid">


        {{-- =================================================
             UPCOMING INTERVIEWS
        ================================================= --}}

        <div class="ed-panel">

            <div class="ed-panel-header">

                <div class="ed-panel-title">

                    <i class="fas fa-calendar-check"></i>

                    Upcoming Interviews

                </div>

                <a href="{{ route('employer.applicants.index', ['status' => 'interview']) }}" class="ed-panel-action">
                    View All →
                </a>

            </div>


            @if(($upcomingInterviews ?? collect())->count())

                <div class="ed-interview-list">

                    @foreach($upcomingInterviews as $i => $interview)

                        @php

                            $icApplication =
                                $interview->application
                                ?? null;

                            $icName =
                                optional(
                                    optional($icApplication)->user
                                )->name
                                ?? 'Candidate';

                            $icJob =
                                optional(
                                    optional($icApplication)->jobPost
                                )->title
                                ?? 'Open Role';

                            $icDate =
                                $interview->scheduled_at
                                ?? null;

                            $icIsToday =
                                $icDate &&
                                \Illuminate\Support\Carbon::parse($icDate)->isToday();

                        @endphp


                        <div
                            class="ed-interview-row"
                            style="animation-delay:{{ $i * 60 }}ms"
                        >

                            <div class="ed-interview-avatar">

                                {{ strtoupper(substr($icName, 0, 1)) }}

                            </div>


                            <div class="ed-interview-info">

                                <div class="ed-interview-name">
                                    {{ $icName }}
                                </div>

                                <div class="ed-interview-role">
                                    {{ $icJob }}
                                </div>

                            </div>


                            <div class="ed-interview-when">

                                <span
                                    class="ed-interview-badge {{ $icIsToday ? 'is-today' : '' }}"
                                >

                                    {{
                                        $icDate
                                            ? \Illuminate\Support\Carbon::parse($icDate)->format('d M, h:i A')
                                            : 'Scheduled'
                                    }}

                                </span>


                                <div class="ed-interview-actions">

                                    <a href="{{ route('employer.applicants.index', ['status' => 'interview']) }}" class="ed-interview-view">
                                        View
                                    </a>


                                    @if(
                                        Route::has('employer.applicants.cancelInterview')
                                        && $icApplication
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('employer.applicants.cancelInterview', $icApplication->id) }}"
                                            style="margin:0;"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="ed-interview-cancel"
                                            >
                                                Cancel
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div
                    class="ed-empty"
                    style="min-height:230px;"
                >

                    <div>

                        <div class="ed-empty-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>

                        <strong>
                            No upcoming interviews
                        </strong>

                        <span>
                            Scheduled interviews will appear here.
                        </span>

                    </div>

                </div>

            @endif

        </div>


        {{-- =================================================
             INVITE CANDIDATES
        ================================================= --}}

        <div class="ed-panel">

            <div class="ed-panel-header">

                <div class="ed-panel-title">

                    <i class="fas fa-paper-plane"></i>

                    Invite Candidates to Apply

                </div>

                <a href="{{ route('employer.applicants.index') }}" class="ed-panel-action">
                    Browse All →
                </a>

            </div>


            @if(($recommendedCandidates ?? collect())->count())

                <div class="ed-invite-list">

                    @foreach($recommendedCandidates as $i => $candidate)

                        @php

                            $candidateProfile =
                                $candidate->employeeRegistration
                                ?? null;

                            $candidateName =
                                $candidate->name
                                ?? 'Employee';

                            $candidateDesignation =
                                $candidateProfile->designation
                                ?? 'Software Professional';

                        @endphp


                        <div
                            class="ed-invite-card"
                            style="animation-delay:{{ $i * 60 }}ms"
                        >

                            <div class="ed-invite-avatar">

                                {{ strtoupper(substr($candidateName, 0, 1)) }}

                            </div>


                            <div class="ed-invite-info">

                                <div class="ed-invite-name">
                                    {{ $candidateName }}
                                </div>

                                <div class="ed-invite-role">
                                    {{ $candidateDesignation }}
                                </div>

                            </div>


                            {{-- OPEN JOB SELECTION MODAL --}}

                            <button
                                type="button"
                                class="ed-invite-btn js-open-invite-modal"
                                data-candidate-id="{{ $candidate->id }}"
                                data-candidate-name="{{ $candidateName }}"
                            >

                                <i class="fas fa-paper-plane"></i>

                                Invite

                            </button>

                        </div>

                    @endforeach

                </div>

            @else

                <div
                    class="ed-empty"
                    style="min-height:230px;"
                >

                    <div>

                        <div class="ed-empty-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <strong>
                            No candidates to invite
                        </strong>

                        <span>
                            Matching employee profiles will appear here.
                        </span>

                    </div>

                </div>

            @endif

        </div>

    </div>

</section>


{{-- =========================================================
     FINAL CTA
========================================================= --}}

<section class="ed-final-cta">

    <div>

        <h2>
            Ready to build your team?
        </h2>

        <p>
            Create a job and connect with skilled professionals.
        </p>

    </div>


    <a href="{{ route('employer.jobs.create') }}" class="ed-btn">

        <i class="fas fa-plus"></i>

        Create a Job

    </a>

</section>


</div>
{{-- END ed-container --}}

</div>
{{-- END employer-dashboard --}}


{{-- =============================================================
     JOB INVITATION MODAL
============================================================= --}}

<div
    class="ed-invite-modal-overlay"
    id="inviteCandidateModal"
    aria-hidden="true"
>

    <div
        class="ed-invite-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="inviteCandidateModalTitle"
    >


        {{-- MODAL HEADER --}}

        <div class="ed-invite-modal-header">

            <div class="ed-invite-modal-heading">

                <div
                    class="ed-invite-modal-title"
                    id="inviteCandidateModalTitle"
                >
                    Invite Candidate
                </div>

                <div class="ed-invite-modal-subtitle">

                    Select a job to invite

                    <strong id="inviteCandidateName">
                        candidate
                    </strong>

                    to apply.

                </div>

            </div>


            <button
                type="button"
                class="ed-invite-modal-close"
                id="closeInviteCandidateModal"
                aria-label="Close"
            >

                <i class="fas fa-times"></i>

            </button>

        </div>


        {{-- MODAL BODY --}}

        <div class="ed-invite-modal-body">

            <div class="ed-job-select-heading">
                SELECT JOB
            </div>


            @if(($employerJobs ?? collect())->count())

                <div class="ed-job-select-list">

                    @foreach($employerJobs as $inviteJob)

                        @php

                            $inviteJobId =
                                (int) $inviteJob->id;

                            /*
                             * We DO NOT use $candidate here.
                             *
                             * The selected candidate is controlled
                             * by JavaScript when the modal opens.
                             *
                             * Therefore the initial button state
                             * is "Invite", and JavaScript changes
                             * it to "Invited" when necessary.
                             */

                        @endphp


                        <div
                            class="ed-job-select-item"
                            data-job-id="{{ $inviteJobId }}"
                        >

                            <div class="ed-job-select-info">

                                <div class="ed-job-select-title">

                                    {{ $inviteJob->title ?? 'Job Opportunity' }}

                                </div>

                                <div class="ed-job-select-meta">

                                    {{ $inviteJob->employment_type ?? 'Full-time' }}

                                    @if(!empty($inviteJob->location))
                                        · {{ $inviteJob->location }}
                                    @endif

                                </div>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'employer.candidates.invite',
                                    [
                                        'candidate' => '__CANDIDATE_ID__'
                                    ]
                                ) }}"
                                class="ed-job-select-form"
                                data-invite-form
                                data-job-id="{{ $inviteJobId }}"
                                data-action-template="{{ route(
                                    'employer.candidates.invite',
                                    [
                                        'candidate' => '__CANDIDATE_ID__'
                                    ]
                                ) }}"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="job_id"
                                    value="{{ $inviteJobId }}"
                                >


                                <button
                                    type="submit"
                                    class="ed-job-select-button"
                                    data-invite-button
                                >

                                    <i class="fas fa-paper-plane"></i>

                                    Invite

                                </button>

                            </form>

                        </div>

                    @endforeach

                </div>


                <div class="ed-invite-note">

                    <i class="fas fa-info-circle"></i>

                    The candidate will receive an email containing
                    the selected job details and an option to apply.

                </div>

            @else

                <div class="ed-no-jobs">

                    <i class="fas fa-briefcase"></i>

                    <strong
                        style="display:block;color:#536d89;margin-bottom:5px;"
                    >
                        No active jobs available
                    </strong>

                    <span>
                        Create an active job before inviting candidates.
                    </span>

                    <div style="margin-top:15px;">

                        <a href="{{ route('employer.jobs.create') }}" class="ed-btn ed-btn-primary" style="min-height:40px;padding:0 16px;font-size:11px;">

                            <i class="fas fa-plus"></i>

                            Create Job

                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       CSRF TOKEN
    ========================================================= */

    const csrfToken =
        document.querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');


    /* =========================================================
       ARTICLE LIKE AJAX
    ========================================================= */

    document.querySelectorAll('.ed-like-form')
        .forEach(function (form) {

            form.addEventListener('submit', async function (event) {

                event.preventDefault();

                const button =
                    form.querySelector('.ed-like-button');

                if (!button) {
                    return;
                }

                if (
                    button.classList.contains('is-loading')
                ) {
                    return;
                }

                const likeUrl =
                    form.dataset.likeUrl ||
                    form.action;

                const countElement =
                    button.querySelector('.like-count');

                button.classList.add('is-loading');

                try {

                    const response = await fetch(
                        likeUrl,
                        {
                            method:'POST',

                            headers:{
                                'X-CSRF-TOKEN':csrfToken,
                                'Accept':'application/json',
                                'X-Requested-With':'XMLHttpRequest'
                            },

                            credentials:'same-origin'
                        }
                    );


                    if (!response.ok) {

                        if (response.status === 419) {

                            alert(
                                'Your session has expired. Please refresh the page and try again.'
                            );

                        } else if (response.status === 401) {

                            alert(
                                'Please login to like this article.'
                            );

                        } else {

                            alert(
                                'Unable to update like. Please try again.'
                            );

                        }

                        return;
                    }


                    const result =
                        await response.json();


                    if (result.liked) {

                        button.classList.add('liked');

                        button.dataset.liked = '1';

                    } else {

                        button.classList.remove('liked');

                        button.dataset.liked = '0';

                    }


                    if (
                        countElement &&
                        result.likes_count !== undefined
                    ) {

                        countElement.textContent =
                            result.likes_count;

                    }

                } catch (error) {

                    console.error(
                        'Article like error:',
                        error
                    );

                    alert(
                        'Something went wrong. Please try again.'
                    );

                } finally {

                    button.classList.remove(
                        'is-loading'
                    );

                }

            });

        });


    /* =========================================================
       INVITE CANDIDATE MODAL
    ========================================================= */

    const inviteModal =
        document.getElementById(
            'inviteCandidateModal'
        );

    const closeInviteModal =
        document.getElementById(
            'closeInviteCandidateModal'
        );

    const inviteCandidateName =
        document.getElementById(
            'inviteCandidateName'
        );


    /*
     * This comes from the EmployerDashboardController:
     *
     * [
     *     candidate_id => [
     *         job_id,
     *         job_id
     *     ]
     * ]
     */

    const invitedCandidateJobIds =
        @json($invitedCandidateJobIds ?? []);


    /* =========================================================
       NORMALIZE INVITATION DATA
    ========================================================= */

    function getInvitedJobIds(candidateId) {

        candidateId =
            String(candidateId);

        const jobs =
            invitedCandidateJobIds[candidateId]
            || [];

        return jobs.map(function (jobId) {

            return parseInt(
                jobId,
                10
            );

        });

    }


    /* =========================================================
       UPDATE MODAL JOB BUTTONS
    ========================================================= */

    function updateInviteJobButtons(candidateId) {

        const invitedJobIds =
            getInvitedJobIds(candidateId);


        document.querySelectorAll(
            '[data-invite-form]'
        ).forEach(function (form) {

            const jobId =
                parseInt(
                    form.dataset.jobId,
                    10
                );

            const button =
                form.querySelector(
                    '[data-invite-button]'
                );

            if (!button) {
                return;
            }


            /*
             * Candidate has already been invited
             * for this specific job.
             */

            if (
                invitedJobIds.includes(jobId)
            ) {

                button.disabled = true;

                button.classList.remove(
                    'is-loading'
                );

                button.classList.add(
                    'is-invited'
                );

                button.innerHTML =
                    '<i class="fas fa-check"></i> Invited';

            } else {

                button.disabled = false;

                button.classList.remove(
                    'is-loading'
                );

                button.classList.remove(
                    'is-invited'
                );

                button.innerHTML =
                    '<i class="fas fa-paper-plane"></i> Invite';

            }

        });

    }


    /* =========================================================
       OPEN MODAL
    ========================================================= */

    document.querySelectorAll(
        '.js-open-invite-modal'
    ).forEach(function (button) {

        button.addEventListener(
            'click',
            function () {

                const candidateId =
                    this.dataset.candidateId;

                const candidateName =
                    this.dataset.candidateName
                    || 'candidate';


                /*
                 * Set candidate name.
                 */

                if (inviteCandidateName) {

                    inviteCandidateName.textContent =
                        candidateName;

                }


                /*
                 * IMPORTANT:
                 *
                 * Always use the original
                 * data-action-template.
                 *
                 * This prevents the old candidate ID
                 * from remaining in the form action.
                 */

                document.querySelectorAll(
                    '[data-invite-form]'
                ).forEach(function (form) {

                    const actionTemplate =
                        form.dataset.actionTemplate;

                    if (!actionTemplate) {
                        return;
                    }

                    const newAction =
                        actionTemplate.replace(
                            '__CANDIDATE_ID__',
                            candidateId
                        );

                    form.setAttribute(
                        'action',
                        newAction
                    );

                });


                /*
                 * Update Invited / Invite buttons
                 * according to selected candidate.
                 */

                updateInviteJobButtons(
                    candidateId
                );


                /*
                 * Open modal.
                 */

                if (inviteModal) {

                    inviteModal.classList.add(
                        'is-open'
                    );

                    inviteModal.setAttribute(
                        'aria-hidden',
                        'false'
                    );

                    document.body.style.overflow =
                        'hidden';

                }

            }
        );

    });


    /* =========================================================
       CLOSE MODAL
    ========================================================= */

    function closeInviteCandidateModal(){

        if (!inviteModal) {
            return;
        }

        inviteModal.classList.remove(
            'is-open'
        );

        inviteModal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.style.overflow =
            '';

    }


    if (closeInviteModal) {

        closeInviteModal.addEventListener(
            'click',
            closeInviteCandidateModal
        );

    }


    /* =========================================================
       CLICK OUTSIDE MODAL
    ========================================================= */

    if (inviteModal) {

        inviteModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    inviteModal
                ) {

                    closeInviteCandidateModal();

                }

            }
        );

    }


    /* =========================================================
       ESC KEY
    ========================================================= */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                inviteModal &&
                inviteModal.classList.contains(
                    'is-open'
                )
            ) {

                closeInviteCandidateModal();

            }

        }
    );


    /* =========================================================
       INVITATION FORM SUBMIT
    ========================================================= */

    document.querySelectorAll(
        '[data-invite-form]'
    ).forEach(function (form) {

        form.addEventListener(
            'submit',
            function (event) {

                const button =
                    form.querySelector(
                        '[data-invite-button]'
                    );

                if (!button) {
                    return;
                }


                /*
                 * Already invited.
                 */

                if (
                    button.disabled &&
                    button.classList.contains(
                        'is-invited'
                    )
                ) {

                    event.preventDefault();

                    return;

                }


                /*
                 * Prevent double click.
                 */

                if (
                    button.classList.contains(
                        'is-loading'
                    )
                ) {

                    event.preventDefault();

                    return;

                }


                /*
                 * Sending state.
                 */

                button.classList.add(
                    'is-loading'
                );

                button.disabled = true;

                button.innerHTML =
                    '<i class="fas fa-spinner fa-spin"></i> Sending...';

            }
        );

    });


});

</script>

@endsection