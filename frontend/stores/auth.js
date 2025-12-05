// stores/auth.js
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: null,
    isLoggedIn: false,
    // Ubah default jadi null agar mudah dicek. 
    // Nanti kita handle tampilan "Pengunjung" di getters atau component.
    user: null, 
  }),

  getters: {
    // Jika user ada, ambil namanya. Jika tidak, tampilkan "Pengunjung"
    userName: (state) => state.user?.name || "Pengunjung",
    // Getter untuk ambil email atau role jika ada
    userEmail: (state) => state.user?.email || "",
    userRole: (state) => state.user?.role || "", 
    getIsLoggedIn: (state) => state.isLoggedIn,
  },

  actions: {
    async initializeAuth() {
      // Hanya jalan di sisi client (karena butuh localStorage)
      if (process.server) return;

      const config = useRuntimeConfig();
      
      // --- PERBAIKAN 1: Ambil token dari LocalStorage ---
      const storedToken = localStorage.getItem("authToken");

      if (!storedToken) {
        this.isLoggedIn = false;
        this.user = null;
        this.token = null;
        return;
      }

      this.token = storedToken;

      try {
        // Panggil API User
        const userData = await $fetch("/user", { // Pastikan endpoint sesuai routes Laravel (biasanya /api/user atau /user)
          method: 'GET',
          baseURL: config.public.apiBase, 
          headers: {
            Authorization: `Bearer ${storedToken}`,
            Accept: 'application/json'
          },
        });
        
        // --- PERBAIKAN 2: Simpan seluruh data user ---
        // Sesuaikan dengan respon Laravel. 
        // Jika Laravel pakai API Resource (ada wrapper 'data'), gunakan userData.data
        // Jika langsung object, gunakan userData.
        const userPayload = userData.data || userData;

        if (userPayload) {
          this.isLoggedIn = true;
          this.user = userPayload; // Simpan semua (id, name, email, role, foto, dll)
        } else {
          this.logout(false);
        }

      } catch (error) {
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
      this.user = user; // User yang dikirim dari form login disimpan di sini
    },

    async logout(callApi = true) {
      if (callApi) {
        try {
           const config = useRuntimeConfig();
           // Panggil API logout agar token di BE hangus (opsional tapi disarankan)
           await $fetch('/logout', { 
             method: 'POST',
             baseURL: config.public.apiBase,
             headers: { Authorization: `Bearer ${this.token}` }
           }); 
        } catch (e) {
          console.error("Gagal logout di server:", e);
        }
      }
      
      if (process.client) {
        localStorage.removeItem("authToken");
      }
      this.token = null;
      this.isLoggedIn = false;
      this.user = null;
      
      // Redirect ke login atau home
      navigateTo("/login"); 
    }
  },
});