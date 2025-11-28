<template>
  <section id="fitur" class="features container">
    <h2 class="section-title">Fitur Utama</h2>

    <div class="grid">
      <NuxtLink
        v-for="f in features"
        :key="f.slug"
        :to="`/fitur/${f.slug}`"
        class="card cursor-pointer hover:scale-[1.03] transition"
      >
        <div class="icon">{{ f.icon }}</div>
        <h3>{{ f.title }}</h3>
        <p>{{ f.desc }}</p>
      </NuxtLink>
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
const features = [
  { slug: "pengajuan", icon: "📝", title: "Pengajuan Online", desc: "Ajukan kegiatan secara digital dengan cepat." },
  { slug: "formdetail", icon: "📋", title: "Form Detail Lengkap", desc: "Isi data kegiatan dengan mudah & terstruktur." },
  { slug: "uploaddokumen", icon: "📤", title: "Upload Dokumen", desc: "Proposal, RAB, TOR, semuanya tersimpan aman." },
  { slug: "notifikasi", icon: "🔔", title: "Notifikasi Revisi", desc: "Dapatkan pemberitahuan otomatis." },
  { slug: "tracking/[id]", icon: "📊", title: "Tracking Real-time", desc: "Pantau progres tanpa menunggu." },
  { slug: "download", icon: "⬇️", title: "Download Izin", desc: "Unduh dokumen legal kegiatan." }
];
</script>

<style scoped>
.container { max-width:1100px; margin:0 auto; padding: 0 20px; }
/* SECTION TITLE DIUBAH KE HITAM */
.section-title { text-align:center; font-size:28px; margin:18px 0 28px; color: #000; } 

.grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); gap:20px; }

/* CARD FITUR UTAMA – KIklik */
.card {
  padding:28px;
  border-radius:12px;
  /* Hapus atau ganti background jika background sebelumnya gelap, 
     namun saya pertahankan agar Anda bisa menyesuaikan */
  background: linear-gradient(180deg, rgba(255,255,255,.98), rgba(255,255,255,.95)); 
  border:1px solid rgba(0,0,0,.1);
  text-align:center;
  transition: .25s ease;
  cursor: pointer;
  text-decoration: none;
  /* WARNA TEKS CARD DIUBAH KE HITAM */
  color: #000; 
}
.card:hover {
  transform: translateY(-6px);
  /* Ubah warna hover border dan shadow agar kontras dengan teks hitam */
  border-color: #333; 
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); 
}

.card .icon { font-size:34px; margin-bottom:12px; }

/* TEKS MUTED DIUBAH KE HITAM */
.muted { color: #333; max-width:760px; margin:0 auto; text-align:center; } 
</style>