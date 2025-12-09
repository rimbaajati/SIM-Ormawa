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
// const newsItems = [
//   {
//     id: 1,
//     title: "Pelantikan Pengurus Baru Ormawa Periode 2024/2025",
//     category: "Kegiatan Kampus",
//     dateDay: "12",
//     dateMonth: "Okt",
//     image: "https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
//     excerpt: "Universitas resmi melantik seluruh pengurus organisasi mahasiswa baru dengan semangat kolaborasi dan inovasi digital."
//   },
//   {
//     id: 2,
//     title: "Workshop Digitalisasi Administrasi Organisasi",
//     category: "Pelatihan",
//     dateDay: "05",
//     dateMonth: "Okt",
//     image: "https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
//     excerpt: "Pelatihan penggunaan sistem informasi manajemen baru untuk sekretaris dan bendahara ormawa."
//   },
//   {
//     id: 3,
//     title: "Prestasi Mahasiswa di Pekan Ilmiah Nasional",
//     category: "Prestasi",
//     dateDay: "28",
//     dateMonth: "Sep",
//     image: "https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
//     excerpt: "Delegasi UMPKU berhasil membawa pulang medali emas dalam kategori inovasi teknologi tepat guna."
//   }
// ];
</script>

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
          Selamat Datang di Sistem Informasi Manajemen<br />
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
    <!-- <section class="berita-section">
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
    </section> -->
  </div>
</template>

<style scoped>
@import url('~/assets/css/pages/index.css');
</style>