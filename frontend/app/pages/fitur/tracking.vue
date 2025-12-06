<script setup>
import { ref } from 'vue';

const trackingId = ref('SE-T20251104RM6SBV');
const baseUrl = 'http://localhost:8000/api'; // Ganti dengan URL Laravel Anda

// Gunakan useFetch untuk mengambil data
const { data: documentData, pending, error, refresh } = await useFetch(
    `${baseUrl}/tracking/${trackingId.value}`,
    {
        // Headers jika Anda menggunakan otentikasi token
        // headers: {
        //     Authorization: `Bearer ${yourAuthToken}`
        // },
        // PENTING: Jika menggunakan Laravel Sanctum atau session-based auth:
        // Dengan credentials, cookies akan dikirimkan
        server: true, 
        credentials: 'include' 
    }
);

// Meringkas data yang dibutuhkan untuk template
const data = ref(documentData.value || { header: {}, attachments: [], history: [] });
</script>

<template>
  <div class="tracker-layout">
    <div v-if="pending">⏳ Sedang memuat data dari Laravel...</div>
    <div v-else-if="error">❌ Gagal terhubung ke API Laravel: {{ error.message }}</div>
    
    <div v-else>
      </div>
  </div>
</template>