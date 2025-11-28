<template>
  <div>
    <header class="nav fixed w-full z-50">
      <div class="container nav-inner">
        <NuxtLink to="/" class="brand">
          <img
            src="/logo.png" 
            alt="Logo ORMAWA UMPKU"
            class="logo-header"
          />
          ORMAWA UMPKU
        </NuxtLink>

        <nav class="links">
          <NuxtLink to="/berita">Berita</NuxtLink>
          <NuxtLink to="/fitur">Fitur</NuxtLink>
          <NuxtLink to="/kontak">Kontak</NuxtLink>
        </nav>

        <div class="flex items-center gap-3">
          <NuxtLink to="/register" class="cta">Daftar</NuxtLink>
          <NuxtLink to="/login" class="cta">Masuk</NuxtLink>
        </div>
      </div>
    </header>

    <main class="site-body">
      <slot />
    </main>

    <footer class="footer">
      <div class="container footer-grid">
        <div class="footer-col">
          <img src="/logo.png" alt="Logo" class="footer-logo-img" /> 
          
          <h3 class="footer-title">SISTEM INFORMASI ORMAWA UMPKU SURAKARTA</h3>

          <p class="footer-text">
            Jl. Tulang Bawang Sel. No.26, Kadipiro, Kec. Banjarsari, Kota
            Surakarta, Jawa Tengah 57136<br />
            Email: info@umpku.ac.id<br />
            Telp: (0271) 734955
          </p>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Peta Lokasi</h3>
          <iframe
            class="map-box"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.3790819601186!2d110.8140317247632!3d-7.533568292479624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a1700245141fd%3A0x28f4257bb5c0e67f!2sUniversitas%20Muhammadiyah%20PKU%20Surakarta!5e0!3m2!1sid!2sid!4v1764230206659!5m2!1sid!2sid"
            allowfullscreen=""
            loading="lazy"
          >
          </iframe>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Layanan Sistem</h3>
          <ul class="footer-list">
            <li>
              <NuxtLink to="/layanan/pengajuan">Pengajuan Kegiatan</NuxtLink>
            </li>
            <li><NuxtLink to="/layanan/laporan">SPJ & LPJ</NuxtLink></li>
            <li>
              <NuxtLink to="/layanan/presensi">Presensi Anggota</NuxtLink>
            </li>
            <li><NuxtLink to="/layanan/database">Database Ormawa</NuxtLink></li>
          </ul>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Portal Informasi</h3>
          <ul class="footer-list">
            <li><NuxtLink to="/berita">Berita</NuxtLink></li>
            <li><NuxtLink to="/agenda">Agenda</NuxtLink></li>
            <li><NuxtLink to="/beasiswa">Beasiswa</NuxtLink></li>
            <li><NuxtLink to="/kemahasiswaan">Kemahasiswaan</NuxtLink></li>
          </ul>
        </div>
      </div>

      <div class="copyright">
        Copyright © {{ new Date().getFullYear() }} SIM ORMAWA UMPKU
      </div>
    </footer>
  </div>
</template>

<script setup></script>

<style scoped>
/* (Kode CSS Anda tetap sama dan sudah benar) */

:root {
  --neon: #00e0ff;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

.nav {
  background: rgba(87, 87, 87, 0.685);
  border-bottom: 1px solid rgba(0, 0, 0, 0.158);
  backdrop-filter: blur(10px);
}
.nav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 72px;
}
.brand {
  display: flex;
  align-items: center; 
  color: white;
  font-weight: 800;
  letter-spacing: 1px;
  font-size: 20px;
  text-decoration: none; 
}

.logo-header {
  height: 32px; 
  width: auto; 
  margin-right: 8px; 
}

.links a {
  color: rgba(255, 255, 255, 0.78);
  margin-left: 18px;
  text-decoration: none;
  font-weight: 600;
  transition: 0.2s;
}
.links a:hover {
  color: var(--neon);
}
.cta {
  background: linear-gradient(90deg, var(--neon) 100%, #000000 100%);
  color: #08101a;
  padding: 10px 14px;
  border-radius: 10px;
  font-weight: 700;
}
.site-body {
  padding-top: 92px;
}

.footer {
  background: #0d0f13;
  padding: 50px 0 25px;
  color: white;
  margin-top: 60px;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}

/* GRID 4 KOLOM */
.footer-grid {
  display: grid;
  grid-template-columns: 1.2fr 1fr 0.8fr 0.8fr;
  gap: 40px;
}

.footer-col {
  line-height: 1.6;
}

.footer-logo-img { 
  height: 40px; 
  width: auto;
  opacity: 0.9;
  margin-bottom: 10px;
}

.footer-title {
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 15px;
}

.footer-text {
  font-size: 14px;
  opacity: 0.8;
}

/* LIST */
.footer-list {
  list-style: none;
  padding: 0;
}

.footer-list li {
  margin-bottom: 8px;
}

.footer-list a {
  color: rgba(255, 255, 255, 0.78);
  text-decoration: none;
}

.footer-list a:hover {
  color: var(--neon);
}

/* MAP */
.map-box {
  width: 100%;
  height: 180px;
  border: none;
  border-radius: 8px;
}

/* COPYRIGHT */
.copyright {
  text-align: center;
  margin-top: 25px;
  padding-top: 15px;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  font-size: 14px;
  opacity: 0.7;
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .footer-grid {
    grid-template-columns: 1fr 1fr;
  }
}
@media (max-width: 600px) {
  .footer-grid {
    grid-template-columns: 1fr;
  }
}
</style>