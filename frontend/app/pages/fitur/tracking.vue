<script setup>
import { ref, watchEffect } from 'vue'
import { useRoute } from 'vue-router'

// Ambil route untuk baca query param (misal ?id=SE-T20251104RM6SBV)
const route = useRoute()

// Bisa manual atau dari query param:
const trackingId = ref(route.query.id || 'SE-T20251104RM6SBV')

// URL API Laravel kamu
const baseUrl = 'http://localhost:8000/api'

// Ambil data tracking dari Laravel
const { data: documentData, pending, error, refresh } = await useFetch(
  () => `${baseUrl}/tracking/${trackingId.value}`,
  {
    server: true,
    credentials: 'include'
  }
)

// Data default jika belum ada API
const trackingData = ref({
  header: {
    project_name: 'Project Alpha Q4 Rockiou',
    status: 'In Transit',
    tracking_code: '#KA08J9192',
    review_status: 'In Review',
    eta: '25 March, 2024'
  },
  history: [
    { date: '14 Oct', description: 'Assigned to John Doe' },
    { date: '15 Oct', description: 'Internal review started' }
  ],
  receiver: {
    name: 'Anna Patel',
    partner: 'Mike Chan'
  }
})

// Update data kalau API berhasil diambil
watchEffect(() => {
  if (documentData.value) trackingData.value = documentData.value
})
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-4">
    <!-- Loading -->
    <div v-if="pending" class="text-gray-500 text-center">⏳ Memuat data tracking...</div>

    <!-- Error -->
    <div v-else-if="error" class="text-red-600 text-center">
      ❌ Gagal mengambil data dari API: {{ error.message }}
    </div>

    <!-- Tampilan utama -->
    <div
      v-else
      class="w-full max-w-md bg-[#007bff] text-white rounded-3xl shadow-2xl overflow-hidden relative"
    >
      <!-- Header -->
      <div class="px-6 pt-8 pb-4 text-center relative">
        <h2 class="text-xl font-bold mb-1">Real-time Tracking:</h2>
        <p class="text-sm opacity-90">{{ trackingData.header.project_name }}</p>

        <!-- Lingkaran tengah -->
        <div class="relative mt-6 flex flex-col items-center">
          <div class="w-48 h-48 rounded-full border-[8px] border-white/30 flex items-center justify-center">
            <div class="w-36 h-36 rounded-full bg-white/10 flex flex-col items-center justify-center">
              <p class="text-lg font-semibold">{{ trackingData.header.status }}</p>
              <p class="text-xs opacity-80">{{ trackingData.header.tracking_code }}</p>

              <button
                class="mt-2 px-4 py-1 text-sm font-medium bg-white text-blue-600 rounded-full"
              >
                {{ trackingData.header.review_status }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol Live Collaboration -->
      <div class="flex justify-center mt-4">
        <button
          class="bg-white text-blue-600 px-6 py-2 font-semibold text-sm rounded-full hover:bg-blue-50 transition"
        >
          Live Collaboration Session
        </button>
      </div>

      <!-- Timeline -->
      <div class="bg-white text-gray-800 rounded-t-3xl mt-6 p-6">
        <h3 class="font-semibold mb-3 text-blue-600">Activity Timeline</h3>
        <ul class="space-y-2 text-sm">
          <li
            v-for="(event, index) in trackingData.history"
            :key="index"
            class="flex justify-between border-b border-gray-200 pb-2"
          >
            <span>{{ event.date }}</span>
            <span>{{ event.description }}</span>
          </li>
        </ul>

        <!-- Receiver Info -->
        <div class="mt-6 bg-lime-400 rounded-2xl p-4 text-gray-900">
          <h4 class="font-semibold mb-2">Receiver Info</h4>
          <p class="font-semibold">{{ trackingData.receiver.name }}</p>
          <p class="text-sm opacity-70">{{ trackingData.receiver.partner }}</p>
        </div>
      </div>

      <!-- ETA -->
      <div class="absolute top-4 right-4 bg-white/20 text-xs px-3 py-1 rounded-full">
        ETA: {{ trackingData.header.eta }}
      </div>
    </div>
  </div>
</template>
