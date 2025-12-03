<template>
  <div class="page">

    <!-- CENTER -->
    <div class="center-container">

      <!-- FORM CARD -->
      <div class="form-card">

        <!-- Close -->
        <button class="close-btn" @click="goBack">✕</button>

        <!-- Title -->
        <h2 class="form-title">Detail Kegiatan</h2>
        <p class="form-subtitle">Lengkapi informasi untuk melanjutkan pengajuan.</p>

        <!-- Form -->
        <form class="mt-8 space-y-6">
          <div>
            <label class="label">Nama Penanggung Jawab</label>
            <input type="text" class="input" placeholder="Nama lengkap" />
          </div>

          <div>
            <label class="label">Tempat Pelaksanaan</label>
            <input type="text" class="input" placeholder="Aula / Gedung / Online" />
          </div>

          <div>
            <label class="label">Estimasi Anggaran</label>
            <input type="number" class="input" placeholder="Rp 0" />
          </div>

          <button class="btn-submit">Simpan Data</button>
        </form>

      </div>
    </div>

  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
const router = useRouter();

const goBack = () => {
  router.push("/fitur");
};
</script>

<style scoped>
/* PAGE BG */
.page {
  min-height: 100vh;
  background: #0b1120;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding-top: 80px;
  padding-bottom: 60px;
}

/* CENTER WRAPPER */
.center-container {
  width: 100%;
  display: flex;
  justify-content: center;
}

/* CARD */
.form-card {
  width: 100%;
  max-width: 480px;
  background: #ffffff;
  padding: 40px 36px;
  border-radius: 26px;
  position: relative;
  box-shadow: 0 22px 55px rgba(0, 0, 0, 0.18);
}

/* Close Button */
.close-btn {
  position: absolute;
  top: 22px;
  right: 22px;
  background: none;
  border: none;
  font-size: 20px;
  color: #333;
  opacity: 0.6;
  cursor: pointer;
  transition: 0.2s;
}

.close-btn:hover {
  opacity: 1;
}

/* Title */
.form-title {
  font-size: 24px;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 5px;
}

.form-subtitle {
  font-size: 14px;
  color: #6b7280;
}

/* Input Label */
.label {
  font-size: 14px;
  color: #374151;
  margin-bottom: 6px;
  display: block;
}

/* Input style */
.input {
  width: 100%;
  padding: 14px 16px;
  background: #f3f4f6;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  outline: none;
  font-size: 15px;
  transition: 0.2s ease;
}

.input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
}

/* Submit Button */
.btn-submit {
  width: 100%;
  background: #0f172a;
  color: white;
  padding: 14px;
  font-weight: 600;
  border-radius: 14px;
  border: none;
  cursor: pointer;
  transition: 0.25s ease;
}

.btn-submit:hover {
  opacity: 0.9;
  transform: scale(1.01);
}
</style>
