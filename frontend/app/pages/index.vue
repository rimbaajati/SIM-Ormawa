<template>
  <div class="main-page">
    
    <!-- 1. BAGIAN UTAMA (HERO SECTION) -->
    <section id="hero" class="hero-section container">
      <!-- Judul menggunakan gradient text (diasumsikan di main.css) -->
      <h1 class="animate-fade-in text-5xl font-extrabold tracking-tight">Selamat Datang di SIM Ormawa</h1>
      <p class="subtitle animate-fade-in delay-200 max-w-2xl">
        Sistem Informasi Manajemen Organisasi Mahasiswa Universitas Muhammadiyah Pontianak. Solusi terpadu untuk digitalisasi kegiatan dan transparansi organisasi Anda.
      </p>
      
      <!-- CTA Utama: Masuk -->
      <NuxtLink to="/login" class="cta-primary hover:scale-[1.05] transition-transform animate-fade-in delay-400">
        Masuk ke Sistem Sekarang &rarr;
      </NuxtLink>
    </section>

    <!-- 2. BAGIAN FITUR UTAMA (components/FiturSection.vue) -->
    <!-- Elemen ini akan menampilkan kartu-kartu fitur di bawah hero -->
    <FiturSection />


  </div>
</template>

<script setup>
/**
 * CATATAN: Komponen <FiturSection /> diimpor secara otomatis oleh Nuxt 3 
 * karena berada di folder 'components/'. 
 */

// Pengaturan metadata halaman (Judul dan Deskripsi)
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
/* --- Style Khusus Halaman Beranda (Menggunakan Skema Neon yang Asli) --- */

/* Variabel lokal untuk konsistensi */
:root {
  --neon: #00ffc8;
  --blue-accent: #2ac0ff;
  --text-dark: #08101a;
  --bg-primary: #08101a;
}

.container { 
    max-width: 1100px; 
    margin: 0 auto; 
    padding: 0 20px; 
}
.section-title { 
    text-align: center; 
    font-size: 28px; 
    margin: 18px 0 28px; 
    color: white; 
}

/* HERO SECTION - Pusat dari estetika */
.hero-section {
  min-height: 50vh; /* Sedikit lebih tinggi */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 100px 20px 80px;
}

.hero-section h1 {
  /* Menggunakan ukuran besar */
  font-size: clamp(30px, 6vw, 56px); 
  font-weight: 900;
  color: white;
  margin-bottom: 12px;
  line-height: 1.1;
  /* Tambahkan efek text shadow halus */
  text-shadow: 0 0 5px rgba(0, 255, 200, 0.2); 
}

.subtitle {
  font-size: clamp(16px, 2vw, 20px);
  color: rgba(255, 255, 255, 0.75);
  margin-bottom: 40px;
  line-height: 1.4;
}

/* --- CTA PRIMARY (Masuk) - Neon Primer --- */
.cta-primary {
  /* Gradien dari Neon ke Biru Muda (Dibuat lebih tebal) */
  background: linear-gradient(90deg, var(--neon) 0%, var(--blue-accent) 100%);
  color: var(--text-dark);
  padding: 14px 30px; 
  border-radius: 12px;
  font-weight: 800;
  text-decoration: none;
  /* Bayangan lebih tegas */
  box-shadow: 0 6px 25px rgba(0, 255, 200, 0.4); 
  transition: all 0.3s cubic-bezier(.2,.9,.3,1); /* Kurva transisi lebih bagus */
}
.cta-primary:hover {
  transform: translateY(-4px); /* Peningkatan efek hover */
  box-shadow: 0 10px 30px rgba(42, 192, 255, 0.8);
}

/* --- CTA SECTION (Gabung) - Bagian Footer CTA yang Keren --- */
.cta-section {
  text-align: center;
  padding: 80px 0; /* Padding lebih besar */
  margin-top: 80px; 
  /* Border pemisah lebih tipis dan halus */
  border-top: 1px solid rgba(255, 255, 255, 0.08); 
  background-color: rgba(0, 0, 0, 0.1); /* Sedikit latar belakang gelap transparan */
  border-radius: 10px;
}

.cta-section h2 {
  font-size: 32px;
  color: white;
  margin-bottom: 24px;
}

/* --- CTA SECONDARY (Daftar) - Neon Outline yang Jelas --- */
.cta-secondary {
  background: none;
  color: var(--neon);
  padding: 14px 30px;
  border-radius: 12px;
  font-weight: 700;
  border: 2px solid var(--neon); /* Border lebih tebal */
  text-decoration: none;
  transition: background 0.3s, transform 0.3s;
}
.cta-secondary:hover {
  background: rgba(0, 255, 200, 0.15); /* Isi latar saat di hover */
}

/* --- ANIMASI --- */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeIn 0.8s ease-out forwards;
    opacity: 0;
}
.delay-200 {
    animation-delay: 0.2s;
}
.delay-400 {
    animation-delay: 0.4s;
}
</style>