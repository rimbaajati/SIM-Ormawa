<template>
  <div class="error-page">
    <div class="container">
      <template v-if="error && error.statusCode === 404">
        <img
          src="/anjing-tidur-404.gif"
          alt="Anjing Tidur - Ilustrasi Error 404"
          class="error-image"
        />
        <h1>404 - Halaman Tidak Ditemukan</h1>
        <p>Maaf, halaman yang Anda cari tidak ada.</p>
      </template>

      <template v-else>
        <img
          src="/anjing-tidur-404.gif"
          alt="Anjing Tidur - Ilustrasi Error"
          class="error-image"
        />
        <h1>Sorry Yee Bree</h1>
        <p>Halaman Masih Dalam Proses Nihh, Mohon Sabar Dikit Yeee...</p>
      </template>

      <NuxtLink to="/" class="home-link">Balik ke Beranda Dulu</NuxtLink>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  layout: 'empty'
})

const { error } = defineProps({
  error: {
    type: Object,
    required: false
  }
})

const statusCode = error?.statusCode ?? 'Unknown'
useHead({
  title: statusCode === 404 ? '404 Tidak Ditemukan' : `Error ${statusCode}`
})
</script>

<style scoped>
/* ================= FULL PAGE STYLING ================= */
.error-page {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  width: 100%;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #ffffff, #ffffff);
  color: #ffffff;
  padding: 20px;
}

.container {
  width: 100%;
  max-width: 900px;
  padding: 40px 20px;
}

/* ================= TEXT & IMAGE ================= */
h1 {
  font-size: 3rem;
  color: #cc0000;
  margin-bottom: 10px;
}

p {
  margin-bottom: 30px;
  color: #555;
  font-size: 1.1rem;
}

.error-image {
  width: 220px;
  height: auto;
  margin: 2rem auto;
  display: block;
}

/* ================= BUTTON ================= */
.home-link {
  display: inline-block;
  padding: 12px 24px;
  background-color: #000000;
  color: #fff;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.home-link:hover {
  background-color: #4c4c4c;
  box-shadow: 0 6px 15px rgba(138, 138, 138, 0.4);
  transform: translateY(-2px);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
  h1 {
    font-size: 2rem;
  }
  p {
    font-size: 1rem;
  }
  .error-image {
    width: 180px;
  }
}
</style>
