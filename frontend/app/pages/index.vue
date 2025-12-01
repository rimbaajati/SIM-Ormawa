<template>
  <div class="main-page">
    <!-- ================= HERO ================= -->
    <section id="hero" class="hero-section">
      <div class="hero-bg-container">
        <div class="hero-video-overlay"></div>

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
    <FiturSection />

    <!-- ================= MITRA SECTION (ONLY) ================= -->
    <section class="mitra-section container">
      <h2 class="section-title">Mitra Kami</h2>

      <div class="partners-grid">
        <img src="/mitra/logo1.png" alt="Mitra 1" loading="lazy" />
        <img src="/mitra/logo2.png" alt="Mitra 2" loading="lazy" />
        <img src="/mitra/logo3.jpeg" alt="Mitra 3" loading="lazy" />
        <img src="/logo.png" alt="Mitra 4" loading="lazy" />
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

/* Animasi */
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

/* =================== MITRA SECTION =================== */
.mitra-section {
  margin-top: 80px;
  margin-bottom: 100px;
  text-align: center;
}

.mitra-section .section-title {
  font-size: 28px;
  font-family: "times new roman", serif;
  font-weight: 800;
  color: rgb(0, 0, 0);
  margin-bottom: 25px;
}

.partners-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 25px;
  align-items: center;
}

.partners-grid img {
  width: 100%;
  max-width: 120px;
  opacity: 0.8;
  filter: grayscale(40%);
  transition: all 0.3s ease;
  display: block;
  margin: 0 auto;
}

.partners-grid img:hover {
  opacity: 1;
  filter: grayscale(0%);
  transform: scale(1.08);
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .partners-grid {
    justify-content: center;
  }
}
</style>
