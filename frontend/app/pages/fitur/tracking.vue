<template>
  <div class="tracking-wrapper">
    <div class="header">
      <h1 class="title">Detail Tracking Dokumen</h1>
      <p class="subtitle">Pantau progres dokumen Anda secara real‑time</p>
    </div>

    <div class="section">
      <h2 class="section-title">Status Saat Ini</h2>
      <div class="current-status">
        <span
          class="status-badge"
          :class="current.done ? 'bg-green-500' : 'bg-yellow-500'"
        >
          {{ current.done ? "Selesai" : "Diproses" }}
        </span>
        <p class="status-text">{{ current.text }}</p>
      </div>
    </div>

    <div class="section">
      <h2 class="section-title">Riwayat Proses</h2>

      <div class="timeline">
        <div v-for="(s, i) in status" :key="i" class="timeline-item">
          <div class="dot" :class="s.done ? 'dot-done' : 'dot-pending'"></div>
          <div class="content">
            <p
              class="step-title"
              :class="s.done ? 'text-green-400' : 'text-gray-400'"
            >
              {{ s.text }}
            </p>
            <p v-if="s.detail" class="step-detail">{{ s.detail }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const status = [
  {
    text: "Pengajuan dikirim",
    done: true,
    detail: "Dokumen berhasil diajukan ke sistem",
  },
  {
    text: "Menunggu verifikasi",
    done: true,
    detail: "Menunggu verifikasi dari pihak admin",
  },
  {
    text: "Diproses oleh Wakil Dekan III",
    done: false,
    detail: "Sedang dicek kelayakan dan persyaratan",
  },
  { text: "Izin diterbitkan", done: false },
];

const current = status.find((s) => !s.done) || status[status.length - 1];
</script>

<style scoped>
.tracking-wrapper {
  @apply max-w-4xl mx-auto py-10 px-6 text-white;
}

.header .title {
  @apply text-4xl font-bold text-blue-400;
}
.subtitle {
  @apply text-gray-300 mt-1;
}

.section {
  @apply mt-10;
}
.section-title {
  @apply text-xl font-semibold text-gray-200 mb-4;
}

.current-status {
  @apply flex items-center gap-4 bg-white/5 border border-white/10 p-4 rounded-xl;
}

.status-badge {
  @apply text-white px-3 py-1 rounded-lg text-sm shadow;
}

.status-text {
  @apply text-lg;
}

.timeline {
  @apply space-y-6 border-l border-white/10 pl-6;
}

.timeline-item {
  @apply relative flex gap-4;
}

.dot {
  @apply absolute -left-3 w-5 h-5 rounded-full border-2 border-gray-600 bg-gray-800;
}
.dot-done {
  @apply bg-green-500 border-green-400 shadow-lg shadow-green-500/40;
}
.dot-pending {
  @apply bg-gray-600 border-gray-500;
}

.content {
  @apply ml-3;
}

.step-title {
  @apply text-lg font-medium;
}

.step-detail {
  @apply text-gray-400 text-sm mt-1;
}
</style>
