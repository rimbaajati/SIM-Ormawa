<template>
  <div class="page">
    <h1 class="title">Download Dokumen Izin Kegiatan</h1>

    <div class="card space-y-6">
      <div class="file-item" v-for="f in files" :key="f.name">
        <p>{{ f.name }}</p>
        <button class="btn-primary px-4 py-2">Download</button>
      </div>
    </div>
  </div>
</template>

<script setup>
const files = [
  { name: "Surat Izin Kegiatan 2025.pdf" },
  { name: "Lampiran Persetujuan.pdf" },
];
</script>

<style scoped>
.page {
  @apply min-h-screen bg-[#0b1120] text-white py-16 px-5;
}
.title {
  @apply text-4xl font-bold text-blue-400 text-center mb-10;
}
.card {
  @apply max-w-3xl mx-auto bg-white/5 border border-white/10 p-8 rounded-2xl;
}
.file-item {
  @apply flex items-center justify-between bg-white/5 border border-white/10 p-4 rounded-xl;
}
.btn-primary {
  @apply bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold shadow;
}
</style>
