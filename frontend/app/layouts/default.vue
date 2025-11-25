<template>
  <div class="flex flex-col min-h-screen bg-gray-50">
    <header class="bg-purple-900 text-white shadow p-4">
      <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">SIM ORMAWA</h1>
        <nav class="space-x-6">
          <a href="/" class="hover:text-yellow-400">Beranda</a>
          <a href="#tentang" class="hover:text-yellow-400">Tentang</a>
          <a href="#fitur" class="hover:text-yellow-400">Fitur</a>
          <a href="#kontak" class="hover:text-yellow-400">Kontak</a>
        </nav>
      </div>
    </header>

    <main class="flex-1">
      <NuxtPage />
    </main>

    <footer class="bg-purple-900 text-white p-4 text-center">
      &copy; {{ new Date().getFullYear() }} SIM Ormawa. Semua hak dilindungi.
    </footer>
  </div>
</template>
