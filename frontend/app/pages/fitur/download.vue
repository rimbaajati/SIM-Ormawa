<template>
  <div class="page">
    <h1 class="title">Download Dokumen Izin Kegiatan</h1>

    <div class="card">
      <div class="file-item" v-for="f in files" :key="f.name">
        <p class="file-name">{{ f.name }}</p>
        <a :href="f.url" download class="btn-primary">Download</a>
      </div>
    </div>
  </div>
</template>

<script setup>
const files = [
  { name: "Surat Izin Kegiatan 2025.pdf", url: "/downloads/surat-izin-kegiatan-2025.pdf" },
  { name: "Lampiran Persetujuan.pdf", url: "/downloads/lampiran-persetujuan.pdf" },
];
</script>

<style scoped>
:root {
  --neon: #000000; /* Define neon color if not already defined */
}

.page {
  min-height: 100vh;
  background: #0b1120;
  color: white;
  padding: 64px 20px;
}

.title {
  font-size: 2.25rem;
  font-weight: bold;
  color: #ffffff;
  text-align: center;
  margin-bottom: 40px;
}

.card {
  max-width: 48rem;
  margin: 0 auto;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 32px;
  border-radius: 16px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.file-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 16px;
  border-radius: 12px;
  transition: all 0.3s ease;
}

.file-item:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0, 255, 200, 0.1);
}

.file-name {
  color: white;
  font-weight: 500;
}

.btn-primary {
  width: 100%;
  padding: 12px;
  background: linear-gradient(90deg, var(--neon), #000000);
  border: none;
  color: #08101a;
  font-weight: 700;
  border-radius: 12px;
  margin-top: 10px;
  cursor: pointer;
  transition: 0.25s;
  box-shadow: 0 6px 25px rgba(0, 0, 0, 0.18);
  text-decoration: none;
  display: inline-block;
  text-align: center;
}

.btn-primary:hover {
  transform: scale(1.02);
  background: linear-gradient(90deg, #000000, var(--neon));
}
</style>