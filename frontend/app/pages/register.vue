<template>
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-[#0f1624] border border-white/10 rounded-2xl p-8 shadow-xl">
      <h2 class="text-2xl font-bold text-center text-white mb-4">Daftar Akun SIM Ormawa</h2>

      <form @submit.prevent="submitRegister" class="space-y-4">
        <div>
          <label class="text-white/80 text-sm">Nama Lengkap</label>
          <input v-model="name" type="text" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Nama lengkap" />
        </div>

        <div>
          <label class="text-white/80 text-sm">Email</label>
          <input v-model="email" type="email" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="email@contoh.com" />
        </div>

        <div>
          <label class="text-white/80 text-sm">Password</label>
          <input v-model="password" type="password" required minlength="6"
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Minimal 6 karakter" />
        </div>

        <div>
          <label class="text-white/80 text-sm">Konfirmasi Password</label>
          <input v-model="password_confirmation" type="password" required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="Ketik ulang password" />
        </div>

        <button type="submit"
          :disabled="loading"
          class="w-full py-3 bg-[#3b82f6] hover:bg-[#2563eb] transition rounded-lg font-semibold text-white shadow-lg disabled:opacity-60">
          <span v-if="!loading">Daftar</span>
          <span v-else>Memproses...</span>
        </button>

        <p v-if="error" class="text-red-400 text-sm mt-2">{{ error }}</p>
        <p v-if="success" class="text-green-400 text-sm mt-2">{{ success }}</p>
      </form>

      <p class="text-center mt-5 text-white/50 text-sm">
        Sudah punya akun?
        <NuxtLink to="/login" class="text-[#3b82f6] hover:underline">Masuk di sini</NuxtLink>
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
const axios = nuxt.$axios // plugin axios kita

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

    // contoh endpoint: POST /api/register
    const res = await axios.post('/register', payload)

    // jika backend mengembalikan token:
    // localStorage.setItem('token', res.data.token)

    success.value = res.data.message || 'Registrasi berhasil. Silakan login.'
    // pindah ke login otomatis (opsional)
    setTimeout(() => navigateTo('/login'), 1200)

  } catch (err) {
    console.error(err)
    error.value = err.response?.data?.message || 'Terjadi kesalahan.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
/* copy style dari login supaya konsisten */
</style>
