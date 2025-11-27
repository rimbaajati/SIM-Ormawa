import axios from 'axios'

export default defineNuxtPlugin(() => {
  const instance = axios.create({
    baseURL: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000/api',
    withCredentials: true
  })

  return {
    provide: {
      axios: instance
    }
  }
})
