<script setup>
import BasicLayout from '@/Layouts/BasicLayout.vue';

const fetchUrls = async () => {
    const response = await axios.get('/api/url');
    console.log(response)
}
</script>
<template>
    <BasicLayout></BasicLayout>
</template>
