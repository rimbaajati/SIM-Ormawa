<template>
  <div class="page">
    <h1 class="title">Upload Dokumen Kegiatan</h1>

    <div class="card space-y-6">
      <div v-for="item in dokumenList" :key="item.label">
        <label class="label">{{ item.label }}</label>
        <input type="file" class="input-file" />
      </div>

      <button class="btn-primary w-full">Upload Semua Dokumen</button>
    </div>
  </div>
</template>

<script setup>
const dokumenList = [
  { label: "Upload Proposal" },
  { label: "Upload RAB" },
  { label: "Upload Rundown" },
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
  @apply max-w-3xl mx-auto bg-white/5 border border-white/10 p-8 rounded-2xl shadow-xl;
}

.label {
  @apply text-sm text-white/70;
}

.input-file {
  @apply mt-2 w-full p-3 bg-white/5 border border-white/10 rounded-xl
    text-white/70 cursor-pointer
    file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-lg file:border-none;
}

.btn-primary {
  @apply py-3 bg-blue-600 hover:bg-blue-700 transition rounded-xl font-semibold text-white shadow-lg;
}
</style>
