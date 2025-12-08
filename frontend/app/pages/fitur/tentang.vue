<template>
  <div>
    <section class="administration-section">
      <div class="container-admin">
        <h2 class="admin-title">Pimpinan Bidang Kemahasiswaan</h2>

        <div class="admin-grid">
          <div class="admin-card">
            <div class="img-wrapper">
              <img src="/fitur/foto1.jpeg" class="admin-img" />
              <div class="img-overlay"></div>
            </div>
            <h3 class="admin-name">Dr. Suyanto, S.Pd.I, M.Pd.I.</h3>
            <p class="admin-role">WAKIL REKTOR III</p>
          </div>

          <div class="admin-card">
            <div class="img-wrapper">
              <img src="/fitur/foto2.jpg" class="admin-img" />
              <div class="img-overlay"></div>
            </div>
            <h3 class="admin-name">NAMA DUA</h3>
            <p class="admin-role">KEMAHASISWAAN</p>
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

    ---

    <section class="learn-more-section">
      <div class="container-learn">
        <h3 class="learn-more-title-main">SIM ORMAWA</h3>

        <div class="sim-ormawa-tabs">
          <button
            :class="{ 'tab-item': true, active: activeTab === 'apa-itu' }"
            @click="activeTab = 'apa-itu'"
          >
            APA ITU SIM ORMAWA
          </button>
          <button
            :class="{ 'tab-item': true, active: activeTab === 'fungsi' }"
            @click="activeTab = 'fungsi'"
          >
            FUNGSI UTAMA SIM ORMAWA
          </button>
          <button
            :class="{ 'tab-item': true, active: activeTab === 'manfaat' }"
            @click="activeTab = 'manfaat'"
          >
            MANFAAT SIM ORMAWA
          </button>
        </div>

        <div class="tab-content-wrapper">
            <Transition name="fade" mode="out-in">
                <div class="content-grid" :key="activeTab">
                    <div class="content-text">
                        <div v-if="activeTab === 'apa-itu'">
                            <p class="content-paragraph">
                                SIM ORMAWA adalah singkatan dari <strong>Sistem Informasi Manajemen
                                Organisasi Mahasiswa</strong>. Ini merupakan sebuah platform digital
                                atau aplikasi berbasis web/mobile yang dirancang khusus untuk
                                memfasilitasi, mengelola, dan mengintegrasikan berbagai
                                aktivitas, administrasi, dan informasi yang terkait dengan
                                Organisasi Mahasiswa (ORMAWA) di lingkungan perguruan tinggi.
                            </p>
                            <p class="content-paragraph-detail">
                                Tujuan utama dari SIM ORMAWA adalah untuk meningkatkan
                                <strong>efisiensi, transparansi, dan akuntabilitas</strong> dalam
                                pengelolaan kegiatan mahasiswa.
                            </p>
                        </div>

                        <div v-else-if="activeTab === 'fungsi'">
                            <p class="content-paragraph">
                                Fungsi-fungsi kunci SIM ORMAWA meliputi:
                            </p>
                            <ul class="ormawa-functions-list-tab">
                                <li>
                                    <strong>Administrasi Keanggotaan:</strong> Pendataan, pendaftaran, dan
                                    pengelolaan status anggota ORMAWA secara terpusat.
                                </li>
                                <li>
                                    <strong>Manajemen Kegiatan/Proyek:</strong> Pengajuan, perencanaan,
                                    pelaksanaan, monitoring, dan pelaporan program kerja.
                                </li>
                                <li>
                                    <strong>Pengelolaan Anggaran:</strong> Pengajuan dan pelaporan penggunaan
                                    dana kegiatan yang terintegrasi dengan sistem keuangan
                                    universitas.
                                </li>
                                <li>
                                    <strong>Dokumentasi dan Arsip:</strong> Tempat penyimpanan terpusat untuk
                                    surat, laporan akhir, sertifikat, dan dokumen penting
                                    lainnya.
                                </li>
                                <li>
                                    <strong>Sistem Komunikasi:</strong> Menyediakan platform untuk pengumuman
                                    resmi, koordinasi, dan penyebaran informasi.
                                </li>
                                <li>
                                    <strong>Evaluasi Kinerja:</strong> Alat bantu bagi pihak kemahasiswaan
                                    untuk memantau dan mengevaluasi kinerja setiap ORMAWA.
                                </li>
                            </ul>
                        </div>

                        <div v-else-if="activeTab === 'manfaat'">
                            <p class="content-paragraph">
                                SIM ORMAWA memberikan manfaat besar bagi seluruh ekosistem
                            kemahasiswaan:
                            </p>
                            <ul class="ormawa-functions-list-tab">
                                <li>
                                    **Bagi Mahasiswa/ORMAWA:** Proses administrasi lebih cepat,
                                    akses informasi terpusat, dan kemudahan kolaborasi.
                                </li>
                                <li>
                                    **Bagi Pimpinan/Universitas:** Peningkatan transparansi
                                    anggaran, kemudahan monitoring aktivitas, dan data akurat
                                    untuk pengambilan keputusan.
                                </li>
                                <li>
                                    **Akurasi Data:** Mengurangi kesalahan data manual dan
                                    memastikan semua data kegiatan tersimpan dengan aman.
                                </li>
                                <li>
                                    **Efisiensi Waktu:** Mempersingkat waktu pengajuan proposal,
                                    laporan, dan persetujuan.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="content-picture">
                        <img 
                            v-if="activeTab === 'apa-itu'" 
                            src="/tentang/apaitu.jpg" 
                            class="sim-ormawa-img" 
                            alt="Ilustrasi Aplikasi SIM ORMAWA"
                        />
                        
                        <div 
                            v-else-if="activeTab === 'fungsi'" 
                            class="content-picture-grid"
                        >
                            <img src="/fitur/foto1.jpeg" class="grid-item" alt="Administrasi Keanggotaan" />
                            <img src="/fitur/foto2.jpg" class="grid-item" alt="Manajemen Kegiatan" />
                            <img src="/fitur/foto3.jpg" class="grid-item" alt="Pengelolaan Anggaran" />
                            <img src="/fitur/foto4.jpg" class="grid-item" alt="Evaluasi Kinerja" />
                        </div>

                        <img 
                            v-else-if="activeTab === 'manfaat'" 
                            src="/fitur/foto4.jpg" 
                            class="sim-ormawa-img" 
                            alt="Ilustrasi Manfaat dan Kolaborasi"
                        />
                    </div>
                </div>
            </Transition>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";
const activeTab = ref("apa-itu");
</script>

<style scoped>
/* KEYFRAMES */
/* Animasi Fade-in standar */
@keyframes fadeIn {
  to {
    opacity: 1;
  }
}

/* Animasi Slide-up dan Fade-in untuk kartu */
@keyframes slideUpFadeIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* --- VUE TRANSITION (BARU DITAMBAHKAN) --- */
/* Kelas transisi untuk konten tab */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
/* --- END VUE TRANSITION --- */


/* ---------------------------------------------------- */
/* SECTION 1: ADMINISTRATION (BAGIAN ASLI DENGAN ANIMASI) */
/* ---------------------------------------------------- */
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
  /* Animasi Fade-in untuk Judul */
  opacity: 0;
  animation: fadeIn 1s ease-out forwards;
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
  /* Animasi Staggered */
  opacity: 0;
  transform: translateY(20px);
  animation: slideUpFadeIn 0.8s ease-out forwards;
}

/* Penundaan (Delay) untuk setiap kartu */
.admin-grid :nth-child(1).admin-card {
  animation-delay: 0.2s;
}
.admin-grid :nth-child(2).admin-card {
  animation-delay: 0.4s;
}
.admin-grid :nth-child(3).admin-card {
  animation-delay: 0.6s;
}
.admin-grid :nth-child(4).admin-card {
  animation-delay: 0.8s;
}

.img-wrapper {
  width: 100%;
  height: 380px;
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0);
  transition: box-shadow 0.3s ease;
}

/* IMAGE */
.admin-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: 0.4s ease;
}

/* OVERLAY GRADIENT */
.img-overlay {
  position: absolute;
  bottom: 0;
  height: 50%;
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

/* HOVER EFFECTS */
.admin-card:hover .admin-img {
  transform: scale(1.04);
  opacity: 0.92;
}

.admin-card:hover .img-wrapper {
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.admin-card:hover .admin-name {
  color: #ff8000; /* Warna Hover */
}

/* TEXT */
.admin-name {
  margin-top: 18px;
  font-size: 20px;
  font-weight: 600;
  font-family: "Playfair Display", serif;
  letter-spacing: 0.6px;
  transition: color 0.3s ease;
}

.admin-role {
  margin-top: 6px;
  font-size: 13px;
  color: #000000;
  letter-spacing: 0.4px;
}

/* ---------------------------------------------------- */
/* SECTION 2: SIM ORMAWA (TAMPILAN BARU) */
/* ---------------------------------------------------- */
.learn-more-section {
  width: 100%;
  padding: 60px 0 100px;
  background-color: #f7f7f7;
  text-align: center;
}

.container-learn {
  max-width: 1050px;
  margin: 0 auto;
  padding: 0 24px;
}

.learn-more-title-main {
  font-size: 34px;
  font-weight: 700;
  font-family: "Playfair Display", serif;
  text-align: center;
  margin-bottom: 40px;
  color: #333;
}

/* --- TAB NAVIGATION STYLING --- */
.sim-ormawa-tabs {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom: 30px;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}

.tab-item {
  background: none;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  font-weight: 600;
  color: #555;
  cursor: pointer;
  border-radius: 5px 5px 0 0;
  transition: all 0.3s ease;
  position: relative;
}

.tab-item.active {
  color: #fff;
  background-color: #ff8000;
  box-shadow: 0 4px 10px rgba(255, 128, 0, 0.3);
}

.tab-item:hover:not(.active) {
  color: #ff8000;
}

/* --- CONTENT GRID STYLING --- */
.content-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 50px;
  text-align: left;
}

.content-text {
  padding-top: 20px;
}

.content-paragraph {
  font-size: 18px;
  line-height: 1.6;
  color: #333;
  margin-bottom: 20px;
}

.content-paragraph-detail {
  font-size: 16px;
  line-height: 1.6;
  color: #555;
  margin-bottom: 30px;
  border-left: 3px solid #ff8000;
  padding-left: 15px;
}

/* Kanan: Kontainer Gambar */
.content-picture {
  background-color: #e0e0e0;
  min-height: 300px;
  height: auto;
  display: block;
  border-radius: 8px;
  overflow: hidden;
  position: relative;
}

/* Styling Gambar Tunggal (Untuk 'Apa Itu' dan 'Manfaat') */
.content-picture .sim-ormawa-img {
    width: 100%;
    height: 100%; 
    object-fit: cover;
    display: block;
    transition: opacity 0.3s ease;
}

/* Styling Khusus untuk Kolase 2x2 (Untuk 'Fungsi') */
.content-picture-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    height: 100%; 
    width: 100%;
    gap: 5px;
    padding: 5px;
    background-color: #f0f0f0;
}

.content-picture-grid .grid-item {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 4px;
}

/* --- LIST STYLING UNTUK TAB FUNGSI/MANFAAT --- */
.ormawa-functions-list-tab {
  list-style: none;
  padding: 0;
  margin-bottom: 40px;
}

.ormawa-functions-list-tab li {
  font-size: 16px;
  line-height: 1.6;
  color: #444;
  margin-bottom: 10px;
  position: relative;
  padding-left: 25px;
}

.ormawa-functions-list-tab li::before {
  content: '✓';
  color: #ff8000;
  font-weight: bold;
  position: absolute;
  left: 0;
  top: 0;
}

/* Media query untuk tampilan mobile */
@media (max-width: 768px) {
    .content-grid {
        grid-template-columns: 1fr;
    }
    .content-picture {
        order: -1;
        margin-bottom: 20px;
    }
    .sim-ormawa-tabs {
        flex-direction: column;
        gap: 5px;
    }
    .tab-item {
        width: 100%;
    }
}
</style>