<script setup>
defineProps({
  id: String,
  header: String,
  desc: String,
});
</script>

<template>
  <input type="checkbox" :id="id" class="modal-toggle" />
  <div class="modal">
    <div class="modal-box">
      <h3 class="font-bold text-lg">{{ header }}</h3>
      <p class="py-4"></p>
      {{ desc }}
      <div class="modal-action">
        <label :for="id" class="btn btn-ghost btn-outline">Cancel</label>
        <label
          :for="id"
          class="btn btn-primary"
          @click="this.$emit('onConfirm')"
        >
          Submit
        </label>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
