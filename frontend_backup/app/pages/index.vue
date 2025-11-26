<template>
  <section id="fitur" class="features container">
    <h2 class="section-title">Fitur Utama</h2>
    <div class="grid">
      <div v-for="f in features" :key="f.title" class="card">
        <div class="icon">{{ f.icon }}</div>
        <h3>{{ f.title }}</h3>
        <p>{{ f.desc }}</p>
      </div>
    </div>
  </section>

  <section id="tentang" class="about container">
    <h2 class="section-title">Tentang SIM Ormawa</h2>
    <p class="muted">
      SIM Ormawa hadir untuk mempermudah organisasi mahasiswa dalam pengelolaan kegiatan
      dan dokumen secara digital, aman, dan transparan.
    </p>
  </section>
</template>

<script setup>
const list = [
  'Pengajuan kegiatan online',
  'Pengisian form detail kegiatan (nama, waktu, tempat, anggaran)',
  'Upload proposal, RAB, rundown, TOR',
  'Tracking status real-time',
  'Notifikasi revisi & persetujuan',
  'Download dokumen izin kegiatan'
]

const features = [
  { icon: '📝', title: 'Pengajuan Online', desc: 'Ajukan kegiatan secara digital dengan cepat.' },
  { icon: '📋', title: 'Form Detail Lengkap', desc: 'Isi data kegiatan dengan mudah & terstruktur.' },
  { icon: '📤', title: 'Upload Dokumen', desc: 'Proposal, RAB, TOR, semuanya tersimpan aman.' },
  { icon: '🔔', title: 'Notifikasi Revisi', desc: 'Dapatkan pemberitahuan otomatis.' },
  { icon: '📊', title: 'Tracking Real-time', desc: 'Pantau progres tanpa menunggu.' },
  { icon: '⬇️', title: 'Download Izin', desc: 'Unduh dokumen legal kegiatan.' }
]
</script>

<style scoped>
.container { max-width:1100px; margin:0 auto; padding: 0 20px; }
.section-title { text-align:center; font-size:28px; margin:18px 0 28px; color:var(--muted); }

.hero { display:grid; grid-template-columns: 1fr 460px; gap:48px; align-items:center; padding:36px 0 60px; }
.hero-left { color: #e6f7ff; }
.eyebrow { color: rgba(255,255,255,.6); font-weight:700; margin-bottom:8px; }
.hero-title { font-size:42px; line-height:1.04; margin:0 0 14px; color: #fff; }
.lead { color: rgba(255,255,255,.7); max-width:640px; }

.feature-list { margin-top:18px; color: rgba(255,255,255,.85); list-style:none; padding-left:0; }
.feature-list li { margin:10px 0; padding-left:18px; position:relative; }
.feature-list li::before { content:'✓'; position:absolute; left:0; color:var(--neon); font-weight:800; }

.hero-actions { margin-top:20px; display:flex; gap:12px; }

.hero-right .mockup { width:100%; border-radius:16px; overflow:hidden; box-shadow: 0 30px 80px rgba(10,20,30,.6); border:1px solid rgba(255,255,255,.04); }
.hero-right img { width:100%; display:block; }

.grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); gap:20px; }
.card { padding:28px; border-radius:12px; background: linear-gradient(180deg, rgba(255,255,255,.02), rgba(255,255,255,.01)); border:1px solid rgba(255,255,255,.04); text-align:center; }
.card .icon { font-size:34px; margin-bottom:12px; }

.muted { color: rgba(255,255,255,.6); max-width:760px; margin:0 auto; text-align:center; }

@media (max-width: 880px) {
  .hero { grid-template-columns: 1fr; }
  .hero-right { order: -1; }
}
</style>
