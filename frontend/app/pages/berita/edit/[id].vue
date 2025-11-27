<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Berita</h1>

    <form @submit.prevent="submit" class="space-y-4 max-w-xl">
      <input v-model="judul" class="border p-2 w-full" placeholder="Judul berita" />
      <textarea v-model="isi" class="border p-2 w-full" rows="6" placeholder="Isi berita"></textarea>

      <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
  </div>
</template>

<script setup>
const { $api } = useNuxtApp()
const route = useRoute()

const judul = ref("")
const isi = ref("")

async function load() {
  const res = await $api.get(`/berita/${route.params.id}`)
  judul.value = res.data.judul
  isi.value = res.data.isi
}

async function submit() {
  await $api.put(`/berita/${route.params.id}`, {
    judul: judul.value,
    isi: isi.value
  })

  navigateTo("/berita")
}

onMounted(load)
</script>
