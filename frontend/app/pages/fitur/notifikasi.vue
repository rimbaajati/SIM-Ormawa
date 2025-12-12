<template>
  <div class="page">
    <h1 class="title">Notifikasi Revisi</h1>

    <div class="card">
      <div class="notif" v-for="n in notifs" :key="n.msg">
        <p class="notif-title">{{ n.title }}</p>
        <p class="notif-msg">{{ n.msg }}</p>
        <span class="time">{{ n.time }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
const notifs = [
  {
    title: "Revisi Proposal",
    msg: "Harap perbaiki bab 2 dan 4.",
    time: "1 jam lalu",
  },
  { title: "Revisi RAB", msg: "Penyesuaian biaya konsumsi.", time: "Kemarin" },
];
</script>

<style scoped>
.page {
  min-height: 100vh;
  background-color: #0b1120; /* bg-[#0b1120] */
  color: white; /* text-white */
  padding: 4rem 1.25rem; /* py-16 px-5 (16*0.25=4rem, 5*0.25=1.25rem) */
}

.title {
  font-size: 2.25rem; /* text-4xl */
  font-weight: 700; /* font-bold */
  color: #60a5fa; /* text-blue-400 */
  text-align: center; /* text-center */
  margin-bottom: 2.5rem; /* mb-10 (10*0.25=2.5rem) */
}

.card {
  max-width: 48rem; /* max-w-3xl (asumsi 3xl di Tailwind v2/3 adalah 48rem/768px) */
  margin-left: auto; /* mx-auto */
  margin-right: auto; /* mx-auto */
  background-color: rgba(255, 255, 255, 0.05); /* bg-white/5 */
  border: 1px solid rgba(255, 255, 255, 0.1); /* border border-white/10 */
  padding: 2rem; /* p-8 (8*0.25=2rem) */
  border-radius: 1rem; /* rounded-2xl (2*0.5=1rem) */
  display: flex; /* Untuk space-y-6 */
  flex-direction: column; /* Untuk space-y-6 */
  gap: 1.5rem; /* space-y-6 (6*0.25=1.5rem) */
}

.notif {
  background-color: rgba(255, 255, 255, 0.05); /* bg-white/5 */
  border: 1px solid rgba(255, 255, 255, 0.1); /* border border-white/10 */
  padding: 1rem; /* p-4 (4*0.25=1rem) */
  border-radius: 0.75rem; /* rounded-xl (1*0.75=0.75rem) */
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); /* shadow (Tailwind default) */
  /* Menambahkan sedikit margin-bottom untuk memisahkan notifikasi,
     menggantikan space-y-4 di template asli yang sudah dihandle oleh gap di .card */
}

.notif-title {
  font-weight: 600; /* font-semibold */
  color: #93c5fd; /* text-blue-300 */
  margin-bottom: 0.25rem; /* Sedikit pemisah antara judul dan pesan */
}

.notif-msg {
  color: rgba(255, 255, 255, 0.7); /* text-white/70 */
  margin-bottom: 0.5rem; /* Sedikit pemisah antara pesan dan waktu */
}

.time {
  font-size: 0.75rem; /* text-xs */
  color: rgba(255, 255, 255, 0.4); /* text-white/40 */
  display: block; /* Agar waktu berada di baris baru */
}
</style>