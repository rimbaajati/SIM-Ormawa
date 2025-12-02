<template>
  <div>
    <div
      v-if="isLoading"
      :class="['loading-overlay', { 'fade-out': !isLoading }]"
    >
      <div class="loading-content">
        <img src="/logo.png" alt="Loading Logo" class="loading-logo" />
      </div>
    </div>

    <header class="nav fixed w-full z-50">
      <div class="nav-left">
        <button class="menu-btn" @click="menuOpen = true">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
      </div>

      <NuxtLink to="/" class="nav-center nav-center-link">
        <span class="nav-subtitle">SISTEM INFORMASI ORMAWA</span>
        <span class="nav-title">UMPKU SURAKARTA</span>
      </NuxtLink>

      <div class="nav-right">
        <NuxtLink to="/" class="logo-link">
          <img src="/logo-atas.png" alt="Logo" class="nav-logo" />
        </NuxtLink>
      </div>
    </header>

    <div v-if="menuOpen" class="menu-overlay" @click.self="menuOpen = false">
      <div class="menu-sidebar">
        <button class="close-btn" @click="menuOpen = false">✕</button>

        <nav class="menu-list">
          <NuxtLink to="/berita" class="menu-item" @click="menuOpen = false">
            BERITA
          </NuxtLink>

          <NuxtLink to="/fitur" class="menu-item" @click="menuOpen = false">
            FITUR
          </NuxtLink>

          <NuxtLink to="/kontak" class="menu-item" @click="menuOpen = false">
            KONTAK
          </NuxtLink>

          <div class="menu-auth-group">
            <NuxtLink
              to="/login"
              class="menu-item menu-login-btn"
              @click="menuOpen = false"
            >
              LOGIN
            </NuxtLink>
            <NuxtLink
              to="/register"
              class="menu-item menu-register-label"
              @click="menuOpen = false"
            >
              REGISTER
            </NuxtLink>
          </div>
        </nav>
      </div>
    </div>

    <main class="site-body">
      <slot />
    </main>

    <footer class="footer-center">
      <img src="/logo.png" alt="Logo" class="fc-logo-top" />

      <nav class="fc-menu">
        <NuxtLink to="https://pmb.umpku.ac.id/" target="_blank"
          >PMB UMPKU</NuxtLink
        >
        <NuxtLink to="https://mylms.umpku.ac.id/" target="_blank"
          >LMS UMPKU</NuxtLink
        >
        <NuxtLink
          to="https://myakademik.itspku.ac.id/site/login"
          target="_blank"
          >My Akademik</NuxtLink
        >
        <NuxtLink to="https://umpku.ac.id/" target="_blank"
          >UMPKU Surakarta</NuxtLink
        >
      </nav>

      <p class="fc-disclaimer">
        Email: <a href="mailto:info@umpku.ac.id">info@umpku.ac.id</a><br />
        Telp: 0271 734955
      </p>

      <p class="fc-copy">
        Copyright © {{ new Date().getFullYear() }} SIM ORMAWA UMPKU. All Rights
        Reserved.
      </p>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const menuOpen = ref(false);
const isLoading = ref(true);

// Definisi handleScroll di luar onMounted untuk akses yang lebih baik
const handleScroll = () => {
  const nav = document.querySelector(".nav");
  if (!nav) return;

  if (window.scrollY > 50) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
};

onMounted(() => {
  // Loading fade-out
  setTimeout(() => {
    isLoading.value = false;
  }, 2000);

  // Jalankan handleScroll saat mount untuk kondisi awal
  handleScroll();

  // Scroll event → ubah navbar
  window.addEventListener("scroll", handleScroll);
});

// Bersihkan event saat component unmount
onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
:root {
  --neon: #00e0ff;
}

/* ================= LOADING PAGE (TETAP) ================= */
.loading-overlay {
  position: fixed;
  inset: 0;
  background: #000000;
  z-index: 100000;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  opacity: 1;
  transition: opacity 0.5s ease-out, visibility 1s ease-out;
}

.loading-overlay.fade-out {
  opacity: 0;
  visibility: hidden;
}

.loading-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  animation: logoFadeIn 1.5s ease-out forwards;
}

.loading-logo {
  width: 200px;
  height: auto;
}

@keyframes logoFadeIn {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  50% {
    opacity: 1;
    transform: scale(1.1);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

/* ================= NAVBAR (DEFAULT / BELUM SCROLL) ================= */
.nav {
  background: #ffffff;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  border-bottom: 2px solid #dcdcdc;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
  transition: background 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

/* RAPIKAN NAV LEFT / CENTER / RIGHT */
.nav-left {
  width: 80px;
  display: flex;
  align-items: center;
}

.nav-center {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  line-height: 1.2;
  transition: color 0.3s ease;
}

/* SUBTITLE (ATAS) */
.nav-subtitle {
  font-size: 12px;
  font-family: "Audiowide", cursive;
  letter-spacing: 0.12em;
  color: #1f2937;
  margin-bottom: 2px;
  display: block;
  transition: 0.3s;
}

/* TITLE (BAWAH) */
.nav-title {
  font-size: 24px;
  font-family: "Times New Roman", serif;
  font-weight: 700;
  color: #1f2937;
  margin-top: 0;
  display: block;
  transition: 0.3s;
}

.nav-right {
  width: 90px;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

/* LOGO default */
.nav-logo {
  height: 45px;
  width: auto;
  object-fit: contain;
  filter: brightness(0); /* hitam */
  transition: 0.3s ease;
}

/* ================= HAMBURGER ================= */
.menu-btn {
  background: none;
  border: none;
  cursor: pointer;
  padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.menu-btn .bar {
  width: 22px;
  height: 3px;
  background: #1f2937;
  border-radius: 4px;
  transition: 0.3s ease;
}

/* ================= NAVBAR SCROLL ================= */
.nav.scrolled {
  background: rgba(0, 0, 0, 0.85);
  border-color: orange;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
}

/* Tekst & logo berubah putih */
.nav.scrolled .nav-title,
.nav.scrolled .nav-subtitle {
  color: #ffffff !important;
}

.nav.scrolled .nav-logo {
  filter: brightness(10);
}

.nav.scrolled .menu-btn .bar {
  background: #ffffff;
}

/* 🚀 ================= MENU OVERLAY (PERUBAHAN DISINI) ================= 🚀 */
.menu-overlay {
  position: fixed;
  inset: 0;
  /* Warna latar belakang transparan agar konten di belakangnya terlihat */
  background: lch(0% 0 0 / 0.5);
  z-index: 99999;
  padding: 0;
  color: white;
  animation: fadeIn 0.3s ease;
}

/* Kontainer Sidebar Sebenarnya */
.menu-sidebar {
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  /* Lebar Sidebar */
  width: 320px;
  max-width: 90vw; /* Responsif */
  background: #ffffff; /* Warna gelap baru untuk sidebar */
  padding: 25px 30px;
  box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
  transform: translateX(0); /* Pastikan muncul dari kiri */
  transition: transform 0.3s ease-out;
  display: flex;
  flex-direction: column;
}

/* Jika Anda ingin animasi slide-in (optional, menuOpen v-if sudah cukup) */
.menu-overlay:not(.fade-out) .menu-sidebar {
  transform: translateX(0);
}

/* Tombol Close */
.close-btn {
  background: none;
  border: none;
  font-size: 18px; /* Lebih kecil */
  color: rgb(0, 0, 0);
  cursor: pointer;
  margin-bottom: 25px;
  text-align: left;
  padding: 0;
}
.close-btn:hover {
  color: var(--neon);
}

/* Daftar Menu */
.menu-list {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
  padding-bottom: 30px;
  font-family: "Roboto", sans-serif;
}

.menu-list > a:not(.menu-auth-group *) {
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  padding-top: 20px;
  padding-bottom: 5px;
}

.menu-item {
  font-size: 20px;
  font-weight: 500;
  text-decoration: none;
  color: rgb(0, 0, 0);
  transition: 0.3s;
  display: block;
}
.menu-item:hover {
  color: var(--neon);
  transform: translateX(5px); /* Geser sedikit saat hover */
}

/* Grup Login/Register di bagian bawah */
.menu-auth-group {
  margin-top: auto; /* Mendorong ke bawah */
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  padding-top: 20px;
  display: flex;
  flex-direction: column;
}

/* Item menu duplikat FITUR & KONTAK yang terpisah dari group auth */
.menu-duplicate {
  opacity: 0.5; /* Dibuat lebih pudar seperti di gambar */
}

/* Style untuk link REGISTER di dalam group auth */
.menu-auth-group .menu-item:first-child {
  font-weight: 600;
  font-size: 13px;
  padding-bottom: 10px;
}

/* === LIQUID GLASS LOGIN BUTTON (SMALL VERSION) === */
.menu-login-btn {
  background: rgba(0, 0, 0, 0.1);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.22);
  text-align: center;
  padding: 8px 0; /* lebih kecil */
  margin-bottom: 10px;
  border-radius: 8px; /* sama seperti register */
  font-weight: 600;
  font-size: 13px; /* diperkecil */
  color: rgb(0, 0, 0);
  box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
  transition: 0.25s;
}

.menu-login-btn:hover {
  background: rgba(0, 0, 0, 0.18);
  border-color: rgba(0, 0, 0, 0.35);
  transform: translateY(-2px);
}

/* === LIQUID GLASS REGISTER LABEL === */
.menu-register-label {
  background: rgba(0, 0, 0, 0.08);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(0, 0, 0, 0.18);
  text-align: center;
  padding: 8px 0;
  border-radius: 8px;
  font-size: 13px;
  color: #000000;
  transition: 0.3s;
}

.menu-register-label:hover {
  background: rgba(0, 0, 0, 0.18);
  border-color: rgba(255, 255, 255, 0.35);
  transform: translateY(-2px);
}

/* ================= BODY (TETAP) ================= */
body {
  background: #301d0b !important;
}

.site-body {
  padding-top: 70px !important;
  min-height: 100vh;
}

.site-body > *:first-child {
  margin-top: 0 !important;
  padding-top: 0 !important;
}

/* ====================== FOOTER (TETAP) ====================== */

.footer-center {
  background: #000;
  text-align: center;
  padding: 60px 20px;
  color: #ccc;
  font-family: "Segoe UI", sans-serif;
}

.fc-logo-top {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 180px;
  margin-bottom: 25px;
  opacity: 0.9;
}

.fc-menu {
  display: flex;
  justify-content: center;
  gap: 25px;
  flex-wrap: wrap;
  margin-bottom: 35px;
}

.fc-menu a {
  color: #ddd;
  font-size: 15px;
  text-decoration: none;
  transition: 0.2s;
}

.fc-menu a:hover {
  color: white;
}

.fc-disclaimer {
  max-width: 800px;
  margin: auto;
  font-size: 14px;
  line-height: 1.6;
  color: #aaa;
  margin-bottom: 40px;
}

.fc-disclaimer a {
  color: var(--neon);
  text-decoration: none;
}
.fc-disclaimer a:hover {
  text-decoration: underline;
}

.fc-copy {
  font-size: 14px;
  color: #888;
}

.copyright {
  text-align: center;
  padding-top: 15px;
  font-size: 14px;
  opacity: 0.7;
}

/* ================= RESPONSIVE (UPDATE) ================= */
@media (max-width: 900px) {
  .footer-grid {
    grid-template-columns: 1fr 1fr;
  }

  .menu-logo-big {
    display: none;
  }
}

@media (max-width: 600px) {
  .footer-grid {
    grid-template-columns: 1fr;
  }
  /* Jika di mobile, menu-sidebar bisa dibuat 100% lebar layar */
  .menu-sidebar {
    width: 100%;
  }
}
</style>