<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import BasicLayout from "@/Layouts/BasicLayout.vue";

const breadcrumbs = [
  {
    text: "Home",
    disabled: false,
    href: "/",
  },
  {
    text: "Links",
    disabled: true,
    href: "",
  },
];

const props = defineProps(["urls"]);
const urls = props.urls.data;
</script>
<template>
  <BasicLayout :breadcrumbs="breadcrumbs">
    <div class="flex justify-between mb-4">
      <h1 class="text-xl font-extrabold">My List</h1>
      <Link href="/links/create">
        <button
          class="bg-indigo-600 hover:bg-indigo-800 p-2 rounded text-white text-xs font-semibold"
        >
          ADD NEW URL
        </button>
      </Link>
    </div>
    <div class="overflow-x-auto">
      <table class="table w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Url</th>
            <th>Failing</th>
            <th>Last modified</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr v-for="url in urls">
            <th>{{ url.id }}</th>
            <td>
              {{ url.url }}<br />
              <span class="badge badge-ghost badge-sm">{{
                url.active ? "Active" : "InActive"
              }}</span>
            </td>
            <td>{{ url.failing ? "Red" : "Green" }}</td>
            <td>{{ url.updated_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </BasicLayout>
</template>
