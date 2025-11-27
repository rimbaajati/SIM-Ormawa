<template>
  <div>
    <header class="nav fixed w-full z-50">
      <div class="container nav-inner">
        <NuxtLink to="/" class="brand">ORMAWA UMPKU</NuxtLink>

        <nav class="links">
          <NuxtLink to="/berita">Berita</NuxtLink>
          <NuxtLink to="/fitur">Fitur</NuxtLink>
          <NuxtLink to="#kontak">Kontak</NuxtLink>
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
          <img src="/logo.png" alt="Logo" class="h-10" />
          <h3 class="footer-title">SIM ORMAWA UMPKU</h3>

          <p class="footer-text">
            Jl. Raya Sindang, Kuningan, Jawa Barat 45562<br />
            Email: ormawa@umpku.ac.id<br />
            Telp: (0232) 123456
          </p>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Peta Lokasi</h3>

          <iframe
            class="map-box"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.4641908759367!2d108.43577547501066!3d-6.837373893158098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1f49615a9757%3A0x6b9d62d2907409c9!2sUniversitas%20Muhammadiyah%20Kuningan!5e0!3m2!1sid!2sid!4v1700994000000!5m2!1sid!2sid"
            allowfullscreen=""
            loading="lazy"
          >
          </iframe>
        </div>

        <div class="footer-col">
          <h3 class="footer-title">Layanan Sistem</h3>
          <ul class="footer-list">
            <li><NuxtLink to="/layanan/pengajuan">Pengajuan Kegiatan</NuxtLink></li>
            <li><NuxtLink to="/layanan/laporan">SPJ & LPJ</NuxtLink></li>
            <li><NuxtLink to="/layanan/presensi">Presensi Anggota</NuxtLink></li>
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

      <div class="social-area">
        <div class="social-icons">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-x-twitter"></i>
          <i class="fab fa-youtube"></i>
          <i class="fab fa-linkedin"></i>
          <i class="fab fa-tiktok"></i>
          <i class="fab fa-instagram"></i>
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
/* --------------------------- */
/* CSS Variable untuk Neon Color */
/* --------------------------- */
/* Tambahkan ini untuk mendefinisikan --neon agar styling .cta dan :hover berfungsi */
:root {
  --neon: #00e0ff; /* Contoh warna neon */
}

/* --------------------------- */
/* CONTAINER GLOBAL */
/* --------------------------- */
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

/* --------------------------- */
/* NAVBAR */
/* --------------------------- */
.nav {
  background: rgba(6, 10, 20, 0.65);
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(10px);
}
.nav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 72px;
}
.brand {
  color: white;
  font-weight: 800;
  letter-spacing: 1px;
  font-size: 20px;
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
  /* Menggunakan --neon dari CSS Variable */
  background: linear-gradient(90deg, var(--neon) 0%, #2ac0ff 100%); 
  color: #08101a;
  padding: 10px 14px;
  border-radius: 10px;
  font-weight: 700;
}
.site-body {
  padding-top: 92px;
}

/* --------------------------- */
/* FOOTER */
/* --------------------------- */
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

.footer-logo {
  width: 80px;
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

/* SOSIAL MEDIA */
.social-area {
  text-align: center;
  margin-top: 50px;
}
.social-area h3 {
  margin-bottom: 12px;
  font-size: 18px;
}
.social-icons {
  display: flex;
  justify-content: center;
  gap: 18px;
  font-size: 22px;
}
.social-icons i {
  cursor: pointer;
  transition: 0.2s;
}
.social-icons i:hover {
  color: var(--neon);
  transform: translateY(-3px);
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