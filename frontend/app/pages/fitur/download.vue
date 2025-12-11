<template>
  <div class="pengajuan-layout">
    <header class="top-header">
      <router-link to="/fitur" class="back-link">
        <span class="arrow">〈</span> Kembali Beranda Fitur
      </router-link>
    </header>

    <div class="header-logo-container">
      <img src="/logo-atas.png" alt="Logo UMPKU" class="logo-img" />
    </div>

    <aside class="sidebar-old-style">
      <div class="menu-fitur-old">
        <router-link
          v-for="(item, index) in features"
          :key="index"
          :to="getFeatureRoute(item.slug)"
          @click="setActive(item.slug)"
          class="menu-item-link"
        >
          <div
            :class="{
              // 'download' aktif, 'pengajuan' non-aktif
              'div-old': item.slug === currentFeature,
              'div-2-old': item.slug !== currentFeature,
            }"
            class="menu-item-wrapper-old"
          >
            <template v-if="item.slug === currentFeature">
              <div class="rectangle-2-old" />
              <div class="rectangle-3-old" />
              <div class="text-wrapper-2-old">{{ item.title }}</div>
              <div class="text-wrapper-3-old">{{ getEmoji(item.slug) }}</div>
            </template>
            <template v-else>
              <div class="rectangle-4-old" />
              <div :class="getTextWrapperClass(item.slug)">
                {{ item.title }}
              </div>
              <div :class="getTextWrapperEmojiClass(item.slug)">
                {{ getEmoji(item.slug) }}
              </div>
            </template>
          </div>
        </router-link>
      </div>
    </aside>

    <div class="liquid-container">
      <ClientOnly>
        <LiquidEther
          :colors="['#CC561E', '#FF6D1F', '#FF9013']"
          :mouse-force="20"
          :cursor-size="100"
          :is-viscous="false"
          :viscous="30"
          :iterations-viscous="32"
          :iterations-poisson="32"
          :resolution="0.5"
          :is-bounce="false"
          :auto-demo="true"
          :auto-speed="0.5"
          :auto-intensity="2.2"
          :takeover-duration="0.25"
          :auto-resume-delay="3000"
          :auto-ramp-duration="0.6"
        />
        <template #fallback>
          <div
            style="
              height: 100vh;
              background: #333;
              color: white;
              text-align: center;
              padding-top: 300px;
            "
          >
            Memuat efek fluid...
          </div>
        </template>
      </ClientOnly>
    </div>

    <section class="main-section">
      <h2 class="page-title">Download Dokumen Izin Kegiatan</h2>

      <div class="form-container download-container">
        <div class="file-item-download" v-for="f in files" :key="f.name">
          <div class="file-info">
            <i class="fas fa-file-pdf file-icon-lg"></i>
            <p class="file-name-download">{{ f.name }}</p>
          </div>
          <a :href="f.url" download class="btn-download">
            <i class="fas fa-download"></i> Download
          </a>
        </div>

        <div v-if="files.length === 0" class="no-files">
          <i class="fas fa-exclamation-circle"></i>
          <p>Belum ada dokumen izin kegiatan yang siap diunduh.</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref } from "vue";
// Catatan: Jika Anda menggunakan LiquidEther, pastikan sudah di-import/terdaftar

definePageMeta({
  layout: "empty",
});

const features = [
  { slug: "pengajuan", title: "Pengajuan Online" },
  { slug: "formdetail", title: "Form Detail Lengkap" },
  { slug: "uploaddokumen", title: "Upload Dokumen" },
  { slug: "notifikasi", title: "Notifikasi Revisi" },
  { slug: "tracking", title: "Tracking Real-Time" },
  { slug: "download", title: "Download Izin" }, // Item ini akan aktif
];

// Mengatur 'download' sebagai fitur yang aktif
const currentFeature = ref("download");

const files = ref([
  { name: "Surat Izin Kegiatan 2025.pdf", url: "/downloads/surat-izin-kegiatan-2025.pdf" },
  { name: "Lampiran Persetujuan.pdf", url: "/downloads/lampiran-persetujuan.pdf" },
]);

const setActive = (slug) => {
  currentFeature.value = slug;
};

// Fungsi untuk menentukan rute/link berdasarkan slug fitur (seperti di template kedua)
const getFeatureRoute = (slug) => {
  if (slug === "pengajuan") {
    return "/fitur/pengajuan";
  }
  return `/fitur/${slug.replace("-", "")}`;
};

// --- HELPER FUNCTIONS UNTUK SIDEBAR ---
const getEmoji = (slug) => {
  if (slug === "pengajuan") return "📝";
  if (slug === "formdetail") return "📋";
  if (slug === "uploaddokumen") return "📤";
  if (slug === "notifikasi") return "🔔";
  if (slug === "tracking") return "📊";
  if (slug === "download") return "⬇️";
  return "";
};

const getTextWrapperClass = (slug) => {
  if (slug === "formdetail") return "text-wrapper-4-old";
  if (slug === "uploaddokumen") return "text-wrapper-6-old";
  if (slug === "notifikasi") return "text-wrapper-7-old";
  if (slug === "tracking") return "text-wrapper-9-old";
  if (slug === "pengajuan") return "text-wrapper-4-old"; // Terapkan style non-aktif
  return "";
};

const getTextWrapperEmojiClass = (slug) => {
  if (slug === "formdetail") return "text-wrapper-5-old";
  if (slug === "uploaddokumen") return "text-wrapper-5-old";
  if (slug === "notifikasi") return "text-wrapper-8-old";
  if (slug === "tracking") return "text-wrapper-10-old";
  if (slug === "pengajuan") return "text-wrapper-5-old"; // Terapkan style non-aktif
  return "";
};
</script>

<style scoped>
/* ================================================= */
/* GLOBAL LAYOUT (GRID) */
/* ================================================= */

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

.pengajuan-layout {
  display: grid;
  grid-template-areas:
    "headerL headerL logo"
    "sidebar main main";
  grid-template-rows: auto 1fr;
  grid-template-columns: 220px 1fr minmax(100px, 150px);
  min-height: 100vh;
  font-family: "Poppins", sans-serif;
  background: #fcfcfc;
  color: #111;
  overflow: hidden;
}

.liquid-container {
  grid-area: headerL / sidebar / headerL / logo;
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 1;
  pointer-events: none;
}

.top-header {
  grid-area: headerL;
  padding: 30px 0 30px 50px;
  z-index: 2;
}

.back-link {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 16px;
  color: #555;
  text-decoration: none;
  font-weight: 500;
}

.arrow {
  font-size: 20px;
  font-weight: 300;
  line-height: 1;
}

.header-logo-container {
  grid-area: logo;
  padding: 30px 50px 30px 0;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  z-index: 2;
}

.logo-img {
  height: 35px;
  width: auto;
  object-fit: contain;
}

/* =============== OLD SIDEBAR =============== */

.menu-item-link {
  text-decoration: none;
  color: inherit;
}

.sidebar-old-style {
  grid-area: sidebar;
  position: relative;
  padding-left: 10px;
  z-index: 2;
}

.menu-fitur-old {
  margin-top: 90px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 280px;
  height: auto;
}

.menu-item-wrapper-old {
  cursor: pointer;
}

/* Item Menu Aktif (Download Izin) */
.div-old {
  height: 70px;
  position: relative;
  width: 310px;
}

.rectangle-2-old {
  background-color: #000000;
  border-radius: 14px;
  height: 70px;
  left: 50px;
  position: absolute;
  top: 0;
  width: 230px;
  box-shadow: 0px 4px 4px #00000040;
}

.rectangle-3-old {
  background-color: #000000;
  border-radius: 14px;
  height: 15px;
  left: -15px;
  position: absolute;
  top: 30px;
  width: 50px;
  box-shadow: 0px 4px 4px #00000040;
}

.text-wrapper-2-old {
  color: #ffffff;
  font-family: "Poppins", Helvetica;
  font-size: 15px;
  font-weight: 700;
  left: 115px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  top: 25px;
  width: 170px;
}

.text-wrapper-3-old {
  color: #000000;
  font-family: "Poppins", Helvetica;
  font-size: 32px;
  font-weight: 700;
  left: 65px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  top: 10px;
  white-space: nowrap;
}

/* Item Menu Non-Aktif (Pengajuan Online, dll) */
.div-2-old {
  height: 70px;
  margin-left: 50px;
  position: relative;
  width: 240px;
}

.rectangle-4-old {
  background-color: #00000040; /* Hitam transparan (sesuai gambar) */
  border-radius: 14px;
  height: 70px;
  left: 0;
  position: absolute;
  top: 0;
  width: 210px;
  box-shadow: 0px 4px 4px #00000040;
}

/* Styling Title Non-Aktif */
.text-wrapper-4-old,
.text-wrapper-6-old,
.text-wrapper-7-old,
.text-wrapper-9-old {
  color: #ffffff;
  font-family: "Poppins", Helvetica;
  font-size: 15px;
  font-weight: 700;
  left: 45px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  text-shadow: 0px 2px 4px #00000040;
  width: 160px;
}

/* Penempatan Title Non-Aktif yang Spesifik */
.text-wrapper-4-old {
  top: 25px; /* Pengajuan Online & Form Detail Lengkap */
}
.text-wrapper-6-old {
  top: 25px; /* Upload Dokumen */
}
.text-wrapper-7-old {
  top: 25px; /* Notifikasi Revisi */
}
.text-wrapper-9-old {
  top: 24px; /* Tracking Real-Time */
}

/* Styling Emoji Non-Aktif */
.text-wrapper-5-old,
.text-wrapper-8-old,
.text-wrapper-10-old {
  color: #000000;
  font-family: "Poppins", Helvetica;
  font-size: 25px;
  font-weight: 700;
  left: 8px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  text-align: center;
  text-shadow: 0px 2px 4px #00000040;
  white-space: nowrap;
}

/* Penempatan Emoji Non-Aktif yang Spesifik */
.text-wrapper-5-old {
  top: 15px; /* Pengajuan Online, Form Detail & Upload Dokumen (disamakan) */
}
.text-wrapper-8-old {
  top: 15px; /* Notifikasi Revisi */
}
.text-wrapper-10-old {
  top: 16px; /* Tracking Real-Time */
}

/* =============== MAIN CONTENT (DOWNLOAD STYLES) =============== */

.main-section {
  grid-area: main;
  padding: 0 50px 50px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  z-index: 2;
}

.page-title {
  text-align: center;
  font-weight: 700;
  font-size: 24px;
  margin: 0 0 40px 0;
}

.form-container {
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
  padding: 40px 50px;
  max-width: 800px;
  width: 100%;
}

.download-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.file-item-download {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #f7f7f7;
  border: 1px solid #eee;
  padding: 15px 20px;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.file-item-download:hover {
  background: #ececec;
  border-color: #ddd;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.file-info {
  display: flex;
  align-items: center;
  gap: 15px;
}

.file-icon-lg {
  font-size: 24px;
  color: #cc561e;
}

.file-name-download {
  color: #111;
  font-weight: 500;
  margin: 0;
}

.btn-download {
  background: #000;
  color: #fff;
  padding: 8px 15px;
  border-radius: 8px;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  transition: background 0.3s, transform 0.2s;
  display: flex;
  align-items: center;
  gap: 8px;
}

.btn-download:hover {
  background: #333;
  transform: translateY(-1px);
}

.no-files {
  text-align: center;
  padding: 30px;
  border: 1px dashed #ddd;
  border-radius: 10px;
  color: #888;
  font-size: 16px;
  font-style: italic;
}
.no-files i {
  display: block;
  font-size: 30px;
  margin-bottom: 10px;
  color: #aaa;
}
</style>