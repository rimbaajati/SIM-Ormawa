<template>
  <div>
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
        <NuxtLink to="/search" class="search-btn search-link"> 🔍︎ </NuxtLink>

        <NuxtLink to="/" class="logo-link">
          <img src="/logo.png" alt="Logo" class="nav-logo" />
        </NuxtLink>
      </div>
    </header>

    <div v-if="menuOpen" class="menu-overlay">
      <button class="close-btn" @click="menuOpen = false">✕ Close</button>

      <nav class="menu-list">
        <NuxtLink to="/berita" class="menu-item" @click="menuOpen = false">
          BERITA ➜
        </NuxtLink>

        <NuxtLink to="/fitur" class="menu-item" @click="menuOpen = false">
          FITUR ➜
        </NuxtLink>

        <NuxtLink to="/kontak" class="menu-item" @click="menuOpen = false">
          KONTAK ➜
        </NuxtLink>
      </nav>

      <div class="menu-logo-big"></div>
    </div>

    <main class="site-body">
      <slot />
    </main>

    <footer class="footer-center">
      <img src="/logo-atas.png" alt="Logo" class="fc-logo-top" />

      <nav class="fc-menu">
        <NuxtLink to="/privacy">Privacy Policy</NuxtLink>
        <NuxtLink to="/terms">Terms of Service</NuxtLink>
        <NuxtLink to="/about">About Us</NuxtLink>
        <NuxtLink to="/contact">Contact Us</NuxtLink>
        <NuxtLink to="/help">Help Center</NuxtLink>
      </nav>

      <p class="fc-disclaimer">
        Seluruh merek dagang dan logo merupakan milik masing-masing
        pemiliknya.<br />
        Konten pada sistem ini dilindungi oleh undang-undang.
      </p>

      <p class="fc-copy">
        Copyright © {{ new Date().getFullYear() }} SIM ORMAWA UMPKU. All Rights
        Reserved.
      </p>
      
      </footer>
  </div>
</template>

<script setup>
import { ref } from "vue";

const menuOpen = ref(false);
</script>

<style scoped>
:root {
  --neon: #00e0ff;
}

/* ================= NAVBAR ================= */
.nav {
  background: #0b1230;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 15px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}

.nav-left {
  width: 80px;
  display: flex;
  align-items: center;
}

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
  display: block;
  width: 22px;
  height: 3px;
  background: white;
  border-radius: 4px;
  transition: 0.3s;
}

.menu-btn:hover .bar {
  background: var(--neon);
}

/* ========== TULISAN TENGAH (DIKEMBALIKAN SEPERTI SEMULA) ========== */
.nav-center {
  flex: 1;
  text-align: center;
  color: white;
  line-height: 1.2; /* kembali default */
  /* letter-spacing dihapus */
}

.nav-center-link {
  text-decoration: none;
  color: inherit;
  cursor: pointer;
}

.nav-center-link:hover .nav-title,
.nav-center-link:hover .nav-subtitle {
  color: var(--neon);
  transition: 0.3s;
}

.nav-subtitle {
  font-size: 13px;
  opacity: 1 !important;
  display: block;
  color: #ffffff !important;
}

.nav-title {
  font-size: 26px;
  font-weight: 700;
  font-family: "Times New Roman", serif;
  color: #ffffff !important;
}

/* ====================== KANAN (SEARCH + LOGO) ====================== */
.nav-right {
  width: 90px;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 14px;
}

.search-link {
  color: white;
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  transition: 0.3s;
  text-decoration: none;
  margin-right: 14px;
}

.search-link:hover {
  color: var(--neon);
}

.logo-link {
  display: flex;
  align-items: center;
}

.nav-logo {
  height: 32px;
  opacity: 0.9;
}

/* ================= MENU OVERLAY ================= */
.menu-overlay {
  position: fixed;
  inset: 0;
  background: #0b1230;
  z-index: 99999;
  padding: 40px;
  color: white;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.close-btn {
  background: none;
  border: none;
  font-size: 20px;
  color: white;
  cursor: pointer;
  margin-bottom: 40px;
}
.close-btn:hover {
  color: var(--neon);
}

.menu-list {
  display: flex;
  flex-direction: column;
  gap: 25px;
  margin-top: 30px;
}

.menu-item {
  font-size: 28px;
  font-weight: 600;
  text-decoration: none;
  color: white;
  transition: 0.3s;
}
.menu-item:hover {
  color: var(--neon);
  transform: translateX(10px);
}

/* Big faded logo like WhiteHouse */
.menu-logo-big {
  position: absolute;
  right: 80px;
  top: 120px;
  width: 430px;
  height: 430px;
  opacity: 0.05;
  background-image: url("/logo.png");
  background-size: contain;
  background-repeat: no-repeat;
  background-position: center;
}

/* ================= BODY ================= */
.site-body {
  padding-top: 90px;
  min-height: 100vh;
}

/* ====================== FOOTER GENSHIN STYLE ====================== */

.footer-center {
  background: #000;
  text-align: center;
  padding: 60px 20px;
  color: #ccc;
  font-family: "Segoe UI", sans-serif;
}

/* LOGO ATAS */
.fc-logo-top {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 180px;
  margin-bottom: 25px;
  opacity: 0.9;
}

/* MENU */
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

/* DISCLAIMER */
.fc-disclaimer {
  max-width: 800px;
  margin: auto;
  font-size: 14px;
  line-height: 1.6;
  color: #aaa;
  margin-bottom: 40px;
}

/* COPYRIGHT */
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

/* ================= RESPONSIVE ================= */
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