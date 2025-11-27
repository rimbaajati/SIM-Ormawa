<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Berita</h1>

    <form @submit.prevent="submit" class="space-y-4 max-w-xl">
      <input v-model="judul" class="border p-2 w-full" placeholder="Judul berita" />
      <textarea v-model="isi" class="border p-2 w-full" rows="6" placeholder="Isi berita"></textarea>

      <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
  </div>
</template>

<script setup>
const { $api } = useNuxtApp()

const judul = ref("")
const isi = ref("")

async function submit() {
  await $api.post("/berita", {
    judul: judul.value,
    isi: isi.value
  })

  navigateTo("/berita")
}
</script>
