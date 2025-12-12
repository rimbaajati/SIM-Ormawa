<template>
  <div class="tracking-layout">
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
          <div class="fallback-bg">Memuat efek fluid...</div>
        </template>
      </ClientOnly>
    </div>

    <section class="main-section">
      <h2 class="page-title">Tracking Real-Time</h2>
      
      <div class="search-container">
        <input 
          type="text" 
          placeholder="Cari ID Kegiatan / Nomor Proposal..." 
          class="search-input"
        />
        <button class="search-btn">
          <i class="fas fa-search"></i>
        </button>
      </div>

      <div class="tracking-card">
        
        <div class="ticket-header">
          <div class="ticket-info-grid">
            <div class="info-item">
              <span class="label">Nomor</span>
              <p class="value">{{ ticketData.nomor }}</p>
            </div>
            <div class="info-item wide">
              <span class="label">Judul Kegiatan</span>
              <p class="value">{{ ticketData.judul }}</p>
            </div>
            <div class="info-item">
              <span class="label">Status</span>
              <span class="status-badge">{{ ticketData.status }}</span>
            </div>
          </div>

          <div class="progress-wrapper">
             <div class="progress-label">
               <span>Progress Keseluruhan</span>
               <span class="percentage">{{ ticketData.progress }}%</span>
             </div>
             <div class="progress-track">
               <div 
                 class="progress-fill" 
                 :style="{ width: ticketData.progress + '%' }"
               ></div>
             </div>
          </div>
        </div>

        <div class="timeline-container">
          <div 
            v-for="(step, index) in steps" 
            :key="index"
            class="timeline-step"
          >
            <div class="marker-col">
              <div :class="['marker-circle', getMarkerClass(step.status)]">
                 <i v-if="step.status === 'Completed'" class="fas fa-check"></i>
                 <i v-else-if="step.status === 'In Progress'" class="fas fa-sync fa-spin"></i>
                 <span v-else class="dot"></span>
              </div>
              <div v-if="index < steps.length - 1" :class="['line-connector', getLineClass(step.status)]"></div>
            </div>

            <div class="content-col">
              <h4 :class="['step-label', getTextClass(step.status)]">{{ step.label }}</h4>
              <p class="step-date">{{ step.date }}</p>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</template>

<script setup>
definePageMeta({
  layout: "empty",
});

import { ref } from "vue";

const features = [
  { slug: "pengajuan", title: "Pengajuan Online" },
  { slug: "formdetail", title: "Form Detail Lengkap" },
  { slug: "uploaddokumen", title: "Upload Dokumen" },
  { slug: "notifikasi", title: "Notifikasi Revisi" },
  { slug: "tracking", title: "Tracking Real-Time" },
  { slug: "download", title: "Download Izin" },
];

// STATE: Set feature aktif ke 'tracking'
const currentFeature = ref("tracking");

const ticketData = ref({
  nomor: "01/UKM/002/2026",
  judul: "Proposal Kegiatan Seminar Nasional Teknologi",
  status: "Dalam Proses",
  progress: 40,
});

const steps = ref([
  { label: "Proposal Dikirim ke Admin", date: "28 Des 2025 - 09:00", status: "Completed" },
  { label: "Verifikasi Kemahasiswaan", date: "30 Des 2025 - 14:20", status: "Completed" },
  { label: "Review Wakil Rektor III", date: "Sedang Berlangsung", status: "In Progress" },
  { label: "Persetujuan Akhir", date: "Menunggu", status: "Pending" },
  { label: "Penerbitan Surat Izin", date: "Menunggu", status: "Pending" },
]);

// --- HELPER LOGIC ---
const getMarkerClass = (status) => {
  if (status === "Completed") return "marker-completed";
  if (status === "In Progress") return "marker-progress";
  return "marker-pending";
};

const getLineClass = (status) => {
  if (status === "Completed") return "line-solid";
  return "line-dashed";
};

const getTextClass = (status) => {
  if (status === "In Progress") return "text-highlight";
  if (status === "Pending") return "text-muted";
  return "text-normal";
};

// --- HELPER SIDEBAR & ROUTING ---
const setActive = (slug) => {
  currentFeature.value = slug;
};

const getFeatureRoute = (slug) => {
  if (slug === "pengajuan") return "/fitur/pengajuan";
  return `/fitur/${slug.replace("-", "")}`;
};

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
  if (slug === "download") return "text-wrapper-9-old";
  return "text-wrapper-4-old"; 
};

const getTextWrapperEmojiClass = (slug) => {
  if (slug === "formdetail") return "text-wrapper-5-old";
  if (slug === "uploaddokumen") return "text-wrapper-5-old";
  if (slug === "notifikasi") return "text-wrapper-8-old";
  if (slug === "tracking") return "text-wrapper-10-old";
  if (slug === "download") return "text-wrapper-10-old";
  return "text-wrapper-5-old"; 
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

/* ================================================= */
/* GLOBAL LAYOUT (GRID) */
/* ================================================= */

.tracking-layout {
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
  position: relative;
  overflow-x: hidden;
}

.liquid-container {
  grid-area: 1 / 1 / -1 / -1;
  position: absolute;
  width: 100%;
  height: 100%;
  z-index: 1;
  pointer-events: none;
}

.fallback-bg {
  height: 100%;
  background: #333;
  color: white;
  text-align: center;
  padding-top: 300px;
}

/* Header & Logo */
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

.arrow { font-size: 20px; font-weight: 300; line-height: 1; }

.header-logo-container {
  grid-area: logo;
  padding: 30px 50px 30px 0;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  z-index: 2;
}

.logo-img { height: 35px; width: auto; object-fit: contain; }

/* ================================================= */
/* SIDEBAR STYLE */
/* ================================================= */
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
}

.menu-item-link { text-decoration: none; color: inherit; }
.menu-item-wrapper-old { cursor: pointer; }

.div-old { height: 70px; position: relative; width: 310px; }
.rectangle-2-old { background-color: #000000; border-radius: 14px; height: 70px; left: 50px; position: absolute; top: 0; width: 230px; box-shadow: 0px 4px 4px #00000040; }
.rectangle-3-old { background-color: #000000; border-radius: 14px; height: 15px; left: -15px; position: absolute; top: 30px; width: 50px; box-shadow: 0px 4px 4px #00000040; }
.text-wrapper-2-old { color: #ffffff; font-size: 15px; font-weight: 700; left: 115px; position: absolute; top: 25px; width: 170px; }
.text-wrapper-3-old { color: #000000; font-size: 32px; font-weight: 700; left: 65px; position: absolute; top: 10px; white-space: nowrap; }

.div-2-old { height: 70px; margin-left: 50px; position: relative; width: 240px; }
.rectangle-4-old { background-color: #00000040; border-radius: 14px; height: 70px; left: 0; position: absolute; top: 0; width: 210px; box-shadow: 0px 4px 4px #00000040; }

.text-wrapper-4-old, .text-wrapper-6-old, .text-wrapper-7-old, .text-wrapper-9-old {
  color: #ffffff; font-size: 15px; font-weight: 700; left: 45px; position: absolute; text-shadow: 0px 2px 4px #00000040; width: 160px;
}
.text-wrapper-4-old, .text-wrapper-6-old, .text-wrapper-7-old { top: 25px; }
.text-wrapper-9-old { top: 24px; }

.text-wrapper-5-old, .text-wrapper-8-old, .text-wrapper-10-old {
  color: #000000; font-size: 25px; font-weight: 700; left: 8px; position: absolute; text-align: center; text-shadow: 0px 2px 4px #00000040; white-space: nowrap;
}
.text-wrapper-5-old, .text-wrapper-8-old { top: 15px; }
.text-wrapper-10-old { top: 16px; }

/* ================================================= */
/* TRACKING CONTENT */
/* ================================================= */

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
  margin: 0 0 30px 0;
  color: #0f172a;
}

/* Search Bar */
.search-container {
  display: flex;
  background: #fff;
  padding: 8px;
  border-radius: 50px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  margin-bottom: 30px;
  width: 100%;
  max-width: 500px;
  border: 1px solid #eee;
}

.search-input {
  flex-grow: 1;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
  outline: none;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
}

.search-btn {
  background: #FF6D1F;
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  transition: background 0.2s;
}

.search-btn:hover { background: #e05a15; }

/* Card Utama */
.tracking-card {
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
  padding: 40px;
  max-width: 800px;
  width: 100%;
}

/* Header Tiket */
.ticket-header {
  background: #fff8f5; /* Orange muda sekali */
  border: 1px solid #ffe5d0;
  border-radius: 12px;
  padding: 20px 25px;
  margin-bottom: 40px;
}

.ticket-info-grid {
  display: grid;
  grid-template-columns: 1fr 2fr 1fr;
  gap: 20px;
  margin-bottom: 20px;
}

.info-item .label {
  display: block;
  font-size: 12px;
  color: #888;
  margin-bottom: 4px;
}

.info-item .value {
  font-weight: 600;
  font-size: 15px;
  color: #333;
  margin: 0;
}

.status-badge {
  display: inline-block;
  background: #FF6D1F;
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 20px;
}

/* Progress Bar */
.progress-wrapper {
  margin-top: 15px;
}

.progress-label {
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  font-weight: 600;
  color: #FF6D1F;
  margin-bottom: 6px;
}

.progress-track {
  height: 8px;
  background: #eee;
  border-radius: 10px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: #FF6D1F;
  border-radius: 10px;
  transition: width 0.5s ease;
}

/* Timeline */
.timeline-container {
  padding: 0 10px;
}

.timeline-step {
  display: flex;
  align-items: flex-start;
  padding-bottom: 0;
  min-height: 80px; /* Jarak antar step */
}

.timeline-step:last-child {
  min-height: auto;
}

/* Kolom Marker (Kiri) */
.marker-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-right: 20px;
  width: 30px;
}

.marker-circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  z-index: 2;
  transition: all 0.3s;
}

/* Style Marker */
.marker-completed {
  background: #00c853; /* Hijau Sukses */
  color: white;
  box-shadow: 0 4px 10px rgba(0, 200, 83, 0.3);
}

.marker-progress {
  background: #FF6D1F; /* Orange Tema */
  color: white;
  box-shadow: 0 4px 10px rgba(255, 109, 31, 0.3);
}

.marker-pending {
  background: #e0e0e0;
  width: 16px;
  height: 16px;
  margin-top: 7px; /* Align center manual karena size beda */
}

.dot {
  display: block;
  width: 6px;
  height: 6px;
  background: #fff;
  border-radius: 50%;
}

/* Garis */
.line-connector {
  width: 2px;
  flex-grow: 1;
  background: #e0e0e0;
  margin-top: 5px;
  margin-bottom: 5px;
}

.line-solid { background: #00c853; } /* Garis hijau jika sudah lewat */

/* Kolom Konten (Kanan) */
.content-col {
  padding-top: 4px;
}

.step-label {
  font-size: 15px;
  font-weight: 600;
  margin: 0 0 4px 0;
}

.step-date {
  font-size: 12px;
  color: #888;
  margin: 0;
}

/* Text Colors */
.text-highlight { color: #FF6D1F; }
.text-muted { color: #aaa; font-weight: 400; }
.text-normal { color: #333; }
</style>