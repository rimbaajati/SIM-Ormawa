export interface Berita {
  id: number
  judul: string
  isi: string
  thumbnail?: string
  penulis_id?: number
  penulis?: {
    id: number
    name: string
  }
  created_at: string
  updated_at: string
}

export interface BeritaResponse {
  success: boolean
  data: Berita | Berita[]
  message?: string
}

export interface BeritaCreateRequest {
  judul: string
  isi: string
  thumbnail?: File
}

export interface BeritaUpdateRequest {
  judul: string
  isi: string
  thumbnail?: File
}