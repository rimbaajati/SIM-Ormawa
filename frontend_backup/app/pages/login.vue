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
        <!-- Email -->
        <div>
          <label class="text-white/80 text-sm">Email</label>
          <input
            v-model="email"
            type="email"
            required
            class="mt-1 w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-white/40 focus:ring-2 focus:ring-[#3b82f6] outline-none"
            placeholder="email@contoh.com"
          />
        </div>

        <!-- Password -->
        <div>
          <label class="text-white/80 text-sm">Password</label>
          <input
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
          class="w-full py-3 bg-[#3b82f6] hover:bg-[#2563eb] transition rounded-lg font-semibold text-white shadow-lg"
        >
          Masuk
        </button>
      </form>

      <!-- Register -->
      <p class="text-center mt-5 text-white/50 text-sm">
        Belum punya akun?
        <NuxtLink to="/register" class="text-[#3b82f6] hover:underline">
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

const submitLogin = () => {
  console.log("Login data:", { email: email.value, password: password.value });

  // TODO: Tambahkan API login di sini
  alert("Login berhasil (dummy). Tambahkan API nanti.");
};
</script>
