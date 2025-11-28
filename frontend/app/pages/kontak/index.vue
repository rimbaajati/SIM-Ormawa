<template>
  <div class="max-w-xl mx-auto py-10 text-white">
    <h1 class="text-3xl font-extrabold text-blue-400 mb-8 tracking-wide">
      Hubungi Kami
    </h1>

    <form @submit.prevent="submitForm" class="form-container">
      <div>
        <label for="nama" class="label-text">Nama Lengkap</label>
        <input
          id="nama"
          v-model="nama"
          class="input-modern"
          placeholder="Masukkan nama Anda"
        />
      </div>

      <div>
        <label for="email" class="label-text">Alamat Email</label>
        <input
          id="email"
          v-model="email"
          class="input-modern"
          type="email"
          placeholder="contoh@domain.com"
        />
      </div>

      <div>
        <label for="subjek" class="label-text">Subjek</label>
        <input
          id="subjek"
          v-model="subjek"
          class="input-modern"
          placeholder="Subjek pesan (opsional)"
        />
      </div>

      <div>
        <label for="pesan" class="label-text">Pesan Anda</label>
        <textarea
          id="pesan"
          v-model="pesan"
          class="input-modern h-32 resize-none"
          placeholder="Tulis pesan Anda secara detail..."
        ></textarea>
      </div>

      <button type="submit" class="submit-button">Kirim Pesan</button>
    </form>

    <p class="mt-6 text-green-400 text-center font-medium" v-if="success">
      {{ success }}
    </p>
  </div>
</template>

<script setup>
import { ref } from "vue";

const nama = ref("");
const email = ref("");
const subjek = ref("");
const pesan = ref("");
const success = ref("");

const submitForm = async () => {
  try {
    const response = await fetch("/kontak", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        nama: nama.value,
        email: email.value,
        subjek: subjek.value,
        pesan: pesan.value,
      }),
    });

    if (!response.ok) {
      throw new Error(`Gagal mengirim pesan! Status: ${response.status}`);
    }

    const resData = await response.json();

    success.value = resData.message || "Pesan berhasil terkirim!";
    nama.value = "";
    email.value = "";
    subjek.value = "";
    pesan.value = "";
  } catch (err) {
    console.error("Error submitting form:", err);
  }
};
</script>

<style scoped>
.form-container {
  @apply space-y-6 bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-700;
}

.label-text {
  @apply block text-sm font-medium text-gray-300 mb-1;
}

.input-modern {
  @apply w-full p-3
    bg-gray-700 text-white
    border border-gray-600 rounded-xl
    outline-none
    transition duration-200
    focus:border-blue-500 focus:ring-1 focus:ring-blue-500;
}

.submit-button {
  @apply w-full py-3 rounded-lg font-semibold tracking-wider text-lg
    bg-blue-600 hover:bg-blue-500
    transition duration-300 ease-in-out
    shadow-lg shadow-blue-500/30;
}
</style>
