<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();

const menuOpen = ref(false);
const isLoading = ref(true);
const openSection = ref(null);
const nav = ref(null);
const isScrolled = ref(false);

// 1. Ambil status dari Store menggunakan computed
const isLoggedIn = computed(() => authStore.getIsLoggedIn);
const userName = computed(() => authStore.userName);

// 2. Fungsi Logout yang memanggil aksi dari Store
const logout = () => {
  authStore.logout();
  menuOpen.value = false;
  alert("Anda telah berhasil logout."); // Atau gunakan notifikasi yang lebih baik
};

// Fungsi untuk toggle submenu
const toggleSection = (section) => {
  openSection.value = openSection.value === section ? null : section;
};

// Fungsi untuk handle scroll
const handleScroll = () => {
  isScrolled.value = window.scrollY > 50; // Threshold scroll, bisa disesuaikan
};

onMounted(() => {
  // Panggil aksi inisialisasi untuk mengecek status token saat mount
  authStore.initializeAuth();

  // Loading fade-out
  setTimeout(() => {
    isLoading.value = false;
  }, 2000);

  // Tambahkan event listener untuk scroll
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  // Hapus event listener saat unmount
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
@import url('~/assets/css/layouts/default.css');
</style>

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

    <header
      ref="nav"
      class="nav fixed w-full z-50"
      :class="{ scrolled: isScrolled }"
    >
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
        <template v-if="!isLoggedIn">
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
        </template>
        <template v-else>
          <div class="menu-logged-in-info">👋 Halo, **{{ userName }}**!</div>
          <NuxtLink
            to="/profil"
            class="menu-item menu-profile-btn"
            @click="menuOpen = false"
          >
            UBAH PROFIL
          </NuxtLink>
          <div class="menu-item menu-logout-btn" @click="logout">LOGOUT</div>
        </template>
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
