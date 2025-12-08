<script>
export default {
  name: "ImprovedContactUs",
  data() {
    return {
      formData: {
        name: "",
        email: "",
        message: "",
      },
    };
  },
  methods: {
    submitForm() {
      console.log("Form data submitted:", this.formData);
      alert("Pesan terkirim!");
      this.formData = { name: "", email: "", message: "" };
    },
    openWhatsApp() {
      const phoneNumber = "6289602834848"; // Nomor tujuan (tanpa + dan tanda hubung)
      const message = encodeURIComponent(
        "Assalamualaikum Wr Wb, Permisi Pak Tama apakah hari ini saya bisa bertemu dengan bapak?"
      );
      window.open(`https://wa.me/${phoneNumber}?text=${message}`, "_blank");
    },
  },
};
</script>

<style scoped>
@import url("~/assets/css/kontak/kontak.css");
</style>

<template>
  <div class="contact-us-wrapper">
    <div class="contact-info-section">
      <div class="info-cards-stack">
        <div class="info-card card-office">
          <div class="icon-outline">
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <circle cx="12" cy="10" r="3" />
              <path
                d="M12 2a8 8 0 0 1 8 8c0 7-8 12-8 12s-8-5-8-12a8 8 0 0 1 8-8z"
              />
            </svg>
          </div>
          <h4 class="card-title">ALAMAT</h4>
          <p>Jl. Tulang Bawang Sel. No.26</p>
          <p>Kota Surakarta, Jawa Tengah 57136</p>
        </div>

        <div class="info-card card-phone">
          <div class="icon-outline">
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path
                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-3.67-2.92 19.19 19.19 0 0 1-2.92-3.67A19.79 19.79 0 0 1 2 4.18 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
              />
            </svg>
          </div>
          <h4 class="card-title">TELEPON</h4>
          <p>(0271) 734955</p>
        </div>

        <div class="info-card card-fax">
          <div class="icon-outline">
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <rect x="2" y="7" width="20" height="15" rx="2" ry="2" />
              <path d="M6 15h0M18 15h0M6 19h0M18 19h0M2 11h20M9 3l3 4 3-4" />
            </svg>
          </div>
          <h4 class="card-title">FAX</h4>
          <p>(0271) 734955</p>
        </div>

        <div class="info-card card-email">
          <div class="icon-outline">
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path
                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
              />
              <polyline points="22,6 12,13 2,6" />
            </svg>
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

    <!-- === Floating WhatsApp Bubble === -->
    <div class="whatsapp-float" @click="openWhatsApp" title="Chat via WhatsApp">
      <svg viewBox="0 0 32 32">
        <path
          d="M16.004 3C9.375 3 4 8.374 4 15.002c0 2.645.867 5.084 2.346 7.076L4 29l7.125-2.318A11.943 11.943 0 0 0 16.004 27C22.631 27 28 21.627 28 15.002 28 8.374 22.631 3 16.004 3Zm0 22c-1.867 0-3.668-.496-5.262-1.439l-.377-.221-4.22 1.375 1.389-4.092-.248-.377A9.938 9.938 0 0 1 6 15.002C6 9.478 10.477 5 16.004 5 21.524 5 26 9.478 26 15.002 26 20.524 21.524 25 16.004 25Zm5.295-7.449c-.291-.146-1.719-.848-1.984-.941-.264-.098-.457-.145-.65.145-.195.291-.748.941-.916 1.135-.166.195-.338.219-.629.073-.291-.145-1.23-.453-2.342-1.445-.865-.77-1.445-1.719-1.611-2.01-.166-.291-.018-.449.127-.594.129-.129.291-.338.436-.506.146-.17.195-.291.291-.486.098-.195.049-.365-.024-.506-.073-.145-.65-1.568-.891-2.145-.232-.563-.469-.486-.65-.494l-.555-.01c-.193 0-.506.072-.771.365-.264.291-1.016.992-1.016 2.414 0 1.422 1.041 2.797 1.186 2.99.146.195 2.047 3.125 5.004 4.383.7.301 1.248.48 1.674.613.703.223 1.342.191 1.848.115.564-.084 1.719-.703 1.963-1.381.242-.676.242-1.26.168-1.381-.072-.121-.264-.193-.555-.34Z"
        />
      </svg>
    </div>
  </div>
</template>
