<script setup lang="ts" generic="TData">
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { MoreHorizontal } from '@lucide/vue';

export interface ActionDef<T> {
    label?: string;
    action?: (row: T) => void;
    separator?: boolean;
    destructive?: boolean;
}

const props = defineProps<{
    row: TData;
    actions: ActionDef<TData>[];
    title?: string;
}>();
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" class="h-8 w-8 p-0">
                <span class="sr-only">Abrir menú de acciones</span>
                <MoreHorizontal class="h-4 w-4" />
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuLabel v-if="title">{{ title }}</DropdownMenuLabel>
            <template v-for="(item, index) in actions" :key="index">
                <DropdownMenuSeparator v-if="item.separator" />
                <DropdownMenuItem
                    :variant="item.destructive ? 'destructive' : undefined"
                    v-else-if="item.label && item.action"
                    @click="item.action(row)"
                >
                    {{ item.label }}
                </DropdownMenuItem>
            </template>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
