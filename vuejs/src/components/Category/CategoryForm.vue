<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <div class="form-group form-category">
          <label for="category-name">Category Name</label>
          <Field
            type="text"
            name="name"
            v-model="category.name"
            id="category-name"
            class="focus:outline-none"
            placeholder="Enter category name"
            @input="updateSlug"
          />
          <ErrorMessage name="name" class="form-message text-red-500" />
        </div>
        <div class="form-group form-category">
          <label for="category-slug">Category Slug</label>
          <Field
            type="text"
            name="slug"
            v-model="category.slug"
            id="category-slug"
            class="focus:outline-none"
            placeholder="Enter category slug"
          />
          <ErrorMessage name="slug" class="form-message text-red-500" />
        </div>
        <div class="form-group form-category">
          <label for="category-description">Description</label>
          <Field
            as="textarea"
            name="description"
            v-model="category.description"
            id="category-description"
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
import { ref, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { categoryService } from "../../apis/category";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { vietnameseNameRegex } from "../../utils/regex";
import { slugRegex } from "../../utils/regex";

const category = ref({
  name: "",
  slug: "",
  description: "",
});
const router = useRouter();
const route = useRoute();

const fetchCategory = async (id) => {
  try {
    const response = await categoryService.find(id);
    category.value = response.data;
  } catch (error) {
    console.error("Failed to fetch category:", error);
  }
};

onMounted(() => {
  if (route.params.id) {
    fetchCategory(route.params.id);
  }
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
});

const { handleSubmit } = useForm({
  validationSchema,
});

const onSubmit = async () => {
  try {
    if (route.params.id) {
      await categoryService.update(route.params.id, category.value);
    } else {
      await categoryService.create(category.value);
    }
    router.push({ name: "category-list" });
  } catch (error) {
    console.error("Failed to save category:", error);
  }
};

const updateSlug = () => {
  category.value.slug = category.value.name
    .toLowerCase()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, '') 
    .replace(/đ/g, 'd')
    .replace(/[^a-z0-9\s-]/g, '') 
    .replace(/\s+/g, '-') 
    .replace(/-+/g, '-'); 
};

watch(() => category.value.name, updateSlug);
</script>

<style scoped></style>
