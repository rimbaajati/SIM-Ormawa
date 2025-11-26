<template>
  <section id="fitur" class="features container">
    <h2 class="section-title">Fitur Utama</h2>

    <!-- CARD GRID -->
    <div class="grid">
      <div class="grid">
        <NuxtLink
          v-for="f in features"
          :key="f.title"
          :to="f.link"
          class="card cursor-pointer hover:scale-[1.02] transition"
        >
          <div class="icon">{{ f.icon }}</div>
          <h3>{{ f.title }}</h3>
          <p>{{ f.desc }}</p>
        </NuxtLink>
      </div>
    </div>
  </section>

  <section id="tentang" class="about container">
    <h2 class="section-title">Tentang SIM Ormawa</h2>
    <p class="muted">
      SIM Ormawa hadir untuk mempermudah organisasi mahasiswa dalam pengelolaan
      kegiatan dan dokumen secara digital, aman, dan transparan.
    </p>
  </section>
</template>

<script setup>
const features = [
  {
    icon: "📝",
    title: "Pengajuan Online",
    desc: "Ajukan kegiatan secara digital dengan cepat.",
    link: "/fitur/pengajuan-online",
  },
  {
    icon: "📋",
    title: "Form Detail Lengkap",
    desc: "Isi data kegiatan dengan mudah & terstruktur.",
    link: "/fitur/form-detail",
  },
  {
    icon: "📤",
    title: "Upload Dokumen",
    desc: "Proposal, RAB, TOR, semuanya tersimpan aman.",
    link: "/fitur/upload-dokumen",
  },
  {
    icon: "🔔",
    title: "Notifikasi Revisi",
    desc: "Dapatkan pemberitahuan otomatis.",
    link: "/fitur/notifikasi-revisi",
  },
  {
    icon: "📊",
    title: "Tracking Real-time",
    desc: "Pantau progres tanpa menunggu.",
    link: "/fitur/tracking",
  },
  {
    icon: "⬇️",
    title: "Download Izin",
    desc: "Unduh dokumen legal kegiatan.",
    link: "/fitur/download-izin",
  },
];
</script>

<style scoped>
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}
.section-title {
  text-align: center;
  font-size: 28px;
  margin: 18px 0 28px;
  color: var(--muted);
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}

/* CARD FITUR UTAMA – KIklik */
.card {
  padding: 28px;
  border-radius: 12px;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 0.02),
    rgba(255, 255, 255, 0.01)
  );
  border: 1px solid rgba(255, 255, 255, 0.04);
  text-align: center;
  transition: 0.25s ease;
  cursor: pointer;
  text-decoration: none;
  color: white;
}
.card:hover {
  transform: translateY(-6px);
  border-color: var(--neon);
  box-shadow: 0 0 20px rgba(0, 255, 200, 0.25);
}

.card .icon {
  font-size: 34px;
  margin-bottom: 12px;
}

.muted {
  color: rgba(255, 255, 255, 0.6);
  max-width: 760px;
  margin: 0 auto;
  text-align: center;
}
</style>
