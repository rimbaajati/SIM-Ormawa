import { fileURLToPath } from "node:url";

const appDir = fileURLToPath(new URL("./", import.meta.url));

export default defineNuxtConfig({
  compatibilityDate: "2025-11-26",

  runtimeConfig: {
    sanctum: {
      baseUrl: "http://localhost:8000",
      endpoint: {
        csrf: "/sanctum/csrf-cookie",
        login: "/api/login",
        logout: "/api/logout",
        register: "/api/register",
      },
    },
  },

  app: {
    head: {
      title: "SIM Ormawa UMPKU",
      link: [
        {
          rel: "stylesheet",
          href: "https://fonts.googleapis.com/css2?family=Audiowide&family=Bebas+Neue&family=Lato:wght@400;700&family=Montserrat:wght@600;700&family=Oswald:wght@400;500;600;700&family=Playfair+Display:wght@700&family=Roboto:wght@400;700&display=swap",
        },
        {
          rel: "icon",
          type: "image/png",
          href: "/logo-bulat.png",
        },
      ],
    },
  },

  css: ["@/assets/css/tailwind.css"],

  modules: ["@nuxtjs/tailwindcss", "@pinia/nuxt"],

  alias: {
    "@": appDir,
    "~": appDir,
  },

  plugins: [
    "~/plugins/axios.js",
  ],

  vite: {
    optimizeDeps: {
      include: [], // Array ini sekarang kosong atau berisi dependensi lain
    },
    build: {
      commonjsOptions: {
        include: [/node_modules/],
      },
    },
  },

  nitro: {
    prerender: {
      crawlLinks: false,
    },
  },
});