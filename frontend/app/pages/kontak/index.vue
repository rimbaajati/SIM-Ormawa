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
@import url('~/assets/css/kontak/kontak.css');
</style>

<template>
  <div class="contact-us-wrapper">
    <div class="contact-info-section">
      <div class="info-cards-stack">
        
        <div class="info-card card-office">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 2a8 8 0 0 1 8 8c0 7-8 12-8 12s-8-5-8-12a8 8 0 0 1 8-8z"/></svg>
          </div>
          <h4 class="card-title">ALAMAT</h4>
          <p>Jl. Tulang Bawang Sel. No.26</p>
          <p>Kota Surakarta, Jawa Tengah 57136</p>
        </div>

        <div class="info-card card-phone">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-3.67-2.92 19.19 19.19 0 0 1-2.92-3.67A19.79 19.79 0 0 1 2 4.18 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <h4 class="card-title">TELEPON</h4>
          <p>(0271) 734955 </p>
        </div>
        
        <div class="info-card card-fax">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><path d="M6 15h0M18 15h0M6 19h0M18 19h0M2 11h20M9 3l3 4 3-4"/></svg>
          </div>
          <h4 class="card-title">FAX</h4>
          <p>(0271) 734955</p>
        </div>

        <div class="info-card card-email">
          <div class="icon-outline">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <h4 class="card-title">EMAIL</h4>
          <p>info@umpku.ac.id</p>
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