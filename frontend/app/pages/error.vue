<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-4 font-sans">
    <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-md w-full">
      
      <img 
        src="/loncat-error.gif" 
        alt="Error Animation" 
        class="w-48 mx-auto mb-6 animate-bounce"
      />
      <h1 class="text-6xl font-extrabold text-red-500 mb-2">
        {{ error.statusCode }}
      </h1>

      <p class="text-gray-600 text-xl mb-8">
        {{ error.statusMessage || 'Halaman tidak ditemukan atau terjadi kesalahan.' }}
      </p>

      <button 
        @click="handleGoHome" 
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 active:translate-y-0"
      >
        Kembali ke Beranda
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  error: Object
})

const handleGoHome = () => {
  clearError({ redirect: '/' })
}
</script>