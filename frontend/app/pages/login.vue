<template>
  <div class="min-h-screen flex items-center justify-center px-4">
    <div
      class="w-full max-w-md bg-[#0f1624] border border-white/10 rounded-2xl p-8 shadow-xl"
    >
      <h2 class="text-2xl font-bold text-center text-white mb-6">
        Masuk ke SIM Ormawa
      </h2>

      <!-- Form -->
      <form @submit.prevent="submitLogin" class="space-y-5">
        <!-- Notifikasi Error -->
        <div v-if="error" class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg text-sm">
          {{ error }}
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="text-white/80 text-sm">Email</label>
          <input
            id="email"
            v-model="email"
            type="email"
            required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="email@contoh.com"
          />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="text-white/80 text-sm">Password</label>
          <input
            id="password"
            v-model="password"
            type="password"
            required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="••••••••"
          />
        </div>

        <!-- Button -->
        <button
          type="submit"
          :disabled="loading"
          class="w-full py-3 bg-[#3b82f6] hover:bg-[#2563eb] transition rounded-lg font-semibold text-white shadow-lg disabled:opacity-60"
        >
          <span v-if="loading">Memproses...</span>
          <span v-else>Masuk</span>
        </button>
      </form>

      <!-- Register -->
      <p class="text-center mt-5 text-white/50 text-sm">
        Belum punya akun?
        <NuxtLink to="/register" class="text-[#00ffc8] hover:underline font-semibold">
          Daftar di sini
        </NuxtLink>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";

const email = ref("");
const password = ref("");
const loading = ref(false);
const error = ref(null);

// Asumsi Anda menggunakan plugin Nuxt bernama '$api' (atau sesuaikan dengan nama plugin API/Axios Anda)
const { $api } = useNuxtApp();
const router = useRouter();

const submitLogin = async () => {
  error.value = null;
  loading.value = true;

  try {
    const payload = {
      email: email.value,
      password: password.value,
    };
    
    // Asumsi endpoint login adalah /login dan mengembalikan token/user data
    const res = await $api.post("/login", payload);

    // TODO: Simpan token atau informasi user ke state/storage (misalnya Pinia/LocalStorage)
    // localStorage.setItem('token', res.data.token); 
    
    // Navigasi ke dashboard setelah login berhasil
    router.push('/dashboard'); 

  } catch (err) {
    console.error("Login Error:", err);
    // Menampilkan pesan error dari backend
    error.value = err.response?.data?.message || "Login gagal. Periksa kembali email dan password Anda.";
  } finally {
    loading.value = false;
  }
};
</script>