<template>
  <div class="flex min-h-screen bg-gray-50">
    <div class="w-64 p-4 bg-white shadow-lg">
      <header class="flex items-center mb-6">
        <span class="text-3xl font-extrabold text-red-600 mr-1">u</span>
        <h2 class="text-xl font-semibold text-gray-800">mpku</h2>
      </header>
      <nav class="space-y-2">
        <button 
          v-for="(item, index) in navItems" 
          :key="index"
          :class="['flex items-center w-full p-3 rounded-xl transition-colors', item.active ? 'bg-red-600 text-white shadow-md' : 'hover:bg-gray-100 text-gray-700']"
        >
          <span class="mr-3 text-xl">{{ item.icon }}</span>
          <span class="font-medium">{{ item.label }}</span>
        </button>
      </nav>
    </div>

    <div class="flex-1 p-8">
      <header class="flex justify-between items-center mb-10">
        <div class="flex items-center">
            <button class="text-gray-500 hover:text-red-600 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <span class="text-gray-500 mr-2">Kembali Beranda Fitur</span>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Tracking Real Time</h1>
        <div class="relative">
          <input
            type="text"
            placeholder="Search Id Kegiatan"
            class="py-2 pl-4 pr-10 border border-gray-300 rounded-lg w-64 focus:ring-red-500 focus:border-red-500"
          />
          <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
      </header>
      
      <div class="bg-white p-8 rounded-xl shadow-2xl max-w-4xl mx-auto">
        
        <div class="status-header">
          <div class="grid grid-cols-4 gap-4 text-center">
            <div class="py-2">
              <span class="text-xs text-gray-500">Nomor</span>
              <p class="font-semibold text-gray-800">{{ ticketData.nomor }}</p>
            </div>
            <div class="col-span-2 py-2">
              <span class="text-xs text-gray-500">Judul</span>
              <p class="font-semibold text-gray-800">{{ ticketData.judul }}</p>
            </div>
            <div class="py-2">
              <span class="text-xs text-gray-500">Status</span>
              <p class="font-bold text-orange-600 bg-orange-100 px-3 py-1 rounded-full inline-block text-xs">
                {{ ticketData.status }}
              </p>
            </div>
          </div>
          
          <div class="mt-4">
            <span class="text-sm font-medium text-orange-600 block mb-1">Proses {{ ticketData.progress }}%</span>
            <div class="progress-bar-container">
              <div 
                class="progress-bar-fill" 
                :style="{ width: ticketData.progress + '%' }"
              ></div>
            </div>
          </div>
        </div>
        
        <div class="timeline-steps">
          <div 
            v-for="(step, index) in steps" 
            :key="index"
            class="timeline-item"
          >
            <div class="timeline-marker-wrapper">
              <div :class="['timeline-marker', getIconClasses(step.status)]">
                <svg v-if="step.status === 'Completed'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                <svg v-else-if="step.status === 'In Progress'" class="w-5 h-5 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 4m0 8h.01"></path></svg>
                <span v-else class="text-white text-xl leading-none">•</span>
              </div>
              <div v-if="index < steps.length - 1" :class="['timeline-line', getLineClasses(step.status, steps[index + 1].status)]"></div>
            </div>

            <div class="timeline-content">
              <div :class="['timeline-label', getLabelClasses(step.status)]">{{ step.label }}</div>
            </div>

            <div class="timeline-date">
              <div :class="['text-sm', getDateClasses(step.status)]">{{ step.date }}</div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  layout: "empty",
});
import { ref, computed } from 'vue';

// --- Data Mockup ---
const navItems = ref([
  { icon: '📝', label: 'Pengajuan Online', active: false },
  { icon: '📋', label: 'Form Detail Lengkap', active: false },
  { icon: '📁', label: 'Upload Dokumen', active: false },
  { icon: '🔔', label: 'Notifikasi Revisi', active: false },
  { icon: '📊', label: 'Tracking Real-Time', active: true },
  { icon: '⬇️', label: 'Download Izin', active: false },
]);

const ticketData = ref({
  nomor: '01/UKM/002/2026',
  judul: 'Proposal Kegiatan Seminar',
  status: 'Dalam Pengecekan',
  progress: 40,
});

const steps = ref([
  { label: 'Proposal Telah Dikirim Ke Admin', date: 'Dibuat Tanggal 28 Desember 2025', status: 'Completed' },
  { label: 'Proposal Dialihkan Ke Bidang Kemahasiswaan', date: 'Disetujui Tanggal 30 Desember 2025', status: 'Completed' },
  { label: 'Proposal Dialihkan Ke Wakil Rektor III', date: 'Dalam Proses', status: 'In Progress' },
  { label: 'Persetujuan Wakil Rektor III', date: 'Menunggu', status: 'Pending' },
  { label: 'Persetujuan Akhir & Penerbitan Izin', date: 'Menunggu', status: 'Pending' },
]);


// --- Logika Kelas Dinamis Timeline (Mempertahankan Warna Tailwind untuk kemudahan) ---

const getIconClasses = (status) => {
  if (status === 'Completed') {
    return 'marker-completed';
  } else if (status === 'In Progress') {
    return 'marker-in-progress';
  }
  return 'marker-pending';
};

const getLineClasses = (currentStatus, nextStatus) => {
  if (currentStatus === 'Completed' || nextStatus === 'In Progress') {
    return 'line-active';
  }
  return 'line-pending';
};

const getLabelClasses = (status) => {
  if (status === 'Completed') {
    return 'text-red-700';
  } else if (status === 'In Progress') {
    return 'text-orange-600 font-bold';
  }
  return 'text-gray-700';
};

const getDateClasses = (status) => {
  if (status === 'Completed') {
    return 'text-green-500 font-medium';
  } else if (status === 'In Progress') {
    return 'text-orange-500 italic';
  }
  return 'text-gray-400';
};
</script>

<style scoped>
/* ====================================
   CSS KHUSUS UNTUK KOMPONEN INI
   ==================================== */

/* --- Status Header --- */
.status-header {
    background-color: #fff8f5; /* Light orange */
    border: 1px solid #ffedd5;
    border-radius: 0.5rem;
    padding: 1rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.progress-bar-container {
    height: 6px;
    background-color: #e5e7eb;
    border-radius: 9999px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    background-color: #f97316; /* Orange-500 */
    transition: width 0.7s ease-in-out;
    border-radius: 9999px;
}

/* --- Timeline Structure --- */
.timeline-steps {
    margin-top: 2rem;
    padding-top: 1.5rem;
    /* Optional: border-top: 1px solid #f3f4f6; */
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    padding-bottom: 1rem;
}

.timeline-marker-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-right: 1.5rem;
}

.timeline-content {
    flex: 1;
    min-width: 0;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

.timeline-date {
    margin-left: 1rem;
    text-align: right;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

/* --- Marker Styles --- */
.timeline-marker {
    width: 2rem; /* w-8 */
    height: 2rem; /* h-8 */
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.marker-completed {
    background-color: #dc2626; /* Red-600 */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
}

.marker-in-progress {
    background-color: #f97316; /* Orange-500 */
    box-shadow: 0 20px 25px -5px rgba(249, 115, 22, 0.3), 0 8px 10px -6px rgba(249, 115, 22, 0.2);
    /* Ring effect implemented using Tailwind classes in template (ring-4 ring-orange-200) */
}

.marker-pending {
    background-color: #9ca3af; /* Gray-400 */
}

/* --- Line Styles --- */
.timeline-line {
    width: 2px; /* w-0.5 */
    flex-grow: 1;
    margin-top: 0.5rem; /* mt-2 */
}

.line-active {
    background-color: #ef4444; /* Red-500 */
}

.line-pending {
    background-color: #d1d5db; /* Gray-300 */
}
</style>