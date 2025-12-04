// stores/auth.js

import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: null,
    isLoggedIn: false,
    user: { name: "Pengunjung" },
  }),

  getters: {
    userName: (state) => state.user.name || "Pengunjung",
    getIsLoggedIn: (state) => state.isLoggedIn,
  },

  actions: {
    async initializeAuth() {
      // 1. Ambil token dari Local Storage
      // Catatan: localStorage hanya tersedia di sisi client
      const config = useRuntimeConfig();
      
      if (!storedToken) {
        this.isLoggedIn = false;
        this.user = { name: "Pengunjung" };
        this.token = null; // Pastikan token null jika tidak ada
        return;
      }

      this.token = storedToken;

      // 2. Verifikasi token ke API Laravel menggunakan $fetch
      try {
      const userData = await $fetch("user", { // Cukup 'user' karena Base URL akan menangani sisanya
        method: 'GET',
        baseURL: config.public.apiBase, // 👈 GUNAKAN BASE URL DI SINI
        headers: {
          Authorization: `Bearer ${storedToken}`,
        },
      });
        
        // 3. Jika valid
        if (userData && userData.name) {
          this.isLoggedIn = true;
          this.user = { name: userData.name };
        } else {
          // Response sukses, tapi data user kosong
          this.logout(false);
        }
      } catch (error) {
        // Gagal (termasuk 401 Unauthorized)
        console.error("Gagal memverifikasi token:", error);
        this.logout(false);
      }
    },

    login(token, user) {
      if (process.client) {
        localStorage.setItem("authToken", token);
      }
      this.token = token;
      this.isLoggedIn = true;
      this.user = user;
    },

    async logout(callApi = true) {
      if (callApi) {
        try {
          // Panggil API logout jika perlu
          // await $fetch('/api/logout', { method: 'POST' }); 
        } catch (e) {
          console.error("Gagal memanggil API logout:", e);
        }
      }
      
      if (process.client) {
        localStorage.removeItem("authToken");
      }
      this.token = null;
      this.isLoggedIn = false;
      this.user = { name: "Pengunjung" };
      await navigateTo("/");
    },
  },
});