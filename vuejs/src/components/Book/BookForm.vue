<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <div class="form-upload-box flex justify-center gap-96 mb-20">
          <div
            class="form-upload relative"
            v-for="field in ['front_image', 'thumbnail', 'rear_image']"
            :key="field"
          >
            <div class="upload">
              <input
                :id="'upload_' + field"
                type="file"
                class="upload-photo"
                :name="field"
                accept="image/*"
                @change="onImageChange(field)"
              />
              <label v-if="book[field]" :for="'upload_' + field">
                <img class="w-40 h-40" :src="book[field]" :alt="field" />
              </label>
              <label
                v-else
                :for="'upload_' + field"
                class="upload-icon bg-blue-100"
              >
                <i class="fa-solid fa-images fa-xl text-blue-500"></i>
              </label>
            </div>
            <label
              :for="'upload_' + field"
              class="label-text truncate overflow-ellipsis overflow-hidden whitespace-nowrap w-36 text-center"
            >
              {{
                field.replace("_", " ").replace(/\b\w/g, (l) => l.toUpperCase())
              }}
            </label>
          </div>
        </div>

        <div
          class="form-group form-book"
          v-for="(value, key) in bookFields"
          :key="key"
        >
          <label :for="'book_' + key">{{
            key.replace("_", " ").replace(/\b\w/g, (l) => l.toUpperCase())
          }}</label>
          <template
            v-if="['category_id', 'author_id', 'publisher_id'].includes(key)"
          >
            <Field
              as="select"
              :name="key"
              v-model="book[key]"
              :id="'book_' + key"
              class="focus:outline-none"
            >
              <option :value="null">Select {{ key }}</option>
              <option
                v-for="(optionName, optionId) in options[
                  key.replace('_id', '')
                ]"
                :key="optionId"
                :value="optionId"
              >
                {{ optionName }}
              </option>
            </Field>
          </template>
          <template v-else-if="key !== 'description'">
            <Field
              type="text"
              :name="key"
              v-model="book[key]"
              :id="'book_' + key"
              class="focus:outline-none"
              :placeholder="'Enter ' + key.replace('_', ' ')"
              @input="key === 'name' && updateSlug"
            />
          </template>
          <template v-else>
            <Field
              as="textarea"
              :name="key"
              v-model="book[key]"
              :id="'book_' + key"
              class="focus:outline-none"
              :placeholder="'Enter ' + key.replace('_', ' ')"
            ></Field>
          </template>
          <ErrorMessage :name="key" class="form-message text-red-500" />
        </div>

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
import { ref, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { bookService } from "../../apis/book";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { vietnameseNameRegex, slugRegex } from "../../utils/regex";

const book = ref({
  name: "",
  slug: "",
  description: "",
  quantity: "",
  category_id: "",
  author_id: "",
  publisher_id: "",
  price: "",
  front_image: null,
  thumbnail: null,
  rear_image: null,
});

const bookFields = {
  name: "",
  slug: "",
  description: "",
  quantity: "",
  category_id: "",
  author_id: "",
  publisher_id: "",
  price: "",
};

const options = ref({
  category: {},
  author: {},
  publisher: {},
});

const router = useRouter();
const route = useRoute();

const fetchBook = async (id) => {
  try {
    const response = await bookService.find(id);
    book.value = response.data;
  } catch (error) {
    console.error("Failed to fetch book:", error);
  }
};

const fetchOptions = async () => {
  try {
    const response = await bookService.getAllCategoriesAuthorsPublishers();
    options.value.category = response.data.categories;
    options.value.author = response.data.authors;
    options.value.publisher = response.data.publishers;
  } catch (error) {
    console.error("Failed to fetch options:", error);
  }
};

onMounted(() => {
  if (route.params.id) {
    fetchBook(route.params.id);
  }
  fetchOptions();
});

const validationSchema = yup.object({
  name: yup
    .string()
    .matches(vietnameseNameRegex, "Name can only contain letters and spaces")
    .required("Name is required"),
  slug: yup
    .string()
    .matches(
      slugRegex,
      "Slug can only contain lowercase letters, numbers, and hyphens"
    )
    .required("Slug is required"),
  description: yup.string(),
  quantity: yup.string().required("Quantity is required"),
  category_id: yup.string().required("Category is required"),
  author_id: yup.string().required("Author is required"),
  publisher_id: yup.string().required("Publisher is required"),
  price: yup.string().required("Price is required"),
});

const { handleSubmit } = useForm({
  validationSchema,
});


const onSubmit = async () => {
  const formData = new FormData();
  for (const key in book.value) {
    if (book.value[key] instanceof File) {
      formData.append(key, book.value[key]);
      console.log(key, book.value[key]);
    } else {
      formData.append(key, book.value[key]);
      console.log(key, book.value[key]);
    }
  }
  console.log(book.value);
  // try {
  //   if (route.params.id) {
  //     await bookService.update(route.params.id, formData);
  //   } else {
  //     await bookService.create(formData);
  //   }
  //   router.push({ name: 'book-list' });
  // } catch (error) {
  //   console.error('Failed to save book:', error);
  // }
};

const onImageChange = (field) => (event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    book.value[field] = file;
    reader.onload = (e) => {
      book.value[field] = e.target.result;
    };
  }
  console.log(book.value[field]);
};

const updateSlug = () => {
  book.value.slug = book.value.name
    .toLowerCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/đ/g, "d")
    .replace(/[^a-z0-9\s-]/g, "")
    .replace(/\s+/g, "-")
    .replace(/-+/g, "-");
};

watch(() => book.value.name, updateSlug);
</script>

<style scoped></style>
