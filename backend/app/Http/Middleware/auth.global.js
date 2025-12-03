// middleware/auth.global.js
// Path: /middleware/auth.global.js

import { useAuthStore } from '@/stores/auth';

export default defineNuxtRouteMiddleware(async (to, from) => {
  // Ambil store Pinia
  const authStore = useAuthStore();
  
  // Logika: 
  // Panggil initializeAuth HANYA JIKA token belum ada di Store.
  // initializeAuth akan mengambil dari LocalStorage (jika ada) dan memvalidasinya ke API.
  // Karena middleware global berjalan sebelum rendering halaman, ini memastikan status siap.
  
  if (!authStore.token) {
    // Memanggil async action untuk memuat dan memvalidasi token
    await authStore.initializeAuth();
  }
});

// Catatan: Jika Anda ingin membatasi akses, tambahkan logika seperti:
/*
if (to.meta.requiresAuth && !authStore.isLoggedIn) {
    return navigateTo('/login');
}
*/