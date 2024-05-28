<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <!-- User Name Input Field -->
        <div class="form-group form-category">
          <label for="lend_ticket_name">User Name LendTicket</label>
          <Field
            type="text"
            name="name"
            v-model="userNameInput"
            id="lend_ticket_name"
            class="focus:outline-none"
            :class="route.params.id ? 'opacity-50' : ''"
            placeholder="Enter lend ticket name"
            @input="debouncedSearch"
            :disabled="route.params.id"
          />
          <ErrorMessage name="name" class="form-message text-red-500" />
          <ul v-if="searchUserResults.length" class="search-results">
            <li
              v-for="user in searchUserResults"
              :key="user.id"
              @click="selectUser(user)"
            >
              {{ user.name }}
            </li>
          </ul>
        </div>

        <!-- Start Date Input Field -->
        <div class="form-group form-category">
          <label for="lend_ticket_start_date">Start Date</label>
          <Field
            type="date"
            name="start_date"
            v-model="lendTicket.start_date"
            id="lend_ticket_start_date"
            class="focus:outline-none"
            placeholder="Enter start_date"
          ></Field>
          <ErrorMessage name="start_date" class="form-message text-red-500" />
        </div>

        <!-- End Date Input Field -->
        <div class="form-group form-category">
          <label for="lend_ticket_end_date">End Date</label>
          <Field
            type="date"
            name="end_date"
            v-model="lendTicket.end_date"
            id="lend_ticket_end_date"
            class="focus:outline-none"
            placeholder="Enter end_date"
          ></Field>
          <ErrorMessage name="end_date" class="form-message text-red-500" />
        </div>

        <!-- Status Select Field -->
        <div
          class="form-group form-category"
          :class="route.params.id ? '' : 'opacity-50'"
        >
          <label for="lend-ticket-status">Status</label>
          <Field
            as="select"
            name="status"
            v-model="lendTicket.status"
            id="lend-ticket-status"
            class="focus:outline-none"
            :disabled="!route.params.id"
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

        <!-- Note Input Field -->
        <div class="form-group form-category">
          <label for="lend_ticket_note">Note</label>
          <Field
            type="text"
            name="note"
            v-model="lendTicket.note"
            id="lend_ticket_note"
            class="focus:outline-none"
            placeholder="Enter note"
          ></Field>
          <ErrorMessage name="note" class="form-message text-red-500" />
        </div>

        <!-- Ticket Details -->
        <div class="form-group form-category">
          <label>Ticket Details</label>
          <div
            v-for="(detail, index) in lendTicket.ticketDetails"
            :key="index"
            class="flex gap-4"
          >
            <div class="flex-1">
              <label>Book ID</label>
              <input
                type="text"
                v-model="detail.book_id"
                class="focus:outline-none"
                v-validate="''"
              />
            </div>
            <div class="flex-1">
              <label>Quantity</label>
              <input
                type="number"
                v-model="detail.quantity"
                class="focus:outline-none"
                v-validate="''"
              />
            </div>
            <button
              type="button"
              @click="removeTicketDetail(index)"
              class="bg-red-500 text-white px-4 py-2 rounded"
            >
              Remove
            </button>
          </div>
          <button
            type="button"
            @click="addTicketDetail"
            class="bg-green-500 text-white px-4 py-2 rounded"
          >
            Add Ticket Detail
          </button>
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
import { lendTicketService } from "../../apis/lendTicket.js";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { debounce } from "lodash-es";
import { lendTicketStatusList } from "../../constants/lendTicketStatus.js";
import { apiService } from "../../apis/base.js";

const lendTicket = ref({
  start_date: "",
  end_date: "",
  status: 1,
  note: "",
  user_id: null,
  userName: "",
  ticketDetails: [{ book_id: "", quantity: 1 }],
});

const userNameInput = ref("");
const searchUserResults = ref([]);
const router = useRouter();
const route = useRoute();

const fetchLendTicket = async (id) => {
  try {
    const response = await lendTicketService.find(id);
    lendTicket.value = response.data;
    userNameInput.value = response.data.user.name;
    lendTicket.value.user_id = response.data.user.id;
  } catch (error) {
    console.error("Failed to fetch Lend Ticket:", error);
  }
};

watch(
  () => route.params.id,
  (id) => {
    if (id) {
      fetchLendTicket(id);
    }
  },
  { immediate: true }
);

const validationSchema = yup.object({
  name: yup.string().required("User is required"),
  start_date: yup.string().required("Start date is required"),
  end_date: yup
    .string()
    .required("End date is required")
    .test(
      "is-greater",
      "End date must be greater than or equal to start date",
      function (value) {
        const { start_date } = this.parent;
        return !start_date || !value || new Date(value) >= new Date(start_date);
      }
    ),
  status: yup.number().required("Status is required"),
  note: yup.string().required("Note is required"),
});

const { handleSubmit } = useForm({
  validationSchema,
});

const searchUsers = async () => {
  try {
    if (userNameInput.value.length > 0) {
      const response = await apiService.search("/user", userNameInput.value);
      searchUserResults.value = response.data;
    } else {
      searchUserResults.value = [];
    }
  } catch (error) {
    console.error("Error searching users:", error);
  }
};

const debouncedSearch = debounce(searchUsers, 1000);

const selectUser = (user) => {
  userNameInput.value = user.name;
  lendTicket.value.user_id = user.id;
  searchUserResults.value = [];
};

const addTicketDetail = () => {
  lendTicket.value.ticketDetails.push({ book_id: "", quantity: 1 });
};

const removeTicketDetail = (index) => {
  lendTicket.value.ticketDetails.splice(index, 1);
};

const onSubmit = async () => {
  try {
    if (route.params.id) {
      await lendTicketService.update(route.params.id, lendTicket.value);
    } else {
      await lendTicketService.create(lendTicket.value);
    }
    router.push({ name: "lend-ticket-list" });
  } catch (error) {
    console.error("Failed to save lendTicket:", error);
  }
};

const statusOptions = lendTicketStatusList;
</script>

<style scoped>
.search-results {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.search-results li {
  cursor: pointer;
  padding: 8px;
  border: 1px solid #ddd;
  margin-top: -1px; 
}

.search-results li:hover {
  background-color: #f0f0f0;
}
</style>
