<template>
  <section class="administration-section">
    <div class="container-admin">

      <h2 class="admin-title">The Administration</h2>

      <div class="admin-grid">

        <div class="admin-card">
          <div class="img-wrapper">
            <img src="/fitur/foto1.jpeg" class="admin-img" />
            <div class="img-overlay"></div>
          </div>
          <h3 class="admin-name">NAMA SATU</h3>
          <p class="admin-role">JABATAN LEMBAGA</p>
        </div>

        <div class="admin-card">
          <div class="img-wrapper">
            <img src="/fitur/foto2.jpg" class="admin-img" />
            <div class="img-overlay"></div>
          </div>
          <h3 class="admin-name">NAMA DUA</h3>
          <p class="admin-role">JABATAN LEMBAGA</p>
        </div>

        <div class="admin-card">
          <div class="img-wrapper">
            <img src="/fitur/foto3.jpg" class="admin-img" />
            <div class="img-overlay"></div>
          </div>
          <h3 class="admin-name">NAMA TIGA</h3>
          <p class="admin-role">JABATAN LEMBAGA</p>
        </div>

        <div class="admin-card">
          <div class="img-wrapper">
            <img src="/fitur/foto4.jpg" class="admin-img" />
            <div class="img-overlay"></div>
          </div>
          <h3 class="admin-name">NAMA EMPAT</h3>
          <p class="admin-role">KETERANGAN LAINNYA</p>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
</script>

<style scoped>
/* SECTION */
.administration-section {
  width: 100%;
  padding: 80px 0 100px;
  background: #ffffff;
  color: rgb(0, 0, 0);
}

.container-admin {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

.admin-title {
  font-size: 34px;
  font-weight: 700;
  font-family: "Playfair Display", serif;
  text-align: center;
  margin-bottom: 45px;
}

/* GRID */
.admin-grid {
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  gap: 50px;
}

@media (min-width: 640px) {
  .admin-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 1024px) {
  .admin-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* CARD */
.admin-card {
  text-align: center;
  cursor: pointer;
}

.img-wrapper {
  width: 100%;
  height: 380px;
  position: relative;
  overflow: hidden;
  border-radius: 8px;
}

/* IMAGE */
.admin-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.4s ease;
}

/* ✨ OVERLAY GRADIENT (PUTIH → TRANSPARAN SESUAI PERMINTAAN) */
.img-overlay {
  position: absolute;
  bottom: 0;
  height: 50%; /* bisa kamu sesuaikan */
  width: 100%;
  background: linear-gradient(
    to top,
    rgba(255, 255, 255, 1) 0%,
    rgba(255, 255, 255, 0.85) 20%,
    rgba(255, 255, 255, 0.55) 45%,
    rgba(255, 255, 255, 0.15) 70%,
    rgba(255, 255, 255, 0) 100%
  );
  pointer-events: none;
}


/* HOVER */
.admin-card:hover .admin-img {
  transform: scale(1.04);
  opacity: 0.92;
}

/* TEXT */
.admin-name {
  margin-top: 18px;
  font-size: 20px;
  font-weight: 600;
  font-family: "Playfair Display", serif;
  letter-spacing: 0.6px;
}

.admin-role {
  margin-top: 6px;
  font-size: 13px;
  color: #000000;
  letter-spacing: 0.4px;
}
</style>
