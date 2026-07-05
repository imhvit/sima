<script setup lang="ts">
import SidebarLayout from './app/SidebarLayout.vue';

defineProps<{
    module: string;
}>();
</script>

<template>
    <SidebarLayout :module="module">
        <slot />
    </SidebarLayout>
</template>
