<template>
  <div class="main-page">
    <!-- ================= HERO ================= -->
    <section id="hero" class="hero-section">
      <div class="hero-bg-container">
        <div class="hero-video-overlay"></div>

        <!-- Pastikan file video ada di folder public -->
        <video
          autoplay
          muted
          loop
          playsinline
          id="bgVideo"
          class="hero-bg-video"
        >
          <source src="/bg-video.mp4" type="video/mp4" />
          Browser Anda tidak mendukung tag video.
        </video>
      </div>

      <div class="content-wrap container">
        <h1 class="animate-fade-in text-5xl font-extrabold tracking-tight">
          Selamat Datang di Sistem Informasi <br />
          Organisasi Mahasiswa
        </h1>

        <p class="subtitle animate-fade-in delay-200 max-w-2xl">
          SIM Organisasi Mahasiswa UMPKU Surakarta.<br />
          Mewujudkan pengelolaan organisasi yang efisien dan transparan melalui
          integrasi digital menyeluruh.
        </p>

        <NuxtLink
          to="/login"
          class="cta-primary hover:scale-[1.05] transition-transform animate-fade-in delay-400"
        >
          Masuk ke Sistem Sekarang
        </NuxtLink>
      </div>
    </section>

    <!-- ================= FITUR SECTION ================= -->
    <!-- Komponen ini diasumsikan sudah ada di proyek Anda -->
    <FiturSection />

    <!-- ================= MITRA SECTION (RUNNING LOGO) ================= -->
    <section class="mitra-section">
      <div class="container">
        <h2 class="section-title">MITRA KAMI</h2>
      </div>

      <!-- Container untuk Marquee (Running Text style) -->
      <div class="marquee-wrapper">
        <div class="marquee-track">
          
          <!-- GROUP 1: Logo Asli -->
          <div class="marquee-group">
            <div v-for="(logo, index) in mitraLogos" :key="'a-'+index" class="logo-item">
              <img :src="logo" alt="Mitra Kampus" loading="lazy" />
            </div>
          </div>

          <!-- GROUP 2: Logo Duplikat (Agar looping seamless/tidak putus) -->
          <div aria-hidden="true" class="marquee-group">
            <div v-for="(logo, index) in mitraLogos" :key="'b-'+index" class="logo-item">
              <img :src="logo" alt="Mitra Kampus" loading="lazy" />
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useHead } from "#app";

useHead({
  title: "Beranda - SIM Ormawa UMPKU",
  meta: [
    {
      name: "description",
      content:
        "Sistem Informasi Manajemen Organisasi Mahasiswa untuk digitalisasi kegiatan.",
    },
  ],
});

// Daftar URL Logo Mitra
const mitraLogos = [
  '/mitra/logo1.png',
  '/mitra/logo2.png',
  '/mitra/logo3.jpeg',
  '/logo ormawa/1.png',
  '/logo ormawa/2.png',
  '/logo ormawa/3.png',
  '/logo ormawa/4.png',
  '/logo ormawa/5.png',
  '/logo ormawa/6.png',
  '/logo ormawa/7.png',
  '/logo ormawa/8.png',
  '/logo ormawa/9.png',
  '/logo ormawa/10.png'
];
</script>

<style scoped>
/* =================== VARIABEL =================== */
:root {
  --neon: #00ffc8;
  --blue-accent: #2ac0ff;
}

/* =================== HERO SECTION =================== */
.hero-section {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.hero-bg-container {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.hero-bg-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 1;
}

.hero-video-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
  z-index: 2;
}

.content-wrap {
  position: relative;
  z-index: 10;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 0 15px;
}

.hero-section h1 {
  font-size: clamp(30px, 6vw, 56px);
  font-weight: 900;
  font-family: "Oswald", "Times New Roman", serif;
  color: white;
  line-height: 1.1;
  margin-bottom: 0.5em;
  text-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
}

.subtitle {
  font-size: clamp(16px, 2vw, 20px);
  font-family: "times new roman", serif;
  color: rgba(255, 255, 255, 0.85);
  max-width: 800px;
  line-height: 1.4;
  margin-bottom: 2.5em;
}

.cta-primary {
  padding: 14px 32px;
  font-weight: 800;
  border-radius: 12px;
  color: #ffffff;
  text-decoration: none;
  transition: transform 0.3s ease-in-out;
  background: rgba(255, 255, 255, 0.2); 
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.4);
  font-family: 'Roboto', sans-serif;
}

.cta-primary:hover {
  transform: scale(1.05);
}

/* Animasi Fade In */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fade-in {
  animation: fadeIn 0.8s ease forwards;
  opacity: 0;
}
.delay-200 {
  animation-delay: 0.2s;
}
.delay-400 {
  animation-delay: 0.4s;
}

/* =================== MITRA SECTION (MARQUEE) =================== */
.mitra-section {
  margin-top: 20px;
  margin-bottom: 50px;
  text-align: center;
  overflow: hidden; /* Penting agar tidak scroll horizontal browser */
}

.mitra-section .section-title {
  font-size: 28px;
  font-family: "oswald", serif;
  font-weight: 800;
  color: rgb(0, 0, 0);
  margin-bottom: 40px;
}

/* Container Pembungkus */
.marquee-wrapper {
  position: relative;
  width: 200%;
  display: flex;
  overflow: hidden;
  user-select: none;
  /* Masking gradient kiri kanan agar terlihat halus saat muncul/hilang */
  mask-image: linear-gradient(
    to right,
    transparent,
    black 10%,
    black 90%,
    transparent
  );
  -webkit-mask-image: linear-gradient(
    to right,
    transparent,
    black 10%,
    black 90%,
    transparent
  );
}

/* Track yang bergerak */
.marquee-track {
  display: flex;
  gap: 3rem; /* Jarak antar grup logo */
  width: max-content; /* Lebar menyesuaikan isi */
  animation: scroll-left 40s linear infinite; /* Kecepatan animasi (makin besar makin pelan) */
}

/* Grup Logo */
.marquee-group {
  display: flex;
  align-items: center;
  justify-content: space-around;
  gap: 3rem; /* Jarak antar logo individual */
  min-width: 100%;
}

/* Styling Item Logo individual */
.logo-item img {
  height: 150px; /* Tinggi logo seragam */
  width: auto;
  object-fit: contain;
  opacity: 0.7;
  filter: grayscale(100%);
  transition: all 0.3s ease;
  cursor: pointer;
}

.logo-item img:hover {
  opacity: 1;
  filter: grayscale(0%);
  transform: scale(1.1);
}

/* Keyframes untuk pergerakan */
@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%); /* Geser setengah karena kita punya 2 grup duplikat */
  }
}

/* Optional: Pause saat hover */
.marquee-wrapper:hover .marquee-track {
  animation-play-state: paused;
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .marquee-track {
    gap: 1.5rem;
    animation-duration: 25s; /* Lebih cepat sedikit di mobile */
  }
  .marquee-group {
    gap: 1.5rem;
  }
  .logo-item img {
    height: 60px; /* Logo lebih kecil di mobile */
  }
}
</style>