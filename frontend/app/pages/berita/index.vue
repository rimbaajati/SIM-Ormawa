<template>
  <!-- Background utama tetap mengisi layar penuh -->
  <div class="bg-[#0f1624] min-h-screen py-10 text-white"> 
    
    <!-- Kontainer Pembungkus untuk membatasi lebar dan memusatkan konten secara horizontal -->
    <div class="container mx-auto px-4 lg:px-6"> 
      
      <!-- Wrapper untuk Header dan Tombol Tambah, agar bisa di-center bersama -->
      <div class="flex flex-col items-center text-center">
        <h1 class="text-4xl font-extrabold mb-6 text-white/90">Manajemen Berita</h1>

        <!-- Tombol Tambah -->
        <NuxtLink to="/berita/tambah" 
          class="bg-[#FFA500] text-[#08101a] font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#FF8C00] transition duration-200 text-base"
        >
          + Tambah Berita Baru
        </NuxtLink>
      </div>

      <div class="mt-12 w-full">
        <!-- ⚠️ Penanganan Status Loading -->
        <div v-if="loading" class="text-center py-12">
          <p class="text-xl text-[#FFD700]">Memuat data berita... ⏳</p>
        </div>

        <!-- ❌ Penanganan Status Error -->
        <div v-else-if="error" class="text-center py-12 border border-red-600 bg-red-900/50 p-6 rounded-lg">
          <p class="text-red-400 font-semibold">Gagal Memuat Data</p>
          <p class="text-sm text-red-500 mt-2">{{ error.message }}</p>
          <button @click="refresh()" class="mt-4 text-sm text-[#FFA500] hover:underline transition">Coba Muat Ulang</button>
        </div>

        <!-- 📝 Penanganan Data Kosong -->
        <div v-else-if="!berita || berita.length === 0" class="text-center py-12 border border-white/10 bg-[#1a2130] p-6 rounded-lg">
          <p class="text-white/60">Belum ada berita yang ditambahkan. Mari buat yang pertama!</p>
        </div>

        <!-- ✅ Menampilkan Daftar Berita -->
        <div v-else class="space-y-4">
          <div
            v-for="item in berita"
            :key="item.id"
            class="p-5 rounded-xl shadow-xl bg-[#1a2130] border border-white/10 hover:border-[#FFA500]/50 transition duration-200"
          >
            <h2 class="text-xl font-semibold text-white">{{ item.judul }}</h2>
            <p class="text-white/70 mt-1 mb-3 text-sm line-clamp-2">{{ item.ringkasan || 'Tidak ada ringkasan.' }}</p>

            <div class="flex gap-4 text-sm font-medium">
              <!-- Tautan Detail -->
              <NuxtLink :to="`/berita/${item.id}`" class="text-[#FFA500] hover:text-[#FFD700] transition">Detail</NuxtLink>
              <!-- Tautan Edit -->
              <NuxtLink :to="`/berita/edit/${item.id}`" class="text-green-500 hover:text-green-400 transition">Edit</NuxtLink>
              <!-- Tombol Hapus -->
              <button @click="hapus(item.id)" class="text-red-500 hover:text-red-400 transition">Hapus</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Mengambil instance $api dari plugin Nuxt
const { $api } = useNuxtApp();

// --- 1. PENGAMBILAN DATA (useAsyncData) ---
const { 
  data: berita,      // Variabel reaktif berisi array berita 
  pending: loading,  // Variabel reaktif (boolean)
  error,             // Variabel reaktif (object) 
  refresh            // Fungsi untuk memuat ulang data secara manual
} = await useAsyncData(
  'berita-list', // Kunci unik untuk caching
  async () => {
    try {
      const res = await $api.get("/berita"); 
      return res.data; 
    } catch (e) {
      throw createError({ 
          statusCode: 500, 
          message: 'Terjadi masalah saat berkomunikasi dengan API berita.'
      });
    }
  },
  { default: () => [] } 
);

// --- 2. FUNGSI HAPUS ---
async function hapus(id) {
  // Menggunakan confirm bawaan
  if (!confirm("Apakah Anda yakin ingin menghapus berita ini secara permanen?")) {
    return;
  }

  try {
    // Panggil endpoint DELETE API
    await $api.delete(`/berita/${id}`);
    
    // Memberi tahu pengguna
    alert("Berita berhasil dihapus!"); 

    // Muat ulang data daftar berita 
    refresh(); 
    
  } catch (e) {
    console.error("Gagal menghapus berita:", e);
    alert("Gagal menghapus berita. Silakan coba lagi.");
  }
}
</script>