<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Berita</h1>

    <NuxtLink to="/berita/tambah" class="bg-blue-600 text-white px-4 py-2 rounded">
      + Tambah Berita
    </NuxtLink>

    <div class="mt-6 space-y-4">
      <div
        v-for="item in berita"
        :key="item.id"
        class="border p-4 rounded shadow"
      >
        <h2 class="text-xl font-semibold">{{ item.judul }}</h2>
        <p class="text-gray-600">{{ item.ringkasan }}</p>

        <div class="mt-3 flex gap-3">
          <NuxtLink :to="`/berita/${item.id}`" class="text-blue-500">Detail</NuxtLink>
          <NuxtLink :to="`/berita/edit/${item.id}`" class="text-green-600">Edit</NuxtLink>
          <button @click="hapus(item.id)" class="text-red-500">Hapus</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const { $api } = useNuxtApp()
const berita = ref([])

async function load() {
  const res = await $api.get("/berita")
  berita.value = res.data
}

async function hapus(id) {
  if (!confirm("Hapus berita ini?")) return

  await $api.delete(`/berita/${id}`)
  load()
}

onMounted(load)
</script>
