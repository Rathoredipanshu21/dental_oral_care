<?php
// patient-care.php — Oral Care Dental Clinic, Dhanbad
$phone_display = '081026 05105';
$phone_tel     = '+918102605105';
$wa_link       = 'https://wa.me/918102605105?text=' . rawurlencode('Hello Oral Care Dental Clinic, I need help with post-treatment care.');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Patient Care | Oral Care Dental Clinic, Dhanbad</title>
<meta name="description" content="Simple aftercare guides for root canal, extraction, child pulp treatment, space maintainers, clear aligners and braces at Oral Care Dental Clinic, Dhanbad.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<style>
/* ==========================================================
   Every rule below is scoped to .patient-care-dental-container
   so nothing here can touch navbar.php or any site-wide include
   ========================================================== */
.patient-care-dental-container{
  --pcd-navy:#0a2a5e; --pcd-navy-2:#06214a; --pcd-navy-3:#123a7a;
  --pcd-green:#3f9a14; --pcd-green-2:#2f7a0d; --pcd-green-soft:#eaf5e2;
  --pcd-ink:#14233f; --pcd-muted:#56637a; --pcd-line:rgba(10,42,94,.09);
  --pcd-bg:#f4f7fb; --pcd-r:6px; --pcd-shadow:0 6px 18px rgba(10,42,94,.10);
  font-family:'Montserrat',sans-serif; font-size:15px; line-height:1.6;
  color:var(--pcd-ink); background:var(--pcd-bg);
  width:100%; position:relative; overflow-x:hidden; overflow-x:clip;
}
.patient-care-dental-container *{box-sizing:border-box}
.patient-care-dental-container h1,
.patient-care-dental-container h2,
.patient-care-dental-container h3,
.patient-care-dental-container h4{font-family:'Playfair Display',serif;color:var(--pcd-navy);line-height:1.2;margin:0}
.patient-care-dental-container p{margin:0}
.patient-care-dental-container ul{list-style:none;margin:0;padding:0}
.patient-care-dental-container img{max-width:100%;display:block}
.patient-care-dental-container a,
.patient-care-dental-container a:hover,
.patient-care-dental-container a:focus{text-decoration:none}

/* grid-line (row + column lining) backgrounds */
.patient-care-dental-container .patient-care-dental-grid-bg{
  background-image:linear-gradient(var(--pcd-line) 1px,transparent 1px),linear-gradient(90deg,var(--pcd-line) 1px,transparent 1px);
  background-size:54px 54px;
}
.patient-care-dental-container .patient-care-dental-grid-bg-dark{
  background-image:linear-gradient(rgba(255,255,255,.07) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.07) 1px,transparent 1px);
  background-size:54px 54px;
}

/* buttons */
.patient-care-dental-container .patient-care-dental-btn{
  display:inline-flex;align-items:center;gap:9px;padding:12px 20px;border-radius:4px;
  font-weight:700;font-size:13px;letter-spacing:.7px;text-transform:uppercase;
  transition:.25s;cursor:pointer;font-family:inherit;line-height:1.3;
}
.patient-care-dental-container .patient-care-dental-btn-green{background:var(--pcd-green);color:#fff;border:2px solid var(--pcd-green);box-shadow:0 5px 14px rgba(63,154,20,.35)}
.patient-care-dental-container .patient-care-dental-btn-green:hover{background:var(--pcd-green-2);border-color:var(--pcd-green-2);color:#fff;transform:translateY(-2px)}
.patient-care-dental-container .patient-care-dental-btn-navy{background:var(--pcd-navy);color:#fff;border:2px solid var(--pcd-navy);box-shadow:0 5px 14px rgba(10,42,94,.3)}
.patient-care-dental-container .patient-care-dental-btn-navy:hover{background:var(--pcd-navy-3);border-color:var(--pcd-navy-3);color:#fff;transform:translateY(-2px)}
.patient-care-dental-container .patient-care-dental-btn-line{background:rgba(255,255,255,.08);color:#fff;border:2px solid rgba(255,255,255,.8)}
.patient-care-dental-container .patient-care-dental-btn-line:hover{background:#fff;color:var(--pcd-navy)}

/* hero */
.patient-care-dental-container .patient-care-dental-hero{
  position:relative;min-height:430px;display:grid;place-items:center;text-align:center;color:#fff;
  background:url('https://images.unsplash.com/photo-1606811841689-23dfddce3e95?auto=format&fit=crop&w=1800&q=70') center/cover no-repeat,var(--pcd-navy);
}
.patient-care-dental-container .patient-care-dental-hero::before{content:"";position:absolute;inset:0;background:linear-gradient(180deg,rgba(6,33,74,.90),rgba(10,42,94,.80))}
.patient-care-dental-container .patient-care-dental-hero::after{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.06) 1px,transparent 1px);background-size:54px 54px}
.patient-care-dental-container .patient-care-dental-hero-inner{position:relative;z-index:2;padding:56px 20px 70px}
.patient-care-dental-container .patient-care-dental-crumbs{display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);padding:8px 18px;border-radius:50px;font-size:13px;font-weight:600;backdrop-filter:blur(4px)}
.patient-care-dental-container .patient-care-dental-crumbs a{color:#fff}
.patient-care-dental-container .patient-care-dental-crumbs a i{color:#8fe05a}
.patient-care-dental-container .patient-care-dental-crumbs a:hover{color:#8fe05a}
.patient-care-dental-container .patient-care-dental-crumbs .fa-chevron-right{font-size:9px;opacity:.7}
.patient-care-dental-container .patient-care-dental-crumbs .patient-care-dental-current{color:#8fe05a}
.patient-care-dental-container .patient-care-dental-title{color:#fff;font-size:clamp(40px,7vw,76px);font-weight:800;margin:22px 0 12px}
.patient-care-dental-container .patient-care-dental-lead{max-width:640px;margin:0 auto 24px;color:#dbe6f7;font-size:16px}
.patient-care-dental-container .patient-care-dental-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;position:relative;z-index:3}

/* facts strip */
.patient-care-dental-container .patient-care-dental-facts{position:relative;z-index:5;margin-top:-34px}
.patient-care-dental-container .patient-care-dental-facts-row{background:#fff;border-radius:var(--pcd-r);box-shadow:var(--pcd-shadow);overflow:hidden;border-top:4px solid var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-fact{display:flex;gap:14px;align-items:center;padding:20px 22px;height:100%;border-right:1px solid var(--pcd-line);border-bottom:1px solid var(--pcd-line)}
.patient-care-dental-container .patient-care-dental-fact-icon{width:46px;height:46px;border-radius:6px;background:var(--pcd-green-soft);color:var(--pcd-green);display:grid;place-items:center;font-size:19px;flex:none}
.patient-care-dental-container .patient-care-dental-fact b{display:block;color:var(--pcd-navy);font-size:14px}
.patient-care-dental-container .patient-care-dental-fact span{font-size:12.5px;color:var(--pcd-muted)}

/* sections */
.patient-care-dental-container .patient-care-dental-section{padding:64px 0;position:relative}
.patient-care-dental-container .patient-care-dental-tag{display:inline-flex;align-items:center;gap:8px;color:var(--pcd-green);font-weight:700;font-size:12.5px;letter-spacing:1.8px;text-transform:uppercase;margin-bottom:10px}
.patient-care-dental-container .patient-care-dental-heading{font-size:clamp(28px,4vw,42px);margin-bottom:14px}
.patient-care-dental-container .patient-care-dental-text{color:var(--pcd-muted);max-width:640px}
.patient-care-dental-container .patient-care-dental-center{text-align:center}
.patient-care-dental-container .patient-care-dental-center .patient-care-dental-text{margin:0 auto}

/* intro points */
.patient-care-dental-container .patient-care-dental-point{display:flex;gap:11px;align-items:flex-start;height:100%;background:#fff;border:1px solid var(--pcd-line);border-left:3px solid var(--pcd-green);border-radius:4px;padding:12px 14px;font-size:13.5px;font-weight:600;color:var(--pcd-navy);transition:.25s}
.patient-care-dental-container .patient-care-dental-point:hover{transform:translateX(4px);box-shadow:var(--pcd-shadow)}
.patient-care-dental-container .patient-care-dental-point i{color:var(--pcd-green);margin-top:4px}

/* collage */
.patient-care-dental-container .patient-care-dental-collage{display:grid;grid-template-columns:repeat(6,1fr);grid-template-rows:repeat(6,62px);gap:12px;position:relative}
.patient-care-dental-container .patient-care-dental-collage figure{margin:0;overflow:hidden;border-radius:var(--pcd-r);position:relative;box-shadow:var(--pcd-shadow);background:linear-gradient(135deg,var(--pcd-navy-3),var(--pcd-green))}
.patient-care-dental-container .patient-care-dental-collage figure::after{content:"";position:absolute;inset:0;border:3px solid #fff;border-radius:var(--pcd-r);pointer-events:none}
.patient-care-dental-container .patient-care-dental-collage img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
.patient-care-dental-container .patient-care-dental-collage figure:hover img{transform:scale(1.08)}
.patient-care-dental-container .patient-care-dental-c1{grid-column:1/4;grid-row:1/5}
.patient-care-dental-container .patient-care-dental-c2{grid-column:4/7;grid-row:1/3}
.patient-care-dental-container .patient-care-dental-c3{grid-column:4/7;grid-row:3/7}
.patient-care-dental-container .patient-care-dental-c4{grid-column:1/4;grid-row:5/7}
.patient-care-dental-container .patient-care-dental-badge{position:absolute;left:-14px;bottom:70px;z-index:3;background:var(--pcd-navy);color:#fff;padding:12px 16px;border-radius:var(--pcd-r);box-shadow:var(--pcd-shadow);display:flex;gap:11px;align-items:center;border-left:4px solid var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-badge i{font-size:22px;color:#8fe05a}
.patient-care-dental-container .patient-care-dental-badge b{display:block;font-size:14px}
.patient-care-dental-container .patient-care-dental-badge span{font-size:11.5px;color:#b9c9e6}

/* aftercare guide */
.patient-care-dental-container .patient-care-dental-guide{background:#fff;border-top:1px solid var(--pcd-line);border-bottom:1px solid var(--pcd-line)}
.patient-care-dental-container .patient-care-dental-tabs{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin:30px 0 24px;border:0}
.patient-care-dental-container .patient-care-dental-tab{display:flex;align-items:center;gap:9px;padding:11px 18px;background:var(--pcd-bg);border:1px solid var(--pcd-line);border-radius:4px;font:600 13.5px 'Montserrat',sans-serif;color:var(--pcd-navy);transition:.25s}
.patient-care-dental-container .patient-care-dental-tab i{color:var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-tab:hover{border-color:var(--pcd-green);color:var(--pcd-navy)}
.patient-care-dental-container .patient-care-dental-tab.active{background:var(--pcd-navy);color:#fff;border-color:var(--pcd-navy);box-shadow:0 6px 14px rgba(10,42,94,.25)}
.patient-care-dental-container .patient-care-dental-tab.active i{color:#8fe05a}
.patient-care-dental-container .patient-care-dental-panel-head{display:flex;align-items:center;gap:14px;margin-bottom:16px}
.patient-care-dental-container .patient-care-dental-panel-icon{width:54px;height:54px;border-radius:6px;background:var(--pcd-navy);color:#8fe05a;display:grid;place-items:center;font-size:23px;flex:none}
.patient-care-dental-container .patient-care-dental-panel-head h3{font-size:26px}
.patient-care-dental-container .patient-care-dental-panel-head p{color:var(--pcd-muted);font-size:13.5px}
.patient-care-dental-container .patient-care-dental-box{background:var(--pcd-bg);border:1px solid var(--pcd-line);border-radius:var(--pcd-r);padding:20px;position:relative;overflow:hidden;height:100%}
.patient-care-dental-container .patient-care-dental-box::before{content:"";position:absolute;left:0;top:0;width:100%;height:3px;background:var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-box-warn::before{background:#d9822b}
.patient-care-dental-container .patient-care-dental-box h4{display:flex;align-items:center;gap:10px;font-size:15px;margin-bottom:12px;font-weight:700}
.patient-care-dental-container .patient-care-dental-box h4 i{width:32px;height:32px;border-radius:4px;background:var(--pcd-green-soft);color:var(--pcd-green);display:grid;place-items:center;font-size:14px}
.patient-care-dental-container .patient-care-dental-box-warn h4 i{background:#fdeedd;color:#d9822b}
.patient-care-dental-container .patient-care-dental-box li{display:flex;gap:10px;font-size:13.5px;color:#33435f;padding:7px 0;border-bottom:1px dashed var(--pcd-line)}
.patient-care-dental-container .patient-care-dental-box li:last-child{border:0}
.patient-care-dental-container .patient-care-dental-box li i{color:var(--pcd-green);margin-top:5px;font-size:11px;flex:none}
.patient-care-dental-container .patient-care-dental-box-warn li i{color:#d9822b}
.patient-care-dental-container .patient-care-dental-note{display:flex;gap:14px;align-items:center;margin-top:16px;background:var(--pcd-navy);color:#e6edf9;border-radius:var(--pcd-r);padding:16px 20px;border-left:5px solid var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-note i{font-size:24px;color:#8fe05a}
.patient-care-dental-container .patient-care-dental-note b{color:#fff}

/* habits */
.patient-care-dental-container .patient-care-dental-habit{background:#fff;border:1px solid var(--pcd-line);border-radius:var(--pcd-r);padding:22px 20px;height:100%;transition:.3s;position:relative;overflow:hidden}
.patient-care-dental-container .patient-care-dental-habit::after{content:"";position:absolute;left:0;bottom:0;height:3px;width:0;background:var(--pcd-green);transition:.35s}
.patient-care-dental-container .patient-care-dental-habit:hover{transform:translateY(-5px);box-shadow:var(--pcd-shadow)}
.patient-care-dental-container .patient-care-dental-habit:hover::after{width:100%}
.patient-care-dental-container .patient-care-dental-habit-icon{width:50px;height:50px;border-radius:6px;background:var(--pcd-green-soft);color:var(--pcd-green);display:grid;place-items:center;font-size:21px;margin-bottom:14px}
.patient-care-dental-container .patient-care-dental-habit h3{font-size:18px;margin-bottom:6px}
.patient-care-dental-container .patient-care-dental-habit p{font-size:13.5px;color:var(--pcd-muted)}

/* emergency band */
.patient-care-dental-container .patient-care-dental-band{background:linear-gradient(120deg,var(--pcd-navy-2),var(--pcd-navy-3));color:#fff;overflow:hidden;padding:50px 0}
.patient-care-dental-container .patient-care-dental-band h2{color:#fff;font-size:clamp(26px,3.6vw,38px);margin-bottom:10px}
.patient-care-dental-container .patient-care-dental-band p{color:#cfdcf2;max-width:560px}
.patient-care-dental-container .patient-care-dental-band-links{display:grid;gap:10px}
.patient-care-dental-container .patient-care-dental-band-links a{display:flex;align-items:center;gap:14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.2);padding:14px 18px;border-radius:var(--pcd-r);transition:.25s;color:#fff}
.patient-care-dental-container .patient-care-dental-band-links a:hover{background:var(--pcd-green);border-color:var(--pcd-green);transform:translateX(5px)}
.patient-care-dental-container .patient-care-dental-band-links i{font-size:20px;color:#8fe05a;width:24px;text-align:center}
.patient-care-dental-container .patient-care-dental-band-links a:hover i{color:#fff}
.patient-care-dental-container .patient-care-dental-band-links b{display:block;font-size:15px;color:#fff}
.patient-care-dental-container .patient-care-dental-band-links span{font-size:12px;color:#c3d3ee}
.patient-care-dental-container .patient-care-dental-band-links a:hover span{color:#fff}

/* post-operative instructions */
.patient-care-dental-container .patient-care-dental-step{background:#fff;border:1px solid var(--pcd-line);border-top:3px solid var(--pcd-green);border-radius:var(--pcd-r);padding:20px 18px;height:100%;position:relative;transition:.3s}
.patient-care-dental-container .patient-care-dental-step:hover{transform:translateY(-5px);box-shadow:var(--pcd-shadow)}
.patient-care-dental-container .patient-care-dental-step-no{position:absolute;right:14px;top:10px;font:800 34px 'Playfair Display',serif;color:rgba(10,42,94,.08)}
.patient-care-dental-container .patient-care-dental-step-icon{width:46px;height:46px;border-radius:6px;background:var(--pcd-navy);color:#8fe05a;display:grid;place-items:center;font-size:19px;margin-bottom:12px}
.patient-care-dental-container .patient-care-dental-step h3{font-size:18px;margin-bottom:4px}
.patient-care-dental-container .patient-care-dental-step small{display:block;color:var(--pcd-green);font-weight:700;font-size:12px;margin-bottom:8px}
.patient-care-dental-container .patient-care-dental-step p{font-size:13.5px;color:var(--pcd-muted)}
.patient-care-dental-container .patient-care-dental-dodont{border-radius:var(--pcd-r);padding:22px;height:100%;border:1px solid var(--pcd-line);background:#fff}
.patient-care-dental-container .patient-care-dental-dodont h3{display:flex;align-items:center;gap:10px;font-size:20px;margin-bottom:12px}
.patient-care-dental-container .patient-care-dental-dodont h3 i{width:34px;height:34px;border-radius:50%;display:grid;place-items:center;font-size:15px;color:#fff;background:var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-dont h3 i{background:#d9822b}
.patient-care-dental-container .patient-care-dental-dodont li{display:flex;gap:10px;padding:7px 0;border-bottom:1px dashed var(--pcd-line);font-size:13.5px;color:#33435f}
.patient-care-dental-container .patient-care-dental-dodont li:last-child{border:0}
.patient-care-dental-container .patient-care-dental-do li i{color:var(--pcd-green);margin-top:5px;font-size:11px}
.patient-care-dental-container .patient-care-dental-dont li i{color:#d9822b;margin-top:5px;font-size:11px}
.patient-care-dental-container .patient-care-dental-do{border-top:3px solid var(--pcd-green)}
.patient-care-dental-container .patient-care-dental-dont{border-top:3px solid #d9822b}

/* patient safety */
.patient-care-dental-container .patient-care-dental-safety{background:linear-gradient(120deg,var(--pcd-navy-2),var(--pcd-navy-3));color:#fff;padding:64px 0;position:relative}
.patient-care-dental-container .patient-care-dental-safety .patient-care-dental-heading{color:#fff}
.patient-care-dental-container .patient-care-dental-safety .patient-care-dental-text{color:#cfdcf2}
.patient-care-dental-container .patient-care-dental-safety-img{position:relative;border-radius:var(--pcd-r);overflow:hidden;box-shadow:0 10px 26px rgba(0,0,0,.3);border:3px solid rgba(255,255,255,.9);background:linear-gradient(135deg,var(--pcd-navy-3),var(--pcd-green));min-height:300px}
.patient-care-dental-container .patient-care-dental-safety-img img{width:100%;height:100%;min-height:300px;object-fit:cover}
.patient-care-dental-container .patient-care-dental-safety-img .patient-care-dental-badge{left:14px;bottom:14px}
.patient-care-dental-container .patient-care-dental-safe-item{display:flex;gap:14px;height:100%;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.18);border-radius:var(--pcd-r);padding:16px;transition:.3s}
.patient-care-dental-container .patient-care-dental-safe-item:hover{background:rgba(255,255,255,.13);transform:translateY(-4px)}
.patient-care-dental-container .patient-care-dental-safe-icon{width:44px;height:44px;border-radius:6px;background:var(--pcd-green);color:#fff;display:grid;place-items:center;font-size:18px;flex:none}
.patient-care-dental-container .patient-care-dental-safe-item h3{color:#fff;font-size:16px;margin-bottom:3px}
.patient-care-dental-container .patient-care-dental-safe-item p{font-size:13px;color:#c3d3ee}

/* responsive */
@media(max-width:991.98px){
  .patient-care-dental-container .patient-care-dental-badge{left:10px}
}
@media(max-width:767.98px){
  .patient-care-dental-container .patient-care-dental-section{padding:46px 0}
  .patient-care-dental-container .patient-care-dental-collage{grid-template-rows:repeat(6,46px);gap:8px}
  .patient-care-dental-container .patient-care-dental-badge{display:none}
  .patient-care-dental-container .patient-care-dental-tabs{justify-content:flex-start;flex-wrap:nowrap;overflow-x:auto;padding-bottom:8px;-webkit-overflow-scrolling:touch}
  .patient-care-dental-container .patient-care-dental-tab{white-space:nowrap;flex:none}
  .patient-care-dental-container .patient-care-dental-fact{border-right:0}
}
@media(prefers-reduced-motion:reduce){.patient-care-dental-container *{animation:none!important;transition:none!important}}
.patient-care-dental-container :focus-visible{outline:3px solid var(--pcd-green);outline-offset:2px}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<main class="patient-care-dental-container" id="patient-care-dental-container">

  <!-- HERO -->
  <section class="patient-care-dental-hero" id="patient-care-dental-hero">
    <div class="patient-care-dental-hero-inner container">
      <div class="patient-care-dental-crumbs" data-aos="fade-down">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span class="patient-care-dental-current">Patient Care</span>
      </div>
      <h1 class="patient-care-dental-title" data-aos="zoom-in" data-aos-delay="100">Patient Care</h1>
      <p class="patient-care-dental-lead" data-aos="fade-up" data-aos-delay="200">Treatment doesn't end when you leave the chair. Follow these easy aftercare steps from Oral Care Dental Clinic for faster healing and lasting results.</p>
      <div class="patient-care-dental-actions" data-aos="fade-up" data-aos-delay="300">
        <a href="#patient-care-dental-guide" class="patient-care-dental-btn patient-care-dental-btn-green"><i class="fa-solid fa-book-medical"></i> Read Aftercare Guide</a>
        <a href="tel:<?= $phone_tel ?>" class="patient-care-dental-btn patient-care-dental-btn-line"><i class="fa-solid fa-phone"></i> Call Clinic</a>
      </div>
    </div>
  </section>

  <!-- FACTS -->
  <div class="patient-care-dental-facts">
    <div class="container">
      <div class="patient-care-dental-facts-row row g-0" data-aos="fade-up">
        <div class="col-12 col-md-6 col-lg-3"><div class="patient-care-dental-fact"><span class="patient-care-dental-fact-icon"><i class="fa-solid fa-notes-medical"></i></span><div><b>6 Aftercare Guides</b><span>Clear, step-by-step</span></div></div></div>
        <div class="col-12 col-md-6 col-lg-3"><div class="patient-care-dental-fact"><span class="patient-care-dental-fact-icon"><i class="fa-solid fa-child-reaching"></i></span><div><b>Adults &amp; Children</b><span>Care for every age</span></div></div></div>
        <div class="col-12 col-md-6 col-lg-3"><div class="patient-care-dental-fact"><span class="patient-care-dental-fact-icon"><i class="fa-solid fa-clock"></i></span><div><b>Quick Response</b><span>We answer your calls</span></div></div></div>
        <div class="col-12 col-md-6 col-lg-3"><div class="patient-care-dental-fact"><span class="patient-care-dental-fact-icon"><i class="fa-brands fa-whatsapp"></i></span><div><b>WhatsApp Support</b><span>Send us a message</span></div></div></div>
      </div>
    </div>
  </div>

  <!-- INTRO + COLLAGE -->
  <section class="patient-care-dental-section patient-care-dental-grid-bg" id="patient-care-dental-intro">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="patient-care-dental-tag"><i class="fa-solid fa-tooth"></i> Healing made simple</div>
          <h2 class="patient-care-dental-heading">Your recovery matters as much as your treatment</h2>
          <p class="patient-care-dental-text">The first few days after a dental procedure decide how smoothly your mouth heals. Our team has put together short, plain-language guides so you always know what to do, what to avoid, and when to reach out.</p>
          <div class="row g-2 my-4">
            <div class="col-sm-6"><div class="patient-care-dental-point"><i class="fa-solid fa-circle-check"></i>Easy steps you can follow at home</div></div>
            <div class="col-sm-6"><div class="patient-care-dental-point"><i class="fa-solid fa-circle-check"></i>Separate advice for kids and adults</div></div>
            <div class="col-sm-6"><div class="patient-care-dental-point"><i class="fa-solid fa-circle-check"></i>Clear warning signs to watch for</div></div>
            <div class="col-sm-6"><div class="patient-care-dental-point"><i class="fa-solid fa-circle-check"></i>Help is one call or message away</div></div>
          </div>
          <a href="#patient-care-dental-guide" class="patient-care-dental-btn patient-care-dental-btn-navy"><i class="fa-solid fa-arrow-down"></i> Choose your treatment</a>
        </div>

        <div class="col-lg-6" data-aos="fade-left">
          <div class="patient-care-dental-collage">
            <figure class="patient-care-dental-c1"><img loading="lazy" src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=700&q=70" alt="Dentist examining patient"></figure>
            <figure class="patient-care-dental-c2"><img loading="lazy" src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=600&q=70" alt="Modern dental chair"></figure>
            <figure class="patient-care-dental-c3"><img loading="lazy" src="https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=700&q=70" alt="Happy patient smiling"></figure>
            <figure class="patient-care-dental-c4"><img loading="lazy" src="https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&w=600&q=70" alt="Sterilised dental instruments"></figure>
            <div class="patient-care-dental-badge"><i class="fa-solid fa-shield-heart"></i><div><b>Gentle, safe care</b><span>Every single visit</span></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- POST-OPERATIVE INSTRUCTIONS -->
  <section class="patient-care-dental-section patient-care-dental-grid-bg" id="patient-care-dental-postop">
    <div class="container">
      <div class="patient-care-dental-center mb-4" data-aos="fade-up">
        <div class="patient-care-dental-tag"><i class="fa-solid fa-clipboard-check"></i> Post-operative instructions</div>
        <h2 class="patient-care-dental-heading">Healing well after any dental procedure</h2>
        <p class="patient-care-dental-text">These general guidelines apply after most treatments. Your dentist may add specific advice for your case, so always follow that first.</p>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-sm-6 col-lg-3" data-aos="fade-up"><div class="patient-care-dental-step"><span class="patient-care-dental-step-no">01</span><div class="patient-care-dental-step-icon"><i class="fa-solid fa-bed"></i></div><h3>Right after</h3><small>First 2–4 hours</small><p>Rest, avoid touching the area, and don't eat or drink hot items while numb.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100"><div class="patient-care-dental-step"><span class="patient-care-dental-step-no">02</span><div class="patient-care-dental-step-icon"><i class="fa-solid fa-snowflake"></i></div><h3>First day</h3><small>Up to 24 hours</small><p>Use a cold pack for swelling, drink plenty of water and keep your head slightly raised when lying down.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200"><div class="patient-care-dental-step"><span class="patient-care-dental-step-no">03</span><div class="patient-care-dental-step-icon"><i class="fa-solid fa-pills"></i></div><h3>Days 2–3</h3><small>Settling phase</small><p>Take medicines exactly as prescribed, eat soft food and clean the other teeth gently.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300"><div class="patient-care-dental-step"><span class="patient-care-dental-step-no">04</span><div class="patient-care-dental-step-icon"><i class="fa-solid fa-calendar-check"></i></div><h3>First week</h3><small>Follow-up</small><p>Return to normal routine slowly and attend your review visit so we can check healing.</p></div></div>
      </div>

      <div class="row g-3">
        <div class="col-md-6" data-aos="fade-right"><div class="patient-care-dental-dodont patient-care-dental-do"><h3><i class="fa-solid fa-check"></i>Please do</h3><ul>
          <li><i class="fa-solid fa-check"></i>Finish every prescribed medicine, including antibiotics, as directed.</li>
          <li><i class="fa-solid fa-check"></i>Keep your mouth clean with gentle brushing and a warm salt-water rinse once your dentist allows it.</li>
          <li><i class="fa-solid fa-check"></i>Eat soft, lukewarm food and stay well hydrated.</li>
          <li><i class="fa-solid fa-check"></i>Get plenty of rest on the day of treatment.</li>
          <li><i class="fa-solid fa-check"></i>Keep our number handy in case you need advice.</li></ul></div></div>
        <div class="col-md-6" data-aos="fade-left"><div class="patient-care-dental-dodont patient-care-dental-dont"><h3><i class="fa-solid fa-xmark"></i>Please avoid</h3><ul>
          <li><i class="fa-solid fa-xmark"></i>Poking the treated area with your tongue, fingers or any object.</li>
          <li><i class="fa-solid fa-xmark"></i>Smoking, chewing tobacco and alcohol while the area heals.</li>
          <li><i class="fa-solid fa-xmark"></i>Very hot, spicy, hard or sticky food in the first few days.</li>
          <li><i class="fa-solid fa-xmark"></i>Strenuous exercise or heavy lifting on the day of surgery.</li>
          <li><i class="fa-solid fa-xmark"></i>Stopping or changing medicines on your own without asking us.</li></ul></div></div>
      </div>
    </div>
  </section>

  <!-- AFTERCARE GUIDE -->
  <section class="patient-care-dental-section patient-care-dental-guide" id="patient-care-dental-guide">
    <div class="container">
      <div class="patient-care-dental-center" data-aos="fade-up">
        <div class="patient-care-dental-tag"><i class="fa-solid fa-hand-holding-medical"></i> Treatment guides</div>
        <h2 class="patient-care-dental-heading">Procedure-wise aftercare instructions</h2>
        <p class="patient-care-dental-text">Select your procedure below. If anything feels unusual, don't wait — call us.</p>
      </div>

      <ul class="nav nav-pills patient-care-dental-tabs" id="patient-care-dental-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab active" data-bs-toggle="pill" data-bs-target="#patient-care-dental-rct" type="button" role="tab"><i class="fa-solid fa-tooth"></i>Root Canal</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab" data-bs-toggle="pill" data-bs-target="#patient-care-dental-ext" type="button" role="tab"><i class="fa-solid fa-syringe"></i>Extraction</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab" data-bs-toggle="pill" data-bs-target="#patient-care-dental-kid" type="button" role="tab"><i class="fa-solid fa-child"></i>Child Pulp Treatment</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab" data-bs-toggle="pill" data-bs-target="#patient-care-dental-spc" type="button" role="tab"><i class="fa-solid fa-puzzle-piece"></i>Space Maintainer</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab" data-bs-toggle="pill" data-bs-target="#patient-care-dental-aln" type="button" role="tab"><i class="fa-solid fa-teeth"></i>Clear Aligners</button></li>
        <li class="nav-item" role="presentation"><button class="nav-link patient-care-dental-tab" data-bs-toggle="pill" data-bs-target="#patient-care-dental-brc" type="button" role="tab"><i class="fa-solid fa-teeth-open"></i>Braces</button></li>
      </ul>

      <div class="tab-content" id="patient-care-dental-tab-content">

        <!-- ROOT CANAL -->
        <div class="tab-pane fade show active" id="patient-care-dental-rct" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-tooth"></i></div><div><h3>After a Root Canal</h3><p>Usually completed in one or two visits.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-hourglass-half"></i>First few hours</h4><ul>
              <li><i class="fa-solid fa-check"></i>Your lip, cheek or tongue may stay numb for some hours.</li>
              <li><i class="fa-solid fa-check"></i>Chew on the opposite side until feeling is back to normal.</li>
              <li><i class="fa-solid fa-check"></i>A temporary filling protects the tooth between visits.</li>
              <li><i class="fa-solid fa-check"></i>Tiny crumbs of the temporary filling may come off — that's fine.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-calendar-day"></i>Next few days</h4><ul>
              <li><i class="fa-solid fa-check"></i>Mild tenderness when biting is common and settles gradually.</li>
              <li><i class="fa-solid fa-check"></i>Take pain relief only as your dentist advised.</li>
              <li><i class="fa-solid fa-check"></i>If antibiotics were given, finish the whole course.</li>
              <li><i class="fa-solid fa-check"></i>Keep brushing gently and keep the area clean.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box patient-care-dental-box-warn"><h4><i class="fa-solid fa-triangle-exclamation"></i>Call us if</h4><ul>
              <li><i class="fa-solid fa-circle-exclamation"></i>Strong pain continues beyond a few days.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>Your face or gum swells up.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>You get a rash, itching or other medicine reaction.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>Your bite feels uneven or "high".</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>The temporary filling falls out completely.</li></ul></div></div>
          </div>
          <div class="patient-care-dental-note"><i class="fa-solid fa-crown"></i><div><b>Don't skip the crown.</b> Get your permanent filling or crown within 15–30 days so the treated tooth doesn't crack.</div></div>
        </div>

        <!-- EXTRACTION -->
        <div class="tab-pane fade" id="patient-care-dental-ext" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-syringe"></i></div><div><h3>After a Tooth Extraction</h3><p>The first 24 hours are the most important.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-bandage"></i>On the day</h4><ul>
              <li><i class="fa-solid fa-check"></i>Bite down firmly on the gauze for about 45 minutes.</li>
              <li><i class="fa-solid fa-check"></i>Take the gauze out with clean hands.</li>
              <li><i class="fa-solid fa-check"></i>Hold a cold pack on your cheek on and off for the first day.</li>
              <li><i class="fa-solid fa-check"></i>Rest well and skip heavy activity.</li>
              <li><i class="fa-solid fa-check"></i>Wait to eat until the bleeding has stopped.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-ban"></i>Protect the clot</h4><ul>
              <li><i class="fa-solid fa-check"></i>No straws, no spitting and no rinsing for 24 hours.</li>
              <li><i class="fa-solid fa-check"></i>No smoking or alcohol for a full week.</li>
              <li><i class="fa-solid fa-check"></i>Leave the socket alone while brushing for 72 hours; clean other teeth normally.</li>
              <li><i class="fa-solid fa-check"></i>Start with soft food and warm drinks, then return to your usual diet slowly.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box patient-care-dental-box-warn"><h4><i class="fa-solid fa-triangle-exclamation"></i>Call us if</h4><ul>
              <li><i class="fa-solid fa-circle-exclamation"></i>Bleeding is heavy or won't stop.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>Pain becomes severe.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>You react badly to a prescribed medicine.</li></ul></div></div>
          </div>
        </div>

        <!-- CHILD PULP -->
        <div class="tab-pane fade" id="patient-care-dental-kid" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-child"></i></div><div><h3>After Pulpectomy / Pulpotomy (Children)</h3><p>Nerve treatment on a baby tooth.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-eye"></i>While still numb</h4><ul>
              <li><i class="fa-solid fa-check"></i>Watch your child so they don't chew their lip, tongue or cheek.</li>
              <li><i class="fa-solid fa-check"></i>No food or drink for 1–2 hours, until numbness is gone.</li>
              <li><i class="fa-solid fa-check"></i>Wait 30 minutes before eating, drinking or rinsing so the filling can set.</li>
              <li><i class="fa-solid fa-check"></i>Normal play and school are fine once they feel comfortable.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-bowl-rice"></i>Food &amp; cleaning</h4><ul>
              <li><i class="fa-solid fa-check"></i>Soft meals for 24–48 hours: rice, idli, khichdi, mashed vegetables.</li>
              <li><i class="fa-solid fa-check"></i>Skip hard, sticky and very hot foods for 2–3 days.</li>
              <li><i class="fa-solid fa-check"></i>Don't brush the treated tooth that evening; brush normally from next day.</li>
              <li><i class="fa-solid fa-check"></i>Give medicines exactly as prescribed.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box patient-care-dental-box-warn"><h4><i class="fa-solid fa-triangle-exclamation"></i>Call us if</h4><ul>
              <li><i class="fa-solid fa-circle-exclamation"></i>Pain keeps increasing or doesn't go away.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>There is swelling or unusual sensitivity.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>Your child can't chew on that tooth.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>You suspect an allergic reaction.</li></ul></div></div>
          </div>
          <div class="patient-care-dental-note"><i class="fa-solid fa-crown"></i><div><b>Crown within 10 days.</b> A late crown makes it much more likely that the tooth breaks or the treatment fails.</div></div>
        </div>

        <!-- SPACE MAINTAINER -->
        <div class="tab-pane fade" id="patient-care-dental-spc" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-puzzle-piece"></i></div><div><h3>After a Space Maintainer</h3><p>Keeps room open for the permanent tooth.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-utensils"></i>Eating</h4><ul>
              <li><i class="fa-solid fa-check"></i>Wait 30–60 minutes after fitting before eating or drinking.</li>
              <li><i class="fa-solid fa-check"></i>Soft food for 24–48 hours; no hard food for 2–3 days.</li>
              <li><i class="fa-solid fa-check"></i>Avoid chewy or sticky sweets that can pull it loose.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-hand-sparkles"></i>Daily habits</h4><ul>
              <li><i class="fa-solid fa-check"></i>Slight gum soreness for 2–3 days is expected.</li>
              <li><i class="fa-solid fa-check"></i>Extra saliva at first is normal and fades.</li>
              <li><i class="fa-solid fa-check"></i>Tell your child not to poke or push on it.</li>
              <li><i class="fa-solid fa-check"></i>Skip brushing there tonight; resume tomorrow with a soft brush.</li>
              <li><i class="fa-solid fa-check"></i>Visit for a check-up every 3–6 months.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box patient-care-dental-box-warn"><h4><i class="fa-solid fa-triangle-exclamation"></i>Tell us if</h4><ul>
              <li><i class="fa-solid fa-circle-exclamation"></i>The permanent tooth starts to come in.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>The appliance feels loose or breaks.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>You notice signs of infection.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>An allergic reaction appears.</li></ul></div></div>
          </div>
        </div>

        <!-- ALIGNERS -->
        <div class="tab-pane fade" id="patient-care-dental-aln" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-teeth"></i></div><div><h3>Clear Aligner Wearers</h3><p>Results depend on wearing time and cleanliness.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-stopwatch"></i>Wear time</h4><ul>
              <li><i class="fa-solid fa-check"></i>Keep a brand-new aligner in for its first 12 hours straight.</li>
              <li><i class="fa-solid fa-check"></i>Aim for at least 22 hours a day, especially in the first 3–4 days of each set.</li>
              <li><i class="fa-solid fa-check"></i>Press the aligner on with a chewie for 1–2 minutes, 8–10 times a day.</li>
              <li><i class="fa-solid fa-check"></i>Change elastics every 24 hours if given.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-soap"></i>Cleaning</h4><ul>
              <li><i class="fa-solid fa-check"></i>Floss, then brush, then put aligners back in; floss twice a day.</li>
              <li><i class="fa-solid fa-check"></i>Brush after meals whenever you can.</li>
              <li><i class="fa-solid fa-check"></i>Rinse aligners in running water; a soft brush is fine.</li>
              <li><i class="fa-solid fa-check"></i>At night, dab a remineralising paste on teeth before reinserting.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box patient-care-dental-box-warn"><h4><i class="fa-solid fa-ban"></i>Avoid</h4><ul>
              <li><i class="fa-solid fa-circle-exclamation"></i>Eating or drinking anything but water with aligners in.</li>
              <li><i class="fa-solid fa-circle-exclamation"></i>Using mouthwash while wearing them.</li></ul></div></div>
          </div>
        </div>

        <!-- BRACES -->
        <div class="tab-pane fade" id="patient-care-dental-brc" role="tabpanel">
          <div class="patient-care-dental-panel-head"><div class="patient-care-dental-panel-icon"><i class="fa-solid fa-teeth-open"></i></div><div><h3>Living with Braces</h3><p>Tips for a smooth journey to a straighter smile.</p></div></div>
          <div class="row g-3">
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-face-smile"></i>What's normal</h4><ul>
              <li><i class="fa-solid fa-check"></i>Soreness in week one and after each adjustment.</li>
              <li><i class="fa-solid fa-check"></i>More saliva, slight speech changes and cheek irritation early on.</li>
              <li><i class="fa-solid fa-check"></i>Slightly wobbly teeth — it means they're moving as planned.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-heart-pulse"></i>Ease discomfort</h4><ul>
              <li><i class="fa-solid fa-check"></i>Press orthodontic wax over any bracket that rubs.</li>
              <li><i class="fa-solid fa-check"></i>Rinse with warm salt water (1 tsp in a glass) 5–6 times a day.</li>
              <li><i class="fa-solid fa-check"></i>Stay away from hard, sticky and chewy foods.</li></ul></div></div>
            <div class="col-md-4"><div class="patient-care-dental-box"><h4><i class="fa-solid fa-broom"></i>Keep it clean</h4><ul>
              <li><i class="fa-solid fa-check"></i>Brush for 2 minutes after every meal.</li>
              <li><i class="fa-solid fa-check"></i>Floss daily with waxed floss or a threader.</li>
              <li><i class="fa-solid fa-check"></i>Use a fluoride rinse for 60 seconds.</li>
              <li><i class="fa-solid fa-check"></i>Never miss an adjustment visit or professional cleaning.</li></ul></div></div>
          </div>
          <div class="patient-care-dental-note"><i class="fa-solid fa-lock"></i><div><b>Retainers finish the job.</b> After braces come off, a retention phase keeps your teeth in their new position.</div></div>
        </div>

      </div>
    </div>
  </section>

  <!-- PATIENT SAFETY -->
  <section class="patient-care-dental-safety patient-care-dental-grid-bg-dark" id="patient-care-dental-safety">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-5" data-aos="fade-right">
          <div class="patient-care-dental-safety-img">
            <img loading="lazy" src="https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=800&q=70" alt="Clean and sterile dental treatment room">
            <div class="patient-care-dental-badge"><i class="fa-solid fa-shield-heart"></i><div><b>Safety first</b><span>For every patient</span></div></div>
          </div>
        </div>
        <div class="col-lg-7">
          <div data-aos="fade-up">
            <div class="patient-care-dental-tag" style="color:#8fe05a"><i class="fa-solid fa-shield-halved"></i> Patient safety</div>
            <h2 class="patient-care-dental-heading">Your safety is built into every visit</h2>
            <p class="patient-care-dental-text mb-4">From the moment you sit down to the moment you leave, we follow strict hygiene and care protocols so you and your family can feel at ease.</p>
          </div>
          <div class="row g-3">
            <div class="col-sm-6" data-aos="fade-up"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-hands-bubbles"></i></div><div><h3>Sterilised instruments</h3><p>Every tool is cleaned and sterilised between patients.</p></div></div></div>
            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="80"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-syringe"></i></div><div><h3>Single-use items</h3><p>Needles, gloves and masks are fresh for each person.</p></div></div></div>
            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="160"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-spray-can-sparkles"></i></div><div><h3>Disinfected surfaces</h3><p>Chairs, trays and touch points are wiped down after every visit.</p></div></div></div>
            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="240"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-file-medical"></i></div><div><h3>Health history check</h3><p>We review allergies, medicines and conditions before treatment.</p></div></div></div>
            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="320"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-x-ray"></i></div><div><h3>Safe dental X-rays</h3><p>Imaging is used only when needed, with protective measures.</p></div></div></div>
            <div class="col-sm-6" data-aos="fade-up" data-aos-delay="400"><div class="patient-care-dental-safe-item"><div class="patient-care-dental-safe-icon"><i class="fa-solid fa-comments"></i></div><div><h3>Clear consent</h3><p>We explain your treatment, options and costs before we begin.</p></div></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- DAILY HABITS -->
  <section class="patient-care-dental-section patient-care-dental-grid-bg" id="patient-care-dental-habits">
    <div class="container">
      <div class="patient-care-dental-center mb-4" data-aos="fade-up">
        <div class="patient-care-dental-tag"><i class="fa-solid fa-wand-magic-sparkles"></i> Everyday smile care</div>
        <h2 class="patient-care-dental-heading">Four habits that protect every treatment</h2>
        <p class="patient-care-dental-text">Whatever procedure you had, these simple routines keep your results strong.</p>
      </div>
      <div class="row g-3">
        <div class="col-sm-6 col-lg-3" data-aos="fade-up"><div class="patient-care-dental-habit"><div class="patient-care-dental-habit-icon"><i class="fa-solid fa-tooth"></i></div><h3>Brush twice daily</h3><p>Two minutes, soft bristles, fluoride toothpaste — morning and night.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="100"><div class="patient-care-dental-habit"><div class="patient-care-dental-habit-icon"><i class="fa-solid fa-ribbon"></i></div><h3>Floss every day</h3><p>Cleans the gaps your brush can't reach and protects your gums.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200"><div class="patient-care-dental-habit"><div class="patient-care-dental-habit-icon"><i class="fa-solid fa-apple-whole"></i></div><h3>Choose tooth-friendly food</h3><p>Cut down on sugary snacks and fizzy drinks; drink plenty of water.</p></div></div>
        <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300"><div class="patient-care-dental-habit"><div class="patient-care-dental-habit-icon"><i class="fa-solid fa-calendar-check"></i></div><h3>Keep check-ups</h3><p>A visit every six months catches small issues before they grow.</p></div></div>
      </div>
    </div>
  </section>

  <!-- EMERGENCY BAND -->
  <section class="patient-care-dental-band patient-care-dental-grid-bg-dark" id="patient-care-dental-band">
    <div class="container">
      <div class="row g-4 align-items-center">
        <div class="col-lg-7" data-aos="fade-right">
          <div class="patient-care-dental-tag" style="color:#8fe05a"><i class="fa-solid fa-truck-medical"></i> Need help now?</div>
          <h2>Worried about how you're healing? Talk to us.</h2>
          <p>No question is too small. Call or message the clinic and our team will guide you on the next step.</p>
        </div>
        <div class="col-lg-5" data-aos="fade-left">
          <div class="patient-care-dental-band-links">
            <a href="tel:<?= $phone_tel ?>"><i class="fa-solid fa-phone-volume"></i><div><b>Call <?= $phone_display ?></b><span>Speak to our team directly</span></div></a>
            <a href="<?= $wa_link ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i><div><b>Message on WhatsApp</b><span>Share a photo or describe the issue</span></div></a>
            <a href="contact.php#appointment"><i class="fa-solid fa-calendar-plus"></i><div><b>Book a follow-up visit</b><span>Choose a time that suits you</span></div></a>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
AOS.init({duration:800,once:true,offset:60,easing:'ease-out-cubic'});

// refresh AOS positions when a tab changes
document.querySelectorAll('#patient-care-dental-tabs [data-bs-toggle="pill"]').forEach(function(btn){
  btn.addEventListener('shown.bs.tab',function(){ AOS.refresh(); });
});

// hide a broken collage image so the gradient shows instead
document.querySelectorAll('.patient-care-dental-collage img').forEach(function(i){
  i.addEventListener('error',function(){ i.style.display='none'; });
});
</script>
</body>
</html>