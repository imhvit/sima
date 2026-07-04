<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
} from '@/components/ui/card';

import type { LucideIcon } from '@lucide/vue';
import { computed } from 'vue';

type ComponentVariant = 'default' | 'destructive';

interface Props {
    title: string;
    value: number | string;
    description?: string;
    icon: LucideIcon;
    variant?: ComponentVariant;
}

const {
    title,
    value,
    description,
    icon,
    variant = 'default',
} = defineProps<Props>();

const variantStyles = {
    default: {
        icon: 'text-muted-foreground',
        text: 'text-foreground',
    },
    destructive: {
        icon: 'text-destructive',
        text: 'text-destructive',
    },
};

const theme = computed(() => variantStyles[variant]);
</script>

<template>
    <Card class="gap-2">
        <CardHeader class="flex flex-row items-start justify-between">
            <CardDescription>
                {{ title }}
            </CardDescription>

            <component :is="icon" class="size-5" :class="theme.icon" />
        </CardHeader>
        <CardContent>
            <div class="text-3xl font-bold tabular-nums" :class="theme.text">
                {{ value }}
            </div>

            <p v-if="description" class="mt-2 text-sm text-muted-foreground">
                {{ description }}
            </p>
        </CardContent>
    </Card>
</template>
