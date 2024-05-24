<template>
  <div>
    <HeaderComponent />
    <NavbarComponent />
    <div class="content-page">
      <div v-if="loading" class="loader"></div>
      <div v-else>
        <div v-for="(author,index) in authors" :key="index" class="author-item">
          <h3>{{ author.name }}</h3>
          <p>{{ author.description }}</p>
          <small>Created at: {{ new Date(author.created_at).toLocaleString() }}</small>
          <small>Updated at: {{ new Date(author.updated_at).toLocaleString() }}</small>
        </div>
        <div class="pagination">
          <button @click="prevPage" :disabled="!pagination.prev_page_url">Previous</button>
          <button @click="nextPage" :disabled="!pagination.next_page_url">Next</button>
        </div>
      </div>
    </div>
    <FooterComponent />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useUserStore } from "../stores/userStore";
import { useRouter } from 'vue-router';
import HeaderComponent from "../components/HeaderComponent.vue";
import NavbarComponent from "../components/NavbarComponent.vue";
import FooterComponent from "../components/FooterComponent.vue";
import { authorService } from '../apis/author';

const authors = ref([]);
const loading = ref(false);
const pagination = ref({});

const fetchAuthors = async (page = 1) => {
  loading.value = true;
  try {
    const response = await authorService.getAll(page);
    authors.value = response.data.data;
    pagination.value = {
      current_page: response.data.current_page,
      next_page_url: response.data.next_page_url,
      prev_page_url: response.data.prev_page_url,
    };
  } catch (error) {
    console.error("Failed to fetch authors:", error);
  } finally {
    loading.value = false;
  }
};
const nextPage = () => {
  if (pagination.value.next_page_url) {
    fetchAuthors(pagination.value.current_page + 1);
  }
};

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    fetchAuthors(pagination.value.current_page - 1);
  }
};

onMounted(() => {
  fetchAuthors();
});
</script>

<style scoped>
/* Add your styles here */
.author-card {
  border: 1px solid #ddd;
  padding: 16px;
  margin-bottom: 16px;
}

.pagination {
  display: flex;
  justify-content: space-between;
}
</style>
