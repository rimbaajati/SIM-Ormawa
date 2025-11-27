<script setup>
const route = useRoute();
const { $axios } = useNuxtApp();

const id = route.params.id;
const data = ref(null);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await $axios.get(`/tracking/${id}`);
    data.value = res.data;
  } catch (e) {
    console.error(e);
  } finally {
    loading.value = false;
  }
});
</script>

<template>
  <div v-if="loading">ora loading</div>

  <div v-else>
    <h1>{{ data.judul }}</h1>
    <ul>
      <li v-for="s in data.timeline" :key="s.id">
        {{ s.text }} - {{ s.detail }}
      </li>
    </ul>
  </div>
</template>

<style scoped>
.tracking-wrapper {
  max-width: 900px;
  margin: 0 auto;
  padding: 40px;
  color: white;
}

.title {
  font-size: 32px;
  font-weight: 700;
  color: #4dc0ff;
}

.section {
  margin-top: 40px;
}

.current-status {
  display: flex;
  gap: 16px;
  background: rgba(255, 255, 255, 0.05);
  padding: 18px;
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.status-badge {
  padding: 6px 14px;
  border-radius: 6px;
  font-weight: 600;
  color: white;
}

.timeline {
  border-left: 2px solid rgba(255, 255, 255, 0.1);
  padding-left: 20px;
}

.timeline-item {
  position: relative;
  margin-bottom: 20px;
}

.dot {
  position: absolute;
  left: -12px;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  border: 2px solid gray;
}

.dot-done {
  background: #22c55e;
  border-color: #16a34a;
}

.dot-pending {
  background: #444;
  border-color: #777;
}

.step-title {
  font-size: 18px;
  font-weight: 600;
}
.step-detail {
  font-size: 14px;
  color: #bbb;
}
</style>
