<script setup>
import { ref, onMounted } from "vue";

const features = [
  { slug: "pengajuan", icon: "📝", title: "Pengajuan Online" },
  { slug: "formdetail", icon: "📋", title: "Form Detail Lengkap" },
  { slug: "uploaddokumen", icon: "📤", title: "Upload Dokumen" },
  { slug: "notifikasi", icon: "🔔", title: "Notifikasi Revisi" },
  { slug: "tracking", icon: "📊", title: "Tracking Real-time" },
  { slug: "download", icon: "⬇️", title: "Download Dokument" },
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
@import url("~/assets/css/fitur/fitur.css");
</style>

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
        <NuxtLink to="/user/error" class="btn-secondary"
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
