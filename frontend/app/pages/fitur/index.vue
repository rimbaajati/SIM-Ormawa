<template>
  <!-- ======================== HERO TENTANG ======================== -->
  <section id="tentang" class="hero-about">
    <img src="/bg-fituratas.jpg" alt="Background Image" class="bg-image" />

    <div class="hero-content">
      <h1 class="hero-title">
        KELOLA KEGIATAN ONLINE <br />
        DENGAN LEBIH CEPAT
      </h1>

      <p class="hero-sub">
        Ajukan, pantau, dan kelola kegiatan Ormawa dalam satu sistem terpadu.
      </p>

      <div class="hero-buttons">
        <NuxtLink to="/fitur/pengajuan" class="btn-primary"
          >AJUKAN SEKARANG</NuxtLink
        >
        <NuxtLink to="/fitur/tentang" class="btn-secondary"
          >PELAJARI LEBIH LANJUT</NuxtLink
        >
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
      </NuxtLink>
    </div>
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
  { slug: "pengajuan", icon: "📝", title: "Pengajuan Online" },
  { slug: "formdetail", icon: "📋", title: "Form Detail Lengkap" },
  { slug: "uploaddokumen", icon: "📤", title: "Upload Dokumen" },
  { slug: "notifikasi", icon: "🔔", title: "Notifikasi Revisi" },
  { slug: "tracking/[id]", icon: "📊", title: "Tracking Real-time" },
  { slug: "download", icon: "⬇️", title: "Download Izin" },
];

const stats = ref([
  { label: "ORTOM", value: 4, display: "00" },
  { label: "UKM", value: 6, display: "00" },
  { label: "ORMAWA", value: 12, display: "00" },
]);

const startAnimation = () => {
  stats.value.forEach((item) => {
    let count = 0;
    const interval = setInterval(() => {
      count++;
      item.display = count < 10 ? "0" + count : count.toString();
      if (count >= item.value) clearInterval(interval);
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

<style scoped>
/* ===========================
   CONTAINER & GLOBAL
=========================== */
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

.section-title {
  text-align: center;
  font-size: 32px;
  margin: 18px 0 28px;
  font-family: "Times New Roman", serif;
  font-weight: 700;
  letter-spacing: 0.5px;
  color: #000;
  opacity: 0;
  animation: fadeSlideUp 0.6s ease-out forwards;
}

/* ===========================
   HERO BACKGROUND
=========================== */
.bg-image {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top;
  z-index: 0;
  animation: fadeIn 0.9s ease-out forwards;
}

/* ===========================
   HERO SECTION
=========================== */
.hero-about {
  width: 100%;
  position: relative;
  color: white;
  min-height: 600px;
  padding: 180px 20px 160px;
  overflow: hidden;
}

.hero-about::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: 1;
  background: linear-gradient(
    to top,
    rgba(255, 255, 255, 1) 0%,
    rgba(255, 255, 255, 0.85) 18%,
    rgba(255, 255, 255, 0.45) 38%,
    rgba(255, 255, 255, 0.1) 60%,
    rgba(255, 255, 255, 0) 100%
  );
  backdrop-filter: blur(0.8px);
}

.hero-content {
  max-width: 850px;
  margin: 0 auto;
  z-index: 2;
  position: relative;
}

.hero-title {
  font-size: 42px;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.5px;
  line-height: 1.15;
  text-align: center;
  text-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
  opacity: 0;
  animation: fadeSlideUp 0.6s ease-out 0.2s forwards;
}

.hero-sub {
  margin-top: 10px;
  font-size: 17px;
  color: rgba(255, 255, 255, 0.88);
  font-weight: 300;
  letter-spacing: 0.4px;
  line-height: 1.35;
  text-align: center;
  opacity: 0;
  animation: fadeSlideUp 0.6s ease-out 0.35s forwards;
}

/* Buttons */
.hero-buttons {
  margin-top: 28px;
  display: flex;
  justify-content: center;
  gap: 12px;
  opacity: 0;
  animation: fadeSlideUp 0.6s ease-out 0.5s forwards;
}

.btn-primary,
.btn-secondary {
  padding: 10px 24px;
  border-radius: 8px;
  font-weight: 500;
  text-decoration: none;
  letter-spacing: 0.6px;
  font-size: 14px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: 0.28s ease;
}

.btn-primary {
  background: #fff;
  color: #111;
  border: 1px solid rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(6px);
}

.btn-primary:hover {
  background: rgba(255, 255, 255, 0.85);
  transform: translateY(-1.5px);
}

.btn-secondary {
  background: transparent;
  color: #fff;
  border: 1.4px solid rgba(255, 255, 255, 0.65);
  backdrop-filter: blur(6px);
}

.btn-secondary:hover {
  background: rgba(255, 255, 255, 0.15);
  transform: translateY(-1.5px);
}

/* ===========================
   FITUR
=========================== */
.features {
  margin-bottom: 100px;
}

.features .card,
.features .card h3,
.features .card p {
  font-family: "Poppins", sans-serif;
}

.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 35px;
  margin-top: 30px;
  opacity: 0;
  animation: fadeIn 0.7s ease-out forwards 0.25s;
}

.card {
  padding: 40px 20px;
  height: 180px;
  border-radius: 36px;
  background: #fff;
  border: 1px solid rgba(180, 160, 255, 0.08);
  box-shadow: 0 8px 25px rgba(180, 160, 255, 0.22);

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;

  transition: 0.25s ease;

  opacity: 0;
  animation: scaleIn 0.5s ease-out forwards;
}

.card:nth-child(1) { animation-delay: 0.2s; }
.card:nth-child(2) { animation-delay: 0.32s; }
.card:nth-child(3) { animation-delay: 0.44s; }
.card:nth-child(4) { animation-delay: 0.56s; }
.card:nth-child(5) { animation-delay: 0.68s; }
.card:nth-child(6) { animation-delay: 0.80s; }

.card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(150, 130, 255, 0.28);
}

.card .icon {
  font-size: 64px;
  margin-bottom: 18px;
}

.card h3 {
  font-size: 18px;
  font-weight: 600;
  color: #111;
}

.card p {
  font-size: 14px;
  color: #666;
  margin-top: 6px;
}

/* ===========================
   STATISTIK
=========================== */
.stats-wrapper {
  width: 100%;
  padding: 90px 20px;
  position: relative;
  overflow: hidden;
  background-image: url("/bg-fitur.jpg");
  background-size: cover;
  background-position: center;
}

.stats-wrapper::before {
  content: "";
  position: absolute;
  inset: 0;
  top: 0;
  height: 55%;
  z-index: 1;
  pointer-events: none;

  background: linear-gradient(
    to bottom,
    rgba(255, 255, 255, 1) 0%,
    rgba(255, 255, 255, 0.85) 20%,
    rgba(255, 255, 255, 0.4) 50%,
    rgba(255, 255, 255, 0) 100%
  );
  backdrop-filter: blur(1px);
}

.stats-wrapper::after {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 330px;
  z-index: 1;
  pointer-events: none;

  background: linear-gradient(
    to bottom,
    rgba(0, 0, 0, 0) 0%,
    rgba(0, 0, 0, 0.2) 20%,
    rgba(0, 0, 0, 0.4) 40%,
    rgba(0, 0, 0, 0.65) 65%,
    rgba(0, 0, 0, 0.9) 85%,
    rgba(0, 0, 0, 1) 100%
  );
  backdrop-filter: blur(1px);
}

.stats-wrapper > * {
  position: relative;
  z-index: 2;
}

.stats-container {
  display: flex;
  justify-content: center;
  gap: 60px;
  flex-wrap: wrap;
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

  opacity: 0;
  animation: scaleIn 0.6s ease-out forwards;
}

.stat-circle:nth-child(1) { animation-delay: 0.2s; }
.stat-circle:nth-child(2) { animation-delay: 0.38s; }
.stat-circle:nth-child(3) { animation-delay: 0.56s; }

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

/* Fade animation on scroll */
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

/* ===========================
   ANIMATION KEYFRAMES
=========================== */

@keyframes fadeSlideUp {
  0% {
    opacity: 0;
    transform: translateY(26px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}

@keyframes scaleIn {
  0% { transform: scale(0.82); opacity: 0; }
  100% { transform: scale(1); opacity: 1; }
}
</style>
