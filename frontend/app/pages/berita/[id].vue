<template>
  <div class="bg-[#0f1624] min-h-screen py-10 text-white">
    
    <div class="container mx-auto px-4 lg:px-6">
      
      <div class="flex flex-col items-center text-center">
        <h1 class="text-4xl font-extrabold mb-6 text-white/90">Manajemen Berita</h1>

        <NuxtLink to="/berita/tambah" 
          class="bg-[#FFA500] text-[#08101a] font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-[#FF8C00] transition duration-200 text-base"
        >
          + Tambah Berita Baru
        </NuxtLink>
      </div>

      <div class="mt-12 w-full">
        
        <div v-if="loading" class="text-center py-12">
          <p class="text-xl text-[#FFD700] flex items-center justify-center space-x-3">
            <svg class="animate-spin h-5 w-5 text-[#FFD700]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Memuat data berita...</span>
          </p>
        </div>

        <div v-else-if="fetchError" class="text-center py-12 border border-red-600 bg-red-900/50 p-6 rounded-lg">
          <p class="text-red-400 font-semibold">Gagal Memuat Data</p>
          <p class="text-sm text-red-500 mt-2">{{ fetchError.message }}</p>
          <button @click="refresh()" class="mt-4 text-sm text-[#FFA500] hover:underline transition">Coba Muat Ulang</button>
        </div>

        <div v-else-if="!berita || berita.length === 0" class="text-center py-12 border border-white/10 bg-[#1a2130] p-6 rounded-lg">
          <p class="text-white/60">Belum ada berita yang ditambahkan. Mari buat yang pertama!</p>
        </div>

        <div v-else class="space-y-4">
          <div
            v-for="item in berita"
            :key="item.id"
            class="p-5 rounded-xl shadow-xl bg-[#1a2130] border border-white/10 hover:border-[#FFA500]/50 transition duration-200"
          >
            <h2 class="text-xl font-semibold text-white">{{ item.judul }}</h2>
            <p class="text-white/70 mt-1 mb-3 text-sm line-clamp-2">{{ item.ringkasan || 'Tidak ada ringkasan.' }}</p>

            <div class="flex gap-4 text-sm font-medium">
              <NuxtLink :to="`/berita/${item.id}`" class="text-[#FFA500] hover:text-[#FFD700] transition">Detail</NuxtLink>
              <NuxtLink :to="`/berita/tambah?id=${item.id}`" class="text-green-500 hover:text-green-400 transition">Edit</NuxtLink> 
              <button 
                @click="openDeleteModal(item.id, item.judul)" 
                class="text-red-500 hover:text-red-400 transition disabled:opacity-50"
                :disabled="isDeleting"
              >
                {{ isDeleting ? 'Menghapus...' : 'Hapus' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4 transition-opacity duration-300">
      <div class="bg-[#1a2130] p-6 rounded-xl shadow-2xl max-w-sm w-full border border-red-500/50 transform transition-transform duration-300 scale-100">
        <h3 class="text-xl font-bold text-white mb-4">Konfirmasi Penghapusan</h3>
        <p class="text-white/80 mb-6">
          Anda yakin ingin menghapus berita berjudul: 
          <span class="font-semibold text-[#FFA500] block mt-1">"{{ itemToDelete.judul }}"</span>?
          Aksi ini tidak dapat dibatalkan.
        </p>

        <div class="flex justify-end gap-3">
          <button 
            @click="showDeleteModal = false"
            class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition"
            :disabled="isDeleting"
          >
            Batal
          </button>
          <button 
            @click="hapus"
            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition disabled:bg-red-800"
            :disabled="isDeleting"
          >
            {{ isDeleting ? 'Ya, Menghapus...' : 'Ya, Hapus Permanen' }}
          </button>
        </div>
      </div>
    </div>

    <div v-if="toast.message" class="fixed bottom-5 right-5 z-50 p-4 rounded-lg shadow-lg text-white font-medium transition-all duration-300"
      :class="{
        'bg-green-600': toast.type === 'success',
        'bg-red-600': toast.type === 'error'
      }"
    >
      {{ toast.message }}
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'; // Tambahkan 'computed' di sini

// Mengambil instance $api dari plugin Nuxt
const { $api } = useNuxtApp();

// --- STATE ---
const showDeleteModal = ref(false);
const itemToDelete = ref({ id: null, judul: '' });
const isDeleting = ref(false);

const toast = ref({
  message: '',
  type: '',
  timeoutId: null,
});

// --- FUNGSI TOAST ---
function showToast(message, type = 'success', duration = 3000) {
  clearTimeout(toast.value.timeoutId);
  toast.value.message = message;
  toast.value.type = type;
  toast.value.timeoutId = setTimeout(() => {
    toast.value.message = '';
  }, duration);
}

// --- FUNGSI MODAL ---
function openDeleteModal(id, judul) {
  itemToDelete.value = { id, judul };
  showDeleteModal.value = true;
}


// --- 1. PENGAMBILAN DATA (useAsyncData) ---
const { 
  // Ganti nama 'data' menjadi 'berita' secara langsung
  data: berita, 
  pending: loading, 
  error: fetchError, 
  refresh 
} = await useAsyncData(
  'berita-list', 
  async () => {
    try {
      const res = await $api.get("/berita"); 
      // Ambil array data dari res.data.data (standar Laravel Resource) atau res.data
      return res.data.data || res.data; 
    } catch (e) {
      console.error('Error fetching berita:', e);
      // Lempar error untuk ditangkap oleh fetchError
      throw createError({ 
        statusCode: e.response?.status || 500, 
        message: e.response?.data?.message || 'Terjadi masalah saat berkomunikasi dengan API berita.'
      });
    }
  },
  // Pastikan default mengembalikan array
  { default: () => [] } 
);

// --- 2. FUNGSI HAPUS (Dijalankan dari Modal) ---
async function hapus() {
  const id = itemToDelete.value.id;
  if (!id) return;

  isDeleting.value = true;
  
  try {
    // Panggil endpoint DELETE API
    await $api.delete(`/berita/${id}`);
    
    // Memberi tahu pengguna
    showToast(`Berita "${itemToDelete.value.judul}" berhasil dihapus!`, 'success'); 

    // Muat ulang data daftar berita
    // Ini akan memanggil ulang fungsi di useAsyncData
    await refresh(); 
    
  } catch (e) {
    console.error("Gagal menghapus berita:", e);
    showToast("Gagal menghapus berita. Pastikan Anda memiliki izin.", 'error');
  } finally {
    // Tutup modal dan reset state
    showDeleteModal.value = false;
    isDeleting.value = false;
    itemToDelete.value = { id: null, judul: '' };
  }
}
</script>