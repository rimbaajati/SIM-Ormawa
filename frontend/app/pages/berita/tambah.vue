<template>
  <div class="bg-[#0f1624] min-h-screen text-white py-10 px-4">
    
    <div class="container mx-auto max-w-2xl mb-6">
      <NuxtLink to="/berita" class="text-[#FFD700] hover:text-[#FFA500] transition block font-medium">← Kembali ke Daftar</NuxtLink>
    </div>

    <div class="flex flex-col items-center justify-center">
      
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
              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#FFA500] outline-none transition-all" 
              placeholder="Masukkan judul berita"
              required
          />
        </div>

        <!-- Upload Foto (PERUBAHAN DISINI) -->
        <div>
          <label for="foto" class="block text-sm font-medium text-white/70 mb-1">Upload Foto</label>
          <!-- Kita tambahkan @change="handleFileChange" -->
          <input 
              type="file"
              id="foto"
              @change="handleFileChange"
              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#FFA500] file:text-[#08101a] hover:file:bg-[#FF8C00]" 
              accept="image/*"
          />
          <p class="text-xs text-gray-500 mt-1">*Maksimal 2MB (JPG/PNG)</p>
        </div>

        <!-- Isi Berita -->
        <div>
          <label for="isi" class="block text-sm font-medium text-white/70 mb-1">Isi Berita</label>
          <textarea 
              id="isi"
              v-model="isi" 
              class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#FFA500] outline-none transition-all" 
              rows="10" 
              placeholder="Tulis konten berita..."
              required
          ></textarea>
        </div>

        <div class="text-center">
          <button 
            type="submit" 
            :disabled="loading"
            class="bg-[#FFA500] text-[#08101a] font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-[#FF8C00] transition duration-200 disabled:opacity-60"
          >
            <span v-if="loading">Mengupload...</span>
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
const fileGambar = ref(null) // Variabel penampung file
const loading = ref(false)
const error = ref(null)

useHead({ title: 'Tambah Berita - SIM Ormawa' });

// 1. Fungsi untuk menangkap file saat user memilih gambar
const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    fileGambar.value = file;
  }
}

async function submit() {
  error.value = null;
  loading.value = true;
  
  const formData = new FormData();
  formData.append('judul', judul.value);
  formData.append('isi', isi.value);
  if (fileGambar.value) {
    formData.append('gambar', fileGambar.value);
  }

  // --- DEBUGGING TOKEN ---
  const token = localStorage.getItem('auth_token');
  console.log("Token yang dikirim:", token); // Cek Console browser (F12)

  try {
    // Kita paksa header Authorization manual disini untuk memastikan
    await $api.post("/berita", formData, {
      headers: {
        'Authorization': `Bearer ${token}`, // Paksa kirim token
        'Content-Type': 'multipart/form-data' // Paksa tipe konten
      }
    });

    alert("Berita berhasil ditambahkan!");
    navigateTo("/berita");
    
  } catch (e) {
    console.error("FULL ERROR:", e);
    // Tampilkan pesan error detail dari Laravel
    if (e.response) {
      console.log("Status Code:", e.response.status);
      console.log("Data Error:", e.response.data);
      error.value = `Error ${e.response.status}: ${e.response.data.message || JSON.stringify(e.response.data)}`;
    } else {
      error.value = "Gagal terhubung ke server.";
    }
  } finally {
    loading.value = false;
  }
}
</script>