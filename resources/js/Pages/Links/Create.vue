<script setup>
import BasicLayout from "@/Layouts/BasicLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const breadcrumbs = [
  {
    text: "Home",
    disabled: false,
    href: "/",
  },
  {
    text: "Links",
    disabled: false,
    href: "/links",
  },
  {
    text: "Create",
    disabled: true,
    href: "",
  },
];

const form = useForm({
  url: "",
});

const submit = () => {
  form.post("/links");
};

defineProps({
  errors: Object,
});
</script>
<template>
  <BasicLayout :breadcrumbs="breadcrumbs">
    <div class="flex justify-center">
      <div class="w-1/2 shadow rounded p-10 bg-white">
        <form @submit.prevent="submit">
          <div class="card-body">
            <h2 class="card-title">Enter the URL</h2>
            <input
              v-model="form.url"
              type="text"
              placeholder="Type here"
              class="input input-bordered input-sm w-full max-w-xs"
              name="url"
              required
            />
            <div v-if="errors.url" class="text-red-600">{{ errors.url }}</div>
            <div class="card-actions">
              <button class="btn btn-primary btn-sm">SAVE</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </BasicLayout>
</template>
