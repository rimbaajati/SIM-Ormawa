<template>
  <div 
    class="relative min-h-screen py-10 text-gray-800 font-sans bg-cover bg-center bg-fixed"
    style="background-image: url('/bg-fituratas.jpg');"
  >
    <div class="absolute inset-0 bg-gradient-to-b from-white/90 via-white/80 to-white pointer-events-none"></div>

    <div class="relative z-10 container mx-auto px-4 lg:px-6 animate-fade-in"> 
      
      <div class="flex flex-col items-center text-center mb-12">
        <h1 class="text-4xl font-extrabold mb-2 text-gray-900 tracking-tight drop-shadow-sm">Manajemen Berita</h1>
        <p class="text-gray-600 font-medium">Kelola informasi dan kegiatan organisasi Anda.</p>
        </div>
    
      <div class="w-full max-w-6xl mx-auto pb-20"> <div v-if="loading" class="text-center py-20">
          <div class="flex flex-col items-center justify-center space-y-4">
            <svg class="animate-spin h-10 w-10 text-[#FFA500]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-600 font-medium">Sedang memuat data berita...</span>
          </div>
        </div>
    
        <div v-else-if="fetchError" class="text-center py-12 border border-red-200 bg-white/80 backdrop-blur p-6 rounded-xl mx-auto max-w-2xl shadow-lg">
          <div class="text-red-500 text-5xl mb-3">⚠️</div>
          <h3 class="text-red-700 font-bold text-lg">Gagal Terhubung ke Server</h3>
          <p class="text-sm text-red-600 mt-2 mb-4">{{ fetchError.message }}</p>
          <button @click="refresh()" class="px-6 py-2 bg-white border border-red-200 text-red-600 rounded-full hover:bg-red-50 transition shadow-sm font-medium">
            Coba Muat Ulang
          </button>
        </div>

        <div v-else>
          <div v-if="berita.length === 0" class="text-center py-20 bg-white/60 backdrop-blur border border-dashed border-gray-400 rounded-xl">
             <div class="text-gray-400 text-6xl mb-4">📝</div>
             <p class="text-gray-600 text-lg">Belum ada berita yang ditambahkan.</p>
          </div>

          <TransitionGroup 
            name="list" 
            tag="div" 
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
          >
            <div 
              v-for="item in berita" 
              :key="item.id"
              class="group bg-white rounded-2xl shadow-lg border border-transparent overflow-hidden 
                     hover:shadow-[0_0_20px_rgba(255,165,0,0.4)] hover:border-[#FFA500] hover:-translate-y-2
                     transition-all duration-300 flex flex-col h-full"
            >
                <div class="h-52 bg-gray-200 relative overflow-hidden">
                   <img 
                    v-if="item.gambar_url" 
                    :src="item.gambar_url" 
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-in-out"
                    alt="Thumbnail"
                   />
                   <div v-else class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                      <span class="text-sm">Tidak ada gambar</span>
                   </div>
                   <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-[#FFA500] border border-[#FFA500]/20 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                      {{ new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}
                   </div>
                </div>

                <div class="p-6 flex flex-col flex-grow relative">
                  <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#FFA500] transition-colors duration-300 line-clamp-2 leading-tight">
                    {{ item.judul }}
                  </h2>
                  <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                    {{ item.isi || item.ringkasan || 'Tidak ada konten deskripsi.' }}
                  </p>

                  <div class="flex items-center justify-between pt-5 border-t border-gray-100 mt-auto">
                    <NuxtLink :to="`/berita/${item.id}`" class="text-gray-500 font-semibold text-sm hover:text-[#FFA500] transition flex items-center gap-1 group/link">
                      Baca Selengkapnya <span class="group-hover/link:translate-x-1 transition-transform">→</span>
                    </NuxtLink>
                    
                    <div class="flex gap-2">
                      <NuxtLink :to="`/berita/tambah?id=${item.id}`" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition" title="Edit">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                         </svg>
                      </NuxtLink>
                      <button 
                        @click="openDeleteModal(item.id, item.judul)" 
                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition"
                        :disabled="isDeleting"
                        title="Hapus"
                      >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
            </div>
          </TransitionGroup>
        </div>
      </div>
    </div>

    <NuxtLink 
      to="/berita/tambah"
      class="fixed bottom-10 right-10 z-50 group"
      title="Tambah Berita Baru"
    >
      <div class="bg-[#FFA500] text-white w-16 h-16 rounded-full flex items-center justify-center 
                  shadow-[0_0_25px_rgba(255,165,0,0.6)] hover:shadow-[0_0_35px_rgba(255,165,0,0.8)] 
                  transform hover:scale-110 hover:rotate-90 transition-all duration-300 
                  border-4 border-white/30 backdrop-blur-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
      </div>

      <span class="absolute right-full mr-4 top-1/2 -translate-y-1/2 px-3 py-1.5 
                   bg-gray-900/90 text-white text-xs font-bold rounded-lg shadow-lg
                   opacity-0 group-hover:opacity-100 transition-opacity duration-300
                   whitespace-nowrap pointer-events-none">
        Tambah Berita
      </span>
    </NuxtLink>

    <Transition name="fade">
      <div v-if="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-sm w-full border border-gray-100 transform transition-all">
          <div class="text-center mb-6">
              <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Berita?</h3>
              <p class="text-gray-500">
                Anda yakin ingin menghapus <span class="font-bold text-gray-800">"{{ itemToDelete.judul }}"</span>? 
              </p>
          </div>

          <div class="flex gap-3">
            <button @click="showDeleteModal = false" class="flex-1 px-4 py-2.5 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 font-semibold transition">
              Batal
            </button>
            <button @click="hapus" class="flex-1 px-4 py-2.5 text-white bg-red-600 rounded-xl hover:bg-red-700 font-semibold shadow-lg shadow-red-200 transition">
              {{ isDeleting ? 'Menghapus...' : 'Ya, Hapus' }}
            </button>
          </div>
        </div>
      </div>
    </Transition>

    <Transition name="slide-up">
      <div v-if="toast.message" class="fixed bottom-5 left-5 z-[60] px-6 py-3 rounded-xl shadow-2xl text-white font-medium flex items-center gap-3"
        :class="toast.type === 'success' ? 'bg-green-600' : 'bg-red-600'"
      >
        <span>{{ toast.type === 'success' ? '✅' : '❌' }}</span>
        {{ toast.message }}
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const { $api } = useNuxtApp();

// DATA DUMMY
const dummyData = [
    {
        id: 101,
        judul: "Open Recruitment Anggota Baru BEM 2024",
        isi: "Badan Eksekutif Mahasiswa membuka kesempatan bagi mahasiswa aktif semester 1-4 untuk bergabung menjadi pengurus periode 2024/2025. Segera daftarkan dirimu!",
        gambar_url: "https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=800&q=80",
        created_at: new Date().toISOString()
    },
    {
        id: 102,
        judul: "Seminar Nasional Teknologi & AI",
        isi: "Himpunan Mahasiswa Teknik Informatika akan mengadakan seminar nasional membahas masa depan Artificial Intelligence di dunia industri. Pembicara dari Google dan Gojek.",
        gambar_url: "https://images.unsplash.com/photo-1544531586-fde5298cdd40?auto=format&fit=crop&w=800&q=80",
        created_at: new Date().toISOString()
    },
    {
        id: 103,
        judul: "Bakti Sosial Desa Binaan",
        isi: "Kegiatan rutin tahunan bakti sosial akan dilaksanakan di Desa Sumber Makmur. Kami menerima donasi berupa buku layak baca, pakaian, dan sembako.",
        gambar_url: null,
        created_at: new Date().toISOString()
    }
];

// State
const showDeleteModal = ref(false);
const itemToDelete = ref({ id: null, judul: '' });
const isDeleting = ref(false);
const toast = ref({ message: '', type: '', timeoutId: null });

function showToast(message, type = 'success', duration = 3000) {
  clearTimeout(toast.value.timeoutId);
  toast.value.message = message;
  toast.value.type = type;
  toast.value.timeoutId = setTimeout(() => { toast.value.message = ''; }, duration);
}

function openDeleteModal(id, judul) {
  itemToDelete.value = { id, judul };
  showDeleteModal.value = true;
}

// FETCH DATA
const { 
  data: apiResponse, 
  pending: loading, 
  error: fetchError, 
  refresh 
} = await useAsyncData(
  'berita-list', 
  async () => {
    try {
      const res = await $api.get("/berita"); 
      return res.data.data || res.data; 
    } catch (e) {
      console.warn('Gagal fetch API, menggunakan mode offline/dummy jika tersedia');
      return []; 
    }
  },
  { default: () => [] } 
);

const berita = computed(() => {
    let dataFromApi = [];
    if (Array.isArray(apiResponse.value)) {
        dataFromApi = apiResponse.value;
    } else if (apiResponse.value && Array.isArray(apiResponse.value.data)) {
        dataFromApi = apiResponse.value.data;
    }
    if (dataFromApi.length === 0) return dummyData;
    return dataFromApi;
});

// HAPUS DATA
async function hapus() {
  const id = itemToDelete.value.id;
  if (!id) return;

  if (id > 100) {
     showToast("Data dummy tidak bisa dihapus dari server.", 'error');
     showDeleteModal.value = false;
     return;
  }

  isDeleting.value = true;
  try {
    await $api.delete(`/berita/${id}`);
    showToast(`Berita berhasil dihapus!`, 'success'); 
    await refresh(); 
  } catch (e) {
    showToast("Gagal menghapus berita.", 'error');
  } finally {
    showDeleteModal.value = false;
    isDeleting.value = false;
    itemToDelete.value = { id: null, judul: '' };
  }
}
</script>

<style scoped>
/* Animasi Fade In untuk Halaman Utama */
.animate-fade-in {
  animation: fadeIn 0.8s ease-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Animasi untuk List Berita (TransitionGroup) */
.list-move,
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(30px);
}

.list-leave-active {
  position: absolute; 
}

/* Animasi Fade untuk Modal */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Animasi Slide Up untuk Toast */
.slide-up-enter-active,
.slide-up-leave-active {
  transition: all 0.3s ease;
}

.slide-up-enter-from,
.slide-up-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>