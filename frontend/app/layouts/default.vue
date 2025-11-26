<template>
  <div>
    <header class="nav fixed w-full z-50">
      <div class="container nav-inner">
        <div class="brand">SIM ORMAWA</div>
        <nav class="links">
          <NuxtLink to="#fitur">Fitur</NuxtLink>
          <NuxtLink to="#tentang">Tentang</NuxtLink>
          <NuxtLink to="#kontak">Kontak</NuxtLink>
        </nav>
        <NuxtLink to="/login" class="cta">Masuk</NuxtLink>
      </div>
    </header>

    <main class="site-body">
      <slot />
    </main>

    <footer class="footer">
      <div class="container footer-inner">
        <div>© {{ new Date().getFullYear() }} SIM Ormawa</div>
        <div class="small">Dibuat dengan ❤️ — Modern Dark Theme</div>
      </div>
    </footer>
  </div>
</template>

<script setup></script>

<style scoped>
/* Layout-specific minimal overrides; main styles live in assets/css/main.css */
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}
.nav {
  background: linear-gradient(
    90deg,
    rgba(6, 10, 20, 0.6),
    rgba(10, 15, 30, 0.6)
  );
  border-bottom: 1px solid rgba(255, 255, 255, 0.04);
  backdrop-filter: blur(6px);
}
.nav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 72px;
}
.brand {
  color: var(--neon);
  font-weight: 800;
  letter-spacing: 1px;
}
.links a {
  color: rgba(255, 255, 255, 0.78);
  margin-left: 18px;
  text-decoration: none;
  font-weight: 600;
}
.cta {
  background: linear-gradient(90deg, var(--neon) 0%, #2ac0ff 100%);
  color: #08101a;
  padding: 10px 14px;
  border-radius: 10px;
  font-weight: 700;
  border: none;
  box-shadow: 0 8px 30px rgba(42, 192, 255, 0.12);
}
.site-body {
  padding-top: 92px;
}
.footer {
  margin-top: 60px;
  padding: 24px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.03);
}
.small {
  color: rgba(255, 255, 255, 0.5);
  font-size: 13px;
}
</style>
