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

    <nav class="menu-list" :class="{ 'menu-open': menuOpen }">
      <div class="menu-close-btn" @click="menuOpen = false">X</div>

      <div class="menu-section">
        <div class="menu-title" @click="toggleSection('berita')">BERITA</div>

        <div class="submenu" v-if="openSection === 'berita'">
          <NuxtLink to="/berita" class="submenu-item" @click="menuOpen = false">
            SEMUA BERITA
          </NuxtLink>
          <NuxtLink
            to="/berita-terbaru"
            class="submenu-item"
            @click="menuOpen = false"
          >
            BERITA TERBARU
          </NuxtLink>
          <NuxtLink
            to="/upload-berita"
            class="submenu-item"
            @click="menuOpen = false"
          >
            UPLOAD BERITA
          </NuxtLink>
        </div>
      </div>

      <div class="menu-section">
        <div class="menu-title" @click="toggleSection('fitur')">FITUR</div>

        <div class="submenu" v-if="openSection === 'fitur'">
          <NuxtLink to="/fitur" class="submenu-item" @click="menuOpen = false">
            SEMUA FITUR
          </NuxtLink>
          <NuxtLink
            to="/fitur/pengajuan"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR PENGAJUAN
          </NuxtLink>
          <NuxtLink
            to="/fitur/formdetail"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR FORM DETAIL
          </NuxtLink>
          <NuxtLink
            to="/fitur/uploaddokumen"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR UPLOAD DOKUMEN
          </NuxtLink>
          <NuxtLink
            to="/fitur/notifikasi"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR NOTIFIKASI REVISI
          </NuxtLink>
          <NuxtLink
            to="/fitur/tracking"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR TRACKING REAL TIME
          </NuxtLink>
          <NuxtLink
            to="/fitur/download"
            class="submenu-item"
            @click="menuOpen = false"
          >
            FITUR DOWNLOAD
          </NuxtLink>
        </div>
      </div>

      <div class="menu-section">
        <div class="menu-title" @click="toggleSection('kontak')">KONTAK</div>

        <div class="submenu" v-if="openSection === 'kontak'">
          <NuxtLink to="/kontak" class="submenu-item" @click="menuOpen = false">
            HUBUNGI KAMI
          </NuxtLink>
        </div>
      </div>

      <div class="menu-auth-group">
        <NuxtLink to="/login" class="menu-item menu-login-btn">
          LOGIN
        </NuxtLink>
        <NuxtLink to="/register" class="menu-item menu-register-label">
          REGISTER
        </NuxtLink>
      </div>
    </nav>

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
        <NuxtLink to="https://pdsi.umpku.ac.id/" target="_blank"
          >PDSI UMPKU</NuxtLink
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
const openSection = ref(null); // Variabel state untuk submenu

// Fungsi untuk toggle submenu
const toggleSection = (section) => {
  openSection.value = openSection.value === section ? null : section;
};

// Definisi handleScroll
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

/* ================= MENU LIST/SIDEBAR STYLING ================= */
/* Anda perlu menambahkan styling untuk membuat menu ini menjadi sidebar yang bisa dibuka/ditutup */
.menu-list {
  /* Contoh styling dasar untuk sidebar (asumsi Anda akan menyempurnakannya) */
  position: fixed;
  top: 0;
  left: 0;
  width: 300px; /* Lebar sidebar */
  height: 100%;
  background-color: #ffffff;
  padding: 70px 20px 20px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
  transform: translateX(-100%); /* Sembunyikan secara default */
  transition: transform 0.3s ease-out;
  z-index: 1000;
  overflow-y: auto;
}

.menu-list.menu-open {
  transform: translateX(0); /* Tampilkan saat menuOpen true */
}

.menu-close-btn {
  position: absolute;
  top: 20px;
  left: 20px; /* ← dari right: 20px menjadi left: 20px */
  font-size: 24px;
  cursor: pointer;
  color: #1f2937;
}

/* Akhir dari asumsi styling sidebar */

.menu-section {
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  padding-top: 20px;
  margin-bottom: 10px;
}

.menu-title {
  font-size: 18px;
  font-weight: 600;
  color: #000;
  cursor: pointer;
  transition: 0.2s;
}

.menu-title:hover {
  color: var(--neon);
  transform: translateX(5px);
}

/* === SUBMENU === */
.submenu {
  margin-top: 10px;
  display: flex;
  flex-direction: column;
}

.submenu-item {
  font-size: 13px;
  color: #000;
  padding: 3px 0;
  padding-left: 10px;
  opacity: 0.8;
  text-decoration: none;
  transition: 0.2s ease;
}

.submenu-item:hover {
  opacity: 1;
  color: var(--neon);
  transform: translateX(5px);
}

.menu-auth-group {
  /* Tambahkan styling untuk bagian login/register */
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  padding-top: 20px;
  margin-top: 20px;
}

.menu-item {
  display: block;
  padding: 10px 0;
  text-decoration: none;
  text-align: center;
  margin-bottom: 10px;
  font-weight: 600;
  border-radius: 5px;
  transition: 0.2s;
}

.menu-login-btn {
  background-color: #1f2937;
  color: #ffffff;
}

.menu-login-btn:hover {
  background-color: var(--neon);
  color: #000;
}

.menu-register-label {
  background-color: #f3f4f6;
  color: #1f2937;
  border: 1px solid #d1d5db;
}

.menu-register-label:hover {
  background-color: #d1d5db;
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
}
</style>
