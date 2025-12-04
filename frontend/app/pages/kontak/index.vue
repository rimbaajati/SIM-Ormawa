<template>
  <div class="contact-us-wrapper">
    <div class="contact-info-section">
      <div class="info-cards-stack">
        
        <div class="info-card card-office">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 1 8 8c0 7-8 12-8 12s-8-5-8-12a8 8 0 0 1 8-8z"/></svg>
          </div>
          <h4 class="card-title">OUR MAIN OFFICE</h4>
          <p>SoHo 94 Broadway St</p>
          <p>New York, NY 1001</p>
        </div>

        <div class="info-card card-phone">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-3.67-2.92 19.19 19.19 0 0 1-2.92-3.67A19.79 19.79 0 0 1 2 4.18 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <h4 class="card-title">PHONE NUMBER</h4>
          <p>234-8876-5400</p>
          <p>888-0123-4567 (Toll Free)</p>
        </div>
        
        <div class="info-card card-fax">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><path d="M6 15h0M18 15h0M6 19h0M18 19h0M2 11h20M9 3l3 4 3-4"/></svg>
          </div>
          <h4 class="card-title">FAX</h4>
          <p>1-234-567-8900</p>
        </div>

        <div class="info-card card-email">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <h4 class="card-title">EMAIL</h4>
          <p>hello@theme.com</p>
        </div>
      </div>
    </div>

    <div class="contact-form-section">
      <h2 class="form-heading">Contact Us</h2>

      <form @submit.prevent="submitForm" class="contact-form">
        <input
          type="text"
          placeholder="Enter your Name"
          v-model="formData.name"
          class="form-input"
          required
        />

        <input
          type="email"
          placeholder="Enter a valid email address"
          v-model="formData.email"
          class="form-input"
          required
        />

        <textarea
          placeholder=""
          rows="8"
          v-model="formData.message"
          class="form-textarea"
          required
        ></textarea>

        <button type="submit" class="submit-button">SUBMIT</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ImprovedContactUs',
  data() {
    return {
      formData: {
        name: '',
        email: '',
        message: '',
      },
    };
  },
  methods: {
    submitForm() {
      console.log('Form data submitted:', this.formData);
      alert('Pesan terkirim!');
      this.formData = { name: '', email: '', message: '' };
    },
  },
};
</script>

<style scoped>
/* Struktur Utama dan Font */
.contact-us-wrapper {
  display: flex;
  max-width: 1100px;
  margin: 50px auto;
  padding: 20px;
  font-family: Arial, Helvetica, sans-serif;

}

/* --- Bagian Judul dan Formulir --- */
.contact-form-section {
  flex: 1;
  padding-left: 50px;
}

.form-heading {
  font-size: 35px;
  /* Membuat font terlihat sangat tebal dan padat */
  font-weight: 900; 
  text-transform: uppercase;
  margin-bottom: 25px;
  letter-spacing: -1px; /* Sedikit dirapatkan */
}

.form-input,
.form-textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #000;
  outline: none;
  font-size: 16px;
  height: 45px;
  border-radius: 6px; 
}

.form-textarea {
  height: 150px; 
  resize: none;
  border-radius: 8px; 
}

.submit-button {
  background-color: #ffc400; 
  color: #000;
  font-weight: bold;
  padding: 10px 30px;
  border: none;
  cursor: pointer;
  text-transform: uppercase;
  align-self: flex-end; 
  margin-top: -5px; 
  border-radius: 25px; 
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  
  transition: all 0.1s ease;
}

.submit-button:active {
  background-color: #e0ac00; 
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); 
  transform: translateY(1px); 
}


/* --- Bagian Informasi Kontak (Tumpukan Kartu) --- */
.contact-info-section {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: flex-start; /* Geser tumpukan ke atas */
  position: relative;
  min-height: 400px; 
  padding-top: 50px; 
}

.info-cards-stack {
  position: relative;
  width: 450px; /* Lebar area tumpukan diperbesar */
  height: 450px; /* Tinggi area tumpukan diperbesar */
}

/* Styling Dasar Kartu */
.info-card {
  position: absolute;
  width: 200px;
  height: 180px;
  border: 1px solid #000;
  padding: 20px;
  background-color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  border-radius: 10px;
  box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
}

/* Ikon SVG Placeholder (Garis Luar) */
.icon-outline {
  width: 25px;
  height: 25px;
  margin-bottom: 10px;
  color: #000;
  
  /* --- Geser ke Kanan --- */
  margin-left: 20px; /* Sesuaikan nilai 20px sesuai kebutuhan pergeseran */
}

.card-title {
  font-size: 14px;
  font-weight: bold;
  margin: 0 0 5px 0;
  text-transform: uppercase;
  
  /* --- Geser ke Kanan --- */
  margin-left: 20px; /* Sesuaikan nilainya agar konsisten dengan ikon */
}

.contact-group {
    display: flex;
    flex-direction: column; /* Jika elemen disusun vertikal */
    align-items: flex-end; /* Semua item di dalamnya akan menempel ke kanan */
}

.info-card p {
  font-size: 12px;
  margin: 0;
  line-height: 1.4;
  margin-left: 20px;
}

/* Penempatan Posisi Absolut untuk Tumpukan (disesuaikan dengan gambar) */
/* Posisi dan z-index yang lebih akurat */
.card-office {
  top: 50px;
  left: 0;
  z-index: 4; 
}
.card-phone {
  top: 0;
  left: 170px;
  z-index: 3;
}
.card-fax {
  top: 190px;
  left: 30px; /* Lebih dekat ke kiri bawah */
  z-index: 2;
}
.card-email {
  top: 150px;
  left: 200px;
  z-index: 1; 
}

/* --- Media Query (Responsif) --- */
@media (max-width: 850px) {
  .contact-us-wrapper {
    flex-direction: column;
    align-items: center;
  }

  .contact-info-section {
    min-height: auto;
    padding-top: 0;
    margin-bottom: 40px;
    width: 100%;
  }
  
  /* Hilangkan posisi absolut dan gunakan grid pada mobile */
  .info-cards-stack {
    position: static;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    height: auto;
    padding: 0 10px;
  }

  .info-card {
    position: static;
    width: auto;
    height: auto;
    padding: 15px;
  }

  .contact-form-section {
    padding-left: 0;
    width: 100%;
  }
  
  .submit-button {
      align-self: center; /* Tombol di tengah pada mobile */
      margin-top: 10px;
  }
}
</style>