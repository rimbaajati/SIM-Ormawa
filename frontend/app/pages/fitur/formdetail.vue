<template>
  <div class="formdetail-layout">
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
          <div
            style="
              height: 600px;
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
      <h2 class="page-title">Detail Kegiatan</h2>

      <div class="form-container">
        <form @submit.prevent="simpanData" class="form-grid">
          
          <div class="form-col">
            <label>Nama Penanggung Jawab</label>
            <div class="custom-input-group">
              <input
                v-model="namaPJ"
                type="text"
                placeholder="Nama lengkap penanggung jawab"
                class="input-with-icon"
                required
              />
              <span class="input-icon-left">
                <i class="fas fa-user"></i>
              </span>
            </div>

            <label>Estimasi Anggaran</label>
            <div class="custom-input-group">
                <input 
                v-model="anggaran" 
                type="number" 
                placeholder="Rp 0"
                class="input-with-icon"
                required 
                />
                <span class="input-icon-left">
                    <i class="fas fa-wallet"></i>
                </span>
            </div>
          </div>

          <div class="form-col">
            <label>Tempat Pelaksanaan</label>
            <div class="custom-input-group">
              <input
                v-model="tempat"
                type="text"
                placeholder="Aula / Gedung / Online"
                class="input-with-icon-right"
                required
              />
              <span class="input-icon-right" @click="openMapSelection">
                <i class="fas fa-map-marker-alt"></i> Maps Location
              </span>
            </div>

            <div style="flex-grow: 1;"></div> 

            <button type="submit" class="submit-btn">Simpan Detail</button>
          </div>

        </form>
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

// STATE: Set feature aktif ke 'formdetail'
const currentFeature = ref("formdetail");

// STATE FORM: Khusus untuk halaman Detail Kegiatan
const namaPJ = ref("");
const tempat = ref("");
const anggaran = ref("");

const setActive = (slug) => {
  currentFeature.value = slug;
};

const getFeatureRoute = (slug) => {
  if (slug === "formdetail") {
  return "/fitur/formdetail";
}
  return `/fitur/${slug.replace("-", "")}`;
};

const simpanData = () => {
  alert(
    `Data Tersimpan!\nPJ: ${namaPJ.value}\nTempat: ${tempat.value}\nAnggaran: Rp ${anggaran.value}`
  );
};

const openMapSelection = () => {
  alert("Membuka Modal Peta...");
};

// --- HELPER SIDEBAR (Sesuai Referensi Terbaru) ---
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
  if (slug ==="pengajuan") return "text-wrapper-4-old";
  if (slug === "formdetail") return "text-wrapper-4-old";
  if (slug === "uploaddokumen") return "text-wrapper-6-old";
  if (slug === "notifikasi") return "text-wrapper-7-old";
  if (slug === "tracking") return "text-wrapper-9-old";
  if (slug === "download") return "text-wrapper-9-old";
  return ""; // Default fallback
};

const getTextWrapperEmojiClass = (slug) => {
  if (slug ==="pengajuan") return "text-wrapper-5-old";
  if (slug === "formdetail") return "text-wrapper-5-old";
  if (slug === "uploaddokumen") return "text-wrapper-5-old";
  if (slug === "notifikasi") return "text-wrapper-8-old";
  if (slug === "tracking") return "text-wrapper-10-old";
  if (slug === "download") return "text-wrapper-10-old";
  return ""; // Default fallback
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

/* ================================================= */
/* GLOBAL LAYOUT (GRID) - SESUAI REFERENSI */
/* ================================================= */

.formdetail-layout {
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
}

/* Background Liquid Ether */
.liquid-container {
  grid-area: headerL / sidebar / headerL / logo; /* Menutupi area header dan main content (sebagai backdrop) */
  position: absolute;
  width: 100%;
  height: 100%;
  /* Atur z-index agar di bawah header dan form, tapi di atas background */
  z-index: 1;
  pointer-events: none; /* Penting: agar interaksi tidak terhalang oleh liquid ether */
}

/* Header Kiri (Kembali) */
.top-header {
  grid-area: headerL;
  padding: 30px 0 30px 50px;
  z-index: 2; /* Di atas liquid ether */
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

/* Logo Kanan */
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

/* ================================================= */
/* SIDEBAR STYLE (REFERENSI BARU) */
/* ================================================= */

.sidebar-old-style {
  grid-area: sidebar;
  position: relative;
  padding-left: 10px;
  z-index: 2;
}

.menu-fitur-old {
  /* PERUBAHAN: Menurunkan posisi sidebar */
  margin-top: 90px;
  display: flex;
  flex-direction: column;
  gap: 15px; /* Mengurangi jarak antar item */
  /* Mengurangi lebar total */
  width: 280px;
  height: auto;
}

.menu-item-link {
  text-decoration: none;
  color: inherit;
}

.menu-item-wrapper-old {
  cursor: pointer;
}

/* Active State */
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
  /* PERBAIKAN: Geser ke kiri (95px) */
  left: 115px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  top: 25px;
  width: 170px; /* Disesuaikan */
}

.text-wrapper-3-old {
  color: #000000;
  font-family: "Poppins", Helvetica;
  font-size: 32px;
  font-weight: 700;
  /* PERBAIKAN: Geser ke kiri (55px) */
  left: 65px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  top: 10px; /* Disesuaikan untuk menengahkan vertikal */
  white-space: nowrap;
}

/* Inactive State */
.div-2-old {
  height: 70px;
  margin-left: 50px;
  position: relative;
  width: 240px;
}

.rectangle-4-old {
  background-color: #00000040;
  border-radius: 14px;
  height: 70px;
  left: 0;
  position: absolute;
  top: 0;
  width: 210px;
  box-shadow: 0px 4px 4px #00000040;
}

.text-wrapper-4-old,
.text-wrapper-6-old,
.text-wrapper-7-old,
.text-wrapper-9-old {
  color: #ffffff;
  font-family: "Poppins", Helvetica;
  font-size: 15px; /* Sedikit lebih kecil, diubah dari 14px */
  font-weight: 700;
  /* Posisikan teks lebih ke kiri */
  left: 45px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  text-shadow: 0px 2px 4px #00000040;
  width: 160px;
}

.text-wrapper-4-old,
.text-wrapper-6-old,
.text-wrapper-7-old {
  top: 25px;
}
.text-wrapper-9-old {
  top: 24px;
}

.text-wrapper-5-old,
.text-wrapper-8-old,
.text-wrapper-10-old {
  color: #000000;
  font-family: "Poppins", Helvetica;
  font-size: 25px; /* Sedikit lebih kecil */
  font-weight: 700;
  /* Posisikan emoji lebih ke kiri */
  left: 8px;
  letter-spacing: 0;
  line-height: normal;
  position: absolute;
  text-align: center;
  text-shadow: 0px 2px 4px #00000040;
  white-space: nowrap;
}

.text-wrapper-5-old,
.text-wrapper-8-old {
  top: 15px;
}
.text-wrapper-10-old {
  top: 16px;
}

/* ================================================= */
/* MAIN SECTION & FORM */
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

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px 40px;
}

.form-col {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

label {
  font-weight: 600;
  font-size: 14px;
  margin-bottom: -10px;
  display: block;
  color: #333;
}

input {
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 12px 15px;
  font-size: 14px;
  outline: none;
  background-color: #fff;
  color: #111;
  transition: border-color 0.2s;
}

input:focus {
  border-color: #000;
}

/* Custom Input Styling */
.custom-input-group {
  position: relative;
}

.input-with-icon {
  padding-left: 40px;
}

.input-icon-left {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  pointer-events: none;
}

.input-with-icon-right {
  padding-right: 120px;
}

.input-icon-right {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #4a4a4a;
  font-size: 12px;
  font-weight: 500;
  cursor: pointer;
  z-index: 10;
}

.input-icon-right i {
  margin-right: 5px;
}

/* Button */
.submit-btn {
  margin-top: 5px;
  width: 100%;
  background: #000;
  color: #fff;
  padding: 15px 20px;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s, transform 0.1s;
  font-size: 16px;
}

.submit-btn:hover {
  background: #333;
  transform: scale(1.01);
}
</style>