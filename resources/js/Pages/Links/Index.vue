<script setup>
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
    <h1>My List</h1>
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
