<script setup lang="ts">
import { cn } from '@/lib/utils';
import { HTMLAttributes } from 'vue';

const props = defineProps<{ class?: HTMLAttributes["class"] }>()
</script>

<template>
    <section :class="cn('px-4', props.class)">
        <slot />
    </section>
</template>