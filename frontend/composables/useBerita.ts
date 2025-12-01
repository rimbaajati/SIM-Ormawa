import type { Berita, BeritaResponse } from '~/types/berita'

export const useBerita = () => {
  const config = useRuntimeConfig()
  const baseURL = config.public.apiBase || 'http://localhost:8000/api'

  // Get all berita
  const getBerita = async (): Promise<Berita[]> => {
    try {
      const { data } = await $fetch(`${baseURL}/berita`)
      return data
    } catch (error) {
      throw error
    }
  }

  // Get single berita
  const getBeritaById = async (id: number): Promise<Berita> => {
    try {
      const { data } = await $fetch(`${baseURL}/berita/${id}`)
      return data
    } catch (error) {
      throw error
    }
  }

  // Create berita (requires auth)
  const createBerita = async (beritaData: FormData): Promise<Berita> => {
    try {
      const token = useCookie('auth-token')
      const { data } = await $fetch(`${baseURL}/berita`, {
        method: 'POST',
        body: beritaData,
        headers: {
          'Authorization': `Bearer ${token.value}`
        }
      })
      return data
    } catch (error) {
      throw error
    }
  }

  // Update berita (requires auth)
  const updateBerita = async (id: number, beritaData: FormData): Promise<Berita> => {
    try {
      const token = useCookie('auth-token')
      const { data } = await $fetch(`${baseURL}/berita/${id}`, {
        method: 'PUT',
        body: beritaData,
        headers: {
          'Authorization': `Bearer ${token.value}`
        }
      })
      return data
    } catch (error) {
      throw error
    }
  }

  // Delete berita (requires auth)
  const deleteBerita = async (id: number): Promise<{ success: boolean; message: string }> => {
    try {
      const token = useCookie('auth-token')
      const { data } = await $fetch(`${baseURL}/berita/${id}`, {
        method: 'DELETE',
        headers: {
          'Authorization': `Bearer ${token.value}`
        }
      })
      return data
    } catch (error) {
      throw error
    }
  }

  return {
    getBerita,
    getBeritaById,
    createBerita,
    updateBerita,
    deleteBerita
  }
}