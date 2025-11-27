<template>
  <div class="p-6">
    <NuxtLink to="/berita" class="text-blue-500">← Kembali</NuxtLink>

    <h1 class="text-3xl font-bold mt-4">{{ berita.judul }}</h1>
    <p class="mt-2 text-gray-600">{{ berita.isi }}</p>
  </div>
</template>

<script setup>
const { $api } = useNuxtApp()
const route = useRoute()
const berita = ref({})

async function load() {
  const res = await $api.get(`/berita/${route.params.id}`)
  berita.value = res.data
}

onMounted(load)
</script>
