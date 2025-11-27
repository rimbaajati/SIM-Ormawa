import axios from 'axios';

// Plugin ini akan membuat instance Axios global dan menginjeksinya sebagai $api
export default defineNuxtPlugin((nuxtApp) => {
  // Ambil konfigurasi runtime publik yang sudah kita definisikan di nuxt.config.ts
  const config = useRuntimeConfig();
  const apiBase = config.public.apiBase;

  // 1. Buat instance Axios baru (HttpClient)
  const api = axios.create({
    baseURL: apiBase,
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
    // PENTING: Untuk otentikasi berbasis cookie/sesi (seperti Laravel Sanctum)
    // ini memastikan cookies sesi dikirim dan diterima antar domain/port.
    withCredentials: true,
  });

  // 2. Tambahkan Interceptor (Opsional: untuk menangani error secara global)
  api.interceptors.response.use(
    response => response,
    error => {
      // Contoh global error handling: jika menerima 401 Unauthorized
      if (error.response && error.response.status === 401) {
        // Redirect ke halaman login atau bersihkan state otentikasi (gunakan Pinia)
        // console.error("Sesi telah berakhir atau tidak sah.");
        // const router = useRouter();
        // router.push('/login');
      }
      return Promise.reject(error);
    }
  );

  // 3. Injeksi Axios ke Nuxt App
  // Kini Anda dapat memanggil 'useNuxtApp().$api' atau '$api' di composables/component
  return {
    provide: {
      api: api
    }
  }
})