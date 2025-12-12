<template>
  <div class="notifikasi-layout">
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
      <h2 class="page-title">Notifikasi Revisi</h2>
      <p class="page-subtitle">Pantau status revisi dan masukan dari kemahasiswaan.</p>

      <div class="notif-card-container">
        
        <div v-if="notifs.length === 0" class="empty-state">
          <p>Tidak ada notifikasi revisi saat ini.</p>
        </div>

        <div v-else class="notif-list">
          <div v-for="(n, index) in notifs" :key="index" class="notif-item">
            <div class="notif-icon-wrapper">
               <i class="fas fa-exclamation-circle"></i>
            </div>
            
            <div class="notif-content">
              <div class="notif-header">
                <h4 class="notif-title">{{ n.title }}</h4>
                <span class="notif-time">{{ n.time }}</span>
              </div>
              <p class="notif-msg">{{ n.msg }}</p>
            </div>
          </div>
        </div>

        <div class="card-footer">
            <button class="mark-read-btn">Tandai Semua Dibaca</button>
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

// STATE: Set feature aktif ke 'notifikasi'
const currentFeature = ref("notifikasi");

// DATA DUMMY NOTIFIKASI
const notifs = ref([
  {
    title: "Revisi Proposal Kegiatan",
    msg: "Mohon perbaiki Bab 2 terkait latar belakang dan sesuaikan format font pada Bab 4.",
    time: "1 jam lalu",
  },
  {
    title: "Revisi Rincian Anggaran (RAB)",
    msg: "Terdapat ketidaksesuaian total biaya konsumsi. Harap lampirkan bukti survei harga terbaru.",
    time: "Kemarin, 14:30",
  },
  {
    title: "Dokumen Tidak Terbaca",
    msg: "File Rundown yang diupload buram. Silakan upload ulang dengan format PDF yang jelas.",
    time: "2 hari lalu",
  },
]);

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

.notifikasi-layout {
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

/* Background Liquid Ether Full Screen */
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

/* Active State */
.div-old { height: 70px; position: relative; width: 310px; }
.rectangle-2-old { background-color: #000000; border-radius: 14px; height: 70px; left: 50px; position: absolute; top: 0; width: 230px; box-shadow: 0px 4px 4px #00000040; }
.rectangle-3-old { background-color: #000000; border-radius: 14px; height: 15px; left: -15px; position: absolute; top: 30px; width: 50px; box-shadow: 0px 4px 4px #00000040; }
.text-wrapper-2-old { color: #ffffff; font-size: 15px; font-weight: 700; left: 115px; position: absolute; top: 25px; width: 170px; }
.text-wrapper-3-old { color: #000000; font-size: 32px; font-weight: 700; left: 65px; position: absolute; top: 10px; white-space: nowrap; }

/* Inactive State */
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
/* NOTIFICATION CARD STYLE */
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
  margin: 0;
  color: #0f172a;
}

.page-subtitle {
  font-size: 14px;
  color: #666;
  margin-top: 5px;
  margin-bottom: 40px;
}

/* Card Wrapper */
.notif-card-container {
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
  padding: 0; /* Padding di handle per item untuk border */
  max-width: 700px;
  width: 100%;
  overflow: hidden; /* Agar radius terjaga */
}

/* List Items */
.notif-list {
  display: flex;
  flex-direction: column;
}

.notif-item {
  display: flex;
  gap: 20px;
  padding: 25px 30px;
  border-bottom: 1px solid #f0f0f0;
  transition: background 0.2s;
}

.notif-item:last-child {
  border-bottom: none;
}

.notif-item:hover {
  background: #fcfcfc;
}

/* Icon (Warning/Alert) */
.notif-icon-wrapper {
  flex-shrink: 0;
  width: 45px;
  height: 45px;
  background: #FFF4E5; /* Warna orange sangat muda */
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #FF9013; /* Warna tema orange */
  font-size: 20px;
}

/* Text Content */
.notif-content {
  flex-grow: 1;
}

.notif-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 5px;
}

.notif-title {
  font-size: 16px;
  font-weight: 700;
  color: #333;
  margin: 0;
}

.notif-time {
  font-size: 12px;
  color: #999;
  white-space: nowrap;
  margin-left: 10px;
}

.notif-msg {
  font-size: 14px;
  color: #555;
  margin: 0;
  line-height: 1.5;
}

/* Footer (Optional) */
.card-footer {
  padding: 15px 30px;
  background: #f9f9f9;
  text-align: center;
  border-top: 1px solid #eee;
}

.mark-read-btn {
  background: none;
  border: none;
  color: #666;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: color 0.2s;
}

.mark-read-btn:hover {
  color: #000;
}

.empty-state {
    padding: 50px;
    text-align: center;
    color: #888;
}
</style>