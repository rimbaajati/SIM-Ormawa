<template>
  <div class="bg-[#0f1624] min-h-screen text-white py-10 px-4">
    
    <!-- Link Kembali (Dibiarkan di atas dan rata kiri) -->
    <div class="container mx-auto max-w-2xl mb-6">
      <NuxtLink to="/berita" class="text-[#FFD700] hover:text-[#FFA500] transition block font-medium">← Kembali ke Daftar</NuxtLink>
    </div>

    <!-- Kontainer Pemusatan Vertikal dan Horizontal -->
    <div class="flex flex-col items-center justify-center">
      
      <!-- Form Container -->
      <form @submit.prevent="submit" class="space-y-6 w-full max-w-2xl bg-[#1a2130] p-8 rounded-xl shadow-xl border border-white/10">
        
        <h1 class="text-3xl font-extrabold mb-4 text-white/90 text-center">Tambah Berita Baru</h1>

        <!-- Notifikasi Error -->
        <div v-if="error" class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg text-sm">
          {{ error }}
        </div>

        <!-- Judul -->
        <div>
          <label for="judul" class="block text-sm font-medium text-white/70 mb-1">Judul Berita</label>
          <input 
              id="judul"
              v-model="judul" 
              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#FFA500] focus:border-[#FFA500]/50 outline-none transition-all duration-200" 
              placeholder="Masukkan judul berita di sini"
              required
          />
        </div>

        <!-- Isi Berita -->
        <div>
          <label for="isi" class="block text-sm font-medium text-white/70 mb-1">Isi Berita</label>
          <textarea 
              id="isi"
              v-model="isi" 
              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#FFA500] focus:border-[#FFA500]/50 outline-none transition-all duration-200" 
              rows="10" 
              placeholder="Tulis konten berita secara lengkap di sini"
              required
          ></textarea>
        </div>

        <!-- Tombol Simpan (Memusatkan tombol di dalam form) -->
        <div class="text-center">
          <button 
            type="submit" 
            :disabled="loading"
            class="bg-[#FFA500] text-[#08101a] font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-[#FF8C00] transition duration-200 disabled:opacity-60 disabled:cursor-not-allowed"
          >
            <span v-if="loading">Menyimpan...</span>
            <span v-else>Simpan Berita</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const { $api } = useNuxtApp()
const judul = ref("")
const isi = ref("")
const loading = ref(false)
const error = ref(null)

// Menggunakan useHead untuk SEO
useHead({
  title: 'Tambah Berita - SIM Ormawa',
});

async function submit() {
  error.value = null;
  loading.value = true;
  
  // Payload dasar
  const payload = {
    judul: judul.value,
    isi: isi.value,
    // Asumsi ringkasan dibuat otomatis dari isi
    ringkasan: isi.value.substring(0, 150) + '...', 
  }

  try {
    // Panggil API POST
    await $api.post("/berita", payload);

    alert("Berita berhasil ditambahkan!");
    navigateTo("/berita");
  } catch (e) {
    console.error("Gagal menambah berita:", e);
    // Menampilkan pesan error yang lebih informatif
    error.value = e.response?.data?.message || "Gagal menambah berita. Silakan cek form dan koneksi Anda.";
  } finally {
    loading.value = false;
  }
}
</script>