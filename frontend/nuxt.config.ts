import { fileURLToPath } from "node:url";

export default defineNuxtConfig({
  compatibilityDate: "2025-11-26",

  runtimeConfig: {
    public: {
      apiBase: 'http://localhost:8000/api',
    }
  },

  plugins: ["~/plugins/axios.js"],

  css: ["@/assets/css/tailwind.css"],

  modules: ["@nuxtjs/tailwindcss", "@pinia/nuxt"],

  alias: {
    "@": fileURLToPath(new URL("./", import.meta.url)),
    "~": fileURLToPath(new URL("./", import.meta.url)),
  },

  vite: {
    resolve: {
      alias: {
        "@": fileURLToPath(new URL("./", import.meta.url)),
        "~": fileURLToPath(new URL("./", import.meta.url)),
      },
    },
  },
});
