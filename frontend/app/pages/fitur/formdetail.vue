<template>
  <div class="page">
    <h1 class="title">Form Detail Kegiatan</h1>

    <div class="card">
      <form class="space-y-5">
        <div>
          <label class="label">Nama Penanggung Jawab</label>
          <input type="text" class="input" placeholder="Nama lengkap" />
        </div>

        <div>
          <label class="label">Tempat Pelaksanaan</label>
          <input
            type="text"
            class="input"
            placeholder="Aula / Gedung / Online"
          />
        </div>

        <div>
          <label class="label">Estimasi Anggaran</label>
          <input type="number" class="input" placeholder="Rp 0" />
        </div>

        <button class="btn-primary w-full">Simpan Data</button>
      </form>
    </div>
  </div>
</template>

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
.input {
  @apply mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl
    text-white placeholder-white/40 outline-none focus:ring-2 focus:ring-blue-500;
}
.btn-primary {
  @apply py-3 bg-blue-600 hover:bg-blue-700 transition rounded-xl font-semibold text-white shadow-lg;
}
</style>
