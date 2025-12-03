import { fileURLToPath } from "node:url";

export default defineNuxtConfig({
  compatibilityDate: "2025-11-26",

  runtimeConfig: {
    public: {
      apiBase: 'http://127.0.0.1:8000/api', 
    }
  },

  app: {
    head: {
      link: [
        {
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Audiowide&display=swap'
        },
        { 
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap'
        },
        { 
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap'
        },
        { 
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap'
        },
        { 
          rel: 'stylesheet',
          href: 'https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap'
        },
        {
          rel: 'stylesheet',
          href:"https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Oswald:wght@400;500;600&family=Playfair+Display:wght@700&display=swap"
        },

        { 
          rel: 'icon',
          type: 'image/png',
          href: '/logo-bulat.png'
        }
      ],
      title: "SIM Ormawa UMPKU"
    }
  },
  
  plugins: ["~/plugins/axios.js"],

  css: ["@/assets/css/tailwind.css"],

  modules: ['@nuxtjs/tailwindcss', "@pinia/nuxt"],

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
