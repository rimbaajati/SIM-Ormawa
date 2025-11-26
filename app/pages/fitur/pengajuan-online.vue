<template>
  <div class="page-wrapper">
    <div class="container">
      <!-- Title -->
      <h1 class="title">Pengajuan Kegiatan Online</h1>
      <p class="subtitle">
        Ajukan kegiatan organisasi Anda secara digital dengan cepat, aman, dan terstruktur.
      </p>

      <!-- Card Form -->
      <div class="form-card">
        <form @submit.prevent="submitPengajuan" class="space-y-5">
          <!-- Nama Kegiatan -->
          <div>
            <label class="label">Nama Kegiatan</label>
            <input
              v-model="nama"
              type="text"
              required
              class="input"
              placeholder="Contoh: Seminar Teknologi Kampus"
            />
          </div>

          <!-- Tanggal -->
          <div>
            <label class="label">Tanggal Kegiatan</label>
            <input
              v-model="tanggal"
              type="date"
              required
              class="input"
            />
          </div>

          <!-- Tempat -->
          <div>
            <label class="label">Tempat / Lokasi</label>
            <input
              v-model="tempat"
              type="text"
              required
              class="input"
              placeholder="Aula Kampus / Online Zoom"
            />
          </div>

          <!-- Anggaran -->
          <div>
            <label class="label">Rencana Anggaran</label>
            <input
              v-model="anggaran"
              type="number"
              required
              class="input"
              placeholder="Contoh: 1500000"
            />
          </div>

          <!-- Deskripsi -->
          <div>
            <label class="label">Deskripsi Singkat</label>
            <textarea
              v-model="deskripsi"
              rows="4"
              required
              class="textarea"
              placeholder="Tuliskan gambaran singkat kegiatan..."
            ></textarea>
          </div>

          <!-- Upload Dokumen -->
          <div>
            <label class="label">Upload Proposal (PDF)</label>
            <input
              type="file"
              accept="application/pdf"
              class="file-input"
              @change="onFileUpload"
            />
          </div>

          <!-- Submit -->
          <button type="submit" class="submit-btn">
            Ajukan Kegiatan
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const nama = ref("");
const tanggal = ref("");
const tempat = ref("");
const anggaran = ref("");
const deskripsi = ref("");
const dokumen = ref(null);

const onFileUpload = (e) => {
  dokumen.value = e.target.files[0];
};

const submitPengajuan = () => {
  console.log({
    nama: nama.value,
    tanggal: tanggal.value,
    tempat: tempat.value,
    anggaran: anggaran.value,
    deskripsi: deskripsi.value,
    dokumen: dokumen.value,
  });

  alert("Pengajuan berhasil dikirim! (dummy)");
};
</script>

<style scoped>
.page-wrapper {
  padding-top: 110px;
  padding-bottom: 60px;
  background: radial-gradient(circle at top, #1c2738 0%, #0e1420 100%);
  min-height: 100vh;
  color: white;
}

.container {
  max-width: 700px;
  margin: auto;
  padding: 0 20px;
}

.title {
  font-size: 32px;
  font-weight: 800;
  text-align: center;
  color: var(--neon);
  margin-bottom: 10px;
}

.subtitle {
  text-align: center;
  color: rgba(255, 255, 255, 0.6);
  margin-bottom: 36px;
}

.form-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 18px;
  padding: 28px;
  backdrop-filter: blur(8px);
  box-shadow: 0 0 30px rgba(0, 180, 255, 0.12);
  animation: fadeIn 0.6s ease-out;
}

.label {
  color: rgba(255, 255, 255, 0.75);
  font-size: 14px;
  margin-bottom: 6px;
  display: block;
}

.input,
.textarea {
  width: 100%;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.12);
  padding: 10px 14px;
  border-radius: 10px;
  color: white;
  outline: none;
  transition: 0.2s;
}

.input:focus,
.textarea:focus {
  border-color: var(--neon);
  box-shadow: 0 0 10px rgba(0, 255, 200, 0.2);
}

.file-input {
  width: 100%;
  background: rgba(255, 255, 255, 0.06);
  padding: 10px;
  border: 1px dashed rgba(255, 255, 255, 0.2);
  border-radius: 10px;
  cursor: pointer;
  color: white;
}

.submit-btn {
  width: 100%;
  padding: 12px;
  background: linear-gradient(90deg, var(--neon), #28c6ff);
  border: none;
  color: #08101a;
  font-weight: 700;
  border-radius: 12px;
  margin-top: 10px;
  cursor: pointer;
  transition: 0.25s;
  box-shadow: 0 6px 25px rgba(0, 255, 200, 0.18);
}

.submit-btn:hover {
  transform: scale(1.02);
  background: linear-gradient(90deg, #28c6ff, var(--neon));
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
