<template>
  <div class="add-content">
    <div class="form-box">
      <Form
        @submit="onSubmit"
        :validation-schema="validationSchema"
        class="flex flex-col gap-14"
      >
        <div class="form-group form-category">
          <label for="publisher-name">Publisher Name</label>
          <Field
            type="text"
            name="name"
            v-model="publisher.name"
            id="publisher-name"
            class="focus:outline-none"
            placeholder="Enter publisher name"
          />
          <ErrorMessage name="name" class="form-message text-red-500" />
        </div>

        <div class="form-group form-category">
          <label for="publisher-description">Description</label>
          <Field
            as="textarea"
            name="description"
            v-model="publisher.description"
            id="publisher-description"
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
import { publisherService } from "../../apis/publisher";
import { useForm, Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import { vietnameseNameRegex } from "../../utils/regex";

const publisher = ref({
  name: "",
  description: "",
});
const router = useRouter();
const route = useRoute();

const fetchpublisher = async (id) => {
  try {
    const response = await publisherService.find(id);
    publisher.value = response.data;
  } catch (error) {
    console.error("Failed to fetch publisher:", error);
  }
};

onMounted(() => {
  if (route.params.id) {
    fetchpublisher(route.params.id);
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
      await publisherService.update(route.params.id, publisher.value);
    } else {
      await publisherService.create(publisher.value);
    }
    router.push({ name: "publisher-list" });
  } catch (error) {
    console.error("Failed to save publisher:", error);
  }
};
</script>

<style scoped></style>
