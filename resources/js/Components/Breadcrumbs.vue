<script setup>
const props = defineProps(['links']);
</script>
<template>
    <div class="text-sm breadcrumbs">
        <ul>
            <li v-for="link in props.links" :key="link.title">
                <a :href="link.href">{{ link.title }}</a>
            </li>
        </ul>
    </div>
</template>
