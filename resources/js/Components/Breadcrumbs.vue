<script setup>
defineProps({
    items: Array
})
</script>
<template>
    <ol class="flex text-gray-700 bg-gray-100 rounded py-2 px-2">
        <template v-for="(item, index) in items">
            <li class="px-2" :class="{'text-indigo-600': item.disabled}">
                <template v-if="item.href !== ''">
                    <a :href="item.href" class="hover:underline">{{ item.text }}</a>
                </template>
                <template v-else>
                    {{ item.text }}
                </template>
            </li>
            <li v-if="index < items.length - 1" class="text-gray-500 select-none">&rsaquo;</li>
        </template>
    </ol>
</template>
