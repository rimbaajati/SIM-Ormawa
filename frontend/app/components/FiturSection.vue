<script setup>
/* BAGIAN 2: JAVASCRIPT (Data dan Logika) */

// 1. Kita buat gambar Icon (SVG) langsung di sini biar tidak perlu install apa-apa
const IconPaper = {
  template: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>`
}
const IconMoney = {
  template: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>`
}
const IconTime = {
  template: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
}

// 2. Ini datanya. Kalau mau ganti tulisan, ganti di sini saja.
const fiturList = [
  {
    judul: 'Proposal Digital',
    deskripsi: 'Ajukan proposal kegiatan tanpa perlu mencetak kertas. Hemat biaya dan mudah dipantau.',
    icon: IconPaper
  },
  {
    judul: 'Transparansi Dana',
    deskripsi: 'Monitoring anggaran dan pelaporan keuangan (LPJ) secara real-time dan transparan.',
    icon: IconMoney
  },
  {
    judul: 'Manajemen Jadwal',
    deskripsi: 'Cek jadwal penggunaan fasilitas kampus agar tidak bentrok dengan ormawa lain.',
    icon: IconTime
  }
]
</script>

<style scoped>
/* BAGIAN 3: CSS (Warna Neon dan Tampilan) */

/* Kita pakai variabel warna yang sama dengan halaman utama */
:root {
  --neon: #00ffc8;
  --blue-accent: #2ac0ff;
}

.features-section {
  padding: 80px 20px;
  margin-top: 40px;
}

/* Judul Bagian */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}
.section-header h2 {
  font-size: 36px;
  color: white; /* Warna putih */
  margin-bottom: 10px;
  font-weight: 800;
}
.section-header p {
  color: rgba(255, 255, 255, 0.6); /* Putih agak transparan */
  font-size: 18px;
}

/* Grid Layout (Agar kotak-kotak rapi berjajar) */
.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
  max-width: 1200px;
  margin: 0 auto;
}

/* Tampilan Kotak Kartu */
.feature-card {
  background: rgba(255, 255, 255, 0.03); /* Latar belakang kaca tipis */
  border: 1px solid rgba(255, 255, 255, 0.05); /* Garis tepi tipis */
  padding: 40px 30px;
  border-radius: 20px;
  transition: all 0.4s ease; /* Animasi halus */
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

/* Efek saat Mouse Menyentuh Kartu (Hover) */
.feature-card:hover {
  transform: translateY(-10px); /* Naik ke atas dikit */
  border-color: var(--neon); /* Garis tepi jadi hijau neon */
  box-shadow: 0 10px 40px -10px rgba(0, 255, 200, 0.2); /* Efek cahaya */
}

/* Tampilan Wadah Icon */
.icon-wrapper {
  width: 60px;
  height: 60px;
  background: rgba(0, 255, 200, 0.1);
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 25px;
  color: var(--neon); /* Warna icon hijau neon */
  transition: transform 0.4s;
}

/* Animasi Icon saat Hover */
.feature-card:hover .icon-wrapper {
  background: var(--neon);
  color: #08101a; /* Icon jadi gelap kontras */
  transform: scale(1.1); /* Membesar dikit */
}

.icon-wrapper svg {
  width: 32px;
  height: 32px;
}

h3 {
  color: white;
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 15px;
}

p {
  color: rgba(255, 255, 255, 0.7);
  line-height: 1.6;
  font-size: 16px;
}
</style>