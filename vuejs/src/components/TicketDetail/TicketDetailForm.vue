<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <!-- Book Name Input Field -->
        <div class="form-group form-category">
          <label for="ticket_detail_book_name">Book Name</label>
          <Field
            type="text"
            name="book_name"
            v-model="bookNameInput"
            id="ticket_detail_book_name"
            class="focus:outline-none"
            placeholder="Enter book name"
            @input="debouncedSearch"
          />
          <ErrorMessage name="book_name" class="form-message text-red-500" />

          <ul v-if="searchBookResults.length" class="search-results">
            <li
              v-for="book in searchBookResults"
              :key="book.id"
              @click="selectBook(book)"
            >
              {{ book.name }}
            </li>
          </ul>
        </div>

        <!-- Status Select Field -->
        <div v-if="route.name === 'ticket-detail-form-edit'" class="form-group form-category">
          <label for="ticket_detail_status">Status</label>
          <Field
            as="select"
            name="status"
            v-model="ticketDetail.status"
            id="ticket_detail_status"
            class="focus:outline-none"
          >
            <option
              v-for="status in statusOptions"
              :key="status.id"
              :value="status.id"
            >
              {{ status.label }}
            </option>
          </Field>
          <ErrorMessage name="status" class="form-message text-red-500" />
        </div>

        <!-- Quantity Input Field -->
        <div class="form-group form-category">
          <label for="ticket_detail_quantity">Quantity</label>
          <Field
            type="number"
            name="quantity"
            v-model="ticketDetail.quantity"
            id="ticket_detail_quantity"
            class="focus:outline-none"
            placeholder="Enter quantity"
          ></Field>
          <ErrorMessage name="quantity" class="form-message text-red-500" />
        </div>

        <!-- Submit Button -->
        <div class="form-button flex justify-center">
          <button
            type="submit"
            class="w-1/3 py-4 bg-blue-500 rounded-xl text-white font-semibold shadow-sm shadow-slate-400"
          >
            Submit
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { ticketService } from "../../apis/ticketDetail.js";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { debounce } from "lodash-es";
import { ticketDetailStatus } from "../../constants/ticketDetailStatus.js";
import { apiService } from "../../apis/base.js";

const router = useRouter();
const route = useRoute();

const bookNameInput = ref("");
const searchBookResults = ref([]);

const ticketDetail = ref({
  lend_ticket_id: route.params.id,
  status: 1,
  quantity: 1,
  book_id: "",
});

const validationSchema = yup.object({
  book_name: yup.string().required("Book is required"),
  quantity: yup
    .number()
    .required("Quantity is required")
    .min(1, "Quantity must be at least 1"),
});

const { handleSubmit } = useForm({
  validationSchema,
});

const searchBooks = async () => {
  try {
    if (bookNameInput.value.length > 0) {
      const response = await apiService.search("/book", bookNameInput.value);
      searchBookResults.value = response.data;
    } else {
      searchBookResults.value = [];
    }
  } catch (error) {
    console.error("Error searching books:", error);
  }
};

const debouncedSearch = debounce(searchBooks, 1000);

const selectBook = (book) => {
  bookNameInput.value = book.name;
  ticketDetail.value.book_id = book.id;
  searchBookResults.value = [];
};

const fetchTicketDetail = async (id) => {
  try {
    const response = await ticketService.find(id);
    ticketDetail.value = response.data;
    bookNameInput.value = response.data.book.name;
  } catch (error) {
    console.error("Failed to fetch ticket detail:", error);
  }
};

watch(
  () => route.params.id,
  (id) => {
    if (route.name === 'ticket-detail-form-edit') {
      fetchTicketDetail(id);
    }
  },
  { immediate: true }
);

const onSubmit = async () => {
  try {
    if (route.name == 'ticket-detail-form-edit') {
      await ticketService.update(route.params.id, ticketDetail.value);
    } else {
      await ticketService.create(ticketDetail.value);
    }
    router.back();
  } catch (error) {
    console.error("Failed to save ticket detail:", error);
  }
};

const statusOptions = ticketDetailStatus;

</script>

<style scoped>
.search-results {
  background: white;
  border: 1px solid #ccc;
  list-style: none;
  margin: 0;
  max-height: 150px;
  overflow-y: auto;
  padding: 0;
}

.search-results li {
  cursor: pointer;
  padding: 10px;
}

.search-results li:hover {
  background: #eee;
}
</style>
