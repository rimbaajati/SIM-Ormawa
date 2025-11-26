<template>
  <div class="page">
    <h1 class="title">Notifikasi Revisi</h1>

    <div class="card space-y-4">

      <div class="notif" v-for="n in notifs" :key="n.msg">
        <p class="font-semibold text-blue-300">{{ n.title }}</p>
        <p class="text-white/70">{{ n.msg }}</p>
        <span class="time">{{ n.time }}</span>
      </div>

    </div>
  </div>
</template>

<script setup>
const notifs = [
  { title: "Revisi Proposal", msg: "Harap perbaiki bab 2 dan 4.", time: "1 jam lalu" },
  { title: "Revisi RAB", msg: "Penyesuaian biaya konsumsi.", time: "Kemarin" }
]
</script>

<style scoped>
.page { @apply min-h-screen bg-[#0b1120] text-white py-16 px-5; }
.title { @apply text-4xl font-bold text-blue-400 text-center mb-10; }
.card {
  @apply max-w-3xl mx-auto bg-white/5 border border-white/10 p-8 rounded-2xl space-y-6;
}
.notif {
  @apply bg-white/5 border border-white/10 p-4 rounded-xl shadow;
}
.time {
  @apply text-xs text-white/40;
}
</style>
    