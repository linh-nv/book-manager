<template>
  <div class="profile-page w-full">
    <h1>User Profile</h1>
    <Form @submit.prevent="onSubmit" class="flex flex-col gap-6">
      <div class="form-group">
        <label for="name">Name</label>
        <Field
          type="text"
          id="name"
          name="name"
          v-model="user.name"
          class="focus:outline-none"
          placeholder="Enter your name"
        />
        <ErrorMessage name="name" class="form-message text-red-500" />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <Field
          type="email"
          id="email"
          name="email"
          v-model="user.email"
          class="focus:outline-none"
          placeholder="Enter your email"
        />
        <ErrorMessage name="email" class="form-message text-red-500" />
      </div>

      <div class="form-group">
        <label for="tel">Phone</label>
        <Field
          type="text"
          id="tel"
          name="tel"
          v-model="user.tel"
          class="focus:outline-none"
          placeholder="Enter your phone number"
        />
        <ErrorMessage name="tel" class="form-message text-red-500" />
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <Field
          as="textarea"
          id="address"
          name="address"
          v-model="user.address"
          class="focus:outline-none"
          placeholder="Enter your address"
        />
        <ErrorMessage name="address" class="form-message text-red-500" />
      </div>

      <div class="form-group">
        <label for="birthday">Birthday</label>
        <Field
          type="date"
          id="birthday"
          name="birthday"
          v-model="user.birthday"
          class="focus:outline-none"
        />
        <ErrorMessage name="birthday" class="form-message text-red-500" />
      </div>

      <div class="form-group">
        <label for="gender">Gender</label>
        <Field
          as="select"
          id="gender"
          name="gender"
          v-model="user.gender"
          class="focus:outline-none"
        >
          <option
            v-for="option in genderOptions"
            :key="option.id"
            :value="option.id"
          >
            {{ option.label }}
          </option>
        </Field>
        <ErrorMessage name="gender" class="form-message text-red-500" />
      </div>

      <div class="form-button flex justify-center gap-4">
        <button
          type="submit"
          class="w-1/3 py-4 bg-blue-500 rounded-xl text-white font-semibold shadow-sm shadow-slate-400"
        >
          Submit
        </button>
        <button
          type="button"
          @click="showChangePasswordForm = !showChangePasswordForm"
          class="w-1/3 py-4 bg-green-500 rounded-xl text-white font-semibold shadow-sm shadow-slate-400"
        >
          Change Password
        </button>
      </div>
    </Form>
    <div v-if="showChangePasswordForm" class="form-change-password">
      <Form
        @submit.prevent="onSubmitChangePassword"
        class="flex flex-col w-1/3 gap-20 bg-white p-14 shadow shadow-slate-300 rounded-xl"
      >
        <h2 class="flex justify-center text-4xl font-semibold">
          Change Password
        </h2>
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <Field
            type="password"
            id="current_password"
            name="current_password"
            v-model="passwordForm.current_password"
            class="focus:outline-none"
            placeholder="Enter current password"
          />
          <ErrorMessage
            name="current_password"
            class="form-message text-red-500"
          />
        </div>

        <div class="form-group">
          <label for="new_password">New Password</label>
          <Field
            type="password"
            id="new_password"
            name="new_password"
            v-model="passwordForm.new_password"
            class="focus:outline-none"
            placeholder="Enter new password"
          />
          <ErrorMessage name="new_password" class="form-message text-red-500" />
        </div>

        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <Field
            type="password"
            id="confirm_password"
            name="confirm_password"
            v-model="passwordForm.confirm_password"
            class="focus:outline-none"
            placeholder="Confirm new password"
          />
          <ErrorMessage
            name="confirm_password"
            class="form-message text-red-500"
          />
        </div>

        <div class="form-button flex justify-center gap-10">
          <button
            type="submit"
            class="w-1/3 py-4 bg-blue-500 rounded-xl text-white font-semibold shadow-sm shadow-slate-400"
          >
            Change Password
          </button>
          <button
            @click="showChangePasswordForm = !showChangePasswordForm"
            class="w-1/3 py-4 bg-blue-500 rounded-xl text-white font-semibold shadow-sm shadow-slate-400"
          >
            Cancel
          </button>
        </div>
      </Form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { userService } from "../apis/user";
import { genderOptions } from "../constants/genderStatus";
import { useForm, Field, Form, ErrorMessage } from "vee-validate";
import * as yup from "yup";

const user = ref({
  id: null,
  name: "",
  email: "",
  tel: "",
  address: "",
  birthday: "",
  gender: 1,
});

const showChangePasswordForm = ref(false);

const passwordForm = ref({
  current_password: "",
  new_password: "",
  confirm_password: "",
});

const router = useRouter();

const fetchUserProfile = async () => {
  try {
    const response = await userService.profile();
    user.value = response;
  } catch (error) {
    console.error("Failed to fetch user profile:", error);
  }
};

onMounted(() => {
  fetchUserProfile();
});

const validationSchema = yup.object({
  name: yup.string().required("Name is required"),
  email: yup
    .string()
    .email("Invalid email format")
    .required("Email is required"),
  tel: yup.string().required("Phone number is required"),
  address: yup.string().required("Address is required"),
  birthday: yup.date().required("Birthday is required"),
  gender: yup.number().required("Gender is required"),
});

const passwordValidationSchema = yup.object({
  current_password: yup.string().required("Current password is required"),
  new_password: yup
    .string()
    .min(6, "New password must be at least 6 characters")
    .required("New password is required"),
  confirm_password: yup
    .string()
    .oneOf([yup.ref("new_password"), null], "Passwords must match")
    .required("Confirm password is required"),
});

const { handleSubmit } = useForm({
  validationSchema,
});

const { handleSubmit: handlePasswordSubmit } = useForm({
  validationSchema: passwordValidationSchema,
});

const onSubmit = async () => {
  try {
    console.log("Submitting user:", user.value);
    if (user.value.id) {
      await userService.update(user.value.id, user.value);
      alert("Profile updated successfully!");
    } else {
      console.error("User ID is missing!");
    }
  } catch (error) {
    console.error("Failed to update profile:", error);
  }
};

const onSubmitChangePassword = async () => {
  try {
    const { current_password, new_password } = passwordForm.value;
    await userService.changePassword({ current_password, new_password });
    alert("Password changed successfully!");
    showChangePasswordForm.value = false;
  } catch (error) {
    console.error("Failed to change password:", error);
  }
};
</script>

<style scoped>
.profile-page {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-page h1 {
  margin-bottom: 20px;
  text-align: center;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.form-group label {
  font-weight: bold;
}

.form-group input,
.form-group textarea,
.form-group select {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  width: 100%;
}

.form-group textarea {
  resize: vertical;
}

.form-button {
  margin-top: 20px;
}

.form-button button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.form-button button:hover {
  background-color: #0056b3;
}
.form-change-password {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1111;
}
.form-change-password::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  opacity: 0.8;
  z-index: -1;
}
</style>
