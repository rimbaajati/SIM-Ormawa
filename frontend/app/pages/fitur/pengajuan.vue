<template>
  <div class="page-wrapper">
    <div class="right-form-wrapper">
      <div class="form-card">
        <!-- Header -->
        <div class="form-header">
          <h2 class="form-title">Pengajuan Kegiatan</h2>
          <span class="close-btn" @click="goBack">✕</span>
        </div>

        <!-- Form -->
        <form @submit.prevent="submitPengajuan" class="space-y-4">

          <!-- Nama Kegiatan -->
          <div>
            <label class="label">Nama Kegiatan</label>
            <div class="input-wrapper">
              <input
                v-model="nama"
                type="text"
                required
                class="input"
                placeholder="Isi nama kegiatan"
              />
            </div>
          </div>

          <!-- Tanggal -->
          <div>
            <label class="label">Tanggal Kegiatan</label>
            <div class="input-wrapper">
              <input
                v-model="tanggal"
                type="date"
                required
                class="input"
              />
            </div>
          </div>

          <!-- Tempat -->
          <div>
            <label class="label">Tempat / Lokasi</label>
            <div class="input-wrapper">
              <input
                v-model="tempat"
                type="text"
                required
                class="input"
                placeholder="Aula Kampus / Online"
              />
            </div>
          </div>

          <!-- Anggaran -->
          <div>
            <label class="label">Rencana Anggaran</label>
            <div class="input-wrapper">
              <input
                v-model="anggaran"
                type="number"
                required
                class="input"
                placeholder="Contoh: 1500000"
              />
            </div>
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

          <!-- Upload Proposal -->
          <div>
            <label class="label">Upload Proposal (PDF)</label>
            <input
              type="file"
              accept="application/pdf"
              class="file-input"
              @change="onFileUpload"
            />
          </div>

          <!-- Button -->
          <button type="submit" class="submit-btn">Ajukan Kegiatan</button>

          <p class="footer-text">Sudah pernah mengajukan sebelumnya?</p>

        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const nama = ref("");
const tanggal = ref("");
const tempat = ref("");
const anggaran = ref("");
const deskripsi = ref("");
const dokumen = ref(null);

const goBack = () => {
  router.push("/fitur");
};

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
/* BACKGROUND */
.page-wrapper {
  min-height: 100vh;
  background: radial-gradient(
      circle at 20% 20%,
      rgba(255, 255, 255, 0.05),
      transparent 40%
    ),
    #0c1018;
  display: flex;
  justify-content: flex-end;
  padding: 60px;
}

/* FORM POSITION */
.right-form-wrapper {
  width: 420px;
}

/* CARD */
.form-card {
  background: #ffffff;
  border-radius: 24px;
  padding: 28px;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
  animation: fadeIn 0.6s ease-out;
}

/* HEADER */
.form-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}

.form-title {
  font-size: 20px;
  font-weight: 700;
  color: #0d0d0d;
}

.close-btn {
  cursor: pointer;
  font-size: 20px;
  color: #000;
  opacity: 0.5;
}

.close-btn:hover {
  opacity: 1;
}

/* LABEL */
.label {
  font-size: 14px;
  color: #555;
  margin-bottom: 4px;
  display: block;
}

/* INPUT WRAPPER */
.input-wrapper {
  background: #f7f7f8;
  border-radius: 12px;
}

/* INPUT */
.input {
  width: 100%;
  background: transparent;
  border: none;
  padding: 12px 14px;
  font-size: 15px;
  outline: none;
  color: #000;
}

.input:focus {
  background: #f0f0f0;
}

/* TEXTAREA */
.textarea {
  width: 100%;
  background: #f7f7f8;
  border-radius: 12px;
  padding: 12px 14px;
  color: #000;
  outline: none;
  border: none;
  resize: none;
  font-size: 15px;
}

.textarea:focus {
  background: #f0f0f0;
}

/* FILE INPUT */
.file-input {
  width: 100%;
  background: #f7f7f8;
  border: 1px dashed #ccc;
  padding: 12px;
  border-radius: 12px;
  cursor: pointer;
}

/* BUTTON */
.submit-btn {
  width: 100%;
  padding: 14px;
  background: #0c0c0f;
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 4px;
}

.submit-btn:hover {
  background: #000;
}

/* FOOTER */
.footer-text {
  text-align: center;
  color: #888;
  font-size: 12px;
  margin-top: 6px;
}

/* ANIMATION */
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
