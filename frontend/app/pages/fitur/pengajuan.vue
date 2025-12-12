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
      <h2 class="page-title">Pengajuan Kegiatan Online</h2>

      <div class="form-container">
        <form @submit.prevent="submitPengajuan" class="form-grid">
          <div class="form-col">
            <label>Nama Kegiatan</label>
            <input
              v-model="namaKegiatan"
              type="text"
              placeholder="Isi nama kegiatan"
              required
            />

            <label>Tanggal Kegiatan</label>
            <div class="custom-input-group">
              <input
                v-model="tanggal"
                type="date"
                placeholder="dd/mm/yyyy"
                class="input-with-icon"
                onfocus="this.type='date'"
                onblur="if(this.value==''){this.type='text'}"
                required
              />
              <span class="input-icon-left">
                <i class="fas fa-calendar-alt"></i>
              </span>
            </div>

            <label>Total Anggaran</label>
            <input v-model="anggaran" type="text" placeholder="Rp. 1.000.000" />

            <label>Upload Proposal (PDF)</label>
            <div class="custom-file-upload">
              <span class="file-icon"><i class="fas fa-file-pdf"></i></span>
              <span class="file-label">{{
                fileName || "No file selected."
              }}</span>
              <input
                type="file"
                accept="application/pdf"
                @change="onFileUpload"
                class="hidden-file-input"
                required
              />
            </div>

            <button type="submit" class="submit-btn">Ajukan Kegiatan</button>
          </div>

          <div class="form-col">
            <label>Nama Organisasi</label>
            <div class="custom-select-group">
              <select v-model="organisasi" required>
                <option value="" disabled selected>Pilih Organisasi</option>
                <option>DPM</option>
                <option>BEM</option>
                <option>HIMANES</option>
                <option>HIMABID</option>
                <option>HIMAPER</option>
                <option>HIMANERS</option>
                <option>HIMAGIZI</option>
                <option>HIMATIF</option>
                <option>HIMATEMI</option>
                <option>UKM</option>
              </select>
              <i class="fas fa-chevron-down select-arrow"></i>
            </div>

            <label>Tempat / Lokasi</label>
            <div class="custom-input-group">
              <input
                v-model="tempat"
                type="text"
                placeholder="Auditorium UMPKU"
                class="input-with-icon-right"
                required
              />
            </div>

            <label>Deskripsi Singkat Kegiatan</label>
            <textarea
              v-model="deskripsi"
              rows="4"
              placeholder="Tuliskan gambaran singkat kegiatan..."
              required
            ></textarea>
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

// Current feature disetel ke 'pengajuan' agar sidebar item ini aktif
const currentFeature = ref("pengajuan");
const namaKegiatan = ref("");
const organisasi = ref("");
const tanggal = ref("");
const tempat = ref("");
const anggaran = ref("");
const deskripsi = ref("");
const fileName = ref("");

const setActive = (slug) => {
  currentFeature.value = slug;
};

// Fungsi untuk menentukan rute/link berdasarkan slug fitur
const getFeatureRoute = (slug) => {
  if (slug === "pengajuan") {
    return "/fitur/pengajuan";
  }
  // Mengarahkan ke sub-rute /fitur/slug
  return `/fitur/${slug.replace("-", "")}`;
};

const onFileUpload = (e) => {
  const file = e.target.files[0];
  fileName.value = file ? file.name : "";
};

const submitPengajuan = () => {
  alert(
    `Pengajuan berhasil dikirim!\nKegiatan: ${namaKegiatan.value}\nOrganisasi: ${organisasi.value}\nTanggal: ${tanggal.value}\nLokasi: ${tempat.value}\nAnggaran: ${anggaran.value}\nDeskripsi: ${deskripsi.value}`
  );
};


// --- HELPER FUNCTIONS BARU UNTUK SIDEBAR LAMA ---
const getEmoji = (slug) => {
  if (slug === "pengajuan") return "📝";
  if (slug === "formdetail") return "📋";
  if (slug === "uploaddokumen") return "📤";
  if (slug === "notifikasi") return "🔔";
  if (slug === "tracking") return "📊";
  if (slug === "download") return "⬇️";
  return "";
};

// Menggunakan mapping yang lebih akurat dan rapi
const getTextWrapperClass = (slug) => {
  if (slug === "formdetail") return "text-wrapper-4-old"; // Teks Form Detail Lengkap
  if (slug === "uploaddokumen") return "text-wrapper-6-old"; // Teks Upload Dokumen
  if (slug === "notifikasi") return "text-wrapper-7-old"; // Teks Notifikasi Revisi
  if (slug === "tracking") return "text-wrapper-9-old"; // Teks Tracking Real-Time
  if (slug === "download") return "text-wrapper-9-old"; // Teks Download Izin
  return "";
};

const getTextWrapperEmojiClass = (slug) => {
  if (slug === "formdetail") return "text-wrapper-5-old";
  if (slug === "uploaddokumen") return "text-wrapper-5-old";
  if (slug === "notifikasi") return "text-wrapper-8-old";
  if (slug === "tracking") return "text-wrapper-10-old";
  if (slug === "download") return "text-wrapper-10-old";
  return "";
};
</script>

<style scoped>
/* ================================================= */
/* GLOBAL LAYOUT (GRID) */
/* ================================================= */

/* Tambahkan Font Import jika diperlukan di lingkungan Anda */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap");

.pengajuan-layout {
  display: grid;
  grid-template-areas:
    "headerL headerL logo"
    "sidebar main main";
  grid-template-rows: auto 1fr;
  /* Mengurangi lebar sidebar menjadi 220px */
  grid-template-columns: 220px 1fr minmax(100px, 150px);
  min-height: 100vh;
  font-family: "Poppins", sans-serif;
  background: #fcfcfc;
  color: #111;
}

/* Container untuk LiquidEther */
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

/* Logo Kanan Atas */
.header-logo-container {
  grid-area: logo;
  padding: 30px 50px 30px 0;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  z-index: 2; /* Di atas liquid ether */
}

.logo-img {
  height: 35px;
  width: auto;
  object-fit: contain;
}

/* =============== OLD SIDEBAR (MODIFIKASI UKURAN) =============== */

.menu-item-link {
  text-decoration: none;
  color: inherit;
}

.sidebar-old-style {
  grid-area: sidebar;
  position: relative;
  /* Mengurangi padding kiri */
  padding-left: 10px;
  z-index: 2; /* Di atas liquid ether */
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

.menu-item-wrapper-old {
  cursor: pointer;
}

/* Item Menu Aktif */
.div-old {
  height: 70px;
  position: relative;
  /* Mengurangi lebar total item aktif */
  width: 310px; /* Disesuaikan untuk menampung kotak yang lebih panjang */
}

/* Background hitam besar */
.rectangle-2-old {
  background-color: #000000;
  border-radius: 14px;
  height: 70px;
  /* Posisikan lebih ke kiri */
  left: 50px;
  position: absolute;
  top: 0;
  /* PERUBAHAN: Menambah lebar background */
  width: 230px; /* Diperpanjang dari 210px menjadi 230px */
  box-shadow: 0px 4px 4px #00000040;
}

/* Kotak hitam kecil di kiri */
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

/* Teks Title Aktif */
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

/* Teks Emoji Aktif */
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

/* Item Menu Non-Aktif */
.div-2-old {
  height: 70px; /* Sedikit lebih pendek */
  /* Posisikan item non-aktif lebih ke kiri */
  margin-left: 50px;
  position: relative;
  width: 240px;
}

.rectangle-4-old {
  background-color: #00000040;
  border-radius: 14px;
  height: 70px; /* Sedikit lebih pendek */
  left: 0;
  position: absolute;
  top: 0;
  /* Mengurangi lebar background */
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

/* Penempatan Title Non-Aktif yang Spesifik */
.text-wrapper-4-old {
  top: 25px; /* Form Detail Lengkap */
}
.text-wrapper-6-old {
  top: 25px; /* Upload Dokumen */
}
.text-wrapper-7-old {
  top: 25px; /* Notifikasi Revisi */
}
.text-wrapper-9-old {
  top: 24px; /* Tracking & Download */
}

/* Styling Emoji Non-Aktif */
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

/* Penempatan Emoji Non-Aktif yang Spesifik */
.text-wrapper-5-old {
  top: 15px; /* Form Detail & Upload Dokumen (disamakan) */
}
.text-wrapper-8-old {
  top: 15px; /* Notifikasi Revisi */
}
.text-wrapper-10-old {
  top: 16px; /* Tracking & Download */
}

/* =============== FORM SECTION (TIDAK BERUBAH) =============== */
.main-section {
  grid-area: main;
  padding: 0 50px 50px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  z-index: 2; /* Di atas liquid ether */
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

input,
select,
textarea {
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 12px 15px;
  font-size: 14px;
  outline: none;
  background-color: #fff;
  color: #111;
}

input:focus,
select:focus,
textarea:focus {
  border-color: #000;
}

/* Custom Input Group (untuk tanggal & lokasi) */
.custom-input-group {
  position: relative;
}

/* Input untuk Tanggal (Agar ikon kalender di kiri berfungsi) */
.custom-input-group input[type="date"],
.custom-input-group input[type="text"].input-with-icon {
  padding-left: 15px;
}
.input-icon-left {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  pointer-events: none;
  font-size: 16px;
}

/* Input untuk Lokasi (Menambahkan style input-with-icon-right untuk konsistensi) */
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
}

.input-icon-right .fas {
  margin-right: 5px;
  font-size: 14px;
}

/* Custom Select Group */
.custom-select-group {
  position: relative;
}
.custom-select-group select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  padding-right: 40px;
}
.select-arrow {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #888;
  pointer-events: none;
  font-size: 14px;
}

/* Custom File Upload */
.custom-file-upload {
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 12px 15px;
  display: flex;
  align-items: center;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  height: 44px;
}

.file-icon {
  color: #888;
  margin-right: 10px;
  font-size: 18px;
}

.file-label {
  color: #888;
  font-size: 14px;
  flex-grow: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.hidden-file-input {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  opacity: 0;
  cursor: pointer;
}

/* Textarea */
textarea {
  resize: none;
  height: 145px;
}

/* Tombol Submit */
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
  transition: background 0.3s;
  font-size: 16px;
}

.submit-btn:hover {
  background: #333;
}
</style>