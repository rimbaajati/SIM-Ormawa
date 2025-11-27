import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "app"), // kalau folder Anda bernama app
      // atau "src", sesuaikan
    }
  },
  plugins: [vue()],
});
