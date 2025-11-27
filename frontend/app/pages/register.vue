<template>
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-[#0f1624] border border-white/10 rounded-2xl p-8 shadow-xl">
      <h2 class="text-2xl font-bold text-center text-white mb-4">Daftar Akun SIM Ormawa</h2>

      <form @submit.prevent="submitRegister" class="space-y-4">
        
        <!-- Nama Lengkap -->
        <div>
          <label for="name" class="text-white/80 text-sm">Nama Lengkap</label>
          <input id="name" v-model="name" type="text" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Nama lengkap" />
        </div>

        <!-- Email -->
        <div>
          <label for="reg-email" class="text-white/80 text-sm">Email</label>
          <input id="reg-email" v-model="email" type="email" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="email@contoh.com" />
        </div>

        <!-- Password -->
        <div>
          <label for="reg-password" class="text-white/80 text-sm">Password</label>
          <input id="reg-password" v-model="password" type="password" required minlength="6"
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Minimal 6 karakter" />
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label for="password_confirmation" class="text-white/80 text-sm">Konfirmasi Password</label>
          <input id="password_confirmation" v-model="password_confirmation" type="password" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Ketik ulang password" />
        </div>

        <!-- Button Submit -->
        <button type="submit"
          :disabled="loading"
          class="w-full py-3 bg-[#3b82f6] hover:bg-[#2563eb] transition rounded-lg font-semibold text-white shadow-lg disabled:opacity-60">
          <span v-if="!loading">Daftar</span>
          <span v-else>Memproses...</span>
        </button>

        <!-- Pesan Status -->
        <p v-if="error" class="text-red-400 text-sm mt-2 text-center">{{ error }}</p>
        <p v-if="success" class="text-green-400 text-sm mt-2 text-center">{{ success }}</p>

      </form>

      <!-- Tautan Login -->
      <p class="text-center mt-5 text-white/50 text-sm">
        Sudah punya akun?
        <!-- Perubahan warna untuk konsistensi tema -->
        <NuxtLink to="/login" class="text-[#00ffc8] hover:underline font-semibold">Masuk di sini</NuxtLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const name = ref('')
const email = ref('')
const password = ref('')
const password_confirmation = ref('')
const loading = ref(false)
const error = ref(null)
const success = ref(null)

const nuxt = useNuxtApp()
// Menggunakan $api untuk konsistensi
const { $api } = nuxt 

const submitRegister = async () => {
  error.value = null
  success.value = null

  if (password.value !== password_confirmation.value) {
    error.value = "Password dan konfirmasi tidak cocok."
    return
  }

  loading.value = true
  try {
    const payload = {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value
    }

    // Asumsi endpoint register: POST /register
    const res = await $api.post('/register', payload)

    success.value = res.data.message || 'Registrasi berhasil! Anda akan diarahkan ke halaman login.'
    
    // Pindah ke login setelah registrasi sukses
    setTimeout(() => navigateTo('/login'), 1200)

  } catch (err) {
    console.error("Registrasi Error:", err)
    // Penanganan error yang lebih spesifik
    error.value = err.response?.data?.message || err.response?.data?.errors?.email?.[0] || 'Terjadi kesalahan saat registrasi. Cek input Anda.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
/*
 * Gaya disalin dari login/register untuk konsistensi visual 
 * (Dark card centered, blue accents, light neon links)
 */
</style>