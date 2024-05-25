<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <div class="form-group form-category">
          <label for="author-name">Author Name</label>
          <Field
            type="text"
            name="name"
            v-model="author.name"
            id="author-name"
            class="focus:outline-none"
            placeholder="Enter author name"
          />
          <ErrorMessage name="name" class="form-message text-red-500" />
        </div>

        <div class="form-group form-category">
          <label for="author-description">Description</label>
          <Field
            as="textarea"
            name="description"
            v-model="author.description"
            id="author-description"
            class="focus:outline-none"
            placeholder="Enter description"
          ></Field>
          <ErrorMessage name="description" class="form-message text-red-500" />
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
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import { authorService } from "../../apis/author";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { vietnameseNameRegex } from "../../utils/regex";

const author = ref({
  name: "",
  description: "",
});
const router = useRouter();
const route = useRoute();

const fetchAuthor = async (id) => {
  try {
    const response = await authorService.find(id);
    author.value = response.data;
  } catch (error) {
    console.error("Failed to fetch author:", error);
  }
};

onMounted(() => {
  if (route.params.id) {
    fetchAuthor(route.params.id);
  }
});

const validationSchema = yup.object({
  name: yup
    .string()
    .matches(vietnameseNameRegex, "Name can only contain letters and spaces")    
    .required("Name is required"),
});

const { handleSubmit } = useForm({
  validationSchema,
});

const onSubmit = async () => {
  try {
    if (route.params.id) {
      await authorService.update(route.params.id, author.value);
    } else {
      await authorService.create(author.value);
    }
    router.push({ name: "author-list" });
  } catch (error) {
    console.error("Failed to save author:", error);
  }
};
</script>

<style scoped></style>
