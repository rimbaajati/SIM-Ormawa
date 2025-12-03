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

    <!-- ================= MITRA SECTION (RUNNING LOGO) ================= -->
    <section class="mitra-section">
  <div class="container">
    <h2 class="section-title">MITRA KAMI</h2>
  </div>

  <div class="marquee-wrapper">
    <div class="marquee-track">

      <!-- GROUP 1 -->
      <div class="marquee-group">
        <div v-for="(logo, index) in mitraLogos" :key="'a-'+index" class="logo-item">
          <a :href="logo.url" target="_blank" rel="noopener noreferrer">
            <img :src="logo.src" alt="Mitra Kampus" loading="lazy" />
          </a>
        </div>
      </div>

      <!-- GROUP 2 (Clone) -->
      <div aria-hidden="true" class="marquee-group">
        <div v-for="(logo, index) in mitraLogos" :key="'b-'+index" class="logo-item">
          <a :href="logo.url" target="_blank" rel="noopener noreferrer">
            <img :src="logo.src" alt="Mitra Kampus" loading="lazy" />
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


    <!-- ================= BERITA SECTION ================= -->
    <section class="berita-section">
      <div class="container">
        <h2 class="section-title">BERITA TERBARU</h2>
        
        <div class="news-grid">
          <div v-for="(news, index) in newsItems" :key="index" class="news-card">
            <div class="news-image-wrapper">
              <img :src="news.image" :alt="news.title" loading="lazy" />
              <div class="news-date">
                <span class="date-day">{{ news.dateDay }}</span>
                <span class="date-month">{{ news.dateMonth }}</span>
              </div>
            </div>
            <div class="news-content">
              <span class="news-category">{{ news.category }}</span>
              <h3 class="news-title">
                <NuxtLink :to="`/berita/${news.id}`">{{ news.title }}</NuxtLink>
              </h3>
              <p class="news-excerpt">{{ news.excerpt }}</p>
              <NuxtLink :to="`/berita/${news.id}`" class="read-more">
                Baca Selengkapnya &rarr;
              </NuxtLink>
            </div>
          </div>
        </div>

        <div class="text-center mt-12">
          <NuxtLink to="/berita" class="btn-secondary">
            Lihat Semua Berita
          </NuxtLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>

// Daftar URL Logo Mitra
const mitraLogos = [
  { src: '/mitra/logo1.png', url: 'https://www.instagram.com/dpm_umpku/' },
  { src: '/mitra/logo2.png', url: 'https://www.instagram.com/bem_umpku/' },
  { src: '/mitra/logo3.jpeg', url: 'https://www.instagram.com/himanes_umpku/' },
  { src: '/logo ormawa/1.png', url: 'https://www.instagram.com/himatif.umpku/' },
  { src: '/logo ormawa/2.png', url: 'https://www.instagram.com/ksr_umpku/' },
  { src: '/logo ormawa/3.png', url: 'https://www.instagram.com/hima.ners_umpku/' },
  { src: '/logo ormawa/4.png', url: '#' },
  { src: '/logo ormawa/5.png', url: '#'},
  { src: '/logo ormawa/6.png', url: 'https://www.instagram.com/immalfatih.umpku/' },
  { src: '/logo ormawa/7.png', url: '#' },
  { src: '/logo ormawa/8.png', url: 'https://www.instagram.com/himagizi.umpku/' },
  { src: '/logo ormawa/9.png', url: 'https://www.instagram.com/himabid_umpku/' },
  { src: '/logo ormawa/10.png', url: 'https://www.instagram.com/himaper.umpku/' }
];


// Data Dummy Berita
const newsItems = [
  {
    id: 1,
    title: "Pelantikan Pengurus Baru Ormawa Periode 2024/2025",
    category: "Kegiatan Kampus",
    dateDay: "12",
    dateMonth: "Okt",
    image: "https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
    excerpt: "Universitas resmi melantik seluruh pengurus organisasi mahasiswa baru dengan semangat kolaborasi dan inovasi digital."
  },
  {
    id: 2,
    title: "Workshop Digitalisasi Administrasi Organisasi",
    category: "Pelatihan",
    dateDay: "05",
    dateMonth: "Okt",
    image: "https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
    excerpt: "Pelatihan penggunaan sistem informasi manajemen baru untuk sekretaris dan bendahara ormawa."
  },
  {
    id: 3,
    title: "Prestasi Mahasiswa di Pekan Ilmiah Nasional",
    category: "Prestasi",
    dateDay: "28",
    dateMonth: "Sep",
    image: "https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
    excerpt: "Delegasi UMPKU berhasil membawa pulang medali emas dalam kategori inovasi teknologi tepat guna."
  }
];
</script>

<style scoped>
/* =================== VARIABEL =================== */
:root {
  --neon: #00ffc8;
  --blue-accent: #2ac0ff;
  --text-dark: #1a1a1a;
  --text-gray: #666;
}

/* =================== HERO SECTION =================== */
.hero-section {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  z-index: 1;
}

.hero-bg-container {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 80%;
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
  height: 80%;
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
  line-height: 1,1;
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
  backdrop-filter: blur(10px);
}

.cta-primary:hover {
  transform: scale(1.05);
  background: rgba(255, 255, 255, 0.3);
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
  position: relative;
  z-index: 10;
  margin-top: -150px;
  margin-bottom: 0;
  text-align: center;
  overflow: hidden; 
  /* background: #fff;  */
  padding-top: 50px;
  padding-bottom: 50px;
}

.mitra-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%; /* Mengisi seluruh section */
  /* Gradasi dari transparan ke putih solid di bagian atas */
  background: linear-gradient(to bottom, transparent 0%, #ffffff 25%, #ffffff 100%);
  z-index: -1; /* Di belakang konten teks/logo */
  pointer-events: none;
}

.mitra-section .section-title {
  font-size: 28px;
  font-family: "oswald", serif;
  font-weight: 800;
  color: rgb(0, 0, 0);
  margin-bottom: 40px;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: relative;
}

/* Container Pembungkus */
.marquee-wrapper {
  position: relative;
  width: 100%;
  display: flex;
  overflow: hidden;
  user-select: none;
  mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
  -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
}

/* Track yang bergerak */
.marquee-track {
  display: flex;
  flex-direction: row;
  width: max-content;
  animation: scroll-left 50s linear infinite;
  will-change: transform;
  transform: translateZ(0);
}

/* Grup Logo */
.marquee-group {
  display: flex;
  align-items: center;
  gap: 4rem; 
  padding-right: 4rem; 
  min-width: 100%;
  flex-shrink: 0;
}

/* Styling Item Logo */
.logo-item img {
  height: 80px; 
  width: auto;
  object-fit: contain;
  opacity: 0.6;
  filter: grayscale(100%);
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  cursor: pointer;
  -webkit-user-drag: none;
  backface-visibility: hidden;
}

.logo-item img:hover {
  opacity: 1;
  filter: grayscale(0%);
  transform: scale(1.15);
}

@keyframes scroll-left {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

.marquee-wrapper:hover .marquee-track {
  animation-play-state: paused;
}

/* =================== BERITA SECTION =================== */
.berita-section {
  position: relative; /* Penting untuk pseudo-element */
  padding: 80px 0;
  background-color: rgb(53, 52, 52); /* Warna Gelap Berita */
}

.berita-section::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 150px; /* Panjang area gradasi */
  /* Dari Putih (Mitra) ke Warna Background Berita */
  background: linear-gradient(to bottom, #ffffff 0%, rgb(53, 52, 52) 100%);
  z-index: 1;
  pointer-events: none;
}

/* Agar konten berita berada di atas layer gradasi */
.berita-section .container {
  position: relative;
  z-index: 2;
}

.berita-section .section-title {
  font-size: 28px;
  font-family: "oswald", serif;
  font-weight: 800;
  color: #f05501;
  margin-bottom: 50px;
  text-transform: uppercase;
  letter-spacing: 2px;
  text-align: center;
}

.news-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
  padding: 0 15px;
}

.news-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.news-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.news-image-wrapper {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.news-image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.news-card:hover .news-image-wrapper img {
  transform: scale(1.05);
}

.news-date {
  position: absolute;
  top: 15px;
  right: 15px;
  background: white;
  padding: 8px 12px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  font-family: 'Oswald', sans-serif;
}

.date-day {
  font-size: 1.2rem;
  font-weight: 700;
  color: #1a1a1a;
  line-height: 1;
}

.date-month {
  font-size: 0.75rem;
  text-transform: uppercase;
  color: #666;
  font-weight: 500;
}

.news-content {
  padding: 24px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.news-category {
  font-size: 0.75rem;
  font-weight: 600;
  color: #2ac0ff; /* Sesuai warna aksen di root */
  text-transform: uppercase;
  margin-bottom: 8px;
  letter-spacing: 0.5px;
}

.news-title {
  margin: 0 0 12px 0;
  font-size: 1.25rem;
  line-height: 1.4;
  font-family: 'Oswald', sans-serif;
  font-weight: 700;
}

.news-title a {
  color: #1a1a1a;
  text-decoration: none;
  transition: color 0.2s;
}

.news-title a:hover {
  color: #007bff;
}

.news-excerpt {
  color: #666;
  font-size: 0.95rem;
  line-height: 1.6;
  margin-bottom: 20px;
  flex-grow: 1;
  font-family: 'Roboto', sans-serif;
}

.read-more {
  color: #1a1a1a;
  font-weight: 600;
  text-decoration: none;
  font-size: 0.9rem;
  display: inline-flex;
  align-items: center;
  transition: gap 0.2s;
  font-family: 'Roboto', sans-serif;
}

.read-more:hover {
  gap: 5px;
  color: #007bff;
}

.btn-secondary {
  display: inline-block;
  padding: 12px 30px;
  border: 2px solid #1a1a1a;
  border-radius: 8px;
  color: #1a1a1a;
  font-weight: 700;
  text-decoration: none;
  transition: all 0.3s ease;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.btn-secondary:hover {
  background: #1a1a1a;
  color: white;
}

.mt-12 { margin-top: 3rem; }
.text-center { text-align: center; }

/* RESPONSIVE */
@media (max-width: 768px) {
  .marquee-track { animation-duration: 30s; }
  .marquee-group { gap: 2rem; padding-right: 2rem; }
  .logo-item img { height: 60px; }
  .mitra-section .section-title, .berita-section .section-title { font-size: 24px; margin-bottom: 25px; }
  .news-grid { gap: 20px; }
}
</style>