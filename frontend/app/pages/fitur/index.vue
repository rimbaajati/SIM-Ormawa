<template>
  <!-- ======================== HERO TENTANG ======================== -->
  <section id="tentang" class="hero-about">
    <video class="bg-video" autoplay muted loop playsinline>
      <source src="#" type="video/mp4" />
    </video>

    <div class="hero-content">
      <h1 class="hero-title">
        KELOLA KEGIATAN ONLINE <br />
        DENGAN MUDAH
      </h1>

      <p class="hero-sub">
        Ajukan, Pantau, dan Dapatkan Persetujuan dalam Sekejap.
      </p>

      <div class="hero-buttons">
        <NuxtLink to="/fitur/pengajuan" class="btn-primary">
          AJUKAN SEKARANG
        </NuxtLink>
        <NuxtLink to="/fitur/tentang" class="btn-secondary">
          PELAJARI LEBIH LANJUT
        </NuxtLink>
      </div>
    </div>
  </section>

  <!-- ======================== FITUR ======================== -->
  <section class="features container">
    <h2 class="section-title">FITUR</h2>

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

  <!-- ======================== TENTANG SIM ORMAWA ======================== -->
  <section class="about container">
    <h2 class="section-title">Tentang SIM Ormawa</h2>
    <p class="muted">
      SIM Ormawa hadir untuk mempermudah organisasi mahasiswa dalam pengelolaan
      kegiatan dan dokumen secara digital, aman, dan transparan.
    </p>
  </section>

  <!-- ======================== STATISTIK ======================== -->
  <section id="statistik" class="stats-wrapper">
    <div class="stats-container">
      <div
        v-for="(s, i) in stats"
        :key="i"
        class="stat-circle fade-anim rotate"
      >
        <h3>{{ s.display }}</h3>
        <p>{{ s.label }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from "vue";

const features = [
  {
    slug: "pengajuan",
    icon: "📝",
    title: "Pengajuan Online",
    desc: "Ajukan kegiatan secara digital dengan cepat.",
  },
  {
    slug: "formdetail",
    icon: "📋",
    title: "Form Detail Lengkap",
    desc: "Isi data kegiatan dengan mudah & terstruktur.",
  },
  {
    slug: "uploaddokumen",
    icon: "📤",
    title: "Upload Dokumen",
    desc: "Proposal, RAB, TOR, semuanya tersimpan aman.",
  },
  {
    slug: "notifikasi",
    icon: "🔔",
    title: "Notifikasi Revisi",
    desc: "Dapatkan pemberitahuan otomatis.",
  },
  {
    slug: "tracking/[id]",
    icon: "📊",
    title: "Tracking Real-time",
    desc: "Pantau progres tanpa menunggu.",
  },
  {
    slug: "download",
    icon: "⬇️",
    title: "Download Izin",
    desc: "Unduh dokumen legal kegiatan.",
  },
];

const stats = ref([
  { label: "ORTOM", value: 4, display: "00" },
  { label: "UKM", value: 6, display: "00" },
  { label: "ORMAWA", value: 10, display: "00" },
]);

const startAnimation = () => {
  stats.value.forEach((item) => {
    let count = 0;
    const target = item.value;

    const interval = setInterval(() => {
      count++;
      item.display = count < 10 ? "0" + count : count.toString();
      if (count >= target) clearInterval(interval);
    }, 40);
  });
};

onMounted(() => {
  const section = document.getElementById("statistik");

  const observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        startAnimation();
        observer.disconnect();
      }
    },
    { threshold: 0.4 }
  );

  observer.observe(section);
});
</script>

<!-- ======================== STYLE GABUNGAN ======================== -->
<style scoped>
/* ===== GENERAL ===== */
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}
.section-title {
  text-align: center;
  font-size: 32px;
  margin: 18px 0 28px;
  color: #000;
}

/* ===== HERO ===== */
.hero-about {
  width: 100%;
  padding: 110px 20px;
  position: relative;
  color: white;
  overflow: hidden;
}
.bg-video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
}
.hero-about::after {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at center, #0f1d3a99, #050c1acc 50%);
  z-index: 1;
}
.hero-content {
  max-width: 850px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}
.hero-title {
  font-size: 42px;
  font-weight: 700;
  color: #ffa500;
}
.hero-sub {
  font-size: 18px;
  margin-top: 12px;
  color: #eee;
}
.hero-buttons {
  margin-top: 24px;
  display: flex;
  gap: 14px;
}

/* Buttons */
.btn-primary,
.btn-secondary {
  padding: 12px 22px;
  border-radius: 6px;
  font-weight: 600;
  text-decoration: none;
  transition: 0.25s;
}
.btn-primary {
  background: #1a62ff;
  color: white;
}
.btn-primary:hover {
  background: #0d4fe0;
}
.btn-secondary {
  background: #ffa500;
  color: white;
}
.btn-secondary:hover {
  background: #bb7a00;
}

/* ===== FITUR GRID ===== */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}
.card {
  padding: 28px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.96);
  border: 1px solid rgba(0, 0, 0, 0.1);
  text-align: center;
  transition: 0.25s ease;
  color: #000;
}
.card:hover {
  transform: translateY(-6px);
  border-color: #333;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.card .icon {
  font-size: 34px;
  margin-bottom: 12px;
}

.muted {
  color: #333;
  text-align: center;
  max-width: 760px;
  margin: 0 auto;
}

/* ===== STATISTIK ===== */
.stats-wrapper {
  width: 100%;
  padding: 90px 20px;
  position: relative;
  background-image: url("bg-fitur.jpg");
  background-size: cover;
  background-position: center;
}
.stats-wrapper::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: 1;
  background: linear-gradient(
      to bottom,
      rgba(255, 255, 255, 1) 0%,
      rgba(255, 255, 255, 0.85) 15%,
      rgba(255, 255, 255, 0.55) 35%,
      rgba(255, 255, 255, 0.15) 60%,
      rgba(255, 255, 255, 0) 100%
    ),
    linear-gradient(
      to top,
      rgba(0, 0, 0, 0.9) 0%,
      rgba(0, 0, 0, 0.6) 25%,
      rgba(0, 0, 0, 0.3) 50%,
      rgba(0, 0, 0, 0) 100%
    );
  backdrop-filter: blur(5px);
}
.stats-container {
  display: flex;
  justify-content: center;
  gap: 60px;
  flex-wrap: wrap;
  position: relative;
  z-index: 3;
}
.stat-circle {
  width: 170px;
  height: 170px;
  border-radius: 50%;
  border: 8px solid #ffa500;
  background: #00000084;
  color: white;

  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: 0.25s;
}
.stat-circle h3 {
  font-size: 46px;
  margin: 0;
}
.stat-circle p {
  margin-top: 6px;
  font-size: 15px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
}

.fade-anim {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.2s forwards;
}
@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
