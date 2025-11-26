<template>
  <div class="page">
    <h1 class="title">Tracking Status Real-Time</h1>

    <div class="card space-y-6">

      <div class="step" v-for="s in status" :key="s.text">
        <div :class="['dot', s.done ? 'bg-green-400' : 'bg-white/20']"></div>
        <p :class="s.done ? 'text-green-300' : 'text-white/60'">{{ s.text }}</p>
      </div>

    </div>
  </div>
</template>

<script setup>
const status = [
  { text: "Pengajuan dikirim", done: true },
  { text: "Menunggu verifikasi", done: true },
  { text: "Diproses Wakil Dekan III", done: false },
  { text: "Izin diterbitkan", done: false }
]
</script>

<style scoped>
.page { @apply min-h-screen bg-[#0b1120] text-white py-16 px-5; }
.title { @apply text-4xl font-bold text-blue-400 text-center mb-10; }
.card {
  @apply max-w-3xl mx-auto bg-white/5 border border-white/10 p-8 rounded-2xl;
}
.step { @apply flex items-center gap-4; }
.dot { @apply w-4 h-4 rounded-full shadow; }
</style>
